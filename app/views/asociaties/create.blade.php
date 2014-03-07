<?php
if(!empty($asociatie)) {
	$action = array('AsociatiesController@update', $asociatie->id);
	$method = 'PUT';
	$header = "Modifica asociatia";
} else {
	$action = 'AsociatiesController@store';
	$method = 'POST';
	$asociatie = new Asociatie();
        $header = "Creaza asociatie";
}
?>
@section('content')
<div class="col-4">
	<h3>{{ $header }}</h3>
	{{ Form::open(array('action' => $action, 'method' => $method)) }}
		{{ Form::label('denumire', 'Denumire: ', array('class' => 'form-label')) }}
		{{ Form::text('denumire', $asociatie->denumire, array('class' => 'form-control')) }}
                
                {{ Form::label('administrator', 'Administrator: ', array('class' => 'form-label')) }}
                {{ Form::text('administrator', $asociatie->administrator, array('class' => 'form-control')) }}

		<hr />
		{{ Form::submit('Submit', array('class' => 'btn btn-default')) }}
	{{ Form::close() }}
</div>
@stop