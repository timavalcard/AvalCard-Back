@component('mail::message')
 کد تایید

@component('mail::panel')
کد تایید شما:
 {{ $code }}
@endcomponent

با تشکر,<br>
{{ config('app.name') }}
@endcomponent
