@extends('layout')
@section('content')
<?php
if(Input::get('asociatie_id')) {
    $asociatie_id = Input::get('asociatie_id');
    Session::put('asociatie_id', $asociatie_id);
} else if(Session::get('asociatie_id')) {
    $asociatie_id = Session::get('asociatie_id');
} else {
    $asociatie_id = '0';
}

if(Input::get('bloc_id')) {
    $bloc_id = Input::get('bloc_id');
    Session::put('bloc_id', $bloc_id);
    $asociatie_id = Bloc::find($bloc_id)->asociatie->id;
} else if(Session::get('bloc_id')) {
    $bloc_id = Session::get('bloc_id');
} else {    
    $bloc_id = '0';
}

if(Input::get('scara_id')) {
    $scara_id = Input::get('scara_id');
    Session::put('scara_id', $scara_id);
    $bloc_id = Scara::find($scara_id)->bloc->id;
    $asociatie_id = Bloc::find($bloc_id)->asociatie->id;
} else if(Session::get('scara_id')) {
    $scara_id = Session::get('scara_id');
} else {    
    $scara_id = '0';
}

$asociatie = Asociatie::all();
$bloc = Bloc::where('asociatie_id', '=', $asociatie_id)->get();
$scara = Scara::where('bloc_id', '=', $bloc_id)->get();
        //$asociatie_id!='0' ? Asociatie::where('id', '=', $asociatie_id)->get() : Asociatie::all();
?>
<h2>Consum asociatie:</h2>

<div class="col-3">
	{{ Form::selectModel($asociatie, 'denumire', $asociatie_id, 'asociatie_id', array('class' => 'page-specifier form-control'), 'Alege asociatie') }}
        {{ Form::selectModel($bloc, 'denumire', $bloc_id, 'bloc_id', array('class' => 'page-specifier form-control'), 'Alege bloc') }}
        {{ Form::selectModel($scara, 'denumire', $scara_id, 'scara_id', array('class' => 'page-specifier form-control'), 'Alege scara') }}
</div>

<div class="col-3">
        {{ Form::text('luna', '', array('class' => 'datepicker form-control hasDatepicker','placeholder' => 'Luna','data-datepicker' => 'datepicker')) }}
        {{ Form::submit('Afiseaza', array('class' => 'btn btn-default')) }}
</div>

<div class="pull-right">
	<a href="{{ URL::action('CheltuielisController@create') }}" class="btn btn-default">Introdu consum</a>
</div>

<table class="table table-striped table-hover">
	<thead>
		<tr>
                    <th>Nr.apartament</th>	
                    <th>Locatar</th>
                    <th>Incapere</th>
                    <th>Index vechi</th>
                    <th>Index nou</th>
                    <th>Consum</th>
                    <th></th>
                    <th></th>
		</tr>
		<tbody>
			@foreach($consum as $cconsum)
			<tr>
                            <td>{{ $cconsum->nr_apartament }}</td>	
                            <td>{{ $cconsum->nume }}</td>
                            <td>{{ $cconsum->tipincapere_id }}</td>                                
                            <td>{{ $cconsum->index_vechi }}</td>
                            <td>{{ $cconsum->index_nou }}</td>
                            <td>{{ $cconsum->index_nou-$cconsum->index_vechi }}</td>
                            <td><a href="{{ URL::action('ConsumsController@edit', $cconsum->id) }}" target='_blank'>Edit</a></td>
                            <td></td>
			</tr>
			@endforeach
		</tbody>
	</thead>
</table>
@stop