<!DOCTYPE html>
<html>
	<head>
		<title>Confirmación Registro
	</head>
	<body>
		<h2>Hola, {{ $user->name }}</h2>
		<p>Gracias por registrarte en nuestra plataforma.</p>
		<p>Por favor, confirma tu cuenta haciendo clic en el siguiente enlace:</p>
		<a href="{{ $url }}">Confirmar Cuenta</a>
		<p>Si no realizaste este registro, puedes ignorar este mensaje.</p>
   	 	<br>
    	<p>Saludos,<br>El equipo de Reservas</p>
	</body>
</html>