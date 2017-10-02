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
					$sMove  = array();
					$node   = array();
					$book   = array();
					$i      = 0;
					$num_11 = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12);
	                $len_11 = array(2, 4, 4, 10, 6, 6, 1, 14, 3, 1, 23, 3, 3);
	                $num_32 = array(0, 1, 2, 3, 4,);
					$len_32 = array(2, 3, 2, 35, 35);
					$num_33 = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
	                $len_33 = array(2, 4, 4, 10, 5, 14, 5, 14, 1, 14, 3);
	                $num_22 = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
	                $len_22 = array(2, 4, 4, 6, 6, 2, 3, 1, 14, 10, 28);
	                $num_23 = array(0, 1, 2, 3);
					$len_23 = array(2, 2, 38, 38);
					
					while(!feof($myfile)) {

							
						
						$row  = fgets($myfile);
						$msg  = substr($row, 0, 2);

						if($msg == 11){
							$node[0] = bookRegister($row, $num_11, $len_11);
						} 

						
							if($msg == 22) {

								$book[0] = bookRegister($row, $num_22, $len_22);

							} 

							if($msg == 23) {
								$book[1]   = bookRegister($row, $num_23, $len_23);
								for ($m = 0; $m < count($book[1]) ; $m++) { 
									if($m != 0){
										array_push($book[0], $book[1][$m]);
									}
								}
							
								$node[1][] = $book[0];
								$book      = [];
							}
						


						if($msg == 32) {
							$node[2] = bookRegister($row, $num_32, $len_32);
						}


						if($msg == 33){
							$node[3] = bookRegister($row, $num_33, $len_33);;
								

							if(!isset($node[1])){
								$node[1] = [];
							}
							//print_r($node[1]);
							ksort($node);
							$sMove[$i] = $node;
							$i++;
							$node = [];
						
								

						}
						
								        

					}
					fclose($myfile);




		    	} else {

		    		$sMove = 'Error_File';
		    	}	

		    }	

		    

		    //echo(json_encode($sMove));
		  fileToExcel($sMove, $origin_name);
		  //print_r($sMove[0][1][0][0][0]);
		  //print_r($sMove[1]);
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
	$cab = array('Registro', 'Pais', 'Sucursal', 'Cuenta','Fecha Inicial','Fecha Final', 'Saldo', 'Saldo Inicial', 'Moneda','Digito Clabe', 'Titular de la Cuenta', 'Plaza Clabe', 'Libre');
	$reg_32 = array('Registro', 'Clave Pais', 'Subcodigo', 'Información 1', 'Información 2' );
	$reg_33 = array('Sucursal', 'Pais', 'Sucursal', 'Cuenta', 'No. de Cargos', 'Importe Total de cargos', 'No. de Abonos', 'Importe Total de Abonos', 'Saldo 2', 'Saldo Final', 'Moneda');
	$reg_22 = array('Registro', 'Pais', 'Sucursal', 'Fecha Operación', 'Fecha Valor', '', 'Clave Leyenda', 'Cargo/Abono', 'Importe', 'Dato', 'Concepto', 'Codigo Dato', 'Referencia Ampliada', 'Referencia');


	$utilities = new utilities();
	$img       = $utilities->selectNameImage();
	$color = null;
	$RGB   = 'FFFFFF';
	if(!is_null($img)){

		$row = $img->fetch_assoc();
		$color = $row['Us_Color'];

		if($color == 'FFFFFF'){
			$RGB = '000000';
		}

	}



	cellColor('A1'.':'.$abc[count($reg_22) - 2].'1', $color, $objPHPExcel);
	$objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A1', 'Reporte de Exportación cuaderno 43');	 
	$objPHPExcel->getActiveSheet()->getStyle('A1'.':'.$abc[count($reg_22) - 2].'1')->getFont()->setSize(18)->setName('Sans Serif')->getColor()->setRGB($RGB) 
				->getActiveSheet()->mergeCells('A1'.':'.$abc[count($reg_22) - 2].'1');	
	$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

	$row = 2;
	$cell = 2;
	for ($i = 0; $i <  count($data) ; $i++) { 

		for ($j=0; $j < count($data[$i][0]); $j++) { 

			$data_cab =  $data[$i][0][$j];
			switch ($j) {
				case 4:
				case 5:
					$data_cab =  $utilities->convertdate($data[$i][0][$j]); 
				break;
				case 6:
				case 7:
					$data_cab = '$'.$data[$i][0][$j];
				break;
			
			}
			
			if($j != 0){
				$objPHPExcel->setActiveSheetIndex()
				            ->setCellValue('A'.$row, $cab[$j]);
				$objPHPExcel->getActiveSheet()->getStyle('A'. $row)->getFont()->setBold(true)->setSize(11)->setName('Sans Serif')->getColor()->setRGB('000000') 
						    ->getActiveSheet()->mergeCells('A'.$row.':'.$abc[$cell - 1].$row);
				$objPHPExcel->getActiveSheet()->getStyle('A'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); 

				$objPHPExcel->setActiveSheetIndex()
				            ->setCellValue($abc[$cell].$row, $data_cab);
				$objPHPExcel->getActiveSheet()->getStyle($abc[$cell]. $row)->getFont()->setSize(8)->setName('Sans Serif')->getColor()
						    ->getActiveSheet()->mergeCells($abc[$cell].$row.':'.$abc[$cell + 2].$row);
				$objPHPExcel->getActiveSheet()->getStyle($abc[$cell].$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); 

			}
			$row++;
		}

		$row = $row - 13;
		$cell = $cell + 7;
		for ($l = 0; $l < count($data[$i][2]); $l++) { 

			if($l != 0){
				$objPHPExcel->setActiveSheetIndex()
				            ->setCellValue('G'.$row, $reg_32[$l]);
				$objPHPExcel->getActiveSheet()->getStyle('G'. $row)->getFont()->setBold(true)->setSize(11)->setName('Sans Serif')->getColor()->setRGB('000000') 
						    ->getActiveSheet()->mergeCells('G'.$row.':'.$abc[$cell - 1].$row);
				$objPHPExcel->getActiveSheet()->getStyle('G'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); 

				$objPHPExcel->setActiveSheetIndex()
				            ->setCellValue($abc[$cell].$row, $data[$i][2][$l]);
				$objPHPExcel->getActiveSheet()->getStyle($abc[$cell]. $row)->getFont()->setSize(8)->setName('Sans Serif')->getColor()
						    ->getActiveSheet()->mergeCells($abc[$cell].$row.':'.$abc[$cell + 1].$row);
				$objPHPExcel->getActiveSheet()->getStyle($abc[$cell].$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); 

			}
			$row++;

		}

	
		$row = $row + 1;
		//$cell = 9;
		for ($m = 0; $m < count($data[$i][3]); $m++) { 

				$data_reg33 =  $data[$i][3][$m];
				switch ($m) {
					case 5:
					case 7:
					case 8:
					case 9:
						$data_reg33 = '$'.$data[$i][3][$m];
					break;
					
				}
				if($m != 0){		
					$objPHPExcel->setActiveSheetIndex()
					            ->setCellValue('G'.$row, $reg_33[$m]);
					$objPHPExcel->getActiveSheet()->getStyle('G'. $row)->getFont()->setBold(true)->setSize(11)->setName('Sans Serif')->getColor()->setRGB('000000') 
							    ->getActiveSheet()->mergeCells('G'.$row.':'.$abc[$cell - 1].$row);
					$objPHPExcel->getActiveSheet()->getStyle('G'.$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); 

					$objPHPExcel->setActiveSheetIndex()
					            ->setCellValue($abc[$cell].$row, $data_reg33);
					$objPHPExcel->getActiveSheet()->getStyle($abc[$cell]. $row)->getFont()->setSize(8)->setName('Sans Serif')->getColor()
							    ->getActiveSheet()->mergeCells($abc[$cell].$row.':'.$abc[$cell + 1].$row);
					$objPHPExcel->getActiveSheet()->getStyle($abc[$cell].$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); 

			    }
				$row++;
		

		}

		$row = $row + 1;
		for ($k = 0; $k < count($reg_22); $k++) { 
			if($k != 0){
				cellColor('A'.$row.':'.$abc[count($reg_22) - 2].$row, $color, $objPHPExcel);
				$objPHPExcel->setActiveSheetIndex()
				            ->setCellValue($abc[$k - 1].$row, $reg_22[$k]);
				$objPHPExcel->getActiveSheet()->getColumnDimension($abc[$k - 1])->setAutoSize(true);   
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
		if(count($data[$i][1]) != 0){

		
			for ($p = 0; $p < count($data[$i][1]) ; $p++) { 

				for ($f = 0; $f < count($data[$i][1][$p]); $f++) {

						$data_cell = $data[$i][1][$p][$f];
						switch ($f) {
							case 3:
								$data_cell =  $utilities->convertdate($data[$i][1][$p][$f]); 
							break;
							case 4:
								$data_cell = $utilities->convertdate($data[$i][1][$p][$f]); 
							break;
							
							case 8:
								$data_cell = '$'.$data[$i][1][$p][$f]; 
							break;
							
							
						}
						
						if($f != 0){
							$objPHPExcel->setActiveSheetIndex()
						            ->setCellValue($abc[$f - 1].$row, $data_cell);
						    $objPHPExcel->getActiveSheet()->getColumnDimension($abc[$f - 1])->setAutoSize(true);
							$objPHPExcel->getActiveSheet()->getStyle($abc[$f - 1]. $row)->getFont()->setSize(9)->setName('Sans Serif')->getColor();
							$objPHPExcel->getActiveSheet()->getStyle($abc[$f - 1].$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); 
							$objPHPExcel->getActiveSheet()->getStyle($abc[$f - 1].$row.':'.$abc[$f - 1].$row)->applyFromArray(array(
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
				$row_paint = $p % 2;
			    if($row_paint == 1){

					cellColor('A'.$row.':'.$abc[count($reg_22) - 2].$row, 'F2F2F2', $objPHPExcel);  //se pintan las celdas en par
			     } 	
				$row++;
				
				
			}


			
		} else {

			$objPHPExcel->setActiveSheetIndex()
						->setCellValue($abc[0].$row, 'Sin Movimientos');	 
			$objPHPExcel->getActiveSheet()->getStyle($abc[0].$row.':'.$abc[count($reg_22) - 2].$row)->getFont()->setSize(12)->setName('Sans Serif')->getColor()->setRGB('000000') 
						->getActiveSheet()->mergeCells($abc[0].$row.':'.$abc[count($reg_22) - 2].$row);	
			$objPHPExcel->getActiveSheet()->getStyle($abc[0].$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle($abc[0].$row.':'.$abc[count($reg_22) - 2].$row)->applyFromArray(array(
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

		$row = $row + 4;
		$cell = $cell - 7;

	}//for principal


	

	
	//Guardado de reporte
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$nameExcel = $origin_name . ' [' .date('d-m-Y  H:i:s') .'].xlsx';
	$objWriter->save(str_replace('php//output', '.xlsx', $nameExcel));
	echo($nameExcel);
	//exit; 


}






































?>