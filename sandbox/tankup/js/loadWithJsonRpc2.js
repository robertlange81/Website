var soapHostServer = 'http://www.sparesprit.de/soapserver.php';
var jsonRpcServer = 'www.sparesprit.de';
var jsonRpcPath = 'jsonrpcserver.php';

var crd;
if(!navigator.onLine) alert("Kein Empfang - Preise sind veraltet!");

function loadPage() {

    	if(document.getElementById('progress')) {
    		document.getElementById('progress').style.display="inline";
    	}    	
} 

function pageLoaded() {

    	if(document.getElementById('progress')) {
    		//document.getElementById('favoriten').innerHTML = "<form><select><option value='123'>123</option></select></form>";		
    		document.getElementById('progress').style.display="none";
    	} 
} 

var t_start, t_end;
var lock;
function getCoordsByTown() {	
	if(lock == 1) return;
	lock = 1;
	t_start = new Date().getTime();
	
	try {  
		var town = umlauteErsetzen(document.getElementById('stadt').value);
		var client = new jsonrpc_client(jsonRpcPath,jsonRpcServer,80); 
		var message = new jsonrpcmsg('getCoordByTown',	[new jsonrpcval(town, 'string')], 1);                   
		var result = client.send(message, 1000, function(msgResp){
		var struct = msgResp.value();
		//console.log(msgResp.serialize());
		var latitude = struct.structMem('latitude').scalarVal();
		var longitude = struct.structMem('longitude').scalarVal();
		console.log('Breite1: ' + latitude);
		console.log('Länge1: ' + longitude);
		localStorage.removeItem('lat');
		localStorage.removeItem('lon'); 
		localStorage.setItem('lat', latitude);
		localStorage.setItem('lon', longitude);	
		lastTown = document.getElementById('stadt').value;	
		t_end = new Date().getTime();
		getDataByCoords(localStorage.getItem('lat'), localStorage.getItem('lon'));						
		});
	}
	catch(e)
	{
		console.log("Fehler getCoordsByTown" + e);	
	}
	lock = 0;
}

var lock2
function getTownByCoords(latitude, longitude) {
	if(lock2 == 1) return;
	lock2 = 1;
	
	try {  
		var client = new jsonrpc_client(jsonRpcPath,jsonRpcServer,80); 
		var message = new jsonrpcmsg('getTownByCoords',	[new jsonrpcval(latitude, 'double'),new jsonrpcval(longitude, 'double')], 2);                     
		var result = client.send(message, 1000, function(msgResp){
			var struct = msgResp.value();
			//console.log(msgResp.serialize());
			var town = struct.structMem('town').scalarVal();
			lastTown = document.getElementById('stadt').value;	
			document.getElementById('stadt').value = umlauteEinfuegen(town);					
		});
	}
	catch(e)
	{
		console.log("Fehler getTownByCoord " + e);	
		document.getElementById('stadt').value = '';
	}
	lock2 = 0;
}

var anbieter = [];
var offen = [];
var offenAb = [];
var offenBis = [];
var lon = [];
var lat = [];
var preis = [];
var strasse = [];
var hausnr = [];
var plz = [];
var ort= [];
var zeit = [];
var dis = [];
var id = [];


var lastTown = "";

function getDataByStoredCoords(){
	getDataByCoords(localStorage.getItem('lat'), localStorage.getItem('lon'));
}

function cleanData() {
	anbieter = [];
	offen = [];
	offenAb = [];
	offenBis = [];
	lon = [];
	lat = [];
	preis = [];
	strasse = [];
	hausnr = [];
	plz = [];
	ort= [];
	zeit = [];
	dis = [];
	id = [];
}

