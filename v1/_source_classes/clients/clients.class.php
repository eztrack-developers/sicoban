 <?php 

/**
* 
*/
class clients
{
	

	function saveClient($user, $name, $rfc, $address, $address2, $phone, $state, $city, $zip, $email, $comments, $active){

		$result = null;
		$result2 = null;
		$result3 = null;
		$msg = null;
		try {

			$obj = new DatabaseConnection();
			$con = $obj->getConnection();

			if(!is_null($con)){

				$query2  = "select * from ban_user where Us_User = '".$user."'";
				$result2 = $con->query($query2);

				if(!is_null($result2)){

					if($row = $result2->fetch_assoc()) 
					{
						$msg = "El nombre de usuario " . $user . " ya existe";
					} else {	

						$query  = "insert into ban_clients (Cli_name, Stt_ID, Us_User, Cli_RFC, Cli_Address, Cli_Address2, Cli_Phone, Sta_ID, Cli_City, Cli_ZIP, Cli_Email, Cli_Comments) ";
						$query .= "values ('".$name."', '".$active."', '".$user."', '".$rfc."', '".$address."', '".$address2."', '".$phone."', '".$state."', '".$city."', '".$zip."', '".$email."', '".$comments."') ";
						$result = $con->query($query);

						if(!is_null($result))
						{

							$query3  = "insert into ban_user (Us_User, Us_Pass, Stt_ID, Us_CreationDate) values ('".$user."', '".md5('HOLA')."', '".$active."', now())";
							$result3 = $con->query($query3);

							if(!is_null($result3))
							{

								$msg = "Cliente ha sido dado de alta correctamente";
							} else{
								$msg = "Cliente no ha sido dado de alta correctamente";
							}
						} else {
							$msg = "Cliente no ha sido dado de alta correctamente";
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



	function updateClient($user, $name, $rfc, $address, $address2, $phone, $state, $city, $zip, $email, $comments, $active, $id_client){
		$result = null;
		$msg    = null;
		try {

			$obj = new DatabaseConnection();
			$con = $obj->getConnection();

			if(!is_null($con)){

				$query  = "update ban_clients set ";
				$query .= "Cli_name = '". $name."', ";
				$query .= "Stt_ID = '".$active."', ";
				$query .= "Us_User = '".$user."', ";
				$query .= "Cli_RFC = '".$rfc."', ";
				$query .= "Cli_Address = '".$address."', ";
				$query .= "Cli_Address2 = '".$address2."', ";
				$query .= "Cli_Phone = '".$phone."', ";
				$query .= "Sta_ID = '".$state."', ";
				$query .= "Cli_City = '".$city."', ";
				$query .= "Cli_ZIP = '".$zip."', ";
				$query .= "Cli_Email = '".$email."', ";
				$query .= "Cli_Comments = '".$comments."' ";
				$query .= "where Cli_ID = '".$id_client."'; ";
				$result = $con->query($query);
				
				if(!is_null($result))
				{
					$msg = 'El cliente ha sido actualizado correctamente';
				} else 
				{
					$msg = 'Se produjo un error durante el actualizado del cliente';
				}
				

			} else {
				$msg = 'Error Conecction';
			}

		} catch(Exception $e){


				echo($e->getMessage());
		}

		$con->close();
		return $msg;
	}


	function getInfoClient($user){
		$result = null;
		try {

			$obj = new DatabaseConnection();
			$con = $obj->getConnection();

			if(!is_null($con)){

				$query  = "select a.Cli_ID, a.Cli_Name, a.Stt_ID, a.Us_User, a.Cli_RFC, a.Cli_Address, a.Cli_Address2, a.Cli_Phone, (select Sta_Descrip from ban_states b where b.Sta_ID = a.Sta_ID) as state, a.Cli_City, a.Cli_ZIP, a.Cli_Email, a.Cli_Comments from ban_clients a where a.Us_User = '".$user."'";
				$result = $con->query($query);
				

			} else {
				echo('Error Conecction');
			}

		} catch(Exception $e){


				echo($e->getMessage());
		}

		$con->close();
		return $result;

	}



	function changePassword($oldpass, $newpass, $userid){

		$result = null;
		
		try {

			$obj = new DatabaseConnection();
			$con = $obj->getConnection();

			if(!is_null($con)){

				$query  = "select Us_User from ban_user where Us_Id = '".$userid."' and Us_Pass = '".md5($oldpass)."'";
				$result = $con->query($query);
				if(!is_null($result)){
					if($row = $result->fetch_assoc()) 
					{
						
						$query2  = "update ban_user set Us_Pass = '".md5($newpass)."' where Us_Id = '".$userid."' ";
						$result2 = $con->query($query2);
						if(!is_null($result2)){
							$msg = "La contraseña ha sido cambiada correctamente.";
						}
					} else {
						$msg = "La contraseña que intenta cambiar no es correcta.";
						
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

	function resetPassword($Cli_ID){
		$result = null;
		$msg    = null;
		try {

			$obj = new DatabaseConnection();
			$con = $obj->getConnection();

			if(!is_null($con)){

				$query  = "update ban_user set Us_Pass = '".md5('HOLA')."' where Us_User = (select Us_User from ban_clients where Cli_ID = ".$Cli_ID.") ";
				$result = $con->query($query);
				if(!is_null($result)){
					$msg = 'Done';
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



	function deletePassword($Cli_ID){

		$result  = null;
		$result2 = null;
		$msg     = null;
		try 
		{

			$obj = new DatabaseConnection();
			$con = $obj->getConnection();

			if(!is_null($con))
			{

				$query  = "delete from ban_user  where Us_User = (select Us_User from ban_clients where Cli_ID = ".$Cli_ID.") ";
				$result = $con->query($query);
				if(!is_null($result))
				{
					
					$query2 = "delete from ban_clients where Cli_ID = ".$Cli_ID."; ";
					$result2 = $con->query($query2);
					if(!is_null($result2)){
						$msg = 'Done';

					}
				}
				

			} else {
				echo('Error Conecction');
			}

		} catch(Exception $e)
		{


				echo($e->getMessage());
		}

		$con->close();
		return $msg;

	}


	function getInfoClient2($id){
		
		$result = null;
		try {

			$obj = new DatabaseConnection();
			$con = $obj->getConnection();

			if(!is_null($con)){

				$query  = "select * from ban_clients where Cli_ID = ".$id."; ";
				$result = $con->query($query);

			} else {
				echo('Error Conecction');
			}

		} catch(Exception $e){


				echo($e->getMessage());
		}

		$con->close();
		return $result;

	}





}



  ?>