<?php
if(isset($admin)) {
	$action = array('AdminsController@update', $admin->id);
	$method = 'PUT';
} else {
	$admin = new Admin();
	$action = array('AdminsController@store');
	$method = 'POST';
}
$moduleRights = $admin->moduleRights();
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
			{{ Form::label('password', 'Password:') }}
			{{ Form::password('password', array('class' => 'form-control width-200', 'autocomplete' => 'off')) }}
		</div>
		<div class="form-group">
			{{ Form::label('password_confirmation', 'Password confirm:') }}
			{{ Form::password('password_confirmation', array('class' => 'form-control width-200', 'autocomplete' => 'off')) }}
		</div>
		<div class="form-group">
			{{ Form::label('type', 'Type:') }}<br />
			{{ Form::select('type', Auth::user()->isSuper() ? Admin::$types : Admin::$types_restricted, Input::old('type') ?: $admin->type, array('class' => 'form-control width-200', 'id' => 'admins-select-admin')) }}
		</div>
		@if(Auth::user()->isSuper())
		<div class="form-group" id="admins-select-country">
			{{ Form::label('fk_country', 'Country:') }}<br />
			{{ Form::selectModel(Country::all(), 'name', Input::old('fk_country') ?: $admin->fk_country, 'fk_country', array('class' => 'form-control width-200')) }}
		</div>
		@else
			{{ Form::hidden('fk_country', Auth::user()->fk_country) }}
		@endif
	</div>
	<div class="pull-left" id="admins-select-rights">
		<p class="lead">Editor rights</p>
		<table class="table">
			@foreach($modules as $module)
				<tr>
					<td class="margin-right-5"><span>{{ ucfirst($module->name) }}</span></td>
					@foreach(Right::$rights as $key => $value)
					<td>
						<div class="inline-block margin-right-10 margin-top-10">
							<?php $checked = isset($moduleRights[$module->id]) && in_array($key, $moduleRights[$module->id])? 'checked="checked"' : ''; ?>
							<input name="modules[{{ $module->id }}][]" type="checkbox" class="margin-right-5" value="{{ $key }}" {{ $checked }} />{{ $value }}
						</div>
					</td>
					@endforeach
				</tr>
			@endforeach
		</table>
	</div>
	<div class="clearfix"></div>
	{{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
{{ Form::close() }}
@stop