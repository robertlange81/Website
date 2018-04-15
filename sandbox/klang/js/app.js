(function() {
  var app = angular.module('klangmassage', []);

  app.controller('TabController', function(){
    this.tab = 'klangmassage';

    this.setTab = function(newValue){
      if(!newValue.includes('submenu') && newValue !== "mt" && newValue !== "km" && newValue !== "gb" && newValue !== "pr") {
          $('.navbar-toggle:visible').click();
      } else if(newValue === "km") {
          newValue = 'klangmassage';
      } else if(newValue === "mt") {
          newValue = 'musiktherapie';
      } else if(newValue === "gb") {
          newValue = "gaestebuch";
      } else if(newValue === "pr") {
          newValue = "preise";
      } else {
          return;
      }
      this.tab = newValue;
    };

    this.isSet = function(tabName){
        return this.tab === tabName;
    };
  });
  
  app.controller('ContactController',  ['$http', function($http){
    this.contact = {};
    this.president = {};
    this.showInvalidEmail = false;
    this.textReplace = " eine Schnupperstunde ";
    
    this.addContact = function() {  

            var data = JSON.stringify({type:this.contact.type, text:this.contact.text, email:this.contact.email});
        
            var config = {
                headers : {
                    'Content-Type': 'application/json;charset=utf-8;',
                    'Access-Control-Allow-Origin': '*'
                }
            }
            
            if(this.contact.president.indexOf('teinmeier') >=0) {
                $http.post('https://www.klangmassage-le.de/api/Mail.php?request=sendKlangmassage', data, config)                
                .then(
                    function(response){
                        $( "#alert-success-text" ).text("Email erfolgreich versendet.");
                        $( ".alert-success" ).show(200);                       
                    }, 
                    function(response){
                        $( "#alert-danger-text" ).text("Unbekannter Fehler beim Senden der Mail. Bitte nutzen Sie Ihren eigenen Mail-Client.");
                        $( ".alert-danger" ).show(200); 
                    }
                );        
                this.contact;
                this.contact = {};
            } else {
                    $( "#alert-danger-text" ).text("Leider falsch, versuchen Sie es bitte nochmal oder nutzen Sie Ihren eigenen E-Mail-Account.");                    
                    $( ".alert-danger" ).show(200);            
                    this.contact.president = 'Leider falsch. Wie heißt der Bundespräsident?';
            }
    };  
    this.changeType = function(val) {
        if(val !== undefined)
            this.contact.type = val;
        switch(this.contact.type){
            case "Schnupperstunde":
                this.contact.text = "Hallo,\n\nich habe Interesse an einer Schnupperstunde. Bitte kontaktieren Sie mich unter der u.g. Mail-Adresse.\n\nMfG ...";
                break;
            case "1 Klangmassage":
                this.contact.text = "Hallo,\n\nich habe Interesse an einer Klangmassage. Bitte kontaktieren Sie mich unter der u.g. Mail-Adresse.\n\nMfG ...";
                break;
            case "Klangmassage 3er-Pack":
                this.contact.text = "Hallo,\n\nich habe Interesse an einem 3er-Pack Klangmassage. Bitte kontaktieren Sie mich unter der u.g. Mail-Adresse.\n\nMfG ...";
                break;                
            case "Klangmassage 6er-Pack":
                this.contact.text = "Hallo,\n\nich habe Interesse an einem 6er-Pack Klangmassage. Bitte kontaktieren Sie mich unter der u.g. Mail-Adresse.\n\nMfG ...";
                break;                
            case "Gutschein(e)":
                this.contact.text = "Hallo,\n\nich habe Interesse an Klangmassage-Gutscheinen. Bitte kontaktieren Sie mich unter der u.g. Mail-Adresse.\n\nMfG ...";
                break;                
        }
    };  
    this.trySubmit = function() {
      if(contactForm.$valid) {
          this.showInvalidEmail = false;
      } else {
          if($('#contactEmail').val() === "") {
            this.showInvalidEmail = true;
            $('#contactEmail').removeClass('ng-pristine');
            $('#contactEmail').removeClass('ng-empty');
            $('#contactEmail').addClass('ng-dirty');
          }
          if($('#contactType').val() === "") {
            this.showInvalidEmail = true;
            $('#contactType').removeClass('ng-pristine');
            $('#contactType').removeClass('ng-empty');
            $('#contactType').addClass('ng-dirty');
          }          
          if($('#contactPresident').val() === "") {
            this.showInvalidEmail = true;
            $('#contactPresident').removeClass('ng-pristine');
            $('#contactPresident').removeClass('ng-empty');
            $('#contactPresident').addClass('ng-dirty');
          }          
      }         
    };  
  }]);  
  
  app.controller('ReviewController', ['$http', function($http) {
    var instance = this;
          
    this.review  = {};
    instance.reviews = [];
            
    $http.get('comments.json', 
        {header : {'Content-Type' : 'application/json; charset=UTF-8'}})
                
        .then(function(response) {
        if(response.data.content !== undefined) {
            instance.reviews = response.data.content;            
        }
    });
    
    this.postReviews = function() { 
            $.each(this.reviews, function(index, value) {
                delete value.$$hashKey;
            });
            var data = JSON.stringify({content:this.reviews});
            $http.post('https://www.klangmassage-le.de/api/Mail.php?request=Guestbook', data
                    , {'contentType' : 'application/json', 'dataType': 'json'}) 
            
            .then(
                function(response){
                  
                }, 
                function(response){

                }
            );  
    }; 
    
    this.addReview = function() { 
      this.reviews.push(this.review);
      this.postReviews();
      this.review = {};
    };    

    this.trySubmit = function() {
      if(!reviewForm.$valid) {
          if($('#reviewAuthor').val() === "") {
            this.showInvalidEmail = true;
            $('#reviewAuthor').removeClass('ng-pristine');
            $('#reviewAuthor').removeClass('ng-empty');
            $('#reviewAuthor').addClass('ng-dirty');
          }
          if($('#reviewBody').val() === "") {
            this.showInvalidEmail = true;
            $('#reviewBody').removeClass('ng-pristine');
            $('#reviewBody').removeClass('ng-empty');
            $('#reviewBody').addClass('ng-dirty');
          }          
      }         
    };     
      
  }]);   
})();