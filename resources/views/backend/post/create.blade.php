@extends('layouts.master')
@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="container">
    <div class="row pt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add new post</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    {!! Form::open( ['route'=> 'post.store', 'method' =>'POST'] ) !!}

                    <div class="row">
                        <div class="col-12">
                            {!! Form::text('title', null, array('class' => 'form-control' , 'placeholder' => 'Title'))
                            !!}

                            @error('title')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-6">
                            {{ Form::select('category_id', $categories , null, ['placeholder' => 'Category', 'class' => 'form-control']) }}
                            @error('category_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-6">
                            {{ Form::select('tags', $tags , null, ['placeholder' => 'Tags', 'class' => 'form-control select2'])}}
                            @error('tags')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-6">
                            @include('backend.partials._media')
                            @error('featured')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-6 d-flex justify-content-around">
                            <span>
                                {{Form::radio('status', '1')}} Publish
                            </span>
                            <span>
                                {{Form::radio('status', '0')}} Unpublish
                            </span>
                            @error('status')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12">
                            <textarea id="my-editor" name="content" class="form-control">{!! old('content') !!}</textarea>
                        </div>
                    </div>

                    <h3>SEO Entities</h3>
                    <div class="row mt-3">
                        <div class="col">
                            {{ Form::text('title', null, array("class"=>'form-control', 'placeholder' => 'Title')) }}
                            @error('title')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>                    

                    <div class="row mt-3">
                        <div class="col">
                            {{ Form::text('meta_title', null, array("class"=>'form-control', 'placeholder' => 'Meta Title')) }}
                            @error('meta_title')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col">
                            {{ Form::textarea('meta_description', null, array("class"=>'form-control', 'placeholder' => 'Meta Description',  'style' => 'resize:none')) }}
                            @error('meta_description')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        {{ Form::submit('Create', ['class'=> 'btn btn-success btn-block mt-3'])}}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script src="{{ asset('js/editor.js') }}"></script>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection