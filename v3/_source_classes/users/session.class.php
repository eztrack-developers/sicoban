<?php 

	class login{
		
	    public function sessionData($user, $pass, $token)
		{
			$result = null;
			$msg    = null;
			try {
				$obj = new DatabaseConnection();
				$con = $obj->getConnection();
				if(!is_null($con))
				{	
					$query = "select  * from ban_user where Us_User = '".$user."' and Us_Pass = '".md5($pass)."';";
					$result = $con->query($query);	
					if(!is_null($result))
					{
					
						if($row = $result->fetch_assoc()) 
						{
							if($row['Us_Initial'] == 1)
							{
								if(trim($row['Us_Token']) == trim($token))
								{	
									$update_query = "update ban_user set Us_Initial='2'; ";
									$result_uo    = $con->query($update_query);
									if(!is_null($result_uo))
									{
										$_SESSION['user'] = $row['Us_User'];
								     	$_SESSION['id'] = $row['Us_Id'];
								     	$_SESSION['creationDate'] = $row['Us_CreationDate'];
								     	$_SESSION['access'] = date('Y-m-d H:i:s');
										$msg = 'SUCESS';
									}
								} else{
									$msg = "Debes de confirmar su correo electrónico.";
								}
							} else {
								$_SESSION['access'] = date('Y-m-d H:i:s');
								$_SESSION['user'] = $row['Us_User'];
						     	$_SESSION['id'] = $row['Us_Id'];
						     	$_SESSION['creationDate'] = $row['Us_CreationDate'];
								$msg = 'SUCESS';
							}
						}else{
							$msg = "Usuario o contraseña incorrecta.";
						}
					}
				}else{
		     		echo "Problema de conexion";
				}
			} catch(Exception $e){
				echo($e->getMessage());
			}
			$con->close();
			return $msg;
		}
	


	}//end of class


	


	
 ?>