<?php
if(!empty($bloc)) {
	$action = array('BlocsController@update', $bloc->id);
	$method = 'PUT';
	$header = "Modifica blocul";
} else {
	$action = 'BlocsController@store';
	$method = 'POST';
	$bloc = new Bloc();
        $header = "Creaza bloc";
}

if(Input::get('asociatie_id')) {
    $asociatie_id = Input::get('asociatie_id');
    Session::put('asociatie_id', $asociatie_id);
} else if(Session::get('asociatie_id')) {
    $asociatie_id = Session::get('asociatie_id');
} else {
    $asociatie_id = '0';
}
$asociatie = $asociatie_id!='0' ? Asociatie::where('id', '=', $asociatie_id)->lists('denumire', 'id') : Asociatie::lists('denumire', 'id');
        
?>
@section('content')
<div class="col-4">
	<h3>{{ $header }}</h3>
	{{ Form::open(array('action' => $action, 'method' => $method)) }}
		{{ Form::label('denumire', 'Denumire: ', array('class' => 'form-label')) }}
		{{ Form::text('denumire', $bloc->denumire, array('class' => 'form-control')) }}
                
                {{ Form::label('asociatie_id', 'Asociatie: ', array('class' => 'form-label')) }}
                {{ Form::select('asociatie_id', $asociatie, Input::old('asociatie_id'), array('class' => 'form-control width-200')) }}

		<hr />
		{{ Form::submit('Submit', array('class' => 'btn btn-default')) }}
	{{ Form::close() }}
</div>
@stop