<?php 
include 'xmlrpc.inc';
include 'xmlrpcs.inc';
include 'classes.php';

header('Content-Type: text/xml; charset=utf-8');

$log;

function fuel($a,$b){
	$c = $a + $b;
  return $c;
}

function getCoordsByTown ($params) {

   // Parse our parameters.
   $town = $params->getParam(0);
   $town = umlaute_einfuegen($town->scalarval());
   $latitude;
   $longitude;
	
	
	if($log == null) $log = new Logging();	 
	$log->lfile('log_debug.txt');
	$log->lwrite("Aufruf getCoordsByTown mit " . $town);	
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
											 WHERE data.text_val = '$town'
											 AND data.loc_id = src.loc_id
											 AND data.text_type = 500100000
											 LIMIT 1");
											 
		if(mysql_num_rows($locRecords) >=1) {
			/* Tankstelle ermitteln */
			while($aktZeile = mysql_fetch_assoc($locRecords)){ 	
					$latitude = $aktZeile['lat'];
					$longitude = $aktZeile['lon'];		
				break;
			}
		}											 
	}
	catch (Exception $ex) {
		// TODO
	}    
    $struct = array('latitude' => new xmlrpcval(doubleval($latitude), 'double'),
                    'longitude' => new xmlrpcval(doubleval($longitude), 'double'));
    return new xmlrpcresp(new xmlrpcval($struct, 'struct'));
}

$getCoordsByTown_sig = array(array('struct', 'string'));;
$getCoordsByTown_doc = 'Get location (longitude and latitude) By Name of Town.';


function getTownByCoords($params)
{

	$db_id = mysql_connect("localhost","web1162","bX2KARTc");
    if(!$db_id)
    {	
        die("Verbindungsaufbau ist gescheitert");
    }
	
	$arg1;$arg2;
	if($log == null) $log = new Logging();	 
	$log->lfile('log_debug.txt');
	$log->lwrite("Aufruf getTownByCoords mit " . $params->getParam(0)->scalarval(). " und ". $params->getParam(1)->scalarval());	
	try 
	{
		$arg2  = $params->getParam(0)->scalarval();
		$arg1 =  $params->getParam(1)->scalarval();	
	}
	catch (Exception $ex) {
		return "Error converting location : ".$ex;
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
				if($log == null) $log = new Logging();	 
				$log->lfile('log_debug.txt');
				$log->lwrite("Ort: " . $response );	
				break;
			}
		 } 
	}
	 catch (Exception $ex) {
		return new SoapFault("Server", "Error reading town by coord. ".$ex);
	}
   
    $struct = array('town' => new xmlrpcval(umlaute_ersetzen($response), 'string'));
    return new xmlrpcresp(new xmlrpcval($struct, 'struct'));
}

$getTownByCoords_sig = array(array('struct', 'double','double'));
$getTownByCoords_doc = 'Get Town by Location (longitude and latitude).';


