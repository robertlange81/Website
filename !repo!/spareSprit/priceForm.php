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
	    <td align="center">Eingabemaske für Treibstoffpreise</td>
	  </tr>
	  <tr>
	    <td>
	      <table>
	        <form method="post" action="priceInsert.php">
	        <th>
				<td>Tankstelle</td>	        
	        </th>	
	        <tr>
	          <td>Bezeichnung der Tankstelle</td>
	          <td>
	          	<select name="id"> 
    					<? 
    					   $anbieter = mysql_query("SELECT petrolStationName as bez, id, MAX( version ) as version FROM petrolStation GROUP BY id");
	 						if(mysql_num_rows($anbieter) >=1) {
	 							while($aktZeile = mysql_fetch_assoc($anbieter)){
	 								$id = $aktZeile['id'];
	 								$bg = $aktZeile['bez'];
	 								$version = $aktZeile['version'];
									printf("<option value='$id'> $id , $bg , $version</option>");
	 							}
	 						} 	
    					?>
					</select> 
	          </td>
	        </tr>
	        <tr>
	          <td>Version (siehe oben)</td>
	          <td>
	          	<input type="text" name="version" size="10" maxlength="5">
	          </td>
	        </tr>		        
	        <tr>
	          <td>Preis Normal E5</td>
	          <td>
	          	<input type="number" name="fuelPriceE5" size="7" maxlength="7" step=0.001 >
	          </td>
	        </tr>	
	        <tr>
	          <td>Preis Normal E10</td>
	          <td>
	          	<input type="number" name="fuelPriceE10" size="7" maxlength="7" step=0.001 >
	          </td>
	        </tr>
	        <tr>
	          <td>Preis Diesel</td>
	          <td>
	          	<input type="number" name="fuelPriceDiesel" size="7" maxlength="7" step=0.001 >
	          </td>
	        </tr>	 	        	 	                        	                        	                	        	        	              
	        <tr>
	          <td></td>
	          <td align="right">
	          	<input type="submit" name="submit" value="Absenden"></td>
	        </tr>
	        </table>
	      </td>
	    </tr>
	</table>

	</body>
</html>