<h2>Nueva Reserva Registrada</h2>
<p>Un usuario ha hecho una reserva:</p>
<ul>
    <li><strong>Usuario:</strong> {{ $reserva->user->name }}</li>
    <li><strong>Fecha:</strong> {{ $reserva->fecha }}</li>
    <li><strong>Hora:</strong> {{ $reserva->hora_inicio }} - {{ $reserva->hora_fin }}</li>
</ul>
