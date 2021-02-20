@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row pt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    {!! Form::model($faq, ['route' => ['faq.update', $faq->id], 'method' => 'PUT']) !!}

                    <div class="col-12">
                        {{ Form::select('tour_id', $tours , null, ['placeholder' => 'Trip name', 'class' => 'form-control']) }}
                    </div>

                    <div class="col-12">
                        {{ Form::label('question', 'Question:')}}
                        {{ Form::text('question', null, array("class"=>'form-control')) }}
                    </div>

                    <div class="col-12">
                        {{ Form::label('answer', 'Answer:')}}
                        {{ Form::textarea('answer', null, array("class"=>'form-control')) }}
                    </div>

                    <div class="col-12">
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
<script>
</script>
@endsection