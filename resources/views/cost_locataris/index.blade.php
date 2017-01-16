@extends ('layouts.dashboard')
@section('page_heading','Calcul asociatie')

@section('section')
<?php
$action = 'Cost_locatarisController@store';
$method = 'POST';

$luna = getInputOrSession('luna');
$asociatie_id = getInputOrSession('asociatie_id');

//var_dump($costuri);
//die();
?>
{{ Form::open(array('action' => $action, 'method' => $method)) }}
<div class="col-3">
        {{ Form::label('luna', '', array('class' => 'form-label')) }}
        {{ Form::text('luna', $luna, array('class' => 'monthYearPick page-specifier form-control','placeholder' => 'Alege luna')) }}
        {{ Form::submit('Submit', array('class' => 'btn btn-default')) }}
        
</div>
{{ Form::close() }}
<div>
</div>

<br/>

@foreach($costuri as $cost)
    @include('cost_locataris.cost_scara', array('cost_scara'=>$cost['cost'], 'denumire_scara'=>$cost['scara']))
@endforeach

@stop