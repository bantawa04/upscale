@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row pt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add new page</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    {!! Form::open( ['route'=> 'page.store', 'method' =>'POST','data-parsley-validate'=>''] ) !!}

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
                        <div class="col-4" id="levelWrapper" >
                            <div class="form-group">
                                <label for="">Page Level</label>
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="isParent" value="0" checked onclick="selectPageLevel()">
                                  <label class="form-check-label">Parent</label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="isParent" value="1"  onclick="selectPageLevel()">
                                  <label class="form-check-label">Child</label>
                                </div>
                              </div>
                            @error('isParent')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-2" id="pageWrapper" style="display: none">
                            <div class="form-group">
                                <label>Parent Page</label>
                                <select name="parentPage" id="parentPage" class="form-control">
                                    <option></option>
                                    @foreach ($pages as $page)
                                        <option value="{{$page->id}}">{{$page->title}}</option>
                                    @endforeach
                                </select>
                                @error('parentPage')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-2">
                            <label>Menu position</label>
                            {!! Form::number('position', null, array('class' => 'form-control' , 'placeholder' =>
                            'Position')) !!}
                        </div>
                        <div class="col-2">            
                            <label>Status</label>                
                            <div class="form-check">                                
                                <input class="form-check-input" type="checkbox" checked value="1" name="status">
                                <label class="form-check-label">Publish</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <label>Banner</label>
                            @include('backend.partials._media')
                            @error('featured')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12">
                            <textarea id="tinymce" name="content"></textarea>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.min.js">
</script>
<!-- Theme included stylesheets -->
<script src="https://cdn.tiny.cloud/1/8t3cusqbsgxjxtrx0cesy6fo1sdkesg3rsg41aky7y8m430h/tinymce/5/tinymce.min.js"
    referrerpolicy="origin"></script>
<script>
    function selectPageLevel() {
        let ele = document.querySelector('input[name="isParent"]:checked'); 
        
        let levelWrapper = document.getElementById("levelWrapper");
        let pageWrapper = document.getElementById("pageWrapper");
        if (ele.value == 1) {//is child
            pageWrapper.style.display = "block";
            levelWrapper.classList.remove("col-4");
            document.getElementById("parentPage").required = true;
            levelWrapper.classList.toggle("col-2");
        } else {//is parent
            pageWrapper.style.display= "none";
            levelWrapper.classList.remove("col-2");            
            levelWrapper.classList.toggle("col-4");
            document.getElementById("parentPage").required = false;
            document.querySelector('select[name="parentPage"]').selectedIndex = 0;
        }
    }  

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
            file_picker_callback : function(callback, value, meta) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;
        
                var cmsURL = '/laravel-filemanager?editor=' + meta.fieldname;
                if (meta.filetype == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                    } else {
                    cmsURL = cmsURL + "&type=Files";
                }
        
                tinyMCE.activeEditor.windowManager.openUrl({
                    url : cmsURL,
                    title : 'Filemanager',
                    width : x * 0.8,
                    height : y * 0.8,
                    resizable : "yes",
                    close_previous : "no",
                    onMessage: (api, message) => {
                        callback(message.content);
                    }
                });
            }
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
@section('styles')
<link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
    <link rel="stylesheet" href="{{ asset('css/parsley.css') }}">
@endsection