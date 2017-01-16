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


