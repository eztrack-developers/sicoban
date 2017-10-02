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


?>

	<h4><?php echo('Estados de cuenta Cash Windows'); ?></h4>	
	<hr>
	</br>
	<a style="float:right" class="btn btn--gray not-active" id="5CashFilePointExcel_btn" onclick="importFileExcelPoints(this, 6)">
		<i class="icon-arrow-shuffle"></i>
		<span>Convertir</span>
	</a>
	<!--<span><input type="button" style="float: right; margin-right: 15px;" id="5CashFilePointExcel_btn" class="gray2" value="<?php echo('Convertir Archivo'); ?>" disabled="disabled" onclick="importFileExcelPoints(this, 6)" ></span>-->
	<div class="draganddrop" ondrop="drop(event)" ondragover="dragover(event)" ondragenter="dragenter(event)" id="dragFile">
		<img src="../images/icon_asset.svg" alt="" width="300" height="200" class=""><br>
		<span>
			<span class="browse-wrap">
				<span class="tiitleimport"><?php echo('Selecciona un archivo'); ?>
				<input type="file" id="5CashFilePointExcel" name="importfile" class="importfile" accept=".exp, .txt" onchange="selectItemFile(this)"></span>
				 <span style="color: #607D8B; font-size: 18px;"><?php echo('o arrastra y suelta aquí'); ?></span>
			</span>
			
		</span>
		<span id="5CashFilePointExcel_Name" class="upload-path"></span>
	</div>

	
	 <div style="width: 99%" id="pointsNotFounds">
	 	
	 </div>


  <!--- dialogo de confirmacion -->
  <div id="msg_upload_excel_file" style="display: none;"></div>
                	


<?php 

}

} 

 ?>