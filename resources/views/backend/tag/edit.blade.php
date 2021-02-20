@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row pt-5">
        <div class="col-12">
            {!! Form::model($tag, ['route' => ['tag.update', $tag->id], 'method' => 'PUT']) !!}

            {{ Form::label('name', 'Name:')}}
            {{ Form::text('name', null, array("class"=>'form-control')) }}

            {{ Form::submit('Update', ['class'=> 'btn btn-success btn-block mt-3'])}}
            {!! Form::close() !!}
        </div>

    </div>
</div>
@endsection