var soapHostServer = 'http://www.sparesprit.de/soapserver.php';

function getTownByCoords(latitude, longitude) {
			
			var xmlhttp;
			if (window.XMLHttpRequest) {
				xmlhttp= new window.XMLHttpRequest;
			}
			else {
				try {
					xmlhttp= new ActiveXObject("MSXML2.XMLHTTP.3.0");
				}
				catch(ex) {
					 alert('Error Building Soap Request ActiveXObject');
				}
			}
			
         xmlhttp.open('POST', soapHostServer);
			xmlhttp.setRequestHeader( 'Content-Type','text/xml; charset=utf-8');
			xmlhttp.setRequestHeader ("Host", "www.sparesprit.de");
			xmlhttp.setRequestHeader("SOAPAction", "http://tempuri.org/GetTownByCoords");
			xmlhttp.setRequestHeader("Access-Control-Allow-Origin", "*");
            // build SOAP request
            var sr =
                "<?xml version='1.0' encoding='utf-8'?>" +
                "<soap:Envelope xmlns:soap='http://schemas.xmlsoap.org/soap/envelope/' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xmlns:xsd='http://www.w3.org/2001/XMLSchema'>" +
					"<soap:Body>" + 
						"<GetTownByCoordsRequest xmlns='http://tempuri.org/'>"+
							"<location><latitude>"+ latitude + "</latitude><longitude>"+ longitude+ "</longitude></location>"+
						"</GetTownByCoordsRequest>" + 
					"</soap:Body>" +
				"</soap:Envelope>";

			xmlhttp.onerror = function(e) {
				alert("Error occurred. Error = " + e.message);
			}
			xmlhttp.ontimeout = function(e) {
				alert("Timeout error!");
			}
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4) {
                    if (xmlhttp.status == 200) {
						try {
							var xml = $.parseXML(xmlhttp.responseText),
							  $xml = $( xml ),
							  $town = $xml.find('town');
							
							console.log($town.text());
														
							var town = $town.text();	
							if(town != null) {
								document.getElementById('stadt').value = town;
							}
							else{
								document.getElementById('stadt').value = '';
							}
						}
                        catch(e)
						{
							document.getElementById('stadt').value = '';	
						}
                    }
                }
            }

            xmlhttp.send(sr);
        }

	var t_start, t_end;		
var lock;
function getCoordsByTown() {

	t_start = new Date().getTime();

			if(lock == 1) return;
			lock = 1;
			console.log("Aufruf getCoordsByTown");
			var xmlhttp;
			var town = document.getElementById('stadt').value;
			if (window.XMLHttpRequest) {
				xmlhttp= new window.XMLHttpRequest;
			}
			else {
				try {
					xmlhttp= new ActiveXObject("MSXML2.XMLHTTP.3.0");
				}
				catch(ex) {
					 alert('Error Building Soap Request ActiveXObject');
				}
			}
			
         xmlhttp.open('POST', soapHostServer);
			xmlhttp.setRequestHeader( 'Content-Type','text/xml; charset=utf-8');
			xmlhttp.setRequestHeader ("Host", "www.sparesprit.de");
			xmlhttp.setRequestHeader("SOAPAction", "http://tempuri.org/GetCoordsByTown");
			xmlhttp.setRequestHeader("Access-Control-Allow-Origin", "*");
			xmlhttp.setRequestHeader("Accept-Encoding","gzip,deflate");
            // build SOAP request
            var sr =
                "<?xml version='1.0' encoding='utf-8'?><soap:Envelope xmlns:soap='http://schemas.xmlsoap.org/soap/envelope/' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xmlns:xsd='http://www.w3.org/2001/XMLSchema'><soap:Body><GetCoordsByTownRequest xmlns='http://tempuri.org/'><town>"+town+"</town></GetCoordsByTownRequest></soap:Body></soap:Envelope>";

			xmlhttp.onerror = function(e) {
				alert("Error occurred. Error = " + e.message);
			}
			xmlhttp.ontimeout = function(e) {
				alert("Timeout error!");
			}
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4) {
                    if (xmlhttp.status == 200) {
						try {
							var xml = $.parseXML(xmlhttp.responseText),$xml = $( xml ),$location = $xml.find('location');				
														
							var location = $location.text();
							if(location != null) {
								var latitude = $location.find('latitude').text();		  			
								var longitude = $location.find('longitude').text();
								localStorage.removeItem('lat');
								localStorage.removeItem('lon'); 
								localStorage.setItem('lat', latitude);
								localStorage.setItem('lon', longitude);	
								localStorage.removeItem('latAct');
								localStorage.removeItem('lonAct'); 
								localStorage.setItem('latAct', latitude);
								localStorage.setItem('lonAct', longitude);
								lastTown = document.getElementById('stadt').value;	
															t_end = new Date().getTime();
							alert(t_end - t_start);
							t_start = null;
								console.log("Ergebnis : " + localStorage.getItem('lat')+ " und " + localStorage.getItem('lon'));
								getDataByCoords(localStorage.getItem('lat'), localStorage.getItem('lon'));	
								lock = 0;							
							}
							else{

							}
						}
                        catch(e)
						{
	
						}
                    }
                }
            }

            xmlhttp.send(sr);
        }
		
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
	console.log("getDataByStoredCoords (" + localStorage.getItem('lat') + ", " + localStorage.getItem('lon'));
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

