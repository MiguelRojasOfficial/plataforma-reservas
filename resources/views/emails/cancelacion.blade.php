<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<h2>Reserva cancelada</h2>
    <p>Hola {{ $reserva->user->name }},</p>
    <p>Tu reserva del día {{ $reserva->fecha }} a las {{ $reserva->hora }} ha sido cancelada.</p>
</body>
</html>