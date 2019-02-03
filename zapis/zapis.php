<?php
if(file_exists('../config.php')){
//----------------------------------------------------------------------
	include('../config.php');
	include('../inc/baza_polacz.php');

//----------------------------------------------------------------------

$data_dodania = time();

//##### ZMIENNE SKRYPTU
$ekran 					= $_GET['ekran']; $ekran = trim($ekran);	// rozdzielczosc
$color 					= $_GET['color'];							//ilosc kolorów
$przegladarka 			= $_GET['przegladarka']; $przegladarka = trim($przegladarka);
$system 				= $_GET['system']; $system = trim($system);
$jezyk_przegladarki 	= $_GET['jezyk_przegladarki']; $jezyk_przegladarki = trim($jezyk_przegladarki);
$podstrona 				= $_GET['podstrona'];	$podstrona = trim($podstrona);	$podstrona = str_replace("|","&",$_GET['podstrona']);
$idref 					= $_GET['idref'];							//przekliknjêto ze strony
$seo 					= $_GET['seo'];								//strona z historii
$ciaguser 				= $_GET['ciaguser'];						//ciag user agent

	if($_SERVER['HTTP_CLIENT_IP']){
		$nr_ip = $_SERVER['HTTP_CLIENT_IP'];
	}
	else if($_SERVER['HTTP_X_FORWARDED_FOR']){
		$nr_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	}else{
		$nr_ip = $_SERVER['REMOTE_ADDR']; 
	}

	$nr_ip = trim($nr_ip);

//##### FUNKCJE
	include('../funkcje/funkcje_zapisu.php');

//##### NR IP
$nazwa_tab = date(Y).'_nr_ip'; $nazwa_tab = trim($nazwa_tab);

$stmt = $db->query("SELECT * FROM $nazwa_tab WHERE `nr_ip` = '".$nr_ip."' AND dzien_roku='".date(z)."'  LIMIT 1");

	if($stmt->rowCount() == 0){
		//dodanie nowego nr IP do tabeli
		$stmt = $db->prepare(
			"INSERT INTO $nazwa_tab (nr_ip, dzien_roku, dzien, miesiac, ods, data_utw)
			VALUES ('".$nr_ip."', '".date(z)."', '".date(j)."', '".date(n)."', '1', '".time()."')"
		);		
		$stmt->execute();	//dodanie nr ip do tabeli nr_ip
	}else{
		//dodanie o jeden do nr ip
		if(@$stmt->execute()){
			while($wiersz = $stmt->fetch(PDO::FETCH_ASSOC)){
				$ods = $wiersz['ods']; $ods++;
				
				$stm = $db->prepare("UPDATE $nazwa_tab SET `ods` = '$ods', `data_utw` = '".time()."' WHERE `nr_ip` = '".$nr_ip."' AND `dzien_roku`='".date(z)."' LIMIT 1;");
				$stm->execute();	//WYKONANIE ZAPYTANIA	
			}// while
		}//if
	}

//##### ODS£ONY
$nazwa_tab = date(Y).'_wiz_ods'; $nazwa_tab = trim($nazwa_tab);

$stmt = $db->query("SELECT id, ods, ".date(G)."ods FROM $nazwa_tab WHERE id='".date(z)."' LIMIT 1");

//wykonanie zapytania
	if(@$stmt->execute()){
		while($wiersz = $stmt->fetch(PDO::FETCH_ASSOC)){
			$ods = $wiersz['ods']; $ods++;
			$god_ods = $wiersz[date(G).'ods']; $god_ods++;
			
			$stm = $db->prepare("UPDATE $nazwa_tab SET `ods` = '$ods', `".date(G)."ods` = '$god_ods' WHERE `id` = '".date(z)."' LIMIT 1;");
			$stm->execute();	//WYKONANIE ZAPYTANIA	
		}// while
	}//if
	

//------------------------------------------------------------ start nowych wizyt ------------------------------------------------------------------------
//##### NUMERY IP dzis
$nazwa_tab = 'nr_ip_dzis'; $nazwa_tab = trim($nazwa_tab);

//-- Odczytanie dnia dodania nr ip do tabeli
$stmt = $db->query("SELECT nr_ip, wejscia, dzien FROM $nazwa_tab LIMIT 1");

	while($wiersz = $stmt->fetch(PDO::FETCH_ASSOC)){$dzien_dodania = $wiersz['dzien'];}
	
	//kasowanie danych z tabeli
	if($dzien_dodania != date(j)){
		$stmt = $db->prepare("DELETE  FROM $nazwa_tab");
		$stmt->execute();	//WYKONANIE ZAPYTANIA	
	}//zamkniecie if
	
	$stm = $db->query("SELECT * FROM $nazwa_tab WHERE `nr_ip` = '$nr_ip' LIMIT 1");
		
	if($stm->rowCount() == 0){
		//dodanie nowego nr IP do tabeli
		$stmt = $db->prepare(
			"INSERT INTO $nazwa_tab (nr_ip, wejscia, dzien)
			VALUES ('$nr_ip', '1', '".date(j)."')"
		);		
		$stmt->execute();	//dodanie nr ip do tabeli nr_ip			

//##### WIZYTY
			$nazwa_tab =  date(Y).'_wiz_ods'; $nazwa_tab = trim($nazwa_tab);			
			$stmt = $db->query("SELECT id, wiz, ".date(G)."wiz FROM $nazwa_tab WHERE id='".date(z)."' LIMIT 1");

			//wykonanie zapytania
			if(@$stmt->execute()){
		
				while($wiersz = $stmt->fetch(PDO::FETCH_ASSOC)){
					$wiz = $wiersz['wiz']; $wiz++;
					$god_wiz = $wiersz[date(G).'wiz']; $god_wiz++;

					$stmt = $db->prepare("UPDATE $nazwa_tab SET `wiz` = '$wiz', `".date(G).'wiz'."` = '$god_wiz' WHERE `id` = '".date(z)."' LIMIT 1;");
					$stmt->execute();	//WYKONANIE ZAPYTANIA	
					}//zamkniecie while
			}// zamkniecie if
				
//##### WIZYTY DNI TYG
			$nazwa_tab = 'dni_tyg'; $nazwa_tab = trim($nazwa_tab);

			$stmt = $db->prepare("SELECT dzien, wejscia FROM $nazwa_tab WHERE dzien='".date(w)."' LIMIT 1");

			//wykonanie zapytania
				if(@$stmt->execute()){
					
					while($wiersz = $stmt->fetch(PDO::FETCH_ASSOC)){
						$wejscia = $wiersz['wejscia']; $wejscia++;
						
						$stmt = $db->prepare("UPDATE $nazwa_tab SET `wejscia` = '$wejscia' WHERE `dzien` = '".date(w)."' LIMIT 1;");
						$stmt->execute();	//WYKONANIE ZAPYTANIA	
					}// while
				}//if
				
//##### WIZYTY GODZIN
			$nazwa_tab = 'god'; $nazwa_tab = trim($nazwa_tab);

			$stmt = $db->prepare("SELECT god, wejscia FROM $nazwa_tab WHERE god='".date(G)."' LIMIT 1");

			//wykonanie zapytania
				if(@$stmt->execute()){
					
					while($wiersz = $stmt->fetch(PDO::FETCH_ASSOC)){
						$wejscia = $wiersz['wejscia']; $wejscia++;
						
						$stmt = $db->prepare("UPDATE $nazwa_tab SET `wejscia` = '$wejscia' WHERE `god` = '".date(G)."' LIMIT 1;");
						$stmt->execute();	//WYKONANIE ZAPYTANIA	
					}// while
				}//if
				
//##### Wizyty Techniczne

			// PODCZAS NOWEJ WIZYTY DODAJE O JEDEN DO STATYSTYK TECHNICZNYCH TZ DO: PRZEGLADARKI, JEZYK, SYSTEMY, ROZDZIELCZOSC, KOLORY
			//##### Wizyty Techniczne
				include("../inc/wizyty_tech.php");
			//##### Wizyty Techniczne					
				
				
	}//zamkniecie if
	 else{
			$stmt = $db->prepare("SELECT nr_ip, wejscia FROM $nazwa_tab WHERE nr_ip='$nr_ip' LIMIT 1");

			//wykonanie zapytania
			if(@$stmt->execute()){
		
				while($wiersz = $stmt->fetch(PDO::FETCH_ASSOC)){
					$wejscia = $wiersz['wejscia']; $wejscia++;

					$stmt = $db->prepare("UPDATE $nazwa_tab SET `wejscia` = '$wejscia' WHERE `nr_ip` = '$nr_ip' LIMIT 1;");
					$stmt->execute();	//WYKONANIE ZAPYTANIA	
				}//zamkniecie while
			}// if	
	 }//zamkniecie else
		 
//------------------------------------------------------------ koniec nowych wizyt ------------------------------------------------------------------------


//##### PODSTRONY
			$nazwa_tab =  'podstrony'; $nazwa_tab = trim($nazwa_tab);
			$stmt = $db->query("SELECT * FROM $nazwa_tab WHERE podstrony='$podstrona' LIMIT 1");
			
			if($stmt->rowCount() == 0){
			
					//dodanie nowej przegladarki do tabeli
					$stmt = $db->prepare(
						"INSERT INTO $nazwa_tab (id, podstrony, wejscia)
						VALUES (0, '".$podstrona."', 1)"
					);		
					$stmt->execute(); //dodanie nr ip do tabeli
			
			}else{

					//wykonanie zapytania
					if(@$stmt->execute()){
						
						while($wiersz = $stmt->fetch(PDO::FETCH_ASSOC)){
							$wejscia = $wiersz['wejscia']; $wejscia++;
							$nr_ip_id = $wiersz['id'];
							
							$stmt = $db->prepare("UPDATE $nazwa_tab SET `wejscia` = '$wejscia' WHERE `id` = '".$nr_ip_id."' LIMIT 1;");
							$stmt->execute();	//WYKONANIE ZAPYTANIA	
						}// while
					}//if

				}
			
//##### HISTORIA
$nazwa_tab = 'historia'; $nazwa_tab = trim($nazwa_tab);

					//dodanie nowej przegladarki do tabeli
					$stmt = $db->prepare(
						"INSERT INTO $nazwa_tab (id, data_utw, ip, podstrona, system, przegladarki, color, ekran, jezyk, ciaguser)
						VALUES (0, '".time()."', '$nr_ip', '".$podstrona."', '".$_GET['system']."', '".$_GET['przegladarka']."', '".$_GET['color']."', '".$_GET['ekran']."', '".$_GET['jezyk_przegladarki']."', '".$_GET['ciaguser']."')"
					);		
					$stmt->execute(); //dodanie nr ip do tabeli			
			
//##### SEO
			include("../inc/seo.php");	
	
//----------------------------------------------------------------------
}//### if file_exists







/**/


