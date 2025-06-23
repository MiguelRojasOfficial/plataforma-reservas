<div class="container mt-4">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h2 class="mb-0">Bienvenido {{ auth()->user()->name }}</h2>
        <form action="{{ route('logout') }}" method="POST" class="mt-4">
            @csrf
            <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
        </form>
    </div>
    @if (session('message'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif
    <a href="{{ route('reservas.create') }}" class="btn btn-success">Crear Reserva</a>
    <a href="{{ route('mis.reservas') }}" class="btn btn-primary">Mis Reservas</a>
</div>