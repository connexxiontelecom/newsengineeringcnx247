@component('mail::message')
{{$conversation->subject}}

{!! $conversation->content !!}



Regards,<br>
{{ config('app.name') }} Team
@endcomponent
