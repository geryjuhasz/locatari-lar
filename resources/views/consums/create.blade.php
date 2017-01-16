@extends ('layouts.dashboard')
@section('page_heading', 'Consum')
@section('section')

<div class="container consums">
{{ Form::open(array('action' => $action, 'method' => $method, 'class' => 'form-inline')) }}
    <hr />
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Contoare</th>
                <th>Index vechi</th>
                <th>Index nou</th>
                <th>Consum</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($consum as $cons)
            <tr>
            <td>
            {{ Form::label('contor',  $cons->tipcontor->denumire.': ', array('class' => 'form-label')) }}
            </td>
            <td>
            @if($cons->index_vechi != 0)
            {{ Form::text($cons->tipcontor->denumire.'_index_vechi', $cons->index_vechi, array('class' => 'form-control text-index-vechi', 'readonly')) }}
            @else
            {{ Form::text($cons->tipcontor->denumire.'_index_vechi', $cons->index_vechi, array('class' => 'form-control text-index-vechi')) }}
            @endif
            </td>
            <td>
            {{ Form::text($cons->tipcontor->denumire.'_index_nou', $cons->index_nou, array('class' => 'form-control text-index-nou')) }}
            </td>
            <td>
            {{ Form::text($cons->tipcontor->denumire.'_consum', $cons->consum, array('class' => 'form-control text-consum')) }}
            </td>
            </tr>
    @endforeach
    </tbody>
    </table>    
	{{ Form::submit('Submit', array('class' => 'btn btn-default')) }}
{{ Form::close() }}
</div>
@stop