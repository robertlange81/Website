<?php
  
function placeContent($arg1, $arg2, $arg3, $arg4, $arg5)
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
    	$priceRecords = mysql_query("select distinct TIME_FORMAT(ot.startTimeOfPeriod,'%H:%i') as ab, TIME_FORMAT(ot.endTimeOfPeriod,'%H:%i') as bis,
    													(select CASE WHEN CURRENT_TIME BETWEEN ot.startTimeOfPeriod
																					AND ot.endTimeOfPeriod
																	then 1
																	else 0
																	end
															) as open,
    													" . $arg1 . " , a.id, a.petrolStationBrand, a.petrolStationStreet, a.petrolStationHouseNumber, a.petrolStationPostcode, a.petrolStationPlace, a.petrolStationVersionTime, a.longitude as AnbietGPSLaenge, a.latitude as AnbietGPSBreite, ACOS( SIN( RADIANS( a.latitude ) ) * SIN( RADIANS( '$arg3' ) ) + COS( RADIANS( a.latitude ) ) * COS( RADIANS( '$arg3' ) ) * COS( RADIANS( a.longitude ) - RADIANS( '$arg2' ) ) ) *6380 AS 'distance'
										 
	 													from ( select Max(`version`) as newest 
	 															from `fuelPrice` 
	 															group by `id` ) plNewest, 
	 														`fuelPrice` pl, `petrolStation` a, `openingTimes` ot
	 															where a.latitude > '$arg3' - 0.5
										 						AND a.latitude < '$arg3' + 0.5
										 						AND a.longitude > '$arg2' - 0.5
										 						AND a.longitude < '$arg2' + 0.5
										 						and pl.`version` = plNewest.newest
	 															and a.`id` = pl.`id` 
																and ot.applicableDay = (SELECT DAYNAME( CURDATE( ) ) )
																and ot.fid = a.id
	 															and " . $arg1 . " > 0 	
	 															having distance < '$arg4' 
	 															order by $arg1, distance limit 5");
	 															
	 } else if(strpos($arg5,'distanz') !== false){
    	$priceRecords = mysql_query("select distinct ot.startTimeOfPeriod as Ab, ot.endTimeOfPeriod as Bis,
    													(select CASE WHEN CURRENT_TIME BETWEEN ot.startTimeOfPeriod
																					AND ot.endTimeOfPeriod
																	then 1
																	else 0
																	end
															) as open,
    													" . $arg1 . " , a.id, a.petrolStationBrand, a.petrolStationStreet, a.petrolStationHouseNumber, a.petrolStationPostcode, a.petrolStationPlace, a.petrolStationVersionTime, a.longitude as AnbietGPSLaenge, a.latitude as AnbietGPSBreite, ACOS( SIN( RADIANS( a.latitude ) ) * SIN( RADIANS( '$arg3' ) ) + COS( RADIANS( a.latitude ) ) * COS( RADIANS( '$arg3' ) ) * COS( RADIANS( a.longitude ) - RADIANS( '$arg2' ) ) ) *6380 AS 'distance'
										 
	 													from ( select Max(`version`) as newest 
	 															from `fuelPrice` 
	 															group by `id` ) plNewest, 
	 														`fuelPrice` pl, `petrolStation` a, `openingTimes` ot
	 															where a.latitude > '$arg3' - 0.5
										 						AND a.latitude < '$arg3' + 0.5
										 						AND a.longitude > '$arg2' - 0.5
										 						AND a.longitude < '$arg2' + 0.5
										 						and pl.`version` = plNewest.newest
	 															and a.`id` = pl.`id` 
																and ot.applicableDay = (SELECT DAYNAME( CURDATE( ) ) )
																and ot.fid = a.id
	 															and " . $arg1 . " > 0 	
	 															having distance < '$arg4'
	 															order by distance limit 5");	 	
	 }
	 if(mysql_num_rows($priceRecords) >=1) {
	 	
	 	/* Tankstelle ermitteln */
	 	$v = 0;
	 	while($aktZeile = mysql_fetch_assoc($priceRecords)){
			printf("anbieter$v");	 		
	 		echo $aktZeile['petrolStationBrand'];
	 		switch($v) {
	 			case 0: printf("offenv");echo $aktZeile["open"];printf("offenAbv");echo $aktZeile["ab"];printf("offenBisv");echo $aktZeile["bis"];printf("preisv");echo $aktZeile[$arg1];printf("lonv");echo $aktZeile['AnbietGPSLaenge'];printf("latv");echo $aktZeile['AnbietGPSBreite'];printf("strassev");echo $aktZeile['petrolStationStreet'];printf("hausnrv");echo $aktZeile['petrolStationHouseNumber'];printf("plzv");echo $aktZeile['petrolStationPostcode'];printf("ort0");echo $aktZeile['petrolStationPlace'];printf("disv");echo $aktZeile['distance'];printf("zeitv");echo $aktZeile['petrolStationVersionTime'];printf("idv");echo $aktZeile['id'];break;
	 			case 1: printf("offenw");echo $aktZeile["open"];printf("offenAbw");echo $aktZeile["ab"];printf("offenBisw");echo $aktZeile["bis"];printf("preisw");echo $aktZeile[$arg1];printf("lonw");echo $aktZeile['AnbietGPSLaenge'];printf("latw");echo $aktZeile['AnbietGPSBreite'];printf("strassew");echo $aktZeile['petrolStationStreet'];printf("hausnrw");echo $aktZeile['petrolStationHouseNumber'];printf("plzw");echo $aktZeile['petrolStationPostcode'];printf("ort1");echo $aktZeile['petrolStationPlace'];printf("disw");echo $aktZeile['distance'];printf("zeitw");echo $aktZeile['petrolStationVersionTime'];printf("idw");echo $aktZeile['id'];break; 
	 			case 2: printf("offenx");echo $aktZeile["open"];printf("offenAbx");echo $aktZeile["ab"];printf("offenBisx");echo $aktZeile["bis"];printf("preisx");echo $aktZeile[$arg1];printf("lonx");echo $aktZeile['AnbietGPSLaenge'];printf("latx");echo $aktZeile['AnbietGPSBreite'];printf("strassex");echo $aktZeile['petrolStationStreet'];printf("hausnrx");echo $aktZeile['petrolStationHouseNumber'];printf("plzx");echo $aktZeile['petrolStationPostcode'];printf("ort2");echo $aktZeile['petrolStationPlace'];printf("disx");echo $aktZeile['distance'];printf("zeitx");echo $aktZeile['petrolStationVersionTime'];printf("idx");echo $aktZeile['id'];break;
	 			case 3: printf("offeny");echo $aktZeile["open"];printf("offenAby");echo $aktZeile["ab"];printf("offenBisy");echo $aktZeile["bis"];printf("preisy");echo $aktZeile[$arg1];printf("lony");echo $aktZeile['AnbietGPSLaenge'];printf("laty");echo $aktZeile['AnbietGPSBreite'];printf("strassey");echo $aktZeile['petrolStationStreet'];printf("hausnry");echo $aktZeile['petrolStationHouseNumber'];printf("plzy");echo $aktZeile['petrolStationPostcode'];printf("ort3");echo $aktZeile['petrolStationPlace'];printf("disy");echo $aktZeile['distance'];printf("zeity");echo $aktZeile['petrolStationVersionTime'];printf("idy");echo $aktZeile['id'];break;
	 			case 4: printf("offenz");echo $aktZeile["open"];printf("offenAbz");echo $aktZeile["ab"];printf("offenBisz");echo $aktZeile["bis"];printf("preisz");echo $aktZeile[$arg1];printf("lonz");echo $aktZeile['AnbietGPSLaenge'];printf("latz");echo $aktZeile['AnbietGPSBreite'];printf("strassez");echo $aktZeile['petrolStationStreet'];printf("hausnrz");echo $aktZeile['petrolStationHouseNumber'];printf("plzz");echo $aktZeile['petrolStationPostcode'];printf("ort4");echo $aktZeile['petrolStationPlace'];printf("disz");echo $aktZeile['distance'];printf("zeitz");echo $aktZeile['petrolStationVersionTime'];printf("idz");echo $aktZeile['id'];break;
	 		}				 		
	 		
	 		$v += 1;
	 	}
	 } else {
	 	echo "Keine Ergebnisse";
	 }
}
 
placeContent($_POST['art'], $_POST['longitude'], $_POST['latitude'], $_POST['umkreis'], $_POST['sortieren']);

?> 
