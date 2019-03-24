<?php
//--- dolaczenie plikow
if(file_exists('config.php')) {
	include('config.php');
	include('inc/baza_polacz.php');
}
	include('funkcje/funkcje.php');
	include('funkcje/funkcje_odczytu.php');
	include("inc/sesje.php");
	
//######## STRONNICOWANIE
function wskaznik($strona, $liczba_stron)
{
    $wynik = "<span class='text-muted small'><center>strona $strona/$liczba_stron</center></span><nav aria-label='Page navigation example'><ul class='pagination justify-content-center'>";

    if ($strona > 1) {
		$wynik .= " <li class='page-item'><a class='page-link' href='uzytkownicy.php?strona=1'><i class='material-icons'>first_page</i></a></li> ";
    } else {
        $wynik .= " <li class='page-item disabled'><a class='page-link' href='' tabindex='-1' aria-disabled='true'><i class='material-icons'>first_page</i></a></li>  ";
    }

    $poprzednia = $strona - 1;
    if ($poprzednia > 0) {
        $wynik .= " <li class='page-item'><a class='page-link' href='uzytkownicy.php?strona=$poprzednia'><i class='material-icons'>navigate_before</i></a></li> ";
    } else {
        $wynik .= " <li class='page-item disabled'><a class='page-link' href=''><i class='material-icons'>navigate_before</i></a></li> ";
    }

    $nastepna = $strona + 1;
    if ($nastepna <= $liczba_stron) {
        $wynik .= " <li class='page-item'><a class='page-link' href='uzytkownicy.php?strona=$nastepna'><i class='material-icons'>navigate_next</i></a></li> ";
    } else {
        $wynik .= " <li class='page-item disabled'><a class='page-link' href=''><i class='material-icons'>navigate_next</i></a></li> ";
    }

    if ($strona < $liczba_stron) {
        $wynik .= " <li class='page-item'><a class='page-link' href='uzytkownicy.php?strona=$liczba_stron'><i class='material-icons'>last_page</i></a></li> ";
    } else {
        $wynik .= " <li class='page-item disabled'><a class='page-link'><i class='material-icons'>last_page</i></a></li> ";
    }
    
   $wynik .= "</ul></nav>";
    return $wynik;

}
?>
<!doctype html>
<html lang="pl">
<head>

<?php
//--- dolaczenie plikow
	include('inc/head.php');
?>

</head>
	
<body>

<?php
//--- dolaczenie plikow
if(file_exists('config.php')) {

	include('inc/menu.php');
	include('inc/baner.php');
	include('operacje/!_spis.php');
	include('inc/pole_alerts.php');
}
?>

