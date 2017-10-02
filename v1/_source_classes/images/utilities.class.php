<?php 



/**
* 
*/
class utilities
{
	
	

	public function uploadImage ($name_file){

		$result = null;
		try {

			$obj = new DatabaseConnection();
			$con = $obj->getConnection();

			if(!is_null($con)){

				$query  = "update ban_user set Us_Logo = '".$name_file."' where Us_Id = ".$_SESSION['id']." ";
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


	public function getStatusUser($id){

		$result = null;
		try {

			$obj = new DatabaseConnection();
			$con = $obj->getConnection();

			if(!is_null($con)){

				$query  = "select Us_Status from ban_user where Us_Id = '".$id."' ";
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




public function selectNameImage (){

		$result = null;
		$msg    = null;
		try {

			$obj = new DatabaseConnection();
			$con = $obj->getConnection();

			if(!is_null($con)){

				$query  = "select Us_Logo, Us_Color from ban_user  where Us_Id = ".$_SESSION['id']." ";
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



public function insertPickColor ($color){

		$result = null;
		
		try {

			$obj = new DatabaseConnection();
			$con = $obj->getConnection();

			if(!is_null($con)){

				$query  = "update ban_user set Us_Color = '".$color."' where Us_Id = ".$_SESSION['id']."  ";
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


	public function convertdate($tratadate){

		$year  = substr($tratadate, 0, 2);
		$month = substr($tratadate, 2, 2);
		$day   = substr($tratadate, 4, 5); 

		return $day.'/'.$month.'/'.$year;

	}

function generateRandomString($length) {

    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {

        $randomString .= $characters[rand(0, $charactersLength - 1)];

    }
    return $randomString;

}


	public function getStates (){

		$result = null;
		
		try {

			$obj = new DatabaseConnection();
			$con = $obj->getConnection();

			if(!is_null($con)){

				$query  = "select Sta_ID, Sta_Descrip from ban_states where Ctr_ID = 3";
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


}//end of class





 ?>