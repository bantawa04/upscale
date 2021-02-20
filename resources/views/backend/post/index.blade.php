@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row pt-5">
        <div class="col-9">
            <h4>{{$posts->count()}} Post(s)</h4>
        </div>
        <div class="col-3">
            <a href="{{ route('post.create') }}" class="btn btn-success btn-block"> Add New</a>
        </div>
        <div class="col-12 pt-2">
            <div class="card">
                <div class="card-body">
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Image</th>
                                <th>Meta Title</th>
                                <th>Meta Description</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $item)
                            <tr class="text-center row{{$item->id}}">
                                <td><a href="{{ route('tour.show',$item->id) }}">{{$item->title}}</a></td>
                                <td>{{$item->category->name}}</td>
                                <td>
                                    @if ($item->path)
                                    <i class="fas fa-check-circle text-success"></i>
                                    @else
                                    <i class="fas fa-times-circle text-danger"></i>
                                    @endif

                                </td>
                                <td>
                                    @if ($item->meta_title)
                                    <i class="fas fa-check-circle text-success"></i>
                                    @else
                                    <i class="fas fa-times-circle text-danger"></i>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->meta_description)
                                    <i class="fas fa-check-circle text-success"></i>
                                    @else
                                    <i class="fas fa-times-circle text-danger"></i>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('post.edit', $item->id) }}"
                                        class="btn btn-primary btn-block btn-sm">
                                        <i class="far fa-edit"></i>
                                        Edit
                                    </a>

                                    <div class="custom-control custom-checkbox mt-2">
                                        <input type="checkbox" class="form-check-input publish my-2" id="publish"
                                            value="{{$item->id}}" {{$item->status ? 'checked': ''}}>
                                        <label for="publish">Publish</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mt-2">
                                        <input type="checkbox" class="form-check-input feature my-2" id="feature"
                                            value="{{$item->id}}" {{$item->featured ? 'checked': ''}}>
                                        <label for="feature">Feature</label>
                                    </div>

                                    {!! Form::open( array('route'=>array('post.destroy',
                                    $item->id),'method'=>'DELETE' )) !!}

                                    <button class="btn btn-danger btn-sm delete" type="submit">

                                        <i class="far fa-trash-alt"></i>
                                        Delete
                                    </button>
                                    {!! Form::close() !!}
                                </td>
                                </td>
                            </tr>
                            @endforeach

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#table').DataTable({
                "ordering": false,
        });

        $('.delete').click(function(e) {
            let id = $(this).data('id');      
            
            $.ajax({
                
                type: "POST",
                url: '/manage/tour/' + id,
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'id': id,
                    "_method": 'DELETE'
                },
                success: function (data) {
                    $('.row' + data['id']).remove();
                    Toast.fire({
                        type: data.type,
                        title: data.message
                    });
                }
            });
        });

        $('.publish').change(function() {
            var id = $(this).val();
            if($(this).prop("checked") == true){
                    $.ajax({
                            type: "POST",
                                    url: '/manage/post/publish/' + id,
                                    data: {
                                        '_token': $('meta[name="csrf-token"]').attr('content'),
                                        'id': id,
                                        "_method": 'PUT'
                                    },
                                    success: function (data) {
                                        Toast.fire({
                                            type: data.type,
                                            title: data.message
                                        })  
                                    }                  
                        });                
                    }
                    else{
                        $.ajax({
                            type: "POST",
                                    url: '/manage/post/unpublish/' + id,
                                    data: {
                                        '_token': $('meta[name="csrf-token"]').attr('content'),
                                        'id': id,
                                        "_method": 'PUT'
                                    },
                                    success: function (data) {
                                        Toast.fire({
                                            type: data.type,
                                            title: data.message
                                        })  
                                    }                  
                        }); 
                    }
        });

        $('.feature').change(function() {
            var id = $(this).val();
            if($(this).prop("checked") == true){
                    $.ajax({
                        type: "POST",
                                url: '/manage/post/feature/' + id,
                                data: {
                                    '_token': $('meta[name="csrf-token"]').attr('content'),
                                    'id': id,
                                    "_method": 'PUT'
                                },
                                success: function (data) {
                                    Toast.fire({
                                        type: data.type,
                                        title: data.message
                                    })  
                                }                  
                    });                
                }
                else{
                    $.ajax({
                        type: "POST",
                                url: '/manage/post/remove-feature/' + id,
                                data: {
                                    '_token': $('meta[name="csrf-token"]').attr('content'),
                                    'id': id,
                                    "_method": 'PUT'
                                },
                                success: function (data) {
                                    Toast.fire({
                                        type: data.type,
                                        title: data.message
                                    })  
                                }                  
                    }); 
                }
        });  
    });
</script>
@endsection
@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
@endsection