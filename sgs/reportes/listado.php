<?php

	include("../../lib/connect_db.inc.php");
	//include("../../lib/ft.inc");
	//include("../../lib/correos.inc.php");
	
	include("../../lib/lib.inc.php");
	include("../../lib/lib.inc2.php");
	
	include("../../lib/lib.sgs.php");
	include("../../lib/seguridad.inc.php");
	
	$aColumns = array('folio','fecha_inicio','fecha_termino','fecha_respuesta','plazo','id_sub_estado_solicitud','id_responsable');
	$aColumnsBD = array('folio','fecha_inicio','fecha_termino','id_sub_estado_solicitud','id_responsable');

	$sIndexColumn = "id_solicitud_acceso";
	$sTable = "sgs_solicitud_acceso ";
	
	

	
	
	$Estados_pendiente_rectificacion = configuracion_cms('Estados_pendiente_rectificacion');
	$id_user= id_usuario($id_sesion);
	 
	 /*$query= "SELECT id_entidad 
               FROM  usuario
               WHERE id_usuario='$id_user'";
         $result= mysql_query($query)or die (error($query,mysql_error(),$php));
          if(list($id_entidad_user) = mysql_fetch_row($result)){
		  	$and = $and." AND id_entidad =  '$id_entidad_user' ";
		  }*/
		  
	$_GET['id_entidad'] = trim($_GET['id_entidad']);
	if(isset($_GET['id_entidad']) and $_GET['id_entidad']!="" and $_GET['id_entidad']!="#"){
		$sWhere .= " AND id_entidad = '".$_GET['id_entidad']."' ";
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
	if(isset($_GET['mes']) and $_GET['mes']!="" and $_GET['mes']!="#" and $_GET['mes']!="undefined"){
		$mes = $_GET['mes'];
	}
	if(isset($_GET['periodo']) and $_GET['periodo']!="" and $_GET['periodo']!="#" and $_GET['periodo']!="undefined"){
		$periodo = $_GET['periodo'];
	}
	if(isset($_GET['id_entidad']) and $_GET['id_entidad']!="" and $_GET['id_entidad']!="#" and $_GET['id_entidad']!="undefined"){
		$id_entidad = $_GET['id_entidad'];
	}
	if(isset($_GET['id_estado_solicitud']) and $_GET['id_estado_solicitud']!="" and $_GET['id_estado_solicitud']!="#" and $_GET['id_estado_solicitud']!="undefined"){
		$id_estado_solicitud = $_GET['id_estado_solicitud'];
	}
	if(isset($_GET['id_responsable']) and $_GET['id_responsable']!="" and $_GET['id_responsable']!="#" and $_GET['id_responsable']!="undefined"){
		$id_responsable = $_GET['id_responsable'];
	}
	if(isset($_GET['id_pais']) and $_GET['id_pais']!="" and $_GET['id_pais']!="#" and $_GET['id_pais']!="undefined" and $_GET['id_pais']!="null"){
		$id_pais = $_GET['id_pais'];
	}
	if(isset($_GET['id_region']) and $_GET['id_region']!="" and $_GET['id_region']!="#" and $_GET['id_region']!="undefined" and $_GET['id_region']!="null"){
		$id_region = $_GET['id_region'];
	}
	if(isset($_GET['id_comuna']) and $_GET['id_comuna']!="" and $_GET['id_comuna']!="#" and $_GET['id_comuna']!="undefined" and $_GET['id_comuna']!="null"){
		$id_comuna = $_GET['id_comuna'];
	}
	if(isset($_GET['id_categoria']) and $_GET['id_categoria']!="" and $_GET['id_categoria']!="#" and $_GET['id_categoria']!="undefined" and $_GET['id_categoria']!="null"){
		$id_categoria = $_GET['id_categoria'];
		if ($id_categoria!=""){
			$sFromCat = " left outer join sgs_solicitud_acceso_categoria c on c.folio = a.folio";
			$sWhere .= " and c.id_categoria= '$id_categoria'";
		}
	}
	
	
	/**********/
	
	/********/
	//echo "responsable:".$id_responsable;

	//echo "mes:".$mes;
	//echo "periodo:".$periodo;
	$_GET['act'] = trim($_GET['act']);
	if(isset($_GET['act']) and $_GET['act']!="" and $_GET['act']!="#" ){
		$act = $_GET['act'];

	if ($mes!=""){
		if ($act==6){
			$sWhere .= " and MONTH(fecha_termino)= $mes";
		}else{
			$sWhere .= " and MONTH(fecha_inicio)= $mes";
		}
	}
	if ($periodo!=""){
		if ($act==6){
			$sWhere .= " and YEAR(fecha_termino)= $periodo";
		}else{
			$sWhere .= " and YEAR(fecha_inicio)= $periodo";
		}
	}	
	if ($id_entidad!=""){
		$sWhere .= " and a.id_entidad= $id_entidad";
	}

	//poner las condiciones de las ubicaciones geograficas
	$sFrom = "";
	$activarOuter = 0;
	//echo "id pais: ".$id_pais;
	if (($id_pais !="51") and ($id_pais!="")){
		$id_region = "";
		$id_comuna = "";
		$sWhere  .= "  and b.id_pais = '$id_pais'";
		$activarOuter = 1;
	}
	if ($id_pais =="") {
		$id_region = "";
		$id_comuna = "";
	}
	if ($id_region != ""){
		$sWhere .= " and b.id_region = '$id_region'";
		$activarOuter = 1;
	}
	if ($id_comuna != ""){
		$sWhere .= " and b.id_comuna = '$id_comuna'";
		$activarOuter = 1;
	}
	if ($activarOuter == 1){
		$sFrom = " left outer join usuario b on a.id_usuario = b.id_usuario ";
	}
	
	
	
		//echo "act:".$act;
		
		switch ($act){
			case 1://total de solicitudes según periodo
				if ($id_estado_solicitud!=""){
					$sWhere .=  " and id_sub_estado_solicitud in ($id_estado_solicitud)";
				}
				break;
			case 2://ingresos sin asignar
				$estado = "1,2";
				if ($id_estado_solicitud==""){
					$sWhere .= " and id_sub_estado_solicitud in ($estado) and  id_responsable='0' ";
				}else{
					$sWhere .= " and id_sub_estado_solicitud in ($id_estado_solicitud)  and  id_responsable='0'";
				}
				break;
			case 3:
				$estados = "6,8";
				if ($id_estado_solicitud==""){
					$sWhere .= " and id_sub_estado_solicitud in ($estados)";
				}else{
					$sWhere .=  " and id_sub_estado_solicitud in ($id_estado_solicitud)";
				}
				break;
			case 4:
				$estados = "21,22";
				if ($id_estado_solicitud==""){
					$sWhere .= " and id_sub_estado_solicitud in ($estados)";
				}else{
					$sWhere .= " and id_sub_estado_solicitud in ($id_estado_solicitud)";
				}
				break;
			case 5://dias por vencer
				if(isset($_GET['dias']) and $_GET['dias']!="" and $_GET['dias']!="#" and $_GET['dias']!="undefined"){
					$dias = $_GET['dias'];
				}
				//echo "<br> dias:".$dias."<br>";
				//$dias = $dias * -1;
				$fecha_actual = date('Y-m-d');
				$fecha_fin = sumaDiasHabiles($fecha_actual,$dias);
			
				$estado = "1,2,3,4,5,6,7,8,9,10,11,12,26";
				if ($id_estado_solicitud==""){
					$sWhere .= " and id_sub_estado_solicitud in ($estado)";
				}else{
					$sWhere .= " and id_sub_estado_solicitud in ($id_estado_solicitud)";
				}
				$sWhere .= " AND a.fecha_termino >= CURRENT_DATE		
									AND a.fecha_termino <= '$fecha_fin'	";
				
				break;
			case 6:
				$estado = "1,2,3,4,5,6,7,8,9,10,11,12";
				if ($id_estado_solicitud==""){
					$sWhere .= " and id_sub_estado_solicitud in ($estado) ";
				}else{
					$sWhere .= " and id_sub_estado_solicitud in ($id_estado_solicitud)";
				}
				$sWhere .= " and a.fecha_termino < CURRENT_DATE() ";
				break;
			case 7://con reserva o secreto
				$estado = "22";
				$sWhere .= " and id_sub_estado_solicitud in ($estado) ";
				break;
			case 8://sin reserva o secreto
				$estado = "14,15,16,17,18,19,20,21,23,27,28,29";
				if ($id_estado_solicitud==""){
					$sWhere .= " and id_sub_estado_solicitud in ($estado) ";
				}else{
					$sWhere .= " and id_sub_estado_solicitud in ($id_estado_solicitud)";
				}
				break;
			case 9://derivadas
				$estado = "24";
				$sWhere .= " and id_sub_estado_solicitud in ($estado) ";
				break;
			case 10://impagas
				$estado = "14";
				$sWhere .= " and id_sub_estado_solicitud in ($estado) ";
				break;
			case 11://ingresos totales segun responsable
				if ($id_estado_solicitud !=""){
					$sWhere .=  " and id_sub_estado_solicitud = $id_estado_solicitud ";
				}
				if ($id_responsable !=""){
					$sWhere .=  " and id_responsable = '$id_responsable' ";
				}
				break;
			
		}
	} 
	
	
	
	
	if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
	{
	
		for ( $icont=0 ; $icont<count($aColumnsBD) ; $icont++ )
		{	
			
			switch ($icont) {
                 case 0:
					  $folio_busca = $_GET['sSearch'];
					  if ($sWhere1!=""){
							$sWhere1 .= " and ";
					   }
                      $sWhere1 .= " folio LIKE '%".mysql_real_escape_string( $folio_busca )."%'  ";
                     break;
            	 case 1:
						
					 if(strlen($_GET['sSearch'])==10){
					  $fecha_ini = fechas_bd($_GET['sSearch']);
					 	if ($sWhere1!=""){
							$sWhere1 .= " and ";
						}

					  $sWhere1 .= $aColumnsBD[$i]."  LIKE '%".mysql_real_escape_string( $fecha_ini )."%'  ";
					 }
					
                     break;
            	 case 2:
					
				  	if(strlen($_GET['sSearch'])==10){
				  		$fecha_ini = fechas_bd($_GET['sSearch']);
						if ($sWhere1!=""){
							$sWhere1 .= " and ";
						}
					 	$sWhere1 .= $aColumnsBD[$i]."  LIKE '%".mysql_real_escape_string( $fecha_ini )."%'  ";
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
		//$sWhere1 = substr_replace( $sWhere1, "", -3 );
		$sWhere = " AND ( $sWhere1 ) ";
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
			}else
			{
				$sWhere .= " AND ";
			}
			$sWhere .= $aColumnsBD[$i]." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
		}
	}
	//$_GET['id_responsable']= 501;
	
	/*$_GET['id_responsable']= trim($_GET['id_responsable']);
		if(isset($_GET['id_responsable']) and $_GET['id_responsable']!="" and $_GET['id_responsable']!="#"){
	
		 	$sWhere .= " AND id_responsable = '".$_GET['id_responsable']."' ";
	 		
		}*/
	
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
	//armar la tabla para exportar a excel
	$sQuery = "	SELECT a.folio,
						fecha_inicio,
						fecha_termino,
						id_sub_estado_solicitud,
						id_responsable
				FROM   $sTable a
					$sFrom
					$sFromCat 
				WHERE 1 
				$sWhere
				$sOrder
	";
	
	
 
	
	$csv_separador=";";
	$csv_fin_linea = "\n";
	$Estados_etapa_fin ="14,15,".configuracion_cms('Estados_etapa_fin');
	$tabla_csv = "Folio".$csv_separador."Fecha ingreso".$csv_separador."Fecha estimada de término".$csv_separador."Fecha de término".$csv_separador."Plazo".$csv_separador."Estado".$csv_fin_linea;
	
	$tabla_mail = "<table  width=\"100%\" class=\"textos\"  cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"display\" id=\"listado\" >
		<thead>
		<tr>
			<td width=\"17%\">Folio</td>
			<td width=\"18%\">Fecha Ingreso</td>

			<td width=\"23%\">Fecha estimada de t&eacute;rmino</td>
			<td width=\"18%\">Fecha de t&eacute;rmino</td>
			<td width=\"13%\">Plazo</td>
			<td width=\"11%\">Estado</td>
		</tr>
		<thead>";
		


	
	$result = mysql_query( $sQuery ) or die(mysql_error()." linea 167<br>$sQuery");
	while($linea = mysql_fetch_array($result)){
		$folio = $linea["folio"];
		$fecha_inicio = $linea["fecha_inicio"];
		$fecha_termino = $linea["fecha_termino"];
		$id_responzable = $linea["id_responzable"];
		$id_sub_estado_solicitud = $linea["id_sub_estado_solicitud"];
		
		if ($fecha_inicio=="0000-00-00"){
			$fecha_inicio = "";
		}
		
		if ($fecha_termino=="0000-00-00"){
			$fecha_termino = "";
		}
		
		$fecha_respuesta = "";
		
		$query= "SELECT fecha  
					 FROM  sgs_flujo_estados_solicitud
					 
					 WHERE folio='$folio' and id_estado_solicitud='$id_sub_estado_solicitud' 
						and id_estado_solicitud in ($Estados_etapa_fin)
					 order by id_flujo_estados_solicitud desc";
					 //echo "\n".$query;
		$result_resp= cms_query($query)or die (error($query,mysql_error(),$php));
		$fecha_respuesta = "";
		if(list($fecha_respuesta) = mysql_fetch_row($result_resp)){
			$fecha_respuesta = fechas_html($fecha_respuesta); 
		}
		//$plazo= saca_plazo_excel($folio,$id_sub_estado_solicitud,$fecha_inicio);
		$plazo= saca_plazo($folio,$id_sub_estado_solicitud,$fecha_ingreso);
		$plazo = str_replace("&nbsp;"," ",$plazo);
		$plazo = str_replace("&iacute;","í",$plazo);
		$plazo = str_replace("&aacute;","á",$plazo);
		
		//echo "\n".$plazo;
		$query= "SELECT estado_solicitud  
							 FROM  sgs_estado_solicitudes
							 WHERE id_estado_solicitud = '$id_sub_estado_solicitud'
							 	";
							 
				    //echo $query."<br>"; 
		$result_sgs_estado_solicitudes= cms_query($query)or die (error($query,mysql_error(),$php));
		list($estado) = mysql_fetch_row($result_sgs_estado_solicitudes);
		$estado = acentos_inverso($estado);
		
		$tabla_csv .= $folio.$csv_separador.$fecha_inicio.$csv_separador.$fecha_termino.$csv_separador.$fecha_respuesta.$csv_separador.$plazo.$csv_separador.$estado.$csv_fin_linea;
		$tabla_mail .= "<tr>
							  <td>$folio</td>
							  <td>$fecha_inicio</td>
							  <td>$fecha_termino</td>
							  <td>$fecha_respuesta</td>
							  <td>$plazo</td>
							  <td>Estado</td>
					  </tr>";
	}
	$tabla_mail.="</table>";
	$_SESSION['tabla_csv'] = $tabla_csv;
	$_SESSION['tabla_mail'] = $tabla_mail;
	
	//fin armar excel
	


	
	
	$sQuery = "
		SELECT a.folio,
						fecha_inicio,
						fecha_termino,
						'' fecha_respuesta,
						'' plazo,
						id_sub_estado_solicitud,
						id_responsable
		FROM   sgs_solicitud_acceso a
		
			$sFrom
			$sFromCat 
		WHERE 1 
		$sWhere
		$sOrder
		$sLimit
	";
	//echo $sQuery;
	
	 
	
	
	
	$rResult = mysql_query( $sQuery ) or die(mysql_error()." linea 167<br>$sQuery");
	
	/* Data set length after filtering */
	$sQuery = "
		SELECT a.folio,
						fecha_inicio,
						fecha_termino,
						'' fecha_respuesta,
						'' plazo,
						id_sub_estado_solicitud,
						id_responsable
		FROM   sgs_solicitud_acceso a
		
			$sFrom
			$sFromCat 
		WHERE 1 
		$sWhere
	";
	//echo $sQuery;
	$rResultFilterTotal = mysql_query( $sQuery ) or die(mysql_error()." linea 173<br>$sQuery");
	$aResultFilterTotal = mysql_num_rows($rResultFilterTotal);
	$iFilteredTotal = $aResultFilterTotal;
	
	/* Total data set length */
	/*$sQuery = "
		SELECT COUNT(".$sIndexColumn.")
		FROM   $sTable a
			$sFrom
			$sFromCat 
		WHERE 1 $sWhere
		";
	$rResultTotal = mysql_query( $sQuery ) or die(mysql_error()." linea 182<br>$sQuery");
	$aResultTotal = mysql_fetch_array($rResultTotal);*/
	$iTotal = $aResultFilterTotal;
	

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
				case 0://folio
					$folio = $aRow[$aColumnsBD[0]];	
					$folio = "<a href='index.php?accion=reportes-de-solicitudes&act=$act&nivel=Detalle&id_entidad_padre=$id_entidad_padre&id_entidad=$id_entidad&periodo=$periodo&mes=$mes&folio=$folio'>$folio</a>";
					$row[] = $folio;
					break;
                case 1://fecha inicio
                	$row[] = fechas_html($aRow[$aColumnsBD[$i]]);
                    break;
            	case 2://fecha termino
				 	
                    $row[] = fechas_html($aRow[$aColumnsBD[2]]);
                    break;
				 case 3://fecha de respuesta
					$id_sub_estado_solicitud = $aRow[$aColumnsBD[3]];
					$folio = $aRow[$aColumnsBD[0]];	
					$Estados_etapa_fin ="14,15,".configuracion_cms('Estados_etapa_fin');
					$query= "SELECT fecha  
							 FROM  sgs_flujo_estados_solicitud
							 
							 WHERE folio='$folio' and id_estado_solicitud='$id_sub_estado_solicitud' 
							 	and id_estado_solicitud in ($Estados_etapa_fin)
							 order by id_flujo_estados_solicitud desc";
							// echo $query;
					$result_resp= cms_query($query)or die (error($query,mysql_error(),$php));
					$fecha_respuesta = "";
					if(list($fecha_respuesta) = mysql_fetch_row($result_resp)){
						$fecha_respuesta = fechas_html($fecha_respuesta); 
					}
					//echo "<br>fecha de respuesta:". $fecha_respuesta;
					$aRow[$aColumns[3]] = $fecha_respuesta;
				 
					$row[] = $aRow[$aColumns[3]].$get;
						
                     break;
				case 4:
					/*CALCULO DE PLAZO */
					$id_sub_estado_solicitud = $aRow[$aColumnsBD[3]];
					$fecha_ingreso = $aRow[$aColumnsBD[1]];		
					$folio = $aRow[$aColumnsBD[0]];	
					$plazo= saca_plazo($folio,$id_sub_estado_solicitud,$fecha_ingreso);
					//$plazo = Calcula_plazo_rectificar($folio);
					//$fecha_termino= $aRow[$aColumnsBD[2]]; 
					$aRow[$aColumns[4]] = $plazo;
					$row[] = $aRow[$aColumns[4]];
					/*FIN CALCULO DE PLAZO DE RESPUESTA*/
                    break;
				case 5:
					$id_sub_estado_solicitud = $aRow[$aColumnsBD[3]];
					
					$query= "SELECT estado_solicitud  
							 FROM  sgs_estado_solicitudes
							 WHERE id_estado_solicitud = '$id_sub_estado_solicitud'
							 	";
							 
				    //echo $query."<br>"; 
				    $result_sgs_estado_solicitudes= cms_query($query)or die (error($query,mysql_error(),$php));
					list($estado_solicitud) = mysql_fetch_row($result_sgs_estado_solicitudes);
					
					$aRow[$aColumns[5]] = $estado_solicitud;
					$row[] = $aRow[$aColumns[5]].$get;
                    break;
					 
                
               	 
                case 6:
					$id_responsable = $aRow[$aColumnsBD[4]];
					
					$query= "SELECT concat(nombre,' ',paterno)
							 From usuario where id_usuario = '$id_responsable'
							 	";
							 
				    //echo $query."<br>"; 
				    $result_sgs_estado_solicitudes= cms_query($query)or die (error($query,mysql_error(),$php));
					list($estado_solicitud) = mysql_fetch_row($result_sgs_estado_solicitudes);
					
					$aRow[$aColumns[6]] = $estado_solicitud;
					$row[] = $aRow[$aColumns[6]];
                    break;
				
				
               	default:
            	  	$row[] = $aRow[$aColumnsBD[$i]];
					break;
            	 
             }
			
			
		}
		
		//$folio = $aRow[$aColumnsBD[0]];
		//$aRow[6]="<a href=\"?accion=$accion&act=1&folio=$folio\">Rectificar</a>";
		//$row[] = $aRow[6];
		
	$output['aaData'][] = $row;
	}		
		
			/*
	 * Output
	 */

		//$output['aaData'][] = $row;

	require_once("../../lib/json.php");

		$json = new Services_JSON;

		echo $json->encode($output);



?>