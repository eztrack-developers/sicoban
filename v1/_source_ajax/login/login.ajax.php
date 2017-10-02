<?php 

	session_start();
	session_cache_limiter('nocache, private');
    header ("Expires: Fri, 14 Mar 1980 20:53:00 GMT");
	header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header ("Cache-Control: no-cache, must-revalidate");
	header ("Pragma: no-cache");
	error_reporting(E_ALL);

	require '../../_db_conecction/dbconecction.php';  	
	require '../../_source_classes/users/session.class.php';  

	if(isset($_POST["user"]) && isset($_POST["password"])) {
		$user = $_POST["user"];
		$pass = $_POST["password"];
		$token = $_POST['token_user'];

		$session = new login();
		$msg     = $session->sessionData($user, $pass, $token);
		
	}
	

	echo($msg);


 ?>