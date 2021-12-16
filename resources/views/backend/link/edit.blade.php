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
                    {!! Form::model($link, ['route' => ['links.update', $link->id], 'method' => 'PUT']) !!}
                    <div class="col-12 mb-3">
                        {{ Form::label('name', 'Name:')}}
                                <select name="para1" id="" class="form-control">
                                    @foreach ($options as $item)
                                        @if ($link->para_1 == $item->slug)
                                            <option value="{{$item->slug}}" selected>{{$item->name}}</option>
                                        @else
                                            <option value="{{$item->slug}}">{{$item->name}}</option>
                                        @endif
                                     @endforeach
                                </select>
                            </div>

                    <div class="col-12 mb-3">
                        {{ Form::label('name', 'Name:')}}
                        <select name="para2" id="" class="form-control">
                            @foreach ($options as $item)
                                @if ($link->para_2 == $item->slug)
                                    <option value="{{$item->slug}}" selected>{{$item->name}}</option>
                                @else
                                    <option value="{{$item->slug}}">{{$item->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 mb-3">
                        {{ Form::label('title', 'Title:')}}
                        {{ Form::text('title', null, array("class"=>'form-control')) }}
                    </div>

                     <div class="col-12 mb-3">
                        {{ Form::label('content', 'Content:')}}
                        {{ Form::textarea('content', null, array("class"=>'form-control', 'id' => 'content')) }}
                    </div>

                    <h3>SEO Entities</h3>

                    <div class="col-12 mb-3">
                        {{ Form::label('meta_title', 'Meta Title:')}}
                        {{ Form::text('meta_title', null, array("class"=>'form-control')) }}
                    </div>

                    <div class="col-12 mb-3">
                        {{ Form::label('meta_description', 'Meta Description:')}}
                        {{ Form::textarea('meta_description', null, array("class"=>'form-control')) }}
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
 <script src="https://cdn.tiny.cloud/1/8t3cusqbsgxjxtrx0cesy6fo1sdkesg3rsg41aky7y8m430h/tinymce/5/tinymce.min.js"></script>
 <script>
        tinymce.init({
          selector: 'textarea#content',
          height: 300,
          menubar: false,
          plugins: [
            'lists',
          ],
          toolbar: 
          'bullist numlist outdent indent | bold italic underline strikethrough' +
          'help',
        });
</script>
@endsection