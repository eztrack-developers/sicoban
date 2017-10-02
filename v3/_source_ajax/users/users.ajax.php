<?php 

if(isset($_GET['prefix']))
{
	require_once('../../_db_conecction/dbconecction.php');
	require_once('../../_source_classes/users/user.class.php');
	require_once('../../_source_classes/images/utilities.class.php');
	require_once('../../sendgrid-php/vendor/autoload.php');
	require_once('../../_source_classes/email/sendgrid_email.class.php');
	$user = new users();


	if($_GET['prefix'] == 1)
	{
		$msg = $user->setDataUser($_POST['client_name'], $_POST['client_lastname'], $_POST['client_user'], $_POST['client_password'], $_POST['client_email'], $_POST['client_phone'], $_POST['client_city'], $_POST['client_IP']);
		
		if(trim($msg) == 'SUCESS'){

			$token = $user->getTokenUser($_POST['client_user']);
			if($token != "")
			{
				$email = new email();
				$body  = $email->_bodyEmailVerifyUser($_POST['client_name'] . ' ' . $_POST['client_lastname'], $token );
				if($body != ""){
					$msg   = $email->_sendEmailToVerifyUser($_POST['client_email'], 'Confirme su correo electrónico', $body);
				}
			}
		}
	}

	if($_GET['prefix'] == 2)
	{
		$msg = $user->edituser($_POST['Us_User'],$_POST['Us_Name'], $_POST['Us_LastName'], $_POST['Us_Email'],$_POST['Us_Phone'], $_POST['Us_City'], $_POST['id_user']);
	}

	 echo($msg);

}


 ?>