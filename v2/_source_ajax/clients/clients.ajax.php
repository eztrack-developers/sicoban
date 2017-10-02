<?php 

	session_start();
	session_cache_limiter('nocache, private');
    header ("Expires: Fri, 14 Mar 1980 20:53:00 GMT");
	header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header ("Cache-Control: no-cache, must-revalidate");
	header ("Pragma: no-cache");
	error_reporting(E_ALL);

	require '../../_db_conecction/dbconecction.php';  	
	require '../../_source_classes/clients/clients.class.php';  
	$msg = null;

	if(isset($_POST["option"])) {
		
		$clients = new clients();

		if($_POST["option"] == 1){
				$msg  = $clients->saveClient($_POST["user"], $_POST["name"], $_POST["rfc"], $_POST["address"], $_POST["address2"], $_POST["phone"], $_POST["state"], $_POST["city"], $_POST["zip"], $_POST["email"], $_POST["comments"], $_POST["active"]);
		}

		if($_POST["option"] == 2){

			$msg = $clients->changePassword($_POST["oldpass"], $_POST["newpass"], $_POST["user"]);
		}

		if($_POST["option"] == 3){

			$msg = $clients->resetPassword($_POST["clientID"]);
		}
		if($_POST["option"] == 4){

			$msg = $clients->deletePassword($_POST["clientID"]);
		}
		if($_POST["option"] == 5){

			$msg = $clients->updateClient($_POST["user"], $_POST["name"], $_POST["rfc"], $_POST["address"], $_POST["address2"], $_POST["phone"], $_POST["state"], $_POST["city"], $_POST["zip"], $_POST["email"], $_POST["comments"], $_POST["active"], $_POST["clientID"]);
		}

	
		
	}
	

	echo($msg);


 ?>