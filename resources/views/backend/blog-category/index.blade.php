@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row pt-5">
        <div class="col-7">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Blog Cateogry</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Name</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $item)
                            <tr class="item{{$item->id}}">
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td class="d-flex justify-content-end ">
                                    <a href="{{ route('blog-category.edit',$item->id) }}"
                                        class="btn btn-primary btn-sm mr-2">
                                        <i class="far fa-edit"></i>
                                        Edit
                                    </a>

                                    {!! Form::open( array('route'=>array('blog-category.destroy',
                                    $item->id),'method'=>'DELETE' )) !!}

                                    <button class="btn btn-danger btn-sm" type="submit">

                                        <i class="far fa-trash-alt"></i>
                                        Delete
                                    </button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <div class="col-5">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add new</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    {!! Form::open( ['route'=> 'blog-category.store', 'method' =>'POST'] ) !!}

                    <div class="col-12">
                        {{ Form::label('name', 'Name:')}}
                        {{ Form::text('name', null, array("class"=>'form-control')) }}
                    </div>
                    @include('backend.partials.metaTags')
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