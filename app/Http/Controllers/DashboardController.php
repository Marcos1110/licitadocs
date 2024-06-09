<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Documento;

class DashboardController extends Controller
{
    public function index() {
        $documentos = Documento::where('responsavel', Auth::user()->id)->get();
       
        return view('usuario.dashboard', compact('documentos'));
    }
}