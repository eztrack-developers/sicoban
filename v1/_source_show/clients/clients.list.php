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

		


?>

<h4>Lista de Clientes</h4>
<hr/>
<br>
<br>
<table cellpadding="0" cellspacing="0" border="0" width="100%" id="table_clients">
	<thead>
		<tr>
			<th></th>
			<th>Usuario:</th>
			<th>Nombre:</th>
			<th>Apellido:</th>
			<th>Teléfono:</th>
			<th>Ciudad:</th>
			<th>Email:</th>
			<th>Acciones:</th>
		</tr>
	</thead>
	<tbody>
		
	</tbody>
	<tfoot>
		<tr>
			<th></th>
			<th>Usuario:</th>
			<th>Nombre:</th>
			<th>Apellido:</th>
			<th>Teléfono:</th>
			<th>Ciudad:</th>
			<th>Email:</th>
			<th>Acciones:</th>
		</tr>
	</tfoot>
	
	
</table>


<?php 
		}
	
}


 ?>