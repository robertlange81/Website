var iFrameBlogHeight = 0;
var theme = "";
var isLoading = false;


if (document.cookie.indexOf("lang") ==-1 && document.cookie.indexOf("fontSize") ==-1) {
		fontSize= "1";
  		document.cookie = 'fontSize=1;';
		lang="de";
		document.cookie = 'lang=de;';
} else {
		a = document.cookie;
		lang = a.substring(a.indexOf("lang")+5,a.indexOf("lang")+7);
		fontSize = a.substring(a.indexOf("fontSize")+9,a.indexOf("fontSize")+10);	
} 

function klein() {
   document.getElementById("content1").style.fontSize="1.0em";
   fontSize = "1";
   document.cookie = 'fontSize=1;';
}

function normal() {
   document.getElementById("content1").style.fontSize="1.2em";
   fontSize = "2";
   document.cookie = 'fontSize=2;';
}

function gross() {
   document.getElementById("content1").style.fontSize="1.4em";
   fontSize = "3";
   document.cookie = 'fontSize=3;';
}

function getFontSize(){
   return fontSize;
}

if (document.cookie.indexOf("lang") ==-1 && document.cookie.indexOf("fontSize") ==-1) {
		fontSize= "1";
  		document.cookie = 'fontSize=1;';
		lang="de";
		document.cookie = 'lang=de;';
} else {
		a = document.cookie;
		lang = a.substring(a.indexOf("lang")+5,a.indexOf("lang")+7);
		fontSize = a.substring(a.indexOf("fontSize")+9,a.indexOf("fontSize")+10);	
} 


var interval;
function loadPage() {

	if(!isLoading) {
		isLoading = true;
    	if(document.getElementById('progress')) {
    		document.getElementById('progress').style.display="inline";
    	} 
    	
    	if(document.getElementById('content1')){
    		document.getElementById('content1').style.display="none"; 
    	} 
    	else
    	{

    		<!--locationHashChanged()-->
    	}
    	  
    	if(style != "handheld" && document.getElementById('container')){
				switch (fontSize){
					case "1": document.getElementById("content1").style.fontSize="1.0em";break;
					case "2": document.getElementById("content1").style.fontSize="1.2em";break;
					case "3": document.getElementById("content1").style.fontSize="1.4em";break;
				}
		} 
		interval = window.setInterval(pageLoaded, 1000);
	}
} 

function pageLoaded() {
<!-- prmSec = 100; var eDate = null; var eMsec = 0; var sDate = new Date(); var sMsec = sDate.getTime(); do { eDate = new Date(); eMsec = eDate.getTime(); } while ((eMsec-sMsec)<prmSec);-->

    	if(style != 'handheld'){
    		document.getElementById('content1').style.display="inline"; 
    	} 
    	else
    	{

    	};    
    	document.getElementById('progress').style.display="none";
    	window.clearInterval(interval);
    	isLoading = false;
    	scrollToTop();
}

function ciao() {
	alert("ciao");	
} 

function home(){

	 loadPage();
	 document.getElementById('progress').style.backgroundImage =  "linear-gradient(blue,Midnightblue)";
	 theme = "home";
	 document.cookie = 'theme=ho;';
	 document.location.hash = 'home';
	 if (style != 'handheld') {
    $.post("teaser.php",
    {
        theme: 'home',
        lang: lang
    },
    function (data) {
		  		if(document.getElementById('teaser')) {
		  			document.getElementById('teaser').innerHTML= data;
		  		} else {

		  		}
    });
    }
    $.post("content1.php",
    {
        theme: 'home',
        lang: lang
    },
    function (data) {
		  		document.getElementById('contentArea').innerHTML= data;
    if (style == 'handheld') { 
    		document.getElementById('android').innerHTML= "Home";
    		document.getElementById("header1").className = "home";
    		toggleMenu();
 	 } else {
 	 	   document.getElementById('navLink').style.backgroundImage =  "linear-gradient(blue,Midnightblue)";
 	 }
 
    });
}

