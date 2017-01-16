
<?php
//decide which asociatie to show
if (Session::get('asociatie')) $asociatie = Session::get('asociatie');
if (Session::get('asociatie_id')) $asociatie_id = Session::get('asociatie_id', '0');
else $asociatie_id = 0;

$action = 'AsociatiesController@select';
$method = 'POST';
?>
{{ Form::open(array('action' => $action, 'method' => $method)) }}
<div class="">
	{{ Form::label('asociatie', 'Asociatia selectata: ', array('class' => 'left')); }}
	{{ Form::selectModel($asociatie, 'denumire', $asociatie_id, 'asociatie_id', array('class' => 'form-control', 'id' => 'asociatie_id', 'onchange' => 'this.form.submit()'), 'Alege asociatie') }}
</div>
{{ Form::close() }}



