@extends('layout')
@section('content')

<h2>Administrare locatari</h2>
<div class="pull-right">
	<a href="{{ URL::action('LocatarisController@create') }}" class="btn btn-default">Adauga locatar</a>
</div>

<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>Numar apartament</th>
                        <th>Nume</th>
			<th>Scara</th>
                        <th>Suprafata MP</th>
                        <th>Numar persoane</th>
                        <th></th>
                        <th></th>
		</tr>
		<tbody>
			@foreach($locatari as $lloc)
			<tr>
				<td>{{ $lloc->nr_apartament }}</td>
                                <td>{{ $lloc->nume }}</td>
                                <td>{{ $lloc->scara_id ? $lloc->scara->denumire : ''}}
                                </td>
                                <td>{{ $lloc->suprafata_mp }}</td>
                                <td>{{ $lloc->nr_persoane }}</td>
				<td><a href="{{ URL::action('LocatarisController@edit', $lloc->id) }}">Edit</a></td>
				<td>
					{{ Form::open(array('action' => array('LocatarisController@destroy', $lloc->id), 'method' => 'delete')) }}
						<button type="submit" class="btn-link btn-confirm-submit">Delete</button>
					{{ Form::close() }}
				</td>
			</tr>
			@endforeach
		</tbody>
	</thead>
</table>
@stop