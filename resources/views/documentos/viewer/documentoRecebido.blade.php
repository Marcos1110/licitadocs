<style>
   section {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      width: 95%;
   }
   .doc-info {
      padding: 20px;
      margin-top: 20px;
      border: 1px solid #ccc;
      background: white;
      box-shadow: 7px 6px 20px 0px rgba(22,20,20,0.64);
      -webkit-box-shadow: 7px 6px 20px 0px rgba(22,20,20,0.64);
      -moz-box-shadow: 7px 6px 20px 0px rgba(22,20,20,0.64);
   }
   .doc-info h5 {
      font-size: 1.5rem;
      margin-bottom: 20px;
   }
   .doc-info p {
      margin-bottom: 10px;
   }
   .doc-info p strong {
      font-weight: bold;
   }
   .doc-info p:last-child {
      margin-bottom: 0;
   }
   .doc-info p:first-child {
      margin-top
      display: flex;
      justify-content: center;
      align-items: center;
   }
   .doc {
      width: 50%;
      padding: 20px;
   }

   iframe {
      width: 100%;
      height: 100vh;

   }
</style>

@include('componentes.navbar')
<div class="text-center py-3 mb-4 border-bottom">
   <h4> {{ $documento->titulo }} </h4>
</div>

<section>
   <div class="doc">
      <iframe src="{{ route('documento.show', ['id' => $documento->id])}}"></iframe>
   </div>

   <div style="width: 50%;">
      <div class="doc-info">
         <h5>Informações do documento</h5>
         <p><strong>Recebido em:</strong> 
            @php
               $envio = App\Models\Envio::where('documento', $documento->id)
                  ->where('destinatario', Auth::user()->id)
                  ->first();
               echo $envio->created_at->format('d/m/Y H:i:s');
            @endphp
         </p>
         <p><strong>Enviado por:</strong> 
            @php
               $responsavel = App\Models\User::find($documento->responsavel);
               echo $responsavel->name; 
            @endphp
         </p>
         <p><strong>Processo:</strong>
            @php
               $processo = App\Models\Processo::where('id', $documento->processo)->first();
               $modalidade = App\Models\Modalidade::where('id', $processo->modalidade)->first();
               echo $modalidade->nome .  " - " . str_pad($processo->numero, 3, '0', STR_PAD_LEFT) . "/" . $processo->ano;
            @endphp
         </p>
         <p><strong>Descrição:</strong> {{ $documento->descricao }}</p>
      </div>
      <div>
         <a href="{{ route('documento.download', ['id' => $documento->id]) }}" class="btn btn-primary mt-3"> Download </a>
         <form action="{{ route('documento.assinar', $documento->id) }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-primary"> Assinar </button>
        </form>
      </div>
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
   </div>
</section>
