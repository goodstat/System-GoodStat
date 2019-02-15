<?php
//--- dolaczenie plikow
if(file_exists('config.php')) {
	include('config.php');
	include('inc/baza_polacz.php');
}
	include('funkcje/funkcje.php');
	include('funkcje/funkcje_odczytu.php');
	include("inc/sesje.php");
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
			<h1>Pomoc <span></span></h1>
		</div>
		

	<dl class="row text-justify">
		<dt class="col-sm-3 text-uppercase"><h4>Zestawienie</h4></dt>
		<dd class="col-sm-9">			
			<p class="text-uppercase font-weight-bold">Zestawienie Wizyt i Odsłon</p>
			
			Dane zawarte w jednej dużej tabeli wskazują ilość Wizyt i Odsłon w wybranym roku i w miesiącu. Dane ilości Wizyt i Odsłon przedstawiono w jednej tabeli, ponieważ z takiego zestawienia można szybciej wyciągnąć wnioski o popularności monitorowanego serwisu.
			<hr />
		</dd> 

		<dt class="col-sm-3 text-uppercase"><h4>Wizyty</h4></dt>
		<dd class="col-sm-9">			
			<p class="text-uppercase font-weight-bold">Statystyki Wizyt</p>
			
			Wizyta jest to ciąg następujących po sobie odsłon wykonanych przez jednego użytkownika w ramach jednej witryny i tego samego numeru IP. Mówiąc prościej, ilość wizyt to nic innego jak ilość numerów IP które odwiedziły Twoją stronę w wybranym przedziale czasowym np. godzinnym, miesięcznym. Jest zrobione tak, że gdy jakiś nr. IP trafia na Twoją stronę pierwszy raz w danym dniu, wówczas zostaje odnotowana jedna Wizyta.
			Wykres Wizyt jest podzielony na:
			<ul>
				<li class="font-weight-bold">Roczny</li>
				<li class="font-weight-bold">Miesięczny</li>
					<ul>
						<li>Pod wykresem Miesięcznym w tabeli, dodano możliwość podglądu ilość Wizyt w poszczególnych godzinach w wybranym dniu, jak i również podgląd samych numerów IP.</li>
					</ul>
			</ul>			
			<hr />
		</dd> 

		<dt class="col-sm-3 text-uppercase"><h4>Odsłony</h4></dt>
		<dd class="col-sm-9">			
			<p class="text-uppercase font-weight-bold">Statystyki Odsłon</p>
			
			Odsłona jest to zdarzenie polegające na obejrzeniu monitorowanej strony, liczba ta zwykle jest większa od liczby Wizyt, ponieważ jeden Nr. IP (jedna Wizyta), może generować kilka odsłon, można powiedzieć że liczba Odsłon to nic innego jak liczba przeładowań (odświeżeń) monitorowanej strony.
			Wykres Odsłon jest podzielony na:
			<ul>
				<li class="font-weight-bold">Roczny</li>
				<li class="font-weight-bold">Miesięczny</li>
					<ul>
						<li>Pod wykresem Miesięcznym w tabeli, dodano możliwość podglądu ilość Odsłon w poszczególnych godzinach w wybranym dniu, jak i również podgląd samych numerów IP.</li>
					</ul>
			</ul>			
			<hr />
		</dd> 

		<dt class="col-sm-3 text-uppercase"><h4>Historia</h4></dt>
		<dd class="col-sm-9">			
			<p class="text-uppercase font-weight-bold">Historia Wejść</p>
			
			Dane zawarte w przedstawionej tam tabeli pokazują wszystkie wejścia na stronę monitorowaną z różnymi szczegółami technicznymi takimi jak: data, nr.ip, podstrona, system, przeglądarka, color, ekran, język i ciąg user agent. User Agent według Wikipedi jest to aplikacja kliencka, nagłówek zawierający tzw. user agent string (UAString) służy serwisom internetowym (np. aplikacji napisanej w języku PHP) do rozpoznania typu programu klienckiego, również do budowania statystyk odwiedzin witryn WWW przez różne przeglądarki bądź roboty. Dane zapisywane są od góry tabeli, czyli najnowsza historia znajduje się na górze.
			<hr />
		</dd> 

		<dt class="col-sm-3 text-uppercase"><h4>Techniczne</h4></dt>
		<dd class="col-sm-9">			
			<p class="text-uppercase font-weight-bold">Statystyki Techniczne</p>
			
			Dane przedstawione na wykresach i w tabelach pokazują dane techniczne odwiedzających stronę monitorowaną tj. ich:
			<ul class="font-weight-bold">
				<li>Systemy</li>
				<li>Przeglądarki</li>
				<li>Rozdzielczość</li>
				<li>Kolory</li>
				<li>Język</li>
			</ul>
			Należy tu zaznaczyć, że dane do tej tabeli zapisywane są jedynie wtedy kiedy stwierdzono nową wizytę. Na takie rozwiązanie zdecydowano się dlatego, żeby odciążyć serwer podczas pracy Systemu GoodStat.
			<hr />
		</dd> 

		<dt class="col-sm-3 text-uppercase"><h4>Globalne</h4></dt>
		<dd class="col-sm-9">			
			<p class="text-uppercase font-weight-bold">Statystyki Globalne</p>
			
			Dział ten składa się z następujących podkategorii:
			<ul>
				<li class="font-weight-bold">Podstrony</li>
					<ul>
						<li>Dane zawarte w tabeli i na wykresie pokazują odsłony poszczególnych podstron strony monitorowanej, czyli każda odsłona podstrony będzie zliczona i zapisana przez system.</li>
					</ul>
				<li class="font-weight-bold">Dni Tygodnia</li>
					<ul>
						<li>Dane zawarte w tabeli i na wykresie wskazują dni tygodnia w których najczęściej stwierdzono Nową Wizytę na stronie monitorowanej, dzięki temu można określić w jakim dniu tygodnia najczęściej wchodzą nowi Użytkownicy. Dane do tej tabeli zapisywane są tylko podczas stwierdzenia nowej wizyty.</li>
					</ul>
				<li class="font-weight-bold">Godziny</li>
					<ul>
						<li>Dane zawarte w tabeli i na wykresie wskazują godziny w których najczęściej stwierdzono Nową Wizytę na stronie monitorowanej, dzięki temu można określić w której godzinie najczęściej wchodzą nowi Użytkownicy. Dane do tej tabeli zapisywane są tylko podczas stwierdzenia nowej wizyty.</li>
					</ul>
			</ul>
			<hr />
		</dd> 

		<dt class="col-sm-3 text-uppercase"><h4>SEO</h4></dt>
		<dd class="col-sm-9">			
			<p class="text-uppercase font-weight-bold">Statystyki SEO</p>
			
			Dział ten składa się z następujących podkategorii:
			<ul>
				<li class="font-weight-bold">Żródło</li>
					<ul>
						<li>Dane zawarte w tabeli wskazują z jakiej domeny trafił użytkownik na stronę monitorowaną lub dzięki której wyszukiwarce. Każde takie wejście jest sumowane i zapisywane, ponadto rubryka Data wskazuje na datę kiedy coś takiego miało miejsce. </li>
					</ul>
				<li class="font-weight-bold">Roboty</li>
					<ul>
						<li>Dane zawarte w tabeli wskazują nazwę robotów internetowych które trafiły na stronę mnitorowaną, są zliczane odsłony, zapisany też jest ciąg tz. User Agent robota (boota). Każde takie wejście jest sumowane i zapisywane, ponadto rubryka Data wskazuje na datę kiedy coś takiego miało miejsce.</li>
					</ul>
			</ul>			
			<hr />
		</dd> 

		<dt class="col-sm-3 text-uppercase"><h4>System</h4></dt>
		<dd class="col-sm-9">			
			<p class="text-uppercase font-weight-bold">Ustawienia Systemu</p>
			Można znaleść tu podgląd wszelkich danych środowiskowych serwera głównie Baz Danych, oraz ustawienia systemu GoodStat.
			Dział ten składa się z następujących podkategorii:
			<ul>
				<li class="font-weight-bold">Kod Java-Script</li>
					<ul>
						<li>Znajdziesz tu Kod JavaScript, który to jest niezbędny do monitoringu Twojej strony www, ponieważ za jego pomocą system GoodStat zlicza i zapisuje statystyki. Kod Java-Script musi znaleść się na każdej podstronie, którą chcesz monitorować.</li>
					</ul>
				<li class="font-weight-bold">Zmiana Hasła</li>
					<ul>
						<li>Dzięki temu narzędziu zmienisz swoje hasło do Systemu GoodStat.</li>
					</ul>
				<li class="font-weight-bold">Dziennik Systemu</li>
					<ul>
						<li>Są tu zapisywane wszystkie ważne czynności jakie dokonywane są w systemie GoodStat, tj. logowanie, zmiany haseł itp. Przygotowana została też możliwość Resetu (usunięcia) wszystkich Logów systemu. Funkcję resetu można stosować w przypadku bardzo dużo zebranych rekordów, wówczas zwolni się miejsce w bazie. Funkconalność ta została przygotowana dla użytkowników dysponującymi małą pojemnością Baz Danych.</li>
					</ul>
				<li class="font-weight-bold">Baza Danych</li>
					<ul>
						<li>Zakładka techniczna, dzięki niej można poznać nazwy tabel w Bazie Danych, ich wielkość, ilość rekordów itp. Odczyt danych tabel dotyczy jedynie tych, które znajdują się w Bazie podanej przy instalacji Systemu GoodStat.</li>
					</ul>
				<li class="font-weight-bold">Aktualizacja</li>
					<ul>
						<li>Dzięki tej zakładce dowiesz się czy istnieje nowa wersja Systemu GoodStat, gdy okaże się że istnieje, wówczas będziesz mógł ją zaktualizować do nowszej wersji.</li>
					</ul>
			</ul>			
			<hr />
		</dd> 


 
	</dl>



</div>
		
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