
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
  <title>Amtshilfe Leipzig</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <?= $this->Html->script('scroll.js') ?>    
<body id="start" data-spy="scroll" data-target=".navbar" data-offset="60">

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li style="position: absolute; left: 0px" class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">AMTSHILFE-LE.de <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#kontakt">Kontakt</a></li>
          </ul>
        </li>        
        <li><a href="#was">WAS</a></li>
        <li class="how"><a href="#wie">WIE</a></li>
        <li><a href="#preise">WIEVIEL</a></li>      
        </ul>
      </ul>
    </div>
  </div>
</nav>
    
<div id="overview" class="container-fluid high-padding bg-even text-center">

<h3 style='font-weight: 500; font: Montserrat, sans-serif'>Keine Zeit für die Fahrt zum Amt? Keine Nerven oder keine Ahnung?</h3>
  <?= $this->Html->image('kopf.png', ['alt' => 'Reite den Amtsschimmel', 'class' => 'img-responsive img-circle margin', 'style' => 'display:inline', 'alt' => '', 'width' => '280', 'height' => '280']); ?>
<h3 style='font-weight: 500; font: Montserrat, sans-serif'>Wir erledigen Ihre Behördengänge und helfen bei allen Fragen und Formularen.</h3>
<div class="starter">
    <?= $this->Html->image('qr_amtshilfe.jpg', ['alt' => '', 'class' => 'img-responsive margin', 'style' => 'display:inline; position: relative; margin-right: 650px;margin-top: 20px;', 'alt' => '', 'width' => '120', 'height' => '120']); ?>    
</div>
<div class="starter">
    <a class="delay sec4 sign-up hidden-xs" href="#lohn-form" style="top:175px">
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
        <h4>"Kein Schlange stehen und einen Tag Urlaub gespart." (KFZ-Anmeldung)<br><span style="font-style:normal;">Santina Koj, Pädagogin</span></h4>
      </div>
      <div class="item">
        <h4>"Meine Gewerbeanmeldung schnell und einfach erledigt - perfekt."<br><span style="font-style:normal;">Robert Lange, Dipl.-Kfm.</span></h4>
      </div>
      <div class="item">
        <h4>"Formulare per Mail und Hilfe beim Ausfüllen. Bin absolut zufrieden."<br><span style="font-style:normal;">Benjamin Litschko, Geologe</span></h4>
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
<div id="was" class="container-fluid bg-even text-center">
  <h2>Amtshilfen</h2>
  <h4>Unsere Dienstleistungen in Leipzig</h4>
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

<!-- Ablauf -->  
<div id="wie" class="container-fluid bg-odd text-center">    
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
<div id="preise" class="container-fluid">
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
    



<!-- Container (Contact Section) -->
<div id="kontakt" class="container-fluid bg-grey">
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
  <a href="#start" title="Seitenanfang">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a>
  <p class="left">Made with <span class="glyphicon glyphicon-heart logo-small"></span> in Leipzig</p>
</footer>


</body>
</html>

