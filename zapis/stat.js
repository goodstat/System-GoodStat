document.cookie = 'ekran=' + window.screen.width + 'x' + window.screen.height;

var nVer = navigator.appVersion;
var nAgt = navigator.userAgent;
var przeg  = navigator.appName;
var fullVersion  = ''+parseFloat(navigator.appVersion); 


//******************************************************************************
//		ROZPOZNAWANIE PRZEGLADARKI
//******************************************************************************
if ((verOffset=nAgt.indexOf("Edge"))!=-1) { 
 przeg = 'Microsoft Edge';
}
// In MSIE, the true version is after "MSIE" in userAgent
else if ((verOffset=nAgt.indexOf("MSIE"))!=-1) { 
 przeg = 'Internet Explorer';
}
// In Opera, the true version is after "Opera" 
else if ((verOffset=nAgt.indexOf("OPR"))!=-1) {
 przeg = 'Opera';
}
// In Opera, the true version is after "Opera" 
else if ((verOffset=nAgt.indexOf("Opera"))!=-1) {
 przeg = 'Opera';
}
// In Chrome, the true version is after "Chrome" 
else if ((verOffset=nAgt.indexOf("Chrome"))!=-1) {
 przeg = 'Chrome';
}
// In MSIE, the true version is after "MSIE" in userAgent
else if ((verOffset=nAgt.indexOf("like Gecko"))!=-1) { 
 przeg = 'Internet Explorer';
}
// In Safari, the true version is after "Safari" 
else if ((verOffset=nAgt.indexOf("Safari"))!=-1) {
 przeg = "Safari";
}
// In Firefox, the true version is after "Firefox" 
else if ((verOffset=nAgt.indexOf("Firefox"))!=-1) {
 przeg = 'Firefox';
}
// In most other browsers, "name/version" is at the end of userAgent 
else if ( (nameOffset=nAgt.lastIndexOf(' ')+1) < (verOffset=nAgt.lastIndexOf('/')) ) 
{
 przeg = nAgt.substring(nameOffset,verOffset);
 fullVersion = nAgt.substring(verOffset+1);
 if (przeg.toLowerCase()==przeg.toUpperCase()) {
  przeg = navigator.appName;
 }
}
// trim the fullVersion string at semicolon/space if present
if ((ix=fullVersion.indexOf(";"))!=-1) fullVersion=fullVersion.substring(0,ix);
if ((ix=fullVersion.indexOf(" "))!=-1) fullVersion=fullVersion.substring(0,ix);

majorVersion = parseInt(''+fullVersion,10);
if (isNaN(majorVersion)) {
 fullVersion  = ''+parseFloat(navigator.appVersion); 
 majorVersion = parseInt(navigator.appVersion,10);
}

//******************************************************************************
//		ROZPOZNAWANIE SYSTEMU
//******************************************************************************
if (navigator.userAgent.indexOf("Win")!=-1){
	//system WINDOWS
	if (navigator.userAgent.indexOf("NT 10.0")!=-1){system="Windows 10";}
	else if (navigator.userAgent.indexOf("NT 6.1")!=-1){system="Windows 7";}
	else if (navigator.userAgent.indexOf("NT 6.0")!=-1){system="Windows Vista";}
	else if (navigator.userAgent.indexOf("NT 5.1")!=-1){system="Windows XP";}
	else if (navigator.userAgent.indexOf("NT 5.2")!=-1){system="Windows Server 2003";}
	else if (navigator.userAgent.indexOf("NT 5.0")!=-1){system="Windows 2000";}
	else if (navigator.userAgent.indexOf("Win98")!=-1){system="Windows 98";}
	else if (navigator.userAgent.indexOf("Win 9x")!=-1){system="Windows ME";}	
	else if (navigator.userAgent.indexOf("Win95")!=-1){system="Windows 95";}
}
else if (navigator.userAgent.indexOf("Android")!=-1){system="Android";}
else if (navigator.userAgent.indexOf("Linux")!=-1){system="Linux";}
else if (navigator.userAgent.indexOf("X11")!=-1){system="Linux";}
else if (navigator.userAgent.indexOf("Mac")!=-1){system="Macintosh";}
else{system = "inny";}


