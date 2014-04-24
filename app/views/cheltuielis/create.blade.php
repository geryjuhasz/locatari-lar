<?php
if(!empty($cheltuieli)) {
	$action = array('CheltuielisController@update', $cheltuieli->id);
	$method = 'PUT';
	$header = "Modifica";
} else {
	$action = 'CheltuielisController@store';
	$method = 'POST';
	$cheltuieli = new Cheltuieli();
        $header = "Introdu cheltuieli";
}

$asociatie_id = getInputOrSession('asociatie_id');
$asociatie = $asociatie_id!='0' ? Asociatie::where('id', '=', $asociatie_id)->lists('denumire', 'id') : Asociatie::lists('denumire', 'id');
$tipcheltuieli  = Tipcheltuieli::lists('denumire', 'id');
?>
@section('content')
<div class="col-4">
	<h3>{{ $header }}</h3>
	{{ Form::open(array('action' => $action, 'method' => $method, 'id' => 'create-cheltuieli')) }}
                {{ Form::label('asociatie_id', 'Asociatie: ', array('class' => 'form-label')) }}
                {{ Form::select('asociatie_id', $asociatie, Input::old('asociatie_id'), array('class' => 'form-control width-200')) }}

                {{ Form::label('tipcheltuieli_id', 'Tip cheltuieli: ', array('class' => 'form-label')) }}
		{{ Form::select('tipcheltuieli_id', $tipcheltuieli, Input::old('tipcheltuieli_id'), array('class' => 'form-control width-200')) }}
                
                {{ Form::label('luna', 'Luna: ', array('class' => 'form-label')) }}
                {{ Form::text('luna', '', array('class' => 'datepicker form-control hasDatepicker','placeholder' => 'Luna','data-datepicker' => 'datepicker')) }}
                
                {{ Form::label('suma', 'Suma: ', array('class' => 'form-label')) }}
                {{ Form::text('suma', $cheltuieli->suma, array('class' => 'form-control')) }}
                
                {{ Form::label('detalii', 'Detalii: ', array('class' => 'form-label')) }}
                {{ Form::text('detalii', $cheltuieli->detalii, array('class' => 'form-control')) }}
                
		<hr />
		{{ Form::submit('Submit', array('class' => 'btn btn-default')) }}
	{{ Form::close() }}
</div>
@stop