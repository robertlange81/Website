<?php 

class GetCoordsByTownRequest { 

  public $town; 
   
  public function __construct($town) { 
      $this->town = (string) $town; 
  } 
} 

class GetCoordsByTownResponse { 

  public $location; 
   
  public function __construct($loc) { 
      $this->location = $loc; 
  } 
} 

class GetTownByCoordsRequest { 

  public $location; 
   
  public function __construct($loc) { 
      $this->location = $loc; 
  } 
} 

class GetTownByCoordsResponse { 

  public $town; 
   
  public function __construct($stringTown) { 
      $this->town = (string) $stringTown; 
  } 
} 

class GetDataByCoordsRequest { 
  public $article,$distance,$location,$sortBy; 
   
  public function __construct($art,$dis,$loc,$sor) { 
      $this->article = (string) $art; 
      $this->distance = (string) $dis; 
	   $this->location = $loc; 
	   $this->sortBy = (string) $sor; 
  } 
} 

class GetDataByCoordsResponse { 
  public $petrolStation; 
   
  public function __construct($petrolStation) { 
      $this->petrolStation = $petrolStation;
  } 
} 

class location { 

  public $latitude,$longitude; 
   
  public function __construct($lat, $lon) { 
      $this->latitude = (double) $lat; 
      $this->longitude = (double) $lon; 
  } 
} 

class address { 
    
  public $street,$housenumber, $postal, $place; 
   
  public function __construct($street,$housenumber,$postal, $place) { 
      $this->street = $street; 
      $this->housenumber =$housenumber; 
	  $this->postal = $postal; 
	  $this->place =$place;  
  } 
} 

class petrolStation {
	public $id;
	public $owner;
	public $isOpen;
	public $openFrom;
	public $openTo;
	public $location;
	public $price;
	public $address;
	public $reporttime;
	public $distance;	
	
	  public function __construct($id,$owner,$isOpen,$openFrom,$openTo,$location,$price,$address,$reporttime,$distance) { 
      $this->id = (string) $id; 
      $this->owner = (string) $owner;
	  $this->isOpen = (bool) $isOpen; 
	  $this->openFrom = (string) $openFrom;
	  $this->openTo = (string) $openTo;
	  $this->location = $location;
	  $this->price = (float) $price;
	  $this->address = $address;
	  $this->reporttime = (string) $reporttime; 
	  $this->distance = (float) $distance; 
  } 
}

/**
 * Logging class:
 * - contains lfile, lwrite and lclose public methods
 * - lfile sets path and name of log file
 * - lwrite writes message to the log file (and implicitly opens log file)
 * - lclose closes log file
 * - first call of lwrite method will open log file implicitly
 * - message is written with the following format: [d/M/Y:H:i:s] (script name) message
 */
class Logging {
    // declare log file and file pointer as private properties
    private $log_file, $fp;
    // set log file (path and name)
    public function lfile($path) {
        $this->log_file = $path;
    }
    // write message to the log file
    public function lwrite($message) {
        // if file pointer doesn't exist, then open log file
        if (!is_resource($this->fp)) {
            $this->lopen();
        }
        // define script name
        $script_name = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
        // define current time and suppress E_WARNING if using the system TZ settings
        // (don't forget to set the INI setting date.timezone)
        $time = @date('[d/M/Y:H:i:s]');
        // write current time, script name and message to the log file
        fwrite($this->fp, "$time ($script_name) " . $message . PHP_EOL);
    }
    // close log file (it's always a good idea to close a file when you're done with it)
    public function lclose() {
        fclose($this->fp);
    }
    // open log file (private method)
    private function lopen() {
        // in case of Windows set default log file
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $log_file_default = 'c:/php/logfile.txt';
        }
        // set default log file for Linux and other systems
        else {
            $log_file_default = '/tmp/logfile.txt';
        }
        // define log file from lfile method or use previously set default
        $lfile = $this->log_file ? $this->log_file : $log_file_default;
        // open log file for writing only and place file pointer at the end of the file
        // (if the file does not exist, try to create it)
        $this->fp = fopen($lfile, 'a') or exit("Can't open $lfile!");
    }
}
?>