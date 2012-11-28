<?php
 
	/*$query= "SELECT observacion_adicional
				FROM sgs_solicitud_acceso a
				WHERE folio='$folio' ";
				//echo $query;
				
	$result_ia= cms_query($query)or die (error($query,mysql_error(),$php));
	list($observacion_adicional) = mysql_fetch_row($result_ia);
	$contenedor_informacion_adicional = "";
	if($observacion_adicional != ""){
					$contenedor_informacion_adicional = html_template("contenedor_informacion_adicional");
					$observacion_adicional = htmlspecialchars_decode($observacion_adicional);
					$contenedor_informacion_adicional = cms_replace("#INFORMACION_ADICIONAL#",$observacion_adicional,$contenedor_informacion_adicional);					
									
				}
	$contenido = cms_replace("#LINEA_INFORMACION_ADICIONAL#",$contenedor_informacion_adicional,$contenido);
	*/
	
	 $contenido = cms_replace("#ID_SOLICITUD#","<b>$folio</b>",$contenido);
	 $contenido = cms_replace("#FECHA_INGRESO#",fechas_html($fecha_ingreso),$contenido);
	 $contenido = cms_replace("#SERVICIO#",$entidad_padre,$contenido);
	 $contenido = cms_replace("#TIPO_SOLICITUD#","<b>$tipo_solicitud</b>",$contenido);
	 
	 $contenido = cms_replace("#ENTIDAD#",$entidad,$contenido);
	 $contenido = cms_replace("#ESTADO_PADRE#",$estado_padre,$contenido); 
	 $contenido = cms_replace("#ESTADO#",$estado_solicitud,$contenido); 
	 $contenido = cms_replace("#SOLICITANTE#",$solicitante,$contenido);
	 $contenido = cms_replace("#IDENTIFICACION_DOCUMENTOS#",$identificacion_documentos,$contenido);
	 $contenido = cms_replace("#BOTON_CANCELAR#",$boton_cancelar,$contenido);
	 $contenido = cms_replace("#ONCLICK#",$onClick,$contenido);
	/*************************************************/
	 include("sgs/opcionales/opcionales.php");
	
	 $contenido = cms_replace("#OPCIONALES#",$opcionales,$contenido);
	 $contenido = cms_replace("#MENSAJES#",$mensajes,$contenido);
	 $contenido = cms_replace("#RESPONSABLE_SOLICITUD#",$responsable_solicitud,$contenido);
	
	/*************************************************/
	$contenido = cms_replace("#FECHA_INGRESO#","$fecha_ingreso",$contenido);
	$contenido = cms_replace("#FECHA_TERMINO#","$fecha_termino",$contenido);
	
	$fecha_movil = "";
	//SI EL ESTADO ES RESPONDIDA:xxxx o si paso por ese estado previamente DEBE APARECER LA FECHA DE RESPUESTA
	//echo "<br>id_estado_soicitud:$id_estado_solicitud";
	if ($id_estado_solicitud=="13"){
		if ($id_sub_estado_solicitud == "14" or $id_sub_estado_solicitud == "15"){
			//sacar la fecha del historial
			$sql = "Select fecha 
					from sgs_flujo_estados_solicitud 
					where folio = '$folio' and id_estado_solicitud = '$id_sub_estado_solicitud' " ;
			$res_fecha_movil = cms_query($sql)or die ("ERROR $php <br>$query.<br>".mysql_error());
			list($fecha_respuesta) = mysql_fetch_row($res_fecha_movil);
			$fecha_movil = "<tr>
					  <td class=\"alt\">Fecha de respuesta</td>
					  <td colspan=\"5\">".fechas_html($fecha_respuesta)."</td>
					</tr>";
			$fecha_termino = $fecha_respuesta;
		}else{
				//echo "\n id_sub_estado_solicitud:".$id_sub_estado_solicitud;
			if ($id_sub_estado_solicitud == "28" or $id_sub_estado_solicitud == "29"){
				//echo "<br>entra al estado";
				
				$sql = "Select fecha 
					from sgs_flujo_estados_solicitud 
					where folio = '$folio' and id_estado_solicitud = '$id_sub_estado_solicitud' " ;
				$res_fecha_movil = cms_query($sql)or die ("ERROR $php <br>$query.<br>".mysql_error());
				list($fecha_respuesta) = mysql_fetch_row($res_fecha_movil);
				$fecha_movil2 = "<tr>
					  <td class=\"alt\">Fecha de finalizaci&oacute;n</td>
					  <td colspan=\"5\">".fechas_html($fecha_respuesta)."</td>
					</tr>";
				
				
				$sql = "Select fecha 
					from sgs_flujo_estados_solicitud 
					where folio = '$folio' and id_estado_solicitud in (14,15) " ;
				//	echo "\n $sql";
				$res_fecha_movil = cms_query($sql)or die ("ERROR $php <br>$query.<br>".mysql_error());
				list($fecha_respuesta) = mysql_fetch_row($res_fecha_movil);
				$fecha_movil .= "<tr>
					  <td class=\"alt\">Fecha de respuesta</td>
					  <td colspan=\"5\">".fechas_html($fecha_respuesta)."</td>
					</tr>";
				//echo "fecha respuesta 0:".$fecha_respuesta."       " ;
				
			}
			if ($id_sub_estado_solicitud < "28" ){
				$sql = "Select fecha 
					from sgs_flujo_estados_solicitud 
					where folio = '$folio' and id_estado_solicitud = '$id_sub_estado_solicitud' " ;
				$res_fecha_movil = cms_query($sql)or die ("ERROR $php <br>$query.<br>".mysql_error());
				list($fecha_respuesta) = mysql_fetch_row($res_fecha_movil);
				$fecha_movil .= "<tr>
					  <td class=\"alt\">Fecha de finalizaci&oacute;n</td>
					  <td colspan=\"5\">".fechas_html($fecha_respuesta)."</td>
					</tr>";
					//echo "fecha respuesta 1:".$fecha_respuesta."       " ;
				
			}
			$fecha_movil .= $fecha_movil2;
			$fecha_termino = $fecha_respuesta;
			//echo "fecha termino 1:".$fecha_termino."       " ;
		}
		
	}
	$contenido = cms_replace("#FECHAS_MOVILES#",$fecha_movil,$contenido);
	
	//SI EL ESTADO ES FINALIZADA:XXXXX DEBE APARECER LA FECHA DE FINALIZACION
	//echo "<br>fecha_ingreso:".$fecha_ingreso."&nbsp;&nbsp;fecha_terminno:".$fecha_termino;
	
	//$dias = diferencia_entre_fechas($fecha_termino,$fecha_ingreso);
	//echo "fecha termino:".$fecha_termino;
	if($plazo==""){
	$dias = calculaDiasHabilesEntreFechas(fechas_bd($fecha_ingreso),fechas_bd($fecha_respuesta));
	//echo "dias:".$dias;
	$plazo = $dias;
	if (abs($plazo) == 1){
		$plazo = $plazo ." d&iacute;a";
	}else{
		$plazo = $plazo ." d&iacute;as";
	}
	

	}
		
	
	
	$contenido = cms_replace("#PLAZO#",$plazo,$contenido);	
	
	$contenido = cms_replace("#SERVICIO#",acentos($entidad_padre),$contenido);
	
	//$apoderado = rescata_valor('usuario',$id_usuario,'apoderado') ;
	if(trim($apoderado)!=""){
	   	$apoderado ="<tr><td class=\"alt\">Apoderado:</td><td colspan=\"5\">
		$apoderado </td></tr>";
	}
	$contenido = cms_replace("#APODERADO#","$apoderado",$contenido);

	//$contenido = cms_replace("#ESTADO#","$estado_solicitud",$contenido);
	
	
	
	$entidad_hija = rescata_valor('sgs_entidades',$id_entidad,'entidad'); 
	$contenido = cms_replace("#ENTIDAD_HIJA#","",$contenido);
	$contenido = cms_replace("#ENTIDAD#",acentos($entidad_hija),$contenido);
					
	$contenido = cms_replace("#LINK_EDITAR#","$link_editar",$contenido);
	$contenido = cms_replace("#DIAS#","$dias",$contenido);
	//$identificacion_documentos = acentos($identificacion_documentos);
	$contenido = cms_replace("#OBS#","$identificacion_documentos",$contenido);
	$contenido = cms_replace("#ACCION#","$accion",$contenido);
	if($_GET['axj']==1 and $_GET['p']==1){
		$contenido = cms_replace("#LINK_PRINT#","",$contenido);
	}else{
		if($print!=""){
			$contenido = cms_replace("#LINK_PRINT#","<div align=\"right\">$print</div>",$contenido);
		}else{
			$contenido = cms_replace("#LINK_PRINT#","<div align=\"right\">$link_print</div>",$contenido);
		}
	}
	
	
	
	
	
	if($notificacion==0)$notificacion="No";
	if($notificacion==1)$notificacion="Si";
	
	$contenido = cms_replace("#MEDIO_NOTIFICACION#","$notificacion",$contenido);
	
	$forma_recepcion = rescata_valor('sgs_forma_recepcion',$id_forma_recepcion,'forma_recepcion') ;
	$contenido = cms_replace("#FORMA_RECEPCION#","$forma_recepcion",$contenido);
	$estado_solicitud = rescata_valor('sgs_estado_solicitudes',$id_estado_solicitud,'estado_para_usuario') ;
	
	$formato_entrega = rescata_valor('sgs_formato_entrega',$id_formato_entrega,'formato_entrega') ;
	$contenido = cms_replace("#FORMA_ENTREGA#","$formato_entrega",$contenido);
	if($oficina!=""){
	
	    $retiro_oficina = "  <tr>
				   <td class=\"alt\">Oficina: </td>
				   <td colspan=\"5\">$oficina</td>
				 </tr>";

	}
	
	
	if($firmada==1){
	  $firmada = "si";
	 }else{
	  $firmada= "no";
	 }
	 
	 
	$contenido = cms_replace("#FIRMADA#","$firmada",$contenido);
	$contenido = cms_replace("#RETIRO_OFICINA#","$retiro_oficina",$contenido);
	$contenido = cms_replace("#DATOS_DERIVACION#","$datos_derivacion",$contenido);

	//$direccion = rescata_valor('usuario',$id_usuario,'direccion') ;
	$contenido = cms_replace("#DIRECCION#",$direccion,$contenido);

	//$numero = rescata_valor('usuario',$id_usuario,'numero') ;
	$contenido = cms_replace("#NUMERO#","$numero",$contenido);
	
	//$depto = rescata_valor('usuario',$id_usuario,'depto') ;
	$contenido = cms_replace("#DEPARTAMENTO#","$depto",$contenido);
	
	//$ciudad = rescata_valor('usuario',$id_usuario,'ciudad') ;
	$contenido = cms_replace("#CIUDAD#",$ciudad,$contenido);
	
	//$id_region = rescata_valor('usuario',$id_usuario,'id_region') ;
	
	//echo "<br>id region:".$id_region;
	$region = rescata_valor('regiones',$id_region,'region');
	$contenido = cms_replace("#REGION#","$region",$contenido);
	
	$id_pais = verificaPais($id_region,"usuario","id_usuario",$id_usuario);
	
	
	$pais = rescata_valor('pais',$id_pais,'pais') ;
	$contenido = cms_replace("#PAIS#","$pais",$contenido);
	
	//$correo_electronico = rescata_valor('usuario',$id_usuario,'email') ;
	$contenido = cms_replace("#CORREO_ELECTRONICO#",$correo_electronico,$contenido);
	
	$id_comuna = rescata_valor('usuario',$id_usuario,'id_comuna') ;
	$comuna = rescata_valor('comunas',$id_comuna,'comuna') ;
	$contenido = cms_replace("#COMUNA#","$comuna",$contenido);
	
	
	/*
	$check_solicitante = "<input type=\"checkbox\" name=\"ver_solicitante\" id=\"ver_solicitante\">Mostrar datos del solicitante&nbsp";
	$contenido = cms_replace("#DETALLE_SOLICITANTE#","$check_solicitante",$contenido);
	
		$js .="

					<script type=\"text/javascript\">
					
						$(document).ready(function(){
						
							$('#ver_solicitante').click(function(){
								var checkeado=$(\"#ver_solicitante\").attr(\"checked\");
								if(checkeado){
									$('#div_datos_solicitante').show(100);
								}else{
									$('#div_datos_solicitante').css(\"display\", \"none\");
								}
							});
						});
					
					</script>

				";*/
	
	
	 /****************************************************/

	 
	 $contenido = cms_replace("#ASIGNAR#","$asignar",$contenido);
	
	 $contenido = cms_replace("#RESPONSABLE#",$responsable,$contenido);
	
     $contenido = cms_replace("#CATEGORIAS#",$lista_categorias_folio,$contenido);
	 
	if($observacion_adicional != ""){
					
		$contenedor_informacion_adicional = html_template("contenedor_informacion_adicional");
		$observacion_adicional = htmlspecialchars_decode($observacion_adicional);
		$contenedor_informacion_adicional = cms_replace("#INFORMACION_ADICIONAL#",$observacion_adicional,$contenedor_informacion_adicional);					
		$contenido = cms_replace("#LINEA_INFORMACION_ADICIONAL#",$contenedor_informacion_adicional,$contenido);
	}
	
	 
?>