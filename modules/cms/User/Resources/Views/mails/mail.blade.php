@component('mail::message')

@component('mail::panel')
 {{ $content }}
@endcomponent

با تشکر,<br>
{{ config('app.name') }}
@endcomponent