//******************************************************************************
//		ROZPOZNANIE JEZYKA
//******************************************************************************
if(navigator.userAgent.indexOf("pl")!=-1){jezyk_przegladarki="polski";}		
else if (navigator.userAgent.indexOf("en")!=-1){jezyk_przegladarki="angielski";}
else if (navigator.userAgent.indexOf("fr")!=-1){jezyk_przegladarki="francuski";}	
else if (navigator.userAgent.indexOf("de")!=-1){jezyk_przegladarki="niemiecki";}
else if (navigator.userAgent.indexOf("it")!=-1){jezyk_przegladarki="wloski";}
else if (navigator.userAgent.indexOf("es")!=-1){jezyk_przegladarki="hiszpanski";}
else if (navigator.userAgent.indexOf("uk")!=-1){jezyk_przegladarki="ukrainski";}
else if (navigator.userAgent.indexOf("ru")!=-1){jezyk_przegladarki="rosyjski";}
else if (navigator.userAgent.indexOf("cs")!=-1){jezyk_przegladarki="czeski";}
else if (navigator.userAgent.indexOf("nl")!=-1){jezyk_przegladarki="holenderski";}
else if (navigator.userAgent.indexOf("sv")!=-1){jezyk_przegladarki="szwedzki";}
else if (navigator.userAgent.indexOf("no")!=-1){jezyk_przegladarki="norwegia";}
else if (navigator.userAgent.indexOf("pt")!=-1){jezyk_przegladarki="portugalia";}
else if (navigator.userAgent.indexOf("ro")!=-1){jezyk_przegladarki="rumunia";}
else if (navigator.userAgent.indexOf("sk")!=-1){jezyk_przegladarki="slowacja";}
else if (navigator.userAgent.indexOf("sl")!=-1){jezyk_przegladarki="slowenia";}
else if (navigator.userAgent.indexOf("sr")!=-1){jezyk_przegladarki="serbia";}
else if (navigator.userAgent.indexOf("zh")!=-1){jezyk_przegladarki="chiny";}
else if (navigator.userAgent.indexOf("bg")!=-1){jezyk_przegladarki="bulgaria";}
else if (navigator.userAgent.indexOf("da")!=-1){jezyk_przegladarki="dania";}
else if (navigator.userAgent.indexOf("el")!=-1){jezyk_przegladarki="grecja";}
else if (navigator.userAgent.indexOf("et")!=-1){jezyk_przegladarki="estonia";}
else if (navigator.userAgent.indexOf("fi")!=-1){jezyk_przegladarki="finlandia";}
else if (navigator.userAgent.indexOf("hu")!=-1){jezyk_przegladarki="wegry";}
else if (navigator.userAgent.indexOf("hy")!=-1){jezyk_przegladarki="armenia";}
else if (navigator.userAgent.indexOf("kn")!=-1){jezyk_przegladarki="kanada";}


else{jezyk_przegladarki = "inny";}

                function setCookie(sName, sValue, oExpires, sPath, sDomain, bSecure) {
                    var sCookie = sName + "=" + encodeURIComponent(sValue);
                
                    if (oExpires) {
                        sCookie += "; expires=" + oExpires.toGMTString();
                    }
                
                    if (sPath) {
                        sCookie += "; path=" + sPath;
                    }
                
                    if (sDomain) {
                        sCookie += "; domain=" + sDomain;
                    }
                
                    if (bSecure) {
                        sCookie += "; secure";
                    }
                
                    document.cookie = sCookie;
                }

                function getCookie(sName) {
                
                    var sRE = "(?:; )?" + sName + "=([^;]*);?";
                    var oRE = new RegExp(sRE);
                    
                    if (oRE.test(document.cookie)) {
                        return decodeURIComponent(RegExp["$1"]);
                    } else {
                        return null;
                    }
                
                } 
				
var ekranik = window.screen.width + 'x' + window.screen.height;

setCookie(ekran, ekranik);

var ekran = getCookie(ekran);
var color = screen.colorDepth;
var przegladarka = przeg;

var podstrona = location.pathname + window.location.search;

var podstrona = podstrona.replace("&", "|");

/*
var podstrona = location.pathname+location;
var podstrona = location.pathname + window.location.search;
*/

 
document.write('<img src="http://'+ ipath +'/zapis.php?podstrona='+ podstrona +'&przegladarka='+ przegladarka +'&ekran='+ ekran +'&color='+ color +'&system=' +system+ '&jezyk_przegladarki=' +jezyk_przegladarki+ '&ciaguser=' +nAgt+ '&idref=' +document.referrer+ '"style="border: none; display:none; visibility:collapse;">')

