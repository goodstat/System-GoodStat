<?php
	//szukania najwiecej wizyt w miesiacu
	szukaj_naj($_GET['rok'].'_wiz_ods', 'ods', $_GET['m'], $_GET['rok']);

	$dane = array(); //zainicjowanie tablicy bez wartosci
	szukaj_danych($_GET['rok'].'_wiz_ods', 'ods', $_GET['m'], $_GET['rok']); //wymikiem jest tablica $dane
	
	$dni_w_miesiacu = new DateTime($_GET['rok'].'-'.$_GET['m'].'-01');
	$ilosc_dni = $dni_w_miesiacu->format("t");	//ilość dni w miesiącu

	$suma_wartosci = 0;
	for($a=0; $a < count($dane); $a++){$wartosc = $dane[$a]; $suma_wartosci = $suma_wartosci + $wartosc;}
	$sr = $suma_wartosci / $ilosc_dni; $sr = number_format ($sr, 1);

	wyk_odslon_miesiac($dane, $naj, $_GET['rok'], $_GET['m']);
	
	echo'<hr />';
?>
	

		
<div class="table-responsive">
	<table class="table table-striped table-hover small table-sm">
		<thead>
			<tr>
				<th>dzień roku</th>
				<th>data</th>
				<th>dzień tygodnia</th>
				<th>odsłony</th>
				<th>wykres godzin</th>
				<th>nr.IP</th>
			</tr>
		</thead>
		<tbody>
