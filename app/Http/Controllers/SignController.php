<?php

namespace App\Http\Controllers;

use App\Models\Certificado;
use App\Models\Documento;
use App\Models\User;
use App\Models\Cargo;
use App\Notifications\SignedDocumentNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use setasign\Fpdi\Tcpdf\Fpdi;
use setasign\Fpdi\PdfParser\StreamReader;
use Illuminate\Support\Facades\Storage;

class SignController extends Controller
{
    public function assinar(Request $request, $id) {
        $documento = Documento::findOrFail($id);
        $user = Auth::user();

        $certificado = Certificado::where('usuario', $user->id)->first();
        if (!$certificado || !file_exists(storage_path("app/{$certificado->arquivo}"))) {
            return redirect()->back()->with('error', 'Você não possui um token de assinatura válido ou o certificado não está disponível.');
        }

        try {
            $cert_file = file_get_contents(storage_path("app/{$certificado->arquivo}"));
            $cert_info = [];
            if (!openssl_pkcs12_read($cert_file, $cert_info, $certificado->senha)) {
                throw new \Exception("Não foi possível ler o certificado.");
            }

            $pdf = new Fpdi();
            $pageCount = $pdf->setSourceFile(storage_path("app/{$documento->arquivo}"));

            for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
                $pdf->AddPage();
                $templateId = $pdf->importPage($pageNo);
                $pdf->useTemplate($templateId);
            }

            $cargo = Cargo::find($user->cargo);
            
            if (!$documento->assinado) {
                $pdf->AddPage();
                $pdf->SetFont('Helvetica', '', 12);
                $pdf->MultiCell(0, 10, "Quem assinou esse documento:\n" . $user->name . " | " . $user->cpf . " | " . $cargo->nome . " | " . now()->format('d/m/Y H:i:s'), 0, 'L');
            }

            // Assinatura digital
            $info = [
                'Name' => $user->name,
                'Location' => 'Empresa X',
                'Reason' => 'Confirmação de Autenticidade',
                'ContactInfo' => $user->email,
            ];

            $pdf->setSignature($cert_info['cert'], $cert_info['pkey'], $certificado->senha, '', 2, $info);
            
            $outputFile = storage_path('app/public/documentos/' . $documento->id . '_assinado.pdf');
            $pdf->Output($outputFile, 'F');

            $documento->assinado = true;
            $documento->arquivo = 'public/documentos/' . $documento->id . '_assinado.pdf';
            $documento->save();

            return back()->with('success', 'Documento assinado com sucesso.');;
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao assinar o documento: ' . $e->getMessage());
        }
    }
}
