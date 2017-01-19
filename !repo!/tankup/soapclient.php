<?php 
require_once 'classes.php';

class SoapClientDispatcher {
	
	public $client;
	public function __construct() {

		if($client == null) {
   		$client = new SoapClient(
   			"http://sparesprit.de/sprit.wsdl", array(
      		'location' => "http://sparesprit.de/soapserver.php",
      		'uri'      => "http://localhost",
      		'trace'    => 1 ));
    	}
      
      return $client;
   }
   
   public function GetCoordsByTown($town) {
   		try{
    			$response = $this->__construct()->__soapCall("getCoordsByTown", array(new GetCoordsByTownRequest($town))); 	
				return $response->location;
			} catch (Exception $e) {
				// Umwandlung Soap-Exception zu HTTP
   			return $e;
			}	
   }
   
  public function GetTownByCoords(location $coords) {
   		try{
    			$response = $this->__construct()->__soapCall("getTownByCoords", array(new GetTownByCoordsRequest($coords))); 			 			
				return $response->town;
			} catch (Exception $e) {
				// Umwandlung Soap-Exception zu HTTP
   			return $e;
			}	
   }   
   
  public function GetDataByCoords($article, $distance, $sortBy, location $coords) {
   		try{
   			$log = new Logging();
   				$log->lfile('/var/www/web1162/html/tankUp/log_debug.txt');
	$log->lwrite($article.$distance.$sortBy.$coords->latitude.$coords->longitude);
	$log->lclose();
				$param = new GetDataByCoordsRequest($article, $distance, $coords,$sortBy);	
    			$response = $this->__construct()->__soapCall("getDataByCoords", array($param)); 			 			
				return $response->petrolStation;
			} catch (Exception $e) {
				// Umwandlung Soap-Exception zu HTTP
   			return $e;
			}	
   }     

	/*
   echo("\nReturning value of __soapCall() call: ".$return);

   echo("\nDumping request headers:\n" .$client->__getLastRequestHeaders());

   echo("\nDumping request:\n".$client->__getLastRequest());

   echo("\nDumping response headers:\n" .$client->__getLastResponseHeaders());

   echo("\nDumping response:\n".$client->__getLastResponse());
   */ 
 }
?>