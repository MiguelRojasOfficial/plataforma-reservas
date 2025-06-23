<h2>Reserva Confirmada</h2>
<p>Hola {{ $reserva->user->name }},</p>
<p>Tu reserva ha sido confirmada con éxito.</p>
<ul>
	<li><storng>Fecha:</storng> {{ $reserva->fecha }}</li>
	<li><strong>Hora:</strong> {{ $reserva->hora_inicio }} - {{ $reserva->hora_fin }}</li>
</ul>
<p>Gracias por utilizar nuestro sistema.</p>