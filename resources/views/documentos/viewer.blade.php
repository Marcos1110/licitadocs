@extends('master')

@section('titulo') Visualizar Documento @endsection

@section('content')

    @if ($documento->responsavel == auth()->user()->id)
       @include('documentos.viewer.documentoEnviado')
    @else
       @include('documentos.viewer.documentoRecebido')
    @endif
@endsection