@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row pt-5">
        <div class="card card-default col-12">
            <!-- /.card-header -->
            <div class="card-body ">
                <form method="POST" action="{{route('media.store')}}" class="dropzone" id="addPhotosForm">
                    {{ csrf_field() }}
                    <div class="dz-message">
                        <h4>Drop files here or click to upload.</h4>
                    </div>
                </form>
                <a href="{{ route('media.index') }}" class="btn btn-block btn-primary">Save</a>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>
@endsection
@section('styles')
<link type="text/css" rel="stylesheet" href="{{ asset('css/dropzone.css') }}" />
@stop
@section('scripts')
<script src="{{ asset('js/dropzone.js') }}"></script>
<script type="text/javascript">
    Dropzone.options.addPhotosForm = {
        paramName: 'photo',
        maxFileSize: 20,
        acceptedFiles: '.jpg, .jpeg',
        dictDefaultMessage: "Drop images here to upload",
    };
</script>
@stop