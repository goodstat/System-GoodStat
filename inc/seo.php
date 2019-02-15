<?php
			//###################### Z JAKIEJ KLIKNIETO STRONY
				//$url = trim($url);
				$adres_www = trim($adres_www);
			
				// parsowanie adresu
				$idref_parse = parse_url($idref);
				$ze_str = $idref_parse['host'];
				$ze_str = trim($ze_str);

			if(($ze_str != $adres_www) AND ($ze_str != '')){

					$nazwa_tab = 'klikzestr'; $nazwa_tab = trim($nazwa_tab);		
					$stmt = $db->query("SELECT * FROM $nazwa_tab WHERE strona='$ze_str' LIMIT 1");
		
					if($stmt->rowCount() == 0){
						
						//dodanie nowej przegladarki do tabeli
						$stmt = $db->prepare(
							"INSERT INTO $nazwa_tab (id, strona, wejscia, data)
							VALUES (0, '$ze_str', 1, ".time().")"
						);		
						$stmt->execute(); //dodanie nr ip do tabeli
		
					}else{			
							//zapisanie ilosci wejœæ do poszczególnych przegladarek
						//	$zapytanie = "SELECT * FROM $nazwa_tab WHERE strona='$ze_str' LIMIT 1";

								//wykonanie zapytania
								if(@$stmt->execute()){

									//odczytywanie i wyswietlenie kolejnych rekordow
									while($wiersz = $stmt->fetch(PDO::FETCH_ASSOC)){
										$wej_k = $wiersz['wejscia']; $wej_k++;	
										$id_k = $wiersz['id'];
							
										$stmt = $db->prepare("UPDATE $nazwa_tab SET `wejscia` = '$wej_k', `data`='".time()."' WHERE `id` = '".$id_k."' LIMIT 1;");
										$stmt->execute();	//WYKONANIE ZAPYTANIA	
									}// while									
								}//if
								
						}//else	
			}//zamkniecie if

//###################### roboty internetowe (boty)
	$nazwa_robota = jakiRobot();	
//	$nazwa_robota = $ua['name']; 	$nazwa_robota = trim($nazwa_robota);
	
	$nazwa_robota = trim($nazwa_robota);
	
/**/
	if($nazwa_robota != ''){
		
					//zapis
					$nazwa_tab = 'roboty'; $nazwa_tab = trim($nazwa_tab);		
					$stmt = $db->query("SELECT * FROM $nazwa_tab WHERE roboty='$nazwa_robota' LIMIT 1");
		
					if($stmt->rowCount() == 0){
						
						$stmt = $db->prepare(
							"INSERT INTO $nazwa_tab (id, roboty, wejscia, data, ua)
							VALUES (0, '$nazwa_robota', 1, ".time().")"
						);		
						$stmt->execute(); //dodanie nr ip do tabeli
						
						//dodanie nowej przegladarki do tabeli
						$stmt = $db->prepare(
							"INSERT INTO $nazwa_tab (id, roboty, wejscia, data, ua)
							VALUES (0, '$nazwa_robota', 1, ".time().", '$ciaguser')"
						);		
						$stmt->execute(); //dodanie nr ip do tabeli
		
					}else{	
								//wykonanie zapytania
								if(@$stmt->execute()){

									//odczytywanie i wyswietlenie kolejnych rekordow
									while($wiersz = $stmt->fetch(PDO::FETCH_ASSOC)){
										$wej_r = $wiersz['wejscia']; $wej_r++;	
										$id_r = $wiersz['id'];
							
										$stmt = $db->prepare("UPDATE $nazwa_tab SET `wejscia` = '$wej_r', `data`='".time()."' WHERE `id` = '".$id_r."' LIMIT 1;");
										$stmt->execute();	//WYKONANIE ZAPYTANIA	
									}// while									
								}//if
								
						}//else	
		
	}


?>