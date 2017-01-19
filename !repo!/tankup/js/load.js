var crd;

if(!navigator.onLine) alert("Kein Empfang - Preise sind veraltet!");

function loadPage() {

    	if(document.getElementById('progress')) {
    		document.getElementById('progress').style.display="inline";
    	}    	
} 

function pageLoaded() {

    	if(document.getElementById('progress')) {
    		document.getElementById('progress').style.display="none";
    	} 
} 

var anbieter0;var offenv;var offenAbv;var offenBisv;var lonv;var latv;var preisv;var strassev;var hausnrv;var plzv;var ort0;var zeitv;var disv;var idv;
var anbieter1;var offenw;var offenAbw;var offenBisw;var lonw;var latw;var preisw;var strassew;var hausnrw;var plzw;var ort1;var zeitw;var disw;var idw;
var anbieter2;var offenx;var offenAbx;var offenBisx;var lonx;var latx;var preisx;var strassex;var hausnrx;var plzx;var ort2;var zeitx;var disx;var idx;
var anbieter3;var offeny;var offenAby;var offenBisy;var lony;var laty;var preisy;var strassey;var hausnry;var plzy;var ort3;var zeity;var disy;var idy;
var anbieter4;var offenz;var offenAbz;var offenBisz;var lonz;var latz;var preisz;var strassez;var hausnrz;var plzz;var ort4;var zeitz;var disz;var idz;

var lastTown = "";

function getDataByCoord()
{
	getDataByCoords(localStorage.getItem('latAct'), localStorage.getItem('lonAct'));
}

