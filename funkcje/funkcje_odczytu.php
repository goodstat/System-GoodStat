<?php
//##### szukanie największej liczby
function szukaj_naj_rok($nazwa_tabeli)
{
		global $naj, $db; //oto największa liczba

		$stmt = $db->query("SELECT wiz FROM `$nazwa_tabeli` ORDER BY `$nazwa_tabeli`.`wiz` DESC LIMIT 1");

			while($wiersz = $stmt->fetch(PDO::FETCH_ASSOC)){
				$naj = $wiersz['wiz'];
			}
}

//##### szukanie największej liczby
function szukaj_naj_godziny($nazwa_tabeli)
{
		global $naj_g, $db; //oto największa liczba

		$stmt = $db->query("SELECT wejscia FROM `$nazwa_tabeli` ORDER BY `$nazwa_tabeli`.`wejscia` DESC LIMIT 1");

			while($wiersz = $stmt->fetch(PDO::FETCH_ASSOC)){
				$naj_g = $wiersz['wejscia'];
			}
}

//##### szukanie największej liczby
function szukaj_naj($nazwa_tabeli, $nazwa_slupka, $pokaz_miesiac, $pokaz_rok)
{
	global $naj, $db; //oto największa liczba
	
		$dni_w_miesiacu = new DateTime($pokaz_rok.'-'.$pokaz_miesiac.'-01');
		$liczba_dni 	= $dni_w_miesiacu->format("t");	//ilość dni w miesiącu
		$dzien_od 		= $dni_w_miesiacu->format("z");	//Dzień roku (Zaczynając od 0) 0 aż do 365
	
	$stmt = $db->query("SELECT $nazwa_slupka FROM $nazwa_tabeli LIMIT $dzien_od, $liczba_dni");
	
	$tablica = array(); //zainicjowanie tablicy bez wartosci
	
	while($wiersz = $stmt->fetch(PDO::FETCH_ASSOC)){	
		$wartosc = $wiersz["$nazwa_slupka"];
		$tablica[] = $wartosc;
	}
	rsort($tablica); 
	$naj = $tablica[0];
}

//##### szukanie największej liczby
function szukaj_naj_ods($nazwa_tabeli, $nazwa_slupka, $pokaz_miesiac, $pokaz_rok)
{
	global $naj_ods, $db; //oto największa liczba
	
		$dni_w_miesiacu = new DateTime($pokaz_rok.'-'.$pokaz_miesiac.'-01');
		$liczba_dni 	= $dni_w_miesiacu->format("t");	//ilość dni w miesiącu
		$dzien_od 		= $dni_w_miesiacu->format("z");	//Dzień roku (Zaczynając od 0) 0 aż do 365
	
	$stmt = $db->query("SELECT $nazwa_slupka FROM $nazwa_tabeli LIMIT $dzien_od, $liczba_dni");
	
	$tablica = array(); //zainicjowanie tablicy bez wartosci
	
	while($wiersz = $stmt->fetch(PDO::FETCH_ASSOC)){	
		$wartosc = $wiersz["$nazwa_slupka"];
		$tablica[] = $wartosc;
	}
	rsort($tablica); 
	$naj_ods = $tablica[0];
}

//##### szukanie danych
function szukaj_danych($nazwa_tabeli, $nazwa_slupka, $pokaz_miesiac, $pokaz_rok)
{
	global $dane, $db; 
	
		$dni_w_miesiacu = new DateTime($pokaz_rok.'-'.$pokaz_miesiac.'-01');
		$liczba_dni 	= $dni_w_miesiacu->format("t");	//ilość dni w miesiącu
		$dzien_od 		= $dni_w_miesiacu->format("z");	//Dzień roku (Zaczynając od 0) 0 aż do 365
	//	$dzien_do 		= $dzien_od + $liczba_dni;
	
	$stmt = $db->query("SELECT $nazwa_slupka FROM $nazwa_tabeli LIMIT $dzien_od, $liczba_dni ");

	while($wiersz = $stmt->fetch(PDO::FETCH_ASSOC)){	
		$wartosc = $wiersz["$nazwa_slupka"];
		$dane[] = $wartosc;
	}
}

//##### szukanie danych
function szukaj_danych_ods($nazwa_tabeli, $nazwa_slupka, $pokaz_miesiac, $pokaz_rok)
{
	global $dane_ods, $db; 
	
		$dni_w_miesiacu = new DateTime($pokaz_rok.'-'.$pokaz_miesiac.'-01');
		$liczba_dni 	= $dni_w_miesiacu->format("t");	//ilość dni w miesiącu
		$dzien_od 		= $dni_w_miesiacu->format("z");	//Dzień roku (Zaczynając od 0) 0 aż do 365
	//	$dzien_do 		= $dzien_od + $liczba_dni;
	
	$stmt = $db->query("SELECT $nazwa_slupka FROM $nazwa_tabeli LIMIT $dzien_od, $liczba_dni ");

	while($wiersz = $stmt->fetch(PDO::FETCH_ASSOC)){		
		$wartosc = $wiersz["$nazwa_slupka"];
		$dane_ods[] = $wartosc;
	}
}

