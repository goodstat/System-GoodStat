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

		<div class="page-header">
			<h1>Nie Pamiętam Hasła <span></span></h1>
		</div>
		

<?php
	if(isset($_SESSION['sesja_uzyt']['zalogowany'])){

	}else{
?>	
<?php
if (!isset($haslo)){
?>
	<div class="jumbotron border">
		<div class="img-rounded postep_0">
			<p class="lead">Jeśli nie pamiętasz hasła do Systemu GoodStat, nic się nie martw, podaj Swój Login, a system automatycznie wygeneruje Nowe Hasło, po zalogowaniu będzie można je zmienić na inne w dziale: <b>System/Zmiana Hasła</b>.</p>
		</div>
	</div>

		<div class="row justify-content-md-center">
			<div class="col-md-4">
				
				<form action="nie_pamietam_hasla.php" method="post">
					<fieldset class="border p-2">
					
						<legend class="w-auto">formularz</legend>

							<div class="form-group">
								<label for="login">login</label>
								<input type="password" class="form-control" id="login" name="l" placeholder="podaj Swój Login" required>
							</div>

						</fieldset>
						
						<fieldset class="border tblFooters">
							<button type="submit" name="wyslij_12" class="btn btn-primary btn-lg btn-block my-4">Wyślij</button>
						</fieldset>
					
				</form>
				
			</div>
		</div>
<?php
}else{
?>
	<div class="jumbotron border">
		<div class="img-rounded postep_0">
			<p class="lead">Nowe Hasło to: <strong><?php echo $haslo; ?></strong> po zalogowaniu będzie można je zmienić na inne w dziale: <b>System/Zmiana Hasła</b>.</p>
		</div>
	</div>
<?php
}
?>

<?php
	}
?>

</div>

<?php
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