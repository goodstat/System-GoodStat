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
			<h1>Sekcja <span>HEAD</span></h1>
		</div>
		



<?php

	$result = getUrlData(ADRES_STR);
?>
	<div class="col-sm-12">
		<div class="card mb-3">
			<div class="card-header">
				title
			</div>
			<ul class="list-group list-group-flush">
				<li class="list-group-item"><?php echo $result['title'].' <small class="text-muted">- ilość znaków: '; if((strlen($result['title']) > 10) AND (strlen($result['title']) < 70)){ echo ''.strlen($result['title']).' - </small> <span class="badge badge-success">OK</span>'; }else{ echo ''.strlen($result['title']).' - </small> <span class="badge badge-danger">NIE OK!</span>'; } ?></li>
				<li class="list-group-item"><small class="text-muted">Optymalna ilość znaków dla TITLE wraz ze spacjami powinna wynosić od 10 do 70 znaków.</small></li>
			</ul>
		</div>
	</div>

<?php
	foreach ( $result['metaTags'] as $zmienne_head => $zmi_head )
	{
		echo'<div class="col-sm-12">';
		echo'<div class="card mb-3">';
		echo '<div class="card-header">' . $zmienne_head . '</div>';
		
		echo'<ul class="list-group list-group-flush">';

			echo '<li class="list-group-item">' . $result['metaTags'][$zmienne_head]['value']; if($zmienne_head == 'description'){ echo'<small class="text-muted">- ilość znaków: '; if((strlen($result['metaTags']['description']['value']) > 70) AND (strlen($result['metaTags']['description']['value']) < 320)){ echo ''.strlen($result['metaTags']['description']['value']).' - </small> <span class="badge badge-success">OK</span>'; }else{ echo ''.strlen($result['metaTags']['description']['value']).' - </small><span class="badge badge-danger">NIE OK!</span>'; } } echo'</li>';
			
			if($zmienne_head == 'description'){ echo'<li class="list-group-item"><small class="text-muted">Optymalna ilość znaków dla DESCRIPTION wraz ze spacjami powinna wynosić od 70 do 320 znaków.</small></li>'; }
		
		echo'</ul>';
		
		echo'</div>';
		echo'</div>';
	}
?>

	<hr />
	
<p>
	<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
		<i class="material-icons">live_help</i> O sekcji HEAD
	</button>
</p>
<div class="collapse" id="collapseExample">
	<div class="card card-body">
		Sekcja HEAD, to sekcja nagłówkowa dokumentu, chociaż niewidoczna na stronie, pełni bardzo ważną funkcję informacyjną dla wyszukiwarek, ma też ważne znaczenie dla pozycjonowania strony, jest nagłówkiem w dokumencie HTML lub XHTML. Pomiędzy otwierającym i zamykającym znacznikiem HEAD znajduje się prolog dokumentu. Zwykle jest to kilka znaczników, przede wszystkim tytuł strony, informacje o autorze strony, kodowaniu i instrukcje dla przeglądarki oraz wyszukiwarek.
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