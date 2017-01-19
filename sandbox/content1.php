<?php
 
// eine beliebige PHP-Funktion 
function placeContent($arg1, $arg2)
{
	 
	 $db_id = mysql_connect("localhost","web1162","bX2KARTc");
    if(!§db_id)
    {	
        die("Verbindungsaufbau ist gescheitert");
    }

    // mysql_query("use usr_web_1162_2");
    $db_sel = mysql_select_db("usr_web1162_2", $db_id);
    if (!$db_sel) { 
		die ('Kann Datenbank nicht benutzen : ' . mysql_error()); 
	 }
	 
	 mysql_query("SET names 'utf8'");
    mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'", $db_id);

    $article = mysql_query("select * from `content` where `theme` = '$arg1' and `lang` = '$arg2'");

	 if($_POST['theme'] == "apps") {
	 	print("<div id='apps_text'>");
	 }	 
	 
	 if(mysql_num_rows($article) >=1) {
	 	while($aktZeile = mysql_fetch_assoc($article)){
	 		echo $aktZeile['article'];
	 	}
	 } 
	 
	 if($_POST['theme'] == "apps") {
	 	print("</div>");
	 }	 
}
 
placeContent($_POST['theme'], $_POST['lang']);
if($_POST['theme'] == "blog") 
{
	print("<div id='blogging'>");
	    define('WP_USE_THEMES', true);
    	 
	include ('wordpress/wp-blog-header.php');
	include ('wordpress/index.php'); 


}
?> 
