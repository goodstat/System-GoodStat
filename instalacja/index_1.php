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
		<div class="card text-white bg-primary">
			<div class="card-body">
				<h3 class="card-title">1 - Zbieranie Informacji</h3>
					<p class="card-text">Dane niezbędne do prawidłowego działania Systemu GoodStat.</p>
			</div>
		</div>
	</div>

	<div class="col-sm-4">
		<div class="card">
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

	if (isset ($_POST['wyslij'])){

		$problem = FALSE;
						
				if (empty ($_POST['email'])){
					$problem = TRUE; 	$problem_email = 'tak';
					echo'<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-warning-sign"></span> Podaj adres e-mail</div>';
				}else{				
						if (email($_POST['email']) == '0'){
							$problem = TRUE; 	$problem_email = 'tak';
							echo'<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-warning-sign"></span> Nie poprawny adres E-mail</div>';
						}
						if (strlen($_POST['email']) > 250){
							$problem = TRUE; 	$problem_email = 'tak';
							echo'<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-warning-sign"></span> W polu: E-mail jest za dużo znaków, max 250.</div>';
						}
					}
				
				if (empty($_POST['login'])){
					$problem = TRUE;
					echo'<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-warning-sign"></span> Podaj login</div>';
				}
				if (empty($_POST['haslo1'])){
					$problem = TRUE;	
					echo'<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-warning-sign"></span> Podaj hasło</div>';
				}
				if (empty($_POST['haslo2'])){
					$problem = TRUE;
					echo'<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-warning-sign"></span> Powtórz hasło</div>';
				}
				
				if (empty($_POST["adres_str"])) {
					$problem = TRUE;
					echo'<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-warning-sign"></span> Podaj pełny adres strony monitorowanej, łącznie z http:// lub z https://</div>';
				}else{

						if(filter_var($_POST["adres_str"], FILTER_VALIDATE_URL)) {
							
						}else{
							$problem = TRUE;	$problem_adres_str = 'tak';
							echo'<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-warning-sign"></span> Podany adres strony monitorowanej wydaje się niewłaściwy</div>';
						}
					}
				
				if (empty($_POST['adres_str'])){
					$problem = TRUE;	$problem_adres_str = 'tak';
					echo'<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-warning-sign"></span> Podaj adres strony monitorowanej</div>';
				}
				
				if ($_POST['regulamin'] != 1){
					$problem = TRUE;	$problem_regulamin = 'tak';
					echo'<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-warning-sign"></span> Nie zaakceptowałeś regulaminu</div>';
				}
				
				if (strlen($_POST['login']) > 100){
					$problem = TRUE;	$problem_login = 'tak';
					echo'<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-warning-sign"></span> W polu: Login jest za dużo znaków, max 100.</div>';
				}
				if (strlen($_POST['haslo1']) > 200){
					$problem = TRUE;	$problem_haslo1 = 'tak';
					echo'<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-warning-sign"></span> W polu: Hasło jest za dużo znaków, max 200.</div>';
				}
				if (strlen($_POST['haslo2']) > 200){
					$problem = TRUE;	$problem_haslo2 = 'tak';
					echo'<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-warning-sign"></span> W polu: Powtórz Hasło jest za dużo znaków, max 200.</div>';
				}
				if (strlen($_POST['adres_str']) > 300){
					$problem = TRUE;	$problem_adres_str = 'tak';
					echo'<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-warning-sign"></span> W polu: Adres Strony Monitorowanej jest za dużo znaków, max 300.</div>';
				}
				
				//inne sprawdzenia
				if ($_POST['haslo1'] != $_POST['haslo2']){
					$problem = TRUE;	$problem_haslo1 = 'tak';	$problem_haslo2 = 'tak';
					echo'<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-warning-sign"></span> Wpisane Hasła różnią się</div>';
				}
						

		
			if (!$problem){
						
				$zarejestrowany = 'tak';
			}
	}
?>	