var lock3;
function getDataByCoords(latitude, longitude){	
	if(lock3 == 1) return;
	lock3 = 1;
	try {  	
		cleanData();
		var umkreis = document.getElementById('umkreis').value;
		var art = document.getElementById('art').value;
		var sortieren = document.getElementById('sortieren').value;
		var route = document.getElementById('route');
		var results = document.getElementById('results');
		route.innerHTML = "";
		results.innerHTML = "<table summary='results' ><td>Keine Ergebnisse</td></table>";					
																		
		t_start = new Date().getTime();
		var client = new jsonrpc_client(jsonRpcPath,jsonRpcServer,80); 
		var message = new jsonrpcmsg('getDataByCoord',
					[new jsonrpcval(latitude, 'double'),new jsonrpcval(longitude, 'double'),new jsonrpcval(art, 'string'),new jsonrpcval(umkreis, 'string'), new jsonrpcval(sortieren, 'string')]
					,3
		);
		
		client.request_charset_encoding="UTF-8";                     
		var msgResp = client.send(message, 1000);
			
			var struct = msgResp.value();
			if(struct != null)
			{
				var count = 0;
				var station;				

				while(struct.structMem(count) != null)
				{
					station = struct.structMem(count);
					anbieter.push(station.structMem('owner').scalarVal());
					offen.push(station.structMem('isOpen').scalarVal());
					offenAb.push(station.structMem('openFrom').scalarVal());
					offenBis.push(station.structMem('openTo').scalarVal());
					lon.push(station.structMem('longitude').scalarVal());
					lat.push(station.structMem('latitude').scalarVal());
					preis.push(station.structMem('price').scalarVal());
					strasse.push(station.structMem('street').scalarVal());
					hausnr.push(station.structMem('housenumber').scalarVal());
					plz.push(station.structMem('postal').scalarVal());
					ort.push(station.structMem('place').scalarVal());
					zeit.push(station.structMem('reporttime').scalarVal());
					dis.push(station.structMem('distance').scalarVal());
					id.push(station.structMem('id').scalarVal());	
					count=count+1;
				}
									t_end = new Date().getTime();
				fillView();
			}				
	}
	catch(e)
	{
		console.log("Fehler getDataByCoord " + e);	
		document.getElementById('stadt').value = '';
	}
	lock3 = 0;								
}

