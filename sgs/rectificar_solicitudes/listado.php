<?php


	$aColumns = array('folio','fecha_inicio','fecha_termino','id_responsable','plazo','id_sub_estado_solicitud');
	$aColumnsBD = array('folio','fecha_inicio','fecha_termino','id_responsable','id_sub_estado_solicitud');


	$sIndexColumn = "id_solicitud_acceso";
	$sTable = "sgs_solicitud_acceso ";
	
	

	
	$Estados_pendiente_rectificacion = configuracion_cms('Estados_pendiente_rectificacion');
	$id_user= id_usuario($id_sesion);
	
	$resultado_int = Verifica_plazo_estado($Estados_pendiente_rectificacion,$id_usuario);
	 
	   $query= "SELECT super_admin
                FROM  usuario_perfil
                WHERE id_perfil='$id_perfil' ";
          $result= mysql_query($query)or die (error($query,mysql_error(),$php));
         list($super_admin) = mysql_fetch_row($result);
		 
	 
	 if($super_admin!=1){
	 $query= "SELECT id_entidad 
               FROM  usuario
               WHERE id_usuario='$id_user'";
         $result= mysql_query($query)or die (error($query,mysql_error(),$php));
          if(list($id_entidad_user) = mysql_fetch_row($result)){
		  	$and = $and." AND id_entidad =  '$id_entidad_user' ";
		  }
		
	 }
		  
		  
	
	/*Fin conf*/
	
	/* 
	 * Paging
	 */
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
                    
					 
					  $folio_busca = $_GET['sSearch'];
					   $sWhere .= " folio LIKE '%".mysql_real_escape_string( $folio_busca )."%' OR ";
					 
					
                     break;
            	 case 1:
                    
					 if(strlen($_GET['sSearch'])==10){
					  $fecha_ini = fechas_bd($_GET['sSearch']);
					   $sWhere .= $aColumnsBD[$i]." LIKE '%".mysql_real_escape_string( $fecha_ini )."%' OR ";
					 }
					
                     break;
            	 case 2:
				  	if(strlen($_GET['sSearch'])==10){
				  		$fecha_ini = fechas_bd($_GET['sSearch']);
					 	$sWhere .= $aColumnsBD[$i]." LIKE '%".mysql_real_escape_string( $fecha_ini )."%' OR ";
                   
				  	}
                     
                     break;
               	case 3:
						
							 
					break;
			       break;
               	case 4:
						
							 
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
	
	$_GET['id_responsable']= trim($_GET['id_responsable']);
		if(isset($_GET['id_responsable']) and $_GET['id_responsable']!="" and $_GET['id_responsable']!="#"){
	
		 	$sWhere .= " AND id_responsable = '".$_GET['id_responsable']."' ";
	 		
		}
	
	/*$_GET['id_estado_solicitud_filtro']= trim($_GET['id_estado_solicitud_filtro']);
		if(isset($_GET['id_estado_solicitud_filtro']) and $_GET['id_estado_solicitud_filtro']!="" and $_GET['id_estado_solicitud_filtro']!="#"){
	
		 	$sWhere .= " AND id_sub_estado_solicitud  = '".$_GET['id_estado_solicitud_filtro']."' ";
	 		
		}*/
	
	$_GET['tipo_filtro']= trim($_GET['tipo_filtro']);
		if(isset($_GET['tipo_filtro']) and $_GET['tipo_filtro']!="" and $_GET['tipo_filtro']!="undefined"){
	
		 	$sWhere .= " AND folio like '%".$_GET['tipo_filtro']."-%' ";
	 		
		}
	$_GET['mis_solicitudes']= trim($_GET['mis_solicitudes']);
	if(isset($_GET['mis_solicitudes']) and $_GET['mis_solicitudes']!="" and $_GET['mis_solicitudes']!="#"){
	
		 	$sWhere .= " AND id_responsable = '".$_GET['mis_solicitudes']."' ";
	}

	//echo $sWhere ;
	
	/*
	 * SQL queries
	 * Get data to display
	
	*/
	$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumnsBD))."
		FROM   $sTable
		WHERE 1 and id_sub_estado_solicitud in ($Estados_pendiente_rectificacion) 
		$sWhere
		$sOrder
		$sLimit
	";
	
	
	
	//echo $sQuery ."<br>";
	
	
	$rResult = mysql_query( $sQuery ) or die(mysql_error()." linea 167<br>$sQuery");
	
	/* Data set length after filtering */
	$sQuery = "
		SELECT FOUND_ROWS()
	";
	$rResultFilterTotal = mysql_query( $sQuery ) or die(mysql_error()." linea 173<br>$sQuery");
	$aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
	$iFilteredTotal = $aResultFilterTotal[0];
	
	/* Total data set length */
	$sQuery = "
		SELECT COUNT(".$sIndexColumn.")
		FROM   $sTable
		WHERE 1 and id_sub_estado_solicitud in ($Estados_pendiente_rectificacion) 
		$sWhere
		";
	$rResultTotal = mysql_query( $sQuery ) or die(mysql_error()." linea 182<br>$sQuery");
	$aResultTotal = mysql_fetch_array($rResultTotal);
	$iTotal = $aResultTotal[0];
	

		$output = array(
		"sEcho" => intval($_GET['sEcho']),
		"iTotalRecords" => $iTotal,
		"iTotalDisplayRecords" => $iFilteredTotal,
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
                 case 1:
                   		$row[] = fechas_html($aRow[$aColumnsBD[$i]]);
                     break;
            	 case 2:
				 	$id_sub_estado_solicitud =$aRow[$aColumnsBD[4]];
				
					 $folio =$aRow[$aColumnsBD[0]];		
					
					$query= "SELECT fecha  
						 FROM  sgs_flujo_estados_solicitud
						 WHERE folio='$folio' and id_estado_solicitud='$id_sub_estado_solicitud' 
						 order by id_flujo_estados_solicitud desc";
				// echo $query;
					  $result_resp= cms_query($query)or die (error($query,mysql_error(),$php));
					  list($fecha_respuesta) = mysql_fetch_row($result_resp);
					  $aRow[$aColumnsBD[2]]= fechas_html($fecha_respuesta);		
                      $row[] = fechas_html($aRow[$aColumnsBD[2]]);
                     break;
               	 case 4:
				 /*CALCULO DE PLAZO DE RESPUESTA*/
				 
						 $id_sub_estado_solicitud =$aRow[$aColumnsBD[4]];
						 $fecha_ingreso =$aRow[$aColumnsBD[1]];		
						 $folio =$aRow[$aColumnsBD[0]];	
				
						//$plazo= saca_plazo($folio,$id_sub_estado_solicitud,$fecha_ingreso);
						$plazo = Calcula_plazo_rectificar($folio);
				 		
						//$fecha_termino= $aRow[$aColumnsBD[2]]; 
				 		$aRow[$aColumns[4]]=$plazo;
				 		$row[] = $aRow[$aColumns[4]];
						 /*FIN CALCULO DE PLAZO DE RESPUESTA*/
                     break;
                 case 5:
				 		
				 		$id_sub_estado_solicitud =$aRow[$aColumnsBD[4]];
				 		$query= "SELECT estado_solicitud  
					             FROM  sgs_estado_solicitudes
				      		     WHERE id_estado_solicitud = '$id_sub_estado_solicitud'";
					      //echo $query."<br>"; 
						   $result_sgs_estado_solicitudes= cms_query($query)or die (error($query,mysql_error(),$php));
     						list($estado_solicitud) = mysql_fetch_row($result_sgs_estado_solicitudes);
	 
				 		$aRow[$aColumnsBD[5]]=$estado_solicitud;
                     
						$row[] = $aRow[$aColumnsBD[5]].$get;
                     break;
               	default:
            	  $row[] = $aRow[$aColumnsBD[$i]];
            	 
                   
             }
			
			
		}
		
	
		
		$folio =$aRow[$aColumnsBD[0]];
		$aRow[6]="<a href=\"?accion=$accion&act=1&folio=$folio\">Rectificar</a>";
		$row[] = $aRow[6];
		
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