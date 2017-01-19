<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
		<?php print("<meta name='author' content='Robert Lange' />"); ?>   
		<meta name="keywords" content="Robert Lange, Weblication, Web, App" />
		<meta name="description" content="Diese Anwendung ist ein Projekt im Rahmen der Lehrveranstaltung Web-Datenbanken an der HTWK Leipzig und dient keinem kommerziellen Zweck" />
		<meta name="viewport" content="user-scalable=no, width=device-width" />
		<meta charset="utf-8" />     
		<script type="text/javascript" src="js/jquery.js"></script>
		<title>TankUp</title>
		      <?php
      
                   /**
                   * @Robert Lange
                   * @copyright 2011
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
         
         ?>
         <link rel='stylesheet' type='text/css' href='css/desktop.css' media='screen and (min-width: 481px)' />
			<script src="js/load.js"></script> 
</head>
<body onload="pageLoaded()" style="background: none;">
	<script type="text/javascript" >
		$(document).ready(function(){loadPage();})														 
	</script>
	<div id="progress"><br/><br/><br/>loading...</div>
	 <div id="eingabeTanke">
<table border="1" style="background:black">
	  <tr>
	    <td align="center">Eingabemaske für Tankstellen</td>
	  </tr>
	  <tr>
	    <td>
	      <table>
	        <form method="post" action="stationInsert.php">   	        
	        <th>
				<td>Identifikation</td>	        
	        </th>
	        <tr>
	          <td>ID*</td>
	          <td><input type="text" name="id" size="40" maxlength="40">
	          </td>
	        </tr>	  
	        <tr>
	          <td>version*</td>
	          <td><input type="text" name="version" size="5" maxlength="5">
	          </td>
	        </tr>		
	        <tr>
	          <td>Zeitstempel-Tag*</td>
	          <td><input type="date" name="versiondate" >
	          </td>
	        </tr>	
	        <tr>
	          <td>Zeitstempel-Uhrzeit*</td>
	          <td><input type="time" name="versiontime" >
	          </td>
	        </tr>		        
	        <tr>
	          <td>Bezeichnung*</td>
	          <td><input type="text" name="name" size="100" maxlength="40">
	          </td>
	        </tr>	
	        <tr>
	          <td>Marke</td>
	          <td><input type="text" name="brand" size="100" maxlength="40">
	          </td>
	        </tr>		        	                
	        <tr>
	          <td>Strasse*</td>
	          <td><input type="text" name="street" size="40" maxlength="100">
	          </td>
	        </tr>	  
	        <tr>
	          <td>Hausnummer*</td>
	          <td><input type="text" name="housenumber" size="5" maxlength="5">
	          </td>
	        </tr>	
	        <tr>
	          <td>PLZ*</td>
	          <td><input type="text" name="postalcode" size="6" maxlength="6">
	          </td>
	        </tr>	
	        <tr>
	          <td>Ort*</td>
	          <td><input type="text" name="place" size="30" maxlength="100">
	          </td>
	        </tr>	
	        <tr>
	          <td>&nbsp;</td>
	          <td>&nbsp;</td>
	        </tr>		        
	        <th>
				<td>Koordinaten</td>	        
	        </th>	        
 	        <tr>
	          <td>Geographische Breite*</td>
	          <td><input type="text" name="latitude" size="18" maxlength="18">
	          </td>
	        </tr>		  	        
	        <tr>
	          <td>Geographische Länge*</td>
	          <td><input type="text" name="longitude" size="18" maxlength="18">
	          </td>
	        </tr>		                        	                	        	        	               
	        <th>
				<td>Öffnungszeiten</td>	        
	        </th>	        
 	        <tr>
	          <td>Montag</td>
	          <td>
	          	von <input type="time" name="mondaystart"><br>
	          	bis <input type="time" name="mondayend">
	          </td>
	        </tr>	
 	        <tr>
	          <td>Dienstag</td>
	          <td>
	          	von <input type="time" name="tuedaystart"><br>
	          	bis <input type="time" name="tuedayend">
	          </td>
	        </tr>	
 	        <tr>
	          <td>Mittwoch</td>
	          <td>
	          	von <input type="time" name="weddaystart"><br>
	          	bis <input type="time" name="weddayend">
	          </td>
	        </tr>	
 	        <tr>
	          <td>Donnerstag</td>
	          <td>
	          	von <input type="time" name="thudaystart"><br>
	          	bis <input type="time" name="thudayend">
	          </td>
	        </tr>	
 	        <tr>
	          <td>Freitag</td>
	          <td>
	          	von <input type="time" name="fridaystart"><br>
	          	bis <input type="time" name="fridayend">
	          </td>
	        </tr>	
 	        <tr>
	          <td>Samstag</td>
	          <td>
	          	von <input type="time" name="satdaystart"><br>
	          	bis <input type="time" name="satdayend">
	          </td>
	        </tr>		
 	        <tr>
	          <td>Sonntag</td>
	          <td>
	          	von <input type="time" name="sondaystart"><br>
	          	bis <input type="time" name="sondayend">
	          </td>
	        </tr>		                	        	        	        	        	  	        	                        	                	        	        	              
	        <tr>
	          <td></td>
	          <td align="right">
	          	<input type="submit" name="submit" value="Absenden">
	          </td>
	        </tr>		              
	        </table>
	      </td>
	    </tr>
	</table>

	</body>
</html>