<?php
echo "FuelApi";

// This is the API, 2 possibilities: show the app list or show a specific app by id.
// This would normally be pulled from a database but for demo purposes, I will be hardcoding the return values.

function get_fuelprice_by_id($stationid, $fuelid)
{
	
  $app_info = array("price" => 1.44); 
   
  return $app_info;
}

// funktion kann nicht ueberladen werden
function get_station_by_loc($lon, $lat)
{
  //normally this info would be pulled from a database.
  //build JSON array
	$station_list = array(
		"stations" => array(
			array("name" => "Aral")
		)
	);
  return $station_list;
}

$possible_url = array("get_app_list", "get_app");

$value = "An error has occurred";

if (isset($_GET["action"]))
{
  switch ($_GET["action"])
    {
      case "get_station_by_loc":
        if (isset($_GET["lon"]) && isset($_GET["lat"]))
          $value = get_station_by_loc($_GET["lon"], $_GET["lat"]);
        else
          $value = "Missing argument lon, lan";
        break;
      case "get_fuelprice_by_id":
        if (isset($_GET["stationid"]) && isset($_GET["fuelid"]))
          $value = get_fuelprice_by_id($_GET["stationid"], $_GET["fuelid"]);
        else
          $value = "Missing argument";
        break;
    }
}

//return JSON array
exit(json_encode($value));
?>