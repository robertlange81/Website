<?php
include 'xmlrpc.inc';
include 'xmlrpcs.inc';
include 'classes.php';
include 'jsonrpc.inc';
include 'jsonrpcs.inc';

function getCoordsByTown ($params) {

   // Parse our parameters.
   $town = $params->getParam(0);
   $town = $town->scalarval();
   $latitude;
	$longitude;
	
	/*
	if($log == null) $log = new Logging();	 
	$log->lfile('log_info.txt');
	$log->lwrite("Aufruf getCoordsByTown mit " . $params->getParam(0));*/	
   	
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
    $struct = array('latitude' => new jsonrpcval(doubleval($latitude), 'double'),
                    'longitude' => new jsonrpcval(doubleval($longitude), 'double'));
    return new jsonrpcresp(new jsonrpcval($struct, 'struct'));
}

$getCoordsByTown_sig = array(array('struct', 'string'));;
$getCoordsByTown_doc = 'Get location (longitude and latitude) By Name of Town.';

/*
function sumAndDifference ($params) {

    // Parse our parameters.
    $xval = $params->getParam(0);
    $x = $xval->scalarval();
    $yval = $params->getParam(1);
    $y = $yval->scalarval();

    // Build our response.
    $struct = array('sum' => new xmlrpcval($x + $y, 'int'),
                    'difference' => new xmlrpcval($x - $y, 'int'));
    return new xmlrpcresp(new xmlrpcval($struct, 'struct'));
}

$sumAndDifference_sig = array(array('struct', 'int', 'int'));
$sumAndDifference_doc = 'Add and subtract two numbers'; */

new jsonrpc_server(array(/*'sample.sumAndDifference' =>
                        array('function' => 'sumAndDifference',
                              'signature' => $sumAndDifference_sig,
                              'docstring' => $sumAndDifference_doc),*/
                  		'getCoordsByTown' =>
                        array('function' => 'getCoordsByTown',
                              'signature' => $getCoordsByTown_sig,
                              'docstring' => $getCoordsByTown_doc)
                              )
                        );
?>