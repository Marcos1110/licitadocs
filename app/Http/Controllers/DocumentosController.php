<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\Documento;
use App\Models\Processo;
use App\Models\TiposDocumento;
use App\Models\User;
use App\Notifications\ReceivedDocumentNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentosController extends Controller
{
    public function index(){
      # Mostra a view do formulário para upload de arquivos
      # Carrega os usuários(exceto o atual), tipos e processos para serem mostrados nos campos do formulário. 
      $destinatarios = User::where('id', '!=', Auth::id())->get();
      $tiposDocumento = TiposDocumento::all();
      $processos = Processo::all();


      return view('documentos.uploadForm', compact('destinatarios', 'tiposDocumento', 'processos'));
  }

    public function store(Request $request)
    {
        #Salva o arquivo no banco 
        $request->validate([
            'arquivo' => 'required|file|mimes:pdf|max:10240',
        ]);

        if ($request->hasFile('arquivo')) {
            
            $file = $request->file('arquivo');
            $filename = time() . '_' . $file->getClientOriginalName();

            $path = $file->storeAs('public/documentos', $filename);

            # Ajusta o valor de precisaAssinar para false caso não seja marcado
            $precisaAssinar = $request->has('precisaAssinar') ? true : false;

            # Salva os dados do arquivo no banco de dados
            $documento = new Documento();
            $documento->titulo = $request->input('titulo');
            $documento->descricao = $request->input('descricao');
            $documento->tipo = $request->input('tipoDocumento');
            $documento->processo = $request->input('processo'); 
            $documento->precisaAssinar = $precisaAssinar;
            $documento->assinado = false;
            $documento->arquivo = $path;
            $documento->remetente = Auth::user()->id;
            $documento->destinatario = $request->input('destinatario');
            $documento->save();

            $this->notificarDesinatario($documento);

            return back()->with('success', 'Arquivo enviado com sucesso!')->with('path', $path);
        }
        return back()->with('error', 'Erro ao enviar o arquivo.');
    }

    public function notificarDesinatario($documento){

        $destinatario = User::find($documento->destinatario);
        $remetente = User::find($documento->remetente);

        $destinatario->notify(new ReceivedDocumentNotification($documento, $destinatario, $remetente));
    }

    public function viewer($id){
        $documento = Documento::findOrFail($id);
        if (auth()->user()->id == $documento->destinatario || auth()->user()->id == $documento->remetente) {
            $pdfPath = Storage::disk('public')->path($documento->arquivo);
            return view('documentos.viewer', compact('pdfPath', 'documento'));
        } else {
            return redirect()->back()->with('error', 'Você não tem permissão para visualizar este documento.');
        }
    }

    public function show($id)
    {
        $documento = Documento::findOrFail($id); 

        return response()->file(storage_path('app/' . $documento->arquivo));
    }

}


