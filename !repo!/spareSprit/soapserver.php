<?php 
ini_set('soap.wsdl_cache_enabled', "0");

include 'classes.php';

$log;

function fuel($a,$b){
	$c = $a + $b;
  return $c;
}

function getCoordsByTown($arg1){

	$response = new location(-1, -1); // TODO Fehler
		 
	// Logging class initialization
	if($log == null) $log = new Logging();
	 
	// set path and name of log file (optional)
	$log->lfile('log_info.txt');
	// write message to the log file
	$log->lwrite("Aufruf getCoordsByTown mit " . $arg1);
	 
	// close log file
	$log->lclose();
	 
	
	try {
	
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
				$response = new location($aktZeile['lat'], $aktZeile['lon']);				
				break;
			}
		}
	}
	catch (SoapFault $fault) {
		return new SoapFault("Server", "Error reading coords by name of town. ".$fault);
	}
    return $response; 
}

function getTownByCoords(location $loc)
{
	$response = ""; // TODO Fehler 
	$db_id = mysql_connect("localhost","web1162","bX2KARTc");
    if(!$db_id)
    {	
        die("Verbindungsaufbau ist gescheitert");
    }
	
	try 
	{
		$arg2 = $loc->latitude;
		$arg1 = $loc->longitude;
	}
	catch (SoapFault $fault) {
		return new SoapFault("Server", "Error converting location : ".$fault);
	}

	try 
	{
		// mysql_query("use usr_web_1162_4");
		$db_sel = mysql_select_db("usr_web1162_4", $db_id);
		if (!$db_sel) { 
			die ('Kann Datenbank nicht benutzen : ' . mysql_error()); 
		 }
		 
		mysql_query("SET names 'utf8'");
		mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'", $db_id);

		$locRecords = mysql_query("SELECT data.loc_id as id, data.text_val as ort, ACOS( SIN( RADIANS( src.lat ) ) * SIN( RADIANS( '$arg2' ) ) + COS( RADIANS( src.lat ) ) * COS( RADIANS( '$arg2' ) ) * COS( RADIANS( src.lon ) - RADIANS( '$arg1' ) ) ) *6380 AS distance
											 FROM geodb_coordinates src, geodb_textdata data
											 WHERE src.lat > '$arg2' - 0.4
											 AND src.lat < '$arg2' + 0.4
											 AND src.lon > '$arg1' - 0.4
											 AND src.lon < '$arg1' + 0.4
											 AND data.loc_id = src.loc_id
											 AND data.text_type = 500100000
											 HAVING distance <5
											 ORDER BY distance asc
											 LIMIT 1");
		 if(mysql_num_rows($locRecords) >=1) {						
			while($aktZeile = mysql_fetch_assoc($locRecords)){
				$response = $aktZeile['ort'];
				break;
			}
		 } 
	}
	 catch (SoapFault $fault) {
		return new SoapFault("Server", "Error reading town by coord. ".$fault);
	}
	return $response; 
}





function getDataByCoords(DataRequest $reqt)
{
	$response = "";
	$lat;
	$lon;
	$art;
	$umkreis;
	$sortieren;
	// Logging class initialization
	if($log == null) $log = new Logging();
	
	try 
	{
		$loc = $reqt->location; 
		$lat = $loc->latitude;
		$lon = $loc->longitude;
		$art = $reqt->article;
		$umkreis = $reqt->distance;
		$sortieren = $reqt->sortBy;
	}
	catch (SoapFault $fault) {
		return new SoapFault("Server", "Error converting location : ".$fault);
	}
	 
	// set path and name of log file (optional)
	$log->lfile('log_info.txt');
	// write message to the log file
	$log->lwrite("Aufruf getDataByCoord mit Artikel ".$reqt->article." , Umkreis: ".$reqt->distance." , Sortieren nach: ".$reqt->sortBy." , Long: ".$lon." , Lat: ".$lat.".");
	$log->lclose();
	 

	$db_id = mysql_connect("localhost","web1162","bX2KARTc");
    if(!$db_id)
    {	
        die("Verbindungsaufbau ist gescheitert");
    }
	
	// mysql_query("use usr_web_1162_3");
    $db_sel = mysql_select_db("usr_web1162_3", $db_id);
    if (!$db_sel) { 
		// close log file
		$log->lclose();
		die ('Kann Datenbank nicht benutzen : ' . mysql_error()); 
	}
	
	mysql_query("SET names 'utf8'");
    mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'", $db_id);

	try 
	{
	 $priceRecords = null;	  
	 $basequery = "select distinct TIME_FORMAT(ot.startTimeOfPeriod,'%H:%i') as ab, TIME_FORMAT(ot.endTimeOfPeriod,'%H:%i') as bis,
    													(select CASE WHEN CURRENT_TIME BETWEEN ot.startTimeOfPeriod
																					AND ot.endTimeOfPeriod
																	then 1
																	else 0
																	end
															) as open,
    													" . $art . " , a.id, a.petrolStationBrand, a.petrolStationStreet, a.petrolStationHouseNumber, a.petrolStationPostcode, a.petrolStationPlace, a.petrolStationVersionTime, a.longitude as AnbietGPSLaenge, a.latitude as AnbietGPSBreite, ACOS( SIN( RADIANS( a.latitude ) ) * SIN( RADIANS( '$lat' ) ) + COS( RADIANS( a.latitude ) ) * COS( RADIANS( '$lat' ) ) * COS( RADIANS( a.longitude ) - RADIANS( '$lon' ) ) ) *6380 AS 'distance'
										 
	 													from ( select Max(`version`) as newest 
	 															from `fuelPrice` 
	 															group by `id` ) plNewest, 
	 														`fuelPrice` pl, `petrolStation` a, `openingTimes` ot
	 															where a.latitude > '$lat' - 0.4
										 						AND a.latitude < '$lat' + 0.4
										 						AND a.longitude > '$lon' - 0.4
										 						AND a.longitude < '$lon' + 0.4
										 						and pl.`version` = plNewest.newest
	 															and a.`id` = pl.`id` 
																and ot.applicableDay = (SELECT DAYNAME( CURDATE( ) ) )
																and ot.fid = a.id
	 															and " . $art . " > 0 	
	 															having distance < '$umkreis' ";																													
     if(strpos($sortieren,'preis') !== false) {																															    
    	$priceRecords = mysql_query($basequery." order by $art, distance limit 7");
	 															
	 } else if(strpos($sortieren,'distanz') !== false){
    	$priceRecords = mysql_query($basequery." order by distance limit 7");	 	
	 }
	 if(mysql_num_rows($priceRecords) >=1) {
		 
	 	$petrolStationList = array();
		
	 	/* Tankstelle ermitteln */
	 	while($aktZeile = mysql_fetch_assoc($priceRecords)){
			// $log->lwrite("Ergebnis GetDataByCoords ".$aktZeile['AnbietGPSBreite']." , ".$aktZeile['AnbietGPSLaenge']." , ".$aktZeile['petrolStationStreet']." , ".$aktZeile['petrolStationHouseNumber']." , ".$aktZeile['petrolStationPostcode']." , ".$aktZeile['petrolStationPlace']." , ".$aktZeile['id']." , ".$aktZeile['petrolStationBrand']." , ".$aktZeile['open']." , ".$aktZeile['ab']." , ".$aktZeile['bis']." , ".$aktZeile[$art]." , ".$aktZeile['petrolStationVersionTime']." , ".$aktZeile['distance'].".");
			//$log->lclose();
			$location = new location($aktZeile['AnbietGPSBreite'], $aktZeile['AnbietGPSLaenge']);
			$address = new address($aktZeile['petrolStationStreet'],$aktZeile['petrolStationHouseNumber'],$aktZeile['petrolStationPostcode'],$aktZeile['petrolStationPlace']);
			$petrolStation = new petrolStation($aktZeile['id'],$aktZeile['petrolStationBrand'],$aktZeile['open'],$aktZeile['ab'],$aktZeile['bis'],$location,$aktZeile[$art],$address,$aktZeile['petrolStationVersionTime'],$aktZeile['distance']);	
			// $log->lwrite("Address: ".$aktZeile['petrolStationStreet'].$aktZeile['petrolStationHouseNumber'].$aktZeile['petrolStationPostcode'].$aktZeile['petrolStationPlace']);
			array_push($petrolStationList, $petrolStation); 		
	 	}
	 } else {
	 	echo "Keine Ergebnisse";
	 }
	}
	 catch (SoapFault $fault) {
		return new SoapFault("Server", "Error reading town by coord. ".$fault);
	}
	$response = $petrolStationList;
	
	return $response; 
}

$server=new SoapServer("http://www.sparesprit.de/sprit.wsdl");
$server->addFunction("fuel");
$server->addFunction("getCoordsByTown");
$server->addFunction("getTownByCoords");
$server->addFunction("getDataByCoords");
$server->handle();

?>