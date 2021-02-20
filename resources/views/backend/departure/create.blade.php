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
                    <h3 class="card-title">Add new tour</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    {!! Form::open( ['route'=> 'departure.store', 'method' =>'POST'] ) !!}

                    <div class="row">
                        <div class="col-8">
                            <select name="tour_id[]" id="tour_id" multiple>
                                @foreach ($tours as $item)
                                <option value="{{$item->id}}"">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class=" col-4">
                                {{ Form::number('gap', null, array("class"=>'form-control' ,'placeholder'=> 'Gap Day')) }}
                        </div>
                    </div>

                    <div class="row pt-3">
                        <div class="col-6">
                            {{ Form::text('start', null, array("class"=>'form-control' , 'id' => 'start', 'placeholder'=> 'Start Date')) }}
                        </div>
                        <div class="col-6">
                            {{ Form::text('end', null, array("class"=>'form-control' , 'id' => 'start', 'placeholder'=> 'End Date')) }}
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
@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/css/datepicker.min.css">

<link rel="stylesheet" type="text/css"
href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/js/datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/js/i18n/datepicker.en.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.min.js">
</script>
<script>
    $('#start,#end').datepicker({
    language: 'en',
    dateFormat:"yyyy/mm/dd",
    minDate: new Date()
});
$('#tour_id').multiselect({
        includeSelectAllOption: true,
        selectAllJustVisible: false,
        enableFiltering: true,
        numberDisplayed: 1,
        maxHeight: 600,
        buttonWidth: '100%'
    });
</script>
@stop