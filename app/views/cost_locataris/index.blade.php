@extends('layout')
@section('content')
<?php
$action = 'Cost_locatarisController@store';
$method = 'POST';

$luna = getInputOrSession('luna');
$asociatie_id = getInputOrSession('asociatie_id');
?>

<h2>Calcul asociatie:</h2>
{{ Form::open(array('action' => $action, 'method' => $method)) }}
<div class="col-3">
        {{ Form::label('luna', '', array('class' => 'form-label')) }}
        {{ Form::text('luna', $luna, array('class' => 'monthYearPick page-specifier form-control','placeholder' => 'Alege luna')) }}
        {{ Form::submit('Submit', array('class' => 'btn btn-default')) }}
        
</div>
{{ Form::close() }}
<div class="pull-right">
</div>
<script type="text/javascript">
options = {
    pattern: 'yyyy-mm', // Default is 'mm/yyyy' and separator char is not mandatory
    selectedYear: 2014,
    startYear: <?php echo date('Y'); ?>,
    finalYear: <?php echo date('Y', strtotime('+4Years')); ?>,
    monthNames: ['Ian', 'Feb', 'Mar', 'Apr', 'Mai', 'Iun', 'Iul', 'Aug', 'Sep', 'Oct', 'Noi', 'Dec']
};

$('#luna').monthpicker(options);
</script>
@stop