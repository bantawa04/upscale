@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row pt-5">
        <div class="col-md-8 offset-md-2">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    {!! Form::model($user, ['route' => ['profile.update', $user->id], 'method' => 'PUT','class'
                    =>'form-horizontal', 'files'=> true]) !!}
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                                {!! Form::text('name', null, array('class' => 'form-control' , 'placeholder' => 'Name')) !!}

                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror                                
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="avatar" class="col-sm-2 col-form-label">Avatar</label>
                        <div class="col-sm-10">
                            <input type="file"  name="avatar">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">New Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="password" placeholder="Password"
                                name="password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="conformpassword" class="col-sm-2 col-form-label">Confirm Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="conformpassword"
                                placeholder="Confirm Password" name="conformpassword">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</div>
@endsection