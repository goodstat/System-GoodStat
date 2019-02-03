<?php

//##### ekran
function ekran($nazwa_tab, $ekran)
{
			global $db;
			
			$stmt = $db->query("SELECT * FROM $nazwa_tab WHERE ekran='$ekran' LIMIT 1");
			
			if($stmt->rowCount() == 0){
			
					//dodanie nowej przegladarki do tabeli
					$stmt = $db->prepare(
						"INSERT INTO $nazwa_tab (id, ekran, wejscia)
						VALUES ('0', '$ekran', '1')"
					);		
					$stmt->execute(); //dodanie nr ip do tabeli
					
					global $db;
			}else{

					//wykonanie zapytania
					if(@$stmt->execute()){
						
						while($wiersz = $stmt->fetch(PDO::FETCH_ASSOC)){
							$wejscia = $wiersz['wejscia']; $wejscia++;
							$nr_ip_id = $wiersz['id'];
							
							$stmt = $db->prepare("UPDATE $nazwa_tab SET `wejscia` = '$wejscia' WHERE `id` = '".$nr_ip_id."' LIMIT 1;");
							$stmt->execute();	//WYKONANIE ZAPYTANIA	
						}// while
					}//if
					
					global $db;
				}
				
				global $db;
}

//##### color
function color($nazwa_tab, $color)
{
			global $db;
			
			$stmt = $db->query("SELECT * FROM $nazwa_tab WHERE color='$color' LIMIT 1");
			
			if($stmt->rowCount() == 0){
			
					//dodanie nowej przegladarki do tabeli
					$stmt = $db->prepare(
						"INSERT INTO $nazwa_tab (id, color, wejscia)
						VALUES ('0', '$color', '1')"
					);		
					$stmt->execute(); //dodanie nr ip do tabeli
					
					global $db;
			}else{

					//wykonanie zapytania
					if(@$stmt->execute()){
						
						while($wiersz = $stmt->fetch(PDO::FETCH_ASSOC)){
							$wejscia = $wiersz['wejscia']; $wejscia++;
							$nr_ip_id = $wiersz['id'];
							
							$stmt = $db->prepare("UPDATE $nazwa_tab SET `wejscia` = '$wejscia' WHERE `id` = '".$nr_ip_id."' LIMIT 1;");
							$stmt->execute();	//WYKONANIE ZAPYTANIA	
						}// while
					}//if
					
					global $db;
				}
				
				global $db;
}

//##### przegladarki
function przegladarki($nazwa_tab, $przegladarki)
{
			global $db;
			
			$stmt = $db->query("SELECT * FROM $nazwa_tab WHERE przegladarki='$przegladarki' LIMIT 1");
			
			if($stmt->rowCount() == 0){
			
					//dodanie nowej przegladarki do tabeli
					$stmt = $db->prepare(
						"INSERT INTO $nazwa_tab (id, przegladarki, wejscia)
						VALUES ('0', '$przegladarki', '1')"
					);		
					$stmt->execute(); //dodanie nr ip do tabeli
					
					global $db;
			}else{

					//wykonanie zapytania
					if(@$stmt->execute()){
						
						while($wiersz = $stmt->fetch(PDO::FETCH_ASSOC)){
							$wejscia = $wiersz['wejscia']; $wejscia++;
							$nr_ip_id = $wiersz['id'];
							
							$stmt = $db->prepare("UPDATE $nazwa_tab SET `wejscia` = '$wejscia' WHERE `id` = '".$nr_ip_id."' LIMIT 1;");
							$stmt->execute();	//WYKONANIE ZAPYTANIA	
						}// while
					}//if
					
					global $db;
				}
				
				global $db;
}


//##### jezyk
function jezyk($nazwa_tab, $jezyk_przegladarki)
{
			global $db;
			
			$stmt = $db->query("SELECT * FROM $nazwa_tab WHERE jezyk='$jezyk_przegladarki' LIMIT 1");
			
			if($stmt->rowCount() == 0){
			
					//dodanie nowej przegladarki do tabeli
					$stmt = $db->prepare(
						"INSERT INTO $nazwa_tab (id, jezyk, wejscia)
						VALUES ('0', '$jezyk_przegladarki', '1')"
					);		
					$stmt->execute(); //dodanie nr ip do tabeli
					
					global $db;
			}else{

					//wykonanie zapytania
					if(@$stmt->execute()){
						
						while($wiersz = $stmt->fetch(PDO::FETCH_ASSOC)){
							$wejscia = $wiersz['wejscia']; $wejscia++;
							$nr_ip_id = $wiersz['id'];
							
							$stmt = $db->prepare("UPDATE $nazwa_tab SET `wejscia` = '$wejscia' WHERE `id` = '".$nr_ip_id."' LIMIT 1;");
							$stmt->execute();	//WYKONANIE ZAPYTANIA	
						}// while
					}//if
					
					global $db;
				}
				
				global $db;
}

