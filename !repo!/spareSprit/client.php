<?php 

   $client = new SoapClient(
   	"http://sparesprit.de/sprit.wsdl", array(
      'location' => "http://sparesprit.de/server.php",
      'uri'      => "http://localhost",
      'trace'    => 1 ));

try{
$result = $client->__soapCall("getCoordsByTown", array( 
        "town" => "Leipzig"        
    )); 

//echo $result;
echo gettype($result);

} catch (Exception $e) {
    echo 'Exception abgefangen: ',  $e->getMessage(), "\n";
}

   echo("\nReturning value of __soapCall() call: ".$return);

   echo("\nDumping request headers:\n" 
      .$client->__getLastRequestHeaders());

   echo("\nDumping request:\n".$client->__getLastRequest());

   echo("\nDumping response headers:\n"
      .$client->__getLastResponseHeaders());

   echo("\nDumping response:\n".$client->__getLastResponse());
?>