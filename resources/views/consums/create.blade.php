<?php
if(!empty($consumlocatar)) {
	$action = array('ConsumsController@update', $cheltuieli->id);
	$method = 'PUT';
	$header = "Modifica consum";
} else {
	$action = 'ConsumsController@store';
	$method = 'POST';
	$consumlocatar = new Consum();
        $header = "Introdu consum";
}

$tipconsum_id = getInputOrSession('tipconsum_id');
$tipconsum = Tipconsum::all();
$asociatie_id = getInputOrSession('asociatie_id');
$asociatie = $asociatie_id!='0' ? Asociatie::where('id', '=', $asociatie_id)->lists('denumire', 'id') : Asociatie::lists('denumire', 'id');
    
?>
@extends('layout')
@section('content')
<div class="col-4">
	<h3>{{ $header }}</h3>
        {{ Form::open(array('action' => $action, 'method' => $method)) }}
            {{ Form::selectModel($tipconsum, 'denumire', $tipconsum_id, 'tipconsum_id', array('class' => 'page-specifier form-control'), 'Alege consum') }}
        <hr />

	
            @foreach ($asociatie_consum as $ac)
                {{ Form::label('incapere',  $ac->tipincapere->denumire.': ', array('class' => 'form-label')) }}
                <br/>
                {{ Form::label($ac->tipincapere->denumire.'_index_vechi_rece',  'Index vechi rece', array('class' => 'form-label')) }}
                {{ Form::text($ac->tipincapere->denumire.'_index_vechi_rece', $consumlocatar->index_vechi_rece, array('class' => 'form-control')) }}
                {{ Form::label($ac->tipincapere->denumire.'_index_nou_rece',  'Index nou rece', array('class' => 'form-label')) }}
                {{ Form::text($ac->tipincapere->denumire.'_index_nou_rece', $consumlocatar->index_nou_rece, array('class' => 'form-control')) }}
                
                {{ Form::label($ac->tipincapere->denumire.'_index_vechi_calda',  'Index vechi calda', array('class' => 'form-label')) }}
                {{ Form::text($ac->tipincapere->denumire.'_index_vechi_calda', $consumlocatar->index_vechi_calda, array('class' => 'form-control')) }}
                {{ Form::label($ac->tipincapere->denumire.'_index_nou_calda',  'Index nou calda', array('class' => 'form-label')) }}
                {{ Form::text($ac->tipincapere->denumire.'_index_nou_calda', $consumlocatar->index_nou_calda, array('class' => 'form-control')) }}
            @endforeach
            <hr />
		{{ Form::submit('Submit', array('class' => 'btn btn-default')) }}
	{{ Form::close() }}
</div>
@stop