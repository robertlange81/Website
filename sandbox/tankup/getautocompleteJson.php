<?php
$db_id = mysql_connect("localhost","web1162","bX2KARTc");
mysql_select_db("usr_web1162_4");
mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER SET 'utf8'");
$term=$_GET['term'];

$query=mysql_query("SELECT distinct data.text_val as ort
										 FROM geodb_textdata data
										 Where data.text_val like '%".$term."%'
										 AND data.text_type = 500100000
										 AND data.loc_id in ( Select loc_id from geodb_coordinates)
										 ORDER BY data.text_val");
$json=array();

while($rec=mysql_fetch_array($query)){
    if (in_array($rec['ort'], $json)){}
    else {
        $json[]=array(
            'value'=> $rec['ort']
        );
    }
}

echo json_encode(array(
    'values'=> $json
));

?>