var lock4;
function getFavsByCoords(){	
	if(lock4 == 1) return;
	lock4 = 1;
	try {  	
		cleanData();
		var latitude = localStorage.getItem('lat');
		var longitude =  localStorage.getItem('lon');
		var umkreis = document.getElementById('umkreis').value;
		var art = document.getElementById('art').value;
		var sortieren = document.getElementById('sortieren').value;
		var route = document.getElementById('route');
		var results = document.getElementById('results');
		route.innerHTML = "";
		results.innerHTML = "<table summary='results' ><td>Keine Ergebnisse</td></table>";					
																		
		t_start = new Date().getTime();
		var client = new jsonrpc_client(jsonRpcPath,jsonRpcServer,80); 
		var message = new jsonrpcmsg('getFavsByCoord',
					[new jsonrpcval(latitude, 'double'),new jsonrpcval(longitude, 'double'),new jsonrpcval(art, 'string'),new jsonrpcval(umkreis, 'string'), new jsonrpcval(sortieren, 'string'), new jsonrpcval(localStorage.getItem("favList"), 'string')]
					,3
		);
		
		client.request_charset_encoding="UTF-8";                     
		var msgResp = client.send(message, 1000);
			
			var struct = msgResp.value();
			if(struct != null)
			{
				var count = 0;
				var station;				

				while(struct.structMem(count) != null)
				{
					station = struct.structMem(count);
					anbieter.push(station.structMem('owner').scalarVal());
					offen.push(station.structMem('isOpen').scalarVal());
					offenAb.push(station.structMem('openFrom').scalarVal());
					offenBis.push(station.structMem('openTo').scalarVal());
					lon.push(station.structMem('longitude').scalarVal());
					lat.push(station.structMem('latitude').scalarVal());
					preis.push(station.structMem('price').scalarVal());
					strasse.push(station.structMem('street').scalarVal());
					hausnr.push(station.structMem('housenumber').scalarVal());
					plz.push(station.structMem('postal').scalarVal());
					ort.push(station.structMem('place').scalarVal());
					zeit.push(station.structMem('reporttime').scalarVal());
					dis.push(station.structMem('distance').scalarVal());
					id.push(station.structMem('id').scalarVal());	
					count=count+1;
				}
				fillView();
			}				
	}
	catch(e)
	{
		console.log("Fehler getDataByCoord " + e);	
		document.getElementById('stadt').value = '';
	}
	lock4 = 0;								
}

				
function fillView() {
 			if(anbieter.length > 0) {
				var count = 0;
				var results = document.getElementById('results');
  				var tableText = "<table summary='results' >";
				anbieter.forEach(function(entry) {						
					// alle Tankstellen zeilenweise darstellen
					tableText += "<tr><td id='td"+count+"' class='whiteBorder'><span class='tooltip tooltipUnten' style='font-size:100%' data-tooltip-text='Details anzeigen'>";
					tableText += "<a href='javascript:selectResult("+count+")'><img src='img/tankstelle.jpg' /></a></span></td>";
					tableText += "<td id='td"+count+"1'><span class='tooltip tooltipUnten' style='font-size:100%' data-tooltip-text='Details anzeigen'><a href='javascript:selectResult("+count+")'>";
					tableText += anbieter[count]+ "<br><span class='red'>";
					tableText += Math.round(dis[count]*100)/100;
					tableText += " km</span></span></td>";
					tableText += "<td id='td"+count+"2' class='preis'><span class='tooltip tooltipUnten' style='font-size:100%' data-tooltip-text='Details anzeigen'>";
					tableText += "<a href='javascript:selectResult("+count+")'>"+preis[count].substr(0,preis[count].length-1)+"<sup><small>";
					tableText += preis[count].substr(preis[count].length-1,1)+"</small></sup> €/L</span></td>";
					tableText += "<td id='td"+count+"3'><span class='tooltip tooltipUnten' style='font-size:100%' data-tooltip-text='Details anzeigen'><a href='javascript:selectResult("+count+")'>";
					tableText += strasse[count]+" "+hausnr[count]+"<br>"+ plz[count] +" " + ort[count] + "</span></td>";
					
					if(localStorage.getItem(id[count]) != null)	
					{		  	
						tableText += "<td id='fav"+count+"' class='isFav' onclick='changeFavorit("+count+", "+id[count]+",&quot;" + anbieter[count] + " " + ort[count] + "&quot;)'>";				
						tableText += "<span class='tooltip tooltipUnten' style='font-size:100%' data-tooltip-text='Als Favorit (ab)wählen'>";	
					}
					else
					{
						tableText += "<td id='fav"+count+"' class='noFav' onclick='changeFavorit("+count+", "+id[count]+",&quot;" + anbieter[count] + " " + ort[count] + "&quot;)'>";
						tableText += "<span class='tooltip tooltipUnten' style='font-size:100%' data-tooltip-text='Als Favorit (ab)wählen'>";							
					}
					tableText += "<a class='transparent' style='color:transparent;'>Favorit<br>Favorit<br>Favorit<br></a></span></td>";
					tableText += "</tr>";
					tableText += "<tr><td valign='top' id='detail"+count+"' colspan='5' class='detail'><td><tr>";	
					
					count += 1;	
				});	
					tableText += "</table>";	
					results.innerHTML = tableText;				  				 				
					selectResult(0);	
			}
			else
			{
				tableText += "<td>Keine Ergebnisse</td>"
				route.innerHTML = "";
				results.innerHTML = tableText;	
				selectResult(-1);
			}										
}



