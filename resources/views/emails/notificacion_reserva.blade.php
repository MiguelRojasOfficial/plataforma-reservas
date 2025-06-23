<!DOCTYPE html>
<html>
    <head>
        <title>Notificación de Reserva</title>
    </head>
    <body>
        <h2>Hola, {{ $user->name }}</h2>
        <p>Su reserva ha sido {{ $estado }}</p>
        <ul>
            <li>Fecha: {{ $reserva->fecha }}</li>
            <li>Fecha: {{ $reserva->hora }}</li>
            <li>Fecha: {{ $reserva->evento }}</li>
        </ul>
        <p>Gracias por usar nuestra plataforma.</p>
        <br>
        <p>Saludos,<br>El equipo de Reservas</p>
    </body>
</html>