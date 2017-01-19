<?php 
require_once 'AbstractApi.php';
require_once '../../soapclient.php';
class FuelAPI extends API
{
    protected $User;
    public $soapClient;

    public function __construct($request, $origin) {
        parent::__construct($request);

        /* Abstracted out for example
        $APIKey = new Models\APIKey();
        $User = new Models\User();

        if (!array_key_exists('apiKey', $this->request)) {
            throw new Exception('No API Key provided');
        } else if (!$APIKey->verifyKey($this->request['apiKey'], $origin)) {
            throw new Exception('Invalid API Key');
        } else if (array_key_exists('token', $this->request) &&
             !$User->get('token', $this->request['token'])) {

            throw new Exception('Invalid User Token');
        }

        $this->User = $User;*/
        //$soapClient = new SoapClientDispatcher();
    }

     protected function CoordsByTown() {
		 
        switch($this->method) {
			case 'GET':
				if(!empty($_GET['town'])){
					return $this->GetCoordsByTown($_GET['town']);
				} else {
					return array('Missing or Invalid Arguments', 400);
				}
				break;
			default:
				return array('Invalid Method', 405);
				break;
        }				 
     }
     
     private function GetCoordsByTown($arg1)
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
				$response = new location($aktZeile['lat'], $aktZeile['lon']);				
				break;
			}
		}
		else 
		{
			$response = null;	
		}
    	return $response;      	
     }
     
     protected function TownByCoords() {
        switch($this->method) {
			case 'GET':
				if(!empty($_GET['latitude']) && !empty($_GET['longitude'])){
					return array('town' => $this->GetTownByCoords(new location($_GET['latitude'],$_GET['longitude'])));
				} else {
					return array('Missing or Invalid Arguments', 400);
				}
				break;
			default:
				return array('Invalid Method', 405);
				break;
        }			 
     }   
     
   private function GetTownByCoords(location $loc)
   {
	$town = null; // TODO Fehler 
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
	catch (Exception $ex) {
		return new Exception("Server", "Error converting location : ".$ex);
	}
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
				$town = $aktZeile['ort'];
				break;
			}
		 } 
		return $town;      	
   }
     
   protected function DataByCoords() {
        switch($this->method) {
			case 'GET':
				if(!empty($_GET['latitude']) 
						&& !empty($_GET['longitude']) 
							&& !empty($_GET['article'])
								&& !empty($_GET['distance'])
									&& !empty($_GET['sortBy'])){					
					return array('stationList' => $this->GetDataByCoords($_GET['article'], $_GET['distance'],$_GET['sortBy'], new location($_GET['latitude'],$_GET['longitude'])));
				} else {
					return array('Missing or Invalid Arguments', 400);
				}
				break;
			case 'POST':
				if(!empty($_POST['latitude']) 
						&& !empty($_POST['longitude']) 
							&& !empty($_POST['article'])
								&& !empty($_POST['distance'])
									&& !empty($_POST['sortBy'])){					
					return array('stationList' => $this->GetDataByCoords($_POST['article'], $_POST['distance'],$_POST['sortBy'], new location($_POST['latitude'],$_POST['longitude'])));
				} else {
					return array('Missing or Invalid Arguments', 400);
				}
				break;				
			default:
				return array('Invalid Method', 405);
				break;
        }			 
     }           
 
 private function GetDataByCoords($art, $umkreis, $sortieren, $loc)
 {
	$response = null;
	$lat = $loc->latitude;
	$lon = $loc->longitude; 

	$db_id = mysql_connect("localhost","web1162","bX2KARTc");
   if(!$db_id)
   {	
       die("Verbindungsaufbau ist gescheitert");
   }
	
	// mysql_query("use usr_web_1162_3");
   $db_sel = mysql_select_db("usr_web1162_3", $db_id);
   if (!$db_sel) { 
	// close log file
		// $log->lclose();
		die ('Kann Datenbank nicht benutzen : ' . mysql_error()); 
	}
	
	mysql_query("SET names 'utf8'");
   mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'", $db_id);

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
	 } else {
		$priceRecords = mysql_query($basequery." order by distance limit 7");	  
	 }
	 
	 $petrolStationList = array();
	 if(mysql_num_rows($priceRecords) >=1) {	 

	 	/* Tankstelle ermitteln */
	 	while($aktZeile = mysql_fetch_assoc($priceRecords)){
			$location = new location($aktZeile['AnbietGPSBreite'], $aktZeile['AnbietGPSLaenge']);
			$address = new address($aktZeile['petrolStationStreet'],$aktZeile['petrolStationHouseNumber'],$aktZeile['petrolStationPostcode'],$aktZeile['petrolStationPlace']);
			$petrolStation = new petrolStation($aktZeile['id'],$aktZeile['petrolStationBrand'],$aktZeile['open'],$aktZeile['ab'],$aktZeile['bis'],$location,$aktZeile[$art],$address,$aktZeile['petrolStationVersionTime'],$aktZeile['distance']);	

			array_push($petrolStationList, $petrolStation); 		
	 	}
	 } 
	
	 return $petrolStationList; 	
 }



