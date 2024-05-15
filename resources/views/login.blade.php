@extends('master')

@section('content')
   <!-- Barra de Navegação -->
   <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
      <div class="container px-4">
          <a class="navbar-brand" href="#page-top">Licitadocs</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
              <ul class="navbar-nav ms-auto">
                  <li class="nav-item"><a class="nav-link" href={{ route('home')}}>Home</a></li>
                  <li class="nav-item"><a class="nav-link" href="#">Cadastro</a></li>
              </ul>
          </div>
      </div>
   </nav>
   
   <main>
      <div class="row justify-content-center align-items-center" style="height:100vh">
      
         <div class="col-4">
            <div class="card">
               <div class="card-body">
                  <h3 class="h3 mb-3 fw-normal text-center">Login</h3>
      
                  <!-- Mensagem de erro no login -->
                  @error('error')
                     <span>{{ $message }}</span>
                  @enderror
      
                  <!-- Formulário de Login -->
                  <form action="{{ route('login.store') }}" method="post" class="form-horizontal">
      
                     @csrf
      
                     <!-- Input de nome -->
                     <div class="form-group">
                        <div class="mb-3">
                           <input type="text" name="email" value="" placeholder="Insira seu email" class="form-control input-md">
                           @error('email')
                           <span  span id="passwordHelpInline" class="form-text">{{ $message }}</span>
                           @enderror
                        </div>
                     </div>
      
                     <!-- Input de senha -->
                     <div class="form-group">
                        <div class="mb-3">
                           <input type="password" name="password" value="" placeholder="Insira sua senha" class="form-control input-md">
                           @error('password')
                              <span d="passwordHelpBlock" class="form-text">{{ $message }}</span>
                           @enderror
                        </div>
                     </div>
      
                     <!-- Botão de submit -->
                     <div class="form-group">
                        <button type="submit" class="btn btn-primary w-100"> Login </button>
                     </div>
      
                  </form>
               </div>
            </div>
         </div>
      </div>
   </main>
@endsection