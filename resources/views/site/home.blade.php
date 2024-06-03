@extends('master')

@section('content')
    <!-- Chamado -->
    <section class="jumbotron py-5">
        <div class="container-fluid">
            <div class="row justify-content-center text-center">
                <div class="px-4 py-5 my-5 text-center">
                    <h3 class="display-6 fw-bold">Bem-vindo(a) ao</h3>
                    <h1 class="display-5 fw-bold">LicitaDocs</h1>
                    <div class="col-lg-6 mx-auto">
                        <p class="lead mb-4">O Lorem Ipsum é um texto modelo da indústria tipográfica e de impressão. O Lorem Ipsum tem vindo a ser o texto padrão usado por estas indústrias desde o ano de 1500, quando uma misturou os caracteres de um texto para criar um espécime de livro. </p>
                        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                            <a href="{{ route('login')}}" class="btn btn-primary" role="button">Começar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection