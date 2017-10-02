<?php 



ini_set('memory_limit', '2147483648M'); 
ini_set('max_execution_time', 500);
error_reporting(E_ALL);
	header ("Expires: Fri, 14 Mar 1980 20:53:00 GMT");
	header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header ("Cache-Control: no-cache, must-revalidate");
	header ("Pragma: no-cache");


		
		require_once('../_source_classes/images/utilities.class.php');
		require_once('../_db_conecction/dbconecction.php');
	if(!isset($_SESSION))
	{

		session_start(); 
		session_cache_limiter('nocache, private');
		if(isset($_SESSION['id']))
		{


			if(isset($_POST['color'])){

				$utilities = new utilities();
				$util      = $utilities->insertPickColor($_POST['color']);

			}


		}

	}	



 ?>