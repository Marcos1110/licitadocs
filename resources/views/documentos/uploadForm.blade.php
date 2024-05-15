@extends('master')

@section('content')
<!-- Barra de Navegação -->
@include('nav-bar')

<main>
   <div class="container mt-5 pt-3"></div>
      <div class="row justify-content-center">
         <div class="col-lg-6 col-md-8 col-sm-10">
            <div class="card">
               <div class="card-body">
               <h3 class="h3 mb-3 fw-normal text-center">Enviar Documento</h3>

               <!-- Mensagens de feedback -->
               @if(session('success'))
               <div class="alert alert-success d-flex align-items-center" role="alert">
                     {{ session('success') }}
               </div>
               @elseif(session('error'))
                  <div class="alert alert-danger d-flex align-items-center" role="alert">
                     {{ session('success') }}
                  </div>
               @endif

               <!-- Formulário de Envio -->
               <form action="{{ route('documentos.store') }}" method="POST" enctype="multipart/form-data">

                  @csrf

                  <!-- Campo para Título do Documento -->
                  <div class="form-group">
                     <div class="mb-3">
                        <input type="text" name="titulo" id="titulo" placeholder="Insira o título do Documento" class="form-control input-md">
                     </div>
                  </div>

                  <!-- Campo para Descrição do Documento -->
                  <div class="form-group">
                     <div class="mb-3">
                        <textarea class="form-control" name="descricao" id="descricao" rows="3" placeholder="Insira uma breve mensagem..."></textarea>
                     </div>
                  </div>

                  <!-- Campo para Destinatário -->
                  <div class="form-group">
                     <div class="mb-3">
                        <select class="form-select" id="destinatario" name="destinatario">
                           <option value="">Para quem será enviado?</option>
                           @foreach($usuarios as $usuario)
                              <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                           @endforeach
                        </select>
                     </div>
                  </div>

                  <!-- Campo para Tipo do Documento -->
                  <div class="form-group">
                     <div class="mb-3">
                        <select class="form-select" id="tipoDocumento" name="tipoDocumento">
                           <option value="">Qual o tipo do documento?</option>
                           @foreach($tiposDocumento as $tipoDocumento)
                              <option value="{{ $tipoDocumento->id }}">{{ $tipoDocumento->descricao }}</option>
                           @endforeach
                        </select>
                     </div>
                  </div>

                  <!-- Campo para Processo ao qual o Documento é referente -->
                  <div class="form-group">
                     <div class="mb-3">
                        <select class="form-select" id="processo" name="processo">
                           <option value="">De qual processo é esse documento?</option>
                           @foreach($processos as $processo)
                              <option value="{{ $processo->id }}">
                              <?php
                                 $modalidade = App\Models\Modalidade::find($processo->modalidade);
                                 if($modalidade) {
                                     echo $modalidade->desc . " - ";
                                 }
                                 echo str_pad($processo->numero, 3, '0', STR_PAD_LEFT);
                             ?>.{{ $processo->ano }}</option>
                           @endforeach
                        </select>
                     </div>
                  </div>

                  <!-- Campo para identificar a necessidade de assinatura do destinatario -->
                  <div class="form-group">
                     <div class="mb-3">
                        <input type="checkbox" name="precisaAssinar" id="precisaAssinar" value="1">
                        <label for="precisaAssinar">Precisa assinar?</label>
                     </div>
                  </div>

                  <!-- Campo oculto para Assinado -->
                  <input type="hidden" name="assinado" value="0">

                  <!-- Campo para upload do documento -->
                  <div class="input-group mb-3">
                     <input type="file" name="arquivo" id="arquivo" accept="application/pdf"><br>
                  </div>

                  <!-- Botão de Envio -->
                  <div class="form-group">
                     <button type="submit" class="btn btn-primary w-100"> Enviar </button>
                  </div>

               </form>
            </div>
         </div>
      </div>
</main>
@endsection