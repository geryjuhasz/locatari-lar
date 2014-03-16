<?php
if(!empty($scara)) {
	$action = array('ScarasController@update', $scara->id);
	$method = 'PUT';
	$header = "Modifica scara";
} else {
	$action = 'ScarasController@store';
	$method = 'POST';
	$scara = new Scara();
        $header = "Creaza scara";
}
$bloc = Bloc::lists('denumire', 'id');
?>
@section('content')
<div class="col-4">
	<h3>{{ $header }}</h3>
	{{ Form::open(array('action' => $action, 'method' => $method)) }}
		{{ Form::label('denumire', 'Denumire: ', array('class' => 'form-label')) }}
		{{ Form::text('denumire', $scara->denumire, array('class' => 'form-control')) }}
                
                {{ Form::label('bloc_id', 'Bloc: ', array('class' => 'form-label')) }}
                {{ Form::select('bloc_id', $bloc, Input::old('bloc_id'), array('class' => 'form-control width-200')) }}
                
                {{ Form::label('total_mp', 'Total mp: ', array('class' => 'form-label')) }}
		{{ Form::text('total_mp', $scara->total_mp, array('class' => 'form-control')) }}
               
                {{ Form::label('total_apartamente', 'Total apartamente: ', array('class' => 'form-label')) }}
		{{ Form::text('total_apartamente', $scara->total_apartamente, array('class' => 'form-control')) }}
               
		<hr />
		{{ Form::submit('Submit', array('class' => 'btn btn-default')) }}
	{{ Form::close() }}
</div>
@stop