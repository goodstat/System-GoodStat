<?php
	function Pole_Alerts_Ok ($tresc_info){		
	//	global $rodzaj_info, $tresc_info;		
		echo'<div class="container"><div class="alert alert-success fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><img src="images/ikony/tak_Icons.png" style="width: 30px;" /> <strong>OK !</strong> '.$tresc_info.' </div></div>';
	}
	
	function Pole_Alerts_Uwaga ($tresc_info){		
	//	global $rodzaj_info, $tresc_info;		
		echo'<div class="container"><div class="alert alert-danger fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><img src="images/ikony/nie_Icons.png" style="width: 30px;" /> <strong>Uwaga!</strong> '.$tresc_info.' </div></div>';
	}
	
	function Pole_Alerts_Info ($tresc_info){		
	//	global $rodzaj_info, $tresc_info;		
		echo'<div class="container"><div class="alert alert-info fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><img src="images/ikony/nie_Icons.png" style="width: 30px;" /> <strong>Info.</strong> '.$tresc_info.' </div></div>';
	}

	if($uruchom_alert == 'tak'){
		if($rodzaj_alert == 'uwaga'){ Pole_Alerts_Uwaga($tresc_info); }else
		if($rodzaj_alert == 'info'){ Pole_Alerts_Info($tresc_info); }else
		if($rodzaj_alert == 'ok'){ Pole_Alerts_Ok($tresc_info); }
	}

