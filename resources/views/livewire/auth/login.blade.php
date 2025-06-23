<div class="container d-flex align-items-center justify-content-center mt-5 py-3">
    <div class="card shadow p-5">
        <h4 class="text-center mb-1">Iniciar Sesión</h4>
        <form wire:submit.prevent="login">
            <div class="mb-3">
                <label class="form-label invisible">Correo Electronico</label>
                <input type="email" wire:model.defer="email" placeholder="Correo Electronico" class="form-control rounded-5">
                @error('email')<span class="text-danger">{{ $message }}</span>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label invisible">Contraseña</label>
                <input type="password" wire:model.defer="password" placeholder="Contraseña" class="form-control rounded-5">
                 @error('password')<small class="text-danger">{{ $message }}</small>@enderror
            </div>
            <div class="d-flex justify-content-center">
            
                <button type="submit" class="btn btn-danger rounded-5 mt-3">Iniciar Sesión</button>
            </div>
        </form>




        <div class="text-center mb-3 mt-5">
            <a href="{{ route('password.request') }}" class="text-decoration-none">¿Olvidaste tu contraseña?</a>
        </div>
        <div class="text-center mb-1 mt-2">
            <small>¿No tienes cuenta? <a href="{{ route('register') }}"> Regístrate aquí</a></small>
        </div>
    </div>
</div>