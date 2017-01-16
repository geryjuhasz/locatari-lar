@extends ('layouts.dashboard')
@section('page_heading','Consum')

@section('section')
<?php 
$action = 'ConsumsController@select';
$method = 'POST';
?>
<div class="pull-right">
    <a href="{{ URL::action('ConsumsController@generate') }}" class="btn btn-primary">Genereaza consum</a>
</div>
{{ Form::open(array('action' => $action, 'method' => $method, 'class' => 'form-inline')) }}
<div class="form-group">
        {{ Form::selectModel($bloc, 'denumire', $bloc_id, 'bloc_id', array('class' => 'page-specifier form-control', 'onchange' => 'this.form.submit()'), 'Alege bloc') }}
</div>
<div class="form-group">
        {{ Form::selectModel($scara, 'denumire', $scara_id, 'scara_id', array('class' => 'page-specifier form-control', 'id' => 'selectScara', 'onchange' => 'this.form.submit()'), 'Alege scara') }}
</div>
<div class="form-group">
        {{ Form::label('luna', '', array('class' => 'form-label')) }}{{ Form::text('luna', $luna, array('class' => 'monthYearPick page-specifier form-control','placeholder' => 'Alege luna', 'onchange' => 'this.form.submit()')) }}
        
</div>
{{ Form::close() }}

<table class="table table-striped table-hover">
	<thead>
		<tr>
            <th>Nr. ap.</th> 
            <th>Nume locatar</th>   
            <th colspan="4"></th>
            <th></th>
		</tr>
    </thead>
       
	<tbody>
			@foreach($locatari as $l)
			<tr>
                <td>{{ $l->nr_apartament }}</td>
                <td>{{ $l->nume }}</td>
                <td colspan="4">
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
                    @foreach($consum[$l->id] as $c)
                    <tr>
                        <td>
                        {{ $c->tipcontor->denumire }}
                        </td>
                        <td>
                        {{ $c->index_vechi }}
                        </td>
                        <td>
                        {{ $c->index_nou }}
                        </td>
                        <td>
                        {{ $c->index_nou - $c->index_vechi }}
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                    </table>
                </td>
                <td><a href="{{ URL::action('ConsumsController@create', array('locatar_id' => $l->id)) }}" class="btn btn-default">Editare</a></td>
            </tr>
			@endforeach
	</tbody>
        <tfoot>       
        <tr>
            @foreach ($tabelfooter as $tf)
                <td>{{ $tf }}</td>	
            @endforeach
            <td></td>
        </tfoot>
</table>
@stop