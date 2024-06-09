<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Documento;
use App\Models\User;
use App\Models\Envio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\ReceivedDocumentNotification;

class EnvioController extends Controller
{
    public function mostrarFormulario()
    {
        $documentos = Documento::where('responsavel', Auth::user()->id)->get();
        $destinatarios = User::where('id', '!=', Auth::user()->id)->get();
        return view('envio.formulario', compact('documentos', 'destinatarios'));
    }

    public function enviarDocumento(Request $request)
    {
        $request->validate(
            [
                'destinatario' => 'required',
                'documento' => 'required',
            ],
            [
                'destinatario.required' => 'Selecione um destinatário.',
                'documento.required' => 'Selecione um documento.',
        ]);

        if($request->has('destinatario') && $request->has('documento'))
        {
            $envio = new Envio();
            $envio->destinatario = $request->input('destinatario');
            $envio->documento = $request->input('documento');
            $envio->precisaAssinar = $request->has('assinar') ? true : false;
            $envio->save();

            $this->notificarDesinatario($envio->documento, $envio);
            return back()->with('success', 'Documento enviado com sucesso!');
        }
        
        return back()->with('error', 'Erro ao enviar o documento.');
    }

    

    public function notificarDesinatario($documento, $envio){
        $documento = Documento::find($documento);
        $destinatario = User::find($envio->destinatario);
        $remetente = User::find($documento->responsavel);

        $destinatario->notify(new ReceivedDocumentNotification($documento, $destinatario, $remetente));
    }
}
