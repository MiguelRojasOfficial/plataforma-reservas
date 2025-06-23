<div class="container mt-4">
    <h2 class="mb-3">Reservas</h2>
    @if (session()->has('message'))
    <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <div class="row mb-3">
        <div class="col-md-4">
            <input wire:model.debounce.300ms="search" type="text" class="form-control" placeholder="Buscar por nombre">
        </div>
        <div class="col-md-3">
            <select wire:model="estado" class="form-select">
                <option value="">Todos los estados</option>
                <option value="pendiente">Pendiente</option>
                <option value="confirmada">Confirmada</option>
                <option value="cancelada">Cancelada</option>
            </select>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Sede</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reservas as $reserva)
                <tr>
                    <td>{{ $reserva->usuario->nombre }}</td>
                    <td>{{ $reserva->sede->nombre }}</td>
                    <td>{{ $reserva->disponibilidad->fecha }}</td>
                    <td>{{ $reserva->disponibilidad->hora_inicio }} - {{ $reserva->disponibilidad->hora_fin }}</td>
                    <td>{{ ucfirst($reserva->estado) }}</td>
                    <td>
                        <div class="btn-group">
                            <button wire:click="actualizarEstado({{ $reserva->id }}, 'confirmada')" class="btn btn-success btn-sm" {{ $reserva->estado === 'confirmada' ? 'disabled' : '' }}>Confirmar</button>
                            <button wire:click="actualizarEstado({{ $reserva->id }}, 'pendiente')" class="btn btn-warning btn-sm" {{ $reserva->estado === 'pendiente' ? 'disabled' : '' }}>Pendiente</button>
                            <button wire:click="confirmarCancelacion({{ $reserva->id }})" class="btn btn-danger btn-sm" {{ $reserva->estado === 'cancelada' ? 'disabled' : '' }}>Cancelar</button>

                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5">No hay reservas registradas.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div wire:ignore.self class="modal fade" id="modalConfirmarCancelacion" tabindex="-1"
    aria-labelledby="modalConfirmarCancelacionLabel" aria-hidden="true"
    x-data
    x-init="@this.on('mostrarModal', () => new bootstrap.Modal($refs.modal).show())"
    x-ref="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmar Cancelación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro que deseas cancelar esta reserva? Esta acción no se puede deshacer.
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button wire:click="cancelarReservaConfirmada" class="btn btn-danger" data-bs-dismiss="modal">Sí, cancelar</button>
                </div>
            </div>
        </div>
    </div>

    {{ $reservas->links() }}
</div>
