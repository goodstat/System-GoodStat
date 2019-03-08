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
		$wynik .= " <li class='page-item'><a class='page-link' href='nr_ip.php?strona=1'><i class='material-icons'>first_page</i></a></li> ";
    } else {
        $wynik .= " <li class='page-item disabled'><a class='page-link' href='' tabindex='-1' aria-disabled='true'><i class='material-icons'>first_page</i></a></li>  ";
    }

    $poprzednia = $strona - 1;
    if ($poprzednia > 0) {
        $wynik .= " <li class='page-item'><a class='page-link' href='nr_ip.php?strona=$poprzednia'><i class='material-icons'>navigate_before</i></a></li> ";
    } else {
        $wynik .= " <li class='page-item disabled'><a class='page-link' href=''><i class='material-icons'>navigate_before</i></a></li> ";
    }

    $nastepna = $strona + 1;
    if ($nastepna <= $liczba_stron) {
        $wynik .= " <li class='page-item'><a class='page-link' href='nr_ip.php?strona=$nastepna'><i class='material-icons'>navigate_next</i></a></li> ";
    } else {
        $wynik .= " <li class='page-item disabled'><a class='page-link' href=''><i class='material-icons'>navigate_next</i></a></li> ";
    }

    if ($strona < $liczba_stron) {
        $wynik .= " <li class='page-item'><a class='page-link' href='nr_ip.php?strona=$liczba_stron'><i class='material-icons'>last_page</i></a></li> ";
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

	<!-- datepicker kalendarz -->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	 
	
	<script>
	  $(function() {
		$( "#data_ip" ).datepicker({dateFormat: "d-m-yy", duration: 300, showWeek: false, dayNamesMin: ["Nd", "Pn", "Wt", "Śr", "Cz", "Pt", "Sb"], monthNames: [ "Styczeń", "Luty", "Marzec", "Kwiecień", "Maj", "Czerwiec", "Lipiec", "Sierpień", "Wrzesień", "Październik", "Listopad", "Grudzień" ], showAnim: "slideDown" });
	  });
	</script>
	<!--/ datepicker kalendarz -->

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
			<h1>Numery IP <span></span></h1>
		</div>
		

	<form action="nr_ip.php" method="get" class="form-inline">
	
		<div class="row">
			<div class="form-group">
				<label for="data_ip" class="col-md-2 col-form-label"><i class="material-icons">calendar_today</i> </label>
				<div class="col-md-6">
					<input type="text" class="form-control input-sm" id="data_ip" name="data_ip" placeholder="d-m-rrrr" required>
				</div>
			</div>
		
			<div class="form-group">
				<div class="col-md-4">
					<button type="submit" class="btn btn-primary btn-sm" name="wyslij" title="Pokaż wejścia dla nr IP w wybranym dniu">wyślij</button>
				</div>  
			</div>
		</div>

	</form>

	<hr />
	
<?php
if(isset($_GET['data_ip'])){
	
	$dni_w_tygodniu 	= new DateTime($_GET['data_ip']);
	$rok	 			= $dni_w_tygodniu->format("Y");	//rok
	$miesiac 			= $dni_w_tygodniu->format("n");	//miesiac 1-12
	$dzien_mies 		= $dni_w_tygodniu->format("j");	//dzien miesiaca 1-31
	$dzien_tyg 			= $dni_w_tygodniu->format("w");	//dzien tygodnia jako cyfra 0 to niedziela
//	$data_unix 			= $dni_w_tygodniu->format("U");	//Sekundy liczone od ery UNIX-a
	$dzien_roku 		= $dni_w_tygodniu->format("z");	//Dzień roku (Zaczynając od 0) 0 aż do 365
	$nr_tyg 			= $dni_w_tygodniu->format("W");	//Numer tygodnia w roku, zgodny z normą ISO-8601, Tygodnie rozpoczynają Poniedziałki. Przykład: 42
	
	if($dzien_tyg == 0){$dzien_tyg = 'Niedziela';}else
	if($dzien_tyg == 1){$dzien_tyg = 'Poniedziałek';}else
	if($dzien_tyg == 2){$dzien_tyg = 'Wtorek';}else
	if($dzien_tyg == 3){$dzien_tyg = 'Środa';}else
	if($dzien_tyg == 4){$dzien_tyg = 'Czwartek';}else
	if($dzien_tyg == 5){$dzien_tyg = 'Piątek';}else
	if($dzien_tyg == 6){$dzien_tyg = 'Sobota';}

	echo'<p class="lead text-right"><b>Odsłony</b> nr.IP dla dnia: <b>'.$_GET['data_ip'].'</b></p>';
	
//-------------------------------------------------------------------
//STRONNICOWANIE
	$p = array(); //zainiciowanie tablicy $p
	$stmt = $db->query("SELECT * FROM ".$rok."_nr_ip WHERE dzien_roku='".$dzien_roku."' AND dzien='".$dzien_mies."' AND miesiac='".$miesiac."'");
	while($wiersz = $stmt->fetch(PDO::FETCH_ASSOC)){$id_art = $wiersz['id']; $p[]=$id_art;}

	$liczba_rekordow = count($p); 	//liczba wszystkich rekordow
	$rekordow_na_stronie = 20;		//liczba rekordow na stronie
	
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
			<th>nr. IP</th> <th>odsłony</th> <th>wykres</th> <th>ostatnio widziany</th> <th>dzień tygodnia</th> <th>nr.tyg</th> <th>dzień roku</th> 
		</tr>';
		
//szukanie NAJ
	$stmt = $db->query("SELECT * FROM ".$rok."_nr_ip WHERE dzien_roku='".$dzien_roku."' AND dzien='".$dzien_mies."' AND miesiac='".$miesiac."' ORDER BY ".$rok."_nr_ip.ods DESC LIMIT 1");

		while($wiersz = $stmt->fetch(PDO::FETCH_ASSOC)){
			$naj				= $wiersz['ods'];
		}
//end szukanie NAJ
	
	$stmt = $db->query("SELECT * FROM ".$rok."_nr_ip WHERE dzien_roku='".$dzien_roku."' AND dzien='".$dzien_mies."' AND miesiac='".$miesiac."' ORDER BY ".$rok."_nr_ip.ods DESC LIMIT $start ,$rekordow_na_stronie");
		
	if($stmt->rowCount() > 0){
		while($wiersz = $stmt->fetch(PDO::FETCH_ASSOC)){
			$nr_ip				= $wiersz['nr_ip'];
			$ods				= $wiersz['ods'];
			$data_utw			= $wiersz['data_utw'];	$data_utw = date('G:i', $data_utw);
			
				if($ods != 0){
					// obliczanie wysokosci slupka
					$szer = ($ods / $naj) * 200; $szer = round($szer, 0);
				}else{$szer = 1;}
			
			echo'
			<tr>
				<td class="text-muted">'.$nr_ip.'</td> <td><span class="label-dane">'.$ods.'</span></td> <td><div class="row_slupki_poziom ttt" style="width: '.$szer.'px;" title="'.$ods.' ods."></div></td> <td class="text-muted">god. '.$data_utw.'</td> <td class="text-muted">'.$dzien_tyg.'</td> <td class="text-muted">'.$nr_tyg.'</td> <td class="text-muted">'.$dzien_roku.'</td>
			</tr>';			
		}//end while

	}else{
			echo'
			<tr>
				<td colspan="7" class="text-muted"><span class="label-dane"> - w dniu: <b>'.$_GET['data_ip'].'</b> brak wejść na stronie - </span></td>
			</tr>';	
	}
	
	echo'
		</table>
	</div>';

			echo wskaznik($strona, $liczba_stron);	//stronnicowanie
			echo'<hr />';
}

?>

<p>
	<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
		<i class="material-icons">live_help</i> Numer IP - Co to znaczy ?
	</button>
</p>
<div class="collapse" id="collapseExample">
	<div class="card card-body">
		Numer IP to numeryczny identyfikator serwera podłączonego do sieci o protokole TCP/IP. Adres jest ciągiem liczb od 0 do 255, oddzielonych kropkami np. 36.192.55.234. Dzięki temu narzędziu dowiemy się o ilości odsłon w wybranym dniu dla poszczególnych Nr.Ip odwiedzających stronę monitorowaną.
	</div>
</div>

</div><!-- /tresc -->
		
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

    <!-- datepicker kalendarz -->
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<!--/ datepicker kalendarz -->

</body>
</html>