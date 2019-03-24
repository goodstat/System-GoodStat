<?php
	$zarejestrowany = 'nie';

	if (isset ($_POST['wyslij_14'])){

		$problem = FALSE;
						
				//sprawdzenie czy wypelniono pola				
				if (empty ($_POST['email'])){
					$problem = TRUE; 	$problem_email = 'tak';
							$uruchom_alert = 'tak'; 
							$rodzaj_alert = 'uwaga';
							$tresc_info = 'Podaj adres e-mail';
				}else{				
						if (email($_POST['email']) == '0'){
							$problem = TRUE; 	$problem_email = 'tak';
							$uruchom_alert = 'tak'; 
							$rodzaj_alert = 'uwaga';
							$tresc_info = 'Nie poprawny adres E-mail';
						}
						if (strlen($_POST['email']) > 250){
							$problem = TRUE; 	$problem_email = 'tak';
							$uruchom_alert = 'tak'; 
							$rodzaj_alert = 'uwaga';
							$tresc_info = 'W polu: E-mail jest za dużo znaków, max 250.';
						}
					}
				
				if (empty($_POST['login'])){
					$problem = TRUE;	$problem_login = 'tak';	
							$uruchom_alert = 'tak'; 
							$rodzaj_alert = 'uwaga';
							$tresc_info = 'Podaj login';
				}
				if (empty($_POST['haslo1'])){
					$problem = TRUE;	$problem_haslo1 = 'tak';
							$uruchom_alert = 'tak'; 
							$rodzaj_alert = 'uwaga';
							$tresc_info = 'Podaj hasło';
				}
				if (empty($_POST['haslo2'])){
					$problem = TRUE;	$problem_haslo2 = 'tak';
							$uruchom_alert = 'tak'; 
							$rodzaj_alert = 'uwaga';
							$tresc_info = 'Powtórz hasło';					
				}
				
				//sprawdzenie dlugosci danych
				if (strlen($_POST['login']) > 100){
					$problem = TRUE;	$problem_login = 'tak';
							$uruchom_alert = 'tak'; 
							$rodzaj_alert = 'uwaga';
							$tresc_info = 'W polu: Login jest za dużo znaków, max 100.';
				}
				if (strlen($_POST['haslo1']) > 200){
					$problem = TRUE;	$problem_haslo1 = 'tak';
							$uruchom_alert = 'tak'; 
							$rodzaj_alert = 'uwaga';
							$tresc_info = 'W polu: Hasło jest za dużo znaków, max 200.';					
				}
				if (strlen($_POST['haslo2']) > 200){
					$problem = TRUE;	$problem_haslo2 = 'tak';
							$uruchom_alert = 'tak'; 
							$rodzaj_alert = 'uwaga';
							$tresc_info = 'W polu: Powtórz Hasło jest za dużo znaków, max 200.';					
				}
				
				//inne sprawdzenia
				if ($_POST['haslo1'] != $_POST['haslo2']){
					$problem = TRUE;	$problem_haslo1 = 'tak';	$problem_haslo2 = 'tak';
							$uruchom_alert = 'tak'; 
							$rodzaj_alert = 'uwaga';
							$tresc_info = 'Wpisane Hasła różnią się.';					
				}
				
				$stmt = $db->query("SELECT * FROM uzyt_stat WHERE login='{$_POST['login']}' LIMIT 1");
				if($stmt->rowCount() == 1){
					$problem = TRUE;	$problem_login = 'tak';
							$uruchom_alert = 'tak'; 
							$rodzaj_alert = 'uwaga';
							$tresc_info = 'Podany Login już istnieje.';
				}

			if (!$problem){
				
					$h = $_POST['haslo1'];
					$haslo1 = sha1($h); $haslo_zakodowane = cleanText($haslo1);

					$stmt = $db->prepare(  
						"INSERT INTO uzyt_stat (id, login, haslo, mail, data_utw)
							VALUES (0, '{$_POST['login']}', '$haslo1', '{$_POST['email']}', ".time().")"
					);
					
						if(@$stmt->execute()){
							
							$uruchom_alert = 'tak'; 
							$rodzaj_alert = 'ok';
							$tresc_info = 'Użytkownik <b>'.$_POST['login'].'</b> został dodany Prawidłowo';
							
							//zapis do logow systemu
							$stmttt = $db->query(
								"INSERT INTO hist_operacji (id, opis, data_utw)
								VALUES (0, 'Dodanie nowego Użytkownika: <b>".$_POST['login']."</b> do systemu GoodStat', ".time().")"
							);
										
						}else{
							$uruchom_alert = 'tak'; 
							$rodzaj_alert = 'uwaga';
							$tresc_info = 'Coś poszło źle, pozycja NIE została usunięta.';
						}						
						
				$zarejestrowany = 'tak';
			}
	}