function getDataByCoords(latitude, longitude){
				$.post("getDataByCoords.php",
    			{
        			art: document.getElementById('art').value,
        			longitude: longitude,
        			latitude: latitude,
        			umkreis: document.getElementById('umkreis').value,
        			sortieren: document.getElementById('sortieren').value
    			},
    			function (data) {
    				anbieter0 = null;
    				anbieter1 = null;
    				anbieter2 = null;
    				anbieter3 = null;
    				anbieter4 = null;
					var hasNext = false;	
    				if(data.indexOf("anbieter0") >= 0) {
    					hasNext = true;
    				}
    				if(hasNext){    					
    					anbieter0 = data.substring(data.indexOf("anbieter0")+9,data.indexOf("offenv"));
    					offenv = data.substring(data.indexOf("offenv")+6,data.indexOf("offenAbv"));
    					offenAbv = data.substring(data.indexOf("offenAbv")+8,data.indexOf("offenBisv"));
    					offenBisv = data.substring(data.indexOf("offenBisv")+9,data.indexOf("preisv"));
						preisv = data.substring(data.indexOf("preisv")+6,data.indexOf("lonv"));
						lonv = data.substring(data.indexOf("lonv")+4,data.indexOf("latv"));
						latv = data.substring(data.indexOf("latv")+4,data.indexOf("strassev"));
						strassev = data.substring(data.indexOf("strassev")+8,data.indexOf("hausnrv"));
						hausnrv = data.substring(data.indexOf("hausnrv")+7,data.indexOf("plzv"));
						plzv = data.substring(data.indexOf("plzv")+4,data.indexOf("ort0"));										
						ort0 = data.substring(data.indexOf("ort0")+4,data.indexOf("disv"));	 
						disv = data.substring(data.indexOf("disv")+4,data.indexOf("zeitv"));
						zeitv = data.substring(data.indexOf("zeitv")+5,data.indexOf("idv"));
						if(data.indexOf("anbieter1") > 0) {
							idv = data.substring(data.indexOf("idv")+3,data.indexOf("anbieter1"));
							hasNext = true;
						}
						else {
							idv = data.substring(data.indexOf("idv")+3,data.length-2);
							hasNext = false;	
						}

						document.getElementById('tankstelle').innerHTML = "<a target='_blank' href='http://maps.google.de/maps?saddr="+localStorage.getItem('latAct')+","+localStorage.getItem('lonAct')+"(Startpunkt)&daddr="+latv+","+lonv+"("+anbieter0.replace(/\s/g, "")+")&t=h&om=0' id='tankstelleText' class='button' style='font-size:55%'>"+anbieter0+"</a>";
		  				document.getElementById('preisOutput').value = " " + preisv + " €/L ";
		  				document.getElementById('oeffnungszeiten').innerHTML = "<span class='tooltip tooltipUnten' data-tooltip-text='geöffnet von " +offenAbv+" bis "+offenBisv+"'> <img style='border:2px solid white' src='img/" + (offenv == "1" ? "open.jpg" : "closed.jpg") + "' ></span>";
		  			}
		  			
		  			if(hasNext){
    					anbieter1 = data.substring(data.indexOf("anbieter1")+9,data.indexOf("offenw"));
						offenw = data.substring(data.indexOf("offenw")+6,data.indexOf("offenAbw"));
    					offenAbw = data.substring(data.indexOf("offenAbw")+8,data.indexOf("offenBisw"));
    					offenBisw = data.substring(data.indexOf("offenBisw")+9,data.indexOf("preisw"));						
						preisw = data.substring(data.indexOf("preisw")+6,data.indexOf("lonw"));
						lonw = data.substring(data.indexOf("lonw")+4,data.indexOf("latw"));
						latw = data.substring(data.indexOf("latw")+4,data.indexOf("strassew"));
						strassew = data.substring(data.indexOf("strassew")+8,data.indexOf("hausnrw"));
						hausnrw = data.substring(data.indexOf("hausnrw")+7,data.indexOf("plzw"));
						plzw = data.substring(data.indexOf("plzw")+4,data.indexOf("ort1"));									
						ort1 = data.substring(data.indexOf("ort1")+4,data.indexOf("disw"));
						disw = data.substring(data.indexOf("disw")+4,data.indexOf("zeitw"));	
						zeitw = data.substring(data.indexOf("zeitw")+5,data.indexOf("idw"));			
						if(data.indexOf("anbieter2") > 0) {

							idw = data.substring(data.indexOf("idw")+3,data.indexOf("anbieter2"));
							hasNext = true;
						}
						else {
							idw = data.substring(data.indexOf("idw")+3,data.length-2);
							hasNext = false;	
						}
					}
					
		  			if(hasNext){
 			    		anbieter2 = data.substring(data.indexOf("anbieter2")+9,data.indexOf("offenx"));
						offenx = data.substring(data.indexOf("offenx")+6,data.indexOf("offenAbx"));
    					offenAbx = data.substring(data.indexOf("offenAbx")+8,data.indexOf("offenBisx"));
    					offenBisx = data.substring(data.indexOf("offenBisx")+9,data.indexOf("preisx"));
						preisx = data.substring(data.indexOf("preisx")+6,data.indexOf("lonx"));
						lonx = data.substring(data.indexOf("lonx")+4,data.indexOf("latx"));
						latx = data.substring(data.indexOf("latx")+4,data.indexOf("strassex"));
						strassex = data.substring(data.indexOf("strassex")+8,data.indexOf("hausnrx"));
						hausnrx = data.substring(data.indexOf("hausnrx")+7,data.indexOf("plzx"));
						plzx = data.substring(data.indexOf("plzx")+4,data.indexOf("ort2"));	
						ort2 = data.substring(data.indexOf("ort2")+4,data.indexOf("disx"));
						disx = data.substring(data.indexOf("disx")+4,data.indexOf("zeitx"));	
						zeitx = data.substring(data.indexOf("zeitx")+5,data.indexOf("idx"));								
						
						if(data.indexOf("anbieter3") > 0) {

							idx = data.substring(data.indexOf("idx")+3,data.indexOf("anbieter3"));
							hasNext = true;
						}
						else {
							idx = data.substring(data.indexOf("idx")+3,data.length-2);
							hasNext = false;	
						}
					}
					
					if(hasNext){
    					anbieter3 = data.substring(data.indexOf("anbieter3")+9,data.indexOf("offeny"));
						offeny = data.substring(data.indexOf("offeny")+6,data.indexOf("offenAby"));
    					offenAby = data.substring(data.indexOf("offenAby")+8,data.indexOf("offenBisy"));
    					offenBisy = data.substring(data.indexOf("offenBisy")+9,data.indexOf("preisy"));	
						preisy = data.substring(data.indexOf("preisy")+6,data.indexOf("lony"));
						lony = data.substring(data.indexOf("lony")+4,data.indexOf("laty"));
						laty = data.substring(data.indexOf("laty")+4,data.indexOf("strassey"));
						strassey = data.substring(data.indexOf("strassey")+8,data.indexOf("hausnry"));
						hausnry = data.substring(data.indexOf("hausnry")+7,data.indexOf("plzy"));
						plzy = data.substring(data.indexOf("plzy")+4,data.indexOf("ort3"));										
						ort3 = data.substring(data.indexOf("ort3")+4,data.indexOf("disy"));
						disy = data.substring(data.indexOf("disy")+4,data.indexOf("zeity"));	
						zeity = data.substring(data.indexOf("zeity")+5,data.indexOf("idy"));						
						if(data.indexOf("anbieter4") > 0) {

							idy = data.substring(data.indexOf("idy")+3,data.indexOf("anbieter4"));
							hasNext = true;
						}
						else {
							idy = data.substring(data.indexOf("idy")+3,data.length-2);
							hasNext = false;	
						}
					}
					
					if(hasNext){
    					anbieter4 = data.substring(data.indexOf("anbieter4")+9,data.indexOf("offenz"));
						offenz = data.substring(data.indexOf("offenz")+6,data.indexOf("offenAbz"));
    					offenAbz = data.substring(data.indexOf("offenAbz")+8,data.indexOf("offenBisz"));
    					offenBisz = data.substring(data.indexOf("offenBisz")+9,data.indexOf("preisz"));
						preisz = data.substring(data.indexOf("preisz")+6,data.indexOf("lonz"));
						lonz = data.substring(data.indexOf("lonz")+4,data.indexOf("latz"));
						latz = data.substring(data.indexOf("latz")+4,data.indexOf("strassez"));
						strassez = data.substring(data.indexOf("strassez")+8,data.indexOf("hausnrz"));
						hausnrz = data.substring(data.indexOf("hausnrz")+7,data.indexOf("plzz"));
						plzz = data.substring(data.indexOf("plzz")+4,data.indexOf("ort4"));	
						ort4 = data.substring(data.indexOf("ort4")+4,data.indexOf("disz"));
						disz = data.substring(data.indexOf("disz")+4,data.indexOf("zeitz"));	
						zeitz = data.substring(data.indexOf("zeitz")+5,data.indexOf("idz"));									
						idz = data.substring(data.indexOf("idz")+3,data.length-2);							
					}
		  			
		  			var results = document.getElementById('results');
		  			var tableText = "<table summary='results' >";
		  			if(anbieter0 != null) {
		  				tableText += "<tr><td id='td0' class='whiteBorder'><span class='tooltip tooltipUnten' style='font-size:100%' data-tooltip-text='Details anzeigen'><a href='javascript:selectResult(0)'><img src='img/tankstelle.jpg' /></a></span></td>";
		  				tableText += "<td>"+anbieter0+"<br><span class='red'>"+Math.round(disv*100)/100+" km</span></td>";
		  				tableText += "<td class='preis'>"+preisv.substr(0,preisv.length-1)+"<sup><small>"+preisv.substr(preisv.length-1,1)+"</small></sup> €/L</td>";
		  				tableText += "<td>"+strassev+" "+hausnrv+"<br>"+ plzv +" " + ort0 + "</td>";
		  				if(localStorage.getItem(idv) == idv)	
		  				{
		  					tableText += "<td id='fav0' class='isFav' onclick='changeFavorit(idv, 0)'><span class='tooltip tooltipUnten' style='font-size:100%' data-tooltip-text='Als Favorit (ab)wählen'><a class='transparent'>Favorit<br>Favorit<br>Favorit<br></a></span></td>";
		  				}
		  				else
		  				{
		  					tableText += "<td id='fav0' class='noFav' onclick='changeFavorit(idv, 0)'><span class='tooltip tooltipUnten' style='font-size:100%' data-tooltip-text='Als Favorit (ab)wählen'><a class='transparent'>Favorit<br>Favorit<br>Favorit<br></a></span></td>";
		  				}
		  				tableText += "</tr>";
		  			}
		  			if(anbieter1 != null) {
		  				tableText += "<tr><td id='td1' class='whiteBorder'><span class='tooltip tooltipUnten' style='font-size:100%' data-tooltip-text='Details anzeigen'><a href='javascript:selectResult(1)'><img src='img/tankstelle.jpg' /></a></span></td>";
		  				tableText += "<td>"+anbieter1+"<br><span class='red'>"+Math.round(disw*100)/100+" km</span></td>";
		  				tableText += "<td class='preis'>"+preisw.substr(0,preisw.length-1)+"<sup><small>"+preisw.substr(preisw.length-1,1)+"</small></sup> €/L</td>";
		  				tableText += "<td>"+strassew+" "+hausnrw+"<br>"+ plzw +" " + ort1 + "</td>";
		  				if(localStorage.getItem(idw) == idw)	
		  				{
		  					tableText += "<td id='fav1' class='isFav' onclick='changeFavorit(idw, 1)'><span class='tooltip tooltipUnten' style='font-size:100%' data-tooltip-text='Als Favorit (ab)wählen'><a class='transparent'>Favorit<br>Favorit<br>Favorit<br></a></span></td>";
		  				}
		  				else
		  				{
		  					tableText += "<td id='fav1' class='noFav' onclick='changeFavorit(idw, 1)'><span class='tooltip tooltipUnten' style='font-size:100%' data-tooltip-text='Als Favorit (ab)wählen'><a class='transparent'>Favorit<br>Favorit<br>Favorit<br></a></span></td>";
		  				}
		  				tableText += "</tr>";
		  			}
		  			if(anbieter2 != null) {
		  				tableText += "<tr><td id='td2' class='whiteBorder'><span class='tooltip tooltipUnten' style='font-size:100%' data-tooltip-text='Details anzeigen'><a href='javascript:selectResult(2)'><img src='img/tankstelle.jpg' /></a></span></td>";
		  				tableText += "<td>"+anbieter2+"<br><span class='red'>"+Math.round(disx*100)/100+" km</span></td>";
		  				tableText += "<td class='preis'>"+preisx.substr(0,preisx.length-1)+"<sup><small>"+preisx.substr(preisx.length-1,1)+"</small></sup> €/L</td>";
		  				tableText += "<td>"+strassex+" "+hausnrx+"<br>"+ plzx +" " + ort2 + "</td>";
		  				if(localStorage.getItem(idx) == idx)	
		  				{
		  					tableText += "<td id='fav2' class='isFav' onclick='changeFavorit(idx, 2)'><span class='tooltip tooltipUnten' style='font-size:100%' data-tooltip-text='Als Favorit (ab)wählen'><a class='transparent'>Favorit<br>Favorit<br>Favorit<br></a></span></td>";
		  				}
		  				else
		  				{
		  					tableText += "<td id='fav2' class='noFav' onclick='changeFavorit(idx, 2)'><span class='tooltip tooltipUnten' style='font-size:100%' data-tooltip-text='Als Favorit (ab)wählen'><a class='transparent'>Favorit<br>Favorit<br>Favorit<br></a></span></td>";
		  				}
		  				tableText += "</tr>";
		  			}
		  			if(anbieter3 != null) {
		  				tableText += "<tr><td id='td3' class='whiteBorder'><span class='tooltip tooltipUnten' style='font-size:100%' data-tooltip-text='Details anzeigen'><a href='javascript:selectResult(3)'><img src='img/tankstelle.jpg' /></a></span></td>";
		  				tableText += "<td>"+anbieter3+"<br><span class='red'>"+Math.round(disy*100)/100+" km</span></td>";
		  				tableText += "<td class='preis'>"+preisy.substr(0,preisy.length-1)+"<sup><small>"+preisy.substr(preisy.length-1,1)+"</small></sup> €/L</td>";
		  				tableText += "<td>"+strassey+" "+hausnry+"<br>"+ plzy +" " + ort3 + "</td>";
		  				if(localStorage.getItem(idy) == idy)	
		  				{
		  					tableText += "<td id='fav3' class='isFav' onclick='changeFavorit(idy, 3)'><span class='tooltip tooltipUnten' style='font-size:100%' data-tooltip-text='Als Favorit (ab)wählen'><a class='transparent'>Favorit<br>Favorit<br>Favorit<br></a></span></td>";
		  				}
		  				else
		  				{
		  					tableText += "<td id='fav3' class='noFav' onclick='changeFavorit(idy, 3)'><span class='tooltip tooltipUnten' style='font-size:100%' data-tooltip-text='Als Favorit (ab)wählen'><a class='transparent'>Favorit<br>Favorit<br>Favorit<br></a></span></td>";
		  				}
		  				tableText += "</tr>";
		  			}
		  			if(anbieter4 != null) {
		  				tableText += "<tr><td id='td4' class='whiteBorder'><span class='tooltip tooltipUnten' style='font-size:100%' data-tooltip-text='Details anzeigen'><a href='javascript:selectResult(4)'><img src='img/tankstelle.jpg' /></a></span></td>";
		  				tableText += "<td>"+anbieter4+"<br><span class='red'>"+Math.round(disz*100)/100+" km</span></td>";
		  				tableText += "<td class='preis'>"+preisz.substr(0,preisz.length-1)+"<sup><small>"+preisz.substr(preisz.length-1,1)+"</small></sup> €/L</td>";
		  				tableText += "<td>"+strassez+" "+hausnrz+"<br>"+ plzz +" " + ort4 + "</td>";
		  				if(localStorage.getItem(idz) == idz)	
		  				{
		  					tableText += "<td id='fav4' class='isFav' onclick='changeFavorit(idz, 4)'><span class='tooltip tooltipUnten' style='font-size:100%' data-tooltip-text='Als Favorit (ab)wählen'><a class='transparent'>Favorit<br>Favorit<br>Favorit<br></a></span></td>";
		  				}
		  				else
		  				{
		  					tableText += "<td id='fav4' class='noFav' onclick='changeFavorit(idz, 4)'><span class='tooltip tooltipUnten' style='font-size:100%' data-tooltip-text='Als Favorit (ab)wählen'><a class='transparent'>Favorit<br>Favorit<br>Favorit<br></a></span></td>";
		  				}
		  				tableText += "</tr>";
		  			}
		  			if(data == null || data.indexOf("keine Ergebnisse") >= 0) {
		  				tableText += "<td>Keine Ergebnisse</td>"
		  			}
					tableText += "</table>";
		  			results.innerHTML = tableText;
		  			var route = document.getElementById('route');
		  			if(anbieter0 != null)
		  				route.innerHTML = "<a target='_blank' href='http://maps.google.de/maps?saddr="+localStorage.getItem('latAct')+","+localStorage.getItem('lonAct')+"(Startpunkt)&daddr="+latv+","+lonv+"("+anbieter0.replace(/\s/g, "")+")&t=h&om=0'><img src='img/routenplaner.jpg' width='75%' alt='' ></a>";
		  	 
    			});
				
}

