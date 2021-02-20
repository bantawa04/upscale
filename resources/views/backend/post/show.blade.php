@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row pt-5">
        <div class="col-7">
        </div>
        <a href="{{ route('post.edit',$post->id) }}" class="col-2 btn btn-primary">Edit</a>

        <div class="col-1">

        </div>
        <a href="{{ route('post.index') }}" class="col-2 btn btn-success">Save</a>
    </div>
</div>
<div class="row pt-3">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{$post->title}}</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <img class="card-img-top" src="{{ asset($post->path) }}" alt="Card image cap">
                    </div>
                    <div class="col-12 pt-2">
                        {!!$post->content!!}
                    </div>

                    <div class="col-12 pt-2">
                        @foreach ($post->tags as $tag)
                        <button type="button" class="btn btn-outline-primary btn-sm">{{$tag->name}}</button>
                        @endforeach
                    </div>

                    <div class="col-12 pt-2">
                        <dt>Meta title</dt>
                        {!!$post->meta_title!!}
                    </div>
                    <div class="col-12 pt-2">
                        <dt>Meta Description</dt>
                        {!!$post->meta_description!!}
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.0/lity.min.js"></script>
@endsection
@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.0/lity.min.css">
@endsection