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
		$wynik .= " <li class='page-item'><a class='page-link' href='logi.php?strona=1'><i class='material-icons'>first_page</i></a></li> ";
    } else {
        $wynik .= " <li class='page-item disabled'><a class='page-link' href='' tabindex='-1' aria-disabled='true'><i class='material-icons'>first_page</i></a></li>  ";
    }

    $poprzednia = $strona - 1;
    if ($poprzednia > 0) {
        $wynik .= " <li class='page-item'><a class='page-link' href='logi.php?strona=$poprzednia'><i class='material-icons'>navigate_before</i></a></li> ";
    } else {
        $wynik .= " <li class='page-item disabled'><a class='page-link' href=''><i class='material-icons'>navigate_before</i></a></li> ";
    }

    $nastepna = $strona + 1;
    if ($nastepna <= $liczba_stron) {
        $wynik .= " <li class='page-item'><a class='page-link' href='logi.php?strona=$nastepna'><i class='material-icons'>navigate_next</i></a></li> ";
    } else {
        $wynik .= " <li class='page-item disabled'><a class='page-link' href=''><i class='material-icons'>navigate_next</i></a></li> ";
    }

    if ($strona < $liczba_stron) {
        $wynik .= " <li class='page-item'><a class='page-link' href='logi.php?strona=$liczba_stron'><i class='material-icons'>last_page</i></a></li> ";
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
			<h1>Dziennik Systemu <span></span></h1>
		</div>
		
<?php			
//-------------------------------------------------------------------
//STRONNICOWANIE
	$p = array(); //zainiciowanie tablicy $p
	
	$stmt = $db->query("SELECT * FROM hist_operacji");
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
			
	echo'
	<div class="table-responsive">
		<table class="table table-striped table-hover small table-sm">
		<tr>
			<th>#</th> <th>opis</th> <th>data</th>
		</tr>';
		
				$stmt = $db->query("SELECT * FROM hist_operacji ORDER BY id DESC LIMIT $start ,$rekordow_na_stronie");

					while($wiersz = $stmt->fetch(PDO::FETCH_ASSOC)){
						$id		 			= $wiersz['id'];
						$opis 				= $wiersz['opis'];
						$data_utw 			= $wiersz['data_utw']; $data_utw = date('d-m-Y, H:i:s', $data_utw);
						echo'
						<tr>
							<td class="text-muted">'.$id.'</td> <td class="text-muted">'.$opis.'</td> <td class="text-muted">'.$data_utw.'</td> 
						</tr>';			
					}
			
	echo'
		</table>
	</div>';
?>
<?php
		echo wskaznik($strona, $liczba_stron);	//stronnicowanie
?>

		<form action="" method="post">
			<fieldset class="border p-2">
			
				<legend class="w-auto">Usuń Logi</legend>			
				
				<button type="button" class="btn btn-danger btn-lg btn-block my-4" data-toggle="modal" data-target="#okienko_usun"><i class="material-icons">delete_forever</i> Usuń Historię <i class="material-icons">delete_forever</i></button>
			
			</fieldset>			
		</form>
		
	<!-- Modal -->
	<div class="modal fade" id="okienko_usun">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
      
				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">Czy chcesz usunąć wszystkie Logi ?</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
        
				<!-- Modal body -->
				<div class="modal-body">
					<form action="logi.php" method="post" class="form-horizontal">
						<fieldset class="border p-2">
							<legend class="w-auto">Pomoc</legend>
							<p class="text-muted small">Operacją tą stosuje się gdy jest już bardzo dużo rekordów w Logach. Po uruchomieniu tej operacji, przybywa nam również wolnego miejsca w Bazie Danych. Po tym zabiegu wszystkie wpisy zostaną bezpowrotnie usunięte.</p>
						</fieldset>
				</div>
        
				<!-- Modal footer -->
				<div class="modal-footer">
				
						<input type="hidden" value="Historia" name="tabelka">
				
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Nie</button>
						<button type="submit" class="btn btn-success" name="wyslij_11" title="tak usuń">Tak</button>
					</form>
				</div>
        
			</div>
		</div>
	</div>

	<hr />
	
<p>
	<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
		<i class="material-icons">live_help</i> Pomoc
	</button>
</p>
<div class="collapse" id="collapseExample">
	<div class="card card-body">
		Są tu zapisywane wszystkie ważne czynności jakie dokonywane są w systemie GoodStat, tj. logowanie, zmiany haseł itp. Przygotowana została też możliwość Resetu (usunięcia) wszystkich Logów systemu. 
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