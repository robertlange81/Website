
if (style == 'handheld') { 
    $(document).ready(function(){
        /*$('aside ul').addClass('hide'); */
        $('header').append('<div class="leftButton" onclick="toggleMenu()">Menu</div>');
        if(theme == null || theme == "" || theme == "start" || theme == "home"){        	
        	//toggleMenu();
        }
    }); 
}
    var menu = false;
    var content = false;
    function toggleMenu() {
    	
    	  if(true) {
    	  		var elStyle = document.getElementById("content1").style;
		  		if(elStyle.display == "inline"){
		  			document.getElementById("content1").style.display = "none";
		  		} else {
		  			document.getElementById("content1").style.display = "inline";
		  		}

        		$('aside ul').toggleClass('hide'); 
        		$('header .leftButton').toggleClass('pressed');
     		}
      }


