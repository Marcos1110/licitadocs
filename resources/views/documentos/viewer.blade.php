@extends('master')

@section('content')
    @include('componentes.navbar')

    <div class="container mt-5 pt-3">
        <h2> {{ $documento->titulo }} </h2>
        <div class="row">
            <!-- Iframe que mostra o documento -->
            <div class="col-md-6">
                <iframe src="{{ route('documento.show', ['id' => $documento->id]) }}" width="100%" height="600px"></iframe>
            </div>

            <!-- Informações do documento -->
            <div class="col-md-6">
                <div class="card p-3 mb-3">
                   @if ($documento->destinatario == auth()->user()->id)
                   <p>
                      <strong>Remetente:</strong>
                      <?php
                         $remetente = App\Models\User::find($documento->remetente);
                         if($remetente) {
                               echo $remetente->name;
                         }
                      ?>
                   </p>   
                   @else
                         <p>
                            <strong>Destinatário:</strong>
                            <?php
                               $destinatario = App\Models\User::find($documento->destinatario);
                               if($destinatario) {
                                     echo $destinatario->name;
                               }
                            ?>
                         </p>
                   @endif
                   <p><strong>Tipo:</strong>
                   <?php
                         $tipo = App\Models\TiposDocumento::find($documento->tipo);
                         if($tipo) {
                            echo $tipo->descricao;
                         }
                   ?>
                   </p>
                   <p><strong>Processo:</strong>
                   <?php
                         $processo = App\Models\Processo::find($documento->processo);
                         if($processo) {
                            $modalidade = App\Models\Modalidade::find($processo->modalidade);
                            echo "$modalidade->desc" . " " . str_pad($processo->numero, 3, '0', STR_PAD_LEFT);
                         }
                   ?>
                   </p>
                   <p><strong>Descrição:</strong> {{ $documento->descricao }}</p>
                </div>
             </div>
                <div class="d-flex justify-content-end">
                    @if($documento->destinatario == auth()->user()->id && !$documento->assinado)
                        <form action="{{ route('documento.assinar', $documento->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-primary"> Assinar </button>
                        </form>
                    @endif
                </div>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    

@endsection
