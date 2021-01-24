@component('mail::message')
# Hola {{ $wishlist->course->teacher->name }}
<br>
EL alumno <b>{{ $wishlist->user->name }}</b> ha añadido tu curso <b>{{ $wishlist->course->title }}</b>  a su lista de deseos.
<br><br>
¡Felicidades!
<br>
@component('mail::button', ['url' => env('APP_URL')])
Volver a la plataforma
@endcomponent

Atentamente,<br>

{{ config('app.name') }}
@endcomponent
