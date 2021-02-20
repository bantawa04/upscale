@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row pt-5">
        <div class="col-7">
            <div id="accordion">
                @foreach ($faqs as $item)
                <div class="card card-primary card-outline item{{$item->id}} collapsed-card">
                        <div class="card-header">
                            <h3 class="card-title">{{$item->question}}</h3>
        
                            <div class="card-tools">
                                <a href="{{ route('faq.edit', [$item->id, $item->id]) }}" class="btn btn-tool" ><i
                                        class="far fa-edit"></i></a>
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                                        class="fas fa-expand"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool delete"  data-id="{{$item->id}}">
                                    <i class="fas fa-times"></i></button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            {!!$item->answer!!}
                        </div>
                        <!-- /.card-body -->
                    </div>
                @endforeach

            </div>
        </div>
        <div class="col-5">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add new</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    {!! Form::open( ['route'=> 'faq.store', 'method' =>'POST'] ) !!}

                    <div class="col-12">
                        {{ Form::select('tour_id', $tours , null, ['placeholder' => 'Trip name', 'class' => 'form-control']) }}
                    </div>

                    <div class="col-12">
                        {{ Form::label('question', 'Question:')}}
                        {{ Form::text('question', null, array("class"=>'form-control')) }}
                    </div>

                    <div class="col-12">
                        {{ Form::label('answer', 'Answer:')}}
                        {{ Form::textarea('answer', null, array("class"=>'form-control', 'row' =>'5')) }}
                    </div>

                    <div class="col-12">
                        {{ Form::submit('Add', ['class'=> 'btn btn-success btn-block mt-3'])}}
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
    $('.delete').click(function() {
                let id = $(this).data('id');      
                
                $.ajax({
                    
                    type: "POST",
                    url: '/manage/faq/' + id,
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        'id': id,
                        "_method": 'DELETE'
                    },
                    success: function (data) {
                        $('.item' + id).remove();
                        Toast.fire({
                        type: data.type,
                        title:data.message
                    })                          
                    }
                });
            });
</script>
@endsection