<html>
 <body>

	<?php

  	$url="http://www.sparesprit.de/rest_api.php?action=get_fuelprice_by_id&stationid=1&fuelid=1";
  
		//  Initiate curl
		$ch = curl_init();
		// Disable SSL verification
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		// Will return the response, if false it print the response
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// Set the url
		curl_setopt($ch, CURLOPT_URL,$url);
		// Execute
		$jsondata=curl_exec($ch);
		curl_close($ch);
		echo($jsondata);
	?>

	<script>
   	var arr;
    	arr = <?php echo json_encode(json_decode($jsondata,TRUE)); ?>;
    	alert(arr.price);
    	arr = <?php echo $jsondata; ?>;
    	alert(arr.price);    	
	</script>
  
 </body>
</html>