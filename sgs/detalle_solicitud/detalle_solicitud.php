<?php


	$folio =  $_GET['folio'];
	//$folio = "AL003P-0008895";
	$mensaje =  $_GET['mensaje'];
	
	$datos_derivacion = "";
	$datos_derivacion = Recupera_datos_derivacion_tabla($folio);

	//sacar el html del contenido
	//$contenido = html_template('detalle_solicitud_finalizada');		
	$contenido = html_template('contenedor_admin_solicitudes_ver');		
	$mensaje_archivar_solicitud = html_template('mensaje_archivar_solicitud');		
	$mensaje_activar_solicitud = html_template('mensaje_activar_solicitud');		
	
	if($mensaje=="ok"){
		$mensaje = configuracion_cms('mensaje_cambio_estado');
		
	}
	if($mensaje=="pro"){
		$mensaje = configuracion_cms('mensaje_prorroga');
		
	}
	else{
		$mensaje = "";
	}
	
	/**/
	$css .="<style>
		div#users-contain { width: 350px; margin: 20px 0; }
		div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
		div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
		.ui-dialog .ui-state-error { padding: .3em; }
		.validateTips { border: 1px solid transparent; padding: 0.3em; }
	</style>";
	
	$js .="
	 <script type=\"text/javascript\" src=\"js/jquery/ui/ui.draggable.js\"></script>
     <script type=\"text/javascript\" src=\"js/jquery/ui/ui.dialog.js\"></script>
     <link type=\"text/css\" href=\"js/jquery/ui/themes/base/ui.all.css\" rel=\"stylesheet\" />
	";
	
	
		include ("sgs/detalle_solicitud/listado_archivos.php");
		$contenido = cms_replace("#DETALLE_ARCHIVOS#","",$contenido);
		$contenido= cms_replace("#LISTADO_ARCHIVOS#",$lista,$contenido);

	  
	 	$query= "SELECT * FROM sgs_solicitud_acceso WHERE folio = '$folio'";
		$result_q= cms_query($query)or die (error($query,mysql_error(),$php));
		$num_filas = mysql_num_fields($result_q);
		$resultado = mysql_fetch_row($result_q);

			for ($i = 1; $i < $num_filas; $i++){
				$nom_campo = mysql_field_name($result_q,$i);
				$valor = $resultado[$i];
					if(!is_numeric($valor)){
						$$nom_campo = $valor;
					}else{
						$$nom_campo = $valor;
					}
				}
		
		
		$id_usuario_folio = $id_usuario;
		
		
		$contenido = cms_replace("#MENSAJE#",$mensaje,$contenido);
	
	   $entidad_padre = rescata_valor('sgs_entidad_padre',$id_entidad_padre,'entidad_padre') ;
	   $entidad = utf8_decode(rescata_valor('sgs_entidades',$id_entidad,'entidad')) ;	
	 
	   $query= "SELECT fecha  
	            FROM  sgs_flujo_estados_solicitud
	            WHERE folio='$folio' and id_estado_solicitud='$id_sub_estado_solicitud' 
				order by id_flujo_estados_solicitud desc";

	      $result= cms_query($query)or die (error($query,mysql_error(),$php));
	      /*if(list($fecha_respuesta) = mysql_fetch_row($result)){
	       		 $plazo = calculaDiasHabilesEntreFechas($fecha_inicio,$fecha_respuesta);
	 			 $plazo = $plazo. " d&iacute;as";
	 			 $fecha_respuesta_1 = fechas_html($fecha_respuesta); 
	       	
	       }else{
	       	  $plazo = calculaDiasHabilesEntreFechas($fecha_inicio,$fecha_termino);
	 			 $plazo = $plazo. " d&iacute;as";
	 			 $fecha_respuesta_1 = fechas_html($fecha_respuesta); 
			
	       }*/
		   
		/*$id_sub_estado_solicitud = $aRow[$aColumnsBD[4]];
		$fecha_ingreso = $aRow[$aColumnsBD[1]];		
		$folio = $aRow[$aColumnsBD[0]];	*/
	 $plazo= saca_plazo($folio,$id_estado_solicitud,$fecha_ingreso);
	       
	      


     $fecha_termino_1 = fechas_html($fecha_termino);
	  
	
	 $estado_padre = rescata_valor('sgs_estado_solicitudes',$id_estado_solicitud,'estado_solicitud'); 
	 	
	 //$estado_solicitud= rescata_valor('sgs_estado_solicitudes',$id_estado_solicitud,'estado_solicitud'); 
	 $estado_solicitud=$estado_padre;
	 
	 
	 $fecha_inicio = fechas_html($fecha_inicio);
	 $estado_mostrar_cv = $estado_solicitud;
	 
	 	
	  	$query= "SELECT * FROM usuario WHERE id_usuario = '$id_usuario_folio'";
		
		$result_q= cms_query($query)or die (error($query,mysql_error(),$php));
		$num_filas = mysql_num_fields($result_q);
		$resultado = mysql_fetch_row($result_q);

			for ($i = 1; $i < $num_filas; $i++){
				$nom_campo = mysql_field_name($result_q,$i);
				$valor = $resultado[$i];
					if(!is_numeric($valor)){
						$$nom_campo = $valor;
					}else{
						$$nom_campo = $valor;
					}
				//echo $$nom_campo ."= $valor;<br>";
				}
				
	 
	 
		//validar existencia de rectificacion
				$sql = "Select  id_tipo_persona , nombre , paterno , materno ,razon_social ,apoderado ,email , direccion , numero ,depto ,ciudad ,id_region ,id_comuna 						
						from sgs_rectificacion_solicitud
						where folio = '$folio' ";
				$result_rectificar = cms_query($sql)or die (error($sql,mysql_error(),$php));
				
				if (mysql_num_rows($result_rectificar)>0){
					list($id_tipo_persona,$nombre,$paterno,$materno,$razon_social,$apoderado,$correo_electronico,$direccion,$numero,$depto,$ciudad,$id_region,$id_comuna) = mysql_fetch_row($result_rectificar);
					$id_pais = verificaPais($id_region,"sgs_rectificacion_solicitud","folio",$folio);
					$solicitante = nombre_usuario2($id_usuario);
				}else{
					/*
					$nombre =       rescata_valor('usuario',$id_usuario,'nombre');
					$paterno =      rescata_valor('usuario',$id_usuario,'paterno');
					$materno =      rescata_valor('usuario',$id_usuario,'materno');
					$razon_social = rescata_valor('usuario',$id_usuario,'razon_social');
					$apoderado =    rescata_valor('usuario',$id_usuario,'apoderado');
					$email =        rescata_valor('usuario',$id_usuario,'email');	
					$direccion =    rescata_valor('usuario',$id_usuario,'direccion') ;
					
					$numero =       rescata_valor('usuario',$id_usuario,'numero') ;
					$depto =        rescata_valor('usuario',$id_usuario,'depto') ;
					$ciudad =       rescata_valor('usuario',$id_usuario,'ciudad') ;
					$id_region =    rescata_valor('usuario',$id_usuario,'id_region') ;
					$id_comuna =    rescata_valor('usuario',$id_usuario,'id_comuna') ;
					$correo_electronico = rescata_valor('usuario',$id_usuario,'email') ;
					*/
					$id_pais = verificaPais($id_region,"usuario","id_usuario",$id_usuario);
					$solicitante = $nombre." ".$paterno." ".$materno;			
				}
					
					$correo_electronico = $email;
					$responsable_solicitud = nombre_usuario2($id_responsable);
					
					
		//fin validar existencia rectificacion
	$tipo_solicitud = rescata_valor('sgs_tipo_solicitud',$id_tipo_solicitud,'tipo_solicitud') ;
	
		//si esta desistida por no rectificacion
	$coloca_boton = "";
	
			$titulo_panel=html_template("contenedor_boton_reactivar");
			
			$mensaje = html_template($template);
            if($mensaje=="$template no existe"){  
			
				  $contenedor_generico = " \t <tr >\r\n    \t   <td align=\"left\" ><div align=\"left\" style=\"border: 1px solid #999999; background-color: #f8f8f8;padding: 5px; width:600px\">La siguiente solicitud se encuentra en estado \"Finalizada: Desistida por no Rectificaci&oacute;n\", para reactivarla y que &eacute;sta vuelva al estado previo a su finalizaci&oacute;n, presione el bot&oacute;n\"Reactivar\"<br /><br />\r\n    \t    <textarea name=\"observacion_reactivar\" id=\"observacion_reactivar\" cols=\"80\" rows=\"8\" class=\"textos\"></textarea>\r\n\r\n    \t     <br />\r\n    \t     <input type=\"button\" name=\"Reactivar\" id=\"Reactivar\" value=\"Reactivar\" onclick=\"if (confirm(\'Al reactivar la solicitud, esta volver&aacute; al estado #ESTADO_PREVIO_SOLICITUD#\')){\r\n\t\t\t  if(document.form1.observacion_reactivar.value==\'\'){alert(\'Debe ingresar la observación para reactivar la solicitud\'); document.form1.observacion_reactivar.focus();return false; }else{\tdocument.form1.submit();  } }\" />\r\n             <input type=\"hidden\" name=\"folio\" id=\"folio\" value=\"#ID_SOLICITUD#\" />\r\n</div></td>\r\n  \t   </tr>\r\n\r\n\r\n\r\n";
				  
                  $_POST['templates']="$template";
                  $_POST['html']=$contenedor_generico;
                  inserta("templates_acciones");
            }

				
				$tipo_solicitud = rescata_valor('sgs_tipo_solicitud',$id_tipo_solicitud,'tipo_solicitud') ;
				
				/**************************/
				
			
	//fin inserta template
	//echo  "<br>id estado:".$id_sub_estado_solicitud;
	$id_perfil = perfil($id_sesion);

	if (($id_sub_estado_solicitud == 23) and ($id_perfil == "1001")){
		
		$coloca_boton = html_template ('contenedor_boton_reactivar');
		//reemplazar la etiqueta #ESTADO_PREVIO_SOLICITD#
		$estado = Recupera_ultimo_estado($folio);
		
		$coloca_boton = cms_replace("#ESTADO_PREVIO_SOLICITUD#","$estado",$coloca_boton);
		
	}
	
	
	// $contenido = acentos($contenido);
	 
	 $fecha_termino = fechas_html($fecha_termino);
	 $fecha_inicio2 =  date(d)."-".date(m)."-".date(Y);
	 $dias = diferencia_entre_fechas($fecha_termino,$fecha_inicio2);
	 $fecha_ingreso= $fecha_inicio;
	
	include("sgs/lista_categorias/lista_categorias.php");
    //include("sgs/reemplaza_etiquetas/reemplaza_etiquetas.php");
		 $contenido = cms_replace("#ID_SOLICITUD#","<b>$folio</b>",$contenido);
	 $contenido = cms_replace("#FECHA_INGRESO#",fechas_html($fecha_ingreso),$contenido);
	 $contenido = cms_replace("#SERVICIO#",$entidad_padre,$contenido);
	 $contenido = cms_replace("#TIPO_SOLICITUD#","<b>$tipo_solicitud</b>",$contenido);
	 
	 $contenido = cms_replace("#ENTIDAD#",$entidad,$contenido);
	 $contenido = cms_replace("#ESTADO_PADRE#",$estado_padre,$contenido); 
	 $contenido = cms_replace("#ESTADO#",$estado_solicitud,$contenido); 
	 $contenido = cms_replace("#SOLICITANTE#",utf8_decode($solicitante),$contenido);
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
	
	$forma_recepcion = utf8_decode(rescata_valor('sgs_forma_recepcion',$id_forma_recepcion,'forma_recepcion')) ;
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
	
	
	
	
	
	
	
	 
	// $forma_recepcion = utf8_decode(rescata_valor('sgs_forma_recepcion',$id_forma_recepcion,'forma_recepcion')) ;
	 
	 $contenido = cms_replace("#PLAZO#",$plazo,$contenido);
	 $contenido = cms_replace("#MENSAJE#",$mensaje,$contenido);
	 $contenido = str_replace("Respuesta en:","Plazo :",$contenido);
	 
	 
	 
	
	 		
	/* include("sgs/historial_estado/historial_estado.php");			
	 $contenido = cms_replace("#VER_HISTORIAL#",$template_historial,$contenido);	
	*/
	$contenido = utf8_encode($contenido);
	include("sgs/gestion/gestion.php");
	include("sgs/historial_estado/historial_estado.php");
	
	$template_historial = utf8_decode($template_historial);
	
	$contenido = cms_replace("#HISTORIAL#","$template_historial",$contenido);
	
	
	



?>