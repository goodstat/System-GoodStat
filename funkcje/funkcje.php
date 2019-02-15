<?php
function cleanHTML($str)
{
return htmlentities($str, ENT_QUOTES);
}
function cleanText($str)
{
$s = $str;
if(!ini_get('magic_quotes_gpc'))
{
$s = addslashes($s);
}
return $s;
}
function checkLength($str, $acceptableLenght)
{
if (strlen($str) >= $acceptableLenght)
{
return true;
}else
{	
return false;
}
}
//####################### TWORZY UNIKALNE id #####################
// ZASTOSOWANIE:
// $new_unikalne_id = tworz_unik_id();
function tworz_unik_id($namespace = '') {
    static $guid = '';
    $uid = uniqid("", true);
    $data = $namespace;
    $data .= $_SERVER['REQUEST_TIME'];
    $data .= $_SERVER['HTTP_USER_AGENT'];
    $data .= $_SERVER['LOCAL_ADDR'];
    $data .= $_SERVER['LOCAL_PORT'];
    $data .= $_SERVER['REMOTE_ADDR'];
    $data .= $_SERVER['REMOTE_PORT'];
    $hash = strtoupper(hash('ripemd128', $uid . $guid . md5($data)));
    $guid = substr($hash,  0,  8) .
            substr($hash,  8,  4) .
            substr($hash, 12,  4) .
            substr($hash, 16,  4) .
            substr($hash, 20, 12);
    return $guid;
  }
  
function guid(){
    if (function_exists('com_create_guid'))
        return com_create_guid();
    else {
        mt_srand((double)microtime()*1000000);//optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45);// "-"
        $uuid = chr(123)// "{"
                .substr($charid, 0, 8).$hyphen
                .substr($charid, 8, 4).$hyphen
                .substr($charid,12, 4).$hyphen
                .substr($charid,16, 4).$hyphen
                .substr($charid,20,12)
                .chr(125);// "}"
		$los = md5($uuid);
        global $los;
    }
}

function email($email, $strict = FALSE)
{
    if ($strict === TRUE)
    {
        $qtext = '[^\\x0d\\x22\\x5c\\x80-\\xff]';
        $dtext = '[^\\x0d\\x5b-\\x5d\\x80-\\xff]';
        $atom  = '[^\\x00-\\x20\\x22\\x28\\x29\\x2c\\x2e\\x3a-\\x3c\\x3e\\x40\\x5b-\\x5d\\x7f-\\xff]+';
        $pair  = '\\x5c[\\x00-\\x7f]';
 
        $domain_literal = "\\x5b($dtext|$pair)*\\x5d";
        $quoted_string  = "\\x22($qtext|$pair)*\\x22";
        $sub_domain     = "($atom|$domain_literal)";
        $word           = "($atom|$quoted_string)";
        $domain         = "$sub_domain(\\x2e$sub_domain)*";
        $local_part     = "$word(\\x2e$word)*";
 
        $expression     = "/^$local_part\\x40$domain$/D";
    }
    else
    {
        $expression = '/^[-_a-z0-9\'+*$^&%=~!?{}]++(?:\.[-_a-z0-9\'+*$^&%=~!?{}]+)*+@(?:(?![-.])[-a-z0-9.]+(?<![-.])\.[a-z]{2,6}|\d{1,3}(?:\.\d{1,3}){3})(?::\d++)?$/iD';
    }
 
    return preg_match($expression, (string) $email);
}

function generujHaslo()
{
  $dlugosc_hasla = 10;
  $zestaw_znakow = "abcdefghijklmnopqrstuvwxyz0123456789!@#%&*+=-";
  ((double)microtime() * 1000000);

  while(strlen($haslo) < $dlugosc_hasla)
  {
    $znak = $zestaw_znakow[rand(0, strlen($zestaw_znakow) - 1)];
    if(!is_integer(strpos($haslo, $znak))) $haslo .= $znak;
  }
  return $haslo;
}