//##### szukanie danych
function szukaj_danych3($nazwa_tabeli, $nazwa_slupka, $pokaz_miesiac, $pokaz_rok)
{
	global $suma, $db;
	$suma = 0;
	
		$dni_w_miesiacu = new DateTime($pokaz_rok.'-'.$pokaz_miesiac.'-01');
		$liczba_dni 	= $dni_w_miesiacu->format("t");	//ilość dni w miesiącu
		$dzien_od 		= $dni_w_miesiacu->format("z");	//Dzień roku (Zaczynając od 0) 0 aż do 365
	//	$dzien_do 		= $dzien_od + $liczba_dni;
	
		
	$stmt = $db->query("SELECT $nazwa_slupka FROM $nazwa_tabeli LIMIT $dzien_od, $liczba_dni ");	
	
		while($wiersz = $stmt->fetch(PDO::FETCH_ASSOC)){	
			$wartosc = $wiersz["$nazwa_slupka"];
			$suma = $suma + $wartosc;
		}
	
}

//##### szukanie danych
function szukaj_danych4($nazwa_tabeli, $slupek_1, $slupek_2)
{
	//	$slupek_1 - wejscia
	//	$slupek_2 - system
	
	global $tab_danych, $db;	
		
	$stmt = $db->query("SELECT * FROM `$nazwa_tabeli` ORDER BY `$nazwa_tabeli`.`$slupek_1` DESC ");													
	
		while($wiersz = $stmt->fetch(PDO::FETCH_ASSOC)){	
			$system 	= $wiersz["$slupek_2"];
			$wejscia 	= $wiersz["$slupek_1"];
			
			$tab_danych["$system"] = $wejscia;
		}
	
}

//##### wykres wizyt rok
function wyk_wizyt_rok($dane, $naj, $rok){
	global $dane; 

	if($naj==0){$naj=1;}
	
	//liczenie sumy wizyt w roku
	$suma_wartosci = 0;
	for($a=0; $a<12; $a++){
		$wartosc = $dane[$a];
		$suma_wartosci = $suma_wartosci + $wartosc; //sumuje
	}
	
			echo'
			<div class="table-responsive">
			<center>
				<div class="wykres">';
				
				reset($dane); // wskazanie na poczڴek tablicy
				$wartosc = current($dane);
				
				if($od==0){$a = -1;}	

			while(list($index, $wartosc) = each( $dane))
			{
				$a++;
				
				if($index == '0'){$index1 = 'Styczeń'; $m = 1;}
				if($index == '1'){$index1 = 'Luty'; $m = 2;}
				if($index == '2'){$index1 = 'Marzec'; $m = 3;}
				if($index == '3'){$index1 = 'Kwiecień'; $m = 4;}
				if($index == '4'){$index1 = 'Maj'; $m = 5;}
				if($index == '5'){$index1 = 'Czerwiec'; $m = 6;}
				if($index == '6'){$index1 = 'Lipiec'; $m = 7;}
				if($index == '7'){$index1 = 'Sierpień'; $m = 8;}
				if($index == '8'){$index1 = 'Wrzesień'; $m = 9;}
				if($index == '9'){$index1 = 'Październik'; $m = 10;}
				if($index == '10'){$index1 = 'Listopad'; $m = 11;}
				if($index == '11'){$index1 = 'Grudzień'; $m = 12;}
				
				// obliczanie wysokosci slupka
				$szer = ($wartosc / $naj) * 200; $szer = round($szer, 0);
				if($szer <= 0){$szer = 1;}
				
				echo'
					<div class="row_wykres bottom-section">
						<div class="bottom-content">';
						
							if(!$suma_wartosci > 0) { echo'<div style="height: 185px; width: 0px;"></div>'; }
							
							echo'
							<div class="row_slupki ttooltip" style="height: '.$szer.'px;" title="'.$index1.' '.$rok.', '.$wartosc.' wizyt" data-toggle="tooltip" data-placement="top">
								
							</div>
						</div>
						<div class="wykres-os-x">'.$m.'</div>
					</div>';

			}//zam while


			echo'
				</div>
			</center>
			</div>';
}

