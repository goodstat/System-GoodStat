<?php
//--- dolaczenie plikow
if(file_exists('config.php')) {
	include('config.php');
	include('inc/baza_polacz.php');
}
	include('funkcje/funkcje.php');
	include("inc/sesje.php");
	
//######## STRONNICOWANIE
function wskaznik($strona, $liczba_stron)
{
    $wynik = "<span class='text-muted small'><center>strona $strona/$liczba_stron</center></span><nav aria-label='Page navigation example'><ul class='pagination justify-content-center'>";

    if ($strona > 1) {
		$wynik .= " <li class='page-item'><a class='page-link' href='historia.php?strona=1'><i class='material-icons'>first_page</i></a></li> ";
    } else {
        $wynik .= " <li class='page-item disabled'><a class='page-link' href='' tabindex='-1' aria-disabled='true'><i class='material-icons'>first_page</i></a></li>  ";
    }

    $poprzednia = $strona - 1;
    if ($poprzednia > 0) {
        $wynik .= " <li class='page-item'><a class='page-link' href='historia.php?strona=$poprzednia'><i class='material-icons'>navigate_before</i></a></li> ";
    } else {
        $wynik .= " <li class='page-item disabled'><a class='page-link' href=''><i class='material-icons'>navigate_before</i></a></li> ";
    }

    $nastepna = $strona + 1;
    if ($nastepna <= $liczba_stron) {
        $wynik .= " <li class='page-item'><a class='page-link' href='historia.php?strona=$nastepna'><i class='material-icons'>navigate_next</i></a></li> ";
    } else {
        $wynik .= " <li class='page-item disabled'><a class='page-link' href=''><i class='material-icons'>navigate_next</i></a></li> ";
    }

    if ($strona < $liczba_stron) {
        $wynik .= " <li class='page-item'><a class='page-link' href='historia.php?strona=$liczba_stron'><i class='material-icons'>last_page</i></a></li> ";
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
			<h1>Historia <span></span></h1>
		</div>
		

		<div class="table-responsive">
		<table class="table table-striped table-hover small table-sm">
		<tr>
			<th>data</th> <th>nr.ip</th>  <th>podstrona</th>  <th>system</th>  <th>przeglądarka</th>  <th>color</th>  <th>ekran</th>  <th>język</th>  <th>user agent</th> 
		</tr>
<?php
//-------------------------------------------------------------------
//STRONNICOWANIE
	$p = array(); //zainiciowanie tablicy $p
	$stmt = $db->query("SELECT * FROM historia");
	while($wiersz = $stmt->fetch(PDO::FETCH_ASSOC)){$id_art = $wiersz['id']; $p[]=$id_art;}

	$liczba_rekordow = count($p); 	//liczba wszystkich rekordow
	$rekordow_na_stronie = 30;		//liczba rekordow na stronie
	
	$liczba_stron = (int) (($liczba_rekordow + $rekordow_na_stronie - 1) / $rekordow_na_stronie);

	if (isset($_GET['strona']) && str_ievpifr($_GET['strona'], 1, $liczba_stron)) {
		$strona = $_GET['strona'];
	}else{
		$strona = 1;
	}
	
	$start = ($strona - 1) * $rekordow_na_stronie;

		$stmt = $db->query("SELECT * FROM `historia` ORDER BY `historia`.`id` DESC LIMIT $start ,$rekordow_na_stronie");

			while($wiersz = $stmt->fetch(PDO::FETCH_ASSOC)){
				$data_utw			= $wiersz['data_utw'];	$data_utw = date('d-m-Y, H:i:s', $data_utw);
				$ip					= $wiersz['ip'];
				$podstrona			= $wiersz['podstrona'];
				$system				= $wiersz['system'];
				$przegladarki		= $wiersz['przegladarki'];
				$color				= $wiersz['color'];
				$ekran				= $wiersz['ekran'];
				$jezyk				= $wiersz['jezyk'];
				$ciaguser			= $wiersz['ciaguser'];
				
				echo'
				<tr>
					<td class="text-muted small">'.$data_utw.'</td> <td class="text-muted small">'.$ip.'</td> <td class="text-muted small">'.$podstrona.'</td> <td class="text-muted small">'.$system.'</td> <td class="text-muted small">'.$przegladarki.'</td> <td class="text-muted small">'.$color.' bit.</td> <td class="text-muted small">'.$ekran.'</td> <td class="text-muted small">'.$jezyk.'</td> <td class="text-muted small">'.$ciaguser.'</td>
				</tr>';
			}
?>
		</table>
		</div>
<?php
		echo wskaznik($strona, $liczba_stron);	//stronnicowanie
?>

		<form action="" method="post">
			<fieldset class="border p-2">
			
				<legend class="w-auto">Usuń Historię</legend>			
				
				<button type="button" class="btn btn-danger btn-lg btn-block my-4" data-toggle="modal" data-target="#okienko_usun"><i class="material-icons">delete_forever</i> Usuń Historię <i class="material-icons">delete_forever</i></button>
			
			</fieldset>			
		</form>
		
	<!-- Modal -->
	<div class="modal fade" id="okienko_usun">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
      
				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">Czy chcesz usunąć całą Historię ?</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
        
				<!-- Modal body -->
				<div class="modal-body">
					<form action="historia.php" method="post" class="form-horizontal">
						<fieldset class="border p-2">
							<legend class="w-auto">Pomoc</legend>
							<p class="text-muted small">Operacją tą stosuje się gdy jest już bardzo dużo rekordów w Historii. Po uruchomieniu tej operacji, przybywa nam również wolnego miejsca w Bazie Danych. Po tym zabiegu cała Historia zostanie bezpowrotnie usunięta.</p>
						</fieldset>
				</div>
        
				<!-- Modal footer -->
				<div class="modal-footer">
				
						<input type="hidden" value="Historia" name="tabelka">
				
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Nie</button>
						<button type="submit" class="btn btn-success" name="wyslij_7" title="tak usuń">Tak</button>
					</form>
				</div>
        
			</div>
		</div>
	</div>
		
	<hr />
	
<p>
	<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
		<i class="material-icons">live_help</i> Historia
	</button>
</p>
<div class="collapse" id="collapseExample">
	<div class="card card-body">
		Dane zawarte w powyższej tabeli pokazują wszystkie wejścia na stronę monitorowaną ze szczegółami takimi jak: data, nr.ip, podstrona, system, przeglądarka, color, ekran, język i ciąg user agent. User Agent według Wikipedi jest to aplikacja kliencka, nagłówek zawierający tzw. user agent string (UAString) służy serwisom internetowym (np. aplikacji napisanej w języku PHP) do rozpoznania typu programu klienckiego, również do budowania statystyk odwiedzin witryn WWW przez różne przeglądarki bądź roboty. Dane zapisywane są od góry tabeli, czyli najnowsza historia znajduje się na górze.
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