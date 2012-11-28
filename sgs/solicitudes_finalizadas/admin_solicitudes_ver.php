<?php
				
	
	$folio =  $_GET['folio'];
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
	
	
	 $contenido = cms_replace("#MENSAJE#",$mensaje,$contenido);
	 
	 	$query= "SELECT * FROM sgs_solicitud_acceso WHERE folio = '$folio'";
		$result_q= cms_query($query)or die (error($query,mysql_error(),$php));
		$num_filas = mysql_num_fields($result_q);
		$resultado = mysql_fetch_row($result_q);

			for ($i = 1; $i < $num_filas; $i++){
				$nom_campo = mysql_field_name($result_q,$i);
				$valor = $resultado[$i];
				$$nom_campo = $valor;
				}

	 $id_usuario_folio = $id_usuario;
	
	   $query= "SELECT fecha  
	            FROM  sgs_flujo_estados_solicitud
	            WHERE folio='$folio' and id_estado_solicitud=$id_sub_estado_solicitud order by id_flujo_estados_solicitud desc";
	      $result= cms_query($query)or die (error($query,mysql_error(),$php));
	       if(list($fecha_respuesta) = mysql_fetch_row($result)){
	       		 
	       		 //$fecha_termino = $fecha_respuesta;
				 $plazo = calculaDiasHabilesEntreFechas($fecha_inicio,$fecha_respuesta);
	 			 $plazo = $plazo. " d&iacute;as";
	 			 $fecha_respuesta_1 = fechas_html($fecha_respuesta); 
	       	
	       }else{
	       	
	       	$fecha_respuesta_1="<font color=\"#FF0000\">???</font>";
	       	$plazo =  "<font color=\"#FF0000\">no es posible calcular el plazo, el calculo se realiza con fecha de respuesta menos
	       	 fecha de inicio</font>";
	       }
	       
	       
	 
	 

	/* */
	$id_entidad_padre2 =$id_entidad_padre;
	$id_entidad2 =$id_entidad;
	
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
				
				

     $fecha_termino_1 = fechas_html($fecha_termino);
	  
	 $sub_estado_solicitud = rescata_valor('sgs_estado_solicitudes',$id_sub_estado_solicitud,'estado_solicitud'); 
	 $estado_padre = rescata_valor('sgs_estado_solicitudes',$id_estado_solicitud,'estado_solicitud'); 
	 
	 	
	 $estado_solicitud= rescata_valor('sgs_estado_solicitudes',$id_sub_estado_solicitud,'estado_solicitud'); 
	 
	 $fecha_inicio = fechas_html($fecha_inicio);
	 $estado_mostrar_cv = $estado_solicitud;
	 
		//validar existencia de rectificacion
						$sql = "Select  id_tipo_persona , nombre , paterno , materno ,razon_social ,apoderado ,email , direccion , numero ,depto ,ciudad ,id_region ,id_comuna 						
						from sgs_rectificacion_solicitud
						where folio = '$folio' ";
				$result_rectificar = cms_query($sql)or die (error($sql,mysql_error(),$php));
				
				if (mysql_num_rows($result_rectificar)>0){
					list($id_tipo_persona,$nombre,$paterno,$materno,$razon_social,$apoderado,$correo_electronico,$direccion,$numero,$depto,$ciudad,$id_region,$id_comuna) = mysql_fetch_row($result_rectificar);
					$id_pais = verificaPais($id_region,"sgs_rectificacion_solicitud","folio",$folio);
					$solicitante = nombre_usuario($id_usuario);
				}else{
					
					$id_pais = verificaPais($id_region,"usuario","id_usuario",$id_usuario);
					$solicitante = $nombre." ".$paterno." ".$materno;			
				}
					
					$correo_electronico = $email;
					$responsable_solicitud = nombre_usuario2($id_responsable);
					
		//fin validar existencia rectificacion
	$tipo_solicitud = rescata_valor('sgs_tipo_solicitud',$id_tipo_solicitud,'tipo_solicitud') ;
				
	//$responsable_solicitud = nombre_usuario2($id_responsable);
	// $solicitante = nombre_usuario($id_usuario);
	
	
		//si esta desistida por no rectificacion
	$coloca_boton = "";
	
	
	//inserta template
			
			$titulo_panel=html_template("contenedor_boton_reactivar");
			
			$mensaje = html_template($template);
            if($mensaje=="$template no existe"){  
			
				  $contenedor_generico = " \t <tr >\r\n    \t   <td align=\"left\" ><div align=\"left\" style=\"border: 1px solid #999999; background-color: #f8f8f8;padding: 5px; width:600px\">La siguiente solicitud se encuentra en estado \"Finalizada: Desistida por no Rectificaci&oacute;n\", para reactivarla y que &eacute;sta vuelva al estado previo a su finalizaci&oacute;n, presione el bot&oacute;n\"Reactivar\"<br /><br />\r\n    \t    <textarea name=\"observacion_reactivar\" id=\"observacion_reactivar\" cols=\"80\" rows=\"8\" class=\"textos\"></textarea>\r\n\r\n    \t     <br />\r\n    \t     <input type=\"button\" name=\"Reactivar\" id=\"Reactivar\" value=\"Reactivar\" onclick=\"if (confirm(\'Al reactivar la solicitud, esta volver&aacute; al estado #ESTADO_PREVIO_SOLICITUD#\')){\r\n\t\t\t  if(document.form1.observacion_reactivar.value==\'\'){alert(\'Debe ingresar la observación para reactivar la solicitud\'); document.form1.observacion_reactivar.focus();return false; }else{\tdocument.form1.submit();  } }\" />\r\n             <input type=\"hidden\" name=\"folio\" id=\"folio\" value=\"#ID_SOLICITUD#\" />\r\n</div></td>\r\n  \t   </tr>\r\n\r\n\r\n\r\n";
				  
                  $_POST['templates']="$template";
                  $_POST['html']=$contenedor_generico;
                  inserta("templates_acciones");
            }

				$entidad_padre = rescata_valor('sgs_entidad_padre',$id_entidad_padre2,'entidad_padre') ;
				$tipo_solicitud = rescata_valor('sgs_tipo_solicitud',$id_tipo_solicitud,'tipo_solicitud') ;
				
				$entidad = rescata_valor('sgs_entidades',$id_entidad2,'entidad') ;
			
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
	 //$dias = diferencia_entre_fechas($fecha_termino,$fecha_inicio2);
	 //$fecha_ingreso= $fecha_inicio;
	//echo "<br>fecha ingreso:".$fecha_inicio;
	 $fecha_ingreso = $fecha_inicio;
	 $plazo = saca_plazo($folio,$id_sub_estado_solicitud,fechas_bd($fecha_inicio));
	 include("sgs/reemplaza_etiquetas/reemplaza_etiquetas.php");
	 
	 
	 
     $contenido = str_replace("Respuesta en:","Plazo :",$contenido);
	// $contenido = cms_replace("#PLAZO#",$plazo,$contenido);
	
	 		
	/* include("sgs/historial_estado/historial_estado.php");			
	 $contenido = cms_replace("#VER_HISTORIAL#",$template_historial,$contenido);	
	*/
	include("sgs/gestion/gestion.php");
	
	include("sgs/historial_estado/historial_estado.php");
	
	$contenido = cms_replace("#HISTORIAL#","$template_historial",$contenido);
	include ("sgs/documentos_sistema/formulario.php");
	include ("sgs/solicitudes_finalizadas/listado_archivos.php");
	
	$contenido = cms_replace("#DETALLE_ARCHIVOS#","",$contenido);
	$contenido= cms_replace("#LISTADO_ARCHIVOS#",$lista,$contenido);

	
		
?>