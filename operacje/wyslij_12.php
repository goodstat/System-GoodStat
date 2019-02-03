<?php	
//-- wyslanie zapytania
if(isset($_POST['wyslij_12'])){

		$problem = FALSE;
		$zarejestrowany = 'nie';
						
				//sprawdzenie czy wypelniono pola
				if (empty($_POST['l'])){
					$problem = TRUE;
					
							$uruchom_alert = 'tak'; 
							$rodzaj_alert = 'uwaga';
							$tresc_info = 'Podaj Swój Login!';
				}
				//inne sprawdzenia				
					$stmt = $db->query("SELECT * FROM uzyt_stat WHERE login='{$_POST['l']}' LIMIT 1");				
						
							if($stmt->rowCount() == 1){

							}else{
								//loginu nie znaleziono
								$problem = TRUE;
								
								$uruchom_alert = 'tak'; 
								$rodzaj_alert = 'uwaga';
								$tresc_info = 'Loginu nie znaleziono!';
							
							}

			if (!$problem){

						$haslo = generujHaslo();
						$haslo_zakodowane = sha1($haslo);
	
						//zapisanie nowego hasla do bazy
						$stmt_haslo = $db->prepare("UPDATE uzyt_stat SET haslo='$haslo_zakodowane' WHERE login='{$_POST['l']}' LIMIT 1;"); 
						
				//kasujemy  
				if(@$stmt_haslo->execute()){
					
						$uruchom_alert = 'tak'; 
						$rodzaj_alert = 'ok';
						$tresc_info = 'Nowe Hasło to: <strong>'.$haslo.'</strong>.';
						
						//zapis do logow systemu
						$stmttt = $db->query(
							"INSERT INTO hist_operacji (id, opis, data_utw)
							VALUES (0, 'Wygenerowanie nowego hasla przez login: <b>{$_POST['l']}</b>', ".time().")"
						);
						
				}else{
							$uruchom_alert = 'tak'; 
							$rodzaj_alert = 'uwaga';
							$tresc_info = 'Resetu NIE dokonano - coś poszło nie tak...';
				}						
						
				$zarejestrowany = 'tak';
			}

}
