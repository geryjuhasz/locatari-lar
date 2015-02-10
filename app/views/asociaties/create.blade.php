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

$admins = $asociatie->admin_id!='0' ? Admin::where('id', '=', $asociatie->admin_id)->lists('name', 'id'): Admin::where('type', '=', 'admin')->lists('name', 'id');

?>
@section('content')
<div class="col-4">
	<h3>{{ $header }}</h3>
	{{ Form::open(array('action' => $action, 'method' => $method)) }}
		{{ Form::label('denumire', 'Denumire: ', array('class' => 'form-label')) }}
		{{ Form::text('denumire', $asociatie->denumire, array('class' => 'form-control')) }}
                
                {{ Form::label('admin_id', 'Administrator: ', array('class' => 'form-label')) }}
                {{ Form::select('admin_id', $admins, Input::old('administrator'), array('class' => 'form-control width-200', 'id' => 'admins-select-admin')) }}

		<hr />
		{{ Form::submit('Submit', array('class' => 'btn btn-default')) }}
	{{ Form::close() }}
</div>
@stop