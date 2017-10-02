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
		   require_once('../../_source_classes/images/utilities.class.php');	
		   require_once('../../_source_classes/clients/clients.class.php');		
		   $row_cli = null;
		   if(isset($_POST['CliID'])){
		   		$id = $_POST['CliID'];

		   		$clients = new clients();
		   		$cli     = $clients->getInfoClient2($id);

		   		if(!is_null($cli))
		   		{
		   			$row_cli = $cli->fetch_assoc();

		   		}

		   }
		


?>
<h4>Alta de Clientes</h4>
<hr/>
<table cellpadding="0" border="0" cellspacing="0" width="100%">


		<tr>
			<td height="30px"><span class="span">Nombre</span></td>
			<td height="30px"><span class="span">Nombre Comercial</span></td>
		</tr>
		<tr>
			<td><input type="text" id="user_id"  value="<?php echo( (isset($row_cli))? $row_cli['Us_User'] : "" ) ?>"></td>
			<td><input type="text" id="user_name" value="<?php echo( (isset($row_cli))? $row_cli['Cli_Name'] : "" ) ?>"></td>
		</tr>


		<tr>
			<td height="30px"><span class="span">RFC</span></td>
			<td height="30px"><span class="span">Dirección</span></td>
		</tr>
		<tr>
			<td><input type="text" id="user_rfc" value="<?php echo( (isset($row_cli))? $row_cli['Cli_RFC'] : "" ) ?>"></td>
			<td><input type="text" id="user_address" value="<?php echo( (isset($row_cli))? $row_cli['Cli_Address'] : "" ) ?>"></td>
		</tr>

		<tr>
			<td height="30px"><span class="span">Colonia</span></td>
			<td height="30px"><span class="span">Teléfono</span></td>
		</tr>
		<tr>
			<td><input type="text" id="user_address2" value="<?php echo( (isset($row_cli))? $row_cli['Cli_Address2'] : "" ) ?>"></td>
			<td><input type="text" id="user_phone" value="<?php echo( (isset($row_cli))? $row_cli['Cli_Phone'] : "" ) ?>"></td>
		</tr>


		<tr>
			<td height="30px"><span class="span">Estado</span></td>
			<td height="30px"><span class="span">Ciudad</span></td>
		</tr>
		<tr>
			<td>
				
                <select name="" id="user_state">
	<?php 

		 $states = new utilities();
		 $sta    = $states->getStates();

		 if(!is_null($sta)){

		 	$cx = $sta->num_rows;
		 	if($cx > 0){

		 		foreach ($sta as $row_state) {
		 			
		 			$selected = ( (isset($row_cli)) ? ($row_cli['Sta_ID'] == $row_state['Sta_ID']) ? "selected=\"selected\"" : "" : "" );
		 			echo("<option ".$selected." value=".$row_state['Sta_ID'].">".utf8_decode($row_state['Sta_Descrip']) ."</option>");
		 		}


		 	}


		 }



	 ?>
                </select>

			</td>
			<td><input type="text" id="user_city" value="<?php echo( (isset($row_cli))? $row_cli['Cli_City'] : "" ) ?>"></td>
		</tr>

		<tr>
			<td height="30px"><span class="span">Codigo Postal</span></td>
			<td height="30px"><span class="span">Correo Electronico</span></td>
		</tr>
		<tr>
			<td><input type="text" id="user_zip" value="<?php echo( (isset($row_cli))? $row_cli['Cli_ZIP'] : "" ) ?>"></td>
			<td><input type="text" id="user_email" value="<?php echo( (isset($row_cli))? $row_cli['Cli_Email'] : "" ) ?>"></td>
		</tr>
		<tr>
			<td height="30px"><span class="span">Comentarios</span></td>
		</tr>
		<tr>
			<td colspan="2">
				<textarea name="" id="" cols="100" rows="4" id="user_comments"><?php echo( (isset($row_cli))? $row_cli['Cli_Comments'] : "" ) ?></textarea>
			</td>
		</tr>
	
</table>

<br>
<hr/>
<br>
<input type="checkbox" value="1" id="user_active" <?php echo( (isset($row_cli))? ($row_cli['Stt_ID'] == 1)? "checked" : "" : "" ) ?> ><span class="span">Activo</span>
<br>
<br>
<input type="checkbox" value="2" id="user_inactive" <?php echo( (isset($row_cli))? ($row_cli['Stt_ID'] == 2)? "checked" : "" : "" ) ?>><span class="span">Inactivo</span>

<table cellpadding="0" border="0" cellspacing="0" width="100%">
<tr>

<?php  
 if(!isset($row_cli)){
?>
	<td align="right"><input type="button"  value="Agregar" class="red2" onclick="saveClient(null)"></td>
<?php 

}else{

 ?>
	<td align="right"><input type="button"  value="Actualizar" class="red2" onclick="saveClient(<?php echo($row_cli['Cli_ID']) ?>)"></td>

 <?php 

 } 

 ?>
</tr>
</table>





<?php 

   }

} else {
	 header("Location: ../../_source_classes/users/sessionout.php");
}
 ?>}
