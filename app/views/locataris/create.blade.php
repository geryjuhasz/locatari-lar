<?php
if(!empty($locatari)) {
	$action = array('LocatarisController@update', $locatari->id);
	$method = 'PUT';
	$header = "Modifica locatar";
} else {
	$action = 'LocatarisController@store';
	$method = 'POST';
	$locatari = new Locatari();
        $header = "Creaza locatar";
}

$scara_id = getInputOrSession('scara_id');
//$bloc = Bloc::where('asociatie_id', '=', $asociatie_id )->get();
$scara = $scara_id!='0' ? Scara::where('id', '=', $scara_id)->lists('denumire', 'id'): Scara::lists('denumire', 'id');

?>
@section('content')
<div class="col-4">
	<h3>{{ $header }}</h3>
	{{ Form::open(array('action' => $action, 'method' => $method)) }}
		{{ Form::label('nume', 'Nume: ', array('class' => 'form-label')) }}
		{{ Form::text('nume', $locatari->nume, array('class' => 'form-control')) }}
                
                {{ Form::label('scara_id', 'Scara: ', array('class' => 'form-label')) }}
                {{ Form::select('scara_id', $scara, Input::old('scara_id'), array('class' => 'form-control width-200')) }}
                
                {{ Form::label('suprafata_mp', 'Suprafata mp: ', array('class' => 'form-label')) }}
		{{ Form::text('suprafata_mp', $locatari->suprafata_mp, array('class' => 'form-control')) }}
               
                {{ Form::label('nr_apartament', 'Numar apartament: ', array('class' => 'form-label')) }}
		{{ Form::text('nr_apartament', $locatari->nr_apartament, array('class' => 'form-control')) }}
               
                {{ Form::label('nr_persoane', 'Numar persoane: ', array('class' => 'form-label')) }}
		{{ Form::text('nr_persoane', $locatari->nr_persoane, array('class' => 'form-control')) }}
               
		<hr />
		{{ Form::submit('Submit', array('class' => 'btn btn-default')) }}
	{{ Form::close() }}
</div>
@stop