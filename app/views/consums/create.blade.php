<?php
if(!empty($consum)) {
	$action = array('ConsumsController@update', $consum->id);
	$method = 'PUT';
	$header = "Modifica";
} else {
	$action = 'CheltuielisController@store';
	$method = 'POST';
	$consum = new Consum();
        $header = "Introdu consum";
}

$asociatie_id = getInputOrSession('asociatie_id');
$asociatie = $asociatie_id!='0' ? Asociatie::where('id', '=', $asociatie_id)->lists('denumire', 'id') : Asociatie::lists('denumire', 'id');
$tipcheltuieli  = Tipcheltuieli::lists('denumire', 'id');
?>
@section('content')
<div class="col-4">
	<h3>{{ $header }}</h3>
        {{ Form::model($consum, array('route' => array('consums.update', $consum->id))) }}
	{{ Form::open(array('action' => $action, 'method' => $method)) }}
                 
                {{ Form::label('luna', 'Luna: ', array('class' => 'form-label')) }}
                {{ Form::text('luna', '', array('class' => 'datepicker form-control hasDatepicker','placeholder' => 'Luna','data-datepicker' => 'datepicker')) }}
                
                {{ Form::label('suma', 'Suma: ', array('class' => 'form-label')) }}
                {{ Form::text('suma', $consum->suma, array('class' => 'form-control')) }}
                
                {{ Form::label('detalii', 'Detalii: ', array('class' => 'form-label')) }}
                {{ Form::text('detalii', $consum->detalii, array('class' => 'form-control')) }}
                
		<hr />
		{{ Form::submit('Submit', array('class' => 'btn btn-default')) }}
	{{ Form::close() }}
</div>
@stop