function getDataByCoords(latitude, longitude){	
	cleanData();
	t_start = new Date().getTime();
	var umkreis = document.getElementById('umkreis').value;
	var art = document.getElementById('art').value;
	var sortieren = document.getElementById('sortieren').value;
	var xmlhttp;
	if (window.XMLHttpRequest) {
		xmlhttp= new window.XMLHttpRequest;
	}
	else {
		try {
			xmlhttp= new ActiveXObject("MSXML2.XMLHTTP.3.0");
		}
		catch(ex) {
			 alert('Error Building Soap Request ActiveXObject');
		}
	}
			
         xmlhttp.open('POST', soapHostServer);
			xmlhttp.setRequestHeader( 'Content-Type','text/xml; charset=utf-8');
			xmlhttp.setRequestHeader ("Host", "www.sparesprit.de");
			xmlhttp.setRequestHeader("SOAPAction", "http://tempuri.org/GetDataByCoords");
			xmlhttp.setRequestHeader("Access-Control-Allow-Origin", "*");
			xmlhttp.setRequestHeader("Accept-Encoding","gzip,deflate");
            // build SOAP request
            var sr =
                "<?xml version='1.0' encoding='utf-8'?><soap:Envelope xmlns:soap='http://schemas.xmlsoap.org/soap/envelope/' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xmlns:xsd='http://www.w3.org/2001/XMLSchema'><soap:Body><GetDataByCoordsRequest xmlns='http://tempuri.org/'><article>"+art+"</article><distance>"+umkreis+"</distance><sortBy>"+sortieren+"</sortBy><location><latitude>"+latitude+"</latitude><longitude>"+longitude+"</longitude></location></GetDataByCoordsRequest></soap:Body></soap:Envelope>";

			xmlhttp.onerror = function(e) {
				alert("Error occurred. Error = " + e.message);
			}
			xmlhttp.ontimeout = function(e) {
				alert("Timeout error!");
			}
            xmlhttp.onreadystatechange = function () {
				
		  		var route = document.getElementById('route');
				var results = document.getElementById('results');
				route.innerHTML = "";
				results.innerHTML = "<table summary='results' ><td>Keine Ergebnisse</td></table>";	
                if (xmlhttp.readyState == 4) {
                    if (xmlhttp.status == 200) {	
							var xml = $.parseXML(xmlhttp.responseText),$xml = $( xml ),$xmlResp = $xml.find('GetDataByCoordsResponse');						
							$($xmlResp).find('petrolStation').each(function(){													
								anbieter.push($(this).find('owner').text());
								offen.push($(this).find('isOpen').text());
								offenAb.push($(this).find('openFrom').text());
								offenBis.push($(this).find('openTo').text());
								lon.push($(this).find('longitude').text());
								lat.push($(this).find('latitude').text());
								preis.push($(this).find('price').text());
								strasse.push($(this).find('street').text());
								hausnr.push($(this).find('housenumber').text());
								plz.push($(this).find('postal').text());
								ort.push($(this).find('place').text());
								zeit.push($(this).find('reporttime').text());
								dis.push($(this).find('distance').text());
								id.push($(this).find('id').text()); 
							});		
							t_end = new Date().getTime();
							alert(t_end - t_start);
							t_start = null;
							fillView();									
                    }
                }
            }

            xmlhttp.send(sr);	
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
					
					if(localStorage.getItem(id[count]) == id[count])	
					{		  	
						tableText += "<td id='fav"+count+"' class='isFav' onclick='changeFavorit("+count+", "+id[count]+")'>";				
						tableText += "<span class='tooltip tooltipUnten' style='font-size:100%' data-tooltip-text='Als Favorit (ab)wählen'>";	
					}
					else
					{
						tableText += "<td id='fav"+count+"' class='noFav' onclick='changeFavorit("+count+", "+id[count]+")'>";
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
  		document.getElementById('detail'+id).innerHTML = " <img style='border:2px solid white' src='img/" + (offen[id] ? "open.jpg" : "closed.jpg") + "' ><div class='textInTable' style='display:inline-block;margin-left: 20px;margin-right: 75px;'>heute geöffnet <br>von " +offenAb[id]+" Uhr<br> bis "+offenBis[id]+" Uhr</div>"
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

function changeFavorit(viewId, primaryId) {
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
	if(localStorage.getItem(primaryId) != primaryId) {
		localStorage.setItem(primaryId, primaryId);
	}
	else 
	{
		localStorage.removeItem(primaryId);	
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
  	navigator.geolocation.getCurrentPosition(success, error, options)
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




