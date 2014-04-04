@extends('layout')
@section('content')

<h2>Administrare calcul asociatie:</h2>

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
@stop