@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row pt-5">
        <div class="col-10 offset-1">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add new</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    {!! Form::open( ['route'=> 'links.store', 'method' =>'POST'] ) !!}

                    <div class="col-12">
                        {{ Form::label('name', 'Name:')}}
                        <select name="para1" id="" class="form-control">
                            @foreach ($options as $item)
                            <option value="{{$item->slug}}">{{$item->name}}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="col-12">
                        {{ Form::label('name', 'Name:')}}
                        <select name="para2" id="" class="form-control">
                            @foreach ($options as $item)
                            <option value="{{$item->slug}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12">
                        {{ Form::label('title', 'Title:')}}
                        {{ Form::text('title', null, array("class"=>'form-control')) }}
                    </div>

                    {{-- <div class="col-12 mb-3">
                        {{ Form::label('description', 'Description:')}}
                        {{ Form::textarea('description', null, array("class"=>'form-control')) }}
                    </div> --}}

                    <h3>SEO Entities</h3>

                    <div class="col-12">
                        {{ Form::label('meta_title', 'Meta Title:')}}
                        {{ Form::text('meta_title', null, array("class"=>'form-control')) }}
                    </div>

                    <div class="col-12 mb-3">
                        {{ Form::label('meta_description', 'Meta Description:')}}
                        {{ Form::textarea('meta_description', null, array("class"=>'form-control')) }}
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