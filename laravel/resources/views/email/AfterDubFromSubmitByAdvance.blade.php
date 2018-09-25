@component('mail::message')
# Hello,

Some info here
<br>
<br>
<br>

<b>Privacy: </b> {{$two->privacy}}<br>
<hr>
<b>Type: </b> {{$two->type}}<br>
<hr>
<b>Number: </b> {{$two->number}}<br>
<hr>
<b>Point earned by you: </b> {{$two->point}}<br>



Thanks,<br>
{{ config('app.name') }}
@endcomponent