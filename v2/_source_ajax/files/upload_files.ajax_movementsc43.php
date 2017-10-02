<?php 


ini_set('memory_limit', '2147483648M'); 
ini_set('max_execution_time', 500);
error_reporting(E_ALL);
	header ("Expires: Fri, 14 Mar 1980 20:53:00 GMT");
	header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header ("Cache-Control: no-cache, must-revalidate");
	header ("Pragma: no-cache");


		require_once '../../PHPExcel/Classes/PHPExcel.php';
		require_once('../../_source_classes/images/utilities.class.php');
		require_once('../../_db_conecction/dbconecction.php');
	if(!isset($_SESSION))
	{

		session_start(); 
		session_cache_limiter('nocache, private');
		if(isset($_SESSION['id']))
		{

			$sMove = null;
			if ($_FILES['file']['error'] != 'text/plain') {
	       		 echo 'Error: ' . $_FILES['file']['error'] . '<br>';
		    }
		    else {

		    	if(strpos($_FILES['file']['name'], '.exp') || strpos($_FILES['file']['name'], '.txt')){


		    		move_uploaded_file($_FILES['file']['tmp_name'], '../uploads/' . $_FILES['file']['name']);

		    		$inputFileName = '../uploads/' . $_FILES['file']['name'];
		    		$myfile = fopen($inputFileName, "r") or die("Unable to open file!");
		    		$origin_name = substr( $_FILES['file']['name'], 0, -4);
      
		    		
		    		$book11 = array(0, 1);
		    		$lenght_book11  = array(2, 17);

		    		$book22         = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13);
		    		$lenght_book22  = array(2, 9, 15, 25, 37, 1, 16, 16, 3, 4, 8, 8, 8, 8);

		    		$flag = false;
		    		$array_node    = array();

		    		$node          = array();
		    		$book          = array();

		    		$count = 0;
		    		//while(!feof($myfile)) { $count++; }

		    		$x = 0;
		    		while(!feof($myfile)) {

		    			$row  = fgets($myfile);
		    			$msg  = substr($row, 0, 2);


		    			if($msg == 11){
		    				
		    				if($flag == false){

									$node[0] = bookRegister($row, $book11, $lenght_book11);
									$flag    = true;

		    				} else {

		    					$array_node [$x] = $node;
		    					$node    = [];
		    					$node[0] = bookRegister($row, $book11, $lenght_book11);
		    					$x++;
		    				}
		    		

		    			}

		    			if($msg == 22){
		    				$book[0] = bookRegister($row, $book22, $lenght_book22);
		    				$node[1][] = $book[0];

		    				

		    			}
	    			
		    		}
		    		$array_node [$x] = $node;

		        }
		        		
		    }

		fileToExcel($array_node, $origin_name);   
		//echo(json_encode($array_node[0][0][1]));

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

function fileToExcel($data, $origin_name) {

	$objPHPExcel = new PHPExcel();
	$objPHPExcel->createSheet();
	$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getProperties()->setCreator("Validator");
	$objPHPExcel->getActiveSheet()->setShowGridlines(false);

	$abc = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
	$reg = array('Registro', '#Movimiento', 'Referencia', 'Concepto', 'Referencia Ampliada', 'Cargo(1) Abono(0)', 'Importe', 'Saldo operativo después de Movto.', 'Código de leyenda', 'Oficina que Operó', 'Fecha Operación', 'Hora Operación', 'Fecha Valor', 'Fecha Contable');

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
	cellColor('A1'.':'.$abc[count($reg) - 2].'1',$color, $objPHPExcel);
	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A1', 'Reporte de Movimientos del día C43 (sólo registro 22)');	 
        $objPHPExcel->getActiveSheet()->getStyle('A1'.':'.$abc[count($reg) - 2].'1')->getFont()->setSize(18)->setName('Sans Serif')->getColor()->setRGB($RGB) 
				->getActiveSheet()->mergeCells('A1'.':'.$abc[count($reg) - 2].'1');	
	$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

	

	$gdImage = imagecreatefromjpeg('../../images/logos_company/'. $row['Us_Logo']);  
	$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
	$objDrawing->setName('Sample image');
	$objDrawing->setDescription('Sample image');
	$objDrawing->setImageResource($gdImage);
	$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);
	$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
	$objDrawing->setHeight(85);
	$objDrawing->setCoordinates($abc[count($reg) - 2].'3');
	$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());



	$row = 7;
	$cell = 2;

   
	for ($i = 0; $i < count($data); $i++) { 

		$objPHPExcel->setActiveSheetIndex()
		            ->setCellValue('A'.$row, 'No. de Cuenta: ' . $data[$i][0][1]);
		$objPHPExcel->getActiveSheet()->getStyle('A'. $row)->getFont()->setBold(true)->setSize(11)->setName('Sans Serif')->getColor()->setRGB('000000') 
				    ->getActiveSheet()->mergeCells('A'.$row.':'.$abc[$cell].$row);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); 
