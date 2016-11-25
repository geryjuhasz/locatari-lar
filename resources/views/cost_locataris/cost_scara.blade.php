<br/>
<h3>{{$denumire_scara}}</h3>
<table class="table table-striped table-hover">
	<tr>
			<th>Locatar</th>
			<th>Cheltuieli pe pers.</th>
                        <th>Apa rece</th>
                        <th>Dif apa rece</th>
			<th>Apa calda</th>
                        <th>Dif apa calda</th>
                        <th>Cheltuieli CPI</th>
                        <th>Cheltuieli specifice</th>
                        <th>Taxa elsaco</th>
                        <th>Caldura</th>
                        <th>Fond rulment</th> 
                        <th>Total chelt.</th>
                        
        </tr>
       
	<tbody>
			@foreach($cost_scara as $cost)
			<tr>
                            <td>{{ $cost->locatari->nume }}</td>
                            <td>{{ $cost->costuri_persoana }}</td>
                            <td>{{ $cost->apa_rece }}</td>
                            <td>{{ $cost->dif_apa_rece }}</td>
                            <td>{{ $cost->apa_calda }}</td>
                            <td>{{ $cost->dif_apa_calda }}</td>
                            <td>{{ $cost->costuri_comune }}</td>
                            <td>{{ $cost->costuri_specifice }}</td>
                            <td>{{ $cost->taxa_elsaco }}</td>
                            <td>{{ $cost->caldura }}</td>
                            <td>{{ $cost->fond_rulment }}</td>
                            <td>{{ $cost->total }}</td>
                        </tr>
			@endforeach
	</tbody>
        
</table>