# favorits / copy of dataByCoords with additional ids
# example-request: http://www.sparesprit.de/api/v2/FuelApi.php?request=databycids
	protected function DataByIds() {
		switch($this->method) {
			case 'GET':
				if(!empty($_GET['ids'])
					&& !empty($_GET['latitude'])
					&& !empty($_GET['longitude'])
					&& !empty($_GET['article'])
					&& !empty($_GET['distance'])
					&& !empty($_GET['sortBy'])){

					$idList = $_GET['ids'];
					$idsQuery = json_decode($idList, TRUE);
					$idsQuery = "(" . implode(",", $idsQuery) . ")";

					return array('stationList' => $this->GetDataByIds($idsQuery, $_GET['article'], $_GET['distance'],$_GET['sortBy'], new location($_GET['latitude'],$_GET['longitude'])));
				} else {
					return array('Missing or Invalid Arguments', 400);
				}
				break;
			default:
				return array('Invalid Method', 405);
				break;
		}
	}

	private function GetDataByIds($idsQuery, $art, $umkreis, $sortieren, $loc)
	{
		$response = null;
		$lat = $loc->latitude;
		$lon = $loc->longitude;

		$db_id = mysql_connect("localhost","web1162","bX2KARTc");
		if(!$db_id)
		{
			die("Verbindungsaufbau ist gescheitert");
		}

		// mysql_query("use usr_web_1162_3");
		$db_sel = mysql_select_db("usr_web1162_3", $db_id);
		if (!$db_sel) {
			// close log file
			// $log->lclose();
			die ('Kann Datenbank nicht benutzen : ' . mysql_error());
		}

		mysql_query("SET names 'utf8'");
		mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'", $db_id);

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
	 															where a.`id` in $idsQuery
										 						and pl.`version` = plNewest.newest
	 															and a.`id` = pl.`id`
																and ot.applicableDay = (SELECT DAYNAME( CURDATE( ) ) )
																and ot.fid = a.id
	 															and " . $art . " > 0";
		if(strpos($sortieren,'preis') !== false) {
			$priceRecords = mysql_query($basequery." order by $art, distance limit 7");
		} else if(strpos($sortieren,'distanz') !== false){
			$priceRecords = mysql_query($basequery." order by distance limit 7");
		} else {
			$priceRecords = mysql_query($basequery." order by distance limit 7");
		}

		$petrolStationList = array();
		if(mysql_num_rows($priceRecords) >=1) {

			/* Tankstelle ermitteln */
			while($aktZeile = mysql_fetch_assoc($priceRecords)){
				$location = new location($aktZeile['AnbietGPSBreite'], $aktZeile['AnbietGPSLaenge']);
				$address = new address($aktZeile['petrolStationStreet'],$aktZeile['petrolStationHouseNumber'],$aktZeile['petrolStationPostcode'],$aktZeile['petrolStationPlace']);
				$petrolStation = new petrolStation($aktZeile['id'],$aktZeile['petrolStationBrand'],$aktZeile['open'],$aktZeile['ab'],$aktZeile['bis'],$location,$aktZeile[$art],$address,$aktZeile['petrolStationVersionTime'],$aktZeile['distance']);

				array_push($petrolStationList, $petrolStation);
			}
		}

		return $petrolStationList;
	}

}
 
if (!array_key_exists('HTTP_ORIGIN', $_SERVER)) {
    $_SERVER['HTTP_ORIGIN'] = $_SERVER['SERVER_NAME'];
}

try {
    $API = new FuelAPI($_REQUEST['request'], $_SERVER['HTTP_ORIGIN']);
    ob_start('ob_gzhandler');
    echo $API->processAPI();
} catch (Exception $e) {
    echo json_encode(Array('error' => $e->getMessage()));
}
?>