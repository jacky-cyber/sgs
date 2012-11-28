<?php


switch ($nivel) {
		  case "Entidad":
		  
		  	if (mysql_num_rows($result)==0){
					$informacion = html_template('reporte_cabecera_solitudes_vencer_vacia');	
		 		 	$lineas = html_template('registro_tabla_vacio_generico');
					$lineas = str_replace ("#COLSPAN#","2",$lineas);
					$lineas = str_replace ("#MENSAJE#","No se encontraron solicitudes que cumplan con los criterios de b&uacute;squeda",$lineas);
					
			}else{
				$csv_tabla = "Entidad".$csv_separador."Cantidad de solicitudes".$csv_fin_linea;
		  		 while (list($id,$glosa,$cantidad) = mysql_fetch_row($result)){
				//arma la salida
						$lista_mis_solicitudes = html_template('lista_registros_solicitudes_vencer');
						if($cambia_color ==1){
								$clase= "class=\"alternate\"";
								$cambia_color=0;
							}else{
								$clase="";
								$cambia_color=1;
							}
						$csv_tabla .= acentos_inverso($glosa.$csv_separador.$cantidad.$csv_fin_linea);
						$lista_mis_solicitudes = cms_replace("#ENTIDAD#","$glosa",$lista_mis_solicitudes);
						
						$link = "<a href='index.php?accion=$accion&act=$act&nivel=Solicitud&id_entidad=$id&periodo=$periodo&dias=$dias'>$cantidad</a>";
						
						$lista_mis_solicitudes = cms_replace("#CANTIDAD#","$link",$lista_mis_solicitudes);
						
						$lineas .=$lista_mis_solicitudes;
				}
				
				$informacion = html_template('reporte_cabecera_solitudes_vencer');	
								
			}
				$informacion = cms_replace("#REGISTROS#","$lineas",$informacion);
				
				session_register_cms('tabla_mail');
				$_SESSION['tabla_mail'] = $informacion;
				$_SESSION['tabla_csv'] = $csv_tabla;
				
				break;
		 case "Solicitud":
		 		//include "sgs/reportes/tabla.htm";
		 		/*if (mysql_num_rows($result)==0){
		 		 	$lineas = html_template('registro_tabla_vacio_generico');
					$lineas = str_replace ("#COLSPAN#","5",$lineas);
					$lineas = str_replace ("#MENSAJE#","No se encontraron solicitudes que cumplan con los criterios de b&uacute;squeda",$lineas);
					
				}else{
		  
				  while (list($id_solicitud_acceso,$folio,$id_entidad,$id_entidad_padre,$id_usuario,$identificacion_documentos,$notificacion,$id_forma_recepcion,$oficina,$id_formato_entrega,$fecha_inicio,$fecha_termino,$orden,$id_estado_solicitud,$estado_padre,$id_sub_estado_solicitud,$id_responsable,$estado_solicitud) = mysql_fetch_row($result)){
								
						//generar la lista
							$lista_mis_solicitudes = html_template('reporte_linea_lista_solicitudes');
							
							
							$fecha_actual= date('d-m-Y');
							$respondida_en = "";
							//si esta terminada
							$estados_fin = configuracion_cms('Estados_etapa_fin');
							$aEstados = split(",",$estados_fin);
							$finalizada = 0;
							$j=0;
								while($j < count($aEstados)){
								//echo "<br>".$aEstados[$j];
								if ($id_sub_estado_solicitud ==  $aEstados[$j]){
									$finalizada = 1;
								}
								$j++;
							}
							
							$fecha_inicio= fechas_html($fecha_inicio);
							$fecha_termino = fechas_html($fecha_termino);
							$dias = diferencia_entre_fechas($fecha_termino,$fecha_actual);
							if ($dias < 0){
								$dias = "<span class=\"texto_rojo\"> ".$dias."</span>";
							}
							
							$fecha_respuesta="";
							if ($finalizada == 1){
								$fecha_inicio= fechas_bd($fecha_inicio);
								$fecha_termino = fechas_bd($fecha_termino);
								$sql = "Select fecha from sgs_flujo_estados_solicitud where folio = '$folio' and id_estado_solicitud = $id_sub_estado_solicitud";
								$resultado_fecha = cms_query($sql)or die (error($sql,mysql_error(),$php));
								list($fecha_respuesta) = mysql_fetch_row($resultado_fecha);
								//echo "<br>fecha_respuesta:".$fecha_respuesta."<br>";
								$respondida_en = calculaDiasHabilesEntreFechas($fecha_inicio,$fecha_respuesta);
								$respondida_en = $respondida_en. "&nbsp;d&iacute;as";
								//$fecha_respuesta = fechas_html($fecha_respuesta);
								
								//$fecha_termino = fechas_html($fecha_termino);
								//echo "<br>fecha de respuesta:".$fecha_respuesta;
								//echo "<br>fecha de termino:".$fecha_termino;
								$dias = calculaDiasHabilesEntreFechas($fecha_respuesta,$fecha_termino);
								//echo "<br>dias:".$dias;
							}
							
							$fecha_inicio= fechas_html($fecha_inicio);
							$fecha_termino = fechas_html($fecha_termino);
							
							
										
							if($cambia_color ==1){
								$clase= "class=\"alternate\"";
								$cambia_color=0;
							}else{
								$clase="";
								$cambia_color=1;
							}
							$fecha_respuesta=trim($fecha_respuesta);
							if($fecha_respuesta!=""){
							$dias = calculaDiasHabilesEntreFechas(fechas_bd($fecha_inicio),fechas_bd($fecha_respuesta));
							//$dias= $dias * -1;
							
							}
							
							
							$folio = "<a href='index.php?accion=$accion&amp;act=$act&amp;nivel=Detalle&amp;id_entidad_padre=$id_entidad_padre&id_entidad=$id_entidad&periodo=$periodo&mes=$mes&folio=$folio'>$folio</a>";
							
							$fecha_respuesta = fechas_html($fecha_respuesta);
							$lista_mis_solicitudes = cms_replace("#INTERLINEADO#","$clase",$lista_mis_solicitudes);
							$lista_mis_solicitudes = cms_replace("#FOLIO#","$folio",$lista_mis_solicitudes);
							$lista_mis_solicitudes = cms_replace("#FECHA_INGRESO#","$fecha_inicio",$lista_mis_solicitudes);
							$lista_mis_solicitudes = cms_replace("#FECHA_ESTIMADA_TERMINO#","$fecha_termino",$lista_mis_solicitudes);
							$lista_mis_solicitudes = cms_replace("#FECHA_TERMINO#","$fecha_respuesta",$lista_mis_solicitudes);
							$lista_mis_solicitudes = cms_replace("#DIAS# ","$dias",$lista_mis_solicitudes);
							$lista_mis_solicitudes = cms_replace("#RESPONDIDA_EN#","$respondida_en",$lista_mis_solicitudes);
							$lista_mis_solicitudes = cms_replace("#ESTADO#","$estado_solicitud",$lista_mis_solicitudes);
							$lista_mis_solicitudes = cms_replace("#ESTADO_PADRE#","$estado_padre",$lista_mis_solicitudes);
						
							
							$lineas .=$lista_mis_solicitudes;
							
						}
					}*/
						
						//cargar el template de la cabecera de la tabla de solicitudes
						$informacion = html_template('reporte_cabecera_lista_solicitudes');	
						$informacion = cms_replace("#ACT#",$act,$informacion);
						
						$informacion = cms_replace("#LISTA_SOLICITUDES#",$lineas,$informacion);
						//$informacion = cms_replace("#PAGINAS#",$paginas, $informacion);
						//$contenido = cms_replace("#PAGINACION#","$paginacion", $contenido);
						//$lista_sin_paginar = armaListaSinPaginar($resultSinPagina,$csv_separador,$csv_separador,$csv_fin_linea);
						$_SESSION['tabla_mail'] = $lista_sin_paginar;
						
						
						
						
						break;
				case "Detalle":
				//$_GET['folio']=$folio;
				$resultado_reporte = "";
				include  ("sgs/detalle_solicitud/detalle_solicitud.php");
					/*MODIFICACION RR*/
					/*
					* 
					* codigo en old_cv.php
					* */
					
					 break;
						
}



