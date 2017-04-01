
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
?>
<!--?php phpinfo(); ?-->
<!DOCTYPE html>
<html lang="de">
<head>
    <?= $this->Html->charset() ?>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('amt.css') ?>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">    
  <title>Amtshilfe-LE Leipzig</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <?= $this->Html->script('scroll.js') ?>    
  <?= $this->Html->script('datetimepicker-master/build/jquery.datetimepicker.full.min.js') ?> 
  <?= $this->Html->css('jquery.datetimepicker.css') ?>

<body id="seitenanfang" data-spy="scroll" data-target=".navbar" data-offset="60">

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
    </div>
      <a class="navbar-brand" href="#">Amtshilfe-LE.de </a>

    <div class="collapse navbar-collapse" id="myNavbar">      
      <ul class="nav navbar-nav navbar-right">       
        <li><a title="Angebote" href="#was">WAS</a></li>
        <li title="Ablauf" class="how"><a href="#wie">WIE</a></li>
        <li title="Preise" class="price"><a href="#preise">WIEVIEL</a></li> 
        <li><a title="Kontakt" href="#kontakt">WER</a></li>  
        <li><a style="color:#5EC4C9 !important;" data-toggle="modal" title="behördengang auswählen" data-target="#auswahlModal" href="#">WEITER</a>
        </li>            
      </ul>
    </div>
  </div>
</nav>
    
<div id="overview" class="container-fluid high-padding bg-1 text-center">

<h3 style='font-weight: 500;'>Keine Zeit für die Fahrt zum Amt? Keine Nerven oder keine Ahnung?</h3>
  <?= $this->Html->image('kopf.png', ['alt' => 'Reite den Amtshilfe', 'class' => 'img-responsive img-circle margin', 'style' => 'display:inline', 'alt' => '', 'width' => '280', 'height' => '280']); ?>
<h3 style='font-weight: 500;'>Wir erledigen Ihre Behördengänge und helfen bei allen Fragen und Formularen.</h3>
<div class="starter">
    <?= $this->Html->image('qr_amtshilfe-le.jpg', ['alt' => '', 'class' => 'img-responsive margin', 'style' => 'display:inline; position: relative; margin-right: 650px;margin-top: 40px;', 'alt' => '', 'width' => '130', 'height' => '130']); ?>    
    <p class="left" style="margin-right: 652px; margin-top: 0px;font-size: 9px">Made with <span class="glyphicon glyphicon-heart logo-small"></span> in Leipzig</p>
</div>
<div class="starter">
    <a data-toggle="modal" title="behördengang auswählen" data-target="#auswahlModal" class="delay sec4 sign-up hidden-xs" href="#" style="top:175px">
        JETZT TESTEN
    </a>
    <div class="delay sec1 left"><span class="glyphicon glyphicon-check"> </span> Professionell & Zuverlässig</div>
    <div class="delay sec2 left"><span class="glyphicon glyphicon-check"> </span> Günstig & Verständlich</div>
    <div class="delay sec3 left"><span class="glyphicon glyphicon-check"> </span> Schnell & Flexibel</div>
</div>


</div>
    
<div class="container-fluid low">
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
        <h4>"Kein Schlange stehen und einen Tag Urlaub gespart."<br><span style="font-style:normal;">Santina Koj, Pädagogin</span></h4>
      </div>
      <div class="item">
        <h4>"Meine Gewerbeanmeldung schnell und einfach erledigt."<br><span style="font-style:normal;">Robert Lange, Dipl.-Kfm.</span></h4>
      </div>
      <div class="item">
        <h4>"Formulare per Mail und Hilfe beim Ausfüllen - Top!"<br><span style="font-style:normal;">Benjamin Litschko, Dipl.-Geol.</span></h4>
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
    
