@extends('master')

@section('content')
   @include('componentes.navbar')
   <main>
      <section class="pt-5 pb-5">
         <div class="container">
            <div class="row text-center">
               <div class="col">
                  <h3 class="mb-4">Envio de Documentos</h3>
               </div>
               <!-- Mensagens de feedback -->
               @if(session('success'))
                  <div class="alert alert-success d-flex align-items-center" role="alert">
                     {{ session('success') }} <!-- Documento enviado com sucesso -->
                  </div>
               @elseif(session('error'))
                  <div class="alert alert-danger d-flex align-items-center" role="alert">
                     {{ session('success') }} <!-- Documento não enviado -->
                  </div>
               @endif

               <!-- Formulário de Envio -->
               <form action="{{ route('documento.upload') }}" method="POST" enctype="multipart/form-data">
               @csrf
                  <!-- Campo para o Título do Documento -->
                  <div class="form-group">
                     <div class="mb-3">
                        <input type="text" name="titulo" id="titulo" placeholder="Insira o título do Documento" class="form-control">
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
                           @foreach($destinatarios as $destinatario)
                              <option value="{{ $destinatario->id }}">{{ $destinatario->name }}</option>
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
                     <input type="checkbox" name="precisaAssinar" id="precisaAssinar" value="1">
                     <label for="precisaAssinar">Precisa assinar?</label>
                 </div>
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
      </section>
   </main>
@endsection
                  

                 