function armaListaSinPaginar($result,$csv_separador,$csv_separador,$csv_fin_linea){
	$csv_tabla = "Folio".$csv_separador."Fecha ingreso".$csv_separador."Fecha estimada término".$csv_separador."Fecha término".$csv_separador."Plazo".$csv_separador."Etapa".$csv_separador."Estado".$csv_fin_linea;
	//$csv_separador = ";";
	if (mysql_num_rows($result)==0){
		 		 	$lineas = html_template('registro_tabla_vacio_generico');
					$lineas = str_replace ("#COLSPAN#","5",$lineas);
					$lineas = str_replace ("#MENSAJE#","No se encontraron solicitudes que cumplan con los criterios de b&uacute;squeda",$lineas);
					$csv_tabla .= acentos_inverso("No se encontraron solicitudes que cumplan con los criterios de b&uacute;squeda");
					
				}else{
				
				$tabla = html_template('reporte_cabecera_lista_solicitudes');	
				$lineas= "";
		  
				  while (list($id_solicitud_acceso,$folio,$id_entidad,$id_entidad_padre,$id_usuario,$identificacion_documentos,$notificacion,$id_forma_recepcion,$oficina,$id_formato_entrega,$fecha_inicio,$fecha_termino,$orden,$id_estado_solicitud,$estado_padre,$id_sub_estado_solicitud,$id_responsable,$estado_solicitud) = mysql_fetch_row($result)){
						
						//generar la lista
							$lista_mis_solicitudes = html_template('reporte_linea_lista_solicitudes');
							
							
							$fecha_actual= date('d-m-Y');
							$respondida_en = "";
							//si esta terminada
							$estados_fin = configuracion_cms('Estados_etapa_fin');
							$aEstados = split(",",$estados_fin);
							$finalizada = 0;
							$j=0;
							/*echo "<br>id_sub_estado_solicitud:". $id_sub_estado_solicitud;
							echo "<br>estados fin :".$estados_fin;
							echo "<br>cantidad arreglo:".count($aEstados);*/
							while($j < count($aEstados)){
								//echo "<br>".$aEstados[$j];
								if ($id_sub_estado_solicitud ==  $aEstados[$j]){
									$finalizada = 1;
								}
								$j++;
							}
							
							$fecha_inicio= fechas_html($fecha_inicio);
							$fecha_termino = fechas_html($fecha_termino);
							$dias = diferencia_entre_fechas($fecha_termino,$fecha_actual);
							$dias_exportar = $dias;
							if ($dias < 0){
								$dias = "<span class=\"texto_rojo\"> ".$dias."</span>";
							}
							
							
							if ($finalizada == 1){
								$fecha_inicio= fechas_bd($fecha_inicio);
								$fecha_termino = fechas_bd($fecha_termino);
								$sql = "Select fecha from sgs_flujo_estados_solicitud where folio = '$folio' and id_estado_solicitud = $id_sub_estado_solicitud";
								$resultado_fecha = cms_query($sql)or die (error($sql,mysql_error(),$php));
								list($fecha_respuesta) = mysql_fetch_row($resultado_fecha);
								//echo "<br>fecha_respuesta:".$fecha_respuesta."<br>";
								$respondida_en = calculaDiasHabilesEntreFechas($fecha_inicio,$fecha_respuesta);
								$respondida_en = $respondida_en. "&nbsp;d&iacute;as";
								//$fecha_respuesta = fechas_html($fecha_respuesta);
								
								//$fecha_termino = fechas_html($fecha_termino);
								//echo "<br>fecha de respuesta:".$fecha_respuesta;
								//echo "<br>fecha de termino:".$fecha_termino;
								$dias = calculaDiasHabilesEntreFechas($fecha_respuesta,$fecha_termino);
								$dias_exportar = $dias;
								//echo "<br>dias:".$dias;
							}
							
							$fecha_inicio= fechas_html($fecha_inicio);
							$fecha_termino = fechas_html($fecha_termino);
							/* if ($dias >=0){
								$plazo = $dias ." d&iacute;as";
							 }else{
								$plazo = " vencida hace ".$dias * (-1) ." d&iacute;as";
							 }*/
							
										
							if($cambia_color ==1){
								$clase= "class=\"alternate\"";
								$cambia_color=0;
							}else{
								$clase="";
								$cambia_color=1;
							}
							if (abs($dias_exportar) != 1){
								$dias_exportar .= " días";
							}else{
								$dias_exportar .= " día";
							}
							
							//echo "<br>dias:".$dias;
							$csv_tabla = acentos_inverso($csv_tabla.$folio.$csv_separador.$fecha_inicio.$csv_separador.$fecha_termino.$csv_separador.$fecha_respuesta.$csv_separador.$dias_exportar.$csv_separador.$estado_padre.$csv_separador.$estado_solicitud.$csv_fin_linea);
							
							$folio = "<a href='index.php?accion=$accion&amp;act=$act&amp;nivel=Detalle&amp;id_entidad_padre=$id_entidad_padre&id_entidad=$id_entidad&periodo=$periodo&mes=$mes&folio=$folio'>$folio</a>";
							
							$fecha_respuesta = fechas_html($fecha_respuesta);
							$lista_mis_solicitudes = cms_replace("#INTERLINEADO#","$clase",$lista_mis_solicitudes);
							$lista_mis_solicitudes = cms_replace("#FOLIO#","$folio",$lista_mis_solicitudes);
							$lista_mis_solicitudes = cms_replace("#FECHA_INGRESO#","$fecha_inicio",$lista_mis_solicitudes);
							$lista_mis_solicitudes = cms_replace("#FECHA_ESTIMADA_TERMINO#","$fecha_termino",$lista_mis_solicitudes);
							$lista_mis_solicitudes = cms_replace("#FECHA_TERMINO#","$fecha_respuesta",$lista_mis_solicitudes);
							$lista_mis_solicitudes = cms_replace("#DIAS# ","$dias",$lista_mis_solicitudes);
							$lista_mis_solicitudes = cms_replace("#RESPONDIDA_EN#","$respondida_en",$lista_mis_solicitudes);
							$lista_mis_solicitudes = cms_replace("#ESTADO#","$estado_solicitud",$lista_mis_solicitudes);
							$lista_mis_solicitudes = cms_replace("#ESTADO_PADRE#","$estado_padre",$lista_mis_solicitudes);
							
							
							
							$lineas .=$lista_mis_solicitudes;
							
						}
					}
					
					$tabla = cms_replace("#PAGINAS#","",$tabla);
					$tabla = cms_replace("#LISTA_SOLICITUDES#",$lineas,$tabla);
					//$lineas .= "</table>";
					
					$_SESSION['tabla_csv'] = $csv_tabla ;
					return $tabla;
}//fin funcion





?>