function getDataByTown(){
				$.post("getDataByTown.php",
    			{
        			art: document.getElementById('art').value,
        			town: document.getElementById('stadt').value
    			},
    			function (data) {
    				anbieter0 = null;
    				anbieter1 = null;
    				anbieter2 = null;
    				anbieter3 = null;
    				anbieter4 = null;
					var hasNext = false;	
    				if(data.indexOf("anbieter0") >= 0) {
    					hasNext = true;
    				}
    				if(hasNext){    					
    					anbieter0 = data.substring(data.indexOf("anbieter0")+9,data.indexOf("preisv"));
						preisv = data.substring(data.indexOf("preisv")+6,data.indexOf("lonv"));
						lonv = data.substring(data.indexOf("lonv")+4,data.indexOf("latv"));
						latv = data.substring(data.indexOf("latv")+4,data.indexOf("strassev"));						
						strassev = data.substring(data.indexOf("strassev")+8,data.indexOf("hausnrv"));
						hausnrv = data.substring(data.indexOf("hausnrv")+7,data.indexOf("plzv"));
						plzv = data.substring(data.indexOf("plzv")+4,data.indexOf("ort0"));										
						ort0 = data.substring(data.indexOf("ort0")+4,data.indexOf("zeitv"));	
						zeitv = data.substring(data.indexOf("zeitv")+5,data.indexOf("idv"));
						if(data.indexOf("anbieter1") > 0) {
							idv = data.substring(data.indexOf("idv")+3,data.indexOf("anbieter1"));
							hasNext = true;
						}
						else {
							idv = data.substring(data.indexOf("idv")+3,data.length-2);
							hasNext = false;	
						}

					document.getElementById('tankstelle').innerHTML = "<a target='_blank' href='http://maps.google.de/maps?saddr="+localStorage.getItem('latAct')+","+localStorage.getItem('lonAct')+"(Startpunkt)&daddr="+latv+","+lonv+"("+anbieter0.replace(/\s/g, "")+")&t=h&om=0' id='tankstelleText' class='button' style='font-size:55%'>"+anbieter0+"</a>";
		  			document.getElementById('preisOutput').value = " " + preisv + " €/L ";
					document.getElementById('oeffnungszeiten').innerHTML = "<span class='tooltip tooltipUnten' data-tooltip-text='geöffnet von " +offenAbv+" bis "+offenBisv+"'> <img style='border:2px solid white' src='img/" + (offenv == "1" ? "open.jpg" : "closed.jpg") + "'></span>";
		  			}
		  			
		  			if(hasNext){
    					anbieter1 = data.substring(data.indexOf("anbieter1")+9,data.indexOf("preisw"));
						preisw = data.substring(data.indexOf("preisw")+6,data.indexOf("lonw"));
						lonw = data.substring(data.indexOf("lonw")+4,data.indexOf("latw"));
						latw = data.substring(data.indexOf("latw")+4,data.indexOf("strassew"));						
						strassew = data.substring(data.indexOf("strassew")+8,data.indexOf("hausnrw"));
						hausnrw = data.substring(data.indexOf("hausnrw")+7,data.indexOf("plzw"));
						plzw = data.substring(data.indexOf("plzw")+4,data.indexOf("ort1"));									
						ort1 = data.substring(data.indexOf("ort1")+4,data.indexOf("zeitw"));	
						zeitw = data.substring(data.indexOf("zeitw")+5,data.indexOf("idw"));			
						if(data.indexOf("anbieter2") > 0) {

							idw = data.substring(data.indexOf("idw")+3,data.indexOf("anbieter2"));
							hasNext = true;
						}
						else {
							idw = data.substring(data.indexOf("idw")+3,data.length-2);
							hasNext = false;	
						}
					}
					
		  			if(hasNext){
 			    		anbieter2 = data.substring(data.indexOf("anbieter2")+9,data.indexOf("preisx"));						
						preisx = data.substring(data.indexOf("preisx")+6,data.indexOf("lonx"));
						lonx = data.substring(data.indexOf("lonx")+4,data.indexOf("latx"));
						latx = data.substring(data.indexOf("latx")+4,data.indexOf("strassex"));
						strassex = data.substring(data.indexOf("strassex")+8,data.indexOf("hausnrx"));
						hausnrx = data.substring(data.indexOf("hausnrx")+7,data.indexOf("plzx"));
						plzx = data.substring(data.indexOf("plzx")+4,data.indexOf("ort2"));	
						ort2 = data.substring(data.indexOf("ort2")+4,data.indexOf("zeitx"));	
						zeitx = data.substring(data.indexOf("zeitx")+5,data.indexOf("idx"));								
						
						if(data.indexOf("anbieter3") > 0) {

							idx = data.substring(data.indexOf("idx")+3,data.indexOf("anbieter3"));
							hasNext = true;
						}
						else {
							idx = data.substring(data.indexOf("idx")+3,data.length-2);
							hasNext = false;	
						}
					}
					
					if(hasNext){
    					anbieter3 = data.substring(data.indexOf("anbieter3")+9,data.indexOf("preisy"));
						preisy = data.substring(data.indexOf("preisy")+6,data.indexOf("lony"));
						lony = data.substring(data.indexOf("lony")+4,data.indexOf("laty"));
						laty = data.substring(data.indexOf("laty")+4,data.indexOf("strassey"));						
						strassey = data.substring(data.indexOf("strassey")+8,data.indexOf("hausnry"));
						hausnry = data.substring(data.indexOf("hausnry")+7,data.indexOf("plzy"));
						plzy = data.substring(data.indexOf("plzy")+4,data.indexOf("ort3"));										
						ort3 = data.substring(data.indexOf("ort3")+4,data.indexOf("zeity"));	
						zeity = data.substring(data.indexOf("zeity")+5,data.indexOf("idy"));						
						if(data.indexOf("anbieter4") > 0) {

							idy = data.substring(data.indexOf("idy")+3,data.indexOf("anbieter4"));
							hasNext = true;
						}
						else {
							idy = data.substring(data.indexOf("idy")+3,data.length-2);
							hasNext = false;	
						}
					}
					
					if(hasNext){
    					anbieter4 = data.substring(data.indexOf("anbieter4")+9,data.indexOf("preisz"));
						preisz = data.substring(data.indexOf("preisz")+6,data.indexOf("lonz"));
						lonz = data.substring(data.indexOf("lonz")+4,data.indexOf("latz"));
						latz = data.substring(data.indexOf("latz")+4,data.indexOf("strassez"));						
						strassez = data.substring(data.indexOf("strassez")+8,data.indexOf("hausnrz"));
						hausnrz = data.substring(data.indexOf("hausnrz")+7,data.indexOf("plzz"));
						plzz = data.substring(data.indexOf("plzz")+4,data.indexOf("ort4"));	
						ort4 = data.substring(data.indexOf("ort4")+4,data.indexOf("zeitz"));	
						zeitz = data.substring(data.indexOf("zeitz")+5,data.indexOf("idz"));									
						idz = data.substring(data.indexOf("idz")+3,data.length-2);							
					}
		  			
		  			var results = document.getElementById('results');
		  			var tableText = "<table summary='results' >";
		  			if(anbieter0 != null) {
		  				tableText += "<tr><td id='td0' class='whiteBorder'><span class='tooltip tooltipUnten' style='font-size:100%' data-tooltip-text='Details anzeigen'><a href='javascript:selectResult(0)'><img src='img/tankstelle.jpg' /></a></span></td>";
		  				tableText += "<td>"+anbieter0+"</td>";
		  				tableText += "<td class='preis'>"+preisv.substr(0,preisv.length-1)+"<sup><small>"+preisv.substr(preisv.length-2,1)+"</small></sup> €/L</td>";
		  				tableText += "<td>"+strassev+" "+hausnrv+"<br>"+ plzv +" " + ort0 + "</td>";
		  				if(localStorage.getItem(idv) == idv)	
		  				{
		  					tableText += "<td id='fav0' class='isFav' onclick='changeFavorit(idv, 0)'><span class='tooltip tooltipUnten' style='font-size:100%' data-tooltip-text='Als Favorit (ab)wählen'><a class='transparent'>Favorit<br>Favorit<br>Favorit<br></a></span></td>";
		  				}
		  				else
		  				{
		  					tableText += "<td id='fav0' class='noFav' onclick='changeFavorit(idv, 0)'><span class='tooltip tooltipUnten' style='font-size:100%' data-tooltip-text='Als Favorit (ab)wählen'><a class='transparent'>Favorit<br>Favorit<br>Favorit<br></a></span></td>";
		  				}
		  				tableText += "</tr>";
		  			}
		  			if(anbieter1 != null) {
		  				tableText += "<tr><td id='td1' class='whiteBorder'><span class='tooltip tooltipUnten' style='font-size:100%' data-tooltip-text='Details anzeigen'><a href='javascript:selectResult(1)'><img src='img/tankstelle.jpg' /></a></span></td>";
		  				tableText += "<td>"+anbieter1+"</td>";
		  				tableText += "<td class='preis'>"+preisw.substr(0,preisw.length-1)+"<sup><small>"+preisw.substr(preisw.length-2,1)+"</small></sup> €/L</td>";
		  				tableText += "<td>"+strassew+" "+hausnrw+"<br>"+ plzw +" " + ort1 + "</td>";
		  				if(localStorage.getItem(idw) == idw)	
		  				{
		  					tableText += "<td id='fav1' class='isFav' onclick='changeFavorit(idw, 1)'><span class='tooltip tooltipUnten' style='font-size:100%' data-tooltip-text='Als Favorit (ab)wählen'><a class='transparent'>Favorit<br>Favorit<br>Favorit<br></a></span></td>";
		  				}
		  				else
		  				{
		  					tableText += "<td id='fav1' class='noFav' onclick='changeFavorit(idw, 1)'><span class='tooltip tooltipUnten' style='font-size:100%' data-tooltip-text='Als Favorit (ab)wählen'><a class='transparent'>Favorit<br>Favorit<br>Favorit<br></a></span></td>";
		  				}
		  				tableText += "</tr>";
		  			}
		  			if(anbieter2 != null) {
		  				tableText += "<tr><td id='td2' class='whiteBorder'><span class='tooltip tooltipUnten' style='font-size:100%' data-tooltip-text='Details anzeigen'><a href='javascript:selectResult(2)'><img src='img/tankstelle.jpg' /></a></span></td>";
		  				tableText += "<td>"+anbieter2+"</td>";
		  				tableText += "<td class='preis'>"+preisx.substr(0,preisx.length-1)+"<sup><small>"+preisx.substr(preisx.length-2,1)+"</small></sup> €/L</td>";
		  				tableText += "<td>"+strassex+" "+hausnrx+"<br>"+ plzx +" " + ort2 + "</td>";
		  				if(localStorage.getItem(idx) == idx)	
		  				{
		  					tableText += "<td id='fav2' class='isFav' onclick='changeFavorit(idx, 2)'><span class='tooltip tooltipUnten' style='font-size:100%' data-tooltip-text='Als Favorit (ab)wählen'><a class='transparent'>Favorit<br>Favorit<br>Favorit<br></a></span></td>";
		  				}
		  				else
		  				{
		  					tableText += "<td id='fav2' class='noFav' onclick='changeFavorit(idx, 2)'><span class='tooltip tooltipUnten' style='font-size:100%' data-tooltip-text='Als Favorit (ab)wählen'><a class='transparent'>Favorit<br>Favorit<br>Favorit<br></a></span></td>";
		  				}
		  				tableText += "</tr>";
		  			}
		  			if(anbieter3 != null) {
		  				tableText += "<tr><td id='td3' class='whiteBorder'><span class='tooltip tooltipUnten' style='font-size:100%' data-tooltip-text='Details anzeigen'><a href='javascript:selectResult(3)'><img src='img/tankstelle.jpg' /></a></span></td>";
		  				tableText += "<td>"+anbieter3+"</td>";
		  				tableText += "<td class='preis'>"+preisy.substr(0,preisy.length-1)+"<sup><small>"+preisy.substr(preisy.length-2,1)+"</small></sup> €/L</td>";
		  				tableText += "<td>"+strassey+" "+hausnry+"<br>"+ plzy +" " + ort3 + "</td>";
		  				if(localStorage.getItem(idy) == idy)	
		  				{
		  					tableText += "<td id='fav3' class='isFav' onclick='changeFavorit(idy, 3)'><span class='tooltip tooltipUnten' style='font-size:100%' data-tooltip-text='Als Favorit (ab)wählen'><a class='transparent'>Favorit<br>Favorit<br>Favorit<br></a></span></td>";
		  				}
		  				else
		  				{
		  					tableText += "<td id='fav3' class='noFav' onclick='changeFavorit(idy, 3)'><span class='tooltip tooltipUnten' style='font-size:100%' data-tooltip-text='Als Favorit (ab)wählen'><a class='transparent'>Favorit<br>Favorit<br>Favorit<br></a></span></td>";
		  				}
		  				tableText += "</tr>";
		  			}
		  			if(anbieter4 != null) {
		  				tableText += "<tr><td id='td4' class='whiteBorder'><span class='tooltip tooltipUnten' style='font-size:100%' data-tooltip-text='Details anzeigen'><a href='javascript:selectResult(4)'><img src='img/tankstelle.jpg' /></a></span></td>";
		  				tableText += "<td>"+anbieter4+"</td>";
		  				tableText += "<td class='preis'>"+preisz.substr(0,preisz.length-1)+"<sup><small>"+preisz.substr(preisz.length-2,1)+"</small></sup> €/L</td>";
		  				tableText += "<td>"+strassez+" "+hausnrz+"<br>"+ plzz +" " + ort4 + "</td>";
		  				if(localStorage.getItem(idz) == idz)	
		  				{
		  					tableText += "<td id='fav4' class='isFav' onclick='changeFavorit(idz, 4)'><span class='tooltip tooltipUnten' style='font-size:100%' data-tooltip-text='Als Favorit (ab)wählen'><a class='transparent'>Favorit<br>Favorit<br>Favorit<br></a></span></td>";
		  				}
		  				else
		  				{
		  					tableText += "<td id='fav4' class='noFav' onclick='changeFavorit(idz, 4)'><span class='tooltip tooltipUnten' style='font-size:100%' data-tooltip-text='Als Favorit (ab)wählen'><a class='transparent'>Favorit<br>Favorit<br>Favorit<br></a></span></td>";
		  				}
		  				tableText += "</tr>";
		  			}
		  			if(data == null || data.indexOf("keine Ergebnisse") >= 0) {
		  				tableText += "<td>Keine Ergebnisse</td>"
		  			}
		  				
					tableText += "</table>";
		  			results.innerHTML = tableText;
		  			var route = document.getElementById('route');
		  			route.innerHTML = "<a target='_blank' href='http://maps.google.de/maps?saddr="+localStorage.getItem('latAct')+","+localStorage.getItem('lonAct')+"(Startpunkt)&daddr="+latv+","+lonv+"("+anbieter0.replace(/\s/g, "")+")&t=h&om=0'><img src='img/routenplaner.jpg' width='75%' alt='' ></a>";
	  			
    			});
}

