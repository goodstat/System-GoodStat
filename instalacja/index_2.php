<?php
//--- dolaczenie plikow
	include('../funkcje/funkcje.php');
	include("../inc/sesje.php");
?>
<!doctype html>
<html lang="pl">
<head>

<?php
//--- dolaczenie plikow
	include('../inc/head_instal.php');
?>

</head>
	
<body>

<link rel="stylesheet" href="css/goodstat.css">

<?php
	include('../inc/baner_instal_2.php');
?>

<div class="container tresc">

	<div class="page-header">
		<h1><img src="../images/loading_instal.gif" /> Instalacja Systemu GoodStat</h1>
	</div>
	
  <div class="row">
	<div class="col-md-12">
		
	</div>
  </div>
	
	
<div class="row my-2">

	<div class="col-sm-4">
		<div class="card text-white bg-success">
			<div class="card-body">
				<h3 class="card-title">1 - Zbieranie Informacji</h3>
					<p class="card-text">Dane niezbędne do prawidłowego działania Systemu GoodStat.</p>
			</div>
		</div>
	</div>

	<div class="col-sm-4">
		<div class="card text-white bg-primary">
			<div class="card-body">
				<h4 class="card-title">2 - Baza Danych</h4>
					<p class="card-text">Czynności związane z bazą danych. Pamiętaj żeby utworzyć na swoim serwerze bazę danych dla Systemu GoodStat.</p>
			</div>
		</div>
	</div>
	
	<div class="col-sm-4">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">3 - Wynik Instalacji</h4>
					<p class="card-text">Wynik instalacji i czynności konfiguracyjne System GoodStat.</p>
			</div>
		</div>
	</div>

</div>
	



<?php
	$zarejestrowany = 'nie';

	if (isset ($_POST['wyslij2'])){

		$problem = FALSE;
		
				//sprawdzenie czy wypelniono pola
				if (empty($_POST['adres_bazy'])){
					$problem = TRUE;	$problem_adres_bazy = 'tak';					
					echo'<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-warning-sign"></span> Podaj nazwę serwera swojej Bazy Danych</div>';
				}
				
				if (empty ($_POST['login_bazy'])){
					$problem = TRUE; 	$problem_login_bazy = 'tak';
					echo'<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-warning-sign"></span> Podaj login Bazy Danych</div>';
				}				
				if (empty($_POST['nazwa_bazy'])){
					$problem = TRUE;	$problem_nazwa_bazy = 'tak';
					echo'<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-warning-sign"></span> Podaj nazwę Bazy Danych</div>';
				}
				
				//sprawdzenie dlugosci danych
				if (strlen($_POST['adres_bazy']) > 250){
					$problem = TRUE;	$problem_adres_bazy = 'tak';
					echo'<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-warning-sign"></span> W polu: Nazwa serwera Bazy Danych jest za dużo znaków, max 250.</div>';
				}
				if (strlen($_POST['login_bazy']) > 150){
					$problem = TRUE;	$problem_login_bazy = 'tak';
					echo'<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-warning-sign"></span> W polu: Nazwa Użytkownika jest za dużo znaków, max 150.</div>';
				}
				if (strlen($_POST['haslo_bazy']) > 200){
					$problem = TRUE;	$problem_haslo_bazy = 'tak';
					echo'<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-warning-sign"></span> W polu: Hasło jest za dużo znaków, max 200.</div>';
				}
				if (strlen($_POST['nazwa_bazy']) > 200){
					$problem = TRUE;	$problem_nazwa_bazy = 'tak';
					echo'<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-warning-sign"></span> W polu: Nazwa Bazy Danych jest za dużo znaków, max 200.</div>';
				}
						
			if (!$problem){

						echo' 
							<div class="alert alert-success alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<span class="glyphicon glyphicon-ok-circle"></span> Jeśli dane są prawidłowe - Przejdź dalej.
							</div>';
						
				$zarejestrowany = 'tak';
			}
	}
		
