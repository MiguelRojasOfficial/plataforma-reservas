<div class="container d-flex align-items-center justify-content-center mt-5 py-5">
        <div class="card shadow p-5">
            <h2 class="text-center mb-1">Recuperar contraseña</h2>

            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <form wire:submit.prevent="submit" class="mt-3">
                <div class="mb-3">
                    <label for="email" class="form-label invisible">Correo electrónico</label>
                    <input type="email" id="email" class="form-control rounded-5" wire:model.defer="email" placeholder="Correo Electronico">
                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="d-flex justify-content-center mb-3">
                    <button type="submit" class="btn btn-danger rounded-5 mt-3">Enviar enlace</button>
                </div>
            </form>
        </div>
</div>