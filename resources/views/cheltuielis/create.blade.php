@extends ('layouts.dashboard')
@section('page_heading', 'Cheltuieli')
@section('section')

<?php
if(!empty($cheltuieli)) {
	$action = array('CheltuielisController@update', $cheltuieli->id);
	$method = 'PUT';
	$header = "Modifica";
} else {
	$action = 'CheltuielisController@store';
	$method = 'POST';
	$cheltuieli = new Cheltuieli();
        $header = "Introdu cheltuieli";
}
?>

<div class="col-4">
	<h3>{{ $header }}</h3>
	{{ Form::open(array('action' => $action, 'method' => $method, 'id' => 'create-cheltuieli')) }}
        <div class="row">
            <div class="col-xs-8">
                {{ Form::label('tipcheltuieli_id', 'Tip cheltuieli: ', array('class' => 'form-label')) }}
		          {{ Form::select('tipcheltuieli_id', $tipcheltuieli, $cheltuieli->tipcheltuieli_id, array('class' => 'form-control width-200')) }}
            </div>  
            <div class="col-xs-4"></div>
        </div>  

        <div class="row">
            <div class="col-xs-8">
            {{ Form::label('furnizor_id', 'Furnizor: ', array('class' => '')) }}
            {{ Form::selectModel($furnizori, 'nume', $furnizor_id, 'furnizor_id', array('class' => 'form-control'), 'Alege furnizor') }}
            </div>  
            <div class="col-xs-4">
            <a href="{{ URL::action('FurnizorController@create') }}" class="btn btn-primary">Introdu furnizor</a>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-8">
            {{ Form::label('tipdocument_id', 'Tip document: ', array('class' => '')) }}
            {{ Form::selectModel($tipdocument, 'denumire', $tipdocument_id, 'tipdocument_id', array('class' => 'form-control'), 'Alege tip document') }}
            </div>  
            <div class="col-xs-4"></div>
        </div>

        <div class="row">
            <div class="col-xs-8">
            {{ Form::label('data_doc', 'Data: ', array('class' => 'form-label')) }}
            {{ Form::text('data_doc', $cheltuieli->data, array('class' => 'form-control','placeholder' => 'Alege data', 'id' => 'datepicker')) }}
            </div>  
            <div class="col-xs-4"></div>
        </div>  

        <div class="row">
            <div class="col-xs-8">
                {{ Form::label('suma', 'Suma: ', array('class' => 'form-label')) }}
                {{ Form::text('suma', $cheltuieli->suma, array('class' => 'form-control')) }}
            </div>  
            <div class="col-xs-4"></div>
        </div> 

        <div class="row">
            <div class="col-xs-8">
        {{ Form::label('detalii', 'Detalii: ', array('class' => 'form-label')) }}
        {{ Form::text('detalii', $cheltuieli->detalii, array('class' => 'form-control')) }}
            </div>  
            <div class="col-xs-4"></div>
        </div> 

        <div class="row">
            <div class="col-xs-8">
                {{ Form::label('consum', 'Consum de pe factura: ', array('class' => 'form-label')) }}
                {{ Form::text('consum', $cheltuieli->consum, array('class' => 'form-control')) }}
            </div>  
            <div class="col-xs-4"></div>
        </div>      

        <div class="row">
            <div class="col-xs-8">
                {{ Form::label('object_id', 'Repartizare catre: ', array('class' => 'form-label')) }}
                {{ Form::radioList('object_id', $tiprepartitie, 'denumire', 1,  array()) }}
            </div>  
            <div class="col-xs-4"></div>
        </div>  
        
        <div class="row">
            <div class="col-xs-8">
                {{ Form::label('luna', 'Repartizare in luna: ', array('class' => 'form-label')) }}
                {{ Form::text('luna', $cheltuieli->luna, array('class' => 'monthYearPick form-control','placeholder' => 'Alege luna')) }}
            </div>  
            <div class="col-xs-4"></div>
        </div>
		<br/>
        <div class="row">
            <div class="col-xs-4">
    		{{ Form::submit('Submit', array('class' => 'btn btn-primary btn-lg')) }}
            </div>
         </div>
	{{ Form::close() }}
</div>
 
@stop