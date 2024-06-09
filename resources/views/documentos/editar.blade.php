@extends('master')

@section('content')
   @include('componentes.navbar')
   <div class="text-center py-3 mb-4 border-bottom">
      <h4> Editando: {{$documento->titulo}} </h4>
   </div>
   <div  class="login-page" style="display: inline">
      <div class="form">
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
         <form action="{{ route('documento.atualizar', $documento->id) }}" method="POST" enctype="multipart/form-data" class="login-form">
            @csrf
            @method('PUT')
            <!-- Título -->
            <input type="text" name="titulo" id="titulo" placeholder="Insira o título do Documento" value="{{ $documento->titulo }}">
            <!-- Descrição -->
            <textarea class="form-control" name="descricao" id="descricao" rows="3" placeholder="Insira uma breve descrição (se necessário)...">{{ $documento->descricao }}</textarea>
            <!-- Processo -->
            <select class="form-select" id="processo" name="processo">
               <option value=""> Processo </option>
               <?php
                 $processoAtual = App\Models\Processo::find($documento->processo);
                 $modalidadeAtual = App\Models\Modalidade::find($processoAtual->modalidade);
                 $processos = App\Models\Processo::where('id', '!=', $documento->processo)->get();
               ?>
               <option value="{{ $processoAtual->id }}" selected>
               <?php
                 if($modalidadeAtual) {
                 echo $modalidadeAtual->nome . " - ";
                 }
                 echo str_pad($processoAtual->numero, 3, '0', STR_PAD_LEFT);
               ?>.{{ $processoAtual->ano }}</option>
               @foreach($processos as $processo)
               <?php
                 $modalidade = App\Models\Modalidade::find($processo->modalidade);
               ?>
               <option value="{{ $processo->id }}">
               <?php
                 if($modalidade) {
                 echo $modalidade->nome . " - ";
                 }
                 echo str_pad($processo->numero, 3, '0', STR_PAD_LEFT);
               ?>.{{ $processo->ano }}</option>
               @endforeach
            </select>
            <!-- Arquivo -->
            <input type="file" name="arquivo" id="arquivo" accept="application/pdf" value="{{ $documento->arquivo }}"><br>
            <button type="submit" class="btn btn-primary"> Atualizar </button>
         </form>
      </div>
   </div>
@endsection