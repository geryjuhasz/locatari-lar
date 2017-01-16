@extends ('layouts.dashboard')
@section('page_heading','Contoare')

@section('section')

<div class="pull-right">
	<a href="{{ URL::action('LocatarContor@create') }}" class="btn btn-default">Adauga contor</a>
</div>

<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>Contor</th>
            <th></th>
			<th></th>
		</tr>
		<tbody>
			@foreach($contoare as $c)
			<tr>
				<td>{{ $c->tipcontor->denumire }}</td>
                <td></td>          
				<td>
					{{ Form::open(array('action' => array('LocatarContor@destroy', $c->id), 'method' => 'delete')) }}
						<button type="submit" class="btn-link btn-confirm-submit">Delete</button>
					{{ Form::close() }}
				</td>
			</tr>
			@endforeach
		</tbody>
	</thead>
</table>
@stop