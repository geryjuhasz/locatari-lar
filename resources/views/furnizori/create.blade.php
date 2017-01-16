@extends ('layouts.dashboard')
@section('page_heading', 'Furnizori')
@section('section')

<?php
if(!empty($furnizor)) {
	$action = array('FurnizorController@update', $furnizor->id);
	$method = 'PUT';
	$header = "Modifica furnizor";
} else {
	$action = 'FurnizorController@store';
	$method = 'POST';
	$furnizor = new Furnizori();
        $header = "Creaza furnizor";
}

?>

<div class="col-4">
	{{ Form::open(array('action' => $action, 'method' => $method)) }}
		{{ Form::label('nume', 'Nume: ', array('class' => 'form-label')) }}
		{{ Form::text('nume', $furnizor->nume, array('class' => 'form-control')) }}
                
        {{ Form::label('codfiscal', 'Cod fiscal: ', array('class' => 'form-label')) }}
		{{ Form::text('codfiscal', $furnizor->codfiscal, array('class' => 'form-control')) }}
               
        {{ Form::label('email', 'E-mail: ', array('class' => 'form-label')) }}
		{{ Form::text('email', $furnizor->email, array('class' => 'form-control')) }}

		{{ Form::label('telefon', 'Telefon: ', array('class' => 'form-label')) }}
		{{ Form::text('telefon', $furnizor->telefon, array('class' => 'form-control')) }}

        {{ Form::label('contbancar', 'Cont bancar: ', array('class' => 'form-label')) }}
		{{ Form::text('contbancar', $furnizor->contbancar, array('class' => 'form-control')) }}
               
        {{ Form::label('banca', 'Banca: ', array('class' => 'form-label')) }}
		{{ Form::text('banca', $furnizor->banca, array('class' => 'form-control')) }}      
               
		<hr />
		{{ Form::submit('Submit', array('class' => 'btn btn-default')) }}
	{{ Form::close() }}
</div>
@stop