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
			<h1>Zmiana Hasła <span></span></h1>
		</div>
		
		<div class="row justify-content-md-center my-1">
			<div class="col-md-4">
				
				<form action="zm_hasla.php" method="post">
					<fieldset class="border p-2">
					
						<legend class="w-auto">formularz zmiany hasła</legend>
					<div class="form-group">
						<label for="login">Login</label>
						<?php echo '<span class="text-success">'.$_SESSION['sesja_uzyt']['zalogowany'].'</span>'; ?>
					</div>
					<div class="form-group">
						<label for="stare_haslo">stare hasło</label>
						<input type="password" class="form-control" id="stare_haslo" name="stare_haslo" placeholder="stare hasło" required>
					</div>
					<div class="form-group">
						<label for="nowe_haslo">nowe hasło</label>
						<input type="password" class="form-control" id="nowe_haslo" name="nowe_haslo" placeholder="nowe hasło" required>
					</div>
					<div class="form-group">
						<label for="nowe_haslo2">powtórz hasło</label>
						<input type="password" class="form-control" id="nowe_haslo2" name="nowe_haslo2" placeholder="powtórz hasło" required>
					</div>

					</fieldset>
					
					<fieldset class="border tblFooters">
						<button type="submit" name="wyslij_10" class="btn btn-primary btn-lg btn-block my-4">Wyślij</button>
					</fieldset>
					
				</form>
				
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