<?php
if(isset($admin)) {
	$action = array('AdminsController@update', $admin->id);
	$method = 'PUT';
} else {
	$admin = new Admin();
	$action = array('AdminsController@store');
	$method = 'POST';
}
//$moduleRights = $admin->moduleRights();
?>
@section('content')
{{ Form::open(array('action' => $action, 'method' => $method)) }}
	<div class="pull-left margin-right-30">
		<div class="form-group">
			{{ Form::label('name', 'Name:') }}
			{{ Form::text('name', Input::old('name') ?: $admin->name, array('class' => 'form-control width-200', 'autocomplete' => 'off')) }}
		</div>
		<div class="form-group">
			{{ Form::label('email', 'Email:') }}
			{{ Form::text('email', Input::old('email') ?: $admin->email, array('class' => 'form-control width-200', 'autocomplete' => 'off')) }}
		</div>
                 <div class="form-group">
			{{ Form::label('username', 'Username:') }}
			{{ Form::text('username', Input::old('username') ?: $admin->username, array('class' => 'form-control width-200', 'autocomplete' => 'off')) }}
		</div>
		<div class="form-group">
			{{ Form::label('password', 'Password:') }}
			{{ Form::password('password', array('class' => 'form-control width-200', 'autocomplete' => 'off')) }}
		</div>
		<div class="form-group">
			{{ Form::label('password_confirmation', 'Password confirm:') }}
			{{ Form::password('password_confirmation', array('class' => 'form-control width-200', 'autocomplete' => 'off')) }}
		</div>
		<div class="form-group">
			{{ Form::label('type', 'Type:') }}<br />
			{{ Form::select('type', $admin->isSuper() ? Admin::$types : Admin::$types_restricted, Input::old('type') ?: $admin->type, array('class' => 'form-control width-200', 'id' => 'admins-select-admin')) }}
		</div>
		
	</div>
	<div class="clearfix"></div>
	{{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
{{ Form::close() }}
@stop