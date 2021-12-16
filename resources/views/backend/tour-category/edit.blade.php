@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row pt-5">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <img class="img-fluid pad" src="{{ asset($category->path) }}">
                </div>
            </div>
        </div>
        <div class="col-6">
            {!! Form::model($category, ['route' => ['tour-category.update', $category->id], 'method' => 'PUT']) !!}

            {{ Form::label('name', 'Name:')}}
            {{ Form::text('name', null, array("class"=>'form-control')) }}

            {{ Form::label('description', 'Description:')}}
            {{ Form::textarea('description', null, array("class"=>'form-control mb-3')) }}
            
            {{ Form::label('content', 'Content:')}}
            {{ Form::textarea('content', null, array("class"=>'form-control mb-3', 'id' => 'content')) }}
            
            @include('backend.partials._media')
            @include('backend.partials.metaTags')
            {{ Form::submit('Update', ['class'=> 'btn btn-success btn-block mt-3'])}}
            {!! Form::close() !!}
        </div>

    </div>
</div>
@endsection
@section('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#content' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
@endsection
@section('styles')
<style>
.ck-editor__editable_inline {
    min-height: 400px;
}
</style>
@stop