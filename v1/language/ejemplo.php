<?php 
	$xml = simplexml_load_file('ingles.xml');
	//print_r($xml);
	print_r($xml->ventas->encargado->nombre['genero']);
	

 ?>