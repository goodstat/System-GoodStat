<?php	
//-- wyslanie zapytania
	if (isset($_POST['wyslij_1'])){

			//usuwa
			$stmt = $db->prepare("DELETE FROM system WHERE id='{$_POST['id']}'");

			if(@$stmt->execute()){
			
							$uruchom_alert = 'tak'; 
							$rodzaj_alert = 'ok';
							$tresc_info = 'Pozycja została usunięta - Prawidłowo ('.$_POST['system'].').';
							
						//zapis do logow systemu
						$stmttt = $db->query(
							"INSERT INTO hist_operacji (id, opis, data_utw)
							VALUES (0, 'Usuniecie pozycji: <b>".$_POST['system']."</b> z dzialu Systemy', ".time().")"
						);
			}else{
							$uruchom_alert = 'tak'; 
							$rodzaj_alert = 'uwaga';
							$tresc_info = 'Coś poszło źle, pozycja NIE została usunięta.';
			}

	}
