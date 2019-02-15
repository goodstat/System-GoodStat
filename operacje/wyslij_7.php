<?php	
//-- wyslanie zapytania
	if (isset($_POST['wyslij_7'])){

			//usuwa
			$stmt = $db->prepare("TRUNCATE `historia`;");	
			//kasujemy  
				if(@$stmt->execute()){
					
						$uruchom_alert = 'tak'; 
						$rodzaj_alert = 'ok';
						$tresc_info = 'Dokonano Resetu Historii - Prawidłowo.';
						
						//zapis do logow systemu
						$stmttt = $db->query(
							"INSERT INTO hist_operacji (id, opis, data_utw)
							VALUES (0, 'Dokonanie Resetu dzialu Hisoria', ".time().")"
						);
						
				}else{
							$uruchom_alert = 'tak'; 
							$rodzaj_alert = 'uwaga';
							$tresc_info = 'Resetu NIE dokonano - coś poszło nie tak...';
				}

	}