//##### system
function system_op($nazwa_tab, $system)
{
			global $db;
			
			$stmt = $db->query("SELECT * FROM $nazwa_tab WHERE system='$system' LIMIT 1");
			
			if($stmt->rowCount() == 0){
			
					//dodanie nowej przegladarki do tabeli
					$stmt = $db->prepare(
						"INSERT INTO $nazwa_tab (id, system, wejscia)
						VALUES ('0', '$system', '1')"
					);		
					$stmt->execute(); //dodanie nr ip do tabeli
					
					global $db;
			}else{

					//wykonanie zapytania
					if(@$stmt->execute()){
						
						while($wiersz = $stmt->fetch(PDO::FETCH_ASSOC)){
							$wejscia = $wiersz['wejscia']; $wejscia++;
							$nr_ip_id = $wiersz['id'];
							
							$stmt = $db->prepare("UPDATE $nazwa_tab SET `wejscia` = '$wejscia' WHERE `id` = '".$nr_ip_id."' LIMIT 1;");
							$stmt->execute();	//WYKONANIE ZAPYTANIA	
						}// while
					}//if
					
					global $db;
				}
				
				global $db;
}

//##### goodStatSeo
function goodStatSeo($refer) {

		$refer = str_replace('#', '&', $refer);

		$sr[] = array('interia', 'q', 'Interia.pl');
        $sr[] = array('google', 'q', 'Google');
        $sr[] = array('google', 'as_q', 'Google');
		$sr[] = array('wp', 'q', 'Wirtualna Polska');
		$sr[] = array('yahoo', 'p', 'Yahoo');
		$sr[] = array('onet', 'qt', 'Onet.pl');
		$sr[] = array('bing', 'q', 'Bing.com');
		$sr[] = array('baidu', 'wd', 'Baidu.com');

        $seach = '';

        // parsuj url'a
        $url = parse_url($refer);

        // twórz zmienne z zapytania url'a
        parse_str($url['query']);

        // liczba znanych wyszukiwarek
        $ile = count($sr);

        // zidentyfikuj wyszukiwarke
        for($n=0; $n<$ile; $n++)
		{
                if(@eregi($sr[$n][0], $refer) && isset($$sr[$n][1]))
				{
                        $search = $sr[$n][2];					
                        break;
                }
        }

        // slowa kluczowe
        if(!empty($search)) {
                $srq = $$sr[$n][1];
                $srq = strtolower($srq);
                $sign = array('%22', '%23', '%24', '%25', '%26', '%27', '%2a', '%2b', '%2c', '%5c');
                while(list($keysign, $valuesign) = each($sign)) $srq = str_replace($valuesign, '', $srq);
                $srq = str_replace('+', ' ', $srq);
                $srq = stripslashes($srq);
                $srq = rawurldecode($srq);
                $ret[1] = strtolower($srq);
                $ret[0] = $search;
        }
		global $wyszu, $slowa;
		
		$wyszu = $ret[0]; $wyszu = trim($wyszu);
		$slowa = $ret[1]; $slowa = trim($slowa);
	
        return $ret;
}


//##### slowa
function slowa($nazwa_tab, $slowa, $wyszu, $data_dodania)
{
	global $nazwa_tab, $slowa, $wyszu, $data_dodania;

	//dodanie nowej godziny do tabeli
	$zapytanie = "INSERT INTO $nazwa_tab (id, slowa, wyszu, data)
		VALUES ('0', '$slowa', '$wyszu', '$data_dodania')";		
			if (@mysql_query ($zapytanie)){	}//dodanie nr ip do tabeli
}

//##### roboty
function jakiRobot() 
{
	global $ciaguser;
	
    $u_agent = $_SERVER['HTTP_USER_AGENT']; //tak bylo: 	$u_agent = $_SERVER['HTTP_USER_AGENT'];
    $nazwa_robota = '';

    //First get the platform?
    if (preg_match('/Yahoo/', $ciaguser)) {
        $nazwa_robota = 'Yahoo';
    }
    elseif (preg_match('/Googlebot/', $ciaguser)) {
        $nazwa_robota = 'Googlebot';
    }
    elseif (preg_match('/Google/', $ciaguser)) {
        $nazwa_robota = 'Googlebot';
    }
    elseif (preg_match('/BingPreview/', $ciaguser)) {
        $nazwa_robota = 'BingBot';
    }
    elseif (preg_match('/Baiduspider/', $ciaguser)) {
        $nazwa_robota = 'Baidu Spider';
    }
    elseif (preg_match('/Yandex/', $ciaguser)) {
        $nazwa_robota = 'Yandex Bot';
    }
    elseif (preg_match('/Sosoimagespider/', $ciaguser)) {
        $nazwa_robota = 'Soso Spider';	
    }
    elseif (preg_match('/Exabot/', $ciaguser)) {
        $nazwa_robota = 'ExaBot';	
    }
    elseif (preg_match('/curl/', $ciaguser)) {
        $nazwa_robota = 'Curl';
    }
    elseif (preg_match('/Sogou/', $ciaguser)) {
        $nazwa_robota = 'Sogou Spider';
    }
    elseif (preg_match('/facebookexternalhit/', $ciaguser)) {
        $nazwa_robota = 'Facebook External Hit';
    }
    elseif (preg_match('/FeedWordPress/', $ciaguser)) {
        $nazwa_robota = 'FeedWordPress Bot';
    }
	
	global $ciaguser;
	return $nazwa_robota;
	
/*
    return array(
     //   'userAgent' => $u_agent,
        'name'      => $nazwa_bota,
    );
*/
} 
/**/
?>