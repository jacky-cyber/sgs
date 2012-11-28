<?php
	$resultado_reporte = html_template('contenedor_reporte');	

	if ($id_tramo!=""){
		$condicion = $condicion. " and a.id_tramo = $id_tramo ";
	}
	if ($id_estado_solicitud!=""){
		$condicion = $condicion. " and a.id_estado = $id_estado_solicitud ";
	}

	switch ($nivel) {
		 case "Entidad":
		 	$csv_tabla="Entidad".$csv_separador."Estado".$csv_separador."Tramo".$csv_separador."Cantidad".$csv_fin_linea;
			$titulo_informe = "Estad&iacute;stica Agregada (Resumen por Entidad)";
			$encabezado = html_template('encabezado_reporte_estadistica_agregada_nivel_entidad');
			$encabezado = cms_replace("#FILTRO_SERVICIO#","$filtro_servicio",$encabezado);
			$encabezado = cms_replace("#FILTRO_ENTIDAD#","$filtro_entidad",$encabezado);
			$encabezado = cms_replace("#FILTRO_ESTADO#","$filtro_estados",$encabezado);
			$encabezado = cms_replace("#FILTRO_TRAMO#","$filtro_tramos",$encabezado);
			
			$_SESSION['encabezados_mail'] = $encabezado_servicio.$encabezado_entidad.$encabezado_estado.$encabezado_tramo;
			$_SESSION['encabezados_csv'] = acentos_inverso($csv_encabezado_servicio.$csv_encabezado_entidad.$csv_encabezado_estado.$csv_encabezado_tramo);
			
			$sql = "select a.id_entidad,
						   b.entidad,
						   a.id_estado,
						   c.estado_solicitud,
						   a.id_tramo,
						   d.descripcion_vencimiento,
						   cantidad
					
					from sgs_estadistica_agregada a,
						 sgs_entidades b,
						 sgs_estado_solicitudes c,
						 sgs_tramos d
					where a.id_entidad = b.id_entidad
						  and a.id_estado = c.id_estado_solicitud
						  and a.id_tramo = d.id_tramo
						  $condicion
					order by id_entidad asc";
			$result_consulta = cms_query($sql) or die ("La consulta falló:<br>".mysql_error());
			
			$informacion = html_template('tabla_estadistica_agregada');
			if (mysql_num_rows($result_consulta) >0 )
			{
				while (list($id_entidad,$entidad,$id_estado,$estado_solicitud,$id_tramo,$descripcion_vencimiento,$cantidad) = mysql_fetch_row($result_consulta)){
					$linea = html_template('registro_estadistica_agregada');
					$linea = str_replace ("#ENTIDAD#",$entidad,$linea);
					$linea = str_replace ("#ESTADO#",$estado_solicitud,$linea);
					$linea = str_replace ("#TRAMO#",$descripcion_vencimiento,$linea);
					$csv_tabla .= acentos_inverso($entidad.$csv_separador.$estado_solicitud.$csv_separador.$descripcion_vencimiento.$csv_separador.$cantidad.$csv_fin_linea);
					$link = "<a href=\"index.php?accion=$accion&act=$act&id_entidad=$id_entidad&id_tramo=$id_tramo&id_estado_solicitud=$id_estado&nivel=Solicitud\">$cantidad</a>";
					$linea = str_replace ("#CANTIDAD#",$link,$linea);
					$lineas = $lineas.$linea;
				}
			}else{
				  $colspan = 4;
				  $mensaje = html_template('mensaje_sin_registros');
				  $registro = Coloca_registro_vacio($colspan,$mensaje);
				  $lineas = $registro;	
				  $csv_tabla .= acentos_inverso($mensaje);
			}
			$informacion = str_replace ("#REGISTROS#",$lineas,$informacion);
			
			$por_correo = "";
			//$por_correo = "<table width=\"100%\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">";
			$por_correo = $por_correo . $informacion;
			//$por_correo = $por_correo . "</table>";
			$_SESSION['tabla_mail'] = $por_correo;
			$_SESSION['tabla_csv'] = $csv_tabla;
			
			
			break;
		 case "Solicitud":
		 	$csv_tabla="Entidad".$csv_separador."Estado".$csv_separador."Tramo".$csv_separador."Folio".$csv_fin_linea;
			$titulo_informe = "Estad&iacute;stica Agregada (Resumen por Entidad - Folio)";
			$encabezado = html_template('encabezado_reporte_estadistica_agregada_nivel_entidad');
			$encabezado = cms_replace("#FILTRO_SERVICIO#","$filtro_servicio",$encabezado);
			$encabezado = cms_replace("#FILTRO_ENTIDAD#","$filtro_entidad",$encabezado);
			$encabezado = cms_replace("#FILTRO_ESTADO#","$filtro_estados",$encabezado);
			$encabezado = cms_replace("#FILTRO_TRAMO#","$filtro_tramos",$encabezado);
			
			$_SESSION['encabezados_mail'] = $encabezado_servicio.$encabezado_entidad.$encabezado_estado.$encabezado_tramo;
			$_SESSION['encabezados_csv'] = acentos_inverso($csv_encabezado_servicio.$csv_encabezado_entidad.$csv_encabezado_estado.$csv_encabezado_tramo);
			$sql = "select a.id_entidad,
						   b.entidad,
						   a.id_estado,
						   c.estado_solicitud,
						   a.id_tramo,
						   d.descripcion_vencimiento,
						   folio
										
					from sgs_folio_tramo_estadistica a,
						 sgs_entidades b,
						 sgs_estado_solicitudes c,
						 sgs_tramos d
					where a.id_entidad = b.id_entidad
						  and a.id_tramo = d.id_tramo
						  ".$condicion ."
						  and a.id_estado = c.id_estado_solicitud
						  
					order by id_entidad asc";
			$result_consulta = cms_query($sql) or die ("La consulta falló:<br>$sql<br>".mysql_error());
			
			$informacion = html_template('tabla_estadistica_agregada_folio');
			if (mysql_num_rows($result_consulta) >0 )
			{
				while (list($id_entidad,$entidad,$id_estado,$estado_solicitud,$id_tramo,$descripcion_vencimiento,$folio) = mysql_fetch_row($result_consulta)){
					$linea = html_template('registro_estadistica_agregada_folio');
					$linea = str_replace ("#ENTIDAD#",$entidad,$linea);
					$linea = str_replace ("#ESTADO#",$estado_solicitud,$linea);
					$linea = str_replace ("#TRAMO#",$descripcion_vencimiento,$linea);
					$csv_tabla .= acentos_inverso($entidad.$csv_separador.$estado_solicitud.$csv_separador.$descripcion_vencimiento.$csv_separador.$folio.$csv_fin_linea);
					$link = "<a href=\"index.php?accion=$accion&act=$act&folio=$folio&nivel=Detalle\">$folio</a>";
					$linea = str_replace ("#FOLIO#",$link,$linea);
					$lineas = $lineas.$linea;
				}
			}else{
				  $colspan = 4;
				  $mensaje = html_template('mensaje_sin_registros');
				  $registro = Coloca_registro_vacio($colspan,$mensaje);
				  $lineas = $registro;	
				  $csv_tabla .= acentos_inverso($mensaje);
			}
			$informacion = str_replace ("#REGISTROS#",$lineas,$informacion);
			
			$por_correo = "";
			//$por_correo = "<table width=\"100%\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">";
			$por_correo = $por_correo . $informacion;
			//$por_correo = $por_correo . "</table>";
			$_SESSION['tabla_mail'] = $por_correo;
			$_SESSION['tabla_csv'] = $csv_tabla;
			
			break;
			
		case "Detalle":
		
			$titulo_informe = "Estad&iacute;stica Agregada (Detalle solicitud)";
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
					WHERE  a.folio = '$folio'
						  and a.id_estado_solicitud = b.id_estado_solicitud  ".$condicion."
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
	$resultado_reporte = cms_replace("#INFORMACION#","$informacion",$resultado_reporte);
	

?>