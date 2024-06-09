@extends('master')

@section('titulo') Licitadocs - Login @endsection

@section('content')
<div class="login-page">
    <div class="form">
      <form action="{{ route('login.store') }}" method="post" class="login-form">
        @csrf
        <!-- Email -->
        <input type="email" name="email" id="inputEmail" placeholder="Insira seu email"/>
        <!-- Mensagem de email obrigatório -->
        @error('email')
          <span class="text-danger">{{ $message }}</span>
        @enderror
        <!-- Senha -->
        <input type="password" name="password" id="inputPassword" placeholder="Insira sua senha"/>
        <!-- Mensagem de senha obrigatória -->
        @error('password')
              <span class="text-danger">{{ $message }}</span>
        @enderror
        <!-- Botão de Login -->
        <button>Login</button>
      </form>
      <!-- Mensagem de erro no login -->
      @error('error')
        <span class="text-danger">{{ $message }}</span>
      @enderror
    </div>
  </div>
@endsection