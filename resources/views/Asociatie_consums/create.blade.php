@extends ('layouts.dashboard')
@section('page_heading', 'Consum')
@section('section')

<?php
if(!empty($consumasociatie)) {
	$action = array('Asociatie_consumsController@update', $consumasociatie->id);
	$method = 'PUT';
	$header = "Modifica setari asociatie";
} else {
	$action = 'Asociatie_consumsController@store';
	$method = 'POST';
	$consumasociatie = new Asociatie_consum();
    $header = "Creaza setari asociatie";
}

$asociatie_id = getInputOrSession('asociatie_id');
$asociatie = $asociatie_id!='0' ? Asociatie::where('id', '=', $asociatie_id)->lists('denumire', 'id') : Asociatie::lists('denumire', 'id');
 
$tipconsum = Tipconsum::lists('denumire', 'id');
$tipcontor = Tipcontor::lists('denumire', 'id');

?>

<div class="col-4">
	<h3>{{ $header }}</h3>
	{{ Form::open(array('action' => $action, 'method' => $method)) }}
    	{{ Form::label('asociatie_id', 'Asociatie: ', array('class' => 'form-label')) }}
        {{ Form::select('asociatie_id', $asociatie, Input::old('asociatie_id'), array('class' => 'form-control width-200')) }}

		{{ Form::label('tipconsum_id', 'Tip consum: ', array('class' => 'form-label')) }}
        {{ Form::select('tipconsum_id', $tipconsum, $consumasociatie->tipconsum_id, array('class' => 'form-control width-200')) }}

        {{ Form::label('tipcontor_id', 'Tip contor: ', array('class' => 'form-label')) }}
                {{ Form::select('tipcontor_id', $tipcontor, $consumasociatie->tipcontor_id, array('class' => 'form-control width-200')) }}
		<hr />
		{{ Form::submit('Submit', array('class' => 'btn btn-default')) }}
	{{ Form::close() }}
</div>
@stop