
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
<html lang="en">
<head>
    <?= $this->Html->charset() ?>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('amt.css') ?>
    <!-- ?= $this->Html->css('cake.css') ?-->    
  <title>Amtshilfe Leipzig</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
  </style>
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="50">
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Amtshilfe-LE.de</a>
    </div>
    <div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
        <li><a href="#what">WAS</a></li>
        <li><a href="#how">WIE</a></li>
          <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Los geht's<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#section41">Section 4-1</a></li>
              <li><a href="#section42">Section 4-2</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
</nav> 
<!-- Navbar 
<nav class="navbar navbar-default" style="margin-bottom:0px">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Amtshilfe-LE.de</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#what">WAS</a></li>
        <li><a href="#how">WIE</a></li>
        <li><a href="#">LOS GEHT'S</a></li>
      </ul>
    </div>
  </div>
</nav>
-->
<div id="what" class="container-fluid bg-1 text-center" style="height:80px;">
</div>
<!-- First Container -->
<div id="what" class="container-fluid bg-1 text-center">
    <div class="delay sec1 left"><span class="glyphicon glyphicon-check"> schnell</span></div>
    <div class="delay sec2 left"><span class="glyphicon glyphicon-check"> günstig</span></div>
    <div class="delay sec3 left"><span class="glyphicon glyphicon-check"> zuverlässig</span></div>
<h3 style='font-weight: 500; font: Montserrat, sans-serif'>Keine Zeit für die Fahrt zum Amt? Keine Nerven oder keine Ahnung?</h3>
  <?= $this->Html->image('kopf.png', ['alt' => 'Reite den Amtsschimmel', 'class' => 'img-responsive img-circle margin', 'style' => 'display:inline', 'alt' => '', 'width' => '250', 'height' => '250']); ?>
<h3 style='font-weight: 500; font: Montserrat, sans-serif'>Wir erledigen Ihre Behördengänge und helfen bei allen Fragen und Formularen.</h3>
</div>

<div class="container-fluid bg-3 text-center">
  <h3 class="margin">Zufriedene Kunden berichten</h3>
  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
  <a href="#" class="btn btn-default btn-lg">
    <span class="glyphicon glyphicon-search"></span> Search
  </a>
</div>

<div id="how" class="container-fluid bg-2 text-center">    
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

<!-- Footer -->
<footer class="container-fluid bg-4 text-center">
  <p>Bootstrap Theme Made By <a href="http://www.w3schools.com">www.w3schools.com</a></p> 
</footer>

</body>
</html>

