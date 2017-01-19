<?php
	if($_GET['q']){
		$handle = fopen('todo.txt', 'a');
		fwrite($handle, "\n".$_GET['q']);
		fclose($handle);
	}
?>