<!-- Dienstleistungen -->
<div id="was" class="container-fluid bg-4 text-center">
  <h2>Amtshilfen</h2>
  <h4>Unsere Dienstleistungen in Leipzig</h4>
  <br>
  <div class="row slideanim">
    <div class="col-sm-4">
      <span class="features">
        <i class="fa fa-address-card fa-4x" aria-hidden="true"></i>
      </span>
      <h4>Personalausweis abholen</h4>
      <p></p>
    </div>
    <div class="col-sm-4">
      <span class="features">
        <i class="fa fa-drivers-license fa-4x" aria-hidden="true"></i>
      </span>
      <h4>Reisepass abholen</h4>
      <p></p>
    </div>
    <div class="col-sm-4">
      <span class="features">
        <i class="fa fa-leanpub fa-4x" aria-hidden="true"></i>
      </span>
      <h4>Amtliche Beglaubigung</h4>
      <p></p>        
    </div>
  </div>
  <br><br>
  <div class="row slideanim">
    <div class="col-sm-4">
      <span class="features">
        <i class="fa fa-home fa-4x" aria-hidden="true"></i>
      </span>
      <h4>Wohnsitz ummelden</h4>
      <p></p>
    </div>  
    <div class="col-sm-4">
      <span class="features">
        <i class="fa fa-globe fa-4x" aria-hidden="true"></i>
      </span>
      <h4>Meldebescheinigung</h4>
      <p></p>
    </div>  
    <div class="col-sm-4">
      <span class="features">
        <i class="fa fa-wheelchair fa-4x" aria-hidden="true"></i>
        <!--i class="fa fa-car fa-4x" aria-hidden="true"></i-->
      </span>
      <h4>Parkausweis beantragen</h4>
      <p></p>
    </div>          
  </div>
  <br><br>
  <div class="row slideanim">  
    <div class="col-sm-4">
        <span class="features">
          <i class="fa fa-play fa-1x" aria-hidden="false"></i>
          <i class="fa fa-car fa-4x" aria-hidden="true"></i>
          <i class="fa fa-play fa-1x" aria-hidden="false"></i>
        </span>
      <h4>KFZ ANmelden</h4>
      <p></p>
    </div>      
    <div class="col-sm-4">
      <span class="features">
          <i class="fa fa-exchange fa-1x" aria-hidden="false"></i>
          <i class="fa fa-car fa-4x" aria-hidden="true"></i>
          <i class="fa fa-exchange fa-1x" aria-hidden="false"></i>
      </span>
      <h4>KFZ UMmelden</h4>
      <p></p>
    </div>      
    <div class="col-sm-4">
      <span class="features">
        <i class="fa fa-stop fa-1x" aria-hidden="false"></i>
        <i class="fa fa-car fa-4x" aria-hidden="false"></i>
        <i class="fa fa-stop fa-1x" aria-hidden="false"></i>
      </span>
      <h4>KFZ ABmelden</h4>
      <p></p>
    </div>      
  </div>  
  <br><br>
  <div class="row slideanim">  
    <div class="col-sm-4">
      <span class="features">
        <i class="fa fa-play fa-1x" aria-hidden="false"></i>
        <i class="fa fa-industry fa-4x" aria-hidden="true"></i>
        <i class="fa fa-play fa-1x" aria-hidden="false"></i>
      </span>
      <h4>Gewerbe ANmelden</h4>
      <p></p>
    </div>      
    <div class="col-sm-4">
      <span class="features">
        <i class="fa fa-exchange fa-1x" aria-hidden="false"></i>
        <i class="fa fa-industry fa-4x" aria-hidden="true"></i>
        <i class="fa fa-exchange fa-1x" aria-hidden="false"></i>
      </span>
      <h4>Gewerbe UMmelden</h4>
      <p></p>
    </div>      
    <div class="col-sm-4">
      <span class="features">
        <i class="fa fa-stop fa-1x" aria-hidden="false"></i>
        <i class="fa fa-industry fa-4x" aria-hidden="false"></i>
        <i class="fa fa-stop fa-1x" aria-hidden="false"></i>
      </span>
      <h4>Gewerbe ABmelden</h4>
      <p></p>
    </div>      
  </div>
<br><br>  
</div>    

