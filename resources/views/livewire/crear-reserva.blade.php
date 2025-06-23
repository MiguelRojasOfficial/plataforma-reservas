<div>
    <h4 class="text-center mb-3">Crear reserva para: {{ $tituloFuncion }}</h4>
    <div class="container d-flex justify-content-center mt-5 mb-5">
        <div class="card shadow p-4" style="max-width: 400px; width: 100%;">
            

            @if(session()->has('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <form wire:submit.prevent="guardarReserva">
                <div class="mb-3">
                    <label class="form-label">Fecha</label>
                    <div x-data x-init="
                        flatpickr($refs.fp, {
                            disable: {{ Js::from($fechasSaturadas) }},
                            dateFormat: 'Y-m-d',
                            onChange: function(selectedDates, dateStr) {
                                $wire.call('actualizarFecha', dateStr);
                            }
                        });
                    ">
                        <input 
                            type="text" 
                            x-ref="fp"
                            class="form-control"
                            placeholder="Selecciona una fecha">
                    </div>
                    <small class="text-muted">Fecha seleccionada: {{ $fechaSeleccionada }}</small>
                    @error('fechaSeleccionada') 
                        <small class="text-danger">{{ $message }}</small> 
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Hora</label>
                    <select wire:model="horaSeleccionada" class="form-select">
                        <option value="">Selecciona una hora</option>
                        @foreach($horasDisponibles as $hora)
                            <option value="{{ $hora }}">{{ $hora }}</option>
                        @endforeach
                    </select>
                    @error('horaSeleccionada') 
                        <small class="text-danger">{{ $message }}</small> 
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Detalle</label>
                    <textarea wire:model="detalle" class="form-control" rows="3" placeholder="Opcional"></textarea>
                    @error('detalle') 
                        <small class="text-danger">{{ $message }}</small> 
                    @enderror
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-danger" wire:loading.attr="disabled" wire:target="guardarReserva">
                        Reservar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>