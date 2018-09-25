@component('mail::message')
# Hello,

Thanks for registering in our Laravel App. You can login any time using your gmail account. To update and see information please visit: {{url('/')}}
<br>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
