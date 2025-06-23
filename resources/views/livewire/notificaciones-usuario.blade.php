<div>
    <h4>Notificaciones</h4>
    @if($notificaciones->isEmpty())
        <p>No tienes notificaciones.</p>
    @else
        <ul class="list-group">
            @foreach($notificaciones as $notificacion)
                <li class="list-group-item d-flex justify-content-between align-items-center {{ $notificacion->leida ? 'list-group-item-secondary' : '' }}">
                    <div>
                        <strong>{{ $notificacion->tipo }}</strong> <br>
                        <small>{{ $notificacion->mensaje }}</small><br>
                        <small class="text-muted">{{ $notificacion->created_at->format('d/m/Y H:i') }}</small>
                    </div>
                    @if(!$notificacion->leida)
                        <button wire:click="marcarComoLeida({{ $notificacion->id }})" class="btn btn-sm btn-primary">Marcar como leído</button>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif
</div>
