<?php
//--- dolaczenie plikow
	include('../funkcje/funkcje.php');
	include("../inc/sesje.php");
?>
<!doctype html>
<html lang="pl">
<head>

<?php
//--- dolaczenie plikow
	include('../inc/head_instal.php');
?>

</head>
	
<body>

<link rel="stylesheet" href="css/goodstat.css">

<?php
	include('../inc/baner_instal_2.php');
?>

<div class="container tresc">

	<div class="page-header">
		<h1><img src="../images/loading_instal.gif" /> Instalacja Systemu GoodStat</h1>
	</div>
	
  <div class="row">
	<div class="col-md-12">
		
	</div>
  </div>
	
	
<div class="row my-2">

	<div class="col-sm-4">
		<div class="card text-white bg-success">
			<div class="card-body">
				<h3 class="card-title">1 - Zbieranie Informacji</h3>
					<p class="card-text">Dane niezbędne do prawidłowego działania Systemu GoodStat.</p>
			</div>
		</div>
	</div>

	<div class="col-sm-4">
		<div class="card text-white bg-success">
			<div class="card-body">
				<h4 class="card-title">2 - Baza Danych</h4>
					<p class="card-text">Czynności związane z bazą danych. Pamiętaj żeby utworzyć na swoim serwerze bazę danych dla Systemu GoodStat.</p>
			</div>
		</div>
	</div>
	
	<div class="col-sm-4">
<?php
	if(isset ($_POST['wyslij3'])){
		include('baza_danych.php');
	}
	
	if($problem == TRUE){ echo '<div class="card text-white bg-danger">'; }else{ echo '<div class="card text-white bg-success">'; }
?>
			<div class="card-body">
				<h4 class="card-title">3 - Wynik Instalacji</h4>
					<p class="card-text">Wynik instalacji i czynności konfiguracyjne System GoodStat.</p>
			</div>
		</div>
	</div>

</div>
	