//##### wykres wizyt godzin
function wyk_wizyt_god($dane_g, $naj_g, $rok){
	global $dane_g; 

	if($naj_g==0){$naj_g=1;}
	
	//liczenie sumy wizyt w roku
	$suma = 0;
	for($a=0; $a<12; $a++){
		$war_g = $dane_g[$a];
		$suma = $suma + $war_g; //sumuje
	}
	
			echo'
			<div class="table-responsive">
			<center>
				<div class="wykres">';
				
				reset($dane_g); // wskazanie na poczڴek tablicy
				$war_g = current($dane_g);
				
				if($od==0){$a = -1;}	

			while(list($index, $war_g) = each( $dane_g))
			{
				$a++;
				
				if($war_g != 0){
					// obliczanie wysokosci slupka
					$szer = ($war_g / $naj_g) * 200; $szer = round($szer, 0);
				}else{$szer = 1;}
				
				echo'
					<div class="row_wykres bottom-section">
						<div class="bottom-content">';
						
							if(!$suma > 0) { echo'<div style="height: 185px; width: 0px;"></div>'; }
							
							echo'
							<div class="row_slupki ttooltip" style="height: '.$szer.'px;">
								<span class="tooltiptext">'.$index1.' '.$rok.'<br />'.$war_g.' wizyt</span>
							</div>
						</div>
						<div class="wykres-os-x">'.$index.'</div>
					</div>';

			}//zam while


			echo'
				</div>
			</center>
			</div>';
}

//##### wykres wizyt miesiac
function wyk_wizyt_miesiac($dane, $naj, $rok, $miesiac){
	global $dane; 

	if($naj==0){$naj=1;}
		
		$dzien = 1;
		
		$dni_w_miesiacu = new DateTime($rok.'-'.$miesiac.'-01');
		$liczba_dni 	= $dni_w_miesiacu->format("t");	//ilość dni w miesiącu
	
	//liczenie sumy wizyt w roku
	$suma_wartosci = 0;
	for($a=0; $a<$liczba_dni; $a++){
		$wartosc = $dane[$a];
		$suma_wartosci = $suma_wartosci + $wartosc; //sumuje
	}
	
	if($miesiac == '1'){$mies_wys = 'I';}
	elseif($miesiac == '2'){$mies_wys = 'II';}
	elseif($miesiac == '3'){$mies_wys = 'III';}
	elseif($miesiac == '4'){$mies_wys = 'IV';}
	elseif($miesiac == '5'){$mies_wys = 'V';}
	elseif($miesiac == '6'){$mies_wys = 'VI';}
	elseif($miesiac == '7'){$mies_wys = 'VII';}
	elseif($miesiac == '8'){$mies_wys = 'VIII';}
	elseif($miesiac == '9'){$mies_wys = 'IX';}
	elseif($miesiac == '10'){$mies_wys = 'X';}
	elseif($miesiac == '11'){$mies_wys = 'XI';}
	elseif($miesiac == '12'){$mies_wys = 'XII';}

			echo'
			<div class="table-responsive">
			<center>
				<div class="wykres">';
				
				reset($dane); // wskazanie na poczڴek tablicy
				$wartosc = current($dane);
				
				if($od==0){$a = -1;}	

			while(list($index, $wartosc) = each( $dane))
			{
				$a++;
				
				// obliczanie wysokosci slupka
				$szer = ($wartosc / $naj) * 200; $szer = round($szer, 0);
				if($szer <= 0){$szer = 1;}
				
				echo'
					<div class="row_wykres bottom-section">
						<div class="bottom-content">';
						
							if(!$suma_wartosci > 0) { echo'<div style="height: 185px; width: 0px;"></div>'; }
							
							echo'
							<div class="row_slupki ttooltip" style="height: '.$szer.'px;" data-toggle="tooltip" data-placement="top" title="'.$dzien.'-'.$mies_wys.'-'.$rok.', '.$wartosc.' wizyt">
								
							</div>
						</div>
						<div class="wykres-os-x">'.$dzien.'</div>
					</div>';
				
				$dzien++;
				
			}//zam while


			echo'
				</div>
			</center>
			</div>';
}

//##### szukanie najwiekszej wizyty w godzinach
function naj_god($nazwa_tabeli, $nazwa_slupka, $dzien_roku)
{
	global $wartosc, $db;
	
	$stmt = $db->query("SELECT id, $nazwa_slupka FROM $nazwa_tabeli WHERE id='$dzien_roku' LIMIT 1");
	
	while($wiersz = $stmt->fetch(PDO::FETCH_ASSOC)){	
		$wartosc = $wiersz["$nazwa_slupka"];		
	}	
}

//############################################################################## ODSLONY ################################################################################################

