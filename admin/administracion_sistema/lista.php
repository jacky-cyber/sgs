<?php
/***********analisis tabla**************/
 if($id_auto_admin==""){
			
                            $query= "SELECT id_auto_admin   
                                    FROM  acciones
                                    WHERE accion='$accion'";
            
                            $result= cms_query($query)or die (error($query,mysql_error(),$php));
                            list($id_auto_admin) = mysql_fetch_row($result);
   		
                    }
                
                  $query= "SELECT tabla  
                                    FROM  auto_admin
                                    WHERE  id_auto_admin='$id_auto_admin'";
            
                            $result= cms_query($query)or die (error($query,mysql_error(),$php));
                            list($tabla) = mysql_fetch_row($result);
                            
                            
                $query= "SELECT campo,existe_listado,pk,id_tipo_campo,txt,txt_xml,relacion
   		           FROM  auto_admin_campo
   		           WHERE  id_auto_admin=$id_auto_admin and campo<>'orden' 
			   ORDER BY id_campo";
   		  
   			//echo "$query<br>";
   		      $resultc= cms_query($query)or die (error($query,mysql_error(),$php));
   		      while (list($campos,$existe_listado,$pk,$id_tipo_campo,$txt,$txt_xml,$relacion) = mysql_fetch_row($resultc)){
   		      	//echo "$campos<br>";
                        $cont_columnas++;
   				$campo_txt_tbl_pk="";
				if($existe_listado==1){
                                    $listado_tabla .="$campos,";
                                    $var = "tipo_campo_$campos";
                                    $$var = $id_tipo_campo;
                                    
                                    $var = "relacion_$campos";
                                    $$var = $relacion;
   					/*
                                        if(substr_count ($campos, "id_") and $pk!=1){
   						//encontramos un pk de otra tabla 
   						$tbl_pk= campo_pk($campos,$DATABASE);
						
                                                        if($tbl_pk!=""){
                                                                $campo_tbl_pk = $campos;
                                                                $query= "SELECT id_auto_admin  
                                                                         FROM auto_admin 
                                                                         WHERE tabla='$tbl_pk'";
                                                                
                                                                $resultq= cms_query($query)or die (error($query,mysql_error(),$php));
                                                                list($id_auto_admin_tbl_pk) = mysql_fetch_row($resultq);
                                                                    //rescatamos el id de la tabla del campo pk encontrado
                                                                $query= "SELECT campo
                                                                         FROM auto_admin_campo 
                                                                         WHERE id_auto_admin='$id_auto_admin_tbl_pk' and existe_listado =1";
        
                                                                 $resultq= cms_query($query)or die (error($query,mysql_error(),$php));
                                                                 list($campo_txt_tbl_pk) = mysql_fetch_row($resultq);
                                                                    //encontramos el campo tx que corresponde al pk que encontramos
                                                                        $contador_pk= $cont;
                                                                        $ver_pk="ok";
							}
   					}else{
   						
                                                        $query= "SELECT campo
   		      	          				 FROM auto_admin_campo 
   		      	          				 WHERE id_auto_admin='$id_auto_admin' and existe_listado =1";

   		      					 $resultq= cms_query($query)or die (error($query,mysql_error(),$php));
                                                        list($campo_txt_tbl_pk) = mysql_fetch_row($resultq);
					}
   					
                                   */	
                                $cont_cols_tabla++;
				}else{
                                    $listado_base .="$campos,";
                                    
                                }
				
				if($pk==1){
                                    $campo_pk = $campos;
                                }
                                if($txt==1){
                                    $campo_txt = $campos;
                                }
   		      
   		}
   		
                 $listado_tabla =elimina_ultimo_caracter($listado_tabla);
                 $listado_base =elimina_ultimo_caracter($listado_base);
                ////////
        
if(verfica_permiso($id_auto_admin,$id_perfil,'ver')){
$configurar_ver= 1;
$cont_columnas++;
}


if(verfica_permiso($id_auto_admin,$id_perfil,'editar')){
$configurar_editar = 1;
$cont_columnas++;
}

if(verfica_permiso($id_auto_admin,$id_perfil,'borrar')){
$configurar_borrar = 1;
$cont_columnas++;
}


