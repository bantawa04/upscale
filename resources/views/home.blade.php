@extends('layouts.master')

@section('content')
<div class="container pt-5 backend-dashboard">
    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <i class="fas m-4 m-4 fa-shoe-prints"></i>
                    <h5 class="mt-5"><a href="{{ route('tour.index') }}">{{$tours}} Tours</a></h5>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <i class="fas m-4 fa-globe-asia"></i>
                    <h5 class="mt-5"><a href="{{ route('country.index') }}">{{$countries}} Countries</a></h5>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <i class="fas m-4 fa-code-branch"></i>
                    <h5 class="mt-5"><a href="{{ route('tour-category.index') }}">{{$tcategories}} Travel Styles</a></h5>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <i class="far m-4 fa-dot-circle"></i>
                    <h5 class="mt-5"><a href="{{ route('region.index') }}"> {{$regions}} Destinations</a></h5>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <i class="far m-4 fa-newspaper"></i>
                    <h5 class="mt-5"><a href="{{ route('page.index') }}">{{$pages}} Pages</a></h5>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <i class="far m-4 fa-newspaper"></i>
                    <h5 class="mt-5"><a href="{{ route('post.index') }}">{{$posts}} Posts</a></h5>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <i class="fas m-4 fa-list"></i>
                    <h5 class="mt-5"><a href="{{ route('blog-category.index') }}">{{$bcategories}} Post Categories</a></h5>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <i class="fas m-4 fa-project-diagram"></i>
                    <h5 class="mt-5"><a href="{{ route('tag.index') }}">{{$tags}} Tags</a></h5>
                </div>
            </div>
        </div>
    </div>    
</div>
@endsection