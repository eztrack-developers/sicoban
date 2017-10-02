<?php 

    error_reporting(E_ALL);
	header ("Expires: Fri, 14 Mar 1980 20:53:00 GMT");
	header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header ("Cache-Control: no-cache, must-revalidate");
	header ("Pragma: no-cache");

	if(!isset($_SESSION))
	{

		
        session_start(); 
		session_cache_limiter('nocache, private');
		if(isset($_SESSION['id']))
		{
		   require_once('../../_db_conecction/dbconecction.php');
		   require_once('../../_source_classes/users/user.class.php');		

		   $user = new users();
		   $cli    = $user->getInfoUser($_SESSION['id']);
		
		  if(!is_null($cli)){

		  	$row_cli = $cli->fetch_assoc();
		  }


?>

<h4>Información General</h4>
<hr/>
<input type="hidden" data-id="<?php echo($_SESSION['id']) ?>" id="hidden_id_user">
<form action="POST" id="form_edit_user">
	<table cellpadding="0" cellspacing="0" border="0" width="100%">
		<tr>
			<td width="12%" height="40px"><label class="label">Usuario:</label></td>
			<td><input type="text" value="<?php echo($row_cli['Us_User']); ?>" id="Us_User_edit" name="Us_User"></td>
		</tr>
		<tr>
			<td width="12%" height="40px"><label class="label">Nombre:</label></td>
			<td><input type="text" value="<?php echo($row_cli['Us_Name']); ?>" id="Us_Name_edit"  name="Us_Name"></td>
		</tr>
		<tr>
			<td width="12%" height="40px"><label class="label">Apellido:</label></td>
			<td><input type="text" value="<?php echo($row_cli['Us_LastName']); ?>" id="Us_LastName_edit" name="Us_LastName"></td>
		</tr>
		<tr>
			<td width="12%" height="40px"><label class="label">Corre Electronico:</label></td>
			<td><input type="text" value="<?php echo($row_cli['Us_Email']); ?>" id="Us_Email_edit"  name="Us_Email"></td>
		</tr>
		<tr>
			<td width="12%" height="40px"><label class="label">Telefono:</label></td>
			<td><input type="text" value="<?php echo($row_cli['Us_Phone']); ?>" id="Us_Phone_edit"  name="Us_Phone"></td>
		</tr>
		<tr>
			<td width="12%" height="40px"><label class="label">Ciudad:</label></td>
			<td><input type="text" value="<?php echo($row_cli['Us_City']); ?>" id="Us_City_edit"  name="Us_City"></td>
		</tr>
		
	</table>
</form>
<div>
	<input type="button" class="red2" value="Actualizar" onclick="editUser()" style="float:right;">
</div>
<br>
<h4>Cambia tu contraseña</h4>
<hr/>

<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
		<td width="12%" height="40px">
			<label class="label">Contraseña Vieja:</label>
		</td>
		<td width="30%">
			<input type="password" id="old_pass">
		</td>
		<td>
			<span class="msg_error" id="error_msg0" ></span>
		</td>
	</tr>
	<tr>
		<td width="12%" height="40px">
			<label class="label">Contraseña Nueva:</label>
		</td>
		<td>
			<input type="password" id="new_pass">
		</td>
		<td>
			<span class="msg_error" id="error_msg1"></span>
		</td>
	</tr>
	<tr>
		<td width="12%" height="40px">
			<label class="label">Repetir Contraseña:</label>
		</td>
		<td>
			<input type="password" id="repeat_pass">
		</td>
		<td>
			<span class="msg_error" id="error_msg2"></span>
		</td>
	</tr>
	<tr>
		<td colspan="3" align="right"><input type="button" class="red2" value="Actualizar" onclick="changePassword(<?php  echo($_SESSION['id']); ?>)"></td>
	</tr>
</table>


<?php 
	}
}else {
	 header("Location: ../../_source_classes/users/sessionout.php");
}
 ?>
