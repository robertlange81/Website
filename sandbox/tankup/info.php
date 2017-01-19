<? 
if (!isset($_SERVER['PHP_AUTH_USER'])) {
       Header("WWW-Authenticate: Basic realm=\"nedeco soap_service\"");
       Header("HTTP/1.0 401 Unauthorized");
       echo "Sorry no login, no service\n";
       exit;
} 

phpinfo(); ?>