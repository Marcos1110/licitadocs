<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use App\Models\Token;
use App\Models\Role;
use App\Models\User;
use App\Notifications\SignedDocumentNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use setasign\Fpdi\Tcpdf\Fpdi;
use setasign\Fpdi\PdfParser\StreamReader;
use Illuminate\Support\Facades\Storage;

class SignController extends Controller
{
    public function index($id)
    {
        $documento = Documento::findOrFail($id);
        $pdf = new Fpdi();
        $pageCount = $pdf->setSourceFile(storage_path('app/' . $documento->arquivo));

        return view('assinatura.signForm', compact('documento', 'pageCount'));
    }

    public function assinar(Request $request, $id) {
        $documento = Documento::findOrFail($id);
        $user = Auth::user();
    
        $token = Token::where('usuario', $user->id)->first();
        if (!$token || !file_exists(storage_path("app/{$token->certificado}"))) {
            return redirect()->back()->with('error', 'Você não possui um token de assinatura válido ou o certificado não está disponível.');
        }
    
        try {
            $cert_file = file_get_contents(storage_path("app/{$token->certificado}"));
            $cert_info = [];
            if (!openssl_pkcs12_read($cert_file, $cert_info, $token->senha)) {
                throw new \Exception("Não foi possível ler o certificado.");
            }
    
            $pdf = new Fpdi();
            $pageCount = $pdf->setSourceFile(storage_path("app/{$documento->arquivo}"));
    
            for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
                $pdf->AddPage();
                $templateId = $pdf->importPage($pageNo);
                $pdf->useTemplate($templateId);
            }
    
            $cargo = Role::find($user->role);
            
            if (!$documento->assinado) {
                $pdf->AddPage();
                $pdf->SetFont('Helvetica', '', 12);
                $pdf->MultiCell(0, 10, "Quem assinou esse documento:\n" . $user->name . " | " . $user->cpf . " | " . $cargo->desc . " | " . now()->format('d/m/Y H:i:s'), 0, 'L');
            }
    
            // Assinatura digital
            $info = [
                'Name' => $user->name,
                'Location' => 'Empresa X',
                'Reason' => 'Confirmação de Autenticidade',
                'ContactInfo' => $user->email,
            ];
    
            $pdf->setSignature($cert_info['cert'], $cert_info['pkey'], $token->senha, '', 2, $info);
            
            $outputFile = storage_path('app/public/documentos/documento_assinado_' . $documento->id . '.pdf');
            $pdf->Output($outputFile, 'F');
    
            $documento->assinado = true;
            $documento->arquivo = 'public/documentos/documento_assinado_' . $documento->id . '.pdf';
            $documento->save();

           $remetente = User::find($documento->remetente);

            $remetente->notify(new SignedDocumentNotification($documento, $remetente));
    
            return back()->with('success', 'Documento assinado com sucesso.');;
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao assinar o documento: ' . $e->getMessage());
        }
    }
    
}
