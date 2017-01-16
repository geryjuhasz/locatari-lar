<?php
Form::macro('radioList', function($name ='group-name', $model, $property, $checked, $attrs = array()) {
	
	$items  = "<div class='radio'>";
  	foreach($model as $item) {
  		$items .= Form::radio($name, $item->id, ($checked == $item->id) ? true : false, $attrs);
		$items .=  Form::label('tiprepartitie_label', $item->$property, array('class' => 'form-label'));
		//$arr[$item->id] = ucfirst($item->$property);
		$items .= "<br/>";
	}	
  	
  	$items .= "</div>";
	return $items;
});


Form::macro('radioRepartitie', function($name ='group-name', $model, $property, $checked, $attrs = array()) {
	
	$items  = "<div class='radio'>";
  	foreach($model as $item) {
  		$items .= Form::radio($name, $item->id, ($checked == $item->id) ? true : false, $attrs);
		$items .=  Form::label('tiprepartitie_label', $item->$property, array('class' => 'form-label'));


		$items .=  Form::selectModel('tiprepartitie_label', $item->$property, array('class' => 'form-label'));
		//$arr[$item->id] = ucfirst($item->$property);
		$items .= "<br/>";
	}	
  	
  	$items .= "</div>";
	return $items;
});