<?php

	if(isset ($_POST['wyslij3'])){

		$problem = FALSE;				
		
		//########## sprawdzenie BD
		include('baza_danych.php');
		
			if (!$problem){
				
				//########## instalacja
				include('tabele.php');

					if ($wp = fopen ("../config.php",'w+')){

						$dane = 
						'<?php ' .		"\r\n"	.
							'//##### glowne parametry strony'	.	"\r\n"	.
							'define(\'ADRES_BAZY\', '		.	'\'' 	. 	$_POST['adres_bazy'] 	. '\''	.	'); '	.	"\r\n"	.
							'define(\'LOGIN_BAZY\', '		.	'\'' 	. 	$_POST['login_bazy'] 	. '\''	.	'); '	.	"\r\n"	.
							'define(\'HASLO_BAZY\', '		.	'\'' 	. 	$_POST['haslo_bazy'] 	. '\''	.	'); '	.	"\r\n"	.
							'define(\'NAZWA_BAZY\', '		.	'\'' 	. 	$_POST['nazwa_bazy'] 	. '\''	.	'); '	.	"\r\n";

			
						//zapis danych i zamkniecie pliku
						fwrite ($wp, $dane);
						fclose ($wp);

					}
					
	//wyslanie maila
//	include('email_instalacja.php');
				
					echo' 
						<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<span class="glyphicon glyphicon-ok-circle"></span> <strong>Sukces!</strong> Wszystko przebiegło pomyślnie.
						</div>';
?>
						
	<script type="text/javascript">
		function selectText_txt1() {
			var oTextbox1 = document.getElementById("txt1");
			oTextbox1.focus();
			oTextbox1.select();
		}
	</script>
	
<?php
//======== do kodu JAVASCRIPT
	$do_kodu_java = $_SERVER['SERVER_NAME'].''.str_replace("index_3.php","zapis",$_SERVER['SCRIPT_NAME']);	
//======== do kodu JAVASCRIPT
?>
	
<?php
echo"
<div class='row'>

	<div class='col-lg-6 col-md-6 col-sm-12 col-xs-12'>
	
		<h2><i class='material-icons'>file_copy</i> Kod JavaScript do wklejenia na Twoją stronę:</h2
<pre>
<textarea rows='11' cols='60' id='txt1' class='form-control small'>
<!-- start statystyki stron GoodStat -->
<script language='javascript'>
<!--
var ipath='$do_kodu_java'
document.write('<SCR' + 'IPT LANGUAGE=\"JavaScript\" SRC=\"http://'+ ipath +'/stat.js\"><\/SCR' + 'IPT>');
//-->
</script>
<!-- stop statystyki stron GoodStat -->
</textarea>
</pre>

	</div>
	
	<div class='col-lg-6 col-md-6 col-sm-12 col-xs-12'>
		<h2><i class='material-icons'>help</i> Co dalej ?</h2>
		<ul>
			<li><span class='glyphicon glyphicon-hand-left'></span> Zaznacz dokładnie cały kod JavaScript aby go skopiowaći i wklej na każdą podstronę, którą chcesz monitorować, kod wklej na początku sekcji <strong>&lt;BODY&gt;</strong>.</li>
			<li>Pierwsze analizy z monitoringu Twojej strony internetowej, widoczne będą natychmiast po wklejeniu kodu JavaScript.</li>
			<li>Dostęp do kodu JavaScript będzie również dostępny po zalogowaniu do systemu GoodStat w dziale: \"<strong>Ustawienia/Kod JavaScript</strong>\".</li>
		</ul>
		
		<input type='button' class='btn btn-secondary js-textareacopybtn' value='Zaznacz żeby skopiować kod JavaScript' onclick='selectText_txt1()' />
	</div>
	
			<div class='col-md-12'>
				<div class='img-rounded' style='padding: 0px 50px; margin: 15px 0 15px 0;'>
					
					<a href='../index.php' class='btn btn-primary btn-lg btn-block'>MOŻESZ SIĘ TERAZ ZALOGOWAĆ <span class='glyphicon glyphicon-triangle-right'></span></a>
					
				</div>
			</div>

</div>
";

						
			}else{
					echo' 
						<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<span class="glyphicon glyphicon-warning-sign"></span> <strong>Błąd!</strong> Coś poszło Źle - system Goodstat nie został zainstalowany!
						</div>
						
	<div class="container">
	  <div class="row">
		<div class="col-md-12">
			<div class="img-rounded" style="padding: 10px 30px;">
				<a href="../index.php" class="btn btn-primary btn-lg btn-block"><i class="material-icons">chevron_left</i> POWTÓRZ INSTALACJĘ</a>
			</div>
		</div>
	  </div>
	</div>	
						';
			}
	}
		
?>















<?php
echo'
	<div class="page-header">
		<h2>Baza Danych</h2>
	</div>
<table class="table">
	<tbody>
    <tr>
		<td scope="row">nazwa serwera</td>
		<th>'.$_POST['adres_bazy'].'</th>
    </tr>
    <tr>
		<td scope="row">login bazy</td>
		<th>'.$_POST['login_bazy'].'</th>
    </tr>
    <tr>
		<td scope="row">hasło bazy</td>
		<th>'.$_POST['haslo_bazy'].'</th>
    </tr>
    <tr>
		<td scope="row">nazwa bazy</td>
		<th>'.$_POST['nazwa_bazy'].'</th>
    </tr>

  </tbody>
</table>

	<div class="page-header">
		<h2>Zebrane Dane</h2>
	</div>
<table class="table">
	<tbody>
    <tr>
		<td scope="row">e-mail</td>
		<th>'.$_POST['email'].'</th>
    </tr>
    <tr>
		<td scope="row">login</td>
		<th>'.$_POST['login'].'</th>
    </tr>
    <tr>
		<td scope="row">hasło</td>
		<th>'.$_POST['haslo1'].'</th>
    </tr>
    <tr>
		<td scope="row">adres strony www</td>
		<th>'.$_POST['adres_str'].'</th>
    </tr>
    <tr>
		<td scope="row">akceptacja regulaminu</td>
		<th>tak</th>
    </tr>

  </tbody>
</table>';
?>
	

</div>
  


<?php
	include('../inc/stopka_instal_2.php');
	include('../inc/stopka_bootstrap_instal.php');
?>

</body>
</html>

