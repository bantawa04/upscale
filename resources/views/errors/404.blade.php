@extends('layouts.app')
@section('content')
<div class="navbar-gap"></div>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2 text-center">
            <img src="{{ asset('images/404.svg') }}" alt="404 Error" class="img-fluid" >
            <h1 class="mt-3">Page Not Found</h1>
        </div>
    </div>
</div>
@stop