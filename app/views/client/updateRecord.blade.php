@extends('layouts/master')
@section('content')
<h1>Update Record</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}
<div class='container'>
	<div class='row'>
		<div class="well well-sm">
			{{ Form::open(array('action' => 'ClientController@handleUpdateRecord')) }}
			{{ Form::hidden('client_id', $client->id) }}
			{{ Form::hidden('record_id', $record->id) }}
			{{ Form::hidden('employee_id', Auth::user()->id) }}
			<div class="form-group">
			        {{ Form::label('date', 'Date') }}
			        <input type="date" class="form-control" name="date" value="{{ date("Y-m-d") }}" readonly="readonly"/>
			</div>

		    <div class="form-group">
		        {{ Form::label('remarks', 'Remarks') }}
		        {{ Form::text('remarks', Input::old('remarks'), array('class' => 'form-control')) }}
		    </div>

		    <div class="form-group">
		        {{ Form::label('due_date', 'Date of Payment') }}
		        <input type="date" class="form-control" name="due_date"/>
		    </div>

		    <div class="form-group">
		        {{ Form::label('notes', 'Notes') }}
		        {{ Form::text('notes', Input::old('notes'), array('class' => 'form-control') ) }}
		    </div>

		    <div class="form-group">
		        {{ Form::label('payments', 'Payment') }}
		        {{ Form::text('payments', '0.00', array('class' => 'form-control') ) }}
		    </div>

		    <div class="form-group">
		        {{ Form::label('balance', 'Balance') }}
		        {{ Form::text('balance', $record->balance, array('class' => 'form-control', 'readonly' => 'readonly') ) }}
		    </div>

		    {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
		    <a href="{{ URL::to('client'.'/'.$client->id) }}" class="btn btn-link">Cancel</a>
		{{ Form::close() }}
		</div>
	</div>
</div>

@stop