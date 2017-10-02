<?php 
	session_start();
	/*unset($_SESSION['user']); 
	unset($_SESSION['id']);
	unset($_SESSION['error']);*/
	session_unset();
	session_destroy();
	header("Location: ../../");
	//http_redirect(login.php);
	exit();	
?>