function selectResult(id) {
	if(document.getElementById('td0')) document.getElementById('td0').className = "whiteBorder";
	if(document.getElementById('td1')) document.getElementById('td1').className = "whiteBorder";
	if(document.getElementById('td2')) document.getElementById('td2').className = "whiteBorder";
	if(document.getElementById('td3')) document.getElementById('td3').className = "whiteBorder";
	if(document.getElementById('td4')) document.getElementById('td4').className = "whiteBorder";
	switch (id) {
		case 0:
			document.getElementById('tankstelle').innerHTML = "<a target='_blank' href='http://maps.google.de/maps?saddr="+localStorage.getItem('latAct')+","+localStorage.getItem('lonAct')+"(Startpunkt)&daddr="+latv+","+lonv+"("+anbieter0.replace(/\s/g, "")+")&t=h&om=0' id='tankstelleText' class='button' style='font-size:55%'>"+anbieter0+"</a>";
			document.getElementById('preisOutput').value = " " + preisv + " €/L "; 
			document.getElementById('td0').className = "redBorder";  
			document.getElementById('route').innerHTML = "<a target='_blank' href='http://maps.google.de/maps?saddr="+localStorage.getItem('latAct')+","+localStorage.getItem('lonAct')+"(Startpunkt)&daddr="+latv+","+lonv+"("+anbieter0.replace(/\s/g, "")+")&t=h&om=0'><img src='img/routenplaner.jpg' width='75%' alt='' ></a>";
		  	document.getElementById('oeffnungszeiten').innerHTML = "<span class='tooltip tooltipUnten' data-tooltip-text='geöffnet von " +offenAbv+" bis "+offenBisv+"'> <img style='border:2px solid white' src='img/" + (offenv == "1" ? "open.jpg" : "closed.jpg") + "' ></span>";
    		break;
  		case 1:
			document.getElementById('tankstelle').innerHTML = "<a target='_blank' href='http://maps.google.de/maps?saddr="+localStorage.getItem('latAct')+","+localStorage.getItem('lonAct')+"(Startpunkt)&daddr="+latw+","+lonw+"("+anbieter1.replace(/\s/g, "")+")&t=h&om=0' id='tankstelleText' class='button' style='font-size:55%'>"+anbieter1+"</a>";;
			document.getElementById('preisOutput').value = " " + preisw + " €/L ";  
			document.getElementById('td1').className = "redBorder"; 
			document.getElementById('route').innerHTML = "<a target='_blank' href='http://maps.google.de/maps?saddr="+localStorage.getItem('latAct')+","+localStorage.getItem('lonAct')+"(Startpunkt)&daddr="+latw+","+lonw+"("+anbieter1.replace(/\s/g, "")+")&t=h&om=0'><img src='img/routenplaner.jpg' width='75%' alt='' ></a>";
  		  	
		  	document.getElementById('oeffnungszeiten').innerHTML = "<span class='tooltip tooltipUnten' data-tooltip-text='geöffnet von " +offenAbw+" bis "+offenBisw+"'> <img style='border:2px solid white' src='img/" + (offenw == "1" ? "open.jpg" : "closed.jpg") + "' ></span>";
    		break;
  		case 2:
			document.getElementById('tankstelle').innerHTML = "<a target='_blank' href='http://maps.google.de/maps?saddr="+localStorage.getItem('latAct')+","+localStorage.getItem('lonAct')+"(Startpunkt)&daddr="+latx+","+lonx+"("+anbieter2.replace(/\s/g, "")+")&t=h&om=0' id='tankstelleText' class='button' style='font-size:55%'>"+anbieter2+"</a>";
			document.getElementById('preisOutput').value = " " + preisx + " €/L ";
			document.getElementById('td2').className = "redBorder"; 
			document.getElementById('route').innerHTML = "<a target='_blank' href='http://maps.google.de/maps?saddr="+localStorage.getItem('latAct')+","+localStorage.getItem('lonAct')+"(Startpunkt)&daddr="+latx+","+lonx+"("+anbieter2.replace(/\s/g, "")+")&t=h&om=0'><img src='img/routenplaner.jpg' width='75%' alt='' ></a>";
		  	document.getElementById('oeffnungszeiten').innerHTML = "<span class='tooltip tooltipUnten' data-tooltip-text='geöffnet von " +offenAbx+" bis "+offenBisx+"'> <img style='border:2px solid white' src='img/" + (offenx == "1" ? "open.jpg" : "closed.jpg") + "' ></span>";
    		break;
  		case 3:
			document.getElementById('tankstelle').innerHTML = "<a target='_blank' href='http://maps.google.de/maps?saddr="+localStorage.getItem('latAct')+","+localStorage.getItem('lonAct')+"(Startpunkt)&daddr="+laty+","+lony+"("+anbieter3.replace(/\s/g, "")+")&t=h&om=0' id='tankstelleText' class='button' style='font-size:55%'>"+anbieter3+"</a>";
			document.getElementById('preisOutput').value = " " + preisy + " €/L ";
			document.getElementById('td3').className = "redBorder";    
			document.getElementById('route').innerHTML = "<a target='_blank' href='http://maps.google.de/maps?saddr="+localStorage.getItem('latAct')+","+localStorage.getItem('lonAct')+"(Startpunkt)&daddr="+laty+","+lony+"("+anbieter3.replace(/\s/g, "")+")&t=h&om=0'><img src='img/routenplaner.jpg' width='75%' alt='' ></a>";
 			document.getElementById('oeffnungszeiten').innerHTML = "<span class='tooltip tooltipUnten' data-tooltip-text='geöffnet von " +offenAby+" bis "+offenBisy+"'> <img style='border:2px solid white' src='img/" + (offeny == "1" ? "open.jpg" : "closed.jpg") + "' ></span>";
    		break;
  		case 4:
			document.getElementById('tankstelle').innerHTML = "<a target='_blank' href='http://maps.google.de/maps?saddr="+localStorage.getItem('latAct')+","+localStorage.getItem('lonAct')+"(Startpunkt)&daddr="+latz+","+lonz+"("+anbieter4.replace(/\s/g, "")+")&t=h&om=0' id='tankstelleText' class='button' style='font-size:55%'>"+anbieter4+"</a>";;
			document.getElementById('preisOutput').value = " " + preisz + " €/L "; 
			document.getElementById('td4').className = "redBorder";  
			document.getElementById('route').innerHTML = "<a target='_blank' href='http://maps.google.de/maps?saddr="+localStorage.getItem('latAct')+","+localStorage.getItem('lonAct')+"(Startpunkt)&daddr="+latz+","+lonz+"("+anbieter4.replace(/\s/g, "")+")&t=h&om=0'><img src='img/routenplaner.jpg' width='75%' alt='' ></a>";
  			document.getElementById('oeffnungszeiten').innerHTML = "<span class='tooltip tooltipUnten' data-tooltip-text='geöffnet von " +offenAbz+" bis "+offenBisz+"'> <img style='border:2px solid white' src='img/" + (offenz == "1" ? "open.jpg" : "closed.jpg") + "' ></span>";
    		break;
  		default:
			document.getElementById('tankstelle').innerHTML = "<a target='_blank' href='http://maps.google.de/maps?saddr="+localStorage.getItem('latAct')+","+localStorage.getItem('lonAct')+"(Startpunkt)&daddr="+latv+","+lonv+"("+anbieter0.replace(/\s/g, "")+")&t=h&om=0' id='tankstelleText' class='button' style='font-size:55%'>"+anbieter0+"</a>";
			document.getElementById('preisOutput').value = " " + preisv + " €/L ";   
			document.getElementById('td0').className = "redBorder";  	
    		break;
	}		
}

