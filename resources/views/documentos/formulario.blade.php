@extends('master')

@section('titulo') Salvar Documento @endsection

@section('content')
   @include('componentes.navbar')
   <div class="text-center py-3 mb-4 border-bottom">
      <h4> Salvar Documento </h4>
   </div>
   <div class="login-page" style="display: inline">
      <div class="form">
         <!-- Mensagens de feedback -->
         @if(session('success'))
         <div class="alert alert-success d-flex align-items-center" role="alert">
            {{ session('success') }} <!-- Documento enviado com sucesso -->
         </div>
         @elseif(session('error'))
            <div class="alert alert-danger d-flex align-items-center" role="alert">
               {{ session('error') }} <!-- Documento não enviado -->
            </div>
         @endif
        <form action="{{ route('documento.save') }}" method="POST" enctype="multipart/form-data" class="login-form">
          @csrf
          <!-- Título -->
          <input type="text" name="titulo" id="titulo" placeholder="Insira o título do Documento">
          <!-- Descrição -->
          <textarea class="form-control" name="descricao" id="descricao" rows="3" placeholder="Insira uma breve descrição (se necessário)..."></textarea>
          <!-- Processo -->
          <select class="form-select" id="processo" name="processo">
            <option value=""> Processo </option>
            @foreach($processos as $processo)
               <option value="{{ $processo->id }}">
               <?php
                  $modalidade = App\Models\Modalidade::find($processo->modalidade);
                  if($modalidade) {
                      echo $modalidade->nome . " - ";
                  }
                  echo str_pad($processo->numero, 3, '0', STR_PAD_LEFT);
              ?>.{{ $processo->ano }}</option>
            @endforeach
         </select>
         <!-- Arquivo -->
         <input type="file" name="arquivo" id="arquivo" accept="application/pdf"><br>
         <!-- Botão de Envio -->
         <button type="submit"> Salvar </button>
      </form>
   </div>
</div>
@endsection

