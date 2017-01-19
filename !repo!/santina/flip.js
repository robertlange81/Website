var focusPage;  
var isLoading = false;
var lastId = "";

  function slideTo(id) 
  {
  	 	
  		if(focusPage == null) {
   		document.getElementById('Startseite').className = "page stage-right";
   		document.getElementById('Klangmassage').className = "page stage-right";
   		document.getElementById('Musiktherapie').className = "page stage-right";
		document.getElementById('Preise').className = "page stage-right";
		document.getElementById('Kommentare').className = "page stage-right";
   		document.getElementById('Kontakt').className = "page stage-right";   
   		document.getElementById('Ich').className = "page stage-right";	
   		document.getElementById('Impressum').className = "page stage-right";	
  			focusPage = document.getElementById('Startseite');
  		}
  				
  		if(focusPage != document.getElementById(id) || lastId == "" ) {
  		lastId = id; 
  		document.getElementById(id).style.opacity = 0; 
  		document.location.hash = id;
  		  /* alte Seite */
  		  $( focusPage ).animate({
    				opacity: 0
  				}, 100, function() {
    			// alte Seite wurde ausgeblendet - jetzt versteckt
    			focusPage.className = 'page transition stage-right';    			
        		/* neue Seite */
        		focusPage = document.getElementById(id);       
        		focusPage.className = 'page transition stage-center';  
        		$( focusPage ).animate({
    				opacity: 1
  				}, 100, function() {
  						 // neue Seite wurde eingeblendet 
  				});              
        		scrollToTop();     		
  		  });
       } 
       else 
       {       		
       	/* schadet nicht
        		$( focusPage ).animate({
    				opacity: 1
  				}, 300, function() {
  						 // neue Seite wurde eingeblendet 
  				}); */
       }
       
     /* beim ersten Laden ist wrapper noch nicht sichtbar */
  		$(document).ready(function() {
  			if(document.getElementById('wrapper').style.display != "inline"){  		 	   
				document.getElementById('wrapper').style.display="inline"; 
				focusPage.style.opacity = 0;
			}   
		}); 
   }
   
   function scrollToTop() {
   $('document').ready(function() {
   $(window).scrollTop(0);
});
};
   
   function changeActiveNav(id){
   	try {
   		document.getElementById('Start').className = "";
   		document.getElementById('Klang').className = "";
   		document.getElementById('Musik').className = ""; 
   		document.getElementById('Pre').className = "";
		document.getElementById('Komm').className = "";
   		document.getElementById('Kon').className = "";   
   		document.getElementById('Ueb').className = "";	
   		document.getElementById('Imp').className = "";	
   		
        } catch (e) {
          /* alert(e); */
        }
        document.getElementById(id).className = "active";
   }
      
   var anker = "";
	function locationHashChanged() {
	 		
	 		if(anker != document.location.hash) {
	 			anker = document.location.hash;
				switch (anker){
					case "#Startseite": slideTo('Startseite'); changeActiveNav('Start'); /* showSidebar() */;break;
					case "#Klangmassage": slideTo('Klangmassage'); changeActiveNav('Klang'); break;
					case "#Musiktherapie": slideTo('Musiktherapie'); changeActiveNav('Musik');break;
					case "#Preise": slideTo('Preise'); changeActiveNav('Pre'); break;
					case "#Kommentare": slideTo('Kommentare'); changeActiveNav('Komm'); break;
					case "#Kontakt": slideTo('Kontakt'); changeActiveNav('Kon');break;
					case "#Ich": slideTo('Ich'); changeActiveNav('Ueb');break;
					case "#Impressum": slideTo('Impressum'); changeActiveNav('Imp');break;
					default  : slideTo('Startseite');changeActiveNav('Start');
				}
			}
			else 
			{
				if(anker == "") 
				{
					if(document.getElementById('Startseite')) {
						slideTo('Startseite'); 
						changeActiveNav('Start');
						document.getElementById('Startseite').style.opacity = 1;
					}
				}
			}
		}
		
  function play(sound) {
    if (window.HTMLAudioElement) {
      var snd = new Audio('');
       
      if(snd.canPlayType('audio/ogg')) {
        snd = new Audio('sounds/' + sound + '.ogg');
      }
      else if(snd.canPlayType('audio/mp3')) {
        snd = new Audio('sounds/' + sound + '.mp3');
      }
       
      snd.play();
    }
 }
 
  			function showSidebar() {				
				if(window.innerWidth > 300 && window.innerHeight > 200) {  /* 900 / 600 */
					$("#sidebar").animate({marginTop:'100px'}, 1300, 'swing'); /* 275 */
				}
							
			}
			
  			function hideSideBar() {				
				if(window.innerWidth > 300 && window.innerHeight > 200) {  /* 900 / 600 */
					$("#sidebar").animate({marginTop:'2000px'}, 1000, 'swing');
				}
							
			}			
			
			
 		
window.onhashchange = locationHashChanged; 	
//window.onload = locationHashChanged; 

window.onload = function() {
  locationHashChanged();
  				play('SingingBowl1');
	//$("#sidebar").animate({marginTop:'275px'}, 1300, 'swing');
}


