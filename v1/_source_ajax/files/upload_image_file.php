<?php 

    ini_set('memory_limit', '2147483648M'); 
    ini_set('max_execution_time', 500);
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
			$msg = 'NO';
			if ($_FILES['image']['error'] > 0) {
	       		 
	       		 $msg = 'Error: ' . $_FILES['image']['error'];
		    }
		    else {

		    	$name     = $_FILES['image']['name'];
		    	$type     = $_FILES['image']['type'];
		    	$route    = '../../images/logos_company/';
		    	$tmp_name = $_FILES["image"]["tmp_name"];
		    	$size     = $_FILES['image']['size'];
		    	
		    	//$filename = $_FILES["image"]["name"];
				


		    	if($type != 'image/jpg' && $type != 'image/jpeg'){

		    		$msg = "Error, el archivo no es una imagen.";

		    	} else {


		    		if( $size > 1024*1024){

		    			$msg = 'Error, el tamaño máximo permitido es un 1MB.';
		    		} else {

		    			$extension   = end(explode(".", $name));
				        $newfilename = generateRandomString(45) .".".$extension;
		    			$sucess      = move_uploaded_file($tmp_name, $route. $newfilename);

		    			if($sucess){


		    				$images = new utilities();
		    				$img    = $images->uploadImage($newfilename);
		    				sleep(3);
		    				if(!is_null($img)){

		    					$msg = 'La foto ha sido cargada correctamente.';
		    				}

		    				
		    			} else{

		    				$msg = 'Ha ocurrido un error durante la carga de la foto intentelo de nuevo.';
		    			}


		    		}


		    	}


		    }

		    echo($msg);
		}

	}


function generateRandomString($length) {

    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {

        $randomString .= $characters[rand(0, $charactersLength - 1)];

    }
    return $randomString;

}


 ?>