@extends('layouts.master')
@section('content')
<div class="container">
    {!! Form::model($category, ['route' => ['blog-category.update', $category->id], 'method' => 'PUT', 'class' =>'row
    pt-5']) !!}

    <div class="col-md-12">
        {{ Form::label('name', 'Name:')}}
        {{ Form::text('name', null, array("class"=>'form-control')) }}
    </div>
    @include('backend.partials.metaTags')
    <div class="col-md-12">
        {{ Form::submit('Update', ['class'=> 'btn btn-success btn-block mt-3'])}}
        {!! Form::close() !!}
    </div>

</div>
@endsection