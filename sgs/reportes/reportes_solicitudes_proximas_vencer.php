<?php
//se arman las pantallas para los distintos niveles de reporte
// aca van las caracteristicas de las solicitudes incluidas las consultas
	$resultado_reporte = html_template('contenedor_reporte');	
	$titulo_prefijo = "Solicitudes pr&oacute;ximas a vencer ";
	$titulo_prefijo2 = " pr&oacute;ximas a vencer ";
	$estado = "1,2,3,4,5,6,7,8,9,10,11,12,26";
	$condicion = $condicion. " and a.id_sub_estado_solicitud in ($estado)";
	switch ($nivel) {
		 case "Servicio":
				 $titulo_informe = $titulo_prefijo." por per&iacute;odo (Resumen por Servicio)";
				 
				 //encabezados
				 $encabezado = html_template('encabezado_reporte_nivel_servicio');
				 
				 $filtro_servicio = str_replace("--Seleccione--","TODOS",$filtro_servicio);
				 $encabezado = cms_replace("#FILTRO_SERVICIO#","$filtro_servicio",$encabezado);
				 $encabezado = cms_replace("#FILTRO_PERIODO#","$filtro_anio",$encabezado);
			 	$encabezado = cms_replace("#FILTRO_PAIS#","$filtro_pais",$encabezado);
				$encabezado = cms_replace("#FILTRO_REGION#","$filtro_region",$encabezado);
				$encabezado = cms_replace("#FILTRO_COMUNA#","$filtro_comuna",$encabezado);
				$encabezado = cms_replace("#FILTRO_CATEGORIA#","$filtro_categoria",$encabezado);
			  	//se extrae la informacion
			   	$query = "select count(distinct a.id_entidad_padre) as cantidad
							FROM sgs_solicitud_acceso a, 
								sgs_entidad_padre b
							WHERE a.id_entidad_padre = b.id_entidad_padre ".$condicion;
								
				$result_cantidad= cms_query($query)
									or die (error($query,mysql_error(),$php));
					
				list($cantidad_registros) = mysql_fetch_row($result_cantidad);
				
				 $query = "SELECT a.id_entidad_padre, 
								b.entidad_padre, 
								MONTH (fecha_inicio) mes, 
								COUNT( distinct(a.folio) ) cantidad
							FROM sgs_solicitud_acceso a, 
								sgs_entidad_padre b
							WHERE a.id_entidad_padre = b.id_entidad_padre ".$condicion." 								
							GROUP BY id_entidad_padre, b.entidad_padre, MONTH (fecha_inicio)
							ORDER BY id_entidad_padre,MONTH (fecha_inicio)";
							
				 $result= cms_query($query)or die (error($query,mysql_error(),$php));
			  
			  
			  
			  //solo se muestra la informacion
			  include  ("sgs/reportes/reportes_crea_informacion_anual.php");
		 
			 break;
		 case "Entidad":
		 
				$titulo_informe = $titulo_prefijo." por per&iacute;odo (Resumen por Entidad)";
				
				
				//encabezados	
				$encabezado = html_template('encabezado_reporte_nivel_entidad_sin_periodo');	
				$adicional = html_template('encabezado_reporte_nivel_entidad_adicional');	
				$adicional =  $adicional.html_template('encabezado_reporte_nivel_entidad_dias_vencer');	 
				$encabezado = cms_replace("#FILTROS_EXTRAS#","$adicional",$encabezado); 
				$encabezado = cms_replace("#COMBO_ADICIONAL#","Estados",$encabezado);
				$encabezado = cms_replace("#FILTRO_ADICIONAL#","$filtro_estados",$encabezado);
				 
				
				$filtro_servicio = str_replace("--Seleccione--","TODOS",$filtro_servicio);
				$encabezado = cms_replace("#FILTRO_SERVICIO#","$filtro_servicio",$encabezado);
				
				$filtro_entidad = str_replace("--Seleccione--","TODAS",$filtro_entidad);
				$encabezado = cms_replace("#FILTRO_ENTIDAD#","$filtro_entidad",$encabezado);
				
				$encabezado = cms_replace("#FILTRO_PAIS#","$filtro_pais",$encabezado);
				$encabezado = cms_replace("#FILTRO_REGION#","$filtro_region",$encabezado);
				$encabezado = cms_replace("#FILTRO_COMUNA#","$filtro_comuna",$encabezado);
				$encabezado = cms_replace("#FILTRO_CATEGORIA#","$filtro_categoria",$encabezado);//$encabezado = cms_replace("#FILTRO_PERIODO#","$filtro_anio",$encabezado);
				
				
				$campoDias = "<input name=\"dias\" id=\"dias\" type=\"text\" size=\"10\" maxlength=\"2\" value=\"$dias\" onblur=\"document.form1.submit();\">";
				$encabezado = cms_replace("#FILTRO_DIAS#","$campoDias",$encabezado);
				
				$item = "D&iacute;as por vencer";
				$valor = $dias;
				$encabezado_dias = completaRegistroEncabezado($linea_encabezado_correo,$item,$valor);
				$csv_encabezado_dias = $item.$csv_separador.$valor.$csv_fin_linea;
				$_SESSION['encabezados_mail'] = $encabezado_servicio.$encabezado_entidad.$encabezado_estado.$encabezado_dias;
				$_SESSION['encabezados_csv'] = acentos_inverso($csv_encabezado_servicio.$csv_encabezado_entidad.$csv_encabezado_periodo.$csv_encabezado_estado.$csv_encabezado_dias);
				
				
				$fecha_actual = date('Y-m-d');
				$fecha_fin = sumaDiasHabiles($fecha_actual,$dias);
				//echo "<br>fecha actual:$fecha_actual    &nbsp;&nbsp;fecha_fin".$fecha_fin;
				
				//se extrae la informacion
				 $query = "select count(distinct a.id_entidad) as cantidad
								FROM sgs_solicitud_acceso a, 
									sgs_entidades b
								WHERE a.id_entidad = b.id_entidad 
									and a.id_entidad = b.id_entidad 
									AND a.fecha_termino >= CURRENT_DATE		
									AND a.fecha_termino <= '$fecha_fin'	
									 ".$condicion;
								
				$result_cantidad= cms_query($query)
								or die (error($query,mysql_error(),$php));
									
				list($cantidad_registros) = mysql_fetch_row($result_cantidad);
				
				

				
				//CALCULAR N DIAS 
				
				
						
				$query = "SELECT a.id_entidad, 
								b.entidad, 
								COUNT( distinct(a.folio) ) cantidad
							FROM sgs_solicitud_acceso a, 
								sgs_entidades b
							WHERE a.id_entidad = b.id_entidad 
									 ".$condicion."
									AND a.fecha_termino >= CURRENT_DATE		
									AND a.fecha_termino <= '$fecha_fin'	
							GROUP BY id_entidad, b.entidad
							ORDER BY id_entidad";
							
				 $result= cms_query($query)or die (error($query,mysql_error(),$php));			
				 
				$query = "SELECT COUNT( distinct(a.folio) ) cantidad
							FROM sgs_entidades b, 
								sgs_solicitud_acceso a
								left outer join usuario c on a.id_usuario = c.id_usuario
							WHERE a.id_entidad = b.id_entidad 
									 ".$condicion.$condicion_geografica."
									AND a.fecha_termino >= CURRENT_DATE		
									AND a.fecha_termino <= '$fecha_fin'	";
				
														
				 $result_cantidad= cms_query($query)or die (error($query,mysql_error(),$php));			
				list($cantidad_registros) = mysql_fetch_row($result_cantidad);
			
				//solo se muestra la informacion
				include  ("sgs/reportes/reportes_arma_listado_solicitudes.php");
				$informacion = cms_replace("#TOTAL_1#","$cantidad_registros",$informacion);
				$informacion = cms_replace("#CATEGORIA#","$nivel",$informacion);
			
			 break;
			 
			 
		case "Solicitud":
		 	$titulo_informe = "Solicitudes ".$titulo_prefijo2." seg&uacute;n per&iacute;odo (Detalle)";
			//encabezados	
			$encabezado = html_template('encabezado_reporte_nivel_solicitud_sin_periodo');	
			$adicional = html_template('encabezado_reporte_nivel_entidad_adicional');	
			$adicional =  $adicional.html_template('encabezado_reporte_nivel_entidad_dias_vencer');	  
			$encabezado = cms_replace("#FILTROS_EXTRAS#","$adicional",$encabezado); 
			$encabezado = cms_replace("#COMBO_ADICIONAL#","Estados",$encabezado);
			$encabezado = cms_replace("#FILTRO_ADICIONAL#","$filtro_estados",$encabezado); 
			
			$filtro_servicio = str_replace("--Seleccione--","TODOS",$filtro_servicio);
			$encabezado = cms_replace("#FILTRO_SERVICIO#","$filtro_servicio",$encabezado);
			
			$filtro_entidad = str_replace("--Seleccione--","TODAS",$filtro_entidad);
			$encabezado = cms_replace("#FILTRO_ENTIDAD#","$filtro_entidad",$encabezado);
			
			$encabezado = cms_replace("#FILTRO_PERIODO#","$filtro_anio",$encabezado);
			$encabezado = cms_replace("#FILTRO_MES#","$filtro_mes",$encabezado);
			
			$campoDias = "<input name=\"dias\" id=\"dias\" type=\"text\" size=\"10\" maxlength=\"2\" value=\"$dias\" onblur=\"document.form1.submit();\">";
			$encabezado = cms_replace("#FILTRO_DIAS#","$campoDias",$encabezado);
			
			$encabezado = cms_replace("#FILTRO_PAIS#","$filtro_pais",$encabezado);
			$encabezado = cms_replace("#FILTRO_REGION#","$filtro_region",$encabezado);
			$encabezado = cms_replace("#FILTRO_COMUNA#","$filtro_comuna",$encabezado);
			$encabezado = cms_replace("#FILTRO_CATEGORIA#","$filtro_categoria",$encabezado);$item = "D&iacute;as por vencer";
			$valor = $dias;
			$encabezado_dias = completaRegistroEncabezado($linea_encabezado_correo,$item,$valor);
			$csv_encabezado_dias = $item.$csv_separador.$valor.$csv_fin_linea;
			$_SESSION['encabezados_mail'] = $encabezado_servicio.$encabezado_entidad.$encabezado_estado.$encabezado_dias;
			$_SESSION['encabezados_csv'] = acentos_inverso($csv_encabezado_servicio.$csv_encabezado_entidad.$csv_encabezado_periodo.$csv_encabezado_estado);
			
			$fecha_actual = date('Y-m-d');
			$fecha_fin = sumaDiasHabiles($fecha_actual,$dias);
				
			
			
			// se extrae la informacion
			$query= "SELECT id_solicitud_acceso,
							folio,
							id_entidad,
							id_entidad_padre,
							id_usuario,
							identificacion_documentos,
							notificacion,
							id_forma_recepcion,
							oficina,
							id_formato_entrega,
							fecha_inicio,
							fecha_termino,
							a.orden,
							a.id_estado_solicitud,
							a.id_estado_solicitud, 
							 b.estado_solicitud estado_padre, 
						   id_sub_estado_solicitud, 
						   id_responsable , ifnull(c.estado_solicitud,'') estado_solicitud,firmada FROM  sgs_solicitud_acceso a, sgs_estado_solicitudes b, sgs_estado_solicitudes c
					WHERE a.id_estado_solicitud = b.id_estado_solicitud  ".$condicion."
							AND a.fecha_termino >= CURRENT_DATE		
							AND a.fecha_termino <= '$fecha_fin'	
						  and c.id_estado_solicitud = a.id_sub_estado_solicitud  
					 ";
			
			$result = cms_query($query)or die (error($query,mysql_error(),$php));
			$resultSinPagina = $result;
			
			
			$tot_registros = mysql_num_rows($result);
			$reg_por_pagina =configuracion_cms('registros_por_pagina');
			
			$cant_pag = ceil($tot_registros/$reg_por_pagina);
			
			$cant_pag = ceil($cant_pag);
		
			if($cant_pag > 0){
				$p = $_GET['p'];
				if($p=="" ){
				$p=0;
				$limit = "limit 0,$reg_por_pagina";
				}else{
				$p2= ($p-1)*$reg_por_pagina;
				
				$limit = "limit $p2,$reg_por_pagina";
				}
				
				
				$pt = $cant_pag; //Numero total de paginas
				$pa = $p; //Pagina en la que estamos ( $_GET['pagina'] )
				$link = "<a href=\"index.php?accion=$accion&act=$act&p={P}&nivel=$nivel&id_entidad_padre=$id_entidad_padre&id_entidad=$id_entidad&periodo=$periodo&mes=$mes&dias=$dias&id_estado_solicitud=$id_estado_solicitud\">"; //Link que queremos ocupar en nuestro paginador
				
			
			$paginas ="";
			if ($cant_pag > 1){
				if ($pa==0){
					$pa = 1;
				}
				$paginas = "P&aacute;gina $pa de $cant_pag";
			}

			$paginacion =Paginacion($pt,$pa,$link);
		
			}
			
			//procesar consulta busqueda
			$query= "SELECT id_solicitud_acceso,
							folio,
							id_entidad,
							id_entidad_padre,
							id_usuario,
							identificacion_documentos,
							notificacion,
							id_forma_recepcion,
							oficina,
							id_formato_entrega,
							fecha_inicio,
							fecha_termino,
							a.orden,
							 a.id_estado_solicitud, 
							 b.estado_solicitud estado_padre, 
						   id_sub_estado_solicitud, 
						   id_responsable
						   , ifnull(c.estado_solicitud,'') estado_solicitud,firmada FROM    sgs_solicitud_acceso a, sgs_estado_solicitudes b, sgs_estado_solicitudes c
					WHERE a.id_estado_solicitud = b.id_estado_solicitud  ".$condicion."
							AND a.fecha_termino >= CURRENT_DATE		
							AND a.fecha_termino <= '$fecha_fin'	
						  and c.id_estado_solicitud = a.id_sub_estado_solicitud  
					order by fecha_inicio asc ". $limit ;
					
			  $result= cms_query($query)or die (error($query,mysql_error(),$php));
			
			//se muestra la informacion
			include  ("sgs/reportes/reportes_arma_listado_solicitudes.php");
		
			break;
			
		
		
		case "Detalle":
		
			$titulo_informe = "Detalle de la solicitud ".$titulo_prefijo2;
			//encabezados	
			
			//se extrae la informacion
			//procesar consulta busqueda
			$query= "SELECT id_solicitud_acceso,
							folio,
							id_entidad,
							id_entidad_padre,
							id_usuario,
							identificacion_documentos,
							notificacion,
							id_forma_recepcion,
							oficina,
							id_formato_entrega,
							fecha_inicio,
							fecha_termino,
							a.orden,
							a.id_estado_solicitud,
							a.id_estado_solicitud, 
							 b.estado_solicitud estado_padre, 
						   id_sub_estado_solicitud, 
						   id_responsable , ifnull(c.estado_solicitud,'') estado_solicitud,firmada FROM  sgs_solicitud_acceso a, sgs_estado_solicitudes b, sgs_estado_solicitudes c
					WHERE   a.folio = '$folio' 
							and  a.id_estado_solicitud = b.id_estado_solicitud  ".$condicion."  
							and c.id_estado_solicitud = a.id_sub_estado_solicitud  ";
					
					
			  $result= cms_query($query)or die (error($query,mysql_error(),$php));
			  //se muestra la informacion			
			  include  ("sgs/reportes/reportes_arma_listado_solicitudes.php");
			  break;
				   
	 }
	
	
	$icono = "<img src=\"images/icono_reporte/$icono\" width=\"32\" height=\"32\" border=\"0\" />";
	$resultado_reporte = cms_replace("#ICONO#","$icono",$resultado_reporte);
	$resultado_reporte = cms_replace("#TITULO_INFORME#","$titulo_informe",$resultado_reporte);
	$resultado_reporte = cms_replace("#ENCABEZADO#","$encabezado",$resultado_reporte);
	$resultado_reporte = cms_replace("#CANT_PAGINAS#",$paginas, $resultado_reporte);
	$resultado_reporte = cms_replace("#PAGINACION#","$paginacion", $resultado_reporte);
	$resultado_reporte = cms_replace("#INFORMACION#","$informacion",$resultado_reporte);


?>