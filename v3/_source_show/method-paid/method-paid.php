
<?php 

    error_reporting(E_ALL);
	if(!isset($_SESSION))
	{
	
		@session_start(); 
		//session_cache_limiter('nocache, private');
		if(!isset($_SESSION['id']))
		{
			  header("Location: ../_source_classes/users/sessionout.php");
		} else {	

 ?>
 <span style="color:#607D8B; font-size:22px;">PAGOS</span>
<hr/>
<!-- <span style="position:absolute; top:235px; left:300px; background:#FFFFFF; padding: 0 15px; color:#E86860">Pago</span> -->
<!-- 
<div style="border: 1px solid #EFC7C7; text-align: left; display: table; height:50px; width:100%; margin-top:20px; border-radius:5px; background:#F2DEDE;">
	<span style="color:#A9485A; display: table-cell; vertical-align:middle; padding-left: 30px; font-size:14px"> <label style="font-size:15px !important; font-weight: bold !important; color:#A9485A;">! Ingrese su pago</label> para poder accesar</span>
</div>
<div style="border: 1px solid silver; height:400px; width:100%; margin-top:20px; text-alig:center">
	
	<img src="../images/method-paid.svg" alt="" style="margin-top:10px;" height="360px" width="280px" />
</div>
	
<div style="margin-top:20px;">	
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
	<input type="hidden" name="cmd" value="_s-xclick">
	<input type="hidden" name="hosted_button_id" value="3S6WFBXWQVKVU">
	<input type="image" src="https://www.paypalobjects.com/es_XC/MX/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal, la forma más segura y rápida de pagar en línea.">
	<img alt="" border="0" src="https://www.paypalobjects.com/es_XC/i/scr/pixel.gif" width="1" height="1">
	</form>
</div> -->
	<span style="font-size:30px">
		En Construcción!!!
	</span>

<?php 
	  		
	   }
    } 
?>