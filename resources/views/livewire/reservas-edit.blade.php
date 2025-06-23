<div class="container mt-4">
    <h2 class="mb-4">Editar Reserva</h2>
    <form wire:submit.prevent="update">
        <div class="mb-3">
            <label for="usuario_id" class="form-label">Usuario</label>
            <select wire:model="usuario_id" id="usuario_id" class="form-control">
                <option value="">Seleccione</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
            @error('usuario_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="sede_id" class="form-label">Sede</label>
            <select wire:model="sede_id" id="sede_id" class="form-control">
                <option value="">Seleccione</option>
                @foreach($sedes as $sede)
                    <option value="{{ $sede->id }}">{{ $sede->nombre }}</option>
                @endforeach
            </select>
            @error('sede_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" wire:model="fecha" id="fecha" class="form-control">
            @error('fecha') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="hora" class="form-label">Hora</label>
            <input type="time" wire:model="hora" id="hora" class="form-control">
            @error('hora') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button class="btn btn-primary" type="submit">Actualizar</button>
        <a href="{{ route('reservas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>