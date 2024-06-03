@extends('master')

@section('content')
   <!-- Barra de Navegação -->
   @include('componentes.navbar')
   <main>
      <div class="container mt-5 pt-3">
          <ul class="nav nav-tabs">
            <li class="nav-item">
               <a class="nav-link active" data-bs-toggle="tab" href="#recebidos">Documentos Recebidos</a>
            </li>
            <li class="nav-item">
               <a class="nav-link" data-bs-toggle="tab" href="#enviados">Documentos Enviados</a>
            </li>
          </ul>
  
          <!-- Tab panes -->
          <div class="tab-content">
            <div class="tab-pane container active" id="recebidos">
               @include('componentes.documentos.recebidos')
            </div>
            <div class="tab-pane container fade" id="enviados">
               @include('componentes.documentos.enviados')
            </div>
          </div>
      </div>
  </main>
@endsection