<?php
if(file_exists('config.php')) {
    //zainstalowany
?>

<div class="container tresc">
<?php
	if(isset($_SESSION['sesja_uzyt']['zalogowany'])){
?>
		<div class="page-header">
			<h1>Użytkownicy <span>GoodStat-u</span></h1>
		</div>
		

<?php			
//-------------------------------------------------------------------
//STRONNICOWANIE
	$p = array(); //zainiciowanie tablicy $p
	
	$stmt = $db->query("SELECT * FROM uzyt_stat");
	while($wiersz = $stmt->fetch(PDO::FETCH_ASSOC)){$id_art = $wiersz['id']; $p[]=$id_art;}

	$liczba_rekordow = count($p); 	//liczba wszystkich rekordow
	$rekordow_na_stronie = 10;		//liczba rekordow na stronie
	
	$liczba_stron = (int) (($liczba_rekordow + $rekordow_na_stronie - 1) / $rekordow_na_stronie);

	if (isset($_GET['strona']) && str_ievpifr($_GET['strona'], 1, $liczba_stron)) {
		$strona = $_GET['strona'];
	}else{
		$strona = 1;
	}
	
	$start = ($strona - 1) * $rekordow_na_stronie;
			
	echo'
	<div class="table-responsive">
		<table class="table table-striped table-hover small table-sm">
		<tr>
			<th>id</th> <th>login</th> <th>e-mail</th> <th>data utw</th> <th>usuń</th>
		</tr>';
		
		$stmt = $db->query("SELECT * FROM `uzyt_stat` ORDER BY `uzyt_stat`.`id` DESC LIMIT $start ,$rekordow_na_stronie");

			while($wiersz = $stmt->fetch(PDO::FETCH_ASSOC)){
				
				$id 		= $wiersz['id'];
				$login 		= $wiersz['login'];
				$mail 		= $wiersz['mail'];
				$data_utw 	= $wiersz['data_utw']; $data_utw = date('d-m-Y, H:i:s', $data_utw);
				
				echo'
				<tr>
					<td class="text-muted">'.$id.'</td> <td class="text-muted">'.$login.'</td> <td><a href="mailto:'.$mail.'">'.$mail.'</a></td> <td class="text-muted">'.$data_utw.'</td> <td class="text-muted">'; if($id!=1){ echo'<button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#szczegoly'.$id.'" title="Usuń"><i class="material-icons">delete_forever</i></button>'; }else{ echo'-'; } echo'</td> 
				</tr>';

					//szczegoly
					echo'
					<!-- Modal -->
					<div class="modal fade" id="szczegoly'.$id.'">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
					  
								<!-- Modal Header -->
								<div class="modal-header">
									<h4 class="modal-title">Na pewno usunąć tą pozycję ?</h4>
										<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>
						
								<!-- Modal body -->
								<div class="modal-body">

									<form action="uzytkownicy.php" method="post" class="form-horizontal">
										<ul class="list-group">								
											<li class="list-group-item">
												<div class="row">
													<div class="col-md-3">login</div>						
													<div class="col-md-9"><b>'.$login.'</b></div>						
												</div>
											</li>									
										</ul>
								</div>
						
								<!-- Modal footer -->
								<div class="modal-footer">
										<input type="hidden" value="'.$id.'" name="id">
										<input type="hidden" value="'.$login.'" name="login">
								
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Nie</button>
										<button type="submit" class="btn btn-success" name="wyslij_13" title="tak usuń">Tak</button>
									</form>
								</div>
						
							</div>
						</div>
					</div>
					<!-- end Modal -->';				
			}
			
	echo'
		</table>
	</div>';
?>
<?php
		echo wskaznik($strona, $liczba_stron);	//stronnicowanie
?>
	
<div class="row justify-content-md-center my-1">
	<div class="col-xl-4 col-lg-9 col-md-9">
		
	<form action="uzytkownicy.php" method="post">
		<fieldset class="border p-2">
			<legend class="w-auto">Dodanie nowego Użytkownika</legend>
		
		<div class="form-group<?php if($problem_email == 'tak'){echo ' has-error has-feedback';} ?>">
			<label for="mail">Adres e-mail</label>
			<input type="email" class="form-control" id="mail" placeholder="e-mail" name="email" required>
		</div>
		
		<div class="form-group<?php if($problem_login == 'tak'){echo ' has-error has-feedback';} ?>">
			<label for="login">Login</label>
			<input type="text" class="form-control" id="login" placeholder="login" name="login" required>
		</div>
		
		<div class="form-group<?php if($problem_haslo1 == 'tak'){echo ' has-error has-feedback';} ?>">
			<label for="haslo1">Hasło</label>
			<input type="password" class="form-control" id="haslo1" placeholder="hasło" name="haslo1" required>
		</div>
		
		<div class="form-group<?php if($problem_haslo2 == 'tak'){echo ' has-error has-feedback';} ?>">
			<label for="haslo2">Powtórz Hasło</label>
			<input type="password" class="form-control" id="haslo2" placeholder="powtórz hasło" name="haslo2" required>
		</div>

		</fieldset>
		
			<fieldset class="border tblFooters">
				<button type="submit" name="wyslij_14" class="btn btn-primary btn-lg btn-block my-4">Dodaj</button>
			</fieldset>
	  
	</form>
		
	</div>
</div>

	<hr />
	
<p>
	<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
		<i class="material-icons">live_help</i> Pomoc
	</button>
</p>
<div class="collapse" id="collapseExample">
	<div class="card card-body">
		Dzięki temu działowi, można dodawać osoby uprawnione do oglądania statystyk monitorowanej strony internetowej.
	</div>
</div>



</div><!-- /container -->
		
<?php
	}else{		
		include('inc/form_logowania.php');
	}
?>	
	

</div>

<?php
	if(isset($_SESSION['sesja_uzyt']['zalogowany'])){
		include('inc/zalogowany_jako.php');
	}

}else{
    //instalacja
	include('instalacja/index.php');
}
?>

<?php
if(file_exists('config.php')) {
	include('inc/stopka.php');
}
	include('inc/stopka_bootstrap.php');
?>

</body>
</html>