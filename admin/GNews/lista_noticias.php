<?php


 $query= "SELECT id_publicador   
           FROM  noticias_id_publicador 
           WHERE id_publicador='$id_usuario'";
     $result2= cms_query($query)or die (error($query,mysql_error(),$php));
   if(list($id_publicador) = mysql_fetch_row($result2)){
			$publicador="ok";
			   
		 }
		
 
	$aColumns   = array('titulo','id_tipo','Gal','Ver','Ok','Edit', 'Del','Click');
	$aColumnsBD = array('titulo','id_tipo','id_galeria','visible','estado','id_noticia','click');
	
	
	function pos_array($valor,$array1,$array2){
	
		for ( $i=0 ; $i<count($array1) ; $i++ )
		{
			if($array1[$i]==$array2[$i]){
				return $i;
			}
		
		}
	}
	
	
  
	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "id_noticia";

	/* DB table to use */
	$sTable = "noticias";
	
	
	
	$sLimit = "";
	if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
	{
		$sLimit = "LIMIT ".mysql_real_escape_string( $_GET['iDisplayStart'] ).", ".
			mysql_real_escape_string( $_GET['iDisplayLength'] );
	}else{
		$sLimit= "LIMIT 0,10";
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
			$sOrder = "ORDER BY id_noticia desc";
		}
	}else{
	 $sOrder = "ORDER BY id_noticia desc";
	 
	}
	
	
	/* 
	 * Filtering
	 * NOTE this does not match the built-in DataTables filtering which does it
	 * word by word on any field. It's possible to do here, but concerned about efficiency
	 * on very large tables, and MySQL's regex functionality is very limited
	 */
	$sWhere = "";
	

	
	// Busqueda por rut
	if(isset($_GET['sSearch']) && $_GET['sSearch']!="" ){
				
            $sWhere .= "and  titulo LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' ";				
	}
	
	
	
	
	$_GET['id_tipo']= trim($_GET['id_tipo']);
		if(isset($_GET['id_tipo']) and $_GET['id_tipo']!="" and $_GET['id_tipo']!="#"){
	
		 	$sWhere .= " AND id_tipo  = '".$_GET['id_tipo']."' ";
	 		
		}
	
	
	
	 $sOrder = "ORDER BY id_noticia desc";
	//QUERY SOLICITUDES A LISTAR
	$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS ".implode(",", $aColumnsBD)."
		FROM   $sTable
		WHERE 1 
		$and
		$sWhere 
		$sOrder
		$sLimit
	";
	
	
	
	
	if($_GET['tp']==6){
		   echo $sQuery."<br><br>";
	}
	
	
	
	
	
	$rResult = mysql_query( $sQuery ) or die(mysql_error()." linea 167<br>$sQuery");
	
	/* Data set length after filtering */
	$sQuery = "
		SELECT FOUND_ROWS()
	";
	$rResultFilterTotal = mysql_query( $sQuery ) or die(mysql_error()." linea 173<br>$sQuery");
	$aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
	$iFilteredTotal = $aResultFilterTotal[0];
	
	//echo $iFilteredTotal;
	//echo "id_perfil--".$id_perfil."<br>";
	
	/* Total data set length */
	$sQuery = "
		SELECT COUNT(".$sIndexColumn.")
		FROM   $sTable
		WHERE 1 $and
		$sWhere
		";
	//echo $sQuery;
	$rResultTotal = mysql_query( $sQuery ) or die(mysql_error()." linea 182<br>$sQuery");
	$aResultTotal = mysql_fetch_array($rResultTotal);
	$iTotal = $aResultTotal[0];
	

		$output = array(
		"sEcho" => intval($_GET['sEcho']),
		"iTotalRecords" => $iFilteredTotal,
		"iTotalDisplayRecords" => $iFilteredTotal,
		"aaData" => array()
		);
		
		//echo "id_perfil--".$id_perfil."<br>";
	//echo count($aColumns);	
	while ( $aRow = mysql_fetch_array( $rResult ) )
	{
		//$num_columnas =count($aColumns);
		$cont_r++;
		$row = array();
	      //echo "--".count($aColumnsBD)." rrr<br>";
	      //echo "count aColumns--".count($aColumns);
	     $id_noticia =$aRow[$aColumnsBD[5]];
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
	
			switch ($i) {
			
				
				case 0:
						// Fecha de ingreso
						$row[] = utf8_encode($aRow[$aColumnsBD[$i]]);
						
					
				 break;
				
				case 1:
						// Fecha de ingreso
						$id_tipo_noticia = $aRow[$aColumnsBD[$i]];
						$query= "SELECT descripcion
							FROM  contenido_tipo
							WHERE id_tipo='$id_tipo_noticia'";
						  $result= cms_query($query)or die (error($query,mysql_error(),$php));
						  list($tipo_noticia) = mysql_fetch_row($result);
					$row[] = utf8_encode($tipo_noticia);
				 break;
				case 2:
					$row[] = "<a href=\"index.php?accion=$accion&act=12&id_noticia=$id_noticia\">
					<img src=\"images/iconos/imagen.jpg\" alt=\"Galeria\" border=\"0\"></a>";
				 break;
				case 3:
						// link activa noticia
						$noticia_activa =$aRow[$aColumnsBD[$i]];
					if($publicador=="ok"){
						
					
						if($noticia_activa=='si'  ){
	       			
							$link_activo ="<div id=\"v_$id_noticia\" >
							<img style=\"cursor: pointer;  cursor: hand;\" onclick=\"ObtenerDatos('index.php?accion=$accion&act=14&id_noticia=$id_noticia&axj=1','v_$id_noticia');\" src=\"images/ciculo_ok.gif\" border=\"0\" alt=\"Ocutar Noticia\">
							</div>";
	    
						}elseif($noticia_activa!='si'){
	  	
							
							$link_activo ="<div id=\"v_$id_noticia\"  >
							<img style=\"cursor: pointer;  cursor: hand;\" onclick=\"ObtenerDatos('index.php?accion=$accion&act=14&id_noticia=$id_noticia&axj=1','v_$id_noticia');\" src=\"images/ciculo_warring.gif\" border=\"0\" alt=\"Activar Noticia\">
							</div>";
						}
					}else{
						if($noticia_activa=='si'  ){
							$link_activo ="<div id=\"v_$id_noticia\" >
							<img  src=\"images/ciculo_ok.gif\" border=\"0\" alt=\"Noticia Oculta\">
							</div>";
	    
						}elseif($noticia_activa!='si'){
	  	
							
							$link_activo ="<div id=\"v_$id_noticia\"  >
							<img style=\"cursor: pointer;  cursor: hand;\"  src=\"images/ciculo_warring.gif\" border=\"0\" alt=\"Noticia Activa\">
							</div>";
						}
						
					}
					
					
					$row[] = $link_activo;
				 break;
				
				case 4:
						
					$row[] = "<a href=\"index.php?accion=$accion&act=2&id_contenido=$id_noticia\" name=\" de borrar\" class=\"confirma\" >
						<img src=\"images/edit.gif\" alt=\"Editar\" border=\"0\"></a>";
				 break;
				case 5:
						
					$row[] = "<a href=\"index.php?accion=$accion&act=3&id_noticia=$id_noticia\" onclick=\"return confirm('¿Deseas borrar esta noticia?');\">
						<img src=\"images/del.gif\" alt=\"Borrar\" border=\"0\"></a>";
				 break;
			
									 
               	default:
				  // Folio
            	  $row[] = $aRow[$aColumnsBD[$i]];
                   
             }
			
			
		}
		
	
		
		//$folio =$aRow[$aColumnsBD[0]];
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