//##### wykres odslon rok
function wyk_odslon_rok($dane, $naj, $rok){
	global $dane; 

	if($naj==0){$naj=1;}
	
	//liczenie sumy wizyt w roku
	$suma_wartosci = 0;
	for($a=0; $a<12; $a++){
		$wartosc = $dane[$a];
		$suma_wartosci = $suma_wartosci + $wartosc; //sumuje
	}
	
			echo'
			<div class="table-responsive">
			<center>
				<div class="wykres">';
				
				reset($dane); // wskazanie na poczڴek tablicy
				$wartosc = current($dane);
				
				if($od==0){$a = -1;}	

			while(list($index, $wartosc) = each( $dane))
			{
				$a++;
				
				if($index == '0'){$index1 = 'Styczeń'; $m = 1;}
				if($index == '1'){$index1 = 'Luty'; $m = 2;}
				if($index == '2'){$index1 = 'Marzec'; $m = 3;}
				if($index == '3'){$index1 = 'Kwiecień'; $m = 4;}
				if($index == '4'){$index1 = 'Maj'; $m = 5;}
				if($index == '5'){$index1 = 'Czerwiec'; $m = 6;}
				if($index == '6'){$index1 = 'Lipiec'; $m = 7;}
				if($index == '7'){$index1 = 'Sierpień'; $m = 8;}
				if($index == '8'){$index1 = 'Wrzesień'; $m = 9;}
				if($index == '9'){$index1 = 'Październik'; $m = 10;}
				if($index == '10'){$index1 = 'Listopad'; $m = 11;}
				if($index == '11'){$index1 = 'Grudzień'; $m = 12;}
				
				// obliczanie wysokosci slupka
				$szer = ($wartosc / $naj) * 200; $szer = round($szer, 0);
				if($szer <= 0){$szer = 1;}
				
				echo'
					<div class="row_wykres bottom-section">
						<div class="bottom-content">';
						
							if(!$suma_wartosci > 0) { echo'<div style="height: 185px; width: 0px;"></div>'; }
							
							echo'
							<div class="row_slupki ttooltip" style="height: '.$szer.'px;" data-toggle="tooltip" data-placement="top" title="'.$index1.' '.$rok.', '.$wartosc.' odsłon">
								
							</div>
						</div>
						<div class="wykres-os-x">'.$m.'</div>
					</div>';

			}//zam while


			echo'
				</div>
			</center>
			</div>';
}

//##### wykres odslon miesiac
function wyk_odslon_miesiac($dane, $naj, $rok, $miesiac){
	global $dane; 

	if($naj==0){$naj=1;}
		
		$dzien = 1;
		
		$dni_w_miesiacu = new DateTime($rok.'-'.$miesiac.'-01');
		$liczba_dni 	= $dni_w_miesiacu->format("t");	//ilość dni w miesiącu
	
	//liczenie sumy wizyt w roku
	$suma_wartosci = 0;
	for($a=0; $a<$liczba_dni; $a++){
		$wartosc = $dane[$a];
		$suma_wartosci = $suma_wartosci + $wartosc; //sumuje
	}
	
	if($miesiac == '1'){$mies_wys = 'I';}
	elseif($miesiac == '2'){$mies_wys = 'II';}
	elseif($miesiac == '3'){$mies_wys = 'III';}
	elseif($miesiac == '4'){$mies_wys = 'IV';}
	elseif($miesiac == '5'){$mies_wys = 'V';}
	elseif($miesiac == '6'){$mies_wys = 'VI';}
	elseif($miesiac == '7'){$mies_wys = 'VII';}
	elseif($miesiac == '8'){$mies_wys = 'VIII';}
	elseif($miesiac == '9'){$mies_wys = 'IX';}
	elseif($miesiac == '10'){$mies_wys = 'X';}
	elseif($miesiac == '11'){$mies_wys = 'XI';}
	elseif($miesiac == '12'){$mies_wys = 'XII';}

			echo'
			<div class="table-responsive">
			<center>
				<div class="wykres">';
				
				reset($dane); // wskazanie na poczڴek tablicy
				$wartosc = current($dane);
				
				if($od==0){$a = -1;}	

			while(list($index, $wartosc) = each( $dane))
			{
				$a++;
				
				// obliczanie wysokosci slupka
				$szer = ($wartosc / $naj) * 200; $szer = round($szer, 0);
				if($szer <= 0){$szer = 1;}
				
				echo'
					<div class="row_wykres bottom-section">
						<div class="bottom-content">';
						
							if(!$suma_wartosci > 0) { echo'<div style="height: 185px; width: 0px;"></div>'; }
							
							echo'
							<div class="row_slupki ttooltip" style="height: '.$szer.'px;" data-toggle="tooltip" data-placement="top" title="'.$dzien.'-'.$mies_wys.'-'.$rok.', '.$wartosc.' odsłon">
								
							</div>
						</div>
						<div class="wykres-os-x">'.$dzien.'</div>
					</div>';
				
				$dzien++;
				
			}//zam while


			echo'
				</div>
			</center>
			</div>';
}


?>