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
	 <img src="../images/ajax-loader.gif" height="35px" width="35px" alt="" style="margin-top:5px; margin-right:25px;">
	 <span style="color:#607D8B; font-size:16px;">Convirtiendo Archivo...</span>
 </div>
<?php
}else {
	 header("Location: ../../_source_classes/users/sessionout.php");
}
  ?>