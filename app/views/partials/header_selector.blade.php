<?php
if(Auth::user()->type == 'super') {
    $asociatie = Asociatie::all();
} elseif(Auth::user()->type == 'admin') { 
    $asociatie = Asociatie::where('admin_id', '=', Auth::user()->id)->get();
}
$asociatie_id = getInputOrSession('asociatie_id');
?>
<?php
if(Auth::user()->type == 'super' || Auth::user()->type == 'admin') {
?>
<div class="">
    {{ Form::label('asociatie', 'Asociatia selectata: ', array('class' => 'left')); }}
    {{ Form::selectModel($asociatie, 'denumire', $asociatie_id, 'asociatie_id', array('class' => 'page-specifier form-control'), 'Alege asociatie   ') }}
</div>
<?php
}
?>
