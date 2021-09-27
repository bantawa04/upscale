@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row pt-5">
        <div class="col-7">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Country</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Name</th>
                                <th>No. of tours</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($countries as $item)
                            <tr class="item{{$item->id}}">
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->tours->count()}}</td>
                                <td class="text-center">
                                    <a href="{{ route('country.edit',$item->id) }}"
                                        class="btn btn-primary btn-sm">Edit</a>
                                    <button class="btn btn-sm btn-danger delete" data-id="{{$item->id}}">Delete</button>
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
                    {!! Form::open( ['route'=> 'country.store', 'method' =>'POST', 'files'=>true] ) !!}

                    <div class="col-12">
                        {{ Form::label('name', 'Name:')}}
                        {{ Form::text('name', null, array("class"=>'form-control')) }}
                    </div>

                    <div class="col-12">
                        {{ Form::label('description', 'Description:')}}
                        {{ Form::textarea('description', null, array("class"=>'form-control')) }}
                    </div>

                    <div class="col-12 mt-3">
                        @include('backend.partials._media')
                    </div>
                    <div class="col-12 mt-3">
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="exampleInputFile" name="map">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text" id="">Upload</span>
                            </div>
                        </div>
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
@section('scripts')
<script>
    $('.delete').click(function() {        
        let id = $(this).data('id');      

        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            $.ajax({                    
                type: "POST",
                url: '/manage/country/' + id,
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'id': id,
                    "_method": 'DELETE'
                },
                success: function (data) {
                    console.log(data);
                    $('.item' + data['id']).remove();
                    Toast.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                    )
                }
            });
        })                
    });
</script>
@endsection