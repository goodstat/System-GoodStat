	
<div class="row justify-content-md-center my-1">
	<div class="col-xl-4 col-lg-9 col-md-9">

<?php
if($wynik_logowania == 'zle'){
					echo' 
						<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<span class="glyphicon glyphicon-warning-sign"></span> <strong>Błąd!</strong> Coś poszło źle - Login lub Hasło jest niepoprawne!
						</div>';
						
						//zapis do logow systemu
						$stmt = $db->prepare(
							"INSERT INTO hist_operacji (id, opis, data_utw)
							VALUES (0, '<b>Nieudane logowanie</b> do Systemu GoodStat, nr.IP: ".$nr_ip.", login: {$_POST['l']}', ".time().")"
						);		
						$stmt->execute();	//dodanie
}
?>

		<form action="index.php" method="post">
			<fieldset class="border p-2">
			
				<legend class="w-auto">Logowanie</legend>
			<div class="form-group">
				<label for="login">Login</label>
				<input type="text" class="form-control" id="login" name="l" placeholder="Login" required>
			</div>
			<div class="form-group">
				<label for="exampleInputPassword1">Password</label>
				<input type="password" class="form-control" id="exampleInputPassword1" name="h" placeholder="Password" required>
			</div>

			<div class="checkbox">
				<label>
					<a href="nie_pamietam_hasla.php">Nie pamiętam hasła</a>
				</label>
			</div>
			</fieldset>
			
			<fieldset class="border tblFooters">
				<button type="submit" name="wyslij_loguj" class="btn btn-primary btn-lg btn-block my-4">Zaloguj się</button>
			</fieldset>

		</form>

		<img src="images/logo_logowanie.png" class="img-fluid rounded mx-auto d-block" alt="logo GoodStat">
	
	</div>

</div>
