<?php 


/**
* 
*/
class logs
{
	
	public function saveLogsConvertion($us, $action){
		$msg    = null;
		$result = null;
		try
		{
			$obj = new DatabaseConnection();
			$con = $obj->getConnection();
			if(!is_null($con))
			{
				$query = "insert into ban_log_convertion (Us_Id, Blc_Date, Blc_Action) values ('".$us."', now(), '".utf8_decode($action)."');";
				$result = $con->query($query);
				if(!is_null($result))
				{
					$msg = "DONE";
				} else {
					$msg = "ERROR QUERY{1}";
				}
			} else {
				$msg = "CONNECTION ERROR";
			}
		}catch(Exception $e)
		{
			echo($e->getMessage());
		}
		$con->close();
		return $msg;
	}

}


 ?>