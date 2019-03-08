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
			<h1>Aktualizacja <span></span></h1>
		</div>

		<div class="row justify-content-md-center my-1">
			<div class="col-xl-5 col-lg-6 col-md-6">
<?php
if (isset($_POST['wyslij_aktualizacje'])){
		
		$fp = fopen("http://goodstat.com.pl/!download-goodstat/aktualizacja.txt", "r");
		$wersja_new = fread($fp, 20); $wersja_new = trim("$wersja_new");
		
		if($wersja_new > $wersja_uzyt){
			echo'
				<form>
					<fieldset class="border p-2">
						<legend class="w-auto"></legend>
						<div class="alert-success padding10" role="alert"><i class="material-icons">new_releases</i> JEST NOWA WERSJA SYSTEMU GOODSTAT DO POBRANIA...</div>
						<div class="form-group">

						</div>
						<a class="btn btn-success btn-lg btn-block my-4" href="http://goodstat.com.pl/index.php?file=goodstat_'.$wersja_new.'.zip" role="button" title="Pobierz GoodStat"><i class="material-icons">file_download</i> Pobierz <i class="material-icons">file_download</i></a>
					</fieldset>
				</form>

				<div class="card">
					<div class="card-body">
						<h4>I teraz tak...</h4>
						
							<ol type="1">
								<li class="card-text">Pobierz nową wersję i rozpakuj pobraną paczkę.</li>
								<li class="card-text">Całą zawartość katalogu na Twoim serwerze w którym były pliki starej wersji GoodStat-u - wykasuj. Bazy danych nie ruszaj, zachowasz w ten sposób zapisane statystyki.</li>
								<li class="card-text">Nowe rozpakowane pliki wyślij na serwer w ten sam katalog w którym znajdowała się stara wersja GoodStat-u.</li>
								<li class="card-text">Następnie wejdź do katalogu na serwerze do którego wysłałeś nowe pliki i postępuj zgodnie z instrukcjami na ekranie żeby zainstalować nową wersję.</li>
							</ol>
						
					</div>
				</div>

			';
		}else{
			echo'
				<form>
					<fieldset class="border p-2">
						<legend class="w-auto"></legend>
						<div class="alert-info padding10" role="alert">Masz aktualną wersję Systemu GoodStat.</div>
						<div class="form-group text-muted">
						
						</div>						
					</fieldset>
				</form>';
				
			$fp2 = fopen("http://goodstat.com.pl/!download-goodstat/wiadomosc.txt", "r");
			$wiadomosc = fread($fp2, 2000); $wiadomosc = trim("$wiadomosc");
			
			echo'<div class="padding10">';
			echo $wiadomosc;
			echo'</div>';
		}

}else{
?>
				<form action="aktualizacja.php" method="post">
					<fieldset class="border p-2">
					
						<legend class="w-auto"></legend>
						<div class="form-group">
							<i class="material-icons">youtube_searched_for</i> Sprawdź czy jest nowa wersja GoodStat-u.
						</div>

					</fieldset>
					
					<fieldset class="border tblFooters">
						<button type="submit" name="wyslij_aktualizacje" class="btn btn-primary btn-lg btn-block my-4" title="Kliknij żeby sprawdzić czy jest nowa wersja.">Sprawdź</button>
					</fieldset>
				</form>
<?php
}
?>
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