@extends ('layouts.dashboard')
@section('page_heading','Adauga contor')

<?php

if(!empty($locatarcontor)) {
	$action = array('LocatarContor@update', $locatar_id);
	$method = 'PUT';
	$header = "Modifica contor locatar";
} else {
	$action = 'LocatarContor@store';
	$method = 'POST';
    $header = "Adauga contor locatar";
}
?>
@section('section')

<div class="col-4">
	<h3>{{ $header }}</h3>
	{{ Form::open(array('action' => $action, 'method' => $method)) }}
        {{ Form::label('tipcontor_id', 'Contor: ', array('class' => 'form-label')) }}
        {{ Form::select('tipcontor_id', $tipcontor, Input::old('tipcontor_id'), array('class' => 'form-control width-200')) }}
               
        {{ Form::text('locatari_id', $locatari_id, array('class' => 'form-control')) }}
       	<hr />
		{{ Form::submit('Submit', array('class' => 'btn btn-default')) }}
	{{ Form::close() }}
</div>
@stop