
<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;

use Cake\Mailer\Email;

$this->layout = false;


try {
    /*
Email::configTransport('gmail', [
    'host' => 'ssl://smtp.gmail.com',
    'port' => 465,
    'username' => 'robert.lange.81@gmail.com',
    'password' => 'Robibert17',
    'className' => 'Smtp'
]);   */
    
    /*
    $email = new Email('gmail');
    $email->from(['robert.lange.81@gmail.com' => 'MySite'])
    ->to('amtsschimmel-le@web.de')
    ->subject('About')
    ->send('Mymessage');
*/
  
} catch (Exception $ex) {
    echo $ex;
}



?>
<!DOCTYPE html>
<html lang="de">
<head>
    <?= $this->Html->charset() ?>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('amt.css') ?>    
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title>Amtshilfe Leipzig</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
  body {
      font: 400 15px Lato, sans-serif;
      line-height: 1.8;
      color: #818181;
  }
  h2 {
      font-size: 24px;
      text-transform: uppercase;
      color: #303030;
      font-weight: 600;
      margin-bottom: 30px;
  }
  h4 {
      font-size: 19px;
      line-height: 1.375em;
      color: #303030;
      font-weight: 400;
      margin-bottom: 30px;
  }  
  .jumbotron {
      background-color: #413131;
      color: #fff;
      padding: 100px 25px;
      font-family: Montserrat, sans-serif;
  }
  .high {
      padding: 50px 60px 20px 50px;
  }
  .bg-grey {
      background-color: #f6f6f6;
  }
  .logo-small {
      color: #413131;
      font-size: 50px;
  }
  .logo {
      color: #413131;
      font-size: 200px;
  }
  .carousel-control.right, .carousel-control.left {
      background-image: none;
      color: #413131;
  }
    .carousel-indicators {
        bottom: -10px !important;
    }  
  .carousel-indicators li {
      border-color: #413131;
  }
  .carousel-indicators li.active {
      background-color: #413131;
  }
  .item h4 {
      font-size: 19px;
      line-height: 1.375em;
      font-weight: 400;
      font-style: italic;
      margin: 40px 0;
      min-height: 55px;
  }
  .item span {
      font-style: normal;
  }
  .panel {
      border: 1px solid #413131; 
      border-radius:0 !important;
      transition: box-shadow 0.5s;
  }
  .panel:hover {
      box-shadow: 5px 0px 40px rgba(0,0,0, .2);
  }
  .panel-footer .btn:hover {
      border: 1px solid #413131;
      background-color: #fff !important;
      color: #413131;
  }
  .panel-heading {
      color: #fff !important;
      background-color: #413131 !important;
      padding: 25px;
      border-bottom: 1px solid transparent;
      border-top-left-radius: 0px;
      border-top-right-radius: 0px;
      border-bottom-left-radius: 0px;
      border-bottom-right-radius: 0px;
  }
  .panel-footer {
      background-color: white !important;
  }
  .panel-footer h3 {
      font-size: 32px;
  }
  .panel-footer h4 {
      color: #aaa;
      font-size: 14px;
  }
  .panel-footer .btn {
      margin: 15px 0;
      background-color: #413131;
      color: #fff;
  }
  
  .navbar {
    border: 0;
    border-radius: 0;
    margin-bottom: 0;
    font-size: 17px;
    padding-top: 15px;
    padding-bottom: 0px;
    letter-spacing: 2px;
    -webkit-backface-visibility: hidden !important;
  }
  .navbar li a, .navbar .navbar-brand {
      color: #413131 !important;
      font-size: 17px;
  }
  .navbar-brand {
      margin-bottom: 10px;
  }
  .navbar li a {
      padding-left: 20px;
      padding-right: 20px;
      padding-bottom: 30px !important;
  }
  .navbar-nav li a:hover, .navbar-nav li.active a {
      color: whitesmoke !important;
      background-color: #413131 !important;
  }
  .navbar-default .navbar-toggle {
      border-color: transparent;
      color: #fff !important;
  }
  footer .glyphicon {
      font-size: 20px;
      margin-bottom: 20px;
      color: #413131;
  }
  .slideanim {visibility:hidden;}
  .slide {
      animation-name: slide;
      -webkit-animation-name: slide;
      animation-duration: 1s;
      -webkit-animation-duration: 1s;
      visibility: visible;
  }
  @keyframes slide {
    0% {
      opacity: 0;
      transform: translateY(70%);
    } 
    100% {
      opacity: 1;
      transform: translateY(0%);
    }
  }
  @-webkit-keyframes slide {
    0% {
      opacity: 0;
      -webkit-transform: translateY(70%);
    } 
    100% {
      opacity: 1;
      -webkit-transform: translateY(0%);
    }
  }
  @media screen and (max-width: 768px) {
    .col-sm-4 {
      text-align: center;
      margin: 25px 0;
    }
    .btn-lg {
        width: 100%;
        margin-bottom: 35px;
    }
  }
  @media screen and (max-width: 480px) {
    .logo {
        font-size: 150px;
    }
  }
  </style>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">AMTSHILFE-LE.de</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#what">WAS</a></li>
        <li><a href="#how">WIE</a></li>
        <li><a href="#pricing">WIEVIEL</a></li>      
          <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">WANN <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#section41">Section 4-1</a></li>
              <li><a href="#section42">Section 4-2</a></li>
            </ul>
          </li>
        </ul>
      </ul>
    </div>
  </div>
