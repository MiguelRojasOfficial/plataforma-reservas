<div class="container d-flex align-items-center justify-content-center mt-5 py-5">
    <div class="card shadow p-5">
        <h2 class="text-center mb-1">Restablecer contraseña</h2>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form wire:submit.prevent="submit" class="mt-3">
            <div class="mb-3">
                <label for="email" class="form-label invisible">Correo electrónico</label>
                <input type="email" id="email" class="form-control rounded-5" wire:model.defer="email" placeholder="Correo electrónico">
                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label invisible">Nueva contraseña</label>
                <input type="password" id="password" class="form-control rounded-5" wire:model.defer="password" placeholder="Nueva contraseña">
                @error('password') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label invisible">Confirmar contraseña</label>
                <input type="password" id="password_confirmation" class="form-control rounded-5" wire:model.defer="password_confirmation" placeholder="Confirmar contraseña">
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-danger rounded-5 mt-3">Restablecer contraseña</button>
            </div>
        </form>
    </div>
</div>