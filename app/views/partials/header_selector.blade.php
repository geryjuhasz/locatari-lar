<?php
$asociatie = Asociatie::all();
$asociatie_id = getInputOrSession('asociatie_id');
?>
<?php
//if(Auth::user()->type == 'super') {
?>
<div class="">
    {{ Form::label('asociatie', 'Asociatia selectata: ', array('class' => 'left')); }}
    {{ Form::selectModel($asociatie, 'denumire', $asociatie_id, 'asociatie_id', array('class' => 'page-specifier form-control'), 'Alege asociatie   ') }}
</div>
<?php
//}
?>
