<?php
	$tablica = array(); //zainicjowanie tablicy bez wartosci

	for($a=1; $a<=12; $a++){
		szukaj_danych3($_GET['rok'].'_wiz_ods', 'wiz', "$a", $_GET['rok']); //wymikiem jest zmienna $suma
		$tablica[] = $suma;
	}
		rsort($tablica); 
		$naj = $tablica[0];

	//szukanie danych
	for($a=1; $a<=12; $a++){
		szukaj_danych3($_GET['rok'].'_wiz_ods', 'wiz', "$a", $_GET['rok']); //wymikiem jest zmienna $suma
		$dane[] = $suma;
	}
	
	//zliczanie wszystkich wizyt w roku
	$suma_wartosci = 0;
	for($a=0; $a < count($dane); $a++){$wartosc = $dane[$a]; $suma_wartosci = $suma_wartosci + $wartosc;}
	$sr = $suma_wartosci / 12; $sr = number_format ($sr, 1);

	/*
	echo '<pre>';
		print_r($dane);
	echo '</pre>';
	*/	
?>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
	<canvas id="myChart" style="width: 1000px;" class="chart-container"></canvas>
	<script>
	var ctx = document.getElementById("myChart").getContext('2d');
	var myChart = new Chart(ctx, {
		type: '<?php echo $_SESSION['sesja_uzyt']['wykres']; ?>',	/* bar, line, radar, polarArea */
		data: {
			labels: [
			
<?php
//wysw miesiace
for ($i = 0; $i < count($dane); $i++) {
	
	if($i == '0'){$miesiac = 'Styczeń'; $m = 1; echo "\"".$miesiac."\",";}else
	if($i == '1'){$miesiac = 'Luty'; $m = 2; echo "\"".$miesiac."\",";}else
	if($i == '2'){$miesiac = 'Marzec'; $m = 3; echo "\"".$miesiac."\",";}else
	if($i == '3'){$miesiac = 'Kwiecień'; $m = 4; echo "\"".$miesiac."\",";}else
	if($i == '4'){$miesiac = 'Maj'; $m = 5; echo "\"".$miesiac."\",";}else
	if($i == '5'){$miesiac = 'Czerwiec'; $m = 6; echo "\"".$miesiac."\",";}else
	if($i == '6'){$miesiac = 'Lipiec'; $m = 7; echo "\"".$miesiac."\",";}else
	if($i == '7'){$miesiac = 'Sierpień'; $m = 8; echo "\"".$miesiac."\",";}else
	if($i == '8'){$miesiac = 'Wrzesień'; $m = 9; echo "\"".$miesiac."\",";}else
	if($i == '9'){$miesiac = 'Październik'; $m = 10; echo "\"".$miesiac."\",";}else
	if($i == '10'){$miesiac = 'Listopad'; $m = 11; echo "\"".$miesiac."\",";}else
	if($i == '11'){$miesiac = 'Grudzień'; $m = 12; echo "\"".$miesiac."\",";}
}
?>
			
			
			],
			datasets: [{
				label: '<?php echo"Wizyty"; ?>',
				data: [
<?php
//ilosc wizyt dane
for ($i = 0; $i < count($dane); $i++) {
	
	echo $dane[$i].',';
	
}
?>
					
					
					],
				backgroundColor: [
				
<?php
//kolor slupka
for ($i = 0; $i < count($dane); $i++) {
	
	echo "'rgba(54, 162, 235, 0.5)',";
	
}
?>
				],
				borderColor: [
				
<?php
//kolor obramowania slupka
for ($i = 0; $i < count($dane); $i++) {
	
	echo "'rgba(54, 162, 235, 1)',";
	
}
?>

				],
				borderWidth: 1
			}]
		},
		options: {
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero:true
					}
				}]
			}
		}
	});
	</script>



<?php	
	echo'
	<div class="table-responsive">
		<table class="table table-striped table-hover small table-sm">
		<tr>
			<th>rok</th> <th>miesiąc</th> <th>wizyty</th> <th>wykres</th> 
		</tr>';
	
				reset($dane); // wskazanie na poczڴek tablicy
				$wartosc = current($dane);
				
				if($od==0){$a = -1;}	
				
for ($i = 0; $i < count($dane); $i++) 
	
//			while(list($index, $wartosc) = each( $dane))
			{
				$a++;
				
				if($i == '0'){$miesiac = 'Styczeń'; $m = 1;}
				if($i == '1'){$miesiac = 'Luty'; $m = 2;}
				if($i == '2'){$miesiac = 'Marzec'; $m = 3;}
				if($i == '3'){$miesiac = 'Kwiecień'; $m = 4;}
				if($i == '4'){$miesiac = 'Maj'; $m = 5;}
				if($i == '5'){$miesiac = 'Czerwiec'; $m = 6;}
				if($i == '6'){$miesiac = 'Lipiec'; $m = 7;}
				if($i == '7'){$miesiac = 'Sierpień'; $m = 8;}
				if($i == '8'){$miesiac = 'Wrzesień'; $m = 9;}
				if($i == '9'){$miesiac = 'Październik'; $m = 10;}
				if($i == '10'){$miesiac = 'Listopad'; $m = 11;}
				if($i == '11'){$miesiac = 'Grudzień'; $m = 12;}
				
				if($dane[$i] != 0){
					// obliczanie wysokosci slupka
					$szer = ($dane[$i] / $naj) * 200; $szer = round($szer, 0);
				}else{$szer = 1;}
				
			echo'
			<tr>
				<td class="text-muted">'.$_GET['rok'].'</td> <td class="text-muted"><a href="wizyty.php?rok='.$_GET['rok'].'&m='.$m.'" role="button" data-toggle="tooltip" data-placement="right" title="Zobacz wizyty w miesiącu: '.$miesiac.'">'.$miesiac.'</a></td> <td><span class="label-dane">'.$dane[$i].'</span></td> <td><div class="row_slupki_poziom ttt" style="width: '.$szer.'px;" data-toggle="tooltip" data-placement="right" title="'.$miesiac.' '.$_GET['rok'].', '.$dane[$i].' wiz."></div></td> 
			</tr>';

			}//zam while
	
				echo'
				<tr>
					<th colspan="2">średnio wizyt/miesiąc:</th> <th><span class="label-dane">'.$sr.'</span></th> <th></th> 
				</tr>
				<tr>
					<th colspan="2">suma:</th> <th><span class="label-dane">'.$suma_wartosci.'</span></th> <th></th> 
				</tr>';

	
	echo'
		</table>
	';
	
	echo'</div>';
?>

	<hr />
	
<p>
	<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
		<i class="material-icons">live_help</i> Wizyta - Co to znaczy ?
	</button>
</p>
<div class="collapse" id="collapseExample">
	<div class="card card-body">
		Wizyta jest to ciąg następujących po sobie odsłon wykonanych przez jednego użytkownika w ramach jednej witryny i tego samego numeru IP. Ilość wizyt pokazuje ilość numerów IP, które odwiedziły monitorowaną stronę www. 
	</div>
</div>

		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		