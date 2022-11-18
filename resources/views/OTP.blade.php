@component('mail::message')
# UiTM OTP vote.

Your OTP is {{$OTP}}. Don't share this code with others.

@component('mail::button', ['url' => ''])
Open
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
