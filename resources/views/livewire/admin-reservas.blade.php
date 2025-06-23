<div class="container mt-4">
    <h2>Administrar Reservas</h2>

    <input type="text" class="form-control mb-3" placeholder="Buscar por nombre" wire:model="search">

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reservas as $reserva)
            <tr>
                <td>{{ $reserva->user->name }}</td>
                <td>{{ $reserva->fecha }}</td>
                <td>{{ $reserva->hora}}</td>
                <td>{{ $reserva->estado}}</td>
                <td>
                    @if($reserva->estado === 'pendiente')
                        <button class="btn btn-success btn-sm me-2" wire:click="confirmar({{ $reserva->id }})">Confirmar</button>
                        <button class="btn btn-danger btn-sm" wire:click="cancelar({{ $reserva->id }})">Cancelar</button>
                    @elseif($reserva->estado === 'confirmada')
                        <span class="text-success">Confirmada</span>
                    @else
                        <span class="text-muted">Cancelada</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">No hay reservas registradas</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{ $reservas->links() }}
</div>