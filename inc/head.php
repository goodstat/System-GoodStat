	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Statystyki GoodStat - Darmowe statystyki na stronę www</title>
	
	<meta name="keywords" content="statystyki stron www, darmowe statystyki stron www, statystyki na bloga, darmowe statystyki, system goodstat, statystyki goodstat, statystyki do instalacji" />
	<meta name="description" content="GoodStat - Darmowe statystyki stron www do samodzielnej instalacji na zdalnym hostingu." />
	<meta name="author" content="GoodStat.com.pl" />

	<!-- bootstrap js -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

	<!-- tooltip 
	<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<!--
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>-->
	
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">

	<!-- styl CSS GoodStat -->
	<link rel="stylesheet" href="css/goodstat.css">
	<link rel="stylesheet" href="css/prism.css">
	
	<link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
	
	<!-- favicon -->
	<link rel="apple-touch-icon" sizes="57x57" href="images/favicon/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="images/favicon/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="images/favicon/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="images/favicon/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/favicon/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="images/favicon/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="images/favicon/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="images/favicon/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="images/favicon/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192" href="images/favicon/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="images/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="images/favicon/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href=">images/favicon/favicon-16x16.png">
	<link rel="manifest" href="/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="images/favicon/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
	
	<!-- animacje -->
	<link rel="stylesheet" type="text/css" href="css/animacja.css">
	<link rel="stylesheet" type="text/css" href="css/animate/animate.min.css">
	
	<!-- ikony: https://material.io/icons/ -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	
	<!-- start data i zegar -->
	<script type="text/javascript">
		tday=new Array("Niedziela","Poniedziałek","Wtorek","Środa","Czwartek","Piątek","Sobota");
		tmonth=new Array("Styczeń","Luty","Marzec","Kwiecień","Maj","Czerwiec","Lipiec","Sierpień","Wrzesień","Październik","Listopad","Grudzień");

		function GetClock(){
			var d=new Date();
			var nday=d.getDay(),nmonth=d.getMonth(),ndate=d.getDate(),nyear=d.getYear(),nhour=d.getHours(),nmin=d.getMinutes(),nsec=d.getSeconds(),ap;

			if(nyear<1000) nyear+=1900;
			if(nmin<=9) nmin="0"+nmin;
			if(nsec<=9) nsec="0"+nsec;

			document.getElementById('clockbox').innerHTML=""+ndate+" "+tmonth[nmonth]+" "+nyear+", "+tday[nday]+" <i class='material-icons'>access_time</i> "+nhour+":"+nmin+":"+nsec+"";
		}

		window.onload=function(){
			GetClock();
			setInterval(GetClock,1000);
		}
	</script>
	<!-- stop data i zegar -->
	
	<!-- przelaczanie class -->
    <script>
        var num = 100; //number of pixels before modifying styles

        $(window).bind('scroll', function () {
            if ($(window).scrollTop() > num) {
				$('#logo').removeClass('animated flipInX');
				$('#tekst-baner').removeClass('animated flipInX');
            } else {
				$('#logo').addClass('animated flipInX');
				$('#tekst-baner').addClass('animated flipInX');
            }
        });
    </script>
	
    <script>
        var num_scr = 100; //number of pixels before modifying styles

        $(window).bind('scroll', function () {
            if ($(window).scrollTop() > num_scr) {
				$('#top-link-block').addClass('affix animated bounceInDown');
				
            } else {
                $('#top-link-block').removeClass('affix animated bounceInDown');
            }
        });
    </script>