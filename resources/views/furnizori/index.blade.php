@extends ('layouts.dashboard')
@section('page_heading','Furnizori')

@section('section')

<div class="pull-right">
	<a href="{{ URL::action('FurnizorController@create') }}" class="btn btn-default">Adauga furnizor</a>
</div>

<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>Nume</th>
            <th>Cod fiscal</th>
			<th>Email</th>
            <th>Suprafata MP</th>
            <th>Numar persoane</th>
            <th></th>
            <th></th>
		</tr>
		<tbody>
			@foreach($furnizori as $fur)
			<tr>
				<td>{{ $fur->nume }}</td>
                <td>{{ $fur->codfiscal }}</td>
                <td></td>
                <td></td>
				<td><a href="{{ URL::action('FurnizorController@edit', $fur->id) }}">Edit</a></td>
				<td>
					{{ Form::open(array('action' => array('FurnizorController@destroy', $fur->id), 'method' => 'delete')) }}
						<button type="submit" class="btn-link btn-confirm-submit">Delete</button>
					{{ Form::close() }}
				</td>
			</tr>
			@endforeach
		</tbody>
	</thead>
</table>
@stop