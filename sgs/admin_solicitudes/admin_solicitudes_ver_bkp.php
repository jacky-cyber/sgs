<?php

	
	$folio =  $_GET['folio'];
	$mensaje =  $_GET['mensaje'];
	
	
		
	 
	//sacar el html del contenido
	$contenido = html_template('contenedor_admin_solicitudes_ver');		
	
	if($mensaje=="ok"){
		$mensaje = "<span class=\"texto_rojo\">El responsable fue asignado correctamente</span>";
		
	}else{
		$mensaje = "";
	}
	$contenido = cms_replace("#MENSAJE#",$mensaje,$contenido);
	
	
	 $query= "SELECT id_solicitud_acceso,
				folio,
				a.id_entidad,
				a.id_entidad_padre,
				identificacion_documentos,notificacion,id_forma_recepcion,oficina,id_formato_entrega,fecha_inicio,fecha_termino,a.orden,id_estado_solicitud,id_sub_estado_solicitud,id_responsable,fecha_formulacion,id_digitador,hash,id_usuario,firmada
				FROM sgs_solicitud_acceso a
				WHERE folio='$folio' ";
				
				//echo $query;
				$result= cms_query($query)or die (error($query,mysql_error(),$php));
				
				list($id_solicitud_acceso,$folio,$id_entidad,$id_entidad_padre,$identificacion_documentos,$notificacion,$id_forma_recepcion,$oficina,$id_formato_entrega,$fecha_ingreso,$fecha_termino,$orden,$id_estado_solicitud,$id_sub_estado_solicitud,$id_responsable,$fecha_formulacion,$id_digitador,$hash,$id_usuario,$firmada) = mysql_fetch_row($result);
				
								
				$entidad_padre = rescata_valor('sgs_entidad_padre',$id_entidad_padre,'entidad_padre') ;
				$entidad = rescata_valor('sgs_entidades',$id_entidad,'entidad') ;
				
				$estado_padre = rescata_valor('sgs_estado_solicitudes',$id_estado_solicitud,'estado_solicitud') ;
				$estado_solicitud = rescata_valor('sgs_estado_solicitudes',$id_sub_estado_solicitud,'estado_solicitud') ;

				$nombre = rescata_valor('usuario',$id_usuario,'nombre');
				$paterno = rescata_valor('usuario',$id_usuario,'paterno');
				$materno = rescata_valor('usuario',$id_usuario,'materno');
				$razon_social = rescata_valor('usuario',$id_usuario,'razon_social');
				$apoderado = rescata_valor('usuario',$id_usuario,'apoderado');
				$email = rescata_valor('usuario',$id_usuario,'email');				
				
				if($razon_social!=""){
				$solicitante = $razon_social;
				}else{
				$solicitante = $nombre." ".$paterno." ".$materno;
				}
				  
				
	 
	 $fecha_ingreso = fechas_html($fecha_ingreso);
	//echo "responsable:".$id_responsable;
		
	 //llenar el combobox de responsables de entidad
	/*$query= "SELECT CONCAT(id_responsable,'-',a.id_usuario) clave,
					id_responsable,
					a.id_usuario,
				   CONCAT(nombre,' ',apellido,' ',materno) nombre
			FROM sgs_responsable a,
				 usuario b
			WHERE id_entidad_padre = ".$id_entidad_padre."
				  and id_entidad = ".$id_entidad."
				  and a.id_usuario = b.id_usuario";*/
	
	
	if ($id_responsable==""){
		$id_responsable_seleccionado = 0;
	}else{
		$id_responsable_seleccionado = $id_responsable;
	}
	
	$estados = "<option value=\"0\" ".$seleccionado.">Seleccione responsable..</option>";
	
	
	  $query= "SELECT id_usuario,nombre,paterno , up.perfil 
               FROM  usuario u, usuario_perfil up
               WHERE u.id_perfil=up.id_perfil and up.maneja_solicitudes = 1";
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
	
	
	$Etapa_fin = configuracion_cms('Etapa_fin');
  
	while (list($id_responsable,$nombre,$paterno, $perfil_user) = mysql_fetch_row($result)){
		
		    $query= "SELECT count(*)
                   FROM  sgs_solicitud_acceso 
                   WHERE id_responsable='$id_responsable' and id_sub_estado_solicitud not in ($Etapa_fin)";
           
			 $result2= cms_query($query)or die (error($query,mysql_error(),$php));
              list($tot_asigaciones) = mysql_fetch_row($result2);
			  
			  
		
		
		if ($id_responsable_seleccionado==$id_responsable){
			$seleccionado = "selected";
		}else{
			$seleccionado = "";
		}
		$estados .= "<option value=\"$id_responsable\" ".$seleccionado.">$nombre $paterno ($perfil_user), $tot_asigaciones solicitudes asignadas</option>";
		}
	
	$responsable = "<select name=\"id_responsable\" >
					".$estados."
				</select>";
	
	 $boton_cancelar = "<input type=\"button\" name=\"button\" id=\"button\" value=\"Cancelar\"  onclick=\"location.href('index.php?accion=$accion');\" />";
	
	 $onClick = "onclick=\"validaforma(document.form1);\"";
	 
	 
	 
 	  $fecha_termino = fechas_html($fecha_termino);
	  $fecha_inicio2 =  date(d)."-".date(m)."-".date(Y);
	  $dias = diferencia_entre_fechas($fecha_termino,$fecha_inicio2);
	
	 
	 
	 $plazo = $dias ." d&iacute;as";
	 $contenido = cms_replace("#PLAZO#",$plazo,$contenido);	
	 
	 $contenido = cms_replace("#ID_SOLICITUD#",$folio,$contenido);
	 $contenido = cms_replace("#FECHA_INGRESO#",$fecha_ingreso,$contenido);
	 $contenido = cms_replace("#SERVICIO#",$entidad_padre,$contenido);
	 $contenido = cms_replace("#RESPONSABLE#",$responsable,$contenido);
	 $contenido = cms_replace("#ENTIDAD#",$entidad,$contenido);
	 $contenido = cms_replace("#ESTADO_PADRE#",$estado_padre,$contenido); 
	 $contenido = cms_replace("#ESTADO#",$estado_solicitud,$contenido); 
	 $contenido = cms_replace("#SOLICITANTE#",$solicitante,$contenido);
	 $contenido = cms_replace("#IDENTIFICACION_DOCUMENTOS#",$identificacion_documentos,$contenido);
	 $contenido = cms_replace("#BOTON_CANCELAR#",$boton_cancelar,$contenido);
	 $contenido = cms_replace("#ONCLICK#",$onClick,$contenido);
	 
	/*************************************************/
	$contenido = cms_replace("#FECHA_INGRESO#","$fecha_ingreso",$contenido);
	$contenido = cms_replace("#FECHA_TERMINO#","$fecha_termino",$contenido);
	$contenido = cms_replace("#SERVICIO#",acentos($entidad_padre),$contenido);
	
	$apoderado = rescata_valor('usuario',$id_usuario,'apoderado') ;
	if(trim($apoderado)!=""){
	   	$apoderado ="<tr><td>Apoderado:</td><td colspan=\"5\"><strong>$apoderado </strong></td></tr>";
	}
	$contenido = cms_replace("#APODERADO#","$apoderado",$contenido);

	//$contenido = cms_replace("#ESTADO#","$estado_solicitud",$contenido);
	
	$entidad_hija = rescata_valor('sgs_entidades',$id_entidad,'entidad'); 
	$contenido = cms_replace("#ENTIDAD_HIJA#","",$contenido);
	$contenido = cms_replace("#ENTIDAD#",acentos($entidad_hija),$contenido);
					
	$contenido = cms_replace("#LINK_EDITAR#","$link_editar",$contenido);
	$contenido = cms_replace("#DIAS#","$dias",$contenido);
	$identificacion_documentos = acentos($identificacion_documentos);
	$contenido = cms_replace("#OBS#","$identificacion_documentos",$contenido);
	$contenido = cms_replace("#ACCION#","$accion",$contenido);
	$contenido = cms_replace("#LINK_PRINT#","$link_print",$contenido);
	if($notificacion==0)$notificacion="No";
	if($notificacion==1)$notificacion="Si";
	
	$contenido = cms_replace("#MEDIO_NOTIFICACION#","$notificacion",$contenido);
	
	$forma_recepcion = rescata_valor('sgs_forma_recepcion',$id_forma_recepcion,'forma_recepcion') ;
	$contenido = cms_replace("#FORMA_RECEPCION#","$forma_recepcion",$contenido);
	$estado_solicitud = rescata_valor('sgs_estado_solicitudes',$id_estado_solicitud,'estado_para_usuario') ;
	
	$formato_entrega = rescata_valor('sgs_formato_entrega',$id_formato_entrega,'formato_entrega') ;
	$contenido = cms_replace("#FORMA_ENTREGA#","$formato_entrega",$contenido);
	if($oficina!=""){
	
	
	$retiro_oficina ="   <tr >
    <td align=\"left\" ><strong>Retiro en Oficina</strong></td>
  </tr>
  <tr >
    <td align=\"left\" ><div align=\"left\" style=\"border: 1px solid #999999; background-color: #f8f8f8;padding: 5px; width:600px\"><strong>$oficina</strong></div></td>
  </tr>  ";
	}
	$contenido = cms_replace("#RETIRO_OFICINA#","$retiro_oficina",$contenido);
	
	
	
	 if($firmada==1){
	 $firmada = "si";
	 }else{
	 $firmada= "no";
	 }
	 
	 $firma = " <tr >
       <td align=\"left\" ><strong>Solicitud firmada </strong></td>
     </tr>
    <tr >
       <td align=\"left\" ><div align=\"left\" style=\"border: 1px solid #999999; background-color: #f8f8f8;padding: 5px; width:600px\"><strong>$firmada</strong></div></td>
     </tr>";
	 
	  $contenido = cms_replace("#FIRMADA#","$firma",$contenido);
	
	if($oficina!=""){
			$retiro_oficina = "  <tr>
						  <td>Oficina: </td>
						  <td colspan=\"2\"><b>$oficina</b></td>
						  <td colspan=\"2\">&nbsp;</td>
						  <td>&nbsp;</td>
						</tr>";

	}
	$contenido = cms_replace("#RETIRO_OFICINA#","$retiro_oficina",$contenido);
	
	
	$direccion = rescata_valor('usuario',$id_usuario,'direccion') ;
	$contenido = cms_replace("#DIRECCION#","$direccion",$contenido);
	
	$numero = rescata_valor('usuario',$id_usuario,'numero') ;
	$contenido = cms_replace("#NUMERO#","$numero",$contenido);
	
	$depto = rescata_valor('usuario',$id_usuario,'depto') ;
	$contenido = cms_replace("#DEPARTAMENTO#","$depto",$contenido);
	
	$ciudad = rescata_valor('usuario',$id_usuario,'ciudad') ;
	$contenido = cms_replace("#CIUDAD#","$ciudad",$contenido);
	
	$id_region = rescata_valor('usuario',$id_usuario,'id_region') ;
	$region = rescata_valor('regiones',$id_region,'region') ;
	$contenido = cms_replace("#REGION#","$region",$contenido);
	
	$correo_electronico = rescata_valor('usuario',$id_usuario,'email') ;
	$contenido = cms_replace("#CORREO_ELECTRONICO#",$correo_electronico,$contenido);
	
	$id_comuna = rescata_valor('usuario',$id_usuario,'id_comuna') ;
	$comuna = rescata_valor('comunas',$id_comuna,'comuna') ;
	$contenido = cms_replace("#COMUNA#","$comuna",$contenido);
	
	 /****************************************************/

	 
	 
	// $contenido = acentos($contenido);

	 $js .= "<script language=\"JavaScript\">
			function validaforma(theForm){
				if (theForm.id_responsable.value == \"0\"){
					alert(\"Debe Seleccionar al responsable.\");
					theForm.id_responsable.focus();
				}else{
					theForm.submit();
				}
				
			}
			</script>";
	$accion_form = "index.php?accion=$accion&act=2&folio=$folio";
	
	$template_historial = html_template('linea_estado_solicitud_user_registrado');				
	include("sgs/historial_estado/historial_estado.php");			
	$contenido = cms_replace("#VER_HISTORIAL#",$template_historial,$contenido);	
	
	
	
				
	

			
	
	
	


	
?>