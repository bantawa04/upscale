@component('mail::message')
@component('mail::panel')
Senders info: {!! $data['user_info'] !!}
@endcomponent
{{$data['subject']}}
Full name: {{$data['name']}}<br>
Email    : <a href="mailto:{{$data['email'] }}">{{$data['email'] }}</a> <br>
Country: {{$data['country']}}<br>
Message	 :
@component('mail::panel')
{{$data['messageBody'] }}
@endcomponent
Good Day,<br>
{{ config('app.name') }}
@endcomponent