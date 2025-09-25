@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">🎉 Eventos disponibles</h1>

    <div class="row">
        @forelse($eventos as $evento)
            <div class="col-md-4">
                <div class="card mb-3 shadow-sm">
                    @if($evento->imagen)
                        <img src="{{ asset('storage/' . $evento->imagen) }}" class="card-img-top" alt="Imagen evento">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $evento->nombre_evento }}</h5>
                        <p class="card-text">
                            {{ $evento->fecha }} <br>
                            {{ $evento->hora_inicio }} <br>
                            Capacidad: {{ $evento->capacidad_maxima }}
                        </p>
                        <p class="card-text text-muted">
                            {{ $evento->descripción }}
                        </p>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">No hay eventos disponibles por ahora.</p>
        @endforelse
    </div>
</div>
@endsection
