<?php 


function hello($someone) { 

 $db_id = mysql_connect("localhost","web1162","bX2KARTc");
 if(!§db_id)
 {	
   die("Verbindungsaufbau ist gescheitert");
 }

 // mysql_query("use usr_web_1162_3");
 $db_sel = mysql_select_db("usr_web1162_3", $db_id);
                  
 if (!$db_sel) 
 { 
 	die ('Kann Datenbank nicht benutzen : ' . mysql_error()); 
 }
						  
 $retval[2];
 $retval[0] = "";
 $retval[1] = ""; 

 mysql_query("SET names 'utf8'");
 mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'", $db_id);
        
 $query = "select * from `usertable` where `name`like '".$someone."%';";
 $result = mysql_query($query); 
        				 
 	if(mysql_num_rows($result) >=1) {
     	while($aktZeile = mysql_fetch_assoc($result))
     	{
			$retval[1] = $aktZeile['email'] . " " . $retval[1];
		}
	}      				 
   
   $retval[0] = "Hello Du " . $someone . "!";
   
   return  $retval;
} 


$server = new SoapServer(null, 
array('uri' => "http://localhost"));
$server->addFunction("hello"); 
$server->handle(); 

?>