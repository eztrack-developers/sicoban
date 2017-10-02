<?php
class menu {
	
	public function getMenu(){
		$result = null;
		$msg    = null;


		try {

			$obj = new DatabaseConnection();
			$con = $obj->getConnection();

			if(!is_null($con)){
				
				$query = "select Men_Descrip, Men_URL from ban_menu;";
				$result = $con->query($query);
				
			}else{
	     		echo "Problema de conexion";
			}

		} catch(Exception $e){
			echo($e->getMessage());

		}
		
		$con->close();
		return $result;
	}




}


?>