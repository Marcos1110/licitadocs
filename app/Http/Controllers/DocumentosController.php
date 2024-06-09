<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\Documento;
use App\Models\Envio;
use App\Models\Processo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentosController extends Controller
{
    public function mostrarFormulario()
    {
      $processos = Processo::all();

      return view('documentos.formulario', compact('processos'));
    }

    public function documentosRecebidos()
    {
      $envios = Envio::where('destinatario', Auth::user()->id)->get();
      $documentos = Documento::whereIn('id', $envios->pluck('documento'))->get();

      return view('documentos.recebidos', compact('documentos'));
    }

    public function salvarDocumento(Request $request)
    {
        $request->validate(
        [
            'arquivo' => 'required|file|mimes:pdf|max:10240',
        ]);

        if ($request->hasFile('arquivo')) {
            $arquivo = $request->file('arquivo');
            $novoNome = time() . '_' . $arquivo->getClientOriginalName();

            $caminho = $arquivo->storeAs('public/documentos', $novoNome);

            $documento = new Documento();
            $documento->titulo = $request->input('titulo');
            $documento->descricao = $request->input('descricao');
            $documento->processo = $request->input('processo');
            $documento->responsavel = Auth::user()->id;
            $documento->arquivo = $caminho;
            $documento->save();

            return back()->with('success', 'Arquivo salvo com sucesso!');
        }

        return back()->with('error', 'Erro ao salvar o arquivo.');
    }

    public function detalhesDocumento($id){
        $documento = Documento::findOrFail($id);
        $envio = Envio::where('documento', $documento->id)->get();
        $pdfPath = Storage::disk('public')->path($documento->arquivo);
        return view('documentos.viewer', compact('pdfPath', 'documento', 'envio'));
    }

    public function show($id)
    {
        $documento = Documento::findOrFail($id);
        $localizacao = storage_path('app/' . $documento->arquivo);
        return response()->file($localizacao);
    }

    public function download($id)
    {
        $documento = Documento::findOrFail($id);
        $path = storage_path('app/public/' . $documento->arquivo);
        return response()->download($path);
    }

    public function editarDocumento($id)
    {
        $documento = Documento::findOrFail($id);
        $processos = Processo::all();

        return view('documentos.editar', compact('documento', 'processos'));
    }

    public function atualizarDocumento(Request $request, $id)
    {
        $request->validate(
        [
            'arquivo' => 'file|mimes:pdf|max:10240',
        ]);
    
        $documento = Documento::findOrFail($id);
        $documento->titulo = $request->input('titulo');
        $documento->descricao = $request->input('descricao');
        $documento->processo = $request->input('processo');
    
        if ($request->hasFile('arquivo')) {
            $arquivo = $request->file('arquivo');
            $novoNome = time() . '_' . $arquivo->getClientOriginalName();

            $caminho = $arquivo->storeAs('public/documentos', $novoNome);

            $caminho = $arquivo->storeAs('public/documentos', $novoNome);
            $documento->arquivo = $caminho;
        }
    
        $documento->save();
    
        return back()->with('success', 'Documento atualizado com sucesso!');
    }

    public function excluirDocumento($id)
    {
        $documento = Documento::findOrFail($id);
        $documento->delete();

        return redirect()->route('usuario.dashboard')->with('success', 'Documento excluído com sucesso!');
    }
}


