@component('mail::message')
@component('mail::panel')
Senders info: {!! $data['user_info'] !!}
@endcomponent
#We have new email from contact form
Full name: {{$data['name']}}<br>
Email    : <a href="mailto:{{$data['email'] }}">{{$data['email'] }}</a> <br>
Subject: {{$data['subject']}}<br>
Message	 :
@component('mail::panel')
{{$data['messageBody'] }}
@endcomponent
Good Day,<br>
{{ config('app.name') }}
@endcomponent