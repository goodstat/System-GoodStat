<?php
	//szukania najwiecej wizyt w miesiacach roku	
	$tablica = array(); //zainicjowanie tablicy bez wartosci

	for($a=1; $a<=12; $a++){
		szukaj_danych3($_GET['rok'].'_wiz_ods', 'ods', "$a", $_GET['rok']); //wymikiem jest zmienna $suma
		$tablica[] = $suma;
	}
		rsort($tablica); 
		$naj = $tablica[0];

	//szukanie danych
	for($a=1; $a<=12; $a++){
		szukaj_danych3($_GET['rok'].'_wiz_ods', 'ods', "$a", $_GET['rok']); //wymikiem jest zmienna $suma
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

	wyk_odslon_rok($dane, $naj, $_GET['rok']);	
	
	echo'<hr />';
	
	echo'
	<div class="table-responsive">
		<table class="table table-striped table-hover small table-sm">
		<tr>
			<th>rok</th> <th>miesiąc</th> <th>odsłony</th> <th>wykres</th>
		</tr>';
	
				reset($dane); // wskazanie na poczڴek tablicy
				$wartosc = current($dane);
				
				if($od==0){$a = -1;}	

			while(list($index, $wartosc) = each( $dane))
			{
				$a++;
				
				if($index == '0'){$miesiac = 'Styczeń'; $m = 1;}
				if($index == '1'){$miesiac = 'Luty'; $m = 2;}
				if($index == '2'){$miesiac = 'Marzec'; $m = 3;}
				if($index == '3'){$miesiac = 'Kwiecień'; $m = 4;}
				if($index == '4'){$miesiac = 'Maj'; $m = 5;}
				if($index == '5'){$miesiac = 'Czerwiec'; $m = 6;}
				if($index == '6'){$miesiac = 'Lipiec'; $m = 7;}
				if($index == '7'){$miesiac = 'Sierpień'; $m = 8;}
				if($index == '8'){$miesiac = 'Wrzesień'; $m = 9;}
				if($index == '9'){$miesiac = 'Październik'; $m = 10;}
				if($index == '10'){$miesiac = 'Listopad'; $m = 11;}
				if($index == '11'){$miesiac = 'Grudzień'; $m = 12;}
				
				if($wartosc != 0){
					// obliczanie wysokosci slupka
					$szer = ($wartosc / $naj) * 200; $szer = round($szer, 0);
				}else{$szer = 1;}
				
			echo'
			<tr>
				<td class="text-muted">'.$_GET['rok'].'</td> <td class="text-muted"><a href="odslony.php?rok='.$_GET['rok'].'&m='.$m.'" role="button" data-toggle="tooltip" data-placement="right" title="Zobacz odsłony w miesiącu: '.$miesiac.'">'.$miesiac.'</a></td> <td><span class="label-dane">'.$wartosc.'</span></td> <td><div class="row_slupki_poziom ttt" style="width: '.$szer.'px;" data-toggle="tooltip" data-placement="right" title="'.$miesiac.' '.$_GET['rok'].', '.$wartosc.' ods."></div></td> 
			</tr>';

			}//zam while
	
				echo'
				<tr>
					<th colspan="2">średnio odsłon/miesiąc:</th> <th><span class="label-dane">'.$sr.'</span></th> <th></th> 
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
		<i class="material-icons">live_help</i> Odsłona - Co to znaczy ?
	</button>
</p>
<div class="collapse" id="collapseExample">
	<div class="card card-body">
		Odsłona jest to zdarzenie polegające na obejrzeniu monitorowanej strony, liczba ta zwykle jest większa od liczby Wizyt, ponieważ jeden Nr. IP (jedna Wizyta), może generować kilka odsłon, można powiedzieć że liczba Odsłon to nic innego jak liczba przeładowań (odświeżeń) monitorowanej strony. 
	</div>
</div>

		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		