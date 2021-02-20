@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row pt-5">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <img class="img-fluid pad" src="{{ asset($region->path) }}">
                </div>
            </div>
        </div>
        <div class="col-6">
            {!! Form::model($region, ['route' => ['region.update', $region->id], 'method' => 'PUT']) !!}

            {{ Form::label('name', 'Name:')}}
            {{ Form::text('name', null, array("class"=>'form-control')) }}

            {{ Form::label('description', 'Description:')}}
            {{ Form::textarea('description', null, array("class"=>'form-control mb-3')) }}

            @include('backend.partials._media')
            @include('backend.partials.metaTags')
            {{ Form::submit('Update', ['class'=> 'btn btn-success btn-block mt-3'])}}
            {!! Form::close() !!}
        </div>

    </div>
</div>
@endsection