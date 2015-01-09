@extends('layouts/master')
@section('content')
<h1>Create a Employee</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::open(array('url' => 'employee')) }}

    <div class="form-group">
        {{ Form::label('lastname', 'Lastname') }}
        {{ Form::text('lastname', Input::old('lastname'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('firstname', 'Firstname') }}
        {{ Form::text('firstname', Input::old('firstname'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('username', 'Username') }}
        {{ Form::text('username', Input::old('username'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('password', 'Password') }}
        {{ Form::password('password', array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('password_confirm', 'Confirm Password') }}
        {{ Form::password('password_confirm', array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
    	{{ Form::label('user_level','User Level') }}
		<select name='user_level' class="form-control" id="sel1">
			<optgroup label="User Level">
				<option value="Admin">Admin</option>
				<option value="User">User</option>
			</optgroup>
		</select>
    </div>

    {{ Form::submit('Create Employee!', array('class' => 'btn btn-primary')) }}
    <a href="{{ URL::to('employee') }}" class='btn btn-info'>Cancel</a>

{{ Form::close() }}
@stop