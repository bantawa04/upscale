@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row pt-5">
        <div class="col-md-4">
            <img src="{{ asset($team->image) }}" class="img-fluid" alt="" srcset="">
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h4>{{$team->name}}</h4>
                    <h5>{{$team->position}}</h5>
                    <p>{!!$team->description!!}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection