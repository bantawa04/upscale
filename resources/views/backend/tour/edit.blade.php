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
                    <h3 class="card-title">Edit {{$tour->name}}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    {!! Form::model($tour, ['route' => ['tour.update', $tour->id], 'method' => 'PUT','data-parsley-validate'=>'']) !!}

                    <div class="row">
                        <div class="col-9">
                            {!! Form::text('name', null, array('class' => 'form-control' , 'placeholder' => 'Name')) !!}

                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-3">
                            {{ Form::text('days', null, array("class"=>'form-control' , 'placeholder' => 'Days')) }}
                            @error('days')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mt-3">

                        <div class="col-2">
                            {{ Form::text('price', null, array("class"=>'form-control', 'placeholder' => 'Price')) }}
                            @error('price')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-2">
                            {{ Form::text('discountPrice', null, array("class"=>'form-control', 'placeholder' => 'Discount Price')) }}
                            @error('discountPrice')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>                        

                        <div class="col-4">
                            {{ Form::number('max_altitude', null, array("class"=>'form-control', 'placeholder' => 'Max altitude')) }}
                            @error('max_altitude')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-4">
                            {{ Form::select('group_id', $groups , null, ['placeholder' => 'Group Size', 'class' => 'form-control']) }}
                            @error('group_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-4">
                            {{ Form::select('difficulty_id', $difficulties , null, ['placeholder' => 'Difficulty Level', 'class' => 'form-control']) }}
                            @error('difficulty_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-4">
                            {{ Form::select('accomodation_id', $accomodations , null, ['placeholder' => 'Accomodation', 'class' => 'form-control'])}}
                            @error('accomodation_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-4">
                            {{ Form::select('meal_id', $meals , null, ['placeholder' => 'Meal Plan', 'class' => 'form-control']) }}
                            @error('meal_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-4">
                            {{ Form::select('country_id', $countries , null, ['placeholder' => 'Country', 'class' => 'form-control']) }}
                            @error('country_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-4">
                            {{ Form::select('category_id', $categories , null, ['placeholder' => 'Category', 'class' => 'form-control'])}}
                            @error('category_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-4">
                            {{ Form::select('region_id', $regions , null, ['placeholder' => 'Region', 'class' => 'form-control']) }}
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-6">
                            {{ Form::select('includes[]', $includes , null, ['class' => 'form-control', 'multiple' => 'multiple' ,'id' => 'includes']) }}
                        </div>
                        <div class="col-6">
                            {{ Form::select('excludes[]', $excludes , null, ['class' => 'form-control' , 'multiple' => 'multiple' ,'id' => 'excludes'])}}
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-6">
                            {{ Form::select('start', $locations , null, ['placeholder' => 'Start', 'class' => 'form-control']) }}
                        </div>
                        <div class="col-6">
                            {{ Form::select('end', $locations , null, ['placeholder' => 'End', 'class' => 'form-control']) }}
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-6">
                            @include('backend.partials._media')
                            @error('featured')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-6">
                            @include('backend.partials._media-multiple')
                            @error('slides')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12">
                            {{ Form::textarea('overview', null, array("id"=>'tinymce')) }}
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col">
                            {{ Form::textarea('note', null, array("class"=>'form-control', 'id' => 'note', 'placeholder' => 'Important note',  'style' => 'resize:none')) }}
                            @error('note')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
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
<script src="https://cdn.tiny.cloud/1/8t3cusqbsgxjxtrx0cesy6fo1sdkesg3rsg41aky7y8m430h/tinymce/5/tinymce.min.js"></script>
<script>
    $('#includes,#excludes').multiselect({
        includeSelectAllOption: true,
        selectAllJustVisible: false,
        enableFiltering: true,
        numberDisplayed: 1,
        maxHeight: 600,
        buttonWidth: '100%'
    });
    tinymce.init({
  selector: 'textarea#note',
  height: 300,
  menubar: false,
  plugins: [
    'lists',
  ],
  toolbar: 
  'bullist numlist outdent indent | bold italic underline strikethrough' +
  'help',
});
tinymce.init({
  selector: 'textarea#tinymce',
  plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
  imagetools_cors_hosts: ['picsum.photos'],
  menubar: 'file edit view insert format tools table help',
  toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
  toolbar_sticky: true,
  autosave_ask_before_unload: true,
  autosave_interval: "30s",
  autosave_prefix: "{path}{query}-{id}-",
  autosave_restore_when_empty: false,
  autosave_retention: "2m",
  image_advtab: true,
  importcss_append: true,
  height: 600,
  image_caption: true,
  quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
  noneditable_noneditable_class: "mceNonEditable",
  toolbar_drawer: 'sliding',
  contextmenu: "link image imagetools table",
 });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
@section('styles')
<link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
    <link rel="stylesheet" href="{{ asset('css/parsley.css') }}">
@endsection