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
                    <h3 class="card-title">Edit {{$team->name}}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    {!! Form::model($team, ['route' => ['team.update', $team->id], 'method' => 'PUT', 'files'=> true]) !!}

                    <div class="row">
                        <div class="col-6">
                            {!! Form::text('name', null, array('class' => 'form-control' , 'placeholder' => 'Name'))
                            !!}

                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-6">
                            {{ Form::select('type_id', $types , null, ['placeholder' => 'Type', 'class' => 'form-control']) }}
                            @error('type_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-6">
                            {!! Form::text('position', null, array('class' => 'form-control' , 'placeholder' =>
                            'Position')) !!}
                        </div>
                        <div class="col-6">
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="exampleInputFile" name="image">
                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="">Upload</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12">
                            <textarea name="description" id="summernote" cols="30"
                                rows="10">{!!$team->description!!}</textarea>
                        </div>
                    </div>

                    <div class="row">
                        {{ Form::submit('Update', ['class'=> 'btn btn-success btn-block mt-3'])}}
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.min.js">
</script>
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- Theme included stylesheets -->

<script>
    $('#summernote').summernote({
        placeholder: 'Overview',
        tabsize: 2,
        height: 400,
        focus: true ,
        toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear','strikethrough', 'superscript', 'subscript']],
        ['color', ['color']],
        ['fontsize', ['fontsize']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['insert', ['link', 'picture', 'video']],
        ['view', ['fullscreen', 'codeview', 'help']],
        ]
      });
</script>
@endsection
@section('styles')
<link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
<link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css') }}">
@endsection