function getDataByCoords($params)
{
	$lat;
	$lon;
	$art;
	$umkreis;
	$sortieren;
	
	try 
	{ 
		$lat 		= $params->getParam(0)->scalarval();
		$lon 		= $params->getParam(1)->scalarval();
		$art 		= $params->getParam(2)->scalarval();
		$umkreis 	= $params->getParam(3)->scalarval();
		$sortieren 	= $params->getParam(4)->scalarval();
	}
	catch (Exception $fault) {
		return new Exception("Server", "Error converting params getDataByCoords : ".$fault);
	}
	 
	if($log == null) $log = new Logging();	 
	$log->lfile('log_debug.txt');
	$log->lwrite("Aufruf getDataByCoord mit Artikel ".$art." , Umkreis: ".$umkreis." , Sortieren nach: ".$sortieren." , Long: ".$lon." , Lat: ".$lat.".");
	$log->lclose();	 

	$db_id = mysql_connect("localhost","web1162","bX2KARTc");
    if(!$db_id)
    {	
        die("Verbindungsaufbau ist gescheitert");
    }
	
    $db_sel = mysql_select_db("usr_web1162_3", $db_id);
    if (!$db_sel) { 
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
	 															
	 } else if(strpos($sortieren,'km') !== false){
    	$priceRecords = mysql_query($basequery." order by distance limit 7");	 	
	 }
	 if(mysql_num_rows($priceRecords) >=1) {
		 
			if($log == null) $log = new Logging();	 
	$log->lfile('log_debug.txt');
	$log->lwrite("Mehr als 1 Ergebnis");
	$log->lclose();	 
	
	 	$petrolStationList = array();
		
	 	/* Tankstelle ermitteln */
	 	while($aktZeile = mysql_fetch_assoc($priceRecords)){
			$location = new location($aktZeile['AnbietGPSBreite'], $aktZeile['AnbietGPSLaenge']);
			$address = new address($aktZeile['petrolStationStreet'],$aktZeile['petrolStationHouseNumber'],$aktZeile['petrolStationPostcode'],$aktZeile['petrolStationPlace']);
			$petrolStation = new petrolStation($aktZeile['id'],$aktZeile['petrolStationBrand'],$aktZeile['open'],$aktZeile['ab'],$aktZeile['bis'],$location,$aktZeile[$art],$address,$aktZeile['petrolStationVersionTime'],$aktZeile['distance']);	
			array_push($petrolStationList, $petrolStation); 		
	 	}
	 } else {
	 	return new xmlrpcresp(new xmlrpcval("no data", $ex));
	 }
	}
	 catch (Exception $ex) {
		return new xmlrpcresp(new xmlrpcval("error", $ex));
	}
	
	$petrolStationArray = array(); // $petrolStationList.count
	$count = 0;
	$resp = new xmlrpcresp(new xmlrpcval("no data", 'string'));
	if($petrolStationList != null) {
		foreach ($petrolStationList as $station) {
			$petrolStation = array(
							'owner' => new xmlrpcval(umlaute_ersetzen($station->owner), 'string'), 
							'isOpen' => new xmlrpcval($station->isOpen, 'boolean'), 
							'openFrom' => new xmlrpcval($station->openFrom."", 'string'),
							'openTo' => new xmlrpcval($station->openTo."", 'string'),
							'longitude' => new xmlrpcval($station->location->longitude, 'double'),
							'latitude' => new xmlrpcval($station->location->latitude, 'double'),
							'price' => new xmlrpcval($station->price, 'string'),
							'street' => new xmlrpcval(umlaute_ersetzen($station->address->street), 'string'),
							'housenumber' => new xmlrpcval($station->address->housenumber, 'string'),
							'postal' => new xmlrpcval($station->address->postal, 'string'),
							'place' => new xmlrpcval(umlaute_ersetzen($station->address->place), 'string'),
							'reporttime' => new xmlrpcval($station->reporttime . "", 'string'),
							'distance' => new xmlrpcval($station->distance, 'double'),
							'id' => new xmlrpcval($station->id, 'double'),
							);
								
			if($log == null) $log = new Logging();	 
			$log->lfile('log_debug.txt');
			$log->lwrite("Abfrage erfolgreich");
			$log->lclose();			
			array_push($petrolStationArray, new xmlrpcval($petrolStation, 'struct'));
			$count += 1;
		}		
		$resp = new xmlrpcresp(new xmlrpcval($petrolStationArray, 'struct'));
		$resp->content_type = "text/xml; charset=UTF-8";
		//$resp->serialize('UTF-8');
	}
	return $resp;
}

$getDataByCoords_sig = array(array('struct', 'double','double','string','string','string'));
$getDataByCoords_doc = 'Get Town by Location (longitude and latitude).';

$server = new xmlrpc_server(array('getTownByCoords' =>
                        array('function' => 'getTownByCoords',
                              'signature' => $getTownByCoordse_sig,
                              'docstring' => $getTownByCoords_doc),
                  		'getCoordsByTown' =>
                        array('function' => 'getCoordsByTown',
                              'signature' => $getCoordsByTown_sig,
                              'docstring' => $getCoordsByTown_doc)
                              ,
						'getDataByCoords' =>							  
						array('function' => 'getDataByCoords',
                              'signature' => $getDataByCoords_sig,
                              'docstring' => $getDataByCoords_doc)
                        )
);

$server->response_charset_encoding = 'UTF-8';
$charset_encoding = 'UTF-8';

function umlaute_ersetzen($text){
	$such_array  = array ('ä', 'ö', 'ü', 'ß', 'Ä', 'Ö','Ü');
	$ersetzen_array = array ('&#xE4;', '&#xF6;', '&#xFC;', '&#xDF;', '&#xC4;','&#xD6;','&#xDC;');
	$neuer_text  = str_replace($such_array, $ersetzen_array, $text);
	return $neuer_text;
}

function umlaute_einfuegen($text){
	$ersetzen_array  = array ('ä', 'ö', 'ü', 'ß', 'Ä', 'Ö','Ü');
	$such_array = array ('#ae#', '#oe#', '#ue#', '#sz#', '#AE#','#OE#','#UE#');
	$neuer_text  = str_replace($such_array, $ersetzen_array, $text);
	return $neuer_text;
}


?>