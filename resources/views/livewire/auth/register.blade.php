<div class="container d-flex align-items-center justify-content-center mt-5 ">
    <div class="card shadow p-5">
        <h4 class="text-center mb-1">Registrese</h4>

        <form wire:submit.prevent="register">
            <div class="mb-3">
                <label class="invisible">Nombre</label>
                <input type="text" wire:model="name" class="form-control rounded-5" placeholder="Nombre">
            </div>
            <div class="mb-3">
                <label class="invisible">Correo electrónico</label>
                <input type="email" wire:model="email" class="form-control rounded-5" placeholder="Correo Electronico">
            </div>
            <div class="mb-3">
                <label class="invisible">Contraseña</label>
                <input type="password" wire:model="password" class="form-control rounded-5" placeholder="Contraseña">
            </div>
            <div class="mb-3">
                <label class="invisible">Confirmar Contraseña</label>
                <input type="password" wire:model="password_confirmation" class="form-control rounded-5" placeholder="Confirmar Contraseña">
            </div>


            <div class="d-flex justify-content-center py-3">
                <button type="submit" class="btn btn-danger rounded-5">Registrarse</button>
            </div>
        </form>
    </div>
</div>