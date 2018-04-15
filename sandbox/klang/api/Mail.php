<?php 
require_once 'AbstractApi.php';
require_once "Mail.php";
//require_once '../../soapclient.php';
class FuelAPI extends API
{
    protected $User;
    public $soapClient;

    public function __construct($request, $origin) {
        parent::__construct($request);
    }

     protected function SendKlangmassage() {
		 
        switch($this->method) {
			case 'POST':
				if(empty($this->request->email)) {
                                    return array('Bad Request - Keine Email', 400);                                    
				} 
				if(empty($this->request->type)) {
                                    return array('Bad Request - Keine Art der Anfrage', 400);                                    
				}      
				if(empty($this->request->text)) {
                                    $this->request->text = "";                                    
				}                                    
 
                                require 'lib/PHPMailerAutoload.php';

                                $message = "von: " . $this->request->email . "\n" . $this->request->text;
                                $subject = "Neue Anfrage zu Klangmassage: " . $this->request->type;

                                $mail = new PHPMailer;
                                $mail->isSMTP();/*Set mailer to use SMTP*/
                                $mail->Mailer = 'smtp';
                                $mail->Host = 'nine.alfahosting-server.de'; 
                                $mail->Port = 25;
                                $mail->SMTPAuth = true;/*Enable SMTP authentication*/
                                $mail->Username = 'web1162p3';/*SMTP username*/
                                $mail->Password = 'Achtung!123';/*SMTP password*/
                                $mail->SMTPSecure = 'tls';//*Enable encryption, 'ssl' also accepted*/
                                $mail->From = 'admin@klangmassage-le.de';
                                $mail->FromName = 'admin@klangmassage-le.de';
                                $mail->addAddress('2tinis@gmail.com', 'Santina Koj');
                                $mail->addReplyTo($this->request->email, $this->request->email);
                                // $mail->WordWrap = 50;
                                $mail->isHTML(true);/*Set email format to HTML (default = true)*/
                                $mail->Subject = $subject;
                                $mail->Body    = $message;
                                $mail->AltBody = $message;
                                // $mail->SMTPDebug = 2;
                                if(!$mail->send()) {
                                } else {
                                    return array('Email sent', 201);
                                }                                                                                       
				break;
			default:
				return array('Invalid Method', 405);
				break;
        }				 
     }
     protected function Guestbook () {
		 
        switch($this->method) {
			case 'POST':                           
				if(empty($this->request->content)) {
                                    return array('Missing parameter "content"', 422);                                    
				}                               
                                $jsonData = json_encode(["content" => $this->request->content]);
                                if(file_put_contents('../comments.json', $jsonData)) {
                                    return array('Comment saved', 201);
                                }
                                return array('Error Saving Comment', 500);
				break;
			default:
				return array('Invalid Method', 405);
				break;
        }				 
     }
}
 
if (!array_key_exists('HTTP_ORIGIN', $_SERVER)) {
    $_SERVER['HTTP_ORIGIN'] = $_SERVER['SERVER_NAME'];
}

try {
    $API = new FuelAPI($_REQUEST['request'], $_SERVER['HTTP_ORIGIN']);
    //ob_start('ob_gzhandler');
    echo $API->processAPI();
} catch (Exception $e) {
    echo json_encode(Array('error' => $e->getMessage()));
}
?>