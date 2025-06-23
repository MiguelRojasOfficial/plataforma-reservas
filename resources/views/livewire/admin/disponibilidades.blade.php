<div class="container mt-4">
    <h2 class="mb-4">Administrar Disponibilidad</h2>

    <form wire:submit.prevent="save" class="mb-4">
        <div class="row g-3 align-items-center">
            <div class="col-md-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" id="fecha" wire:model="fecha" class="form-control">
                @error('fecha') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-3">
                <label for="hora_inicio" class="form-label">Hora Inicio</label>
                <input type="time" id="hora_inicio" wire:model="hora_inicio" class="form-control">
                @error('hora_inicio') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-3">
                <label for="hora_fin" class="form-label">Hora Fin</label>
                <input type="time" id="hora_fin" wire:model="hora_fin" class="form-control">
                @error('hora_fin') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary">
                    @if($editId) Guardar Cambios @else Agregar Disponibilidad @endif
                </button>
                @if($editId)
                    <button type="button" wire:click="$set('editId', null)" class="btn btn-secondary ms-2">Cancelar</button>
                @endif
            </div>
        </div>
    </form>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Hora Inicio</th>
                <th>Hora Fin</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($disponibilidades as $disp)
            <tr>
                <td>{{ $disp->fecha }}</td>
                <td>{{ $disp->hora_inicio }}</td>
                <td>{{ $disp->hora_fin }}</td>
                <td>
                    <button wire:click="edit({{ $disp->id }})" class="btn btn-sm btn-warning">Editar</button>
                    <button wire:click="delete({{ $disp->id }})" class="btn btn-sm btn-danger" onclick="confirm('¿Seguro que quieres eliminar esta disponibilidad?') || event.stopImmediatePropagation()">Eliminar</button>
                </td>
            </tr>
            @endforeach
            @if($disponibilidades->isEmpty())
            <tr>
                <td colspan="4" class="text-center">No hay disponibilidades registradas.</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>