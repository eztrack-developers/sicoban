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

	<h4><?php echo('Movimientos del día C43 (sólo registro 22)'); ?></h4>	
	<hr>
	</br>
	<button class="btn btn--full btn--gray" style="float:right"  id="5movementsimportfile_btn" disabled="disabled" onclick="importFileExcelPoints(this, 2)">
			<img src="../images/icon_converter.svg" alt="" height="12px" width="12px" style="float:left; margin-top:1px;">
			<div class="float:right;">Convertir</div>
	</button>

	<div class="draganddrop" ondrop="drop(event)" ondragover="dragover(event)" ondragenter="dragenter(event)" id="dragFile">
		<img src="../images/icon_asset.svg" alt="" width="300" height="200" class=""><br>
		<span>
			<span class="browse-wrap">
				<span class="tiitleimport"><?php echo('Selecciona un archivo'); ?>
				<input type="file" id="5movementsimportfile" name="importfile" class="importfile" accept=".exp, .txt" onchange="selectItemFile(this)"></span>
				 <span style="color: #607D8B; font-size: 18px;"><?php echo('o arrastra y suelta aquí'); ?></span>
			</span>
			
		</span>
		<span id="5movementsimportfile_Name" class="upload-path"></span>
	</div>

	 </br>
	 </br>
	 <div style="width: 99%" id="pointsNotFounds">
	 	
	 </div>


  <!--- dialogo de confirmacion -->
  <div id="msg_upload_excel_file" style="display: none;"></div>
                	


<?php 

}

} 

 ?>