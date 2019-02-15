<?php	
//-- wyslanie zapytania
	if (isset($_POST['wyslij_4'])){

			//usuwa
			$stmt = $db->prepare("DELETE FROM color WHERE id='{$_POST['id']}'");

			if(@$stmt->execute()){
			
							$uruchom_alert = 'tak'; 
							$rodzaj_alert = 'ok';
							$tresc_info = 'Pozycja została usunięta - Prawidłowo ('.$_POST['color'].').';
							
						//zapis do logow systemu
						$stmttt = $db->query(
							"INSERT INTO hist_operacji (id, opis, data_utw)
							VALUES (0, 'Usuniecie pozycji: <b>".$_POST['color']." bit</b> z dzialu Liczba Kolorow', ".time().")"
						);
			}else{
							$uruchom_alert = 'tak'; 
							$rodzaj_alert = 'uwaga';
							$tresc_info = 'Coś poszło źle, pozycja NIE została usunięta.';
			}

	}