//#####
function str2Url($t,$replace=null) {
	$rf = array("\r","\n","\r\n","\n\r",'а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п','р','с','т','у','ф','х','ц','ч','ш','щ','ъ','ы','ь','э','ю','я');
	$rt = array('','','','','a','b','v','g','d','e','jo','zh','z','i','j','k','l','m','n','o','p','r','s','t','u','f','h','c','ch','sh','w','','y','','je','ju','ja');
	$txt = str_replace(array('^',"'",'"','`','~'),'',iconv('UTF-8','ASCII//TRANSLIT',str_replace($rf,$rt,mb_strtolower($t,'UTF-8'))));
	if(empty($replace)) return $txt;
	else return str_replace(' ',$replace, ereg_replace(' +',' ',preg_replace('/[^a-zA-Z0-9\s]/','',trim(str_replace(array('_','.',',','(',')','{','}','[',']','/',':',';','"','\'','-','+','=','!','@','#','$','%','^','&','?','*'),' ', $txt )))));
}
// sposob uzycia:	$nazwa_kat_ = str2Url($nazwa_kat);
// przeksztalca string na URL-a




//##################### STRONNICOWANIE
/**
 * Walidacja danych
 *
 * Funkcje sluzace do walidacji identyfikatorow
 * przekazywanych w adresach URL postaci:
 *     index.php?id1=12&id2=34&id3=56
 *
 * Zawartosc tablicy $_GET stanowia zawsze napisy.
 * Zatem wszystkie funkcje walidujace sprawdzaja
 * typ parametrow.
 *
 *
 * @package    WALIDACJA
 * @author     Wlodzimierz Gajda, gajdaw
 * @copyright  1997-2009 Wlodzimierz Gajda, gajdaw
 * @link       http://gajdaw.pl
 * @license    GPL
 * @version    walidacja.inc.php, v 1.1, 2009/02/24, 08:47
 */


/*
 * Maksymalna liczba calkowita
 * ma wartosc 2 147 483 647.
 *
 * Przyjmujemy: dziewiec cyfr.
 *
 */


/**
 * Maksymalna dlugosc napisu.
 *
 */
define('WALIDACJA_MAX_DL_NAPISU', 10);


/**
 * str_ievpi(): Is exactly valid positive integer?
 *
 * Czy liczba jest poprawna, calkowita, nieujemna?
 * Wykluczamy wiodace zera: 001, 000004.
 * Sprawdzamy typ i dlugosc zmiennej.
 *
 * @param string badana liczba
 * @return bool czy badana liczba spelnia kryteria
 */
function str_ievpi($number)
{
    if (
        is_string($number) &&
        (strlen($number) <= WALIDACJA_MAX_DL_NAPISU) &&
        preg_match('/^(([1-9][0-9]+)|([0-9]))$/', $number)
    ) {
        return true;
    } else {
        return false;
    }
}


/**
 * str_ievpifr(): Is exactly valid positive integer from range?
 *
 * Czy liczba jest poprawna, calkowita, nieujemna i z podanego zakresu?
 * Wykluczamy wiodace zera: 001, 000004.
 *
 * @param string badana liczba
 * @param string maksymalna dopuszczalna wartosc
 * @param string minimalna dopuszczalna wartosc 
 * @return bool czy badana liczba spelnia kryteria
 */
function str_ievpifr($number, $rmin, $rmax)
{
    if (
        str_ievpi($number) &&
        ($number >= $rmin) &&
        ($number <= $rmax)
    ) {
        return true;
    } else {
        return false;
    }
}

function array_1dim_to_2dimV($a, $columns, $default = '')
{
    $items = count($a);
    $rows = round(ceil($items / $columns));

    $result = array();
    for ($j = 0; $j < $columns; $j++) {    
        for ($i = 0; $i < $rows; $i++) {
            $index = $i + $rows * $j;
            if (isset($a[$index])) {
                $result[$j][$i] = $a[$index];
            } else {
                $result[$j][$i] = $default;
            }
        }
    }

    return array(
        'items' => $result,
        'rows' => $rows,
        'cols' => $columns
    );
}




