@extends('layouts/master')
@section('content')
<div class='container'>
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h1 class="text-center login-title">MDK LIDO LOANS INC.</h1>
            <div class="account-wall">
                <img class="profile-img" src="{{ asset('assets/images/logo.png') }}"
                    alt="">
                {{ Form::open(array('class' => 'form-signin', 'action' => 'EmployeeController@doLogin')) }}
                    {{ Form::text('username', null, array('placeholder' => 'Username', 'class' => 'form-control input-lg if ($errors->has("username")) has-error endif')) }}
                    @if ($errors->has('username')) <p class="help-block">{{ $errors->first('username') }}</p> @endif
                    {{ Form::password('password', array( 'placeholder' => 'Password', 'class' => 'form-control input-lg if ($errors->has("password")) has-error endif')) }}
                    @if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
                    {{ Form::submit('Sign In', array('class' => 'btn btn-lg btn-primary btn-block')) }}
                    <span class="clearfix"></span>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@stop