<nav class="navbar fixed-top navbar-expand-lg navbar navbar-dark bg-dark">
	<div class="container">
		<a class="navbar-brand" href="./" data-toggle="tooltip" data-placement="bottom" title="Home"><img src="images/favicon/android-icon-36x36.png" /></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarText">
		
		<ul class="navbar-nav mr-auto">
<?php
if(isset($_SESSION['sesja_uzyt']['zalogowany'])){
?>
			<li class="nav-item<?php if(strpos($_SERVER['PHP_SELF'], "zestawienie") !==false){ echo(" active");} ?>">
				<a class="nav-link" href="zestawienie.php?rok=<?php echo date(Y); ?>">Zestawienie</a>
			</li>
			<li class="nav-item<?php if(strpos($_SERVER['PHP_SELF'], "wizyty") !==false){ echo(" active");} ?>">
				<a class="nav-link" href="wizyty.php?rok=<?php echo date(Y); ?>">Wizyty</a>
			</li>
			<li class="nav-item<?php if(strpos($_SERVER['PHP_SELF'], "odslony") !==false){ echo(" active");} ?>">
				<a class="nav-link" href="odslony.php?rok=<?php echo date(Y); ?>">Odsłony</a>
			</li>
			<li class="nav-item<?php if(strpos($_SERVER['PHP_SELF'], "historia") !==false){ echo(" active");} ?>">
				<a class="nav-link" href="historia.php">Historia</a>
			</li>
			<li class="nav-item<?php if(strpos($_SERVER['PHP_SELF'], "nr_ip") !==false){ echo(" active");} ?>">
				<a class="nav-link" href="nr_ip.php">Nr. IP</a>
			</li>
			

			<!-- Staty Techniczne -->
			<li class="nav-item dropdown<?php if(strpos($_SERVER['PHP_SELF'], "systemy") !==false){ echo(" active");}elseif(strpos($_SERVER['PHP_SELF'], "przegladarki") !==false){ echo(" active");}elseif(strpos($_SERVER['PHP_SELF'], "rozdzielczosc") !==false){ echo(" active");}elseif(strpos($_SERVER['PHP_SELF'], "liczba_kolorow") !==false){ echo(" active");}elseif(strpos($_SERVER['PHP_SELF'], "jezyk") !==false){ echo(" active");} ?>">
				<a class="nav-link dropdown-toggle" href="#" id="staty_globalne" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Techniczne
				</a>
				<div class="dropdown-menu" aria-labelledby="staty_globalne">
					<a class="dropdown-item<?php if(strpos($_SERVER['PHP_SELF'], "systemy") !==false){ echo(" active");} ?>" href="systemy.php">Systemy</a>
					<a class="dropdown-item<?php if(strpos($_SERVER['PHP_SELF'], "przegladarki") !==false){ echo(" active");} ?>" href="przegladarki.php">Przeglądarki</a>
					<a class="dropdown-item<?php if(strpos($_SERVER['PHP_SELF'], "rozdzielczosc") !==false){ echo(" active");} ?>" href="rozdzielczosc.php">Rozdzielczość</a>
					<a class="dropdown-item<?php if(strpos($_SERVER['PHP_SELF'], "liczba_kolorow") !==false){ echo(" active");} ?>" href="liczba_kolorow.php">Kolory</a>
					<a class="dropdown-item<?php if(strpos($_SERVER['PHP_SELF'], "jezyk") !==false){ echo(" active");} ?>" href="jezyk.php">Język</a>
				</div>
			</li>
			
			<!-- Staty Globalne -->
			<li class="nav-item dropdown<?php if(strpos($_SERVER['PHP_SELF'], "dni_tyg") !==false){ echo(" active");}elseif(strpos($_SERVER['PHP_SELF'], "godziny") !==false){ echo(" active");}elseif(strpos($_SERVER['PHP_SELF'], "podstrony") !==false){ echo(" active");} ?>">
				<a class="nav-link dropdown-toggle" href="#" id="staty_globalne" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Globalne
				</a>
				<div class="dropdown-menu" aria-labelledby="staty_globalne">
					<a class="dropdown-item<?php if(strpos($_SERVER['PHP_SELF'], "podstrony") !==false){ echo(" active");} ?>" href="podstrony.php">Podstrony</a>
					<a class="dropdown-item<?php if(strpos($_SERVER['PHP_SELF'], "dni_tyg") !==false){ echo(" active");} ?>" href="dni_tyg.php">Dni Tygodnia</a>
					<a class="dropdown-item<?php if(strpos($_SERVER['PHP_SELF'], "godziny") !==false){ echo(" active");} ?>" href="godziny.php">Godziny</a>
				</div>
			</li>
			
			<!-- Staty SEO -->
			<li class="nav-item dropdown<?php if(strpos($_SERVER['PHP_SELF'], "zrodlo") !==false){ echo(" active");}elseif(strpos($_SERVER['PHP_SELF'], "roboty") !==false){ echo(" active");} ?>">
				<a class="nav-link dropdown-toggle" href="#" id="staty_globalne" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					SEO
				</a>
				<div class="dropdown-menu" aria-labelledby="staty_globalne">
					<a class="dropdown-item<?php if(strpos($_SERVER['PHP_SELF'], "zrodlo") !==false){ echo(" active");} ?>" href="zrodlo.php">Źródło</a>
					<a class="dropdown-item<?php if(strpos($_SERVER['PHP_SELF'], "roboty") !==false){ echo(" active");} ?>" href="roboty.php">Roboty</a>
				</div>
			</li>
			
			<!-- System GoodStat -->
			<li class="nav-item dropdown<?php if(strpos($_SERVER['PHP_SELF'], "kod_javascript") !==false){ echo(" active");}elseif(strpos($_SERVER['PHP_SELF'], "zm_hasla") !==false){ echo(" active");}elseif(strpos($_SERVER['PHP_SELF'], "logi") !==false){ echo(" active");}elseif(strpos($_SERVER['PHP_SELF'], "baza_danych") !==false){ echo(" active");}elseif(strpos($_SERVER['PHP_SELF'], "aktualizacja") !==false){ echo(" active");} ?>">
				<a class="nav-link dropdown-toggle" href="#" id="staty_globalne" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					System
				</a>
				<div class="dropdown-menu" aria-labelledby="staty_globalne">
					<a class="dropdown-item<?php if(strpos($_SERVER['PHP_SELF'], "kod_javascript") !==false){ echo(" active");} ?>" href="kod_javascript.php">Kod JavaScript</a>
					<a class="dropdown-item<?php if(strpos($_SERVER['PHP_SELF'], "zm_hasla") !==false){ echo(" active");} ?>" href="zm_hasla.php">Zmiana Hasła</a>
					<a class="dropdown-item<?php if(strpos($_SERVER['PHP_SELF'], "logi") !==false){ echo(" active");} ?>" href="logi.php">Dziennik Systemu</a>
					<a class="dropdown-item<?php if(strpos($_SERVER['PHP_SELF'], "baza_danych") !==false){ echo(" active");} ?>" href="baza_danych.php">Baza Danych</a>
						<div class="dropdown-divider"></div>
					<a class="dropdown-item<?php if(strpos($_SERVER['PHP_SELF'], "aktualizacja") !==false){ echo(" active");} ?>" href="aktualizacja.php">Aktualizacja</a>
				</div>
			</li>
			
			<li class="nav-item<?php if(strpos($_SERVER['PHP_SELF'], "pomoc") !==false){ echo(" active");} ?>">
				<a class="nav-link" href="pomoc.php">Pomoc</a>
			</li>
<?php
}
?>
		</ul>
<?php
if(isset($_SESSION['sesja_uzyt']['zalogowany'])){
?>
		<ul class="navbar-nav justify-content-end animated bounceInRight">
			<li class="nav-item">
				<a class="nav-link" href="wyloguj_uzyt.php" data-toggle="tooltip" data-placement="bottom" title="wyloguj"><i class="material-icons">power_settings_new</i></a>
			</li>
		</ul>
<?php
}
?>
			<span class="navbar-text">			
				<div class="clockbox rounded-bottom padding5 animated bounceInRight">
					<div id="clockbox"></div>
				</div>
			</span>
		</div>
	</div>
</nav>