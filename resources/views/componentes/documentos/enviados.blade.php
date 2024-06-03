<div class="gradient-custom-1 h-100">
  <div class="mask d-flex align-items-center h-100">
    <div class="container">
      <div class="row justify-content-center">
          <div class="col-12">
            @if ($documentosEnviados->isEmpty())
               <p class="mt-3"> Nenhum arquivo enviado... </p>
            @else
              <div class="table-responsive bg-white">
                <table class="table mb-0 table-dark">
                  <thead>
                    <tr>
                      <th scope="col"> Título </th>
                      <th scope="col"> Enviado para </th>
                      <th scope="col"> Data de Recebimento </th>
                      <th scope="col"> Processo </th>
                      <th scope="col"></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($documentosEnviados as $documento)
                      <tr>
                          <td> {{ $documento->titulo }} </td>
                          <td>
                            <?php 
                            $destinatario = App\Models\User::find($documento->destinatario);
                            if($destinatario) {
                                echo $destinatario->name;
                            }
                            ?>
                          </td>
                          <td> {{ $documento->created_at->format('d/m/Y H:i:s') }}  </td>
                          <td> 
                            <?php 
                              $processo = App\Models\Processo::find($documento->processo);
                              if($processo) {
                                $modalidade = App\Models\Modalidade::find($processo->modalidade);
                                echo "$modalidade->desc" . " - "; 
                              }
                              echo str_pad($processo->numero, 3, '0', STR_PAD_LEFT);
                            ?>.{{ $processo->ano }}
                          </td>
                          <td> <a href="{{ route('documento.viewer', $documento->id) }}">Detalhes</a> </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            @endif
        </div>
      </div>
    </div>
  </div>
</div>