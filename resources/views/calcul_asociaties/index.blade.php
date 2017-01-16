@extends ('layouts.dashboard')
@section('page_heading','Configurari asociatie')

@section('section')
<?php
    $method = 'PUT';
    $action = array('AsociatiesController@update', $asociatie_id);
    $defaultAction = URL::action('AsociatiesController@update', $asociatie_id);
    $asociatie = Asociatie::Find($asociatie_id);
?>

<h3>Repartizare cheltuieli</h3>
<div class="pull-right">
    <a href="{{ URL::action('Calcul_asociatiesController@create') }}" class="btn btn-default">Adauga tip calcul cheltuieli</a>
</div>
<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>Tip cheltuieli</th>
			<th>Tip calcul repartitie</th>
            <th>Tip repartitie</th>
			<th></th>
      	    <th></th>
            <th></th>
            <th></th>

		</tr>
		<tbody>
			@foreach($calcul as $ccalcul)
			<tr>
				<td>{{ $ccalcul->tipcheltuieli->denumire }}</td>
                <td>{{ $ccalcul->tipcalculrepartitie->denumire }}</td>
                <td>{{ $ccalcul->tiprepartitie->denumire }}</td>
                <td></td>
                <td>{{ $ccalcul->created_at }}</td>
				<td><a href="{{ URL::action('Calcul_asociatiesController@edit', $ccalcul->id) }}">Edit</a></td>
                <td>
					{{ Form::open(array('action' => array('Calcul_asociatiesController@destroy', $ccalcul->id), 'method' => 'delete')) }}
						<button type="submit" class="btn-link btn-confirm-submit">Delete</button>
					{{ Form::close() }}
				</td>
			</tr>
			@endforeach
		</tbody>
	</thead>
</table>

<h3>Contoare</h3>
<div class="pull-right">
    <a href="{{ URL::action('Asociatie_consumsController@create') }}" class="btn btn-default">Adauga tip consum</a>
</div>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Tip consum</th>
            <th>Tip contor</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>

        </tr>
        <tbody>
        @foreach($consum as $cconsum)
        <tr>
            <td>{{ $cconsum->tipconsum->denumire }}</td>
            <td>{{ $cconsum->tipcontor->denumire }}</td>
            <td><a href="{{ URL::action('Asociatie_consumsController@edit', $cconsum->id) }}">Edit</a></td>
            <td>
                {{ Form::open(array('action' => array('Asociatie_consumsController@destroy', $cconsum->id), 'method' => 'delete')) }}
                    <button type="submit" class="btn-link btn-confirm-submit">Delete</button>
                {{ Form::close() }}
            </td>
        </tr>
        @endforeach
        </tbody>
    </thead>
</table>

<div class="pull-left">
    <span>Tipuri consum:</span>
    {{ Form::open(array('action' => $action, 'method' => $method)) }}
        {{ Form::checkbox('consum_apa', 'Consum apa', Input::old('consum_caldura')?: $asociatie->consum_apa); }}Consum apa
        <br/>
        {{ Form::checkbox('consum_caldura', 'Consum caldura' , Input::old('consum_caldura')?: $asociatie->consum_caldura); }}Consum caldura
        <br/>
        <button type="submit" class="btn-button">Save</button>
    {{ Form::close() }}
</div>
@stop