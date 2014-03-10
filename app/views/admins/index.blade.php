@section('content')
<div class="col-12">
	<a href="{{ URL::action('AdminsController@create') }}" class="btn btn-default">Add admin</a>
	<table class="table table-striped table-hover">
		<thead>
			<th>#</th>
			<th>Name</th>
			<th>Type</th>
			<th>Country</th>
			<th></th>
			<th></th>
			<th></th>
		</thead>
		<tbody>
		@foreach($admins as $admin)
			<tr>
				<td>{{ $admin->id }}</td>
				<td>{{ $admin->name }}</td>
				<td>{{ $admin->type }}</td>
				<td>{{ $admin->country? $admin->country->name: '' }}</td>
				<td><a href="{{ URL::action('AdminsController@edit', $admin->id) }}">Edit</a></td>
				<td>
					{{ Form::open(array('action' => array('AdminsController@destroy', $admin->id), 'method' => 'DELETE')) }}
						<input type="submit" value="Delete" class="btn-confirm-submit btn btn-danger" />
					{{ Form::close() }}
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
</div>	
@stop