<?php session_start();
						header("Access-Control-Allow-Origin: *");
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
      <?php print("<meta name='author' content='Robert Lange' />"); ?>   
		<meta name="keywords" content="Robert Lange, Weblication, Web, App" />
		<meta name="description" content="Auf Robert-Lange.eu finden Sie eine Auswahl an Spielen und Anwendungen f&uuml;r den PC, Tablet und Smartphone. Besuchen Sie auch meinen Blog oder informieren Sie sich &uuml;ber meine aktuellen Projekte." />
		<meta name="viewport" content="user-scalable=no, width=device-width" />
		<meta charset="utf-8" />
		<!--<meta http-equiv="X-Frame-Options" content="SAMEORIGIN" />-->
		<meta property="og:image" content="http://www.robert-lange.eu/images/robert_lange_middle.jpg" />
		<meta property="og:image:type" content="image/jpeg" /> 
		<meta property="og:image:width" content="400" /> 
		<meta property="og:image:height" content="300" />		
		<!--<meta property="og:url" content="http://www.robert-lange.eu" />-->
		<meta property="og:title" content="Web & App" />
		<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />      
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
                  		case "start" : printf("<script type='text/javascript'> var theme = 'home'; </script>\n\t");break;
								case "home" : printf("<script type='text/javascript'> var theme = 'home'; </script>\n\t");break;
								case "apps" : printf("<script type='text/javascript'> var theme = 'apps'; </script>\n\t");break;
								case "games" : printf("<script type='text/javascript'> var theme = 'games'; </script>\n\t");break;
								case "projects" : printf("<script type='text/javascript'> var theme = 'projects'; </script>\n\t");break;
								case "blog" : printf("<script type='text/javascript'> var theme = 'blog'; </script>\n\t");break;
							}
                 	} else {
                 			printf("<script type='text/javascript'> if(!theme) {var theme = 'home';}</script>\n\t");
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
                                 //printf("<link rel='stylesheet' type='text/css' href='css/android.css' media='only screen and (max-width: 480px)' />\n\t");
                                 printf("  <link rel='stylesheet' type='text/css' href='css/desktop.css' media='screen and (min-width: 481px)' /> \n");                       
                          }
                  }                  
         ?>
		<!--[if lte IE 8]>
    			<style type='text/css'>
    				#oldBrowser{display:inline;} 
    				#headline{display:none;}
    				#container{display:none;}
    				#progress{display:none;}
    			</style>
    	<![endif]-->
	 </head>

     <body onloadstart="loadPage()" onload="pageLoaded()" >
     <?php include_once("analyticstracking.php") ?>
		<div id="progress">loading...</div>			

			 <div id="oldBrowser"><a href="http://windows.microsoft.com/de-DE/internet-explorer/download-ie">Browser veraltet, bitte updaten</a></div>
<div id="container">	
		    
		    <div id="headline">
		    <!--
		   <div id="googlePlus">
				<g:plusone id="gone" size="medium"></g:plusone>
         </div>  
         
         <div id="facebook">
         	<iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.robert-lange.eu&amp;layout=button_count&amp;show_faces=true&amp;width=450&amp;action=like&amp;colorscheme=light&amp;height=80" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100%; height:80px;" allowTransparency="true"></iframe>   				
			</div> 
			--> 
		    <aside>
                		<nav>
                		
                		  <div>
								
									
											<script type="text/javascript" >
											
											if(style == 'handheld') {
																							
											} else {																						
												var homeButton = "<ul id='breadcrumbs'><li class='home_Button'><a onclick='home()'><img src='../images/Home_Button.png' width='120' height='78' alt='HOME' /></a></li>";
												var appsButton = "<li class='apps_Button'><a onclick='apps()'><img src='../images/apps_button.png' width='120' height='78' alt='APPS' /></a></li>"
												var gameButton = "<li class='games_Button'><a onclick='games()'><img src='../images/games_button.png' width='120' height='78' alt='GAMES' /></a></li>"
												var projButton = "<li class='projects_Button'><a onclick='projects()'><img src='../images/projects_button.png' width='120' height='78' alt='PROJECTS' /></a></li>"
												var blogButton = "<li class='blog_Button'><a onclick='blog()'><img src='../images/blog_button.png' width='120' height='78' alt='BLOG' /></a></li></ul>"
											}
											
											document.write(homeButton);
											document.write(appsButton);
											document.write(gameButton);
											document.write(projButton);
											document.write(blogButton);
											</script>
											<noscript>
												<ul id="breadcrumbs">
                  						<li class="home_Button"><a href="/index.php?theme=home"><img src="../images/Home_Button_1.png" width="126" height="70" alt="HOME" /></a></li>
                  						<li class="apps_Button"><a href="/index.php?theme=apps">&nbsp;&nbsp;Apps&nbsp;&nbsp;&nbsp;</a></li>
												<li class="games_Button"><a href="/index.php?theme=games">&nbsp;Games&nbsp;&nbsp;</a></li>
												<li class="projects_Button"><a href="/index.php?theme=projects" >Projects</a></li>
												<li class="blog_Button"><a href="/index.php?theme=blog" >&nbsp;&nbsp;Blog&nbsp;&nbsp;&nbsp;</a></li>
												</ul>											
											</noscript>
								
							  </div>
							  
							</nav>
            </aside>  
            <?php 
            	if($style != 'handheld') {
            		include ("textOptions.php"); 
            	}
            
					switch($theme) {
                  		case "start" : printf("<h1 id='navLink' class='home'>");break;
								case "home" : printf("<h1 id='navLink' class='home'>");break;
								case "apps" : printf("<h1 id='navLink' class='apps'>");break;
								case "games" : printf("<h1 id='navLink' class='games'>");break;
								case "projects" : printf("<h1 id='navLink' class='projects'>");break;
								case "blog" : printf("<h1 id='navLink' class='blog'>");break;
								default : printf("<h1 id='navLink' class='home'>");
							}
				?> 
				
            <a onclick="imprint()" style="color:white; cursor:pointer" class="textglow"><small></small></a>
         	
            
            </h1>
				
    			</div>

		