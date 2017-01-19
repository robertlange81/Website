<!DOCTYPE html>
<html lang="de">
<head>
		<?php print("<meta name='author' content='Robert Lange' />"); ?>   
		<meta name="keywords" content="Robert Lange, Weblication, Web, App" />
		<meta name="description" content="Diese Anwendung ist ein Projekt im Rahmen der Lehrveranstaltung Web-Datenbanken an der HTWK Leipzig und dient keinem kommerziellen Zweck" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />		
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" /> 
		<link rel="apple-touch-icon-precomposed" href="tankstelle_60x60.png" /> 		
		<meta charset="utf-8" />     
      <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>      
      <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" />
 
		<title>Spare Sprit</title>
		      <?php
      
                   /**
                   * @Robert Lange
                   * @copyright 2013
                   */ 

                   $db_id = mysql_connect("localhost","web1162","bX2KARTc");
                   if(!§db_id)
                   {	
                          die("Verbindungsaufbau ist gescheitert");
                   }

                   // mysql_query("use usr_web_1162_3");
                   $db_sel = mysql_select_db("usr_web1162_3", $db_id);
   					 if (!$db_sel) { 
							die ('Kann Datenbank nicht benutzen : ' . mysql_error()); 
						 }
						  
                   mysql_query("SET names 'utf8'");
                   mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'", $db_id);
         		   // include_once("check_mobile.php");
         		   // $is_mobile = check_mobile();
                  printf("<link rel='stylesheet' type='text/css' href='css/mobile.css' media='screen and (max-width: 899px)' />");
						printf("<link rel='stylesheet' type='text/css' href='css/desktop.css' media='screen and (min-width: 900px)' /> \n");
						//printf("<link rel='stylesheet' media='all and (orientation:portrait)' href='css/mobile.css' />\n");
						//printf("<link rel='stylesheet' media='all and (orientation:landscape)' href='css/desktop.css' />\n");
                       
                     
         ?>
         <!--script src="js/loadWithSoap.js"></script --> 
         <!-- script src="js/loadWithRest.js"></script> 
		 <!--script src="js/loadWithXmlRpc.js"></script --> 
         <script src="js/xmlrpc_lib.js"></script>   
		 <script src="js/jsonrpc_lib.js"></script> 
         <script src="js/loadWithJsonRpc.js"></script> 
             
</head>
<body onload="pageLoaded()">
	<script type="text/javascript" >
		$(document).ready(function(){loadPage();})														 
	</script>
	<div id="progress">
		<br/><br/>
		<img src="img/tankstelle.jpg" alt="" width="263px" height="264">		
		<br/>lade aktuelle Daten...
	</div>
	<div id="hauptmenu">
	<!--?php 
		if(!$is_mobile)
		{
			include('desktop.php');
		}
		else 
		{
			include('mobile.php');
		}
		
	?>

<div id='adminfeld'> 
	<h2><center>Administration</center></h2>
	<a href='insert.php' class='button' id='neueTanke'>
			<span class='shine'></span>
			<span class='text'><center>Tankstelle anlegen</center></span>
	</a>
	<a href='update.php' class='button' id='preiseEingeben'>
			<span class='shine'></span>
			<span class='text'><center>Preise aktualisieren</center></span>
	</a>
</div>
-->
<header>

</header>
<div id='profil'> 
	<a href='' class='button'  style="color:red">
			<span class='shine'></span>
			<span class='text'><center>Profil</center></span>
	</a>
</div>




<div id='umkreisDiv'> 
	<label id="LabelUmkreis">
		Umkreis:
	</label>
	<select name="art" class="select" id="umkreis" onchange="getDataByStoredCoords()">
  		<option value="2">2 km</option>
		<option value="5" selected="selected">5 km</option>    				
		<option value="10">10 km</option>
		<option value="20">20 km</option>
		<option value="30">30 km</option>
  	</select>
</div>
<div id='sortierungDiv'> 
	<label id="LabelSortierung">
		Sortierung:
	</label>
	<select name="art" class="select" id="sortieren" onchange="getDataByStoredCoords()">
  		<option value="preis" selected="selected">Preis</option>
    	<option value="distanz">KM</option>			
  	</select>
</div>

<div id='favoriten' style="background:white; color: black;cursor:pointer"> 
	<a onclick="getFavsByCoords()"><img src="img/stargold.jpg" alt="" width="20" height="20"></img> Lade Favoriten</a>
</div>
	 
		<div id="saeule">
		   <span class="tooltip tooltipUnten" data-tooltip-text="Standort ändern">
			<div id="ort">
				<input type="text" id="stadt" value="Ort eingeben" onchange="getCoordsByTown()" onfocus="if(this.value == 'Ort eingeben') {this.value=''}" />	 <!--onchange="getCoordsByTown()"-->			
			</div> 
			</span>
			
			<div id="oeffnungszeiten">
				<img style="border:2px solid white" src="img/open.jpg" alt="" height="50">
			</div> 
			
			<div id="tankstelle">
				<a href="" id="tankstelleText" class="button" style="font-size:70%">Tankstelle</a>
			</div> 
		 
		  <div id="treibstoff">
		  <span class="tooltip tooltipUnten" data-tooltip-text="Benzinsorte ändern"> 
		  	 <form>
  				<select name="art" id="art" onchange="getDataByStoredCoords()">
  					<option value="fuelPriceE5" selected="selected">Super E5</option>  				
    				<option value="fuelPriceE10">Super E10</option>
    				<!--option value="Super Plus">Super Plus</option-->
    				<!--option value="Premium">Premium</option-->
    				<option value="fuelPriceDiesel">  Diesel</option>
    				<!--option value="Autogas">Autogas</option-->
    				<!--option value="Erdgas">Erdgas</option-->
  				</select>
  			 </form>
  			</span> 
  		  	 <div id="preis">
		   		<input type="text" id="preisOutput" value="00,000 €/L" readonly />
		  	 </div>
		  	 <span class="tooltip tooltipUnten" data-tooltip-text="Zur Tankstelle navigieren"> 
  		  	 <div id="route">
		   		<a target="_blank" href="" title="Zur Tankstelle navigieren" ><img src="img/zurTankstelle.png" width="75%" alt="" ></a>
		  	 </div>	
		  	 </span> 	  	 
		
		  </div>
		  
		  <div id="results">
		  		<table summary="results" >
		  			<tr>
		  				<td>keine Ergebnisse</td>
		  			</tr>
		  		</table>
		  </div>
		</div>
		

		<script type="text/javascript" >
			startLocating();
		</script>

		
	</div>
</body>
</html>