<!-- Ablauf -->  
<div id="wie" class="container-fluid bg-1 text-center">  
  <h2>Ablauf</h2>
  <h4>Und so funktioniert es ...</h4>    
  <br>
  <div class="row">
    <div class="col-sm-3">
        <div class="thumbnail">
            <?= $this->Html->image('a.jpg', ['alt' => '1.', 'class' => 'img-responsive', 'width' => '250px']); ?>
            <div class="caption post-content numbers">
                <h3>1</h3>
            </div>  
        </div>
        <p class="text-how"><span class="who">Sie wählen</span> online die jeweilige Amtssache und einen Termin aus, an dem wir bei Ihnen daheim oder im Büro vorbei kommen sollen. Sie können den Termin auch noch nachträglich telefonisch verschieben.<br><br></p>
    </div>
    <div class="col-sm-3">
        <div class="thumbnail">
            <?= $this->Html->image('b.jpg', ['alt' => '1.', 'class' => 'img-responsive', 'width' => '250px']); ?>
            <div class="caption post-content numbers">
                <h3>2</h3>
            </div>  
        </div>
        <p class="text-how">
            <span class="who">Wir senden</span> Ihnen die jeweiligen Formulare und Vollmachten sowie Hinweise zum optimalen Ablauf des Verfahrens per E-Mail zu.
            <span class="who">Sie drucken</span> die ausgefüllten Formulare aus und ergänzen fehlende Angaben.<br><br>
        </p>
    </div>
    <div class="col-sm-3">
        <div class="thumbnail">
            <?= $this->Html->image('d.jpg', ['alt' => '1.', 'class' => 'img-responsive', 'width' => '250px']); ?>
            <div class="caption post-content numbers">
                <h3>3</h3>
            </div>  
        </div>
        <p class="text-how"><span class="who">Wir kommen</span> zum vereinbarten Termin und prüfen alle Anträge und notwendigen Dokumente auf deren Vollständigkeit und Richtigkeit. Auf Wunsch helfen wir Ihnen zudem gerne bei inhaltlichen Fragen<span class="who">&#185;</span>.<br><br></p><!-- Für Fragen stehen wir zudem <span class="who">telefonisch</span> zur Verfügung&#185;.-->
    </div>
    <div class="col-sm-3">
        <div class="thumbnail">
            <?= $this->Html->image('h.jpg', ['alt' => '1.', 'class' => 'img-responsive', 'width' => '250px']); ?>
            <div class="caption post-content numbers">
                <h3>4</h3>
            </div>  
        </div>
        <p class="text-how"></p>
        <p class="text-how"><span class="who">Wir erledigen</span> für Sie zügig<span class="who">²</span> den Behördengang, legen die Gebühren aus und bringen alle Dokumente wieder persönlich zu Ihnen zurück. Sie können bar bei Übergabe oder bequem per Bankeinzug bezahlen.<br><br></p>
    </div>
  </div>
  <div class="hint">
      <br>
    <div class="su-note" style="border-color:#e5e55c;border-radius:5px;-moz-border-radius:5px;-webkit-border-radius:5px;">
        <div class="su-note-inner su-clearfix" style="background-color:wheat;border-color:#ffffe0;color:#333333;border-radius:5px;-moz-border-radius:5px;-webkit-border-radius:5px;">
            &#185; Mit Support-Option helfen wir Ihnen beim Ausfüllen der Antragsformulare und unterstützen Sie bei inhaltlichen Fragen zu Ihrer Amtssache.
            <br>² Mit Express-Option erledigen wir Ihre Amtssache (außer Parkausweis) innerhalb <span style="font-weight: bold">eines</span> Behördentags (Standard ist innerhalb von drei).
        </div>
    </div>      
  </div>
</div>

