<?php 

    error_reporting(E_ALL);
	

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
<div style="width:100%;  height: calc(30vh); overflow:hidden;">
    <br>   
	<span style="color:#607D8B; font-size:15px;"> Elige una foto para que aparesca en sus arhivos excel, y asi darle una mejor presentación.</span>
	<br>
    <br>
   
    <button class="fileUpload btn btn--full btn--red" style="float:right">
            <img src="../images/icon_add.svg" alt="" height="9px" width="9px" style="float:left; margin-top:1px;">
   			<div class="float:right; height:15px; border:1px solid green;">Nueva Imagen</div>
    		<input type="file" class="upload" id="upload-imagen" accept=".jpeg, .jpg" onchange="uploadPhoto(this)" />
	</button>
	 <div id="msg-error-img" style="float:right; padding:7px 20px;" class="msg_error"></div>
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
	

    
</div>
<div style="width:100%;  height: calc(40vh); overflow:hidden; border-top: 2px solid #F2F2F2; position:relative">
	<br>
	<span style="color:#607D8B; font-size:15px;">Elige un color para personalizar tu formato de excel.</span>
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