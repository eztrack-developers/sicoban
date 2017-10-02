<?php 
 error_reporting(E_ALL);
header ("Expires: Fri, 14 Mar 1980 20:53:00 GMT");
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
if(!isset($_SESSION))
{




 ?>
 <div style="width:100%; height:calc(13vh); text-align:center; line-height:calc(13vh); display:table">
	<a style="margin-left:0px;" class="btn btn--red"  id="my-account">
		<i class="icon-user"></i>
		<span>Mi Cuenta</span>
	</a>
	<a style="margin-left:45px;" class="btn btn--red"  id="my-suscription" >
		<i class="icon-creditcard"></i>
		<span>Suscribirse</span>
	</a>
	<a style="margin-left:40px;" class="btn btn--red" href="javascript:closeSession('../_source_classes/users/sessionout.php')">
		<i class="icon-sign-out"></i>
		<span>Cerrar Sesión</span>
	</a>
	<script>

	$(function(){
		$('#my-suscription').bind('click', function(){
			_destroy();
			setTimeout(function(){
				 $('body').PopWindow({ Width: '800', Height: '400', Url:'../_source_show/method-paid/method-paid.php'})
			}, 1000);
		});
		$('#my-account').bind('click', function(){
			_destroy();
			setTimeout(function(){
				loadScrips('../_source_show/clients/myaccount.form.php')
			}, 500);
		});
	});
	</script>
 </div>
<?php
}else {
	 header("Location: ../../_source_classes/users/sessionout.php");
}
  ?>