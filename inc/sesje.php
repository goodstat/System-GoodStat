<?php
$lifetime = (60 * 60 * 24) * 7; //### (60 * 60) * wartosc w godzinach np. 7 - znaczy to 7 dni
session_set_cookie_params($lifetime,"/",$_SERVER['SERVER_NAME']);
session_start();

	if(isset($_SERVER['HTTP_CLIENT_IP'])){
		$nr_ip = $_SERVER['HTTP_CLIENT_IP'];
	}
	else if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
		$nr_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	}else{
		$nr_ip = $_SERVER['REMOTE_ADDR']; 
	}

	$nr_ip = trim($nr_ip);

if(!isset($_SESSION['sesja_uzyt']))
{
	$_SESSION['sesja_uzyt'] 				= array();	
	$_SESSION['sesja_uzyt']['wykres'] 		= 'bar'; // bar, line, radar, polarArea
}

//#### logowanie
if(isset($_POST['wyslij_loguj'])){
	$h = $_POST['h']; 
	$haslo_zakodowane = sha1($h);
	
		$stmt = $db->query("SELECT * FROM uzyt_stat WHERE login='{$_POST['l']}' AND haslo='$haslo_zakodowane' LIMIT 1");

				if($stmt->rowCount() == 1){
					while($wiersz = $stmt->fetch(PDO::FETCH_ASSOC)){
						$id_loginu 			= $wiersz['id'];
						$login 				= $wiersz['login'];
					}//while	

					$_SESSION['sesja_uzyt']['zalogowany'] 		= $login;
					$_SESSION['sesja_uzyt']['id_loginu'] 		= $id_loginu;
					
						//zapis do logow systemu						
						$stmt = $db->prepare(  
							"INSERT INTO hist_operacji (id, opis, data_utw)
								VALUES (0, 'Zalogowal sie login: <b>$login</b>, nr.IP: $nr_ip', ".time().")"
						);
						
						$stmt->execute();
					
					header("Location: index.php"); // ucieka do strony
					
				}else{
					$wynik_logowania = 'zle';
				}
}

//#### zmien wykres
if(isset($_POST['wyslij_wykres'])){
	
	$rodz_wykresu = $_POST['rodz_wykresu']; 	

	$_SESSION['sesja_uzyt']['wykres'] 		= $rodz_wykresu;

}

