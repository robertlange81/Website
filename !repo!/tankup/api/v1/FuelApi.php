<?php 
require_once 'AbstractApi.php';
require_once '../../soapclient.php';
class FuelAPI extends API
{
    protected $User;
    public $soapClient;

    public function __construct($request, $origin) {
        parent::__construct($request);

        /* Abstracted out for example
        $APIKey = new Models\APIKey();
        $User = new Models\User();

        if (!array_key_exists('apiKey', $this->request)) {
            throw new Exception('No API Key provided');
        } else if (!$APIKey->verifyKey($this->request['apiKey'], $origin)) {
            throw new Exception('Invalid API Key');
        } else if (array_key_exists('token', $this->request) &&
             !$User->get('token', $this->request['token'])) {

            throw new Exception('Invalid User Token');
        }

        $this->User = $User;*/
        $soapClient = new SoapClientDispatcher();
    }

     protected function CoordsByTown() {
		 
        switch($this->method) {
			case 'GET':
				if(!empty($_GET['town'])){
					if($soapClient == null) $soapClient = new SoapClientDispatcher();
					return $soapClient->GetCoordsByTown($_GET['town']);
				} else {
					return array('Missing or Invalid Arguments', 400);
				}
				break;
			default:
				return array('Invalid Method', 405);
				break;
        }				 
     }
     
     protected function TownByCoords() {
        switch($this->method) {
			case 'GET':
				if(!empty($_GET['latitude']) && !empty($_GET['longitude'])){
					if($soapClient == null) $soapClient = new SoapClientDispatcher();						
					return $soapClient->GetTownByCoords(new location($_GET['latitude'],$_GET['longitude']));
				} else {
					return array('Missing or Invalid Arguments', 400);
				}
				break;
			default:
				return array('Invalid Method', 405);
				break;
        }			 
     }   
     
     protected function DataByCoords() {
        switch($this->method) {
			case 'GET':
				if(!empty($_GET['latitude']) 
						&& !empty($_GET['longitude']) 
							&& !empty($_GET['article'])
								&& !empty($_GET['distance'])
									&& !empty($_GET['sortBy'])){
					if($soapClient == null) $soapClient = new SoapClientDispatcher();						
					return $soapClient->GetDataByCoords($_GET['article'], $_GET['distance'],$_GET['sortBy'], new location($_GET['latitude'],$_GET['longitude']));
				} else {
					return array('Missing or Invalid Arguments', 400);
				}
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
    ob_start('ob_gzhandler');
    echo $API->processAPI();
} catch (Exception $e) {
    echo json_encode(Array('error' => $e->getMessage()));
}
?>