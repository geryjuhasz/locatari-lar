<?php
if(!empty($calculasociatie)) {
	$action = array('Calcul_asociatiesController@update', $calculasociatie->id);
	$method = 'PUT';
	$header = "Modifica setari asociatie";
} else {
	$action = 'Calcul_asociatiesController@store';
	$method = 'POST';
	$calculasociatie = new Calcul_asociatie();
        $header = "Creaza setari asociatie";
}
$tipcheltuieli = Tipcheltuieli::lists('denumire', 'id');
$tipcalculrepartitie = Tipcalculrepartitie::lists('denumire', 'id');
$tiprepartitie = Tiprepartitie::lists('denumire', 'id');

?>
@section('content')
<div class="col-4">
	<h3>{{ $header }}</h3>
	{{ Form::open(array('action' => $action, 'method' => $method)) }}
		{{ Form::label('tipcheltuieli_id', 'Tip cheltuieli: ', array('class' => 'form-label')) }}
                {{ Form::select('tipcheltuieli_id', $tipcheltuieli, Input::old('tipcheltuieli_id'), array('class' => 'form-control width-200')) }}

                {{ Form::label('tipcalculrepartitie_id', 'Calcul repartitie: ', array('class' => 'form-label')) }}
                {{ Form::select('tipcalculrepartitie_id', $tipcalculrepartitie, Input::old('tipcalculrepartitie_id'), array('class' => 'form-control width-200')) }}

                {{ Form::label('tiprepartitie_id', 'Tip repartitie: ', array('class' => 'form-label')) }}
                {{ Form::select('tiprepartitie_id', $tiprepartitie, Input::old('tiprepartitie_id'), array('class' => 'form-control width-200')) }}

		<hr />
		{{ Form::submit('Submit', array('class' => 'btn btn-default')) }}
	{{ Form::close() }}
</div>
@stop