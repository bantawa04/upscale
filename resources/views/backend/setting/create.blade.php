@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row pt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Settings</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body px-2">
                    {!! Form::open( ['route'=> 'setting.store', 'method' =>'POST', 'files' => true] ) !!}

                    <div class="row">
                        <div class="col-6">
                            {{ Form::label('company_name', 'Company Name:')}}
                            {{ Form::text('company_name', null, array("class"=>'form-control')) }}
                        </div>

                        <div class="col-6">
                            {{ Form::label('tagline', 'Tagline:')}}
                            {{ Form::text('tagline', null, array("class"=>'form-control')) }}
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-6">
                            {{ Form::label('address', 'Address:')}}
                            {{ Form::text('address', null, array("class"=>'form-control')) }}
                        </div>

                        <div class="col-6">
                            {{ Form::label('city', 'City:')}}
                            {{ Form::text('city', null, array("class"=>'form-control')) }}
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-6">
                            {{ Form::label('phone', 'Phone:')}}
                            {{ Form::text('phone', null, array("class"=>'form-control')) }}
                        </div>

                        <div class="col-6">
                            {{ Form::label('mobile', 'Mobile:')}}
                            {{ Form::text('mobile', null, array("class"=>'form-control')) }}
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-6">
                            {{ Form::label('website', 'Website:')}}
                            {{ Form::text('website', null, array("class"=>'form-control')) }}
                        </div>

                        <div class="col-6">
                                {{ Form::label('email', 'Email:')}}
                                {{ Form::text('email', null, array("class"=>'form-control')) }}
                            </div>                        

                    </div>

                    <div class="row">
                        <div class="col-6">
                            {{ Form::label('facebook', 'Facebook:')}}
                            {{ Form::text('facebook', null, array("class"=>'form-control')) }}
                        </div>

                        <div class="col-6">
                            {{ Form::label('twitter', 'Twitter:')}}
                            {{ Form::text('twitter', null, array("class"=>'form-control')) }}
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-6">
                            {{ Form::label('instagram', 'Instagram:')}}
                            {{ Form::text('instagram', null, array("class"=>'form-control')) }}
                        </div>

                        <div class="col-6">
                            {{ Form::label('youtube', 'Youtube:')}}
                            {{ Form::text('youtube', null, array("class"=>'form-control')) }}
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-6">
                            {{ Form::label('linkedin', 'Linked in:')}}
                            {{ Form::text('linkedin', null, array("class"=>'form-control')) }}
                        </div>
                        <div class="col-6">
                            {{ Form::label('pintrest', 'Pintrest:')}}
                            {{ Form::text('pintrest', null, array("class"=>'form-control')) }}
                        </div>                        
                    </div>

                    <div class="row">
                        <div class="col-6">
                            {{ Form::label('meta_title', 'Meta Title:')}}
                            {{ Form::text('meta_title', null, array("class"=>'form-control')) }}
                        </div>

                        <div class="col-6">
                            {{ Form::label('meta_description', 'Meta Description:')}}
                            {{ Form::textarea('meta_description', null, array("class"=>'form-control', "style" => 'resize:none', "rows" => '3')) }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            {{ Form::label('Cover Photo', 'Cover Photo:')}}
                            {{ Form::file('photo', null, array("class"=>'form-control')) }}
                        </div>
                        <div class="col-6">
                        </div>
                    </div>

                    <div class="col-12">
                        {{ Form::submit('Save', ['class'=> 'btn btn-success btn-block mt-3'])}}
                    </div>
                    {!! Form::close() !!}
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</div>
@endsection