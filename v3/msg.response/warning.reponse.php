<?php 
header ("Expires: Fri, 14 Mar 1980 20:53:00 GMT");
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
error_reporting(0);

if(isset($_POST["msg"]))
{
		$msg = $_POST["msg"];
?>
 <div style="width:100%; height:calc(11vh); text-align:center; line-height:calc(11vh); display:table">
	 <i class="icon-warning-msg" style="padding-right:10px;"></i>
	 <span style="color:#607D8B; font-size:14px;"><?php echo($msg) ?></span>
 </div>
<?php	
}
 ?>