<div class="col-12 mt-3">
    {{ Form::label('meta_title', 'Meta Title:')}}
    {{ Form::textarea('meta_title', null, array("class"=>'form-control', 'rows' => '3', 'style' =>'resize:none;')) }}
</div>
<div class="col-12 mt-3">
    {{ Form::label('meta_description', 'Meta Description:')}}
    {{ Form::textarea('meta_description', null, array("class"=>'form-control', 'rows'=>'5',  'style' =>'resize:none;')) }}
</div>