@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row pt-5">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <img class="img-fluid pad" src="{{ asset($country->thumb) }}">
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
                <div class="form-group">
                    <label for="map">Map(png/PNG):</label>
                    <input type="file" class="form-control-file" id="map" name="map">
                  </div>
            </div>

            {{ Form::submit('Update', ['class'=> 'btn btn-success btn-block mt-3'])}}
            {!! Form::close() !!}
        </div>

    </div>
</div>
@endsection