</nav>
    
<div id="what" class="container-fluid high-padding bg-even text-center">

<h3 style='font-weight: 500; font: Montserrat, sans-serif'>Keine Zeit für die Fahrt zum Amt? Keine Nerven oder keine Ahnung?</h3>
  <?= $this->Html->image('kopf.png', ['alt' => 'Reite den Amtsschimmel', 'class' => 'img-responsive img-circle margin', 'style' => 'display:inline', 'alt' => '', 'width' => '280', 'height' => '280']); ?>
<h3 style='font-weight: 500; font: Montserrat, sans-serif'>Wir erledigen Ihre Behördengänge und helfen bei allen Fragen und Formularen.</h3>
<div class="starter">
    <a class="sign-up" href="#lohn-form">
        JETZT TESTEN
    </a>
    <div class="delay sec1 left"><span class="glyphicon glyphicon-check"> </span> Professionell & Zuverlässig</div>
    <div class="delay sec2 left"><span class="glyphicon glyphicon-check"> </span> Günstig & Verständlich</div>
    <div class="delay sec3 left"><span class="glyphicon glyphicon-check"> </span> Schnell & Flexibel</div>
</div>


</div>
    
<div class="container-fluid bg-odd low">
  <div id="myCarousel" class="carousel slide text-center" data-ride="carousel" data-interval="5000">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <h4>"Kein Schlange stehen und einen Tag Urlaub gespart." (KFZ-Anmeldung)<br><span style="font-style:normal;">Robert Lange, Dipl.-Kfm.</span></h4>
      </div>
      <div class="item">
        <h4>"Formulare per Mail und Hilfe beim Ausfüllen. Bin voll zufrieden."<br><span style="font-style:normal;">Benjamin Litschko, Geologe</span></h4>
      </div>
      <div class="item">
        <h4>"Parkausweis innerhalb eines Tages erhalten. Perfekt."<br><span style="font-style:normal;">Santina Koj, Pädagogin</span></h4>
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Vorherige</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Nächste</span>
    </a>
  </div>
</div>

<!-- Ablauf -->  
<div id="how" class="container-fluid bg-even text-center">    
  <h3 class="margin">Und so funktioniert es ...</h3><br>
  <div class="row">
    <div class="col-sm-15">
        <div class="thumbnail">
            <?= $this->Html->image('a.jpg', ['alt' => '1.', 'class' => 'img-responsive', 'width' => '100%']); ?>
            <div class="caption post-content numbers">
                <h3>1</h3>
            </div>  
        </div>
        <p class="text-how"><span class="who">Sie wählen</span> online die jeweilige Amtssache und einen Termin aus, an dem wir bei Ihnen daheim oder im Büro vorbei kommen sollen.</p>
    </div>
    <div class="col-sm-15">
        <div class="thumbnail">
            <?= $this->Html->image('b.jpg', ['alt' => '1.', 'class' => 'img-responsive', 'width' => '100%']); ?>
            <div class="caption post-content numbers">
                <h3>2</h3>
            </div>  
        </div>
        <p class="text-how"><span class="who">Wir senden</span> Ihnen die jeweiligen Formulare und Vollmachten sowie wertvolle Hinweise zum optimalen Verfahrensablauf per E-Mail zu.</p>
    </div>
    <div class="col-sm-15">
        <div class="thumbnail">
            <?= $this->Html->image('c.jpg', ['alt' => '1.', 'class' => 'img-responsive', 'width' => '100%']); ?>
            <div class="caption post-content numbers">
                <h3>3</h3>
            </div>  
        </div>
        <p class="text-how"><span class="who">Sie drucken</span> die vorausgefüllten Formulare aus und ergänzen fehlende Angaben. Notwendige Dokumente legen Sie auch für uns bereit.</p><!-- Für Fragen stehen wir zudem <span class="who">telefonisch</span> zur Verfügung&#185;.-->
    </div>
    <div class="col-sm-15">
        <div class="thumbnail">
            <?= $this->Html->image('d.jpg', ['alt' => '1.', 'class' => 'img-responsive', 'width' => '100%']); ?>
            <div class="caption post-content numbers">
                <h3>4</h3>
            </div>  
        </div>
        <p class="text-how"><span class="who">Wir kommen</span> zum vereinbarten Termin und prüfen, auf Wunsch schon vorab telefonisch&#185;, alle Anträge auf Vollständigkeit und Richtigkeit.</p>
    </div>
    <div class="col-sm-15">
        <div class="thumbnail">
            <?= $this->Html->image('h.jpg', ['alt' => '1.', 'class' => 'img-responsive', 'width' => '100%']); ?>
            <div class="caption post-content numbers">
                <h3>5</h3>
            </div>  
        </div>
        <p class="text-how"><span class="who">Wir erledigen</span> für Sie zügig² den Behördengang, legen alle Gebühren aus und bringen alle Dokumente wieder persönlich zu Ihnen zurück.</p>
    </div>
  </div>
