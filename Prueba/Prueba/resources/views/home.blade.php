@extends('layouts.public')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Próximos Eventos</h2>
    <div class="row">
        @foreach($eventos as $evento)
            <div class="col-md-4 mb-3">
                <div class="card h-100 shadow-sm">
                    @if($evento->imagen)
                        <img src="{{ asset('storage/'.$evento->imagen) }}" class="card-img-top" alt="Imagen del evento">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $evento->nombre_evento }}</h5>
                        <p class="card-text">
                            Fecha: {{ $evento->fecha }} <br>
                            Hora: {{ $evento->hora_inicio }}
                        </p>
                        <a href="#" class="btn btn-primary">Ver más</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection