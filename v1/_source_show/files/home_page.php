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

		require_once('../../_source_classes/images/utilities.class.php');
		require_once('../../_db_conecction/dbconecction.php');
		$image = new utilities();
		$img   = $image->selectNameImage();
		$image_name = null;
		if(!is_null($img)){

			$image_name = $img->fetch_assoc();

		}
		
?>

<div style="width:30%; float: right; height: calc(20vh); text-align:center;  margin-top:30px; padding: 0px 15px">
	<img src="../images/icon_edit.svg" alt="" height="70px" width="70px">
	<br>
	<span style="color:#607D8B; font-size:13px;">
		Da de alta tu información de emprsa para tener un mejor control.
	</span>
</div>

<div style="width:30%; float: right; height: calc(20vh); text-align:center;  margin-top:40px;  padding: 0px 15px">
	<img src="../images/icon_setting.svg" alt="" height="60px" width="60px">
	<br>
	<span style="color:#607D8B; font-size:13px;">
		Tan sencillo como elegir la opcion del formato que desees, y cargarlo para que se convierta.
	</span>
</div>

<div style="width:30%; float: right; height: calc(20vh); text-align:center; margin-top:40px;  padding: 0px 15px">
	
      <img src="../images/icon_upload.svg" alt="" height="60px" width="60px">
      <br>
      <span style="color:#607D8B; font-size:13px;">
      	  Te permite subir una imagen para que tus formatos sean personaizados.
      </span>
</div>	

<div style="width:100%;  height: calc(30vh); overflow:hidden; border-top: 2px solid #F2F2F2">
    <br>
   
	<span style="color:#607D8B; font-size:13px;"> Elige una foto para que aparesca en sus arhivos excel, y asi darle una mejor presentación.</span>

	<br>
    <br>

    <input id="uploadFile_photo" class="ui-input-photo" placeholder="Elige una imagen" disabled="disabled" />
    <div class="fileUpload">
   			 <span>Cargar</span>
    		<input type="file" class="upload" id="upload-imagen" accept=".jpeg, .jpg" onchange="uploadPhoto(this)" />
	</div>
	<br>
	<div style="width:20%;  height:100px; overflow:hidden; text-align: center; float:left;">
<?php

		if(!empty($image_name['Us_Logo'])){

		
 ?>
			<img src="<?php  echo('../images/logos_company/'.$image_name['Us_Logo']);?>" alt="" style="float:left; max-width:100%; height:auto;">
<?php 

		} else {

 ?>		
	 		<img src="../images/no-image.svg" alt=""   width="100px" height="100px" style="float:left">

<?php 
	
	    }

 ?>


	</div>
	<input type="button" style="float: right; margin-right: 15px; margin-top:68px;" id="" class="red2" value="<?php echo('NUEVA IMAGEN'); ?>" onclick="uploadPhotoToServer()" >

    
</div>
<div style="width:100%;  height: calc(40vh); overflow:hidden; border-top: 2px solid #F2F2F2; position:relative">
	<br>
	<span style="color:#607D8B; font-size:13px;">Elige un color para personalizar tu formato de excel.</span>
	<br>
    <br>
    <table width="40%" cellspacing="5" cellpadding="0" border="0">
    	<tr>
    		<td><div  id="option_1" data-color="01579B" onclick="pickAColor(this)" style="width:50px; height:50px; background: #01579B; border-radius:5px; border: 2px solid #E6E6E6; cursor:pointer" ></div></td>
    		<td><div  id="option_2" data-color="E86860" onclick="pickAColor(this)" style="width:50px; height:50px; background: #E86860; border-radius:5px; border: 2px solid #E6E6E6; cursor:pointer"></div></td>
    		<td><div  id="option_3" data-color="2ECCFA" onclick="pickAColor(this)" style="width:50px; height:50px; background: #2ECCFA; border-radius:5px; border: 2px solid #E6E6E6; cursor:pointer" ></div></td>
    		<td><div  id="option_4" data-color="FEE361" onclick="pickAColor(this)" style="width:50px; height:50px; background: #FEE361; border-radius:5px; border: 2px solid #E6E6E6; cursor:pointer" ></div></td>
    		<td><div  id="option_5" data-color="FFFFFF" onclick="pickAColor(this)" style="width:50px; height:50px; background: #FFFFFF; border-radius:5px; border: 2px solid #E6E6E6; cursor:pointer" ></div></td>
    	</tr>
    	<tr>
    		<td><div  id="option_6" data-color="F15A29" onclick="pickAColor(this)" style="width:50px; height:50px; background: #F15A29; border-radius:5px; border: 2px solid #E6E6E6; cursor:pointer" ></div></td>
    		<td><div  id="option_7" data-color="76C2AF" onclick="pickAColor(this)" style="width:50px; height:50px; background: #76C2AF; border-radius:5px; border: 2px solid #E6E6E6; cursor:pointer"></div></td>
    		<td><div  id="option_8" data-color="F5CF87" onclick="pickAColor(this)" style="width:50px; height:50px; background: #F5CF87; border-radius:5px; border: 2px solid #E6E6E6; cursor:pointer" ></div></td>
    		<td><div  id="option_9" data-color="77B3D4" onclick="pickAColor(this)" style="width:50px; height:50px; background: #77B3D4; border-radius:5px; border: 2px solid #E6E6E6; cursor:pointer" ></div></td>
    		<td><div  id="option_10" data-color="32733C" onclick="pickAColor(this)" style="width:50px; height:50px; background: #32733C; border-radius:5px; border: 2px solid #E6E6E6; cursor:pointer" ></div></td>
    	</tr>
    </table>
   
	
	
	

	<img  src="../images/screenshoot_report.png" height="170px" width= "170px" style="border-radius:50%; position:absolute; right:50px; top:20px;">
</div>



                	


<?php 

}

}

 ?>