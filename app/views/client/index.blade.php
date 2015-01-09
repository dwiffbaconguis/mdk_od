@extends('layouts/master')
@section('content')
	<h1>All Client</h1>

	<nav class="navbar navbar-inverse">
	    <ul class="nav navbar-nav">
	        <li><a href="{{ URL::to('client/create') }}">Add Client</a>
	    </ul>
	</nav>
	<!-- will be used to show any messages -->
	@if (Session::has('message'))
	    <div class="alert alert-info">{{ Session::get('message') }}</div>
	@endif

	<table class="table table-striped table-bordered" id='client-list'>
	    <thead>
	        <tr>
	        	<th>ID</th>
	            <th>Lastname</th>
	            <th>Firstname</th>
	            <th>Employee</th>
	            <th>Actions</th>
	        </tr>
	    </thead>
	    <tbody>
	    @foreach($client as $key => $value)
	        <tr>
	        	<td>{{ $value->id }}</td>
	            <td>{{ $value->lastname }}</td>
	            <td>{{ $value->firstname }}</td>
	            <td>{{ $value->emp_name }}</td>
	            <td>
	            	@if(Auth::user()->user_level === 'Admin')
		                {{ Form::open(array('url' => 'client/' . $value->id, 'class' => 'pull-right')) }}
		                    {{ Form::hidden('_method', 'DELETE') }}
		                    {{ Form::submit('Delete', array('class' => 'btn btn-warning')) }}
		                {{ Form::close() }}
		                <a class="btn btn-small btn-success" href="{{ URL::to('client/' . $value->id) }}">View</a>
		                <a class="btn btn-small btn-info" href="{{ URL::to('client/' . $value->id . '/edit') }}">Edit</a>
	                @else
	                	<a class="btn btn-small btn-success" href="{{ URL::to('client/' . $value->id) }}">View</a>
	                @endif
	            </td>
	        </tr>
	    @endforeach
	    </tbody>
	</table>
@stop