/*
		$objPHPExcel->setActiveSheetIndex()
		            ->setCellValue($abc[$cell + 1].$row, $data[$i][0][1]);
		$objPHPExcel->getActiveSheet()->getStyle($abc[$cell + 1]. $row)->getFont()->setBold(true)->setSize(10)->setName('Sans Serif')->getColor()->setRGB('FFA039') 
				    ->getActiveSheet()->mergeCells($abc[$cell + 1].$row.':'.$abc[3].$row);
		$objPHPExcel->getActiveSheet()->getStyle($abc[$cell + 1].$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); */




		$row = $row + 2;
		for ($k = 0; $k < count($reg); $k++) { 
				
			if($k != 0){	
				cellColor('A'.$row.':'.$abc[count($reg) - 2].$row, $color, $objPHPExcel);
				$objPHPExcel->setActiveSheetIndex()
				            ->setCellValue($abc[$k - 1].$row, $reg[$k]);
	            if($k == 1){
	            	$objPHPExcel->getActiveSheet()->getColumnDimension($abc[$k])->setAutoSize(true);  
	            }
				$objPHPExcel->getActiveSheet()->getRowDimension($abc[$k - 1])->setRowHeight(25);    
				 	 $objPHPExcel->getActiveSheet()->getStyle($abc[$k - 1]. $row)->getFont()->setBold(true)->setSize(12)->setName('Arial')->getColor()->setRGB($RGB);  
				$objPHPExcel->getActiveSheet()->getStyle($abc[$k - 1].$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 

				if($color == 'FFFFFF'){
					$objPHPExcel->getActiveSheet()->getStyle($abc[$k - 1].$row.':'.$abc[$k - 1].$row)->applyFromArray(array(
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
			
		}

		
	

		$row = $row + 1;
		for ($j = 0; $j < count($data[$i][1]) ; $j++) {

			for ($b = 0; $b < count($data[$i][1][$j]) ; $b++) { 

				if($b != 0){

					$objPHPExcel->setActiveSheetIndex()
			            ->setCellValue($abc[$b -1].$row, ($b == 6 || $b == 7) ? '$'.$data[$i][1][$j][$b] : $data[$i][1][$j][$b] );
			         if($b != 1){   
				    		$objPHPExcel->getActiveSheet()->getColumnDimension($abc[$b])->setAutoSize(true);
						}
					$objPHPExcel->getActiveSheet()->getStyle($abc[$b -1]. $row)->getFont()->setSize(9)->setName('Sans Serif')->getColor();
					 if(is_numeric($data[$i][1][$j][$b])) {
					 	$objPHPExcel->getActiveSheet()->getStyle($abc[$b -1].$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); 
					 } else {
					 	$objPHPExcel->getActiveSheet()->getStyle($abc[$b -1].$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); 

					 }
					
					$objPHPExcel->getActiveSheet()->getStyle($abc[$b -1].$row.':'.$abc[$b -1].$row)->applyFromArray(array(
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
				
			}
			$row_paint = $j % 2;
		    if($row_paint == 1){

				cellColor('A'.$row.':'.$abc[count($reg) - 2].$row, 'F2F2F2', $objPHPExcel);  //se pintan las celdas en par
		     } 	
			$row++;
			
		}

		$row = $row + 3;
		
	} 


	//Guardado de reporte
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$nameExcel = $origin_name . ' [' .date('d-m-Y  H:i:s') .'].xlsx';
	$objWriter->save(str_replace('php//output', '.xlsx',$nameExcel));
	echo($nameExcel);
	//exit; 

}






 ?>