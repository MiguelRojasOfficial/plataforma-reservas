<div class="container mt-1">
    <div class="row align-items-center mb-3">

        @if(Auth::user()->Rol === 'admin')
            <div class="alert alert-info mt-3">
                Acceso como administrador.
                <a href="{{ route('admin.reservas') }}" class="btn btn-sm btn-light mt-2">Ver reservas administrables</a>
            </div>
        @endif
        
        <div class="col-md-6">
            <h2>Bienvenido {{ Auth::user()->name }}</h2>
        </div>

        <div class="col-md-6 text-md-end">
            <div class="dropdown d-inline-block">
                <button class="btn btn-outline-primary dropdown-toggle" type="button" id="notificacionesDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    Notificaciones
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificacionesDropdown" style="max-height: 300px; overflow-y: auto;">
                    @forelse ($notificaciones as $notificacion)
                        <li class="dropdown-item">
                            {{ $notificacion->data['mensaje'] }}
                            <br><small class="text-muted">{{ $notificacion->created_at->diffForHumans() }}</small>
                        </li>
                    @empty
                        <li class="dropdown-item text-muted">No tienes notificaciones</li>
                    @endforelse
                </ul>
            </div>

            <form method="POST" action="{{ route('notificaciones.leer') }}" class="d-inline-block ms-2">
                @csrf
                <button class="btn btn-sm btn-outline-secondary py-2">Marcar como leídas</button>
            </form>
            <form action="{{ route('logout') }}" method="POST" class="d-inline-block mt-4 ms-2">
        @csrf
        <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
    </form>
        </div>
    </div>

    <div class="row">
        @foreach ([
            ['label' => 'Total', 'count' => $totalReservas, 'bg' => 'bg-secondary'],
            ['label' => 'Pendientes', 'count' => $pendientes, 'bg' => 'bg-warning'],
            ['label' => 'Confirmadas', 'count' => $confirmadas, 'bg' => 'bg-success'],
            ['label' => 'Canceladas', 'count' => $canceladas, 'bg' => 'bg-danger'],
        ] as $card)
        <div class="col-md-3">
            <div class="card {{ $card['bg'] }} text-white text-center">
                <div class="card-body">
                    <h5>{{ $card['label'] }}</h5>
                    <h2>{{ $card['count'] }}</h2>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @if($notificaciones->count())
        <div class="alert alert-warning mt-3">
            <h5><strong>⚠️ Cambios recientes en la disponibilidad</strong></h5>
            <ul class="mb-0">
                @foreach($notificaciones as $notificacion)
                    <li>
                        {{ $notificacion->data['mensaje'] }}
                        (<span class="text-muted">{{ $notificacion->created_at->diffForHumans() }}</span>)
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    @if($reservasPendientes->count())
        <h4 class="mt-4">Reservas Pendientes</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reservasPendientes as $reserva)
                    <tr>
                        <td>{{ $reserva->user->name }}</td>
                        <td>{{ $reserva->fecha }}</td>
                        <td>{{ $reserva->hora }}</td>
                        <td>
                            <button wire:click="confirmar({{ $reserva->id }})" class="btn btn-success btn-sm me-2">Confirmar</button>
                            <button wire:click="cancelar({{ $reserva->id }})" class="btn btn-danger btn-sm">Cancelar</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>