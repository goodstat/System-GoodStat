<?php
	echo'<p class="lead text-right"><b>'.$miesiac.' '.$_GET['rok'].'</b> - <b>Zestawienie</b></p>';
	
	//######################### WIZYTY
	//szukania najwiecej wizyt w miesiacu
	szukaj_naj($_GET['rok'].'_wiz_ods', 'wiz', $_GET['m'], $_GET['rok']);
	$dane = array(); //zainicjowanie tablicy bez wartosci
	szukaj_danych($_GET['rok'].'_wiz_ods', 'wiz', $_GET['m'], $_GET['rok']); //wymikiem jest tablica $dane
	
		$dni_w_miesiacu = new DateTime($_GET['rok'].'-'.$_GET['m'].'-01');
		$ilosc_dni = $dni_w_miesiacu->format("t");	//ilość dni w miesiącu

	$suma_wartosci = 0;
	for($a=0; $a < count($dane); $a++){$wartosc = $dane[$a]; $suma_wartosci = $suma_wartosci + $wartosc;}
	$sr = $suma_wartosci / $ilosc_dni; $sr = number_format ($sr, 1);
	
	//######################### ODSLONY
	//szukania najwiecej odslon w miesiacu
	szukaj_naj_ods($_GET['rok'].'_wiz_ods', 'ods', $_GET['m'], $_GET['rok']);	//wynikiem jest zmienna $naj_ods
	$dane_ods = array(); //zainicjowanie tablicy bez wartosci
	szukaj_danych_ods($_GET['rok'].'_wiz_ods', 'ods', $_GET['m'], $_GET['rok']); //wynikiem jest tablica $dane_ods
	
		$dni_w_miesiacu = new DateTime($_GET['rok'].'-'.$_GET['m'].'-01');
		$ilosc_dni = $dni_w_miesiacu->format("t");	//ilość dni w miesiącu
		
	$suma_wartosci_ods = 0;
	for($a=0; $a < count($dane_ods); $a++){$wartosc_ods = $dane_ods[$a]; $suma_wartosci_ods = $suma_wartosci_ods + $wartosc_ods;}
	$sr_ods = $suma_wartosci_ods / $ilosc_dni; $sr_ods = number_format ($sr_ods, 1);
	
	echo'<hr />';
	
	echo'
	<div class="table-responsive">
		<table class="table table-striped table-hover small table-sm">
		<tr>
			<th>dzień</th> <th>data</th> <th>dzień tygodnia</th> <th>wizyty</th> <th>wykres wizyt</th> <th>odsłony</th> <th>wykres odsłon</th> 
		</tr>';
	
				reset($dane); // wskazanie na poczڴek tablicy
				$wartosc = current($dane);
				
				if($od==0){$a = -1;}	
				$dzien = 1;
				
			while(list($index, $wartosc) = each( $dane))
			{
				$a++;
				
				if($_GET['m'] == '1'){$miesiac = 'Styczeń'; $m = 1;}else
				if($_GET['m'] == '2'){$miesiac = 'Luty'; $m = 2;}else
				if($_GET['m'] == '3'){$miesiac = 'Marzec'; $m = 3;}else
				if($_GET['m'] == '4'){$miesiac = 'Kwiecień'; $m = 4;}else
				if($_GET['m'] == '5'){$miesiac = 'Maj'; $m = 5;}else
				if($_GET['m'] == '6'){$miesiac = 'Czerwiec'; $m = 6;}else
				if($_GET['m'] == '7'){$miesiac = 'Lipiec'; $m = 7;}else
				if($_GET['m'] == '8'){$miesiac = 'Sierpień'; $m = 8;}else
				if($_GET['m'] == '9'){$miesiac = 'Wrzesień'; $m = 9;}else
				if($_GET['m'] == '10'){$miesiac = 'Październik'; $m = 10;}else
				if($_GET['m'] == '11'){$miesiac = 'Listopad'; $m = 11;}else
				if($_GET['m'] == '12'){$miesiac = 'Grudzień'; $m = 12;}
				
				//wizyty
				if($wartosc != 0){
					// obliczanie wysokosci slupka
					$szer = ($wartosc / $naj) * 200; $szer = round($szer, 0);
				}else{$szer = 1;}
				
				//odslony
				if($dane_ods[$index] != 0){
					// obliczanie wysokosci slupka
					$szer_ods = ($dane_ods[$index] / $naj_ods) * 200; $szer_ods = round($szer_ods, 0);
				}else{$szer_ods = 1;}	

				$dni_w_tygodniu 	= new DateTime($_GET['rok'].'-'.$_GET['m'].'-'.$dzien.'');
				$dzien_tyg 			= $dni_w_tygodniu->format("w");	//dzien tygodnia jako cyfra 0 to niedziela
				$dzien_roku 		= $dni_w_tygodniu->format("z");	//Dzień roku (Zaczynając od 0) 0 aż do 365
				$dzien_roku++;
				
				if($dzien_tyg == '0'){$dzien_tyg = 'Niedziela';}else
				if($dzien_tyg == '1'){$dzien_tyg = 'Poniedziałek';}else
				if($dzien_tyg == '2'){$dzien_tyg = 'Wtorek';}else
				if($dzien_tyg == '3'){$dzien_tyg = 'Środa';}else
				if($dzien_tyg == '4'){$dzien_tyg = 'Czwartek';}else
				if($dzien_tyg == '5'){$dzien_tyg = 'Piątek';}else
				if($dzien_tyg == '6'){$dzien_tyg = 'Sobota';}
				
				echo'
				<tr>
					<td class="text-muted">'.$dzien_roku.'</td> <td>'.$dzien.' '.$miesiac.' '.$_GET['rok'].'</td> <td class="text-muted">'.$dzien_tyg.'</td> <td><span class="label-dane">'.$wartosc.'</span></td> <td><div class="row_slupki_poziom ttt" style="width: '.$szer.'px;" data-toggle="tooltip" data-placement="right" title="'.$dzien.' '.$miesiac.' '.$_GET['rok'].', '.$wartosc.' wiz."></div></td> 
					<td><span class="label-dane">'.$dane_ods[$index].'</span></td> <td><div class="row_slupki_poziom ttt" style="width: '.$szer_ods.'px;" data-toggle="tooltip" data-placement="right" title="'.$dzien.' '.$miesiac.' '.$_GET['rok'].', '.$dane_ods[$index].' ods."></div></td>
				</tr>';
						
						
						
						echo'
						</div>
						
						</div>
					</div>
				</div>
				';
				
				$dzien++;

			}//zam while
	
				echo'
				<tr>
					<th></th> <th></th> <th></th> <th></th> <th></th> <th></th> <th></th> 
				</tr>
				<tr>
					<th colspan="3">średnio na dzień:</th> <th><span class="label-dane">'.$sr.'</span></th> <th></th> <th><span class="label-dane">'.$sr_ods.'</span></th> <th></th> 
				</tr>
				<tr>
					<th colspan="3">suma:</th> <th><span class="label-dane">'.$suma_wartosci.'</span></th> <th></th> <th><span class="label-dane">'.$suma_wartosci_ods.'</span></th> <th></th>
				</tr>';

	
	echo'
		</table>
	';
	
	echo'</div>';





?>