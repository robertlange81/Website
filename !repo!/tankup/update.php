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
<body onload="pageLoaded()">
	<script type="text/javascript" >
		$(document).ready(function(){loadPage();})														 
	</script>
	<div id="progress"><br/><br/><br/>loading...</div>
	 <div id="eingabeTanke">
		<form>
				<select title="Wählen Sie eine Tankstelle">
		<?php
						print("Tankstelle: ");
						$result = mysql_query("select * from `Anbieter` order by 'AnbietBezeichnung'");												
						if(mysql_num_rows($result) >=1) {
							while($row = mysql_fetch_assoc($result)){
								$id  = $row['NutzerID'];
								$bez = $row['AnbietBezeichnung'];
								print("<option value ='$id'>$bez</option>");
							}
						} 
		?>
				</select>
    			<textarea required></textarea>
		   	<button>Validieren &amp; Abschicken</button>
			</form>
	 </dir>
	</body>
</html>