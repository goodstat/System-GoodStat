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
			<h1>Wizyty <span><?php echo 'Rok: '.$_GET['rok']; ?></span></h1>
		</div>		

<div class="row">
<div class="col-sm">
	<div class="btn-group" role="group" aria-label="...">

		<!-- lata -->
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<?php echo 'Rok <b>'.$_GET['rok'].'</b>'; ?>
				<span class="caret"></span>
			</button>
			<ul class="dropdown-menu">
	<?php
			$stmt = $db->query("SELECT * FROM `lata_kal` ORDER BY `lata_kal`.`lata` ASC");

				while($wiersz = $stmt->fetch(PDO::FETCH_ASSOC)){
					$rok = $wiersz['lata'];
					echo'<a href="wizyty.php?rok='.$rok.'" class="dropdown-item'; if($rok == $_GET['rok']){echo' active';} echo'">'.$rok.'</a>';
				}
	?>
			</ul>
			
		</div>
		
		<!-- miesiace -->
		<div class="btn-group" role="group">
			<button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<?php echo 'Miesiąc <b>'.$_GET['m'].'</b>'; ?>
				<span class="caret"></span>
			</button>
			<ul class="dropdown-menu">
	<?php				
					echo'<a href="wizyty.php?rok='.$_GET['rok'].'&m=1" class="dropdown-item'; if($_GET['m'] == 1){echo' active';} echo'">Styczeń</a>';
					echo'<a href="wizyty.php?rok='.$_GET['rok'].'&m=2" class="dropdown-item'; if($_GET['m'] == 2){echo' active';} echo'">Luty</a>';
					echo'<a href="wizyty.php?rok='.$_GET['rok'].'&m=3" class="dropdown-item'; if($_GET['m'] == 3){echo' active';} echo'">Marzec</a>';
					echo'<a href="wizyty.php?rok='.$_GET['rok'].'&m=4" class="dropdown-item'; if($_GET['m'] == 4){echo' active';} echo'">Kwiecień</a>';
					echo'<a href="wizyty.php?rok='.$_GET['rok'].'&m=5" class="dropdown-item'; if($_GET['m'] == 5){echo' active';} echo'">Maj</a>';
					echo'<a href="wizyty.php?rok='.$_GET['rok'].'&m=6" class="dropdown-item'; if($_GET['m'] == 6){echo' active';} echo'">Czerwiec</a>';
					echo'<a href="wizyty.php?rok='.$_GET['rok'].'&m=7" class="dropdown-item'; if($_GET['m'] == 7){echo' active';} echo'">Lipiec</a>';
					echo'<a href="wizyty.php?rok='.$_GET['rok'].'&m=8" class="dropdown-item'; if($_GET['m'] == 8){echo' active';} echo'">Sierpień</a>';
					echo'<a href="wizyty.php?rok='.$_GET['rok'].'&m=9" class="dropdown-item'; if($_GET['m'] == 9){echo' active';} echo'">Wrzesień</a>';
					echo'<a href="wizyty.php?rok='.$_GET['rok'].'&m=10" class="dropdown-item'; if($_GET['m'] == 10){echo' active';} echo'">Październik</a>';
					echo'<a href="wizyty.php?rok='.$_GET['rok'].'&m=11" class="dropdown-item'; if($_GET['m'] == 11){echo' active';} echo'">Listopad</a>';
					echo'<a href="wizyty.php?rok='.$_GET['rok'].'&m=12" class="dropdown-item'; if($_GET['m'] == 12){echo' active';} echo'">Grudzień</a>';
	?>
			</ul>
			
		</div>

	</div>
</div>

	<div class="col-sm" style="margin-top: 5px; margin-bottom: 5px;">
		<form action="" class="form-inline" method="post">

				<div class="form-group row">
					<label for="inputWykres" class="col-sm-2 col-form-label text-muted">wykres</label>
					
					<div class="col-sm">
						<select name="rodz_wykresu" id="inputWykres" class="form-control form-control-sm">
							<option value="bar" <?php if($_SESSION['sesja_uzyt']['wykres'] == 'bar'){echo 'selected';} ?>>Bar</option>
							<option value="line" <?php if($_SESSION['sesja_uzyt']['wykres'] == 'line'){echo 'selected';} ?>>Line</option>
							<option value="radar" <?php if($_SESSION['sesja_uzyt']['wykres'] == 'radar'){echo 'selected';} ?>>Radar</option>
							<option value="polarArea" <?php if($_SESSION['sesja_uzyt']['wykres'] == 'polarArea'){echo 'selected';} ?>>Polar Area</option>
						</select>
					</div>
				</div>

				 <div class="form-group row">
					<div class="col-sm">
						<button type="submit" name="wyslij_wykres" class="btn btn-primary btn-sm">zmień wykres</button>
					</div>
				 </div>

		</form>
	</div>
</div><!-- /row -->
	
<?php
if(!isset($_GET['m']) AND !isset($_GET['t'])){
//---------------------------------------Pokazuje wykres ROKU (miesiące)

	include('inc/odczyt-stat/wizyty-rok.php');
	
}else{
//---------------------------------------Pokazuje wykres MIESIECZNY (dni)

	include('inc/odczyt-stat/wizyty-miesiac.php');
}
?>

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

</body>
</html>