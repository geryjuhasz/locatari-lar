@extends('layout')
@section('content')
<?php

$asociatie_id = getInputOrSession('asociatie_id');
$bloc_id = getInputOrSession('bloc_id');
$scara_id = getInputOrSession('scara_id');
$tipconsum_id = getInputOrSession('tipconsum_id');

$bloc = Bloc::where('asociatie_id', '=', $asociatie_id)->get();
$scara = Scara::where('bloc_id', '=', $bloc_id)->get();
$tipconsum = Tipconsum::all();

$locatari = $consum['Locatari'];
if($consum['Consum']!=null) $consums = $consum['Consum'];
else $consums = array();

?>
<h2>Consum asociatie:</h2>

<div class="col-3">
        {{ Form::selectModel($bloc, 'denumire', $bloc_id, 'bloc_id', array('class' => 'page-specifier form-control'), 'Alege bloc') }}
        {{ Form::selectModel($scara, 'denumire', $scara_id, 'scara_id', array('class' => 'page-specifier form-control'), 'Alege scara') }}
</div>

<div class="col-3">
        {{ Form::text('luna', '', array('class' => 'datepicker form-control hasDatepicker','placeholder' => 'Luna','data-datepicker' => 'datepicker')) }}
        {{ Form::submit('Afiseaza', array('class' => 'btn btn-default')) }}
</div>

<div class="col-3">
        {{ Form::selectModel($tipconsum, 'denumire', $tipconsum_id, 'tipconsum_id', array('class' => 'page-specifier form-control'), 'Alege consum') }}
</div>

<div class="pull-right">
	<a href="{{ URL::action('CheltuielisController@create') }}" class="btn btn-default">Introdu consum</a>
</div>

<table class="table table-striped table-hover">
	<thead>
		<tr>
                    <th width='20px'>Nr.apartament</th>	
                    <th width='50px'>Locatari</th>
                    <th colspan="{{ count($consums) }}">Consum</th>
                    <th>Editare</th>
                    
		</tr>
                <tr>
                    <th colspan="2"></th>	
                    @foreach($consums as $cconsum)
                        <th colspan="2">{{ $cconsum['Name'] }}</th>
                    @endforeach

                    <th></th>
		</tr>
		<tbody>
			@foreach($locatari as $locatar)
			<tr>
                            <td>{{ $locatar->nr_apartament }}</td>	
                            <td>{{ $locatar->nume }}</td>
                            <?php
                            foreach ($consums as $c1) {
                                $c2 = $c1['Consum']; 
                                foreach ($c2 as $c3) {
                                    if ($c3->nr_apartament == $locatar->nr_apartament) {
                                        ?>
                                        <td>Rece {{ $c3->index_vechi_rece }} => {{ $c3->index_nou_rece }} => {{ $c3->index_nou_rece - $c3->index_vechi_rece }}</td>
                                        <td>Calda {{ $c3->index_vechi_calda }} => {{ $c3->index_nou_calda }} => {{ $c3->index_nou_calda - $c3->index_vechi_calda }}</td>
                                        <?php
                                    }  
                                }
                            }
                            ?>
                            <td><a href="{{ URL::action('ConsumsController@edit', $locatar->id) }}" target='_blank'>Edit</a></td>
                        </tr>
                        
			@endforeach
		</tbody>
	</thead>
</table>
@stop