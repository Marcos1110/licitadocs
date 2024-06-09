<style>
   section{
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
         <p><strong>Criado em:</strong> {{ $documento->created_at->format('d/m/Y H:i:s') }}</p>
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
         <a href="{{ route('documento.editar', ['id' => $documento->id]) }}" class="btn btn-primary mt-3"> Alterar </a>
         <form id="deleteForm" action="{{ route('documento.excluir', ['id' => $documento->id]) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <input type="hidden" name="password" id="password">
            <button type="submit" class="btn btn-danger mt-3">Excluir</button>
         </form>
      </div>
   </div>
</section>

