$(document).ready(function(){
  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top -58
      }, 700, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });

  $(window).scroll(function() {
    $(".slideanim").each(function(){
      var pos = $(this).offset().top;

      var winTop = $(window).scrollTop();
        if (pos < winTop + 600) {
          $(this).addClass("slide");
        }
    });
  });
  
 $(function(){ 
     var navMain = $(".navbar-collapse");
     navMain.on("click", "a", null, function (e) {
         if(e.target.className != "dropdown-toggle") {
            navMain.collapse('hide'); 
         }
     });
 });  
 
    $('#auswahlModal').bind('hidden.bs.modal', function () {
      $("html").css("margin-left", "0px");
    });
    $('#auswahlModal').bind('show.bs.modal', function () {
      $("html").css("margin-left", "16px");
    }); 
        
    $("#contactform").submit(function(e)
    {
        e.preventDefault(); 
        $( ".alert-danger" ).hide();
        $( ".alert-success" ).hide();        

        if($('#contactform')[0].checkValidity() === false) {
            $( "#alert-danger-text" ).text("Bitte prüfen Sie Ihre Eingaben.");
            $( ".alert-danger" ).show();
            return;
        }
        var postData = $(this).serializeArray();
        var formURL = $(this).attr("action");
        $.ajax(
        {
            url : formURL,
            type: "POST",
            data : postData,
            success:function(data, textStatus, jqXHR) 
            {
                var res = $.parseJSON(data);
                if(res.success == true) {
                    $( "#alert-success-text" ).text(res.msg);
                    $( ".alert-success" ).show(200);  
                    
                    $( "#name" ).val('');  
                    $( "#email" ).val('');  
                    $( "#text" ).val('');  
                } else {
                    $( "#alert-danger-text" ).text(res.msg);
                    $( ".alert-danger" ).show(200);                        
                }
            },
            error: function(jqXHR, textStatus, errorThrown) 
            {
                $( "#alert-danger-text" ).text("Ihrer Anfrage kann derzeit nicht versendet werden. Bitte kontaktieren Sie uns telefonisch unter 0176 35 76 0004.");
                $( ".alert-danger" ).show();    
            }
        });
    });
    
    $('.alert .close').on('click', function(e) {
        $(this).parent().hide();
    });  
    
    $.datetimepicker.setLocale('de');
    jQuery('#datePicker').datetimepicker({
     i18n:{
      de:{
       months:[
        'Januar','Februar','März','April',
        'Mai','Juni','Juli','August',
        'September','Oktober','November','Dezember',
       ],
       dayOfWeek:[
        "So.", "Mo", "Di", "Mi", 
        "Do", "Fr", "Sa.",
       ]
      }
     },   
     disabledDates: ['01.01.2017','15.02.2017'],  
     timepicker:false,
     format:'d.m.Y',
     defaultDate:'+1970/01/02',
     startDate:'+1970/01/02',
     minDate:'+1970/01/02',
     maxDate:'+1970/03/02',
    });
    
    jQuery('#timePicker').datetimepicker({
     datepicker: false,
     allowTimes:['07:00','07:30','08:00','08:30','09:00','09:30','10:00','10:30', '11:00','11:30','12:00','12:30','13:00','13:30','14:00','14:30','15:00','15:30','16:00','16:30','17:00','17:30','18:00','18:30','19:00','19:30','20:00','20:30','21:00','21:30', '22:00','22:30','23:00','23:30','24:00'],
     defaultTime:'17:00',
     format:'H:i',
     step: 30
    });
})