var options = {
  enableHighAccuracy: true,
  timeout: 50000,
  maximumAge: 0
};

function success(pos) {
				crd = pos.coords;
				localStorage.removeItem('lat');
				localStorage.removeItem('lon'); 
				localStorage.setItem('lat', crd.latitude);
				localStorage.setItem('lon', crd.longitude);
				localStorage.removeItem('latAct');
				localStorage.removeItem('lonAct'); 
				localStorage.setItem('latAct', crd.latitude);
				localStorage.setItem('lonAct', crd.longitude);
				$.post("getLocationByCoord.php",
    			{
        			longitude: crd.longitude,
        			latitude: crd.latitude
    			},
    			function (data) {
		  			var ortText = data.substring(data.indexOf("xyz")+3,data.indexOf("zyx"));		  			
		  			var entfernung = data.substring(data.indexOf("zyx")+3,data.length-2);
		  			var ort = document.getElementById('stadt');
		  			ort.value = ortText;	 
					lastTown = ortText;						  				  			
    			});
    			getDataByCoords(crd.latitude, crd.longitude);
};

function error(err) {
	alert(err);
};

function getLocationByCoord(){
  	navigator.geolocation.getCurrentPosition(success, error, options)
}

function getCoordsByTown(){

				$.post("getCoordsByTown.php",
    			{
        			town: document.getElementById('stadt').value
    			},
    			function (data) {
		  			var latitude = data.substring(data.indexOf("lat")+3,data.indexOf("lon"));		  			
		  			var longitude = data.substring(data.indexOf("lon")+3,data.length-2); 
					localStorage.removeItem('lat');
					localStorage.removeItem('lon'); 
					localStorage.setItem('lat', latitude);
					localStorage.setItem('lon', longitude);	
					localStorage.removeItem('latAct');
					localStorage.removeItem('lonAct'); 
					localStorage.setItem('latAct', latitude);
					localStorage.setItem('lonAct', longitude);
					lastTown = document.getElementById('stadt').value;	
					getDataByCoords(latitude, longitude);
    			});			
}