function ile_jest($znak, $wyrazenie)
{
	$wynik = 0;
	
	for($i=0; $i < strlen($wyrazenie); $i++){
		if($wyrazenie[$i] == $znak){
			$wynik++;
		}
	}//end for

	return $wynik;
}

//##### przelicz na zl
function przelicz_na_zl ($wartosc) {
	$wartosc = $wartosc / 100; $wartosc = number_format(str_replace(',','.',$wartosc), 2, '.', ''); 
	$cena_w_zl = $wartosc;
	return $cena_w_zl;
}
//##### przelicz na gr
function przelicz_na_gr ($wartosc) {
	$wartosc = $wartosc * 100;
	$cena_w_gr = $wartosc;
	return $cena_w_gr;
}
//##### rozpoznaj_miesiac
function rozpoznaj_miesiac ($wartosc) {
	if($wartosc == 1){ $miesiac_to = 'Styczeń'; }else
	if($wartosc == 2){ $miesiac_to = 'Luty'; }else
	if($wartosc == 3){ $miesiac_to = 'Marzec'; }else
	if($wartosc == 4){ $miesiac_to = 'Kwiecień'; }else
	if($wartosc == 5){ $miesiac_to = 'Maj'; }else
	if($wartosc == 6){ $miesiac_to = 'Czerwiec'; }else
	if($wartosc == 7){ $miesiac_to = 'Lipiec'; }else
	if($wartosc == 8){ $miesiac_to = 'Sierpień'; }else
	if($wartosc == 9){ $miesiac_to = 'Wrzesień'; }else
	if($wartosc == 10){ $miesiac_to = 'Październik'; }else
	if($wartosc == 11){ $miesiac_to = 'Listopad'; }else
	if($wartosc == 12){ $miesiac_to = 'Grudzień'; }
	
	return $miesiac_to;
}
//##### rozpoznaj_dzien_tyg
function rozpoznaj_dzien_tyg ($wartosc) {
	if($wartosc == 1){ $dzien_tyg_to = 'Poniedziałek'; }else
	if($wartosc == 2){ $dzien_tyg_to = 'Wtorek'; }else
	if($wartosc == 3){ $dzien_tyg_to = 'Środa'; }else
	if($wartosc == 4){ $dzien_tyg_to = 'Czwartek'; }else
	if($wartosc == 5){ $dzien_tyg_to = 'Piątek'; }else
	if($wartosc == 6){ $dzien_tyg_to = 'Sobota'; }else
	if($wartosc == 7){ $dzien_tyg_to = 'Niedziela'; }
	return $dzien_tyg_to;
}

//##### sprawdzanie poprawnosci nr nip
function CheckNIP($str)
{
	$str = preg_replace("/[^0-9]+/","",$str);
	if (strlen($str) != 10)
	{
		return false;
	}
 
	$arrSteps = array(6, 5, 7, 2, 3, 4, 5, 6, 7);
	$intSum=0;
	for ($i = 0; $i < 9; $i++)
	{
		$intSum += $arrSteps[$i] * $str[$i];
	}
	$int = $intSum % 11;
 
	$intControlNr=($int == 10)?0:$int;
	if ($intControlNr == $str[9])
	{
		return true;
	}
	return false;
}

//##### Formatowanie rozmiaru, sposob uzycia: $wartosc = formatSize($wartosc);
function formatSize($bytes,$decimals=2){
    $size	= array(' B',' KB',' MB',' GB',' TB',' PB',' EB',' ZB',' YB');
    $factor	= floor((strlen($bytes)-1)/3);
	
    return sprintf("%.{$decimals}f",$bytes/pow(1024,$factor)).@$size[$factor];
}