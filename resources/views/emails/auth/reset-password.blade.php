@component('mail::message')
# Restablecer contraseña

Has solicitado restablecer tu contraseña.
Haz clic en el boton de abajo para restablecer tu contraseña:

@component('mail::button', ['url' =>$url])
Restablecer contraseña
@endcomponent

Si no solicitaste este cambio, puedes ignorar este correo.

Gracias,<br>
{{ config('app.name') }}
@endcomponet