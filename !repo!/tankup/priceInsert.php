	<?
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
        
        				 $query = "SELECT * FROM fuelPrice WHERE id='$_POST[id]' AND version='$_POST[version]'";
	 				    $exits = mysql_query($query); 
	 		// doppeltes Senden verhindern		     				    
	 		if($_POST[id] != null) {

	 					 if(mysql_num_rows($exits) >=1) {
	 					 	echo "Aktualisieren des Datensatzes ";
	 					 	if($_POST[fuelPriceE5] != null && $_POST[fuelPriceE5] != '' && $_POST[fuelPriceE5] != 0 ){
	 					 		$query1 = "UPDATE fuelPrice SET fuelPriceE5='$_POST[fuelPriceE5]' WHERE id='$_POST[id]' AND version='$_POST[version]'";
								$result = mysql_query($query1);
								if(!$result) 
									echo "Fehler Aktualisieren FuelPriceE5"; 					 		
	 					 	}
	 					 	if($_POST[fuelPriceE10] != null && $_POST[fuelPriceE10] != '' && $_POST[fuelPriceE10] != 0 ){
	 					 		$query1 = "UPDATE fuelPrice SET fuelPriceE10='$_POST[fuelPriceE10]' WHERE id='$_POST[id]' AND version='$_POST[version]'";
								$result = mysql_query($query1);	
								if(!$result) 
									echo "Fehler Aktualisieren FuelPriceE10"; 									 					 		
	 					 	}	 	
	 					 	if($_POST[fuelPriceDiesel] != null && $_POST[fuelPriceDiesel] != '' && $_POST[fuelPriceDiesel] != 0 ){
	 					 		$query1 = "UPDATE fuelPrice SET fuelPriceDiesel='$_POST[fuelPriceDiesel]' WHERE id='$_POST[id]' AND version='$_POST[version]'";
								$result = mysql_query($query1);
								if(!$result) 
									echo "Fehler Aktualisieren FuelPriceDiesel"; 										 					 		
	 					 	}	 					 	 					 					 		 					 	
			 
	 					 } else {
	 					 	echo "Einfügen eines neuen Datensatzes ";
	 					 	echo $_POST[id];
	 					 	echo $_POST[version];
	 					 	echo $_POST[fuelPriceE5];
	 					 	echo $_POST[fuelPriceE10];
	 					 	echo $_POST[fuelPriceDiesel];
	 					 	$query2 = "INSERT INTO fuelPrice (id, version, fuelPriceE5, fuelPriceE10, fuelPriceDiesel)
	            					VALUES
	            					('$_POST[id]',
	            	 				 '$_POST[version]',
	            	 				 '$_POST[fuelPriceE5]',
	            	 				 '$_POST[fuelPriceE10]',
	            	 				 '$_POST[fuelPriceEDiesel]')";
	            	 	$result = mysql_query($query2);
							if(!$result) 
								echo "Fehler Einfügen FuelPrice"; 	            	 	
	 					 }

	if($result){
		echo("erfolgreich.");
	} else{
	   echo("fehlerhaft.");
	}
}
	?>