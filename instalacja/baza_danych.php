<?php
   try
   {
		$db = new PDO('mysql:host='.$_POST['adres_bazy'].';dbname='.$_POST['nazwa_bazy'].'', $_POST['login_bazy'], $_POST['haslo_bazy']);
   }
   catch(PDOException $e)
   {
		$problem = TRUE;
		echo'<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-warning-sign"></span> Problem z Bazą Danych! Nie można nawiązać połączenia lub podane dane są nieprawidłowe</div>';
   }
?>