function homehash(){

	 loadPage();
	 document.getElementById('progress').style.backgroundImage =  "linear-gradient(blue,Midnightblue)";
	 theme = "home";
	 document.cookie = 'theme=ho;';
	 if (style != 'handheld') {
    $.post("teaser.php",
    {
        theme: 'home',
        lang: lang
    },
    function (data) {
		  		if(document.getElementById('teaser')) {
		  			document.getElementById('teaser').innerHTML= data;
		  		} else {

		  		}
    });
    }
    $.post("content1.php",
    {
        theme: 'home',
        lang: lang
    },
    function (data) {
		  		document.getElementById('contentArea').innerHTML= data;
    if (style == 'handheld') { 
    		document.getElementById('android').innerHTML= "Home";
    		document.getElementById("header1").className = "home";
 	 } else {
 	 	   document.getElementById('navLink').style.backgroundImage =  "linear-gradient(blue,Midnightblue)";
 	 }
 
    });
}

function apps(){
	 theme = "apps";
	 document.cookie = 'theme=ap;';
	 document.location.hash = 'apps';
	 document.getElementById('progress').style.backgroundImage =  "linear-gradient(#50BF38,green)";
	 loadPage();
	 if (style != 'handheld') {
	 $.post("teaser.php",
    {
        theme: 'apps',
        lang: lang
    },
    function (data) {
    			document.getElementById('teaser').innerHTML= data;
    });
    }
    $.post("content1.php",
    {
        theme: 'apps',
        lang: lang
    },
    function (data) {
		  		document.getElementById('contentArea').innerHTML= data;
    if (style == 'handheld') { 
    	  	document.getElementById('android').innerHTML= "Apps"; 
    	  	document.getElementById("header1").className = "apps";
    		toggleMenu();
 	 } else {
   	  	document.getElementById('navLink').style.backgroundImage =  "linear-gradient(#50BF38,green)";
 	 }

    });
}

function appshash(){
	 theme = "apps";
	 document.cookie = 'theme=ap;';
	 document.getElementById('progress').style.backgroundImage =  "linear-gradient(#50BF38,green)";
	 loadPage();
	 if (style != 'handheld') {
	 $.post("teaser.php",
    {
        theme: 'apps',
        lang: lang
    },
    function (data) {
    			document.getElementById('teaser').innerHTML= data;
    });
    }
    $.post("content1.php",
    {
        theme: 'apps',
        lang: lang
    },
    function (data) {
		  		document.getElementById('contentArea').innerHTML= data;
    if (style == 'handheld') { 
    	  	document.getElementById('android').innerHTML= "Apps"; 
    	  	document.getElementById("header1").className = "apps";
 	 } else {
   	  	document.getElementById('navLink').style.backgroundImage =  "linear-gradient(#50BF38,green)";
 	 }

    });
}


function games(){
	theme = "games";
	document.cookie = 'theme=ga;';
	document.location.hash = 'games';
	document.getElementById('progress').style.backgroundImage =  "linear-gradient(gold,#bfc835)";
	loadPage();
	if (style != 'handheld') { 
    $.post("teaser.php",
    {
        theme: 'games',
        lang: lang
    },
    function (data) {
		  		document.getElementById('teaser').innerHTML= data;
    });
    }
    $.post("content1.php",
    {
        theme: 'games',
        lang: lang
    },
    function (data) {
		  		document.getElementById('contentArea').innerHTML= data;
    if (style == 'handheld') { 
    		document.getElementById('android').innerHTML= "Games";
    		document.getElementById("header1").className = "games";
    		toggleMenu();
 	 } else {
   	  		document.getElementById('navLink').style.backgroundImage =  "linear-gradient(gold,#bfc835)";
 	 }

    });
}

function gameshash(){
	theme = "games";
	document.cookie = 'theme=ga;';
	document.getElementById('progress').style.backgroundImage =  "linear-gradient(gold,#bfc835)";
	loadPage();
	if (style != 'handheld') { 
    $.post("teaser.php",
    {
        theme: 'games',
        lang: lang
    },
    function (data) {
		  		document.getElementById('teaser').innerHTML= data;
    });
    }
    $.post("content1.php",
    {
        theme: 'games',
        lang: lang
    },
    function (data) {
		  		document.getElementById('contentArea').innerHTML= data;
    if (style == 'handheld') { 
    		document.getElementById('android').innerHTML= "Games";
    		document.getElementById("header1").className = "games";
 	 } else {
   	  		document.getElementById('navLink').style.backgroundImage =  "linear-gradient(gold,#bfc835)";
 	 }

    });
}

