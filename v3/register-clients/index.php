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
	<link rel="stylesheet" type="text/css" href="../css/PopWindow.jquery.css" />
	<link rel="stylesheet" type="text/css" href="../css/icons.css" />
	<link href='https://fonts.googleapis.com/css?family=Roboto:300' rel='stylesheet' type='text/css'>
	<link rel="icon" href="../images/logo-sicoban-icon.ico">

	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script type="text/javascript" src="http://l2.io/ip.js?var=myip"></script>
	<script type="text/javascript" src="../js/register.optimize.js"></script> 
	<script type="text/javascript" src="../js/Validate.jquery.js"></script>
	<script type="text/javascript" src="../js/PopWindow.jquery.js"></script>
</head>
<body>
<header class="header--main">
	<img src="../images/logo-sicoban-2.svg" alt="" height="70px" width="150px">
	<!--<input type="button" class="button-account" value="Ya tengo cuenta" onclick="window.location.href='http://www.sicoban.mx/'">-->
	<a href="http://www.sicoban.mx/"  class="link" style="float:right">Ya tengo cuenta</a>
</header>
<div class="content-main">
	<div class="subcontent-main" id="subcontent_main">
			<table  cellpadding="0" border="0" cellspacing="0" width="100%" >
				<tr>
					<td align="left">
						<img src="../images/icon_background.svg" alt="" width="300px" height="300px">
					</td>
					<td>
						<span>Registrate y empieza tu prueba gratis</span>
					</td>
				</tr>
			</table>
			<table cellpadding="0" border="0" cellspacing="0" width="100%" id="registertable">
				
				<tr>
					<td height="40px" align="left" valign="bottom" colspan="2"><span class="span--title">Nombre:</span></td>
					
				</tr>
				<tr>
					<td height="60px" align="left"><input type="text" id="client_name"   name="register" class="input-register" placeholder="Nombre"></td>
					<td align="right"><input type="text" id="client_lastname"  name="register" class="input-register" placeholder="Apellido"></td>
				</tr>
				<tr>
					<td colspan="2" height="40px" align="left" valign="bottom">
						<span class="span--title">Usuario:</span>
					</td>
				</tr>
				<tr>
					<td colspan="2" height="60px">
						<input type="text" id="client_user" name="register" class="input-rs" placeholder="Usuario">
					</td>
				</tr>
				<tr>
					<td colspan="2" height="40px" align="left" valign="bottom">
						<span class="span--title">Contraseña:</span>
					</td>
				</tr>
				<tr>
					<td colspan="2" height="60px">
						<input type="password" id="client_password" name="register" class="input-rs" placeholder="Al menos 6 caracteres">
					</td>
					<script>
					(function(){
						$('#client_password').on('blur', function(){
							if($(this).val().length <  6 ){
								$(this).addClass('input-error');
							} else {
								$(this).removeClass('input-error');
							}
						});
					})()
					</script>
				</tr>
				<tr>
					<td colspan="2" height="40px" align="left" valign="bottom">
						<span class="span--title">Correo Electrónico:</span>
					</td>
				</tr>
				<tr>
					<td colspan="2" height="60px">
						<input type="email" id="client_email" name="register" class="input-rs" placeholder="nombre@ejemplo.com">
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
					<td colspan="2" height="40px" align="left" valign="bottom">
						<span class="span--title">Teléfono:</span>
					</td>
				</tr>
				<tr>
					<td colspan="2" height="60px">
						<input type="tel" id="client_phone" name="register" class="input-rs" placeholder="(234) 555-555" onkeypress="return isNumber(event)" maxlength="10">
					</td>
				</tr>
					<tr>
					<td colspan="2" height="40px" align="left" valign="bottom">
						<span class="span--title">Ciudad:</span>
					</td>
				</tr>
				<tr>
					<td colspan="2" height="60px">
						<input type="text" id="client_city" name="register" class="input-rs" placeholder="Ciudad">
					</td>
				</tr>
			</table>
			<br>
			<br>
			<table cellpadding="0" border="0" cellspacing="0" width="100%">
			<tr>
				<td align="center">
					<input type="button"  value="AGREGAR" class="button-register" id="button-register" >
						<script>
						(function(){  $('#button-register').bind('click', function(){ 
							b = cx();
							( b == "SUCCESS") ?  $('body').PopWindow({ Width: '350', Height: '120', Url:'../msg.response/successful.reponse.php', Data: 'Se ha enviado un email al correo que proporciono.', Post:"msg"}) : $('body').PopWindow({ Width: '350', Height: '120', Url:'../msg.response/warning.reponse.php', Data: b, Post:"msg"})  }) })();		
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
</div>
</body>
</html>
<script>
	$(document).ready(function(){
		var x = document.getElementById("subcontent_main");
		
	});
</script>