?>





	
<?php
if ($zarejestrowany == 'nie'){
	//-- formularz niewysłany
?>

	<p class="text-info"><i class="material-icons">info</i> Dane wprowadzone w tym formularzu wykorzystane będą tylko i wyłącznie do konfiguracji Systemu GoodStat.</p>

<form class="needs-validation" novalidate action="index_2.php" method="post">
	<fieldset class="border p-2">
	
		<legend class="w-auto">Baza Danych</legend>
		
		<div class="form-row">
			<div class="col-md-1 mb-3">
				<label for="adres_bazy">nazwa serwera</label>
			</div>
			<div class="col-md-5 mb-3">
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="material-icons">lock</i></span>
					</div>
						<input type="password" class="form-control" name="adres_bazy" value="<?php echo $_POST['adres_bazy']; ?>" id="adres_bazy" placeholder="nazwa serwera bazy danych" aria-describedby="adres_bazy" required>
					<div class="invalid-feedback">
						Podaj nazwe serwera bazy danych, zwykle jest to: localhost.
					</div>
				</div>
			</div>
			<div class="col-md-5 mb-3">
				<small class="form-text text-muted">
					Zwykle jest to: localhost.
				</small>
			</div>		
		</div>

		<div class="form-row">
			<div class="col-md-1 mb-3">
				<label for="login_bazy">login</label>
			</div>
			<div class="col-md-5 mb-3">
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="material-icons">lock</i></span>
					</div>
						<input type="password" class="form-control" name="login_bazy" value="<?php echo $_POST['login_bazy']; ?>" id="login_bazy" placeholder="login bazy danych" aria-describedby="login_bazy" required>
					<div class="invalid-feedback">
						Podaj Login Bazy Danych.
					</div>
				</div>
			</div>
			<div class="col-md-5 mb-3">
				<small id="passwordHelpBlock" class="form-text text-muted">
					Login Twojej Bazy Danych.
				</small>
			</div>		
		</div>

		<div class="form-row">
			<div class="col-md-1 mb-3">
				<label for="haslo_bazy">hasło</label>
			</div>
			<div class="col-md-5 mb-3">
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="material-icons">lock</i></span>
					</div>
						<input type="password" class="form-control" name="haslo_bazy" value="<?php echo $_POST['haslo_bazy']; ?>" id="haslo_bazy" placeholder="hasło do bazy danych" aria-describedby="haslo_bazy">
					<div class="invalid-feedback">
						Podaj hasło.
					</div>
				</div>
			</div>
			<div class="col-md-5 mb-3">
				<small id="passwordHelpBlock" class="form-text text-muted">
					Hasło do Twojej Bazy Danych.
				</small>
			</div>		
		</div>
		
		<div class="form-row">
			<div class="col-md-1 mb-3">
				<label for="nazwa_bazy">nazwa</label>
			</div>
			<div class="col-md-5 mb-3">
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="material-icons">lock</i></span>
					</div>
						<input type="password" class="form-control" name="nazwa_bazy" value="<?php echo $_POST['nazwa_bazy']; ?>" id="nazwa_bazy" placeholder="nazwa bazy danych" aria-describedby="nazwa_bazy" required>
					<div class="invalid-feedback">
						Podaj nazwę Bazy Danych.
					</div>
				</div>
			</div>
			<div class="col-md-5 mb-3">
				<small class="form-text text-muted">
					Nazwa Twojej Bazy Danych.
				</small>
			</div>		
		</div>
	
	</fieldset>
	
	<div class="container my-4">
	  <div class="row">
<?php
	echo'
					<input type="hidden" name="email" value="'.$_POST['email'].'">
					<input type="hidden" name="login" value="'.$_POST['login'].'">
					<input type="hidden" name="haslo1" value="'.$_POST['haslo1'].'">
					<input type="hidden" name="adres_str" value="'.$_POST['adres_str'].'">
	';
?>	  
		<div class="col-md-12">
			<button type="submit" name="wyslij2" class="btn btn-primary btn-lg btn-block" href="instalacja/index_1.php" role="button">DALEJ 2/3<i class="material-icons">chevron_right</i></button>
		</div>
		
	  </div>
	</div>	

</form>

<script>
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>	
	
<?php
}else{	


echo'
	<div class="page-header">
		<h2>Baza Danych</h2>
	</div>
<table class="table">
	<tbody>
    <tr>
		<td scope="row">nazwa serwera</td>
		<th>'.$_POST['adres_bazy'].'</th>
    </tr>
    <tr>
		<td scope="row">login bazy</td>
		<th>'.$_POST['login_bazy'].'</th>
    </tr>
    <tr>
		<td scope="row">hasło bazy</td>
		<th>'.$_POST['haslo_bazy'].'</th>
    </tr>
    <tr>
		<td scope="row">nazwa bazy</td>
		<th>'.$_POST['nazwa_bazy'].'</th>
    </tr>

  </tbody>
</table>

	<div class="container my-4">
	  <div class="row">	  
		<div class="col-md-12">
			<form class="needs-validation" novalidate action="index_3.php" method="post">
					
					<input type="hidden" name="adres_bazy" value="'.$_POST['adres_bazy'].'">
					<input type="hidden" name="login_bazy" value="'.$_POST['login_bazy'].'">
					<input type="hidden" name="haslo_bazy" value="'.$_POST['haslo_bazy'].'">
					<input type="hidden" name="nazwa_bazy" value="'.$_POST['nazwa_bazy'].'">
					
					<input type="hidden" name="email" value="'.$_POST['email'].'">
					<input type="hidden" name="login" value="'.$_POST['login'].'">
					<input type="hidden" name="haslo1" value="'.$_POST['haslo1'].'">
					<input type="hidden" name="adres_str" value="'.$_POST['adres_str'].'">
					
				<button type="submit" name="wyslij3" class="btn btn-primary btn-lg btn-block" role="button">DALEJ 2/3 <i class="material-icons">chevron_right</i></button>
			</form>
		</div>
	  </div>
	</div>
';


}
?>















<?php
echo'
	<div class="page-header">
		<h2>Zebrane Dane</h2>
	</div>
<table class="table">
	<tbody>
    <tr>
		<td scope="row">e-mail</td>
		<th>'.$_POST['email'].'</th>
    </tr>
    <tr>
		<td scope="row">login</td>
		<th>'.$_POST['login'].'</th>
    </tr>
    <tr>
		<td scope="row">hasło</td>
		<th>'.$_POST['haslo1'].'</th>
    </tr>
    <tr>
		<td scope="row">adres strony www</td>
		<th>'.$_POST['adres_str'].'</th>
    </tr>
    <tr>
		<td scope="row">akceptacja regulaminu</td>
		<th>tak</th>
    </tr>

  </tbody>
</table>';
?>
	

</div>
  


<?php
	include('../inc/stopka_instal_2.php');
	include('../inc/stopka_bootstrap_instal.php');
?>

</body>
</html>

