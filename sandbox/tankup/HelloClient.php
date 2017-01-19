<?php 

   $client = new SoapClient(null, array(
      'location' => "http://sparesprit.de/HelloServer.php",
      'uri'      => "http://localhost",
      'trace'    => 1 ));

   $return = $client->__soapCall("hello",array("robert"));
   echo("\nReturning value of __soapCall() call: ".$return);

   echo("\nDumping request headers:\n" 
      .$client->__getLastRequestHeaders());

   echo("\nDumping request:\n".$client->__getLastRequest());

   echo("\nDumping response headers:\n"
      .$client->__getLastResponseHeaders());

   echo("\nDumping response:\n".$client->__getLastResponse());
?>