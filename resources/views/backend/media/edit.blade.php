@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row pt-5">
        <div class="col-6">
            <img class="img-fluid pad" src="{{ asset($media->path) }}">
        </div>
        <div class="col-6">
            {!! Form::model($media, ['route' => ['media.update', $media->id], 'method' => 'PUT']) !!}

            {{ Form::label('name', 'Name:')}}
            {{ Form::text('name', null, array("class"=>'form-control')) }}

            {{ Form::submit('Update', ['class'=> 'btn btn-success btn-block mt-3'])}}
            {!! Form::close() !!}
        </div>

    </div>
</div>
@endsection
@section('scripts')
<script>
</script>
@endsection