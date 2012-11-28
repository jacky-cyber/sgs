<?php

	
	$folio =  $_REQUEST['folio'];
	$contenido = "hola, el folio es ".$folio;
	 
	//sacar el html del contenido
	$contenido = html_template('contenedor_admin_solicitudes_ver');		
	
	$query= "SELECT id_solicitud_acceso,
					folio,
					a.id_entidad,
					a.id_entidad_padre,
					d.entidad_padre,
					a.id_usuario,
					identificacion_documentos,
					notificacion,
					id_forma_recepcion,
					oficina,
					id_formato_entrega,
					a.fecha_ingreso,
					fecha_termino,
					a.orden,
					a.id_estado_solicitud,
					b.estado_solicitud,
					id_sub_estado_solicitud,
					id_responsable,
                    ifnull(c.estado_solicitud,'') estado_padre,
                    CONCAT(f.nombre,' ', f.apellido,' ', f.materno) solicitante,
				    CONCAT(entidad,'(',g.sigla,')') entidad
			FROM  sgs_solicitud_acceso a, 
					sgs_estado_solicitudes b, 
					sgs_estado_solicitudes c,
					sgs_entidad_padre d,
                    usuario f, 
					sgs_entidades g
			
			WHERE a.id_estado_solicitud = b.id_estado_solicitud  ".$and."
			      and c.id_estado_solicitud = b.id_estado_padre
				  and a.id_entidad_padre = d.id_entidad_padre
				  and a.id_usuario = f.id_usuario
				  and a.id_entidad = g.id_entidad
				  
			ORDER BY fecha_inicio asc";
			
      $result= cms_query($query)or die (error($query,mysql_error(),$php));
	  
	 list($id_solicitud_acceso,$folio,$id_entidad,$id_entidad_padre,$entidad_padre,$id_usuario,$identificacion_documentos,$notificacion,$id_forma_recepcion,$oficina,$id_formato_entrega,$fecha_ingreso,$fecha_termino,$orden,$id_estado_solicitud,$estado_solicitud,$id_sub_estado_solicitud,$id_responsable,$estado_padre,$solicitante,$entidad) = mysql_fetch_row($result);
	 
	 
	 $fecha_ingreso = fechas_html($fecha_ingreso);
	
		
	 //llenar el combobox de responsables de entidad
	$query= "SELECT id_responsable,
					CONCAT(id_responsable,'-',a.id_usuario) clave,
				   a.id_usuario,
				   CONCAT(nombre,' ',apellido,' ',materno) nombre
			FROM sgs_responsable a,
				 usuario b
			WHERE id_entidad_padre = '".$id_entidad_padre."'
				  and id_entidad = '".$id_entidad."'
				  and a.id_usuario = b.id_usuario";
	$result= cms_query($query)or die (error($query,mysql_error(),$php));
	
	$id_responsable_seleccionado = $responsable;
	
	if ($id_responsable_seleccionado==0){
			$seleccionado = "selected";
	}else{
		$seleccionado = "";
	}
	  
	$estados = "<option value=\"?accion=$accion&id_estado_solicitud=\" ".$seleccionado.">Seleccione responsable..</option>";
	while (list($clave,$id_responsable,$nombre) = mysql_fetch_row($result)){
		if ($id_responsable_seleccionado==$id_responsable){
			$seleccionado = "selected";
		}else{
			$seleccionado = "";
		}
		$estados .= "<option value=\"?accion=$accion&clave=$clave\" ".$seleccionado.">".$nombre."</option>";
		}
	
	$responsable = "<select name=\"id_responsable\" >
					".$estados."
				</select>";
	
	$boton_cancelar = "<input type=\"button\" name=\"button\" id=\"button\" value=\"Cancelar\"  onclick=\"location.href('index.php?accion=$accion');\" />";
	
	 
	 
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

	 $js .= "<script language=\"JavaScript\">
			function validaforma(theForm){
				if (theForm.id_personal.value == \"\"){
					alert(\"Debe Seleccionar Personal.\");
					theForm.id_personal.focus();
					return false;
				}
			}
			</script>";
			
	$onsubmit = "onSubmit=\"return validaforma(this)\"";


	
?>