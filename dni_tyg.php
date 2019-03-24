<?php
//--- dolaczenie plikow
if(file_exists('config.php')) {
	include('config.php');
	include('inc/baza_polacz.php');
}
	include('funkcje/funkcje.php');
	include('funkcje/funkcje_odczytu.php');
	include("inc/sesje.php");
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
			<h1>Dni Tygodnia <span></span></h1>
		</div>
<?php
		$dane_g = array(); //zainicjowanie tablicy bez wartosci

		$stmt = $db->query("SELECT * FROM `dni_tyg` ORDER BY `dni_tyg`.`dzien` ASC");

			while($wiersz = $stmt->fetch(PDO::FETCH_ASSOC)){
				$wejscia = $wiersz['wejscia'];
				
				$dane_g[] = $wejscia;
				$suma = $suma + $wejscia; //sumuje
			}

	szukaj_naj_godziny('dni_tyg');
?>

<?php	
	echo'
	<div class="table-responsive">
		<table class="table table-striped table-hover small table-sm">
		<tr>
			<th>dzień</th> <th>wizyty</th> <th>wykres</th>
		</tr>';

				reset($dane_g); // wskazanie na pocz?ek tablicy
				$wartosc = current($dane_g);
				
				if($od==0){$a = -1;}	
				$dzien = 1;

			for ($i = 0; $i < count($dane_g); $i++) 
			{
				
				if($i == '0'){$tydzien[$i] = 'Niedziela';}else
				if($i == '1'){$tydzien[$i] = 'Poniedziałek';}else
				if($i == '2'){$tydzien[$i] = 'Wtorek';}else
				if($i == '3'){$tydzien[$i] = 'Środa';}else
				if($i == '4'){$tydzien[$i] = 'Czwartek';}else
				if($i == '5'){$tydzien[$i] = 'Piątek';}else
				if($i == '6'){$tydzien[$i] = 'Sobota';}
				
				if($dane_g[$i] != 0){
					// obliczanie wysokosci slupka
					$szer = ($dane_g[$i] / $naj_g) * 200; $szer = round($szer, 0);
				}else{$szer = 1;}
		
				echo'
				<tr>
					<td class="text-muted">'.$tydzien[$i].'</td> <td><span class="label-dane">'.$dane_g[$i].'</span></td> <td><div class="row_slupki_poziom ttt" style="width: '.$szer.'px;" data-toggle="tooltip" data-placement="right" title="'.$dane_g[$i].' wiz."></div></td>
				</tr>';
			}

	echo'
		</table>
	';
	
	echo'</div>';
?>


	<hr />
	
<p>
	<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
		<i class="material-icons">live_help</i> Co znaczą te dane ?
	</button>
</p>
<div class="collapse" id="collapseExample">
	<div class="card card-body">
		Dane zawarte w powyższej tabeli wskazują dni tygodnia w których najczęściej stwierdzono Nową Wizytę na stronie monitorowanej, dzięki temu można określić w jakim dniu tygodnia najczęściej wchodzą nowi Użytkownicy.
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