@extends('master')

@section('titulo') Dashboard @endsection

@section('content')
   @include('componentes.navbar')
   
   <div class="text-center py-3 mb-4 border-bottom">
         <h2> Bem-vindo(a) {{ auth()->user()->name }} </h2>
         <h4> Seus Documentos </h4>
    </div>
    <div class="table-responsive container-table">
        <table class="table table-striped 
                    table-bordered table-hover custom-table">
            <thead>
                <tr>
                    <th>Index</th>
                    <th>Titulo</th>
                    <th>Criado em</th>
                    <th>Mais Detalhes</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($documentos as $documento)
                    <tr>
                    <td> {{ $documento->id }} </td>
                    <td> {{ $documento->titulo }} </td>
                    <td> {{ $documento->created_at->format('d/m/Y H:i:s') }} </td>
                    <td><a href="{{ route('documento.visualizar', ['id' => $documento->id]) }}">Visualizar</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </table>
    </div>
@endsection