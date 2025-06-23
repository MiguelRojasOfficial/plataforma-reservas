<div class="container mt-4">
    <h1 class="text-center mb-4">Funciones en el Teatro</h1>
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    @if(count($funciones) > 0)
        <div class="row">
            @foreach ($funciones as $funcion)
                <div class="col-md-12 mb-4">
                    <div class="card shadow-sm funcion-card">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{ asset('images/' . ($funcion['imagen'] ?? 'placeholder.webp')) }}" class="rounded-start w-100" alt="{{ $funcion['titulo'] }}" style="height: 200px; object-fit: cover; object-position: center;">
                            </div>


                            <div class="col-md-8 d-flex align-items-center">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $funcion['titulo'] }}</h5>
                                    <p class="card-text">
                                        <strong>Fecha:</strong> {{ \Carbon\Carbon::parse($funcion['fecha'])->format('d/m/Y') }}<br>
                                        <strong>Hora:</strong> {{ $funcion['hora'] }}<br>
                                        <strong>Lugar:</strong> {{ $funcion['lugar'] }}
                                    </p>
                                </div>
                                @auth
                                    <a href="{{ route('crear-reserva', ['titulo' => $funcion['titulo']]) }}" class="btn btn-outline-danger mt-2 me-5">
                                        Reservar entrada
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-outline-danger mt-2 me-5">
                                        Reservar entrada
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>No hay funciones disponibles por el momento.</p>
    @endif
</div>