@extends('master')

@section('content')

    <h3>Assinar Documento</h3>
     <!-- Mensagens de feedback -->
     @if(session('success'))
     <div class="alert alert-success d-flex align-items-center" role="alert">
           {{ session('success') }}
     </div>
     @elseif(session('error'))
        <div class="alert alert-danger d-flex align-items-center" role="alert">
           {{ session('success') }}
        </div>
     @endif
     
    <p>Você vai assinar - {{$documento->titulo}}</p>
    <form action="{{ route('documentos.assinar', $documento->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="certificado" class="form-label">Certificado Digital:</label>
            <input type="file" class="form-control" id="certificado" name="certificado" required accept=".crt,.p12">
        </div>
        
        @if($pageCount > 1)
        <div class="mb-3">
            <label for="pagina" class="form-label">Página a ser assinada:</label>
            <select class="form-select" id="pagina" name="pagina">
                @for ($i = 1; $i <= $pageCount; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>
        @else
            <input type="hidden" name="pagina" value="1">
        @endif
        
        <button type="submit" class="btn btn-primary">Assinar</button>
    </form>
@endsection
