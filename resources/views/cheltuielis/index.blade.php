@extends ('layouts.dashboard')
@section('page_heading','Administrare cheltuieli asociatie')

@section('section')

<div class="pull-right">
	<a href="{{ URL::action('CheltuielisController@create') }}" class="btn btn-default">Introdu cheltuieli</a>
</div>

<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>Cheltuieli</th>
			<th>Furnizor</th>
			<th>Luna</th>
            <th>Suma</th>
  			<th>Data introducerii</th>
            <th></th>
            <th></th>

		</tr>
		<tbody>
			@foreach($cheltuieli as $ccheltuieli)
			<tr>
				<td>{{ $ccheltuieli->tipcheltuieli->denumire }}</td>
				<td>{{ $ccheltuieli->furnizori->nume }}</td>
                <td>{{ $ccheltuieli->luna }}</td>
                <td>{{ $ccheltuieli->suma }}</td>
                <td>{{ $ccheltuieli->created_at }}</td>
				<td><a href="{{ URL::action('CheltuielisController@edit', $ccheltuieli->id) }}">Edit</a></td>
                <td>
					{{ Form::open(array('action' => array('CheltuielisController@destroy', $ccheltuieli->id), 'method' => 'delete')) }}
						<button type="submit" class="btn-link btn-confirm-submit">Delete</button>
					{{ Form::close() }}
				</td>
			</tr>
			@endforeach
		</tbody>
	</thead>
</table>
@stop