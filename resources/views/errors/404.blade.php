@extends('layouts.app')
@section('content')
<div class="navbar-gap"></div>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2 text-center">
            <img src="{{ asset('images/404.svg') }}" alt="404 Error" class="img-fluid" >
            <h1 class="mt-3">Page Not Found</h1>
            <h5 class="mt-3"><a href="{{url('/')}}">Homepage</a></h5>
            <h6 class="mt-3"><a href="{{ url('/site-map')}}">Sitemap</a></h6>
        </div>
    </div>
</div>
@stop
@push('styles')
<style>
    h5 > a,h6 > a {
        color: #212529;
        transition: 0.5s;
    }
    h5 > a:hover,h6 > a:hover{
        text-decoration:none;
    } 
</style>
@endpush