<!-- Preise -->    
<div id="preise" class="container-fluid bg-4">
  <div class="text-center">
    <h2>Preise</h2>
    <h4>Alle Kosten transparent im Überblick³</h4>
  </div>
    <br>
  <div class="row slideanim">
    <div class="col-sm-4 col-xs-12">
      <div class="panel panel-default text-center">
        <div class="panel-heading">
          <h1>Basis</h1>
        </div>
        <div class="panel-body">
          <p><strong>Personalausweis abholen</strong></p>
          <p><strong>Reisepass abholen</strong></p>
          <p><strong>Amtliche Beglaubigung</strong></p> 
          <p><strong>Meldebescheinigung</strong></p>          
        </div>
        <div class="panel-footer">
          <h3>19 €</h3>
          <h4></h4>
          <button class="btn btn-lg">Weiter</button>
        </div>
      </div>      
    </div>     
    <div class="col-sm-4 col-xs-12">
      <div class="panel panel-default text-center">
        <div class="panel-heading">
          <h1>Pro</h1>
        </div>
        <div class="panel-body">
          <p><strong>Wohnsitz ummelden</strong></p>                           
          <p><strong>Gewerbe Anmelden</strong></p>
          <p><strong>Gewerbe Ummelden</strong></p>
          <p><strong>Gewerbe Abmelden</strong></p>                 
        </div>
        <div class="panel-footer">
          <h3>25 €</h3>
          <h4></h4>
          <button class="btn btn-lg">Weiter</button>
        </div>
      </div>      
    </div>       
    <div class="col-sm-4 col-xs-12">
      <div class="panel panel-default text-center">
        <div class="panel-heading">
          <h1>Premium</h1>
        </div>
          <div class="panel-body">
          <p><strong>KFZ Anmelden</strong></p>
          <p><strong>KFZ Ummelden</strong></p>
          <p><strong>KFZ Abmelden</strong></p>
          <p><strong>Parkausweis beantragen</strong></p>            
        </div>
        <div class="panel-footer">
          <h3>35 €</h3>
          <h4></h4>
          <button class="btn btn-lg">Weiter</button>
        </div>
      </div>      
    </div>    
  </div>
  <div class="hint">
    <h6>
        ³ zzgl. der von den Behörden erhobenen Gebühren für die jeweilige Amtssache<br>
    </h6> 
      <br>
  </div>
</div>
    
<!-- Kontakt -->
<div id="kontakt" class="container-fluid bg-1">
  <h2 class="text-center">Kontakt</h2>
  <div class="row">
    <div class="col-sm-5">
      <p>Kontaktieren Sie uns - wir antworten sofort.</p>
      <p><span class="glyphicon glyphicon-map-marker"></span> Filialen</p>
      <p><span class="glyphicon glyphicon-phone"></span> +049 176 35 76 0004</p>
      <p><span class="glyphicon glyphicon-envelope"></span> info@amtshilfe-le.de</p>
    </div>
    <div class="col-sm-7 slideanim">
        <form id="contactform" action="/email/sendContact">  
            <div class="row">                  
                <div class="col-sm-6 form-group">
                  <input class="form-control" id="name" name="name" placeholder="Name" type="text" required>
                </div>
                <div class="col-sm-6 form-group">
                  <input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
                </div>
            </div>
            <textarea class="form-control" id="text" name="text" placeholder="Nachricht" rows="5" required></textarea><br>
            <div class="row">
              <div class="col-sm-12 form-group">
                <button id="submitContact" class="btn btn-default pull-right">Absenden</button>
              </div>
            </div>
        </form>
    </div>
  </div>
</div>
  <div class="alert alert-success alert-dismissable fade in">
    <a class="close" aria-label="close">&times;</a>
    <span id="alert-success-text"></span>
  </div>
  <div class="alert alert-info alert-dismissable fade in">
    <a class="close" aria-label="close">&times;</a>
    <span id="alert-info-text"></span>
  </div>
  <div class="alert alert-warning alert-dismissable fade in">
    <a class="close" aria-label="close">&times;</a>
    <span id="alert-warning-text"></span>
  </div>
  <div class="alert alert-danger alert-dismissable fade in">
    <a class="close" aria-label="close">&times;</a>
    <span id="alert-danger-text"></span>
  </div>
<footer class="container-fluid text-center">
  <a href="#seitenanfang" title="Seitenanfang">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a>
</footer>

<!-- Modal -->
<div id="auswahlModal" style=" padding-right: 0px !important;" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Behördengang auswählen</h4>
      </div>
      <div class="modal-body">
          <form>              
            <div class="checkbox">
              <label><input type="checkbox" value="">Option 1</label>
            </div>
            <div class="checkbox">
              <label><input type="checkbox" value="">Option 2</label>
            </div>
            <div class="checkbox disabled">
              <label><input type="checkbox" value="" disabled>Option 3</label>
            </div>      
            <!-- http://xdsoft.net/jqplugins/datetimepicker/ -->
            <div class="form-group">
              <label for="usr">Abholdatum</label>
               <div class="form-group">
              <input id="datePicker" type="text" class="form-control">
              <input id="timePicker" type="text" class="form-control">
              </div>
                            
            </div>            
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</body>
</html>

