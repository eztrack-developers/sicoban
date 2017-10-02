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
		   require_once('../../_db_conecction/dbconecction.php');
		  
		  	$obj = new DatabaseConnection();
			$lnk = $obj->getConnection();	 
					
			if($lnk->connect_errno) {
				$sOutput = '{';
				$sOutput .= '"sEcho": '.intval($_POST['sEcho']).', ';
				$sOutput .= '"recordTotal": 1, ';
				$sOutput .= '"recordsFiltered": 1, ';
				$sOutput .= '"Data": [ ["NO INFO (DB Connect Failed)"] ';
				$sOutput .= '] }';
				echo $sOutput;			
				exit();				
			}	

			$aColumns = array('Us_Id', 'Us_User', 'Us_Name', 'Us_LastName', 'Us_Phone', 'Us_City', 'Us_Email', 'Actions');
			/*  Local functions */
			function fatal_error ( $sErrorMessage = '' )
			{
				header( $_SERVER['SERVER_PROTOCOL'] .' 500 Internal Server Error' );
				die( $sErrorMessage );
			}	


				// Paging
			
			$sLimit = "";
			if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
			{
				$sLimit = " LIMIT ".intval( $_GET['iDisplayStart'] ).", ".
					intval( $_GET['iDisplayLength'] );
			}


			$sOrder = "";
			if ( isset( $_GET['iSortCol_0'] ) )
			{
				$sOrder = "ORDER BY  ";
				for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
				{
					if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
					{
						$sOrder .= "`".$aColumns[ intval( $_GET['iSortCol_'.$i] ) ] . "` " . ($_GET['sSortDir_'.$i]==='asc' ? 'asc' : 'desc') .", ";

					}
				}
				$sOrder = substr_replace( $sOrder, "", -2 );
				if ( $sOrder == "ORDER BY" )
				{
					$sOrder = "";
				}
			}


			// Individual column filtering 
			$sWhere = ''; 
			if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
			{	
				//echo($_GET['sSearch']);
				//$search = 0;

				$sWhere .= " where ";
				for ($i = 0 ; $i < count($aColumns); $i++)
				{
					if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true")// && $_GET['sSearch_'.$i] != '' )
					{
						switch($i) {
							case 1:
								$sWhere .= " `Us_User` LIKE '%" . $lnk->real_escape_string($_GET['sSearch']) . "%' or ";
							break;							
							case 2:
								$sWhere .= " `Us_Name` LIKE '%" . $lnk->real_escape_string($_GET['sSearch']) . "%' or ";
							break;
							case 3:
								$sWhere .= " `Us_LastName` LIKE '%" . $lnk->real_escape_string($_GET['sSearch']) . "%' or ";
							break;
							case 4:
								$sWhere .= " `Us_Phone` LIKE '%" . $lnk->real_escape_string($_GET['sSearch']) . "%' or ";
							break;
							case 5:
								$sWhere .= " `Us_City` LIKE '%" . $lnk->real_escape_string($_GET['sSearch']) . "%' or ";
							break;
							case 6:
								$sWhere .= " `Us_Email` LIKE '%" . $lnk->real_escape_string($_GET['sSearch']) . "%' or ";
							break;			
						}
					}
				}
				$sWhere = substr_replace( $sWhere, "", -3 );		
				$sWhere .= " ";	
			}

		
			$query  = "select Us_Id, Us_User, Us_Name, Us_LastName, Us_Phone, Us_City, Us_Email from ban_user";
			$query .= $sWhere;
			$query .= $sOrder;
			$query .= $sLimit;
			$query .= ";";
			//echo($query);
			$rResult = $lnk->query($query);
			if(!$rResult) {
				fatal_error( 'MySQL Error {1}: ' . $lnk->error() ); 
			}  


			$fQuery = "SELECT FOUND_ROWS();";
			$iFilteredTotal = 0;	
			if($rResultFilterTotal = $lnk->query($fQuery)) {
				$row = $rResultFilterTotal->fetch_array(MYSQLI_NUM);
				$iFilteredTotal = $row[0];		
			}
			else {
				fatal_error( 'MySQL Error {2}: ' . '   ' . $fQuery );
			}
	
			$totalQuery = "select count(Us_Id) from ban_user";
			$rResultTotal = $lnk->query($totalQuery);
			$iTotal = 0;
			if($rResultTotal) {
				$row = $rResultTotal->fetch_array(MYSQLI_NUM);
				$iTotal = $row[0];	

			}	
			else {
				fatal_error( 'MySQL Error {3}: ' . '   ' . $totalQuery );
			}


		
			$output = array(
				"sEcho" => intval($_GET['sEcho']),
				"iTotalRecords" => $iTotal,
				"iTotalDisplayRecords" => $iFilteredTotal,
				"aaData" => array()
			);

	
			while ( $aRow = $rResult->fetch_array())
			{
				$row = array();
				for ( $i=0 ; $i<count($aColumns) ; $i++ )
				{

					if ( $aColumns[$i] == "Us_Id" )
					{
						/* Special output formatting for 'version' column */
						$row[] = ($aRow[ $aColumns[$i] ] == "0") ? '-' : $aRow[ $aColumns[$i] ];
					}
					if ( $aColumns[$i] == "Us_User" )
					{
						/* Special output formatting for 'version' column */
						$row[] = ($aRow[ $aColumns[$i] ] == "0") ? '-' : $aRow[ $aColumns[$i] ];
					}
					if ( $aColumns[$i] == "Us_Name" )
					{
						/* Special output formatting for 'version' column */
						$row[] = ($aRow[ $aColumns[$i] ] == "0") ? '-' : $aRow[ $aColumns[$i] ];
					}
					
					if ( $aColumns[$i] == "Us_LastName" )
					{
						/* Special output formatting for 'version' column */
						$row[] = ($aRow[ $aColumns[$i] ] == "0") ? '-' : $aRow[ $aColumns[$i] ];
					}
					
					if ( $aColumns[$i] == "Us_Phone" )
					{
						$row[] = $aRow[ $aColumns[$i] ];
					}	
					if ( $aColumns[$i] == "Us_City" )
					{
						$row[] = $aRow[ $aColumns[$i] ];
					}	
					if ( $aColumns[$i] == "Us_Email" )
					{
						$row[] = $aRow[ $aColumns[$i] ];
					}

					if ( $aColumns[$i] == "Actions" )
					{
						$row[] = '';
					}			
					
				}
				$output['aaData'][] = $row;
			}


		}   
	}

	echo json_encode( $output );	   
?>