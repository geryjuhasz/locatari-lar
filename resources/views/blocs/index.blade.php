@extends ('layouts.dashboard')
@section('page_heading','Administrare blocuri')

@section('section')
<div class="pull-right">
	<a href="{{ URL::action('BlocsController@create') }}" class="btn btn-default">Adauga bloc</a>
</div>

<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>Denumire</th>
			<th>Asociatie</th>
                        <th></th>
			<th></th>
		</tr>
		<tbody>
			@foreach($bloc as $bbloc)
			<tr>
				<td>{{ $bbloc->denumire }}</td>
                                <td>{{ $bbloc->asociatie_id ? $bbloc->asociatie->denumire : ''}}
                                </td>
				<td><a href="{{ URL::action('BlocsController@edit', $bbloc->id) }}">Edit</a></td>
				<td><a href="{{ URL::action('ScarasController@index', array('bloc_id' => $bbloc->id)) }}">Scari</a></td>
                                <td>
					{{ Form::open(array('action' => array('BlocsController@destroy', $bbloc->id), 'method' => 'delete')) }}
						<button type="submit" class="btn-link btn-confirm-submit">Delete</button>
					{{ Form::close() }}
				</td>
			</tr>
			@endforeach
		</tbody>
	</thead>
</table>
@stop