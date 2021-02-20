@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row pt-5">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <img class="img-fluid pad" src="{{ asset($country->path) }}">
                    <img class="img-fluid pad" src="{{ asset($country->map) }}">
                </div>
            </div>
        </div>
        <div class="col-6">
            {!! Form::model($country, ['route' => ['country.update', $country->id], 'method' => 'PUT', 'files' => true]) !!}

            {{ Form::label('name', 'Name:')}}
            {{ Form::text('name', null, array("class"=>'form-control')) }}

            {{ Form::label('description', 'Description:')}}
            {{ Form::textarea('description', null, array("class"=>'form-control mb-3')) }}

            @include('backend.partials._media')
            @include('backend.partials.metaTags')

            <div class="input-group mt-2">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="exampleInputFile" name="map">
                    <label class="custom-file-label" for="exampleInputFile">Choose file for map</label>
                </div>
                <div class="input-group-append">
                    <span class="input-group-text" id="">Upload</span>
                </div>
            </div>

            {{ Form::submit('Update', ['class'=> 'btn btn-success btn-block mt-3'])}}
            {!! Form::close() !!}
        </div>

    </div>
</div>
@endsection