@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row pt-5">
        <div class="col-9">
            <h4>{{$tours->count()}} Tour(s)</h4>
        </div>
        <div class="col-3">
            <a href="{{ route('tour.create') }}" class="btn btn-success btn-block"> Add New</a>
        </div>
        <div class="col-12 pt-2">
            <div class="card">
                <div class="card-body">
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Days</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Image</th>
                                <th>Meta Title</th>
                                <th>Meta Description</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tours as $item)
                            <tr class="text-center row{{$item->id}}">
                                <td><a href="{{ route('tour.show',$item->id) }}">{{$item->name}}</a></td>
                                <td>{{$item->days}}</td>
                                <td>{{$item->price}}</td>
                                <td>{{$item->category->name}}</td>
                                <td>
                                    @if ($item->image)
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
                                    <a href="{{ route('tour.edit', $item->id) }}"
                                        class="btn btn-primary btn-block btn-sm">
                                        <i class="far fa-edit"></i>
                                        Edit
                                    </a>
                                    <a href="{{ route('itinerary.index',$item->id) }}"
                                        class="btn btn-info btn-block btn-sm">
                                        <i class="fas fa-list-ul"></i>
                                        Itinerary
                                    </a>
                                    <div class="custom-control custom-checkbox mt-2">
                                            <input type="checkbox" class="form-check-input publish my-2" id="publish" value="{{$item->id}}" {{$item->status ? 'checked': ''}}>
                                            <label for="publish">Publish</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mt-2">
                                            <input type="checkbox" class="form-check-input feature my-2" id="feature" value="{{$item->id}}" {{$item->featured ? 'checked': ''}}>
                                            <label for="feature">Feature</label>
                                    </div>
                                    <button class="btn btn-danger btn-block btn-sm delete mt-2" data-id="{{$item->id}}">
                                        <i class="far fa-trash-alt"></i>
                                        Delete</button>
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
    $(document).on('change', '.publish', function(){
        console.log("Published ticked");        
        var id = $(this).val();
        console.log(id);
        if($(this).prop("checked") == true){
            $.ajax({
                type: "POST",
                        url: '/manage/tour/publish/' + id,
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
                        url: '/manage/tour/unpublish/' + id,
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
    $(document).on('change', '.feature', function(){
        var id = $(this).val();
        console.log("Feature ticked");
        console.log(id);                    
        if($(this).prop("checked") == true){
            $.ajax({
                type: "POST",
                        url: '/manage/tour/feature/' + id,
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
                            url: '/manage/tour/remove-feature/' + id,
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
    $(document).on('click', '.delete', function(){
        
        let id = $(this).data('id');     
        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.value) {
            $.ajax({                    
                type: "POST",
                url: '/manage/tour/' + id,
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'id': id,
                    "_method": 'DELETE'
                },
                success: function (data) {
                    $('.item' + data['id']).remove();
                    Toast.fire({
                        type: 'success',
                        title: 'Deleted  successfully'
                    })  
                }              
            });        
        }
      })                
    });
});
</script>
@endsection
@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
@endsection