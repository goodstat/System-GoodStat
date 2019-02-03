<?php
//--- dolaczenie plikow
if(file_exists('config.php')) {
	include('config.php');
	include('inc/baza_polacz.php');
}
	include('funkcje/funkcje.php');
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
			<h1>Kod Java-Script <span>do wklejenia</span></h1>
		</div>
		
<?php
//======== do kodu JAVASCRIPT
	$do_kodu_java = $_SERVER['SERVER_NAME'].''.str_replace("kod_javascript.php","zapis",$_SERVER['SCRIPT_NAME']);	
//======== do kodu JAVASCRIPT
?>

	<script type="text/javascript">
		function selectText_txt1() {
			var oTextbox1 = document.getElementById("txt1");
			oTextbox1.focus();
			oTextbox1.select();
		}
	</script>
<div class="row">
	<div class='col-lg-6 col-md-6 col-sm-12 col-xs-12'>
<?php
echo"
<pre>
<textarea rows='11' cols='30' id='txt1' class='form-control small'>
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
";
?>	
	</div>

	<div class='col-lg-6 col-md-6 col-sm-12 col-xs-12'>
		<h3> O kodzie JavaScript.</h3>
		<ul>
			<li><span class='glyphicon glyphicon-hand-left'></span> Zaznacz dokładnie cały kod JavaScript aby go skopiować i wklej na każdą podstronę którą chcesz monitorować, kod wklej na początku sekcji <strong>&lt;BODY&gt;</strong>.</li>
			<li>Pierwsze analizy z monitoringu Twojej strony internetowej, widoczne będą natychmiast po wklejeniu kodu JavaScript.</li>
			<li>Kod JavaScript na Twojej stronie jest niezbędny, ponieważ za jego pomocą system GoodStat zlicza i zapisuje statystyki.</li>
		</ul>
		<hr />
		<input type='button' class='btn btn-primary js-textareacopybtn' value='Zaznacz żeby skopiować kod JavaScript' onclick='selectText_txt1()' />
		<br /><br />
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