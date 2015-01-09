@extends('layouts/master')
@section('content')
	<h1 class="text-center login-title">View {{ $employee->lastname, ', ',$employee->firstname }} (Clients)</h1>
	<table class="table table-striped table-bordered" id='employee-list'>
	    <thead>
	        <tr>
	            <th>Fullname</th>
	            <th>Date Created</th>
	        </tr>
	    </thead>
	    <tbody>
            @foreach($clientList as $key => $value)
	        <tr>
	            <td><a href="{{ URL::to('client/' . $value->client_id) }}">{{ $value->lastname, ', ', $value->firstname  }}</a></td>
	            <td>{{ date('M. d, Y', strtotime($value->created_at))}}</td>
	        </tr>
            @endforeach
	    </tbody>
	</table>
</div>
@stop