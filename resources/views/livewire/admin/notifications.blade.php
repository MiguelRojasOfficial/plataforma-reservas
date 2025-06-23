<div>
    <h3>Notificaciones</h3>

    <ul class="list-group">
        @foreach($notificaciones as $notificacion)
        <li class="list-group-item {{ $notificacion->leido ? 'list-group-item-secondary' : 'list-group-item-info' }}">
            <strong>{{ $notificacion->titulo }}</strong><br>
            {{ $notificacion->mensaje }}<br>
            <small>{{ $notificacion->created_at->diffForHumans() }}</small>

            @if(!$notificacion->leido)
            <button wire:click="marcarLeido({{ $notificacion->id }})" class="btn btn-sm btn-primary float-end">Marcar como leído</button>
            @endif
        </li>
        @endforeach
    </ul>
</div>
