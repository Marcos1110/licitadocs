@extends('master')

@section('titulo') Enviar Documento @endsection

@section('content')
   @include('componentes.navbar')
   <div class="text-center py-3 mb-4 border-bottom">
      <h4> Enviar Documento </h4>
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
        <form action="{{ route('envio.save') }}" method="POST" enctype="multipart/form-data" class="login-form">
         @csrf
         <!-- Destinatario -->
         <select class="form-select" id="destinatario" name="destinatario">
            <option value=""> Destinatário </option>
            @foreach($destinatarios as $user)
               <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
         </select>
         <!-- Documento -->
         <select class="form-select" id="documento" name="documento">
            <option value=""> Documento </option>
            @foreach($documentos as $documento)
               <option value="{{ $documento->id }}">{{ $documento->titulo }}</option>
            @endforeach
         </select>
         <!-- Precisa Assinar? -->
         <label class="control control-checkbox">
            Precisa Assinar?
                <input type="checkbox" name="assinar" id="assinar" value="1" />
            <div class="control_indicator"></div>
        </label>
         <!-- Botão de Envio -->
         <button type="submit"> Enviar </button>
      </form>
   </div>
</div>
@endsection

