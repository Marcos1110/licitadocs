@extends('master')

@section('content')
<!-- Barra de Navegação -->
@include('nav-bar')

<!-- Conteúdo Principal -->
<main>
    <div class="container mt-5 pt-3">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#recebidos">Arquivos Recebidos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#enviados">Arquivos Enviados</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane container active" id="recebidos">
                @include('documentos.recebidos')
            </div>
            <div class="tab-pane container fade" id="enviados">
                @include('documentos.enviados')
            </div>
        </div>
    </div>
</main>
@endsection
