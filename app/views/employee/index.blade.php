@extends('layouts/master')
@section('content')
	<h1>All Employee</h1>

	<nav class="navbar navbar-inverse">
	    <ul class="nav navbar-nav">
	        <li><a href="{{ URL::to('employee/create') }}">Add Employee</a>
	    </ul>
	</nav>
	<!-- will be used to show any messages -->
	@if (Session::has('message'))
	    <div class="alert alert-info">{{ Session::get('message') }}</div>
	@endif

	<table class="table table-striped table-bordered" id='employee-list'>
	    <thead>
	        <tr>
	            <th>Lastname</th>
	            <th>Firstname</th>
	            <th>User Level</th>
	            <th>Actions</th>
	        </tr>
	    </thead>
	    <tbody>
	    @foreach($employee as $key => $value)
	        <tr>
	            <td>{{ $value->lastname }}</td>
	            <td>{{ $value->firstname }}</td>
	            <td>{{ $value->user_level }}</td>
	            <td>
	                {{ Form::open(array('url' => 'employee/' . $value->id, 'class' => 'pull-right')) }}
	                    {{ Form::hidden('_method', 'DELETE') }}
	                    {{ Form::submit('Delete', array('class' => 'btn btn-warning')) }}
	                {{ Form::close() }}
	                <a class="btn btn-small btn-success" href="{{ URL::to('employee/' . $value->id) }}">View</a>
	                <a class="btn btn-small btn-info" href="{{ URL::to('employee/' . $value->id . '/edit') }}">Edit</a>
	            </td>
	        </tr>
	    @endforeach
	    </tbody>
	</table>
@stop