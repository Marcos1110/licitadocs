@extends('master')

@section('titulo') Recebidos @endsection

@section('content')
   @include('componentes.navbar')
   <div class="text-center py-3 mb-4 border-bottom">
    <h4> Documentos Recebidos </h4>
  </div>
  <div class="table-responsive container-table">
   <table class="table table-striped 
               table-bordered table-hover custom-table">
       <thead>
           <tr>
               <th>Index</th>
               <th>Titulo</th>
               <th>Enviado Por</th>
               <th>Enviado Em</th>
               <th></th>
           </tr>
       </thead>
       <tbody>
          @foreach ($documentos as $documento)
            <tr>
              <td> {{ $documento->id }} </td>
              <td> {{ $documento->titulo }} </td>
              <td>
                @php
                  $responsavel = App\Models\User::find($documento->responsavel);
                  echo $responsavel->name; 
                @endphp
              </td>
              <td> 
                @php
                  $envio = App\Models\Envio::where('documento', $documento->id)
                          ->where('destinatario', Auth::user()->id)
                          ->first();
                  echo $envio->created_at->format('d/m/Y H:i:s');
                @endphp
              </td>
              <td><a href="{{ route('documento.visualizar', ['id' => $documento->id]) }}">Visualizar</a></td>
            </tr>
          @endforeach
       </tbody>
   </table>
  </div>
@endsection