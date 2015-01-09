@extends('layouts/master')
@section('content')
	<h1 class="text-center login-title">View {{ $client->lastname, ', ',$client->firstname }}</h1>
	<nav class="navbar navbar-inverse">
	    <ul class="nav navbar-nav">
	    	@if(count($record) === 0)
	        <li><a href="{{ URL::to('client/addRecord/' . $client->id) }}">Add Record</a></li>
	        @else
    		<li><a href="{{ URL::to('client/updateRecord/' . $client->id) }}">Update Record</a></li>
	    	@endif
	    </ul>
	</nav>
	<!-- will be used to show any messages -->
	@if (Session::has('message'))
	    <div class="alert alert-info">{{ Session::get('message') }}</div>
	@endif

	<table class="table table-striped table-bordered" id='record-list'>
	    <thead>
	        <tr>
	            <th>Date</th>
	            <th>Remarks</th>
	            <th>Date of Payment</th>
	            <th>Employee</th>
	            <th>Notes</th>
	            <th>Payment</th>
	            <th>Balance</th>
	        </tr>
	    </thead>
	    <tbody>
	    	@foreach($record as $key => $value)
	    		<tr>
	    			<td>{{ date('M. d, Y', strtotime($value->date))}} </td>
	    			<td>{{ $value->remarks}} </td>
	    			<td>{{ date('M. d, Y', strtotime($value->due_date))}} </td>
	    			<td>{{ $value->emp_name}} </td>
	    			<td>{{ $value->notes}} </td>
	    			<td>{{ number_format((float)$value->payments, 2, '.', ',')}} </td>
	    			<td>{{ number_format((float)$value->balance, 2, '.', ',')}} </td>
	    		</tr>
	    	@endforeach
	    </tbody>
	</table>
@stop