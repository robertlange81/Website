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
         
// doppeltes Senden verhindern		     				    
if($_POST[id] != null) {	
 
	//Tankstelle
	$query = "INSERT INTO petrolStation
	            (id, 
	            version, 
	            petrolStationVersionTime, 
	            petrolStationName, 
	            petrolStationBrand, 
	            petrolStationStreet, 
	            petrolStationHouseNumber,
	            petrolStationPostcode,
	            petrolStationPlace,
	            latitude,
	            longitude)
	            VALUES
	            ('$_POST[id]',
	            '$_POST[version]',
	            '$_POST[versiondate] $_POST[versiontime]',
	            '$_POST[name]',
	            '$_POST[brand]',
	            '$_POST[street]',
	            $_POST[housenumber],
	            '$_POST[postalcode]',
	            '$_POST[place]',
	            $_POST[latitude],
	            $_POST[longitude])";
	 

	$result = mysql_query($query);  

	if($result){
	
		//Zeiten
		$query = "INSERT INTO openingTimes
	            (fid, 
	            applicableDay, 
	            startTimeOfPeriod,
	            endTimeOfPeriod)
	            VALUES
	            ('$_POST[id]',
	            'monday',
	            '$_POST[mondaystart]',
	            '$_POST[mondayend]')";	
	            
		$result = mysql_query($query);  	            
	            
		$query = "INSERT INTO openingTimes
	            (fid, 
	            applicableDay, 
	            startTimeOfPeriod,
	            endTimeOfPeriod)
	            VALUES
	            ('$_POST[id]',
	            'tuesday',
	            '$_POST[tuedaystart]',
	            '$_POST[tuedayend]')";	
	            
		$result = mysql_query($query);  	            
	            
		$query = "INSERT INTO openingTimes
	            (fid, 
	            applicableDay, 
	            startTimeOfPeriod,
	            endTimeOfPeriod)
	            VALUES
	            ('$_POST[id]',
	            'wednesday',
	            '$_POST[weddaystart]',
	            '$_POST[weddayend]')";	
	            
		$result = mysql_query($query);	            
	            
		$query = "INSERT INTO openingTimes
	            (fid, 
	            applicableDay, 
	            startTimeOfPeriod,
	            endTimeOfPeriod)
	            VALUES
	            ('$_POST[id]',
	            'thursday',
	            '$_POST[thudaystart]',
	            '$_POST[thudayend]')";	
	            
		$result = mysql_query($query);	            
	            
		$query = "INSERT INTO openingTimes
	            (fid, 
	            applicableDay, 
	            startTimeOfPeriod,
	            endTimeOfPeriod)
	            VALUES
	            ('$_POST[id]',
	            'friday',
	            '$_POST[fridaystart]',
	            '$_POST[fridayend]')";	
	            
		$result = mysql_query($query);	            
	            
		$query = "INSERT INTO openingTimes
	            (fid, 
	            applicableDay, 
	            startTimeOfPeriod,
	            endTimeOfPeriod)
	            VALUES
	            ('$_POST[id]',
	            'saturday',
	            '$_POST[satdaystart]',
	            '$_POST[satdayend]')";	
	            
		$result = mysql_query($query);	            
	            
		$query = "INSERT INTO openingTimes
	            (fid, 
	            applicableDay, 
	            startTimeOfPeriod,
	            endTimeOfPeriod)
	            VALUES
	            ('$_POST[id]',
	            'sonday',
	            '$_POST[sondaystart]',
	            '$_POST[sondayend]')";	
	            
		$result = mysql_query($query);            

			
		echo("<br>OK.");
	} else{
	    echo("<br>Fehler beim Einfügen der Tankstelle.");
	}
}
	?>