<?php

namespace App\Http\Controllers;
use App\Models\Documento;

class DashboardController extends Controller
{
    public function index() {
        # Mostra a view do Dashboard
        $documentosRecebidos = Documento::where('destinatario', auth()->user()->id)->get();
        $documentosEnviados = Documento::where('remetente', auth()->user()->id)->get();
        return view('dashboard',['documentosEnviados' => $documentosEnviados], ['documentosRecebidos' => $documentosRecebidos]);
    }
}