<?php
	//detalle de la solicitud
					
					list($id_solicitud_acceso,$folio,$id_entidad,$id_entidad_padre,$id_usuario,$identificacion_documentos,$notificacion,$id_forma_recepcion,$oficina,$id_formato_entrega,$fecha_inicio,$fecha_termino,$orden,$id_estado_solicitud,$id_estado_solicitud,$estado_padre,$id_sub_estado_solicitud,$id_responsable,$estado_solicitud,$firmada,$prorroga) = mysql_fetch_row($result);
					/*  list($id_solicitud_acceso,$folio,$id_entidad,$id_entidad_padre,$id_usuario,$identificacion_documentos,$notificacion,$id_forma_recepcion,$oficina,$id_formato_entrega,$fecha_inicio,$fecha_termino,$orden,$id_estado_solicitud,$estado_solicitud,$id_sub_estado_solicitud,$id_responsable,$estado_padre) = mysql_fetch_row($result);*/
				  
				     //cargar el template del detalle de la solicitud
					 $informacion = html_template('reporte_detalle_solicitud');	
					 
					 $responsable = nombre_usuario($id_responsable);
					 
					 $fecha_termino = fechas_html($fecha_termino);
					 $fecha_inicio2 =  date(d)."-".date(m)."-".date(Y);
					 
					 
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
							
					 if($finalizada!=1){
					 
					  $dias = diferencia_entre_fechas($fecha_termino,$fecha_inicio2);
					 
					 if ($dias >=0){
					 	$plazo = $dias ." d&iacute;as";
					 }else{
					 	$plazo = " vencida hace ".$dias*(-1) ." d&iacute;as";
					 }
					
					 
					 
					 
					 }else{
					 $fecha_respuesta="";
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
								//$dias = calculaDiasHabilesEntreFechas($fecha_respuesta,$fecha_termino);
							
					 
					 
					 }
					 
					 
					  if($fecha_respuesta!=""){
							$plazo = calculaDiasHabilesEntreFechas(fechas_bd($fecha_respuesta),fechas_bd($fecha_inicio));
							$plazo= $plazo * -1;
							
							}
					 
					 
					 $informacion = cms_replace("#PLAZO#",$plazo,$informacion);
					 
					 
					 $fecha_inicio = fechas_html($fecha_inicio);
					 
					 $informacion = cms_replace("#ID_SOLICITUD#",$folio,$informacion);
					 $informacion = cms_replace("#FECHA_INGRESO#",$fecha_inicio,$informacion);
					 //$informacion = cms_replace("#SERVICIO#",$entidad_padre,$informacion);
					 $informacion = cms_replace("#RESPONSABLE#",$responsable,$informacion);
					
					
					 $informacion = cms_replace("#ESTADO_PADRE#",$estado_padre,$informacion); 
					 $informacion = cms_replace("#ESTADO#",$estado_solicitud,$informacion); 
					
					 $informacion = cms_replace("#IDENTIFICACION_DOCUMENTOS#",$identificacion_documentos,$informacion);
					 
					/*************************************************/
					
					 if($firmada==1){
						 $firmada = "Si";
					 }else{
						 $firmada= "No";
					 }
					 
					 $informacion = cms_replace("#FIRMADA#","$firmada",$informacion);
					 
					
					
					$entidad = rescata_valor('sgs_entidades',$id_entidad,'entidad') ;
					$informacion = cms_replace("#ENTIDAD#",$entidad,$informacion);
					
					$entidad_padre = rescata_valor('sgs_entidad_padre',$id_entidad_padre,'entidad_padre') ;
					$informacion = cms_replace("#SERVICIO#",$entidad_padre,$informacion); 
					
					
					$nombre = rescata_valor('usuario',$id_usuario,'nombre') ;
					$paterno = rescata_valor('usuario',$id_usuario,'paterno') ;
					$materno = rescata_valor('usuario',$id_usuario,'materno') ;
					
					$razon_social = rescata_valor('usuario',$id_usuario,'razon_social');
						
					$solicitante = $nombre." ".$paterno." ".$materno;
					
					if(trim($razon_social)!=""){
						$solicitante = $razon_social;
					}else{
						$solicitante = $nombre." ".$paterno." ".$materno;
					}
					
					$informacion = cms_replace("#SOLICITANTE#",$solicitante,$informacion);
					
					$correo_electronico = rescata_valor('usuario',$id_usuario,'email') ;
					$informacion = cms_replace("#CORREO_ELECTRONICO#",$correo_electronico,$informacion);
					
					
					 
					$informacion = cms_replace("#FECHA_TERMINO#","$fecha_termino",$informacion);
									
					$apoderado = rescata_valor('usuario',$id_usuario,'apoderado') ;
					if(trim($apoderado)!=""){
						$apoderado ="<tr><td>Apoderado:</td><td colspan=\"5\"><strong>$apoderado </strong></td></tr>";
					}else{
						$apoderado="";
					}
					$informacion = cms_replace("#APODERADO#","$apoderado",$informacion);
				
					
					
					$entidad_hija = rescata_valor('sgs_entidades',$id_entidad,'entidad'); 
					$informacion = cms_replace("#ENTIDAD_HIJA#","",$informacion);
					$informacion = cms_replace("#ENTIDAD#",acentos($entidad_hija),$informacion);
									
					$informacion = cms_replace("#LINK_EDITAR#","$link_editar",$informacion);
					$informacion = cms_replace("#DIAS#","$dias",$informacion);
					$informacion = cms_replace("#OBS#","$identificacion_documentos",$informacion);
					$informacion = cms_replace("#ACCION#","$accion",$informacion);
					$informacion = cms_replace("#LINK_PRINT#","$link_print",$informacion);
					if($notificacion==0)$notificacion="No";
					if($notificacion==1)$notificacion="Si";
					
					$informacion = cms_replace("#MEDIO_NOTIFICACION#","$notificacion",$informacion);
					
					$forma_recepcion = rescata_valor('sgs_forma_recepcion',$id_forma_recepcion,'forma_recepcion') ;
					$informacion = cms_replace("#FORMA_RECEPCION#","$forma_recepcion",$informacion);
					$estado_solicitud = rescata_valor('sgs_estado_solicitudes',$id_estado_solicitud,'estado_para_usuario') ;
					
					$formato_entrega = rescata_valor('sgs_formato_entrega',$id_formato_entrega,'formato_entrega') ;
					$informacion = cms_replace("#FORMA_ENTREGA#","$formato_entrega",$informacion);
					
					if($oficina!=""){
						$retiro_oficina = "  <tr>
							  <td>Oficina: </td>
							  <td colspan=\"2\"><b>$oficina</b></td>
							  <td colspan=\"2\">&nbsp;</td>
							  <td>&nbsp;</td>
							</tr>";
					}
					$informacion = cms_replace("#RETIRO_OFICINA#","$retiro_oficina",$informacion);
					
					
					 if(trim($prorroga)==0){
					  	$prorrogada = "No";
					}else{
						$prorrogada = "Si";
					 }

					
					
            		$informacion = cms_replace("#SOLICITUD_PRORROGADA#",$prorrogada, $informacion);
					
					$direccion = rescata_valor('usuario',$id_usuario,'direccion') ;
					$informacion = cms_replace("#DIRECCION#","$direccion",$informacion);
					
					$numero = rescata_valor('usuario',$id_usuario,'numero') ;
					$informacion = cms_replace("#NUMERO#","$numero",$informacion);
					
					$depto = rescata_valor('usuario',$id_usuario,'depto') ;
					$informacion = cms_replace("#DEPARTAMENTO#","$depto",$informacion);
					
					$ciudad = rescata_valor('usuario',$id_usuario,'ciudad') ;
					$informacion = cms_replace("#CIUDAD#","$ciudad",$informacion);
					
					$id_region = rescata_valor('usuario',$id_usuario,'id_region') ;
					$region = rescata_valor('regiones',$id_region,'region') ;
					$informacion = cms_replace("#REGION#","$region",$informacion);
					
					
					$id_comuna = rescata_valor('usuario',$id_usuario,'id_comuna') ;
					$comuna = rescata_valor('comunas',$id_comuna,'comuna') ;
					$informacion = cms_replace("#COMUNA#","$comuna",$informacion);
					
					include("sgs/historial_estado/historial_estado.php");			
	 				$informacion = cms_replace("#VER_HISTORIAL#",$template_historial,$informacion);	

					session_register_cms('tabla_mail');
					$_SESSION['tabla_mail'] = $informacion;
					 /****************************************************/


?>