/************Fin analisis tabla********/
        $listado_tabla .=",$campo_pk";
	
	$aColumns = array($listado_tabla);
	$aColumnsBD = array($listado_tabla);
	
	
	$id_perfil_conect = perfil($id_sesion);
	//verificamos que quien este viendo este modulo no sea admin
	
	

	$sIndexColumn = "$campo_pk";

	/* DB table to use */
	$sTable = "$tabla";
	
	
	
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
            
            $_GET['iSortCol_0']  = trim($_GET['iSortCol_0'] );
		$sOrder = "ORDER BY  ";
		for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
		{
			if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" and $_GET['iSortCol_'.$i]=="" )
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
            
    
	$palabra = $_GET['sSearch'];
        $sWhere = "and  $campo_txt like '%$palabra%' ";
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
	
	
	
	// Filtros
	$condicion_campo = "";
	$_GET['campo']= trim($_GET['campo']);
	if(isset($_GET['campo']) and $_GET['campo']!="" and $_GET['campo']!="#"){

		$campo_buscar = $_GET['campo'];
		$condicion_campo = "AND $campo_buscar";
	}
	
	$operador = "";
	$_GET['select']= trim($_GET['select']);
	if(isset($_GET['select']) and $_GET['select']!="" and $_GET['select']!="#"){
		
		$query= "SELECT filtro_sql  
					FROM auto_admin_filtros
					WHERE id_filtro = '".$_GET['select']."'";
		$result= mysql_query($query)or die (error($query,mysql_error(),$php));
		list($filtro_sql) = mysql_fetch_row($result);
		$operador = $filtro_sql;
		
	}
	
	
	$_GET['texto_filtro']= trim($_GET['texto_filtro']);
	if(isset($_GET['texto_filtro']) and $_GET['texto_filtro']!="" and $_GET['texto_filtro']!="#" and $condicion_campo != ""){
		
		$pos = strpos($operador, '#');
		if($pos == false){
			$filtros_sesion = " $condicion_campo  $operador '".$_GET['texto_filtro']."' ";
		}else{
			$operador = str_replace("#VALOR#",$_GET['texto_filtro'],$operador);
			$filtros_sesion = " $condicion_campo  $operador";
		}
	}

	

	$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumnsBD))."
		FROM   $sTable
		WHERE 1 $sWhere_perfiles
		$filtros_sesion
		$sWhere
		$sOrder
		$sLimit
		
	";
	
        if($_GET['tp']==6){
            echo $sQuery;
        }
	
	$rResult = mysql_query( $sQuery ) or die(mysql_error()." linea 167<br>$sQuery");
	
	/* Data set length after filtering */
	$sQuery = "SELECT FOUND_ROWS()";
	$rResultFilterTotal = mysql_query( $sQuery ) or die(mysql_error()." linea 173<br>$sQuery");
	$aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
	$iFilteredTotal = $aResultFilterTotal[0];
	
	/* Total data set length */
	$sQuery = "
		SELECT COUNT(".$sIndexColumn.")
		FROM   $sTable
		WHERE 1 $sWhere_perfiles $filtros_sesion
		";
	$rResultTotal = mysql_query( $sQuery ) or die(mysql_error()." linea 182<br>$sQuery");
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
		
		//echo "--".count($aColumns)." $cont_cols_tabla rrr<br>";
            $row = array();
		for ( $i=0 ; $i<$cont_cols_tabla ; $i++ )
		{
                    
			//echo $aRow[$i]."--";
			/* 
			$aRow[$aColumnsBD[$i]] =trim($aRow[$aColumnsBD[$i]]);
			if($aRow[$aColumnsBD[$i]]==""){
				$aRow[$aColumnsBD[$i]]="&nbsp;";
			}*/
                         $campo =@mysql_field_name($rResult,$i);
                         $tipo_campo = "tipo_campo_$campo";
                          
			switch ($$tipo_campo) {
                                   
                                   case 4: //si o no
                                                if($aRow[$i]==1){
                                                    $aRow[$i]='si';
                                                }else{
                                                    $aRow[$i]='no';
                                                }
                                              
                                        break;
                                        case 5://checkbox
                                            //    echo $valor_nom_campo;
                                            $valor_nom_campo  =  $aRow[$i];
                                            $nom_campo =$campo;
                                            $check_campos="";
			  $os = explode(",", $valor_nom_campo);
	 //<input type="checkbox" name="#nombre_campo#" value="#valor_campo_pk#"  id="#nombre_campo#" #checked1#>#valor_campo_txt#
		     $query= "SELECT relacion   
	 	              FROM  auto_admin_campo
	 	              WHERE id_auto_admin='$id_auto_admin' and campo='$nom_campo'";
	 	     
	// echo "$query<br>";
	 	        $result= cms_query($query)or die (error($query,mysql_error(),$php));
	 	      list($tabla_relacion) = mysql_fetch_row($result);
       		   
			    $query= "SELECT id_auto_admin
                       FROM  auto_admin
                       WHERE   tabla  ='$tabla_relacion'";
                 $result21= cms_query($query)or die (error($query,mysql_error(),$php));
                  list($id_auto_admin_rel) = mysql_fetch_row($result21);
				  
				  $campo_pk_rel = campo_pk_tabla($id_auto_admin_rel);
				  $campo_txt_rel= campo_txt($id_auto_admin_rel);
				  
				      $query= "SELECT $campo_pk_rel,$campo_txt_rel  
                             FROM  $tabla_relacion";
                       $result= cms_query($query)or die (error($query,mysql_error(),$php));
                        while (list($id_campo_pk_rel,$txt_campo_txt_rel) = mysql_fetch_row($result)){
						
									//echo "<br>$aEntidad $id_entidad encontrado:".$encontrado;
									$checked="";
									if(in_array($id_campo_pk_rel,$os)){
											//$checked = "checked";
											$check_campos .="$txt_campo_txt_rel ,";
									}
									  
						 }
				  
				 $valor_nom_campo = trim($check_campos);
				 $valor_nom_campo= elimina_ultimo_caracter($valor_nom_campo);
                                 if($valor_nom_campo==false){
                                    $valor_nom_campo="";
                                 }
                                             $aRow[$i]= $valor_nom_campo;
                                        break;
                                        case 6: //combolist
                                              
                                             $query= "SELECT id_auto_admin  
                                                        FROM  auto_admin_campo
                                                        WHERE pk='1' and campo='$campo'";
                                             
                                                  $result= cms_query($query)or die (error($query,mysql_error(),$php));
                                                list($id_auto_admin_tabla_relacion) = mysql_fetch_row($result);
                                             
                                                      $query= "SELECT tabla
                                                 FROM  auto_admin
                                                 WHERE   id_auto_admin  ='$id_auto_admin_tabla_relacion'";
                                           $result21= cms_query($query)or die (error($query,mysql_error(),$php));
                                            list($tabla_campo ) = mysql_fetch_row($result21);
                                                                       
                                             
                                             
                                             $id_campo_relacion = $aRow[$i];
                                             $campo_text_relacion = campo_txt($tabla_campo);
                                             $aRow[$i]=rescata_valor($tabla_campo,$id_campo_relacion, $campo_text_relacion);
                                        break;
                                       case 9: //fecha
                                             $aRow[$i]=fechas_html($aRow[$i]);
                                        break;
                                        case 10://text
                                            if($aRow[$i]==1){
                                                            $aRow[$i]='Mujer';
                                                            }else{
                                                            $aRow[$i]='Hombre';
                                                            }
                                        break;
                                        
                                       default:
                                          
                                        
                                      
                                   }
                         
                         
                         
                         
                    $row[] = $aRow[$i];
		$cont_campos++;	 
		}
		
	$ultimo = $cont_cols_tabla;
		$id = $aRow[$ultimo];
         // echo "<br>>$cont_cols_tabla< $id--".count($aColumnsBD)."<---<br>";
		if($configurar_ver==1){ 
			
			$url = "index.php?accion=$accion&act=18&id_a=$id_auto_admin&id=$id&width=400&axj=1";
			$row[]=" <div class=\"jver\" onMouseOver=\"ver_popover('$url','$id','$tabla');\" <a id=\"$id\" ><span class=\"icon-eye-open\" ></span></a> </div>";
			
			
		}
		
		
		
		
		if($configurar_editar==1){$row[]="<a href=\"?accion=$accion&act=1&id_a=$id_auto_admin&id=$id\" title=\"Editar Registro\" ><div class=\"jver\"><spam class=\"icon-edit\"></spam></div></a>";}
		if($configurar_borrar==1){$row[]="<a href=\"javascript:confirmar('Esta seguro de eliminar este registro','?accion=$accion&act=4&id_a=$id_auto_admin&id=$id')\" title=\"Borrar Registro\" >
                            <div class=\"jver\"><spam class=\"icon-trash\"></div></spam></a>";}
		
		
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