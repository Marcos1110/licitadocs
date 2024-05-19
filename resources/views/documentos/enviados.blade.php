<div class="gradient-custom-1 h-100">
   <div class="mask d-flex align-items-center h-100">
     <div class="container">
       <div class="row justify-content-center">
           <div class="col-12">
            @if ($documentosEnviados->isEmpty())
               <p class="mt-3"> <a href="{{route('documentos.index')}}">Clique aqui para enviar um documento</a></p>
            @else
             <div class="table-responsive bg-white">
               <table class="table mb-0">
                 <thead>
                   <tr>
                     <th scope="col"> Título </th>
                     <th scope="col"> Enviado para </th>
                     <th scope="col"> Data de Envio </th>
                     <th scope="col"> Processo </th>
                     <th scope="col"> + Detalhes</th>
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
                        <td> {{ $documento->created_at->format('d/m/Y H:i:s') }} </td>
                        <td> 
                          <?php 
                          $processo = App\Models\Processo::find($documento->processo);
                          if($processo) {
                            $modalidade = App\Models\Modalidade::find($processo->modalidade);
                            echo "$modalidade->desc" . " " . "$processo->numero";
                          }
                          ?> 
                        </td>
                        <td> <a href="{{ route('documentos.viewer', $documento->id) }}">Detalhes</a></td> 
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