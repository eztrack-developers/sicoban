<?php 

    error_reporting(E_ALL);
	header ("Expires: Fri, 14 Mar 1980 20:53:00 GMT");
	header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header ("Cache-Control: no-cache, must-revalidate");
	header ("Pragma: no-cache");

		   require_once('../_db_conecction/dbconecction.php');
		   require_once('../_source_classes/images/utilities.class.php');	
		   require_once('../_source_classes/clients/clients.class.php');		
		
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Socio Sicoban</title>
	<link rel="stylesheet" href="../css/register-clients.css">
	<link rel='stylesheet' type='text/css' href='https://fonts.googleapis.com/css?family=Roboto' >
	<link rel="icon" href="../images/logo-sicoban-icon.ico">

	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script type="text/javascript" src="http://l2.io/ip.js?var=myip"></script>
	<script type="text/javascript" src="../js/register.optimize.js"></script> 
	<script type="text/javascript" src="../js/Validate.jquery.js"></script>
</head>
<body>

<div class="content-main"></div>
<div class="subcontent-main" id="subcontent_main">
		<table cellpadding="0" border="0" cellspacing="0" width="100%" id="registertable">
			<tr>
				<td colspan="2" height="70px">
					<input type="button" class="button-account" value="Ya tengo cuenta" onclick="window.location.href='http://www.sicoban.mx/'">
				</td>
			</tr>
			<tr>
				<td align="center" colspan="2" height="40px">
					<span class="title">O CREA UNA CUENTA</span>
					<br>

					<hr/>

				</td>
			<tr>
				<td height="53px" align="left"><input type="text" id="client_name"   name="register" class="input-register" placeholder="Nombre"></td>
				<td align="right"><input type="text" id="client_lastname"  name="register" class="input-register" placeholder="Apellido"></td>
			</tr>
			<tr>
				<td colspan="2" height="53px">
					<input type="text" id="client_user" name="register" class="input-rs" placeholder="Usuario">
				</td>
			</tr>
			<tr>
				<td colspan="2" height="53px">
					<input type="password" id="client_password" name="register" class="input-rs" placeholder="Contraseña">
				</td>
			</tr>
			<tr>
				<td colspan="2" height="53px">
					<input type="email" id="client_email" name="register" class="input-rs" placeholder="Correo Electrónico">
					<script>
					$(document).ready(function(){
						$('#client_email').on('blur', function(){
				
							$(this).validate();
						});

					});

					</script>
				</td>
			</tr>
			<tr>
				<td colspan="2" height="53px">
					<input type="tel" id="client_phone" name="register" class="input-rs" placeholder="Teléfono" onkeypress="return isNumber(event)" maxlength="10">
				</td>
			</tr>
			
			<tr>
				<td colspan="2" height="53px">
					<input type="text" id="client_city" name="register" class="input-rs" placeholder="Ciudad">
				</td>
			</tr>

			<tr>
				<td colspan="2" height="53px">
					<span id="msg-error-user" class="msg-error"></span>
					<hr/>
				</td>
			</tr>
		
		</table>

		<table cellpadding="0" border="0" cellspacing="0" width="100%">
		<tr>
			<td align="center">
				<input type="button"  value="Agregar" class="button-register" id="button-register" >
					<script>
					(function(){  $('#button-register').bind('click', function(){ 
						b = cx();
						( b == "DO") ? window.location.href='http://www.sicoban.mx/' : $('#msg-error-user').append(b) }) })();		
					</script>
			</td>		
		</tr>
		<tr>
			<td>
				<p>
					Al proceder, acepto que Sicoban o sus representantes pueden ponerse en contacto conmigo por correo electrónico, teléfono, 
					o al número que yo indique, incluso 
					para fines de marketing. He leído y comprendo la 
					<a href="#" class="link-privacy">Declaración de privacidad para el cliente.</a>
				</p>
			</td>
		</tr>
		</table>
		
	</div>

</body>
</html>
<script>
	$(document).ready(function(){
		var x = document.getElementById("subcontent_main");
		x.style.height = "calc(100vh - 10vh)";
	});
</script>