<?php
	
	$dzien_od 		= $dni_w_miesiacu->format("z");	//Dzień roku (Zaczynając od 0) 0 aż do 365
	
	
	$stmt = $db->query("SELECT * FROM ".$_GET['rok']."_wiz_ods LIMIT ".$dzien_od.", ".$ilosc_dni."");
	$stmt->rowCount();
	$d_miesiaca = 1;
		while($wiersz = $stmt->fetch(PDO::FETCH_ASSOC)){
			$d_roku 	= $wiersz['id']; $d_roku++;
			$ods 		= $wiersz['ods'];
			$dzien_tyg 	= $wiersz['dni_tyg'];
			
				if($dzien_tyg == '0'){$dzien_tyg = 'Niedziela';}else
				if($dzien_tyg == '1'){$dzien_tyg = 'Poniedziałek';}else
				if($dzien_tyg == '2'){$dzien_tyg = 'Wtorek';}else
				if($dzien_tyg == '3'){$dzien_tyg = 'Środa';}else
				if($dzien_tyg == '4'){$dzien_tyg = 'Czwartek';}else
				if($dzien_tyg == '5'){$dzien_tyg = 'Piątek';}else
				if($dzien_tyg == '6'){$dzien_tyg = 'Sobota';}
				
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

				echo'
				<tr>
					<td class="text-muted">'.$d_roku.'</td>
					<td class="text-muted">'.$d_miesiaca.' '.$miesiac.' '.$_GET['rok'].'</td>
					<td class="text-muted">'.$dzien_tyg.'</td>
					<th class="text-muted">'.$ods.'</th>
					<td><button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#okienko'.$d_roku.'" title="Zobacz ilość Odsłon w godzinach w tym dniu"><i class="material-icons">bar_chart</i></button></td>';
					
					
					// modal
					echo'
					<div class="modal fade" id="okienko'.$d_roku.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-xl">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Wykres Odsłon w godzinach w dniu: '.$d_miesiaca.' '.$miesiac.' '.$_GET['rok'].', dzień roku: '.$d_roku.'</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">';

						$dzien_r = $d_roku - 1;
						
//szukanie najwiekszej wizyty w godzinach
	$tab = array(); //zainicjowanie tablicy bez wartosci
for($a=0; $a<24; $a++){
	$nazwa_slupka = $a.'ods';
	naj_god($_GET['rok'].'_wiz_ods', "$nazwa_slupka", "$dzien_r");
	$tab[] = $wartosc;
}
	rsort($tab); 
	$naj_g = $tab[0];
	
	$dane_g = array(); //zainicjowanie tablicy bez wartosci
	$suma = 0;
for($a=0; $a<24; $a++){
	$nazwa_slupka = $a.'ods';
	naj_god($_GET['rok'].'_wiz_ods', "$nazwa_slupka", "$dzien_r");
	$dane_g[] = $wartosc;
	$suma = $suma + $wartosc; //sumuje
}

			echo'
			<div class="table-responsive">
			<center>
				<div class="wykres">';
				
				reset($dane_g); // wskazanie na poczڴek tablicy
				$wartosc = current($dane_g);
				
				if($od==0){$a = -1;}	

			while(list($index, $wartosc) = each( $dane_g))
			{
				$a++;
				
				if($wartosc != 0){
					// obliczanie wysokosci slupka
					$szer = ($wartosc / $naj_g) * 200; $szer = round($szer, 0);
				}else{$szer = 1;}
				
				echo'
					<div class="row_wykres bottom-section">
						<div class="bottom-content">';
						
							if(!$suma > 0) { echo'<div style="height: 185px; width: 0px;"></div>'; }
							
							echo'
							<div class="row_slupki ttooltip" data-toggle="tooltip" data-placement="bottom" title="godzina: '.$index.'.00 - odsłon: '.$wartosc.'" style="height: '.$szer.'px;">
								
							</div>
						</div>
						<div class="wykres-os-x">'.$index.'</div>
					</div>';

			}//zam while
			
			echo'
				</div>
			</center>
			</div>';
								
								echo'
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								</div>
								</div>
						</div>
					</div>';
					
					echo'
					<td>					
						<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#okienko_ip'.$d_roku.'" data-toggle="tooltip" data-placement="bottom" title="Zobacz ilość Odsłon, poszczególnych adresów IP"><i class="material-icons">bar_chart</i></button>					
					</td>';
					
				//modal ip
				echo'
				<div class="modal fade" id="okienko_ip'.$d_roku.'">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
				  
							<!-- Modal Header -->
							<div class="modal-header">
								<h5 class="modal-title">Odsłony nr. IP w dniu: '.$d_miesiaca.' '.$miesiac.' '.$_GET['rok'].', dzień roku: '.$d_roku.'</h5>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
					
							<!-- Modal body -->
							<div class="modal-body">
								<div class="row">
									<div class="col-4"><b>nr. IP</b></div>
									<div class="col-4"><b>odsłony</b></div>
									<div class="col-4"><b>data</b></div>';
								
							$stmt_ip = $db->query("SELECT * FROM ".$_GET['rok']."_nr_ip WHERE dzien_roku=".$dzien_r." ORDER BY `".$_GET['rok']."_nr_ip`.`ods` DESC LIMIT 20");
							if($stmt_ip->rowCount() > 0){
							
								while($wiersz = $stmt_ip->fetch(PDO::FETCH_ASSOC)){
									
									$nr_ip 		= $wiersz['nr_ip'];
									$ods_ip 	= $wiersz['ods'];
									$data_ip 	= $wiersz['data_utw'];	$data_ip = date('d-m-Y, H:i:s', $data_ip);						
								
										echo'
											<div class="col-4 text-muted small">
												'.$nr_ip.'
											</div>
											<div class="col-4 text-muted small">
												'.$ods_ip .'
											</div>
											<div class="col-4 text-muted small">
												'.$data_ip .'
											</div>';
								}
									echo'<div class="col-12">
											<fieldset class="border">
												<legend class="w-auto">Pomoc</legend>
													<p class="text-muted small">Dane pokazują 20 numerów IP z największą ilością odsłon w wybranym dniu. Kolumna <i>Data</i>, wskazuje ostatnią odsłonę w tym dniu.</p>
											</fieldset>
										</div>';
							}else{
								echo'<div class="col-12"><p class="text-muted my-4">brak numerów IP...</p></div>';
							}
							echo'
								</div>
							</div>
					
							<!-- Modal footer -->
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							</div>
					
						</div>
					</div>
				</div>';				
				//end modal ip
					
				echo'
				</tr>';
			$d_miesiaca++;
		}
?>
			<tr>
				<th></th>
				<th></th>
				<th>suma</th>
				<th colspan="3"><?php echo $suma_wartosci; ?></th>				
			</tr>
			<tr>
				<th></th>
				<th></th>
				<th>średnio</th>
				<th colspan="3"><?php echo $sr; ?></th>
			</tr>
		</tbody>
	</table>	
</div>

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
	