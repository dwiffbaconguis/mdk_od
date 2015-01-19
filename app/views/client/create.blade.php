@extends('layouts/master')
@section('content')
<h1>Add Client</h1>

<!-- if there are creation errors, they will show here -->
{{ HTML::ul($errors->all()) }}

{{ Form::open(array('url' => 'client')) }}
    {{ Form::hidden('employee_id', Auth::user()->id) }}
    <div class="form-group">
        {{ Form::label('lastname', 'Lastname') }}
        {{ Form::text('lastname', Input::old('lastname'), array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('firstname', 'Firstname') }}
        {{ Form::text('firstname', Input::old('firstname'), array('class' => 'form-control')) }}
    </div>

    {{ Form::submit('Add Client!', array('class' => 'btn btn-primary')) }}
    <a href="{{ URL::to('client') }}" class='btn btn-info'>Cancel</a>

{{ Form::close() }}
@stop