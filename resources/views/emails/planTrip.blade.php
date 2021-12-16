@component('mail::message')

    @component('mail::panel')
    # Origination

    Senders info: {!! $data['user_info'] !!}
    Subject: {{$data['subject']}}
    
    @endcomponent  
    @component('mail::panel')
    # Basic Information
    Name: {{$data['name'] }} 
    Email    : {{$data['email'] }}
    Phone    : {{$data['phone']}}
    Country: {{$data['country'] }}

    # Travel Type

    Travel Type: {{$data['travelType'] }}

    @if ($data['adult'])
    Adult: {{$data['adult'] }}    
    @endif

    @if ($data['children'])
    Children: {{$data['children'] }}    
    @endif    

    # Travel Date

    Travel Date: {{$data['travelDate'] }}

    @if($data['startDate'] && $data['endDate'])
    Start Date: {{$data['startDate'] }}
    End Date: {{$data['endDate'] }}
    @endif

    # Travel Destination

    Do you have sought out trip destination ?

    {{$data['haveTrip'] }}

    @if ($data['tripName'])
    Where do you want to go ?

    {{$data['description'] }}

    @endif

    @if ($data['description'])
    Do you have any special request ?

    {{$data['description'] }}

    @endif

    @endcomponent

Good Day,<br>
{{ config('app.name') }}

@endcomponent