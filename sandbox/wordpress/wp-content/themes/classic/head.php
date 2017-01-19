<?php session_start();
                 	if(!empty($_GET['lang'])){
                 		setcookie("lang", $_GET['lang'], time()+60*60*24*30);
                 		$lang = $_GET['lang'];
                 	} elseif (isset($_COOKIE["lang"])) {
                 		$lang = $_COOKIE["lang"];
                 	} else {
                 		setcookie("lang", 'de', time()+60*60*24*30);
                 		$lang = 'de';
                 	}
?>

<!DOCTYPE html>
<html>
    <head>
      <title>Robert Lange - Web & App - IT Services</title>
      <meta name="author" content="rober_000" />
		<meta name="keywords" content="Robert Lange, Weblication, Web, App" />
		<meta name="description" content="Auf Robert-Lange.eu finden Sie eine Auswahl an Spielen und Anwendungen f&uuml;r den PC, Tablet und Smartphone. Besuchen Sie auch meinen Blog oder informieren Sie sich &uuml;ber meine aktuellen Projekte." />
		<meta name="viewport" content="user-scalable=no, width=device-width" />
		<meta charset="utf-8" />
		<link rel="SHORTCUT ICON" href="images/favi.ico">      
		<script type="text/javascript" src="js/jquery.js"></script>
		
      <?php
      
                   /**
                   * @Robert Lange
                   * @copyright 2011
                   */ 

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

                  $style = '';
                  if(!empty($_GET['theme'])){
                  	$theme = $_GET["theme"];
                  	switch($_GET['theme']) {
                  		case "start" : printf("<script type='text/javascript'> var theme = 'home'; </script>");break;
								case "home" : printf("<script type='text/javascript'> var theme = 'home'; </script>");break;
								case "apps" : printf("<script type='text/javascript'> var theme = 'apps'; </script>");break;
								case "games" : printf("<script type='text/javascript'> var theme = 'games'; </script>");break;
								case "projects" : printf("<script type='text/javascript'> var theme = 'projects'; </script>");break;
								case "blog" : printf("<script type='text/javascript'> var theme = 'blog'; </script>");break;
							}
                 	} else {
                 			printf("<script type='text/javascript'> if(!theme) {var theme = 'home';}</script>");
                 			$theme = "home";
                 	}
                 	
						include_once("check_mobile.php");
                  if(check_mobile()) {
                          $type = check_mobile();
                          $style = 'handheld';
                          printf("<script type='text/javascript'> var style ='handheld'; </script>");
                          printf("<link rel='stylesheet' type='text/css' href='css/android.css' media='screen,projection' />");
                          printf("<script type='text/javascript' src='js/android.js'></script>");
                  } else {
                  		  
                          $os = $_SERVER['HTTP_USER_AGENT'];
                          if (strpos($os, 'Opera')!== false) {
                                 printf("<script type='text/javascript'> var style ='opera'; </script>");
                                 printf("<link rel='stylesheet' href='css/opera.css' type='text/css' media='screen,projection' /> \n\t");
                                 $style = 'opera';
                          } else {
                                 $style = 'screen';
                                 printf("<script type='text/javascript'> var style ='screen'; </script>");
                                 // printf("<link rel='stylesheet' type='text/css' href='css/android.css' media='only screen and (max-width: 480px)' />\n\t");
                                 printf("  <link rel='stylesheet' type='text/css' href='css/desktop.css' media='screen and (min-width: 481px)' /> \n");                       
                          }
                  }                  
         ?>
      <script src="js/load.js"></script>      
		<script type="text/javascript" src="js/bling.js"></script>
	 </head>

     <body onloadstart="loadPage()" onload="pageLoaded()">
     <?php include_once("analyticstracking.php") ?>
		<div id="progress">loading...</div>
			

		
		    <div id="headline">
            <?php 
            if($style != 'handheld') {
            	include ("textOptions.php"); 
            }
            ?> 
            
         <div id="googlePlus">
				<g:plusone id="gone" size="medium"></g:plusone>
         </div>  
         
         <div id="facebook">
         	<iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.robert-lange.eu&amp;layout=button_count&amp;show_faces=true&amp;width=450&amp;action=like&amp;colorscheme=light&amp;height=80" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100%; height:80px;" allowTransparency="true"></iframe>   				
			</div>       
            
            <h1><a onclick="home()" style="color:white; cursor:pointer" class="textglow"><small>&nbsp;&nbsp;&nbsp;Web & App&nbsp;&nbsp;&nbsp;</small>Robert Lange<small>&nbsp;&nbsp;&nbsp;IT-Services</small></a></h1>
            <!-- <h2>Bla</h2>
             <p>* See our new Blog</p> -->
    			</div>
		<div id="container">