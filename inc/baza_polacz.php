<?php
//##### połączenie z bazą
   try
   {
		$db = new PDO("mysql:host=".ADRES_BAZY.";dbname=".NAZWA_BAZY.";",LOGIN_BAZY, HASLO_BAZY);
   }
   catch(PDOException $e)
   {
		$problem = TRUE;
		
		echo '<div class="container">';
		
		echo'<pre>';
		
		echo'<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><img src="'.URL_GLOWNY.'images/ikony/nie_Icons.png" style="width: 30px;" /> <strong>Uwaga!</strong> Problem z Bazą Danych! Nie można nawiązać połączenia lub podane dane są nieprawidłowe</div>';

		echo '<p>Połączenie nie mogło zostać utworzone: <b>' . $e->getMessage() . '</b></p>';
		
		echo'</pre>';
		
		echo '</div>';
   }
//##### połączenie z bazą