@extends ('layouts.dashboard')
@section('page_heading','Asociatii')

@section('section')
<div class="pull-right">
	<a href="{{ URL::action('AsociatiesController@create') }}" class="btn btn-primary">Adauga asociatie</a>
</div>

<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>Denumire</th>
			<th>Administrator</th>
                        <th></th>
                        <th></th>
			<th></th>
		</tr>
		<tbody>
			@foreach($asociatie as $aasociatie)
			<tr>
				<td>{{ $aasociatie->denumire }}</td>
                <td>{{ $aasociatie->admin_id ? $aasociatie->administrator->name : '' }}</td>
				<td><a href="{{ URL::action('AsociatiesController@edit', $aasociatie->id) }}">Editeaza</a></td>
				<td><a href="{{ URL::action('Calcul_asociatiesController@index', array('asociatie_id' => $aasociatie->id)) }}">Setari</a>
				</td>
                <td><a href="{{ URL::action('BlocsController@index', array('asociatie_id' => $aasociatie->id)) }}">Blocuri</a>
                </td>
                <td>
					{{ Form::open(array('action' => array('AsociatiesController@destroy', $aasociatie->id), 'method' => 'delete')) }}
						<button type="submit" class="btn-link btn-confirm-submit">Sterge</button>
					{{ Form::close() }}
				</td>
			</tr>
			@endforeach
		</tbody>
	</thead>
</table>
@stop