function projects(){
	 theme = "projects";
	 document.cookie = 'theme=pr;';
	 document.location.hash = 'projects';
	 document.getElementById('progress').style.backgroundImage =  "linear-gradient(orange,#DB9335)";
	 loadPage();
	 if (style != 'handheld') { 
    $.post("teaser.php",
    {
        theme: 'projects',
        lang: lang
    },
    function (data) {
		  		document.getElementById('teaser').innerHTML= data;
    });
    }
    $.post("content1.php",
    {
        theme: 'projects',
        lang: lang
    },
    function (data) {
		  		document.getElementById('contentArea').innerHTML= data;
    if (style == 'handheld') { 
    		document.getElementById('android').innerHTML= "Projects";
    		document.getElementById("header1").className = "projects";
    		toggleMenu();
 	 } else {
   	  		document.getElementById('navLink').style.backgroundImage =  "linear-gradient(orange,#DB9335)";
 	 }

    });
}

function projectshash(){
	 theme = "projects";
	 document.cookie = 'theme=pr;';
	 document.getElementById('progress').style.backgroundImage =  "linear-gradient(orange,#DB9335)";
	 loadPage();
	 if (style != 'handheld') { 
    $.post("teaser.php",
    {
        theme: 'projects',
        lang: lang
    },
    function (data) {
		  		document.getElementById('teaser').innerHTML= data;
    });
    }
    $.post("content1.php",
    {
        theme: 'projects',
        lang: lang
    },
    function (data) {
		  		document.getElementById('contentArea').innerHTML= data;
    if (style == 'handheld') { 
    		document.getElementById('android').innerHTML= "Projects";
    		document.getElementById("header1").className = "projects";
 	 } else {
   	  		document.getElementById('navLink').style.backgroundImage =  "linear-gradient(orange,#DB9335)";
 	 }

    });
}

function blog(){
	 theme = "blog";
	 document.cookie = 'theme=bl;';
	 document.location.hash = 'blog';
	 document.getElementById('progress').style.backgroundImage =  "linear-gradient(red,#BB3B5A)";
	 loadPage();
	 if (style != 'handheld') {
    $.post("teaser.php",
    {
        theme: 'blog',
        lang: lang
    },
    function (data) {
		  		document.getElementById('teaser').innerHTML= data;
		  		
    });
    } 
    $.post("content1.php",
    {
        theme: 'blog',
        lang: lang
    },
    function (data) {
    	if(document.getElementById('contentArea'))
		  		document.getElementById('contentArea').innerHTML= data;	  		
    if (style == 'handheld') { 
    		document.getElementById('android').innerHTML= "Blog";
    		document.getElementById("header1").className = "blog";
    		toggleMenu();
 	 } else {
   	  		document.getElementById('navLink').style.backgroundImage =  "linear-gradient(red,#BB3B5A)";
 	 };
		if(style != "handheld")
		{
			//startResizeIframeChrome();
 	 	   //startResizeIframeFirefox();	
		}
 	 	    
    });
}

function bloghash(){
	 theme = "blog";
	 document.cookie = 'theme=bl;';
	 document.getElementById('progress').style.backgroundImage =  "linear-gradient(red,#BB3B5A)";
	 loadPage();
	 if (style != 'handheld') {
    $.post("teaser.php",
    {
        theme: 'blog',
        lang: lang
    },
    function (data) {
		  		document.getElementById('teaser').innerHTML= data;
		  		
    });
    } 
    $.post("content1.php",
    {
        theme: 'blog',
        lang: lang
    },
    function (data) {
    	if(document.getElementById('contentArea'))
		  		document.getElementById('contentArea').innerHTML= data;	  		
    if (style == 'handheld') { 
    		document.getElementById('android').innerHTML= "Blog";
    		document.getElementById("header1").className = "blog";
 	 } else {
   	  		document.getElementById('navLink').style.backgroundImage =  "linear-gradient(red,#BB3B5A)";
 	 };
		if(style != "handheld")
		{
			//startResizeIframeChrome();
 	 	   //startResizeIframeFirefox();	
		}
 	 	    
    });
}

