<div class="container-fluid small wersja">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-xs-12 text-right">
<?php
		$stmt = $db->query("SELECT * FROM klient_stat WHERE id='1' LIMIT 1");

			while($wiersz = $stmt->fetch(PDO::FETCH_ASSOC)){

				$wersja_uzyt 	= $wiersz['wersja'];
				$data_inst 		= $wiersz['data_inst']; $data_inst = date('d-m-Y, H:i:s', $data_inst);
			}
if(isset($_SESSION['sesja_uzyt']['zalogowany'])){
				echo'<span>data instalacji: '.$data_inst.', wersja oprogramowania: '.$wersja_uzyt.'</span>';
}else{ echo'<span>data instalacji: -, wersja oprogramowania: -</span>'; }
?>
			</div>
		</div>
	</div>
</div>

<div class="container baner">
	<div class="row">
		<div class="col-md-6 col-xs-12">
			<a href="./" title="System GoodStat - Strona Główna"><img src="images/logo-goodstat.png" id="logo" class="img-fluid navbar-brand animated bounceInLeft" alt="Logo GoodStat-u" /></a>
		</div>
		<div class="hidden-xs d-none d-md-block col-md-6 col-xs-12 animated bounceInRight" id="tekst-baner">
			<blockquote class="blockquote text-right">
				<span class="animated pulse">"Odpowiednia analiza danych z Systemu GoodStat, może przyczynić się do zwiększenia wizyt na Twojej stronie internetowej"</span>
				<footer class="blockquote-footer">autor GoodStat-u</footer>
			</blockquote>
		</div>
	</div>
</div>