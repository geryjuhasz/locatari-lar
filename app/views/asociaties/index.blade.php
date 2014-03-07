@extends('layout')
@section('content')

<h2>Administrare asociatii</h2>
<div class="pull-right">
	<a href="{{ URL::action('AsociatiesController@create') }}" class="btn btn-default">Adauga asociatie</a>
</div>

<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>Denumire</th>
			<th>Administrator</th>
                        <th></th>
			<th></th>
		</tr>
		<tbody>
			@foreach($asociatie as $aasociatie)
			<tr>
				<td>{{ $aasociatie->denumire }}</td>
                                <td>{{ $aasociatie->administrator }}</td>
				<td><a href="{{ URL::action('AsociatiesController@edit', $aasociatie->id) }}">Edit</a></td>
				<td>
					{{ Form::open(array('action' => array('AsociatiesController@destroy', $aasociatie->id), 'method' => 'delete')) }}
						<button type="submit" class="btn-link btn-confirm-submit">Delete</button>
					{{ Form::close() }}
				</td>
			</tr>
			@endforeach
		</tbody>
	</thead>
</table>
@stop