function de(){
	 lang = "de";
	 document.cookie = 'lang=de;';
	 loadPage();
	 if (style != 'handheld') {
	 $.post("teaser.php",
    {
        theme: theme,
        lang: "de"
    },
    function (data) {
		  		document.getElementById('teaser').innerHTML= data; 
    	if (style == 'handheld') { 
    			/* toggleMenu(); */
 	 	} else {
 	 		
 	 	}	 
    });
	 }    
	 $.post("content1.php",
    {
        theme: theme,
        lang: "de"
    },
    function (data) {
		  		document.getElementById('contentArea').innerHTML= data; 
		  		document.getElementById('deu').className = 'chosen'; 
		  		document.getElementById('eng').className = 'not_chosen'; 
    if (style == 'handheld') { 
    		/* toggleMenu(); */
 	 } else {

 	 }
	 
    });
}

function en(){
	 lang = "en";
	 document.cookie = 'lang=en;';
	 loadPage();
	 if (style != 'handheld') {
	 $.post("teaser.php",
    {
        theme: theme,
        lang: "en"
    },
    function (data) {
		  		document.getElementById('teaser').innerHTML= data;
    if (style == 'handheld') { 
    		/* toggleMenu(); */
 	 } else {

 	 }
    });
 	 }   
	 $.post("content1.php",
    {
        theme: theme,
        lang: "en"
    },
    function (data) {
		  		document.getElementById('contentArea').innerHTML= data;	
		  		document.getElementById('deu').className = 'not_chosen'; 
		  		document.getElementById('eng').className = 'chosen'; 
    if (style == 'handheld') { 
    		/* toggleMenu(); */
 	 } else {

 	 }

    });
}

function imprint(){
	 theme = "imprint";
	 document.cookie = 'theme=im;';
	 document.location.hash = 'imprint';
	 document.getElementById('progress').style.backgroundImage =  "linear-gradient(blue,Midnightblue)";
	 
	 if (style != 'handheld') {
    $.post("teaser.php",
    {
        theme: 'imprint',
        lang: lang
    },
    function (data) {
		  		document.getElementById('teaser').innerHTML= data;
		  		
    });
    } 
    $.post("content1.php",
    {
        theme: theme,
        lang: lang
    },
    function (data) {
				loadPage();
    	 	   document.getElementById("header1").className = "home";
		  		document.getElementById('contentArea').innerHTML= data;
		  		if (style == 'handheld') { 	  		
    	 	   	document.getElementById('android').innerHTML= "Home";
    				toggleMenu();
 	 		} else {
 					
 	 		}  	

    });
}

function imprinthash(){
	 theme = "imprint";
	 document.cookie = 'theme=im;';
	 document.getElementById('progress').style.backgroundImage =  "linear-gradient(blue,Midnightblue)";
	 
	 if (style != 'handheld') {
    $.post("teaser.php",
    {
        theme: 'imprint',
        lang: lang
    },
    function (data) {
		  		document.getElementById('teaser').innerHTML= data;
		  		
    });
    } 
    $.post("content1.php",
    {
        theme: theme,
        lang: lang
    },
    function (data) {
				loadPage();
    	 	   document.getElementById("header1").className = "home";
		  		document.getElementById('contentArea').innerHTML= data;
		  		if (style == 'handheld') { 	  		
    	 	   	document.getElementById('android').innerHTML= "Home";
 	 		} else {
 				
 	 		}  	

    });
}


locationHashChanged();


jQuery(function ($) {
    var $el = $('#headline'), 
        top = $el.offset().top;
        
    
    $(window).scroll(function () {
        var pos = $(window).scrollTop();
        
        
        if(pos >= top+42  && !$el.hasClass('fixed')) {
            $el.addClass('fixed');
        } else if (pos < top+42  && $el.hasClass('fixed')) {
            $el.removeClass('fixed');
        }
        
    });

});

function locationHashChanged() {

	 	var anker = window.location.hash;
		if(anker !=  ('#'+theme)) {	
	
				switch (anker){
					case "#home": homehash(); break;
					case "#apps": appshash(); break;
					case "#games": gameshash(); break;
					case "#projects": projectshash();break;
					case "#blog": bloghash();break;
					case "#imprint": imprinthash(); break;
					default  : home();
				}	
		}

}

window.onhashchange = locationHashChanged;

function scrollToTop() {
   $('document').ready(function() {
   $(window).scrollTop(0);
});
};



/* User Agent (Browserkennung) auf einen bestimmten Browsertyp prüfen */  
 function checkBrowserName(name){  
   var agent = navigator.userAgent.toLowerCase();  
   if (agent.indexOf(name.toLowerCase())>-1) {  
     return true;  
   }  
   return false;  
 }  
 




