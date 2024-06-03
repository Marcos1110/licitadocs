@extends('master')

@section('content')
<section class="pt-5 pb-5">
   <div class="container">
      <div class="row text-center">
            <div class="col">
               <h3 class="mb-4">Bom ter você de volta!</h3>
               <p class="lead mb-4">Por favor, realize o login para acessar sua página</p>
            </div>
            <!-- Mensagem de erro no login -->
            @error('error')
               <span>{{ $message }}</span>
            @enderror
            <div class="container mt-2 d-flex justify-content-center">
               <div style="width:40%;">
                   <!-- Formulário de Login -->
                   <form action="{{ route('login.store') }}" method="post" class="form-horizontal">
                       @csrf
                       <!-- Input de email -->
                       <div class="form-floating mb-3">
                           <input type="email" class="form-control" name="email" id="inputEmail" placeholder="name@example.com">
                           <label for="inputEmail">Email</label>
                           @error('email')
                               <div class="text-danger">{{ $message }}</div>
                           @enderror
                       </div>
                       <!-- Input de senha -->
                       <div class="form-floating mb-3">
                           <input type="password" class="form-control" name="password" id="inputPassword" placeholder="Password">
                           <label for="inputPassword">Senha</label>
                           @error('password')
                               <div class="text-danger">{{ $message }}</div>
                           @enderror
                       </div>
                       <!-- Botão de submit -->
                       <div class="d-grid">
                           <button type="submit" class="btn btn-primary">Entrar</button>
                       </div>
                   </form>
               </div>
           </div>           
      </div>
   </div>
</section>
@endsection