<ul>
@foreach ($countries as $country)
    
        <li>{{$country->tours->meal->name}}</li>
    
@endforeach
</ul>