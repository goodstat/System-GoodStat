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
			<h1>Baza Danych <span></span></h1>
		</div>
		

<?php
$stmt = $db->query("SHOW TABLE STATUS FROM ".NAZWA_BAZY."");

echo'
<div class="table-responsive">
	<table class="table table-striped table-hover small table-sm">
    <tr>
		<th>Name</th> <th>Rows</th> <th>Avg_row_length</th> <th>Data_length</th> <th>Index_length</th> <th>Auto_increment</th> <th>Create_time</th> <th>Update_time</th>
	</tr>';
	
while($wiersz = $stmt->fetch(PDO::FETCH_ASSOC)){

	$suma_rows 				+= $wiersz['Rows'];
	$suma_Avg_row_length 	+= $wiersz['Avg_row_length'];
	$suma_Data_length 		+= $wiersz['Data_length'];
	$suma_Index_length 		+= $wiersz['Index_length'];
	$suma_wielkosci			+= $wiersz['Data_length'] + $wiersz['Index_length'];

	echo'
    <tr>
		<td><span class="text-muted">'.$wiersz['Name'].'</td> <td><span class="text-muted">'.$wiersz['Rows'].'</span></td> <td><span class="text-muted">'.formatSize($wiersz['Avg_row_length']).'</span></td> <td><span class="text-muted">'.formatSize($wiersz['Data_length']).'</span></td> <td><span class="text-muted">'.formatSize($wiersz['Index_length']).'</span></td> <td><span class="text-muted">'.$wiersz['Auto_increment'].'</span></td> <td><span class="text-muted">'.$wiersz['Create_time'].'</span></td> <td><span class="text-muted">'.$wiersz['Update_time'].'</span></td>
	</tr>';
}

echo'
		<tr>
			<th>suma:</th> <th>'.$suma_rows.'</th> <th>'.formatSize($suma_Avg_row_length).'</th> <th>'.formatSize($suma_Data_length).'</th> <th>'.formatSize($suma_Index_length).'</th> <th></th> <th></th> <th></th>
		</tr>
		<tr>
			<th colspan="3">wielkość Bazy:</th> <th>'.formatSize($suma_wielkosci).'</th> <th></th> <th></th> <th></th> <th></th>
		</tr>
	</table>
</div> 
';
?>

	<hr />

<p>
	<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
		<i class="material-icons">live_help</i> Pomoc
	</button>
</p>
<div class="collapse" id="collapseExample">
	<div class="card card-body">
		Zakładka techniczna, dzięki niej można poznać nazwy tabel w Bazie Danych, ich wielkość, ilość rekordów itp.
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