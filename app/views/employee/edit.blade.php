@extends('layouts/master')
@section('content')
	<h1>Edit {{ $employee->firstname }}</h1>

	<!-- if there are creation errors, they will show here -->
	{{ HTML::ul($errors->all()) }}

	{{ Form::model($employee, array('route' => array('employee.update', $employee->id), 'method' => 'PUT')) }}

	    <div class="form-group">
	        {{ Form::label('lastname', 'Lastname') }}
	        {{ Form::text('lastname', null, array('class' => 'form-control')) }}
	    </div>

	    <div class="form-group">
	        {{ Form::label('firstname', 'Firstname') }}
	        {{ Form::text('firstname', null, array('class' => 'form-control')) }}
	    </div>

	    {{ Form::submit('Edit Employee!', array('class' => 'btn btn-primary')) }}
	    <a href="{{ URL::to('employee') }}" class='btn btn-info'>Cancel</a>
	{{ Form::close() }}
@stop