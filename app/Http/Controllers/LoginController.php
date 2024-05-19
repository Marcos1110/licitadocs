<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        # Chama o formulário de login
        return view('login');
    }

    public function store(Request $request)
    {
        # Validação do formulário de login
        $request -> validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Este campo é obrigatório!',
            'email.email' => 'Email inválido!',
            'password.required' => 'Este campo é obrigatório!',
        ]);

        $credentials = $request -> only('email', 'password');
        $authenticated = Auth::attempt($credentials);

        if(!$authenticated) {
            return redirect() -> route('login') -> withErrors(['error' => "Email ou Senha inválidos"]);
        }

        return redirect() -> route('user.dashboard') -> with(['success' => 'Logged in']);
    }

    public function destroy()
    {
        #Efetua logout e redireciona para página de login
        Auth::logout();

        return redirect() -> route('login');
    }
}

