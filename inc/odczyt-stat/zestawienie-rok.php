<?php
	echo'<p class="lead text-right"><b>'.$_GET['rok'].' rok</b> - <b>Zestawienie</b></p>';
//######################### WIZYTY
	//szukania najwiecej wizyt w miesiacach roku	
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

//	wyk_wizyt_rok($dane, $naj, $_GET['rok']);	

//######################### ODSLONY
	//szukania najwiecej odslon w miesiacach roku	
	$tablica = array(); //zainicjowanie tablicy bez wartosci

	for($a=1; $a<=12; $a++){
		szukaj_danych3($_GET['rok'].'_wiz_ods', 'ods', "$a", $_GET['rok']); //wymikiem jest zmienna $suma
		$tablica[] = $suma;
	}
		rsort($tablica); 
		$naj_ods = $tablica[0];
	//szukanie danych
	for($a=1; $a<=12; $a++){
		szukaj_danych3($_GET['rok'].'_wiz_ods', 'ods', "$a", $_GET['rok']); //wymikiem jest zmienna $suma
		$dane_ods[] = $suma;
	}
	//zliczanie wszystkich odslon w roku
	$suma_wartosci_ods = 0;
	for($a=0; $a < count($dane_ods); $a++){$wartosc_ods = $dane_ods[$a]; $suma_wartosci_ods = $suma_wartosci_ods + $wartosc_ods;}
	$sr_ods = $suma_wartosci_ods / 12; $sr_ods = number_format ($sr_ods, 1);
	
	echo'<hr />';
	
	echo'
	<div class="table-responsive">
		<table class="table table-striped table-hover small table-sm">
		<tr>
			<th>rok</th> <th>miesiąc</th> <th>wizyty</th> <th>wykres wizyt</th> <th>odsłony</th> <th>wykres odsłon</th> 
		</tr>';
	
				reset($dane); // wskazanie na poczڴek tablicy
				$wartosc = current($dane);
				
				if($od==0){$a = -1;}	

			for ($i = 0; $i < count($dane); $i++) {
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
				
				//wizyty
				if($dane[$i] != 0){
					// obliczanie wysokosci slupka
					$szer = ($dane[$i] / $naj) * 200; $szer = round($szer, 0);
				}else{$szer = 1;}
				
				//odslony
				if($dane_ods[$i] != 0){
					// obliczanie wysokosci slupka
					$szer_ods = ($dane_ods[$i] / $naj_ods) * 200; $szer_ods = round($szer_ods, 0);
				}else{$szer_ods = 1;}				
				
			echo'
			<tr>
				<td class="text-muted">'.$_GET['rok'].'</td> <td class="text-muted"><a href="zestawienie.php?rok='.$_GET['rok'].'&m='.$m.'" role="button" data-toggle="tooltip" data-placement="right" title="Zobacz zestawienie Wizyt i Odsłon w miesiącu: '.$miesiac.'">'.$miesiac.'</a></td> <td><span class="label-dane">'.$dane[$i].'</span></td> <td><div class="row_slupki_poziom ttt" style="width: '.$szer.'px;" data-toggle="tooltip" data-placement="right" title="'.$miesiac.' '.$_GET['rok'].', '.$dane[$i].' wiz."></div></td>
				<td><span class="label-dane">'.$dane_ods[$i].'</span></td> <td><div class="row_slupki_poziom ttt" style="width: '.$szer_ods.'px;" data-toggle="tooltip" data-placement="right" title="'.$miesiac.' '.$_GET['rok'].', '.$dane_ods[$i].' ods."></div></td>
			</tr>';

			}//zam while
	
				echo'
				<tr>
					<th></th> <th></th> <th></th> <th></th> <th></th> <th></th> 
				</tr>
				<tr>
					<th colspan="2">średnio na miesiąc:</th> <th><span class="label-dane">'.$sr.'</span></th> <th></th> <th><span class="label-dane">'.$sr_ods.'</span></th> <th></th>
				</tr>
				<tr>
					<th colspan="2">suma:</th> <th><span class="label-dane">'.$suma_wartosci.'</span></th> <th></th> <th><span class="label-dane">'.$suma_wartosci_ods.'</span></th> <th></th>
				</tr>';

	
	echo'
		</table>
	';
	
	echo'</div>';
	








?>