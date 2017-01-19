<?php 
require_once 'AbstractApi.php';
class FuelAPI extends API
{
    protected $User;

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
    }

    /**
     * Example of an Endpoint
     */
     protected function CoordsByTown() {
		 
        switch($this->method) {
			case 'GET':
				if(!empty($_GET['town'])){
					return $this->GetCoordsByTown();
				} else {
					return array('Missing or Invalid Argruments', 400);
				}
				break;
			default:
				return array('Invalid Method', 405);
				break;
        }				 
     }
	 
	 private function GetCoordsByTown()
	 {
		 return array('Invalid Method', 401);
	 }
 }
 
if (!array_key_exists('HTTP_ORIGIN', $_SERVER)) {
    $_SERVER['HTTP_ORIGIN'] = $_SERVER['SERVER_NAME'];
}

try {
    $API = new FuelAPI($_REQUEST['request'], $_SERVER['HTTP_ORIGIN']);
    echo $API->processAPI();
} catch (Exception $e) {
    echo json_encode(Array('error' => $e->getMessage()));
}
?>