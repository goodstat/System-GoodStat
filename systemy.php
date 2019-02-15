<?php
//--- dolaczenie plikow
if(file_exists('config.php')) {
	include('config.php');
	include('inc/baza_polacz.php');
}
	include('funkcje/funkcje.php');
	include('funkcje/funkcje_odczytu.php');
	include("inc/sesje.php");
	
//######## STRONNICOWANIE
function wskaznik($strona, $liczba_stron)
{
    $wynik = "<span class='text-muted small'><center>strona $strona/$liczba_stron</center></span><nav aria-label='Page navigation example'><ul class='pagination justify-content-center'>";

    if ($strona > 1) {
		$wynik .= " <li class='page-item'><a class='page-link' href='systemy.php?strona=1'><i class='material-icons'>first_page</i></a></li> ";
    } else {
        $wynik .= " <li class='page-item disabled'><a class='page-link' href='' tabindex='-1' aria-disabled='true'><i class='material-icons'>first_page</i></a></li>  ";
    }

    $poprzednia = $strona - 1;
    if ($poprzednia > 0) {
        $wynik .= " <li class='page-item'><a class='page-link' href='systemy.php?strona=$poprzednia'><i class='material-icons'>navigate_before</i></a></li> ";
    } else {
        $wynik .= " <li class='page-item disabled'><a class='page-link' href=''><i class='material-icons'>navigate_before</i></a></li> ";
    }

    $nastepna = $strona + 1;
    if ($nastepna <= $liczba_stron) {
        $wynik .= " <li class='page-item'><a class='page-link' href='systemy.php?strona=$nastepna'><i class='material-icons'>navigate_next</i></a></li> ";
    } else {
        $wynik .= " <li class='page-item disabled'><a class='page-link' href=''><i class='material-icons'>navigate_next</i></a></li> ";
    }

    if ($strona < $liczba_stron) {
        $wynik .= " <li class='page-item'><a class='page-link' href='systemy.php?strona=$liczba_stron'><i class='material-icons'>last_page</i></a></li> ";
    } else {
        $wynik .= " <li class='page-item disabled'><a class='page-link'><i class='material-icons'>last_page</i></a></li> ";
    }
    
   $wynik .= "</ul></nav>";
    return $wynik;

}
?>
<!doctype html>
<html lang="pl">
<head>

<?php
//--- dolaczenie plikow
	include('inc/head.php');
?>

</head>
	
<body>

<?php
//--- dolaczenie plikow
if(file_exists('config.php')) {

	include('inc/menu.php');
	include('inc/baner.php');
	include('operacje/!_spis.php');
	include('inc/pole_alerts.php');
}
?>

<?php
if(file_exists('config.php')) {
    //zainstalowany
?>

<div class="container tresc">
<?php
	if(isset($_SESSION['sesja_uzyt']['zalogowany'])){
?>
		<div class="page-header">
			<h1>Systemy <span></span></h1>
		</div>
		
		
<?php
	$tab_danych = array(); //zainicjowanie tablicy bez wartosci
	szukaj_danych4('system', 'wejscia', "system");
?>
		
		


<?php			
//-------------------------------------------------------------------
//STRONNICOWANIE
	$p = array(); //zainiciowanie tablicy $p
	
	$stmt = $db->query("SELECT * FROM system");
	while($wiersz = $stmt->fetch(PDO::FETCH_ASSOC)){$id_art = $wiersz['id']; $p[]=$id_art;}

	$liczba_rekordow = count($p); 	//liczba wszystkich rekordow
	$rekordow_na_stronie = 10;		//liczba rekordow na stronie
	
	$liczba_stron = (int) (($liczba_rekordow + $rekordow_na_stronie - 1) / $rekordow_na_stronie);

	if (isset($_GET['strona']) && str_ievpifr($_GET['strona'], 1, $liczba_stron)) {
		$strona = $_GET['strona'];
	}else{
		$strona = 1;
	}
	
	$start = ($strona - 1) * $rekordow_na_stronie;
			
	echo'
	<div class="table-responsive">
		<table class="table table-striped table-hover small table-sm">
		<tr>
			<th>system</th> <th>wizyty</th> <th>wykres</th> <th>usuń</th>
		</tr>';

		szukaj_naj_godziny('system');
		
		$stmt = $db->query("SELECT * FROM `system` ORDER BY `system`.`wejscia` DESC LIMIT $start ,$rekordow_na_stronie");

			while($wiersz = $stmt->fetch(PDO::FETCH_ASSOC)){
				
				$id = $wiersz['id'];
				$system = $wiersz['system'];
				$wejscia = $wiersz['wejscia'];
				
				if($wejscia != 0){
					// obliczanie wysokosci slupka
					$szer = ($wejscia / $naj_g) * 200; $szer = round($szer, 0);
				}else{$szer = 1;}
				
				echo'
				<tr>
					<td class="text-muted">'.$system.'</td> <td class="text-muted">'.$wejscia.'</td> <td><div class="row_slupki_poziom ttt" style="width: '.$szer.'px;" data-toggle="tooltip" data-placement="right" title="'.$wejscia.' wiz."></div></td> <td><button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#szczegoly'.$id.'" title="Usuń"><i class="material-icons">delete_forever</i></button></td> 
				</tr>';

					//szczegoly
					echo'
					<!-- Modal -->
					<div class="modal fade" id="szczegoly'.$id.'">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
					  
								<!-- Modal Header -->
								<div class="modal-header">
									<h4 class="modal-title">Na pewno usunąć tą pozycję ?</h4>
										<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>
						
								<!-- Modal body -->
								<div class="modal-body">

									<form action="systemy.php" method="post" class="form-horizontal">
										<ul class="list-group">								
											<li class="list-group-item">
												<div class="row">
													<div class="col-md-3">nazwa</div>						
													<div class="col-md-9"><b>'.$system.'</b></div>						
												</div>
											</li>									
										</ul>
								</div>
						
								<!-- Modal footer -->
								<div class="modal-footer">
										<input type="hidden" value="'.$id.'" name="id">
										<input type="hidden" value="'.$system.'" name="system">
								
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Nie</button>
										<button type="submit" class="btn btn-success" name="wyslij_1" title="tak usuń">Tak</button>
									</form>
								</div>
						
							</div>
						</div>
					</div>
					<!-- end Modal -->';				
			}
			
	echo'
		</table>
	</div>';
?>
<?php
		echo wskaznik($strona, $liczba_stron);	//stronnicowanie
?>

	<hr />
	
<p>
	<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
		<i class="material-icons">live_help</i> Pomoc
	</button>
</p>
<div class="collapse" id="collapseExample">
	<div class="card card-body">
		Dane zawarte w powyższej tabeli wskazują dane techniczne odwiedzających stronę monitorowaną. Dane do tej tabeli zapisywane są jedynie wtedy kiedy stwierdzono nową wizytę. Dodano też możliwość usunięcia pojedynczych rekordów.
	</div>
</div>

</div>
		
<?php
	}else{		
		include('inc/form_logowania.php');
	}
?>	
	

</div>

<?php
	if(isset($_SESSION['sesja_uzyt']['zalogowany'])){
		include('inc/zalogowany_jako.php');
	}

}else{
    //instalacja
	include('instalacja/index.php');
}
?>

<?php
if(file_exists('config.php')) {
	include('inc/stopka.php');
}
	include('inc/stopka_bootstrap.php');
?>

</body>
</html>