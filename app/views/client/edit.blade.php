@extends('layouts/master')
@section('content')
	<h1>Edit {{ $client->firstname }}</h1>

	<!-- if there are creation errors, they will show here -->
	{{ HTML::ul($errors->all()) }}

	{{ Form::model($client, array('route' => array('client.update', $client->id), 'method' => 'PUT')) }}

	    <div class="form-group">
	        {{ Form::label('lastname', 'Lastname') }}
	        {{ Form::text('lastname', null, array('class' => 'form-control')) }}
	    </div>

	    <div class="form-group">
	        {{ Form::label('firstname', 'Firstname') }}
	        {{ Form::text('firstname', null, array('class' => 'form-control')) }}
	    </div>

	    {{ Form::submit('Edit Client!', array('class' => 'btn btn-primary')) }}
	    <a href="{{ URL::to('client') }}" class='btn btn-info'>Cancel</a>
	{{ Form::close() }}
@stop