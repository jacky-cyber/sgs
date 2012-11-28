<?php

	$ficha.= "<style>
		.cuadro_light {
			border: 1px solid #999999;
			background-color: #f8f8f8;
			-moz-border-radius:5px 5px 5px 5px;
			padding: 5px;
			width:580pt;
		}
		td{
			background: none repeat scroll 0 0 #FFF;
			font-family: Verdana;
			font-size: 9pt;
				
		}
		.alt {
			background: none repeat scroll 0 0 #EFEFEF;
			font-family: Verdana;
			font-size: 9pt;
			font-weight: bold;
			text-align: left;
		}
					
	</style>";


	

	$folio = $_GET["folio"];
	$ficha .= html_template('contenedor_detalle_solicitud_imprimir');	
	$id_usuario = id_usuario($id_sesion);
	$folio = $_GET['folio'];

		$query= "SELECT id_solicitud_acceso,folio,id_entidad,id_entidad_padre,identificacion_documentos,notificacion,id_forma_recepcion,oficina,id_formato_entrega,fecha_inicio,fecha_termino,orden,id_estado_solicitud,id_sub_estado_solicitud,id_responsable,fecha_formulacion,id_digitador,hash,observacion_adicional
				  FROM sgs_solicitud_acceso
				  WHERE folio ='$folio'";
		//and id_usuario=$id_usuario

		$result= cms_query($query)or die ("ERROR $php <br>$query.<br>".mysql_error());
		list($id_consulta,$folio_consulta,$id_entidad,$id_entidad_padre,$consulta,$notificacion,$id_forma_recepcion,$oficina,$id_formato_entrega,$fecha_inicio,$fecha_termino,$orden,$id_estado_solicitud,$id_sub_estado_solicitud,$id_responsable,$fecha_formulacion,$id_digitador,$hash,$observacion_adicional) = mysql_fetch_row($result);
		
		
		// si esta finalizada saco la ultima del historial, sino de la fecha de termino de la consulta
		
		$query= "SELECT id_estado_padre
					FROM sgs_estado_solicitudes
					WHERE id_estado_solicitud = '$id_estado_solicitud'";
		$result= cms_query($query)or die ("ERROR $php <br>$query.<br>".mysql_error());
		list($id_estado_padre) = mysql_fetch_row($result);
		
		//dias
		if ($id_estado_padre ==13){
		
			$query= "SELECT MAX(id_flujo_estados_solicitud)
						FROM sgs_flujo_estados_solicitud
						WHERE folio = '$folio'";
			$result= cms_query($query)or die ("ERROR $php <br>$query.<br>".mysql_error());
			list($id_estado_max) = mysql_fetch_row($result);
			$fecha_termino = rescata_valor('sgs_flujo_estados_solicitud',$id_estado_max,'fecha');
			$fecha_respuesta = $fecha_termino;
			$fecha_inicio = fechas_bd($fecha_inicio);
			$respondida_en = calculaDiasHabilesEntreFechas($fecha_inicio,$fecha_respuesta);

			if ($fecha_respuesta!=""){
				$dias = calculaDiasHabilesEntreFechas($fecha_inicio,$fecha_respuesta);
				$fecha_respuesta = fechas_html($fecha_respuesta);
				$fecha_termino = $fecha_respuesta;
				
				$glosa = "$estado_solicitud en ";
			}else{
				$glosa = "";
				$dias = "<span style=\"color:#Ff0000\">????</span>";
			}
		}else{
			$fecha_inicio = fechas_bd($fecha_inicio);
			$fecha_respuesta = fechas_bd($fecha_termino);
			$dias = calculaDiasHabilesEntreFechas($fecha_inicio,$fecha_respuesta);
			$glosa = "En";
		}
		
		if ($dias != "<span style=\"color:#Ff0000\">???</span>"){
			if (abs($dias) > 1)  {
				$dias = $glosa."&nbsp;".$dias."&nbsp; d&iacute;as";
			}else{
				$dias = $glosa."&nbsp;".$dias."&nbsp; d&iacute;a";
			}
		}
		
		if($observacion_adicional != ""){
			$contenedor_detalle_solicitud_imprimir_obs_adicional = html_template('contenedor_detalle_solicitud_imprimir_obs_adicional');
			$contenedor_detalle_solicitud_imprimir_obs_adicional = cms_replace("#OBSERVACIONES_ADICIONALES#","$observacion_adicional",$contenedor_detalle_solicitud_imprimir_obs_adicional);
			$ficha = cms_replace("#OBSERVACION_ADICIONAL#",$contenedor_detalle_solicitud_imprimir_obs_adicional,$ficha);
		}
		
		$ficha=cms_replace("#URL_SERVIDOR#",configuracion_cms('url_servidor'),$ficha);
		$ficha=cms_replace("#LOGO#","logo_gobierno_m.jpg",$ficha);
		
		$responsable = nombre_usuario($id_responsable);
		$fecha_inicio= fechas_html($fecha_inicio);
		$fecha_termino = fechas_html($fecha_termino);

		$fecha_inicio2 =  date(d)."-".date(m)."-".date(Y);
		$estado_solicitud = rescata_valor('sgs_estado_solicitudes',$id_estado_solicitud,'estado_para_usuario') ;
		$ficha = cms_replace("#FECHA_TERMINO#","$fecha_termino",$ficha);

		$entidad_hija = rescata_valor('sgs_entidades',$id_entidad,'entidad');
		$id_entidad_padre = rescata_valor('sgs_entidades',$id_entidad,'id_entidad_padre');
		$entidad_padre = rescata_valor('sgs_entidad_padre',$id_entidad_padre,'entidad_padre');

		$link_print = " href=\"?accion=solicitud-de-informacion&act=7&folio=$folio&axj=1\" ";
		
		$fecha_respuesta = fechas_html($fecha_respuesta);
		$ficha = cms_replace("#ESTADO#","$estado_solicitud",$ficha);						
		$ficha = cms_replace("#FECHA_INGRESO#","$fecha_inicio",$ficha);
		$ficha = cms_replace("#FECHA_RESPUESTA#","$fecha_respuesta",$ficha);
		$glosa_fecha = "";
		if ($fecha_respuesta!=""){
			$glosa_fecha = "Fecha de respuesta";
		}
		$ficha = cms_replace("#GLOSA_FECH_RESP#","$glosa_fecha",$ficha);
		
		$ficha = cms_replace("#SERVICIO#",acentos($entidad_padre),$ficha);
		//$ficha = cms_replace("#ESTADO#","$estado_solicitud",$ficha);
		
		$entidad_hija = rescata_valor('sgs_entidades',$id_entidad,'entidad'); 
		$ficha = cms_replace("#ENTIDAD_HIJA#","",$ficha);
		$ficha = cms_replace("#ENTIDAD#",acentos($entidad_hija),$ficha);
						
		$ficha = cms_replace("#LINK_EDITAR#","$link_editar",$ficha);
		$ficha = cms_replace("#DIAS#","$dias",$ficha);
		
		$consulta = acentos($consulta);
		$ficha = cms_replace("#OBS#","$consulta",$ficha);
		$ficha = cms_replace("#ACCION#","$accion",$ficha);
		$ficha = cms_replace("#LINK_PRINT#","$link_print",$ficha);
		if($notificacion==0)$notificacion="No";
		if($notificacion==1)$notificacion="Si";
		
		$ficha = cms_replace("#FOLIO#","$folio",$ficha);
		$ficha = cms_replace("#MEDIO_NOTIFICACION#","$notificacion",$ficha);
		
		$forma_recepcion = rescata_valor('sgs_forma_recepcion',$id_forma_recepcion,'forma_recepcion') ;
		$ficha = cms_replace("#FORMA_RECEPCION#","$forma_recepcion",$ficha);
		$estado_solicitud = rescata_valor('sgs_estado_solicitudes',$id_estado_solicitud,'estado_para_usuario') ;
		
		$formato_entrega = rescata_valor('sgs_formato_entrega',$id_formato_entrega,'formato_entrega') ;
		$ficha = cms_replace("#FORMA_ENTREGA#","$formato_entrega",$ficha);
		
		if($oficina!=""){
		
		
		$retiro_oficina ="  <tr>
							 <td><strong>Retiro en Oficina</strong></td>
							 <td colspan=\"3\">$oficina &nbsp;   </td>
						 </tr>";
		}
		$ficha = cms_replace("#RETIRO_OFICINA#","$retiro_oficina",$ficha);
						 
	$img ="<br><img src=\"code39/html/image.php?code=code128&o=1&t=30&r=1&text=$hash&f1=Arial.ttf&f2=8&a1=&a2=B&a3=\" alt=\"\" border=\"0\">";

	$ficha = cms_replace("#HASH#","$img",$ficha);

	$ficha.="<script>
		window.print();
	</script>";

	$contenido=$ficha;

?>