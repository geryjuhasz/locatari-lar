@extends ('layouts.dashboard')
@section('page_heading','Administrare scari')

@section('section')

<div class="pull-right">
	<a href="{{ URL::action('ScarasController@create') }}" class="btn btn-default">Adauga scara</a>
</div>

<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>Denumire</th>
			<th>Bloc</th>
            <th>Total MP</th>
			<th>Total nr apartamente</th>
            <th></th>
            <th></th>
            <th></th>
		</tr>
		<tbody>
			@foreach($scara as $sscara)
			<tr>
				<td>{{ $sscara->denumire }}</td>
                <td>{{ $sscara->bloc_id ? $sscara->bloc->denumire : ''}}</td>
                <td>{{ $sscara->total_mp }}</td>
                <td>{{ $sscara->total_apartamente }}</td>
				<td><a href="{{ URL::action('ScarasController@edit', $sscara->id) }}">Edit</a></td>
				<td><a href="{{ URL::action('LocatarisController@index', array('scara_id' => $sscara->id)) }}">Locatari</a></td>
                <td>
					{{ Form::open(array('action' => array('ScarasController@destroy', $sscara->id), 'method' => 'delete')) }}
						<button type="submit" class="btn-link btn-confirm-submit">Delete</button>
					{{ Form::close() }}
				</td>
			</tr>
			@endforeach
		</tbody>
	</thead>
</table>
@stop