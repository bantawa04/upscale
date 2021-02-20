@component('mail::message')
@component('mail::panel')
Senders info: {!! $data['user_info'] !!}
Subject: {{$data['subject']}}<br>
@endcomponent
@component('mail::panel')
Lead traveller name: {{$data['name'] }} <br>
Email    : <a href="mailto:{{$data['email'] }}">{{$data['email'] }}</a> <br>
Phone    : {{$data['phone']}} <br>
No. of travellers: {{$data['travellersNo'] }} <br>
Country: {{$data['country'] }} <br>
Contact: {{$data['phone'] }} <br>
Address: {{$data['detailedAddress'] }} <br>
@endcomponent

@if(!empty($data['messageBody']))
Message	 :
@component('mail::panel')
{{$data['messageBody'] }}
@endcomponent
@endif

Good Day,<br>
{{ config('app.name') }}
@endcomponent