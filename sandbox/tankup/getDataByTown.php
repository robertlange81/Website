<?php
  
function placeContent($arg1, $arg2)
{
	 
	 $db_id = mysql_connect("localhost","web1162","bX2KARTc");
    if(!$db_id)
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

	 $priceRecords = null;

	 if(strpos($arg5,'preis') !== false) { 
	 		$priceRecords = mysql_query("select distinct " . $arg1 . " , a.petrolStationBrand, a.petrolStationStreet, a.petrolStationHouseNumber, a.petrolStationHouseNumber, a.petrolStationPostcode, a.petrolStationPlace, a.petrolStationVersionTime, a.longitude as AnbietGPSLaenge, a.latitude as AnbietGPSBreite, ACOS( SIN( RADIANS( a.latitude ) ) * SIN( RADIANS( '$arg3' ) ) + COS( RADIANS( a.latitude ) ) * COS( RADIANS( '$arg3' ) ) * COS( RADIANS( a.longitude ) - RADIANS( '$arg2' ) ) ) *6380 AS 'distance'
										 
	 													from ( select Max(`version`) as newest 
	 															from `fuelPrice` 
	 															group by `id` ) plNewest, 
	 														`fuelPrice` pl, `petrolStation` a
	 															where a.latitude > '$arg3' - 0.5
										 						AND a.latitude < '$arg3' + 0.5
										 						AND a.longitude > '$arg2' - 0.5
										 						AND a.longitude < '$arg2' + 0.5
										 						and pl.`version` = plNewest.newest
	 															and a.`id` = pl.`id` 	
	 															and " . $arg1 . " > 0  
	 															and a.petrolStationPlace = '$arg2' 
	 													order by '$arg1' limit 5");
    else {
    		 		$priceRecords = mysql_query("select distinct " . $arg1 . " , a.petrolStationBrand, a.petrolStationStreet, a.petrolStationHouseNumber, a.petrolStationHouseNumber, a.petrolStationPostcode, a.petrolStationPlace, a.petrolStationVersionTime, a.longitude as AnbietGPSLaenge, a.latitude as AnbietGPSBreite, ACOS( SIN( RADIANS( a.latitude ) ) * SIN( RADIANS( '$arg3' ) ) + COS( RADIANS( a.latitude ) ) * COS( RADIANS( '$arg3' ) ) * COS( RADIANS( a.longitude ) - RADIANS( '$arg2' ) ) ) *6380 AS 'distance'
										 
	 													from ( select Max(`version`) as newest 
	 															from `fuelPrice` 
	 															group by `id` ) plNewest, 
	 														`fuelPrice` pl, `petrolStation` a
	 															where a.latitude > '$arg3' - 0.5
										 						AND a.latitude < '$arg3' + 0.5
										 						AND a.longitude > '$arg2' - 0.5
										 						AND a.longitude < '$arg2' + 0.5
										 						and pl.`version` = plNewest.newest
	 															and a.`id` = pl.`id` 	
	 															and " . $arg1 . " > 0  
	 															and a.petrolStationPlace = '$arg2' 
	 													order by distance limit 5");
    }	 													
	 if(mysql_num_rows($priceRecords) >=1) {
	 	/* Tankstelle ermitteln */
	 	$v = 0;
	 	while($aktZeile = mysql_fetch_assoc($priceRecords)){
			printf("anbieter$v");	 		
	 		echo $aktZeile['AnbietBezeichnung'];
	 		switch($v) {
	 			case 0: printf("preisv");echo $aktZeile['PLPreis'];printf("lonv");echo $aktZeile['AnbietGPSLaenge'];printf("latv");echo $aktZeile['AnbietGPSBreite'];printf("strassev");echo $aktZeile['AdrStrasse'];printf("hausnrv");echo $aktZeile['AdrHausNr'];printf("plzv");echo $aktZeile['AdrPLZ'];printf("ort0");echo $aktZeile['AdrOrt'];printf("zeitv");echo $aktZeile['PLZeitpunkt'];printf("idv");echo $aktZeile['NutzerID'];break;
	 			case 1: printf("preisw");echo $aktZeile['PLPreis'];printf("lonw");echo $aktZeile['AnbietGPSLaenge'];printf("latw");echo $aktZeile['AnbietGPSBreite'];printf("strassew");echo $aktZeile['AdrStrasse'];printf("hausnrw");echo $aktZeile['AdrHausNr'];printf("plzw");echo $aktZeile['AdrPLZ'];printf("ort1");echo $aktZeile['AdrOrt'];printf("zeitw");echo $aktZeile['PLZeitpunkt'];printf("idw");echo $aktZeile['NutzerID'];break; 
	 			case 2: printf("preisx");echo $aktZeile['PLPreis'];printf("lonx");echo $aktZeile['AnbietGPSLaenge'];printf("latx");echo $aktZeile['AnbietGPSBreite'];printf("strassex");echo $aktZeile['AdrStrasse'];printf("hausnrx");echo $aktZeile['AdrHausNr'];printf("plzx");echo $aktZeile['AdrPLZ'];printf("ort2");echo $aktZeile['AdrOrt'];printf("zeitx");echo $aktZeile['PLZeitpunkt'];printf("idx");echo $aktZeile['NutzerID'];break;
	 			case 3: printf("preisy");echo $aktZeile['PLPreis'];printf("lony");echo $aktZeile['AnbietGPSLaenge'];printf("laty");echo $aktZeile['AnbietGPSBreite'];printf("strassey");echo $aktZeile['AdrStrasse'];printf("hausnry");echo $aktZeile['AdrHausNr'];printf("plzy");echo $aktZeile['AdrPLZ'];printf("ort3");echo $aktZeile['AdrOrt'];printf("zeity");echo $aktZeile['PLZeitpunkt'];printf("idy");echo $aktZeile['NutzerID'];break;
	 			case 4: printf("preisz");echo $aktZeile['PLPreis'];printf("lonz");echo $aktZeile['AnbietGPSLaenge'];printf("latz");echo $aktZeile['AnbietGPSBreite'];printf("strassez");echo $aktZeile['AdrStrasse'];printf("hausnrz");echo $aktZeile['AdrHausNr'];printf("plzz");echo $aktZeile['AdrPLZ'];printf("ort4");echo $aktZeile['AdrOrt'];printf("zeitz");echo $aktZeile['PLZeitpunkt'];printf("idz");echo $aktZeile['NutzerID'];break;
	 		}				 		
	 		
	 		$v += 1;
	 	}
	 } else {
	 	echo "keine Ergebnisse";
	 }

}
 
placeContent($_POST['art'], $_POST['town']);

?> 