var lastId = 0;
function selectResult(id) {
	var i = 0;
	anbieter.forEach(function(entry) {	
		document.getElementById('td'+i).className = "whiteBorder";
		document.getElementById('td'+i+'1').style.backgroundColor = "transparent";
		document.getElementById('td'+i+'2').style.backgroundColor = "transparent"; 
		document.getElementById('td'+i+'3').style.backgroundColor = "transparent";
		$('#detail'+i).fadeOut(200);
		i+=1;
	});	

	if(window.innerWidth < 900)
  	{
			if(id > -1)
			{
  		document.getElementById('detail'+id).innerHTML = " <img style='border:2px solid white' src='img/" + (offen[id] == "1" ? "open.jpg" : "closed.jpg") + "' ><div class='textInTable' style='display:inline-block;margin-left: 20px;margin-right: 75px;'>heute geöffnet <br>von " +offenAb[id]+" Uhr<br> bis "+offenBis[id]+" Uhr</div>"
					+ "<div style='float:right;position:relative; right:55px;'><a target='_blank' href='http://maps.google.de/maps?saddr="+localStorage.getItem('latAct')+","+localStorage.getItem('lonAct')+"(Startpunkt)&daddr="+lat[id]+","+lon[id]+"("+anbieter[id].replace(/\s/g, "")+")&t=h&om=0'><img src='img/zurTankstelle.png' /></a></div>";				
				$('#detail'+lastId).fadeOut(200, function(){$('#detail'+id).fadeIn(200);});	  
			}
	}   
	else
  	{
		if(id > -1)
		{		
		document.getElementById('tankstelle').innerHTML = "<a target='_blank' href='http://maps.google.de/maps?saddr="+localStorage.getItem('latAct')+","+localStorage.getItem('lonAct')+"(Startpunkt)&daddr="+lat[id]+","+lon[id]+"("+anbieter[id].replace(/\s/g, "")+")&t=h&om=0' id='tankstelleText' class='button' style='font-size:55%'>"+anbieter[id]+"</a>";
		document.getElementById('preisOutput').value = " "+ preis[id] + " €/L "; 
		document.getElementById('td'+id).className = "redBorder";  
		document.getElementById('td'+id+'1').style.backgroundColor = "red"; 
		document.getElementById('td'+id+'2').style.backgroundColor = "red"; 
		document.getElementById('td'+id+'3').style.backgroundColor = "red";
		
		document.getElementById('route').innerHTML = "<a target='_blank' href='http://maps.google.de/maps?saddr="+localStorage.getItem('latAct')+","+localStorage.getItem('lonAct')+"(Startpunkt)&daddr="+lat[id]+","+lon[id]+"("+anbieter[id].replace(/\s/g, "")+")&t=h&om=0'><img src='img/zurTankstelle.png' width='75%' alt='' ></a>";
		document.getElementById('oeffnungszeiten').innerHTML = "<span class='tooltip tooltipUnten' data-tooltip-text='geöffnet von " +offenAb[id]+" bis "+offenBis[id]+" Uhr'> <img style='border:2px solid white' src='img/" + (offen[id] == "1" ? "open.jpg" : "closed.jpg") + "' ></span>";	
		}
		else
		{
			document.getElementById('tankstelle').innerHTML = "";
			document.getElementById('preisOutput').value = " €/L "; 
			document.getElementById('oeffnungszeiten').innerHTML = "";
		}
	} 		
    		
	lastId = id;
}

function changeFavorit(viewId, primaryId, naming) {
	
	var star;
	/* Sternfarbe aendern */
	star = document.getElementById('fav'+viewId);
	if(star.className == "noFav")
	{
		star.className = "isFav";
	}
	else
	{
		star.className = "noFav";
	}			 	
	
	/* ID speichern */
	if(localStorage.getItem(primaryId) == null) {
		localStorage.setItem(primaryId, primaryId);
		var favs = localStorage.getItem("favList");
		localStorage.setItem("favList", favs + " " + primaryId + ";");
	}
	else 
	{
		localStorage.removeItem(primaryId);	
		var str = localStorage.getItem("favList");
		var replacer = new RegExp("" + primaryId + ";","g");
		str = str.replace(replacer, "");
		str = str.replace(/[^0-9.;]/g, "");
		localStorage.setItem("favList", str);
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
				
				// Aufruf um Stadt zu ermitteln
				getTownByCoords(crd.latitude, crd.longitude);
    			
				// Aufruf um Tankstellen zu ermitteln
				getDataByCoords(crd.latitude, crd.longitude);
				
};

function error(err) {
	console.log("Fehler beim Ermitteln der Position: " + err);
};

function startLocating(){
	console.log("Los geht's!");
  	navigator.geolocation.getCurrentPosition(success, error, options)
}

// mit json
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

function umlauteEinfuegen(text){
	return text.replace("&#xE4;","ä").replace("&#xF6;","ö").replace("&#xFC;","ü").replace("&#xDF;","ß").replace("&#xC4;","Ä").replace("&#xD6;","Ö").replace("&#xDC;","Ü");	
}

function umlauteErsetzen(text){
	return text.replace("ä", "#ae#").replace("ö", "#oe#").replace("ü", "#ue#").replace("ß", "#sz#").replace("Ä", "#AE#").replace("Ö", "#OE#").replace("Ü", "#UE#;");
}



