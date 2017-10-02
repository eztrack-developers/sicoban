<?php 


ini_set('memory_limit', '2147483648M'); 
ini_set('max_execution_time', 500);
error_reporting(E_ALL);
	header ("Expires: Fri, 14 Mar 1980 20:53:00 GMT");
	header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header ("Cache-Control: no-cache, must-revalidate");
	header ("Pragma: no-cache");


		require_once '../../PHPExcel/Classes/PHPExcel.php';
	if(!isset($_SESSION))
	{

		session_start(); 
		session_cache_limiter('nocache, private');
		if(isset($_SESSION['id']))
		{

			require_once('../../_source_classes/images/utilities.class.php');
		    require_once('../../_db_conecction/dbconecction.php');
			$sMove = null;
			if ($_FILES['file']['error'] != 'text/plain') {
	       		 echo 'Error: ' . $_FILES['file']['error'] . '<br>';
		    }
		    else {

		    	if(strpos($_FILES['file']['name'], '.exp') || strpos($_FILES['file']['name'], '.txt')){
		    		move_uploaded_file($_FILES['file']['tmp_name'], '../uploads/' . $_FILES['file']['name']);

		    		$inputFileName = '../uploads/' . $_FILES['file']['name'];
		    		$origin_name = substr( $_FILES['file']['name'], 0, -4);
		    		$myfile = fopen($inputFileName, "r") or die("Unable to open file!");

      
		    		
		    		$array_columns = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14);
		    		$array_lenght  = array(18, 10, 6, 30, 1, 16, 3, 9, 30, 7, 10, 12, 3, 3, 4);
		    		$array_node    = array();
		    		$x = 0;
		    		while(!feof($myfile)) {
		    			$row  = fgets($myfile);
		    			
		    			$array_node[$x] = bookRegister($row, $array_columns, $array_lenght);

		    			$x++;
		    		}


		        }
		        		
		    }

		 fileToExcel($array_node, $origin_name );   
		//echo(json_encode($array_node));

		}

	}


function bookRegister($register, $num, $len){

	$arr = array();
    $start = 0;
 	for($r = 0; $r < count($num) ; $r++){

		
		if($r == $num[$r]){
	
			$arr[$r] = substr($register, $start, $len[$r]);
			$start = $start + $len[$r];

		}



	}

	return $arr;

}

function cellColor($cells,$color, $objPHPExcel){ //funcion que pinta las celdas
   

    $objPHPExcel->getActiveSheet()->getStyle($cells)->getFill()->applyFromArray(array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array(
             'rgb' => $color
        )
    ));
}

function fileToExcel($data, $origin_name ) {

	$objPHPExcel = new PHPExcel();
	$objPHPExcel->createSheet();
	$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getProperties()->setCreator("Validator");
	$objPHPExcel->getActiveSheet()->setShowGridlines(false);

	$abc = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
	$reg = array('Cuenta', 'Fecha Valor', 'Folio Banco', 'Transacción', 'Tipo de Movimiento', 'Importe', 'Moneda', 'Folio Aceptación', 'Referencia', 'Contrato',  'Fecha Operación', 'Nombre contrato CW', 'Código Transacción', 'Tipo Operación', 'Plaza');

	$image = new utilities();
	$img   = $image->selectNameImage();
	$color = null;
	$RGB   = 'FFFFFF';
	if(!is_null($img)){

		$row = $img->fetch_assoc();
		$color = $row['Us_Color'];

		if($color == 'FFFFFF'){
			$RGB = '000000';
		}

	}


	cellColor('A1'.':'.$abc[count($reg) - 1].'1',$color, $objPHPExcel);
	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A1', 'Reporte de Estados de cuenta Cash Windows');	 
	$objPHPExcel->getActiveSheet()->getStyle('A1'.':'.$abc[count($reg) - 1].'1')->getFont()->setSize(18)->setName('Sans Serif')->getColor()->setRGB($RGB) 
				->getActiveSheet()->mergeCells('A1'.':'.$abc[count($reg) - 1].'1');	
	$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

	$gdImage = imagecreatefromjpeg('../../images/logos_company/'. $row['Us_Logo']);  
	$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
	$objDrawing->setName('Sample image');
	$objDrawing->setDescription('Sample image');
	$objDrawing->setImageResource($gdImage);
	$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);
	$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
	$objDrawing->setHeight(85);
	$objDrawing->setCoordinates($abc[count($reg) - 3].'3');
	$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

	$row = 8;
	for ($k = 0; $k < count($reg); $k++) { 
			
		cellColor('A'.$row.':'.$abc[count($reg) - 1].$row,$color, $objPHPExcel);
		$objPHPExcel->setActiveSheetIndex()
		            ->setCellValue($abc[$k].$row, $reg[$k]);
		//$objPHPExcel->getActiveSheet()->getColumnDimension($abc[$k])->setAutoSize(true);   
		$objPHPExcel->getActiveSheet()->getRowDimension($abc[$k])->setRowHeight(25);           
		$objPHPExcel->getActiveSheet()->getStyle($abc[$k]. $row)->getFont()->setBold(true)->setSize(13)->setName('Arial')->getColor()->setRGB($RGB); 
		$objPHPExcel->getActiveSheet()->getStyle($abc[$k].$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 

		if($color == "FFFFFF"){
			$objPHPExcel->getActiveSheet()->getStyle($abc[$k].$row.':'.$abc[$k].$row)->applyFromArray(array(
												            'borders' => array(
												                'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN, 
												                                      'color' => array('rgb' => '000000')
												                                      ),
												                'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN, 
												                                      'color' => array('rgb' => '000000')
												                                      )
												               
												            )
												        ));

		}
		
		
	}

    $row = $row + 1;
	for ($i = 0; $i < count($data) -1 ; $i++) { 

		
		
		for ($j = 0; $j < count($data[$i]); $j++) {

			$string_data = $data[$i][$j];
			switch ($j) {
				case  0:
					$string_data = "'".$data[$i][$j];
				break;
				
				case 5:
					$string_data = '$'.$data[$i][$j];
				break;
			}
			$objPHPExcel->setActiveSheetIndex()
		            ->setCellValue($abc[$j].$row, $string_data);
		    $objPHPExcel->getActiveSheet()->getColumnDimension($abc[$j])->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getStyle($abc[$j]. $row)->getFont()->setSize(9)->setName('Sans Serif')->getColor();

			if(is_numeric($data[$i][$j])){
				$objPHPExcel->getActiveSheet()->getStyle($abc[$j].$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); 
			} else {

				$objPHPExcel->getActiveSheet()->getStyle($abc[$j].$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); 
			}
			
			$objPHPExcel->getActiveSheet()->getStyle($abc[$j].$row.':'.$abc[$j].$row)->applyFromArray(array(
											            'borders' => array(
											                'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN, 
											                                      'color' => array('rgb' => 'D8D8D8')
											                                      ),
											                'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN, 
											                                      'color' => array('rgb' => 'D8D8D8')
											                                      )
											               
											            )
											        ));

			
		}
		$row_paint = $i % 2;
	    if($row_paint == 1){

			cellColor('A'.$row.':'.$abc[count($reg) - 1].$row, 'F2F2F2', $objPHPExcel);  //se pintan las celdas en par
	     } 	
		$row++;
	} 


	//Guardado de reporte
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$nameExcel = $origin_name . ' [' .date('d-m-Y  H:i:s') .'].xlsx';
	$objWriter->save(str_replace('php//output', '.xlsx', $nameExcel));
	echo($nameExcel);
	//exit; 

}






 ?>


