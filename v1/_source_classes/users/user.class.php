<?php 

/**
* 
*/
class users
{
	
	 function setDataUser($client_name, $client_lastname, $client_user, $client_password, $client_email, $client_phone, $client_city, $client_IP){

		$result_select_user  = null;
		$result_insert_user  = null;
		$result_select_email = null;
		$result_select_ip    = null;
		$ip_client = $_SERVER['REMOTE_ADDR'];
		$msg = null;
		try {

			$obj = new DatabaseConnection();
			$con = $obj->getConnection();

			if(!is_null($con)){

				$query_select_user  = "select * from ban_user where Us_User = '".$client_user."'";
				$result_select_user = $con->query($query_select_user);

				if(!is_null($result_select_user)){
					
					$cx  = $result_select_user->num_rows;
					if($cx > 0) 
					{
						$msg = "El nombre de usuario " . $client_user . " ya existe.";
					} else {


						$query_select_email  = "select * from ban_user where Us_Email = '".$client_email."'";
						$result_select_email = $con->query($query_select_email);

						if(!is_null($result_select_email)){

							$dx  = $result_select_email->num_rows;
							if($dx > 0 )
							{
								$msg = "Intenta registrar otro email.";
							} else {

								//$query_select_ip  = "select * from ban_user where Us_IP = '".$ip_client."'";
								//$result_select_ip = $con->query($query_select_ip);

								//if(!is_null($result_select_ip))
								//{
									//$ct  = $result_select_ip->num_rows;

									//if($ct > 0)
									//{
									//	$msg = "Estas intentando registrarte de nuevo.";
									//} else {

										$util = new utilities();
										$token = $util->generateRandomString(45);

										$query_insert_user  = "insert into ban_user (Us_User, Us_Pass,Us_Name, Us_LastName, Us_Email, Us_Phone, Us_City, Us_CreationDate, Us_Status, Us_IP, Us_Token, Us_Initial) ";
										$query_insert_user .= "values ('".$client_user."', '".md5($client_password)."', '".$client_name."', '".$client_lastname."', '".$client_email."', '".$client_phone."', '".$client_city."', now(), 'trial', '".$ip_client."', '".$token."', '1') ";
										$result_insert_user = $con->query($query_insert_user);

										if(!is_null($result_insert_user))
										{
											$msg = "SUCESS";
										} else { $msg = "Se produjo un error {1}"; }
									//}	
								//}

							}
						}

					}
				}

	
			} else {
				echo('Error Conecction');
			}

		} catch(Exception $e){


				echo($e->getMessage());
		}

		$con->close();
		return $msg;


	}




	function getInfoUser($id_user){

		$result_select_user = null;
		try {

			$obj = new DatabaseConnection();
			$con = $obj->getConnection();
			if(!is_null($con))
			{

				$query = "select Us_User, Us_Name, Us_LastName, Us_Email, Us_City, Us_Phone, Us_Code from ban_user where Us_Id = '".$id_user."';";
				$result_select_user = $con->query($query);
				
			}

		}catch(Exception $e){

			echo($e->getMessage());
		}	

		$con->close();
		return $result_select_user;

	}

	function getTokenUser($id_user){

		$result_select_user = null;
		$code = null;
		try {

			$obj = new DatabaseConnection();
			$con = $obj->getConnection();
			if(!is_null($con))
			{

				$query = "select Us_Token from ban_user where Us_User = '".$id_user."';";
				$result_select_user = $con->query($query);
				if(!is_null($result_select_user)){

					$us = $result_select_user->fetch_assoc();
					$code = $us['Us_Token'];

				}
				
			}

		}catch(Exception $e){

			echo($e->getMessage());
		}	

		$con->close();
		return $code;

	}


	function edituser($Us_User, $Us_Name, $Us_LastName, $Us_Email, $Us_Phone, $Us_City, $id_user){
		$result_update_user = null;
		$msg = null;
		try {

			$obj = new DatabaseConnection();
			$con = $obj->getConnection();
			if(!is_null($con))
			{

				$query = "update ban_user set  Us_User = '".$Us_User."', Us_Name = '".$Us_Name."', Us_LastName = '".$Us_LastName."', Us_Email = '".$Us_Email."', Us_City = '".$Us_City."', Us_Phone = '".$Us_Phone."'  where Us_Id = '".$id_user."';";
				$result_update_user = $con->query($query);
				if(!is_null($result_update_user)){
					$msg = 'DONE';
				}
				
			}

		}catch(Exception $e){

			echo($e->getMessage());
		}	

		$con->close();
		return $msg;

	}




}//end class users





 ?>