<?php
if ($zarejestrowany == 'nie'){
	//-- formularz niewysłany
?>

<form class="needs-validation" novalidate action="index_1.php" method="post">
	<fieldset class="border p-2">
	
		<legend class="w-auto">Zbieranie Informacji</legend>
		
		<div class="form-row">
			<div class="col-md-1 mb-3">
				<label for="email">e-mail</label>
			</div>
			<div class="col-md-5 mb-3">
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="material-icons">alternate_email</i></span>
					</div>
						<input type="text" class="form-control" name="email" value="<?php echo $_POST['email']; ?>" id="email" placeholder="Twój e-mail" aria-describedby="email" required>
					<div class="invalid-feedback">
						Podaj adres e-mail.
					</div>
				</div>
			</div>
			<div class="col-md-5 mb-3">
				<small class="form-text text-muted">
					Podaj adres e-mail.
				</small>
			</div>		
		</div>

		<div class="form-row">
			<div class="col-md-1 mb-3">
				<label for="login">login</label>
			</div>
			<div class="col-md-5 mb-3">
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="material-icons">account_box</i></span>
					</div>
						<input type="text" class="form-control" name="login" value="<?php echo $_POST['login']; ?>" id="login" placeholder="Twój login" aria-describedby="login" required>
					<div class="invalid-feedback">
						Podaj login.
					</div>
				</div>
			</div>
			<div class="col-md-5 mb-3">
				<small id="passwordHelpBlock" class="form-text text-muted">
					Za jego pomocą będziesz mógł się logować do systemu.
				</small>
			</div>		
		</div>

		<div class="form-row">
			<div class="col-md-1 mb-3">
				<label for="haslo1">hasło</label>
			</div>
			<div class="col-md-5 mb-3">
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="material-icons">lock</i></span>
					</div>
						<input type="password" class="form-control" name="haslo1" value="<?php echo $_POST['haslo1']; ?>" id="haslo1" placeholder="Twóje hasło" aria-describedby="haslo1" required>
					<div class="invalid-feedback">
						Podaj hasło.
					</div>
				</div>
			</div>
			<div class="col-md-5 mb-3">
				<small id="passwordHelpBlock" class="form-text text-muted">
					Hasło do Systemu GoodStat.
				</small>
			</div>		
		</div>
		
		<div class="form-row">
			<div class="col-md-1 mb-3">
				<label for="haslo2">powtórz hasło</label>
			</div>
			<div class="col-md-5 mb-3">
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="material-icons">lock</i></span>
					</div>
						<input type="password" class="form-control" name="haslo2" value="<?php echo $_POST['haslo2']; ?>" id="haslo2" placeholder="Powtórz hasło" aria-describedby="haslo2" required>
					<div class="invalid-feedback">
						Powtórz hasło.
					</div>
				</div>
			</div>
			<div class="col-md-5 mb-3">
				<small class="form-text text-muted">
					Powtórz Hasło do Systemu GoodStat.
				</small>
			</div>		
		</div>

		<div class="form-row">
			<div class="col-md-1 mb-3">
				<label for="adres_str">strona www</label>
			</div>
			<div class="col-md-5 mb-3">
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"><i class="material-icons">lock</i></span>
					</div>
						<input type="text" class="form-control" name="adres_str" value="<?php echo $_POST['adres_str']; ?>" id="adres_str" placeholder="pełny adres Twojej strony z http:// lub z https://" aria-describedby="adres_str" required>
					<div class="invalid-feedback">
						Podaj adres Twojej strony www.
					</div>
				</div>
			</div>
			<div class="col-md-5 mb-3">
				<small id="passwordHelpBlock" class="form-text text-muted">
					Podaj <b>pełny adres Twojej strony</b> www na której chcesz zainstalować System GoodStat np. http://www.AdresTwojejStrony.pl
				</small>
			</div>		
		</div>


		<div class="form-row">
			<div class="col-md-1 mb-3">
				<label>
					akceptacja <a href="" role="button" class="popover-test" data-toggle="modal" data-target="#regulamin_rejestracja">regulaminu</a>
				</label>
			</div>
			<div class="col-md-5 mb-3">
				<div class="input-group">
						<input class="form-check-input" type="checkbox" name="regulamin" value="1" id="invalidCheck" required> 
							<label class="form-check-label" for="invalidCheck"> Tak, akceptuję i zobowiązuje się przestrzegać regulaminu</label>
					<div class="invalid-feedback">
						Zaakceptuj Regulamin.
					</div>
				</div>
			</div>
			<div class="col-md-5 mb-3">
				<small id="passwordHelpBlock" class="form-text text-muted">
					Akceptacja Regulaminu jest niezbędna do rozpoczęcia instalacji.
				</small>
			</div>		
		</div>	
<?php
	include('../inc/regulamin_rejestracja.php')
?>

	</fieldset>
	
	<div class="container my-4">
	  <div class="row">
	  
		<div class="col-md-6">
				<a class="btn btn-secondary btn-lg btn-block" href="../index.php" role="button"><i class="material-icons">chevron_left</i> DO POCZĄTKU</a>
		</div>
	  
		<div class="col-md-6">
			<button type="submit" name="wyslij" class="btn btn-primary btn-lg btn-block" href="instalacja/index_1.php" role="button">DALEJ 1/3<i class="material-icons">chevron_right</i></button>
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
	//-- formularz wyslany
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
</table>	
	
	<div class="container my-4">
	  <div class="row">	  
		<div class="col-md-12">
			<form class="needs-validation" novalidate action="index_2.php" method="post">
					
					<input type="hidden" name="email" value="'.$_POST['email'].'">
					<input type="hidden" name="login" value="'.$_POST['login'].'">
					<input type="hidden" name="haslo1" value="'.$_POST['haslo1'].'">
					<input type="hidden" name="adres_str" value="'.$_POST['adres_str'].'">
					
				<button type="submit" name="wyslij" class="btn btn-primary btn-lg btn-block" role="button">DALEJ 1/3 <i class="material-icons">chevron_right</i></button>
			</form>
		</div>
	  </div>
	</div>';
	
	
	
	
}
?>	

</div>
  


<?php
	include('../inc/stopka_instal_2.php');
	include('../inc/stopka_bootstrap_instal.php');
?>

</body>
</html>

