<!DOCTYPE html>
<html lang="de">
<head>
         <script src="js/xmlrpc_lib.js"></script>     
         <script src="js/jsonrpc_lib.js"></script>        
</head>

<?php 
include 'xmlrpc.inc';
include 'classes.php';
include 'jsonrpc.inc.php';

// Make an object to represent our server.
$server = new jsonrpc_client('XML_RPC_Server.php',
                            'sparesprit.de', 80);                         
/*
$message = new xmlrpcmsg('sample.sumAndDifference',
                         array(new xmlrpcval(5, 'int'),
                               new xmlrpcval(3, 'int')));*/
$message = new jsonrpcmsg('getCoordsByTown',
                         	array(new jsonrpcval(Leipzig, 'string'),
                           1)
                         );
$result = $server->send($message);

// Process the response.
if (!$result) {
    print "<p>Could not connect to HTTP server.</p>";
} elseif ($result->faultCode()) {
    print "<p>XML-RPC Fault #" . $result->faultCode() . ": " .
        $result->faultString();
} else {
    $struct = $result->value();
    $latitude = $struct->structmem('latitude');
    $longitude = $struct->structmem('longitude');
    echo "Latitude: ". htmlentities($latitude->scalarval());
    echo "Longitude: ". htmlentities($longitude->scalarval());
}
?> 
<body>
test

<script>
function getCoordsByTown(town){
try {  
	var client = new jsonrpc_client('XML_RPC_Server.php','www.sparesprit.de',80); 
	var message = new jsonrpcmsg('getCoordsByTown',	[new jsonrpcval(town, 'string')], 1);                     
	var result = client.send(message, 1000, function(msgResp){
		alert('Callback erhalten');
		var struct = msgResp.value();
		console.log(msgResp.serialize());
		var latitude = struct.structMem('latitude').scalarVal();
		var longitude = struct.structMem('longitude').scalarVal();
		console.log('Breite: ' + latitude);
		console.log('Länge: ' + longitude);
	});
	alert('Warte auf Callback...1');
}
catch(e)
{
	console.log(e);	
}
}

getDBC();
alert('Warte auf Callback...2');
</script>
</body>