</div>

<!-- Preise -->    
<div id="pricing" class="container-fluid bg-odd">
  <div class="text-center">
    <h2>Pricing</h2>
    <h4>Choose a payment plan that works for you</h4>
  </div>
  <div class="row slideanim">
    <div class="col-sm-4 col-xs-12">
      <div class="panel panel-default text-center">
        <div class="panel-heading">
          <h1>Basic</h1>
        </div>
        <div class="panel-body">
          <p><strong>20</strong> Lorem</p>
          <p><strong>15</strong> Ipsum</p>
          <p><strong>5</strong> Dolor</p>
          <p><strong>2</strong> Sit</p>
          <p><strong>Endless</strong> Amet</p>
        </div>
        <div class="panel-footer">
          <h3>$19</h3>
          <h4>per month</h4>
          <button class="btn btn-lg">Sign Up</button>
        </div>
      </div>      
    </div>     
    <div class="col-sm-4 col-xs-12">
      <div class="panel panel-default text-center">
        <div class="panel-heading">
          <h1>Pro</h1>
        </div>
        <div class="panel-body">
          <p><strong>50</strong> Lorem</p>
          <p><strong>25</strong> Ipsum</p>
          <p><strong>10</strong> Dolor</p>
          <p><strong>5</strong> Sit</p>
          <p><strong>Endless</strong> Amet</p>
        </div>
        <div class="panel-footer">
          <h3>$29</h3>
          <h4>per month</h4>
          <button class="btn btn-lg">Sign Up</button>
        </div>
      </div>      
    </div>       
    <div class="col-sm-4 col-xs-12">
      <div class="panel panel-default text-center">
        <div class="panel-heading">
          <h1>Premium</h1>
        </div>
        <div class="panel-body">
          <p><strong>100</strong> Lorem</p>
          <p><strong>50</strong> Ipsum</p>
          <p><strong>25</strong> Dolor</p>
          <p><strong>10</strong> Sit</p>
          <p><strong>Endless</strong> Amet</p>
        </div>
        <div class="panel-footer">
          <h3>$49</h3>
          <h4>per month</h4>
          <button class="btn btn-lg">Sign Up</button>
        </div>
      </div>      
    </div>    
  </div>
</div>
    
<!-- Container (Services Section) -->
<div id="services" class="container-fluid text-center">
  <h2>SERVICES</h2>
  <h4>What we offer</h4>
  <br>
  <div class="row slideanim">
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-off logo-small"></span>
      <h4>POWER</h4>
      <p>Lorem ipsum dolor sit amet..</p>
    </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-heart logo-small"></span>
      <h4>LOVE</h4>
      <p>Lorem ipsum dolor sit amet..</p>
    </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-lock logo-small"></span>
      <h4>JOB DONE</h4>
      <p>Lorem ipsum dolor sit amet..</p>
    </div>
  </div>
  <br><br>
  <div class="row slideanim">
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-leaf logo-small"></span>
      <h4>GREEN</h4>
      <p>Lorem ipsum dolor sit amet..</p>
    </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-certificate logo-small"></span>
      <h4>CERTIFIED</h4>
      <p>Lorem ipsum dolor sit amet..</p>
    </div>
    <div class="col-sm-4">
      <span class="glyphicon glyphicon-wrench logo-small"></span>
      <h4 style="color:#303030;">HARD WORK</h4>
      <p>Lorem ipsum dolor sit amet..</p>
    </div>
  </div>
</div>


<!-- Container (Contact Section) -->
<div id="contact" class="container-fluid bg-grey">
  <h2 class="text-center">CONTACT</h2>
  <div class="row">
    <div class="col-sm-5">
      <p>Contact us and we'll get back to you within 24 hours.</p>
      <p><span class="glyphicon glyphicon-map-marker"></span> Chicago, US</p>
      <p><span class="glyphicon glyphicon-phone"></span> +00 1515151515</p>
      <p><span class="glyphicon glyphicon-envelope"></span> myemail@something.com</p>
    </div>
    <div class="col-sm-7 slideanim">
      <div class="row">
        <div class="col-sm-6 form-group">
          <input class="form-control" id="name" name="name" placeholder="Name" type="text" required>
        </div>
        <div class="col-sm-6 form-group">
          <input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
        </div>
      </div>
      <textarea class="form-control" id="comments" name="comments" placeholder="Comment" rows="5"></textarea><br>
      <div class="row">
        <div class="col-sm-12 form-group">
          <button class="btn btn-default pull-right" type="submit">Send</button>
        </div>
      </div>
    </div>
  </div>
</div>
<footer class="container-fluid text-center">
  <a href="#myPage" title="To Top">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a>
  <p>Bootstrap Theme Made By <a href="http://www.w3schools.com" title="Visit w3schools">www.w3schools.com</a></p>
</footer>

<script>
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
        scrollTop: $(hash).offset().top -50
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
  -->
})
</script>

</body>
</html>