function changeFavorit(id, number) {
	var star;
	switch (number) { /* Sternfarbe aendern */ 
		case 0:
			star = document.getElementById('fav0');
			if(star.className == "noFav")
			{
				star.className = "isFav";
			}
			else
			{
				star.className = "noFav";
			}			 
    		break;
  		case 1: 
			star = document.getElementById('fav1');
			if(star.className == "noFav")
			{
				star.className = "isFav";
			}
			else
			{
				star.className = "noFav";
			}	   
    		break;
  		case 2:
			star = document.getElementById('fav2');
			if(star.className == "noFav")
			{
				star.className = "isFav";
			}
			else
			{
				star.className = "noFav";
			}	 
    		break;
  		case 3:
			star = document.getElementById('fav3');
			if(star.className == "noFav")
			{
				star.className = "isFav";
			}
			else
			{
				star.className = "noFav";
			}	     
    		break;
  		case 4:
			star = document.getElementById('fav4');
			if(star.className == "noFav")
			{
				star.className = "isFav";
			}
			else
			{
				star.className = "noFav";
			}	    
    		break;
  		default:  
			star = document.getElementById('fav0');
			if(star.className == "noFav")
			{
				star.className = "isFav";
			}
			else
			{
				star.className = "noFav";
			}	  	
    		break;
	}			
	
	/* ID speichern */
	if(localStorage.getItem(id) != id) {
		localStorage.setItem(id, id);
	}
	else 
	{
		localStorage.removeItem(id);	
	}
			
}



    $(document).ready(function(){
	      $("#stadt").autocomplete({
               source: 'getautocomplete.php',
               minLength:4
         });
         
         $("#stadt").keypress(function(event){ 
		 		var keycode = (event.keyCode ? event.keyCode : event.which);
				if(keycode == '13'){
						getCoordsByTown();										
				}
		});
    });




