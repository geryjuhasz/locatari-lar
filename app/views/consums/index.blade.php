@extends('layout')
@section('content')
<?php

$asociatie_id = getInputOrSession('asociatie_id');
$bloc_id = getInputOrSession('bloc_id');
$scara_id = getInputOrSession('scara_id');
$tipconsum_id = getInputOrSession('tipconsum_id');
$luna = getInputOrSession('luna');

$bloc = Bloc::where('asociatie_id', '=', $asociatie_id)->get();
$scara = Scara::where('bloc_id', '=', $bloc_id)->get();
$tipconsum = Tipconsum::all();

?>
<h2>Consum asociatie:</h2>

<div class="col-3">
        {{ Form::selectModel($bloc, 'denumire', $bloc_id, 'bloc_id', array('class' => 'page-specifier form-control'), 'Alege bloc') }}
        {{ Form::selectModel($scara, 'denumire', $scara_id, 'scara_id', array('class' => 'page-specifier form-control'), 'Alege scara') }}
</div>

<div class="col-3">
        {{ Form::label('luna', '', array('class' => 'form-label')) }}{{ Form::text('luna', $luna, array('class' => 'monthYearPick page-specifier form-control','placeholder' => 'Alege luna')) }}
        
</div>

<div class="col-3">
        {{ Form::selectModel($tipconsum, 'denumire', $tipconsum_id, 'tipconsum_id', array('class' => 'page-specifier form-control'), 'Alege consum') }}
</div>

<table class="table table-striped table-hover">
	<thead>
		<tr>
                    @foreach ($tabel as $t)
                        <th>{{ $t }}</th>	
                    @endforeach
                    <th>Editare</th>
                    
		</tr>
                
		<tbody>
			@foreach($consum as $cons)
			<tr>
                            <?php 
                            if(isset($cons['locatar_id'])) {
                                $locatar_id = $cons['locatar_id'];
                                unset($cons['locatar_id']);
                            }
                            ?>
                            @foreach ($cons as $c)
                                <td>{{ $c }}</td>
                            @endforeach
                            <td><a href="{{ URL::action('ConsumsController@create', array('locatar_id' => $locatar_id)) }}" class="btn btn-default">Consum</a></td>
                        </tr>
			@endforeach
		</tbody>
	</thead>
</table>
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