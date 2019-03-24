<?php	
//-- wyslanie zapytania
	if (isset($_POST['wyslij_13'])){

			//usuwa
			$stmt = $db->prepare("DELETE FROM uzyt_stat WHERE id='{$_POST['id']}'");

			if(@$stmt->execute()){
			
							$uruchom_alert = 'tak'; 
							$rodzaj_alert = 'ok';
							$tresc_info = 'Pozycja <b>'.$_POST['login'].'</b> została usunięta - Prawidłowo';
							
						//zapis do logow systemu
						$stmttt = $db->query(
							"INSERT INTO hist_operacji (id, opis, data_utw)
							VALUES (0, 'Usuniecie Użytkownika: <b>".$_POST['login']."</b> z systemu GoodStat', ".time().")"
						);
			}else{
							$uruchom_alert = 'tak'; 
							$rodzaj_alert = 'uwaga';
							$tresc_info = 'Coś poszło źle, pozycja NIE została usunięta.';
			}

	}
