<?php
	if (isset ($_POST['wyslij_10'])){

		$problem = FALSE;
						
				//sprawdzenie czy wypelniono pola
				if (empty($_POST['stare_haslo'])){
					$problem = TRUE;
							$uruchom_alert = 'tak'; 
							$rodzaj_alert = 'uwaga';
							$tresc_info = 'Podaj stare hasło.';
				}
				if (empty($_POST['nowe_haslo'])){
					$problem = TRUE;
							$uruchom_alert = 'tak'; 
							$rodzaj_alert = 'uwaga';
							$tresc_info = 'Podaj nowe hasło.';
				}
				if (empty($_POST['nowe_haslo2'])){
					$problem = TRUE;
							$uruchom_alert = 'tak'; 
							$rodzaj_alert = 'uwaga';
							$tresc_info = 'Powtórz nowe hasło.';
				}
				//sprawdzenie dlugosci danych
				if (strlen($_POST['nowe_haslo']) > 50){
					$problem = TRUE;
							$uruchom_alert = 'tak'; 
							$rodzaj_alert = 'uwaga';
							$tresc_info = 'Nowe Hasło jest za długie.';
				}
				//inne sprawdzenia				
					$stmt = $db->query("SELECT * FROM uzyt_stat WHERE login='{$_SESSION['sesja_uzyt']['zalogowany']}' LIMIT 1");				

							while($wiersz = $stmt->fetch(PDO::FETCH_ASSOC)){
								$haslo_z_bazy = $wiersz['haslo']; 
							}
							
							$stare_haslo_zakodowane = sha1($_POST['stare_haslo']); $stare_haslo_zakodowane = cleanText($stare_haslo_zakodowane);

							if($haslo_z_bazy != $stare_haslo_zakodowane){
								$problem = TRUE;
									$uruchom_alert = 'tak'; 
									$rodzaj_alert = 'uwaga';
									$tresc_info = 'Stare hasło - jest Niepoprawne.';
							}
							
							if($_POST['nowe_haslo2'] != $_POST['nowe_haslo']){
								$problem = TRUE;
									$uruchom_alert = 'tak'; 
									$rodzaj_alert = 'uwaga';
									$tresc_info = 'Hasło powtórzone - różni się od hasła nowego.';
							}

					if (!$problem){

						$haslo_zakodowane = sha1($_POST['nowe_haslo']); //stare haslo: 2b5eff5d295e0c608c29caf4f42909a64b3c3d60 ewaslawek5
	
						//zapisanie nowego hasla do bazy
						$stmt_haslo = $db->prepare("UPDATE uzyt_stat SET haslo='$haslo_zakodowane' WHERE login='{$_SESSION['sesja_uzyt']['zalogowany']}' LIMIT 1;");
						
							if(@$stmt_haslo->execute()){
							
											$uruchom_alert = 'tak'; 
											$rodzaj_alert = 'ok';
											$tresc_info = 'Hasło zostało zmienione - Prawidłowo';
											
										//zapis do logow systemu
										$stmttt = $db->query(
											"INSERT INTO hist_operacji (id, opis, data_utw)
											VALUES (0, 'Zmiana Hasla do Systemu GoodStat', ".time().")"
										);
							}else{
											$uruchom_alert = 'tak'; 
											$rodzaj_alert = 'uwaga';
											$tresc_info = 'Coś poszło źle, Hasło NIE ZOSTAŁO zmienione.';
							}

					}
	}