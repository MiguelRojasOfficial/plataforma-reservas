<div class="container mt-4">
    <h2>Mis Reservas</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reservas as $reserva)
            <tr>
                <td>{{ $reserva->fecha }}</td>
                <td>{{ $reserva->hora }}</td>
                <td>{{ $reserva->estado }}</td>
                <td>
                    @if($reserva->estado !== 'cancelada')
                        <button class="btn btn-success btn-sm" wire:click="cancelar({{ $reserva->id }})">Cancelar</button>
                        <button class="btn btn-primary btn-sm ms-2" wire:click="abrirModalReprogramar({{ $reserva->id }})">Reprogramar</button>

                    @else
                        <span class="text-muted">Cancelada</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4">No tienes reservas registradas.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Modal -->
<div class="modal fade @if($modalReprogramarAbierto) show d-block @endif" tabindex="-1" role="dialog" style="@if($modalReprogramarAbierto) display: block; background-color: rgba(0,0,0,0.5); @else display: none; @endif">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form wire:submit.prevent="reprogramarReserva">
        <div class="modal-header">
          <h5 class="modal-title">Reprogramar Reserva</h5>
          <button type="button" class="btn-close" wire:click="$set('modalReprogramarAbierto', false)"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label>Fecha nueva</label>
            <input type="date" class="form-control" wire:model="nueva_fecha">
            @error('nueva_fecha') <small class="text-danger">{{ $message }}</small> @enderror
          </div>
          <div class="mb-3">
            <label>Hora nueva</label>
            <input type="time" class="form-control" wire:model="nueva_hora">
            @error('nueva_hora') <small class="text-danger">{{ $message }}</small> @enderror
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" wire:click="$set('modalReprogramarAbierto', false)">Cerrar</button>
          <button type="submit" class="btn btn-danger">Guardar cambios</button>
        </div>
      </form>
    </div>
  </div>
</div>
    {{ $reservas->links() }}
</div>