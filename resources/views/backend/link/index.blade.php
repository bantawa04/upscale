@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row pt-5">
        <div class="col-md-9"></div>
        <div class="col-md-3">
            <a href="{{ route('links.create') }}" class="btn btn-block btn-primary">Create Link</a>
        </div>
    </div>
    <div class="row pt-3">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Links</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Name</th>
                                <th>Title</th>
                                <th>Meta Title</th>
                                <th>Meta Description</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($links as $item)
                            <tr class="item{{$item->id}}">
                                <td>{{$item->id}}</td>
                                <td>{{$item->para_1}}/{{$item->para_2}}</td>
                                <td>
                                    {{$item->title}}
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
                                <td class="text-right">
                                    <a href="{{ route('links.edit',$item->id) }}" class="btn btn-primary btn-sm"><i
                                            class="far fa-edit"></i></a>
                                    <button class="btn btn-sm btn-danger delete" data-id={{$item->id}}><i
                                            class="far fa-trash-alt"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
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
                    url: '/manage/links/' + id,
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        'id': id,
                        "_method": 'DELETE'
                    },
                    success: function (data) {
                        $('.item' + id).remove();
                    }
                });
            });
</script>
@endsection