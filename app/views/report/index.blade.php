@extends('layouts/master')
@section('content')

<h1 class="text-center login-title">Detail Report</h1>
	<div class="form-group navbar-form pull-right" id="date-group">
		<label for="from">From</label>
        <input type="text" class="form-control" id ='from'>
        <label for="to">To</label>
        <input type="text" class="form-control" id ='to'>
    </div>
	<table class="table table-striped table-bordered" id='report-list'>
	    <thead>
	        <tr>
	            <th>Date</th>
	            <th>Full Name</th>
	            <th>Employee</th>
	            <th>Payment</th>
	        </tr>
	    </thead>
	    <tbody>
	    	@foreach($record as $key => $value)
	    		<tr>
	    			<td>{{ date('M. d, Y', strtotime($value->date))}} </td>
	    			<td><a href="{{ URL::to('client/' . $value->client_id) }}">{{ $value->lastname,', ',$value->firstname}} </a></td>
	    			<td>{{ $value->emp_name}} </td>
	    			<td>{{ number_format((float)$value->payments, 2, '.', ',') }} </td>
	    		</tr>
	    	@endforeach
	    </tbody>
	    <tfoot>
        <tr>
            <th colspan="3" style="text-align:right">Total Collectibles:</th>
            <th></th>
        </tr>
    </tfoot>
	</table>
	{{ HTML::script('assets/js/report-list.js') }}
	{{ HTML::script('assets/TableTools/js/dataTables.tableTools.min.js')}}
@stop