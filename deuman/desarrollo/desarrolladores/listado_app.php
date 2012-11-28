<?php

	//$aColumnsBD[$cont++]=$campo_pk;			
	 //$lista_campos= elimina_ultimo_caracter($lista_campos);
	 // echo $lista_campos."   $campo_pk<br>";		
	/*
	include("../../lib/connect_db.inc.php");
	include("../../lib/ft.inc");
	include("../../lib/correos.inc.php");
	
	include("../../lib/lib.inc.php");
	include("../../lib/lib.inc2.php");
	
	include("../../lib/lib.sgs.php");
	include("../../lib/seguridad.inc.php");*/
	
	
	
		
	$aColumns = array('nombre_app','fecha_creacion_app','token_app','ping_app','','');
	$aColumnsBD = array('nombre_app','DATE_FORMAT(fecha_creacion_app,"%d-%m-%Y")','token_app','ping_app','estado_app','id');
	
	
	function pos_array($valor,$array1,$array2){
	
		for ( $i=0 ; $i<count($array1) ; $i++ )
		{
			if($array1[$i]==$array2[$i]){
				return $i;
			}
		
		}
	}
	
	
	//$aColumnsBD = array( 'remitente', 'destinatario', 'fecha', 'hora', 'enviado' );
	
	//print_r($aColumnsBD);    
	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "id";

	/* DB table to use */
	$sTable = "deuman_app_desarrollo";
	
	$sLimit = "";
	if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
	{
		$sLimit = "LIMIT ".mysql_real_escape_string( $_GET['iDisplayStart'] ).", ".
			mysql_real_escape_string( $_GET['iDisplayLength'] );
	}else{
		$sLimit= "LIMIT 0,20";
	}
	
	
	/*
	 * Ordering
	 */
	$sOrder = "";
	if ( isset( $_GET['iSortCol_0'] ) )
	{
		$sOrder = "ORDER BY  ";
		for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
		{
			if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
			{
				$sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
				 	".mysql_real_escape_string( $_GET['sSortDir_'.$i] ) .", ";
			}
		}
		
		$sOrder = substr_replace( $sOrder, "", -2 );
		if ( $sOrder == "ORDER BY" )
		{
			$sOrder = "";
		}
	}
	
	
	/* 
	 * Filtering
	 * NOTE this does not match the built-in DataTables filtering which does it
	 * word by word on any field. It's possible to do here, but concerned about efficiency
	 * on very large tables, and MySQL's regex functionality is very limited
	 */
	$sWhere = "";
	if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
	{
	
		for ( $icont=0 ; $icont<count($aColumnsBD) ; $icont++ )
		{	
			switch ($icont) {
                 case 0:
                    
					 
					  $nombre_app = $_GET['sSearch'];
					  $sWhere .= " nombre_app LIKE '%".mysql_real_escape_string( $nombre_app )."%' OR ";
                     break;
				default:
            	// $sWhere .= $aColumnsBD[$i]." LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
            	 
                   
             }
			// echo "dfgdsfsd $i<br>";
			
		}
		$sWhere = substr_replace( $sWhere, "", -3 );
		$sWhere = " AND ( $sWhere ) ";
	}
	//echo $sWhere." wrwrwrw <br>";
	/* Individual column filtering */
	for ( $i=0 ; $i<count($aColumnsBD) ; $i++ )
	{
		if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
		{
			if ( $sWhere == "" )
			{
				$sWhere = " ";
			}
			else
			{
				$sWhere .= " AND ";
			}
			$sWhere .= $aColumnsBD[$i]." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
		}
	}
	//$_GET['id_responsable']= 501;
	
	/*
	
	$_GET['folio_consulta']= trim($_GET['folio_consulta']);
		if(isset($_GET['folio_consulta']) and $_GET['folio_consulta']!="" and $_GET['folio_consulta']!="#"){
	
		 	$sWhere .= " AND folio_consulta = '".$_GET['folio_consulta']."' ";
	 		
		}
	$_GET['fecha_ingreso']= trim($_GET['v']);
	if(isset($_GET['fecha_ingreso']) and $_GET['fecha_ingreso']!="" and $_GET['fecha_ingreso']!="#"){
	
		 	$sWhere .= " AND fecha_ingreso = '".$_GET['fecha_ingreso']."' ";
	}

	
	$_GET['fecha_termino']= trim($_GET['fecha_termino']);
		if(isset($_GET['fecha_termino']) and $_GET['fecha_termino']!="" and $_GET['fecha_termino']!="#"){
	
		 	$sWhere .= " AND fecha_termino  = '".$_GET['fecha_termino']."' ";
	 		
		}
	
	
	*/
	
	
	/*
	 * SQL queries
	 * Get data to display
	 $sQuery = "
		SELECT SQL_CALC_FOUND_ROWS *
		FROM   $sTable
		$sWhere
		$sOrder
		$sLimit
	";
	*/
	$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumnsBD))."
		FROM   $sTable
		WHERE 1 $and
		AND id_desarrollador=$id_usuario
		$sWhere 
		$sOrder
		$sLimit
	";
	//echo $sQuery;
	
	if($_GET['tp']==6){
		   echo $sQuery."<br><br>";
	}
	
	if($_GET['tp']==3){
		echo $sQuery ."<br>";
	}
	
	
	
	$rResult = cms_query( $sQuery ) or die(mysql_error()." linea 167<br>$sQuery");
	
	/* Data set length after filtering */
	$sQuery = "
		SELECT FOUND_ROWS()
	";
	$rResultFilterTotal = cms_query( $sQuery ) or die(mysql_error()." linea 173<br>$sQuery");
	$aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
	$iFilteredTotal = $aResultFilterTotal[0];
	
	/* Total data set length */
	$sQuery = "
		SELECT COUNT(".$sIndexColumn.")
		FROM   $sTable
		WHERE 1 $and
		$sWhere
		";
	$rResultTotal = cms_query( $sQuery ) or die(mysql_error()." linea 182<br>$sQuery");
	$aResultTotal = mysql_fetch_array($rResultTotal);
	$iTotal = $aResultTotal[0];
	

		$output = array(
		"sEcho" => intval($_GET['sEcho']),
		"iTotalRecords" => $iTotal,
		"iTotalDisplayRecords" => $iTotal,
		"aaData" => array()
		);
		
		
	while ( $aRow = mysql_fetch_array( $rResult ) )
	{
		$cont_r++;
		$row = array();
//		echo "--".count($aColumnsBD)." rrr<br>";

		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
	
			switch ($i) {
                
				case 0:
						$row[] =$aRow[$aColumnsBD[$i]];
                break;
				
				case 1:
						$row[] =$aRow[$aColumnsBD[$i]];
                break;
				
				case 2:
						$row[] = $aRow[$aColumnsBD[$i]];
                     break;
			
				case 3:
						$row[] = $aRow[$aColumnsBD[$i]];
                     break;
				case 4:	
						if($aRow[$aColumnsBD[$i]]==1)
							$estado="Activo";
						else	
							$estado="Inactivo";
						$row[] = $estado;
					break;	 
				case 5:	
						$idApp=  $aRow[$aColumnsBD[5]];
						$row[] = "<a style=\"cursor:pointer;\" id=\"editarApp\" onclick=\"editar_app($idApp)\">Editar</a>"; //$aRow[$aColumnsBD[$i]];
						
					break;
				/*
				case 5:
						$row[] = "<a style=\"cursor:pointer;\>asasa</a>";
                     break;
				*/	 
               	default:
						$row[] = $aRow[$aColumnsBD[$i]];
                   
             }
			
			
		}
		
	
		
		$folio =$aRow[$aColumnsBD[0]];
		//$aRow[3]="<a href=\"?accion=$accion&act=1&folio=$folio\">Editar</a>";
		//$row[] = $aRow[3];
		
		$output['aaData'][] = $row;
	}		
		
			/*
	 * Output
	 */

		//$output['aaData'][] = $row;

	require_once("lib/json.php");

		$json = new Services_JSON;

		echo $json->encode($output);

	
?>