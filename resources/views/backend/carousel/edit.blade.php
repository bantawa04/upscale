@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-6">
            <img class="img-fluid pad" src="{{ asset($carousel->path) }}">
        </div>
        <div class="col-6">
            {!! Form::model($carousel, ['route' => ['carousel.update', $carousel->id], 'method' => 'PUT']) !!}

            {{ Form::label('name', 'Name:')}}
            {{ Form::text('name', null, array("class"=>'form-control')) }}

            {{ Form::label('heading', 'Heading:')}}
            {{ Form::text('heading', null, array("class"=>'form-control')) }}

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