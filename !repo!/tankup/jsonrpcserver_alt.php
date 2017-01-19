<?php 
include 'xmlrpc.inc';
include 'xmlrpcs.inc';
include 'classes.php';
include 'jsonrpc.inc';
include 'jsonrpcs.inc';

$log;

function fuel($a,$b){
	$c = $a + $b;
  return $c;
}

function getCoordByTown($params) {

	if($log == null) $log = new Logging();	 
	$log->lfile('log_debug.txt');
	$log->lwrite("Aufruf jsonrpc:getCoordsByTown mit ");	
	$log->lwrite($params->getParam(0)->scalarval());	
	$log->lclose();
	
   // Parse our parameters.
   $town = $params->getParam(0);
   $town = umlaute_einfuegen($town->scalarval());
   $latitude;
   $longitude;
	   	
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
		
		$log->lfile('log_debug.txt');
		$log->lwrite("Ergebnis :");	
		$log->lwrite($latitude .":". $longitude);	
		$log->lclose();										 
	}
	catch (Exception $ex) {
		// TODO
		if($log == null) 
			$log->lclose();
	}    
	
	
		//$resp = new jsonrpcresp(new jsonrpcval("Bla", 'string'));
		//$resp->content_type = "text/json; charset=iso-8859-1";
		//return $resp;
		//$resp->serialize('UTF-8');
    $struct = array('latitude' => new jsonrpcval(doubleval($latitude), 'double'),
                    'longitude' => new jsonrpcval(doubleval($longitude), 'double'));
    return new jsonrpcresp(new jsonrpcval($struct, 'struct'));
    
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
				$log->lfile('log_info.txt');
				$log->lwrite("Ort: " . $response );	
				break;
			}
		 } 
	}
	 catch (Exception $ex) {
		return new SoapFault("Server", "Error reading town by coord. ".$ex);
	}
   
    $struct = array('town' => new jsonrpcval(umlaute_ersetzen($response), 'string'));
    return new jsonrpcresp(new jsonrpcval($struct, 'struct'));
}

$getTownByCoords_sig = array(array('struct', 'double','double'));
$getTownByCoords_doc = 'Get Town by Location (longitude and latitude).';


function getDataByCoord($params)
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
	$log->lfile('log_info.txt');
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
	 															
	 } else if(strpos($sortieren,'distanz') !== false){
    	$priceRecords = mysql_query($basequery." order by distance limit 7");	 	
	 }
	 if(mysql_num_rows($priceRecords) >=1) {
		 
	 	$petrolStationList = array();
		
	 	/* Tankstelle ermitteln */
	 	while($aktZeile = mysql_fetch_assoc($priceRecords)){
			$location = new location($aktZeile['AnbietGPSBreite'], $aktZeile['AnbietGPSLaenge']);
			$address = new address($aktZeile['petrolStationStreet'],$aktZeile['petrolStationHouseNumber'],$aktZeile['petrolStationPostcode'],$aktZeile['petrolStationPlace']);
			$petrolStation = new petrolStation($aktZeile['id'],$aktZeile['petrolStationBrand'],$aktZeile['open'],$aktZeile['ab'],$aktZeile['bis'],$location,$aktZeile[$art],$address,$aktZeile['petrolStationVersionTime'],$aktZeile['distance']);	
			array_push($petrolStationList, $petrolStation); 		
	 	}
	 } else {
	 	echo "Keine Ergebnisse";
	 }
	}
	 catch (SoapFault $fault) {
		return new SoapFault("Server", "Error reading town by coord. ".$fault);
	}
	
	$petrolStationArray = array(); // $petrolStationList.count
	$count = 0;
	$resp = new jsonrpcresp(new jsonrpcval("no data", 'string'));
	if($petrolStationList != null) {
		foreach ($petrolStationList as $station) {
			$petrolStation = array(
							'owner' => new jsonrpcval(umlaute_ersetzen($station->owner), 'string'), 
							'isOpen' => new jsonrpcval($station->isOpen, 'boolean'), 
							'openFrom' => new jsonrpcval($station->openFrom."", 'string'),
							'openTo' => new jsonrpcval($station->openTo."", 'string'),
							'longitude' => new jsonrpcval($station->location->longitude, 'double'),
							'latitude' => new jsonrpcval($station->location->latitude, 'double'),
							'price' => new jsonrpcval($station->price, 'string'),
							'street' => new jsonrpcval(umlaute_ersetzen($station->address->street), 'string'),
							'housenumber' => new jsonrpcval($station->address->housenumber, 'string'),
							'postal' => new jsonrpcval($station->address->postal, 'string'),
							'place' => new jsonrpcval(umlaute_ersetzen($station->address->place), 'string'),
							'reporttime' => new jsonrpcval($station->reporttime . "", 'string'),
							'distance' => new jsonrpcval($station->distance, 'double'),
							'id' => new jsonrpcval($station->id, 'double'),
							);								
			array_push($petrolStationArray, new jsonrpcval($petrolStation, 'struct'));
			$count += 1;
		}		
		$resp = new jsonrpcresp(new jsonrpcval($petrolStationArray, 'struct'));
		$resp->content_type = "text/json; charset=iso-8859-1";
		//$resp->serialize('UTF-8');
	}
	return $resp;
}

$getDataByCoord_sig = array(array('struct', 'double','double','string','string','string'));
$getDataByCoord_doc = 'Get Town by Location (longitude and latitude).';

$server = new jsonrpc_server(array(
						'getTownByCoords' =>
                        array('function' => 'getTownByCoords',
                              'signature' => $getTownByCoordse_sig,
                              'docstring' => $getTownByCoords_doc),
                  		'getCoordByTown' =>
                        array('function' => 'getCoordByTown',
                              'signature' => $getCoordsByTown_sig,
                              'docstring' => $getCoordsByTown_doc),
						'getDataByCoord' =>							  
						array('function' => 'getDataByCoord',
                              'signature' => $getDataByCoord_sig,
                              'docstring' => $getDataByCoord_doc)
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