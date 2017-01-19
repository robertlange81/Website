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

	 if($_POST['theme'] == "home" || $_POST['theme'] == "start") {
	 	print("<div id='home_text'>");
	 }	 
	 
	 if(mysql_num_rows($article) >=1) {
	 	while($aktZeile = mysql_fetch_assoc($article)){
	 		echo $aktZeile['article'];
	 	}
	 } 
	 
	 if($_POST['theme'] == "home" || $_POST['theme'] == "start") {
	 	print("</div>");
	 }	 
}
 
placeContent($_POST['theme'], $_POST['lang']);
if($_POST['theme'] == "blog") 
{
	print("<div id='blogging'>");
	 /*$blogs = mysql_query("select * from `Blog` where true");
	 if(mysql_num_rows($blogs) >=1) {
	 	
	 	while($aktZeile = mysql_fetch_assoc($blogs)){
	 		print("<br /><div id='what'>"); echo $aktZeile['ENTRY']; printf("</div>");
	 		print("<div id='who'>"); echo "gepostet von "; echo $aktZeile['BLOGGER']; echo " am ";echo $aktZeile['INPUTDATE']; printf("</div>");
	 	}

	 } 
	 print("<br />");
	 	 print("<textarea style='width:95%;height:100px' id='ENTRY'>");
	 if($_POST['lang'] == 'de'){
	 	print("Beitrag verfassen </textarea><br />");
	 } 
	 else 
	 {
	 	print("Contribute</textarea><br />");
	 }
	 print("<textarea style='width:15%;height:25px' id='BLOGGER'>Username</textarea> ");
	 print("<input class='button' type='button'><br />");
	 
	 print("<textarea style='width:150px;height:50px'  id='BLOGGER' value='NAME'>Username</textarea>");
    */
    print("<iframe src='wordpress/index.php' width='100%' height='500px' name='wordpress_blog'>");
	 print("</div>");
}

?>