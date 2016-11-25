<?php

Form::macro('selectModel', function($model, $property, $selected, $name, $htmlProperties = array(), $zero = '') {
	$arr = array();
	if($zero) {
		$arr['0'] = $zero;
	}
	foreach($model as $item) {
		$arr[$item->id] = ucfirst($item->$property);
	}
	return Form::select($name, $arr, $selected, $htmlProperties);
});

Form::macro('selectSource', function($name, $selected, $htmlProperties, $zero = false) {
	$arr = array();
	if($zero) $arr['all'] = 'All';
	$arr['organic'] = 'Organic'; $arr['import'] = 'Import';
	
	return Form::select($name, $arr, $selected, $htmlProperties);
});


