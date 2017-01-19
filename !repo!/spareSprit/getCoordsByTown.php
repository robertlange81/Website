<?php
 
// eine beliebige PHP-Funktion 
function getLocation($arg1)
{
	 
	 $db_id = mysql_connect("localhost","web1162","bX2KARTc");
    if(!$db_id)
    {	
        die("Verbindungsaufbau ist gescheitert");
    }

    // mysql_query("use usr_web_1162_4");
    $db_sel = mysql_select_db("usr_web1162_4", $db_id);
    if (!$db_sel) { 
		die ('Kann Datenbank nicht benutzen : ' . mysql_error()); 
	 }
	 
	 mysql_query("SET names 'utf8'");
    mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'", $db_id);

    $locRecords = mysql_query("SELECT src.loc_id as id, src.lon as lon, src.lat as lat
										 FROM geodb_coordinates src, geodb_textdata data
										 WHERE data.text_val = '$arg1'
										 AND data.loc_id = src.loc_id
										 AND data.text_type = 500100000
										 LIMIT 1");
	 if(mysql_num_rows($locRecords) >=1) {
	 	/* Tankstelle ermitteln */
	 	
	 	while($aktZeile = mysql_fetch_assoc($locRecords)){
			printf("lat");	 		
	 		echo $aktZeile['lat'];
			printf("lon");	 		
	 		echo $aktZeile['lon'];
	 	}
	 } 

}
 
getLocation($_POST['town']);

?> 
