@component('mail::message')
# Hello,

Some info here
<br>
<br>
<br>

<b>Email: </b> {{$anonymous->email}}<br>
<hr>
<b>Ethereum address: </b> {{$anonymous->ethereum_address}}<br>
<hr>
<b>Privacy: </b> {{$anonymous->privacy}}<br>
<hr>
<b>Type: </b> {{$anonymous->type}}<br>
<hr>
<b>Number: </b> {{$anonymous->number}}<br>
<hr>
<b>Point earned by you: </b> {{$anonymous->point}}<br>



Thanks,<br>
{{ config('app.name') }}
@endcomponent
