<?php

//##### EKRAN
$nazwa_tab = 'ekran'; $nazwa_tab = trim($nazwa_tab);
if($ekran != ''){
	ekran($nazwa_tab, $ekran);
}

//##### COLOR
$nazwa_tab = 'color'; $nazwa_tab = trim($nazwa_tab);
if($color != ''){
	color($nazwa_tab, $color);
}

//##### PRZEGL¥DARKI
$nazwa_tab = 'przegladarki'; $nazwa_tab = trim($nazwa_tab);
if($przegladarka != ''){
	przegladarki($nazwa_tab, $przegladarka);
}

//##### JEZYK
$nazwa_tab = 'jezyk'; $nazwa_tab = trim($nazwa_tab);
if($jezyk_przegladarki != ''){
	jezyk($nazwa_tab, $jezyk_przegladarki);
}

//##### SYSTEM
$nazwa_tab = 'system'; $nazwa_tab = trim($nazwa_tab);
if($system != ''){
	system_op($nazwa_tab, $system);
}
/**/
?>