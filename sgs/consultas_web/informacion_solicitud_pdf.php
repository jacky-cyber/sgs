<?php

		
		ini_set("memory_limit","20M");
		ini_set('default_charset','utf-8');
    	
		$query= "SELECT id_solicitud_acceso,folio,id_entidad,id_usuario,identificacion_documentos,notificacion,id_forma_recepcion,id_formato_entrega,fecha_inicio,fecha_termino,orden,id_estado_solicitud,hash,id_tipo_solicitud
                        FROM sgs_solicitud_acceso
                        WHERE folio LIKE '%$folio%'";
		
		
		
		$result= cms_query($query)or die (error($query,mysql_error(),$php));
        if (list($id_solicitud_acceso,$folio,$id_entidad,$id_usuario,$consulta,$notificacion,$id_forma_recepcion,$id_formato_entrega,$fecha_ingreso,$fecha_termino,$orden,$id_estado_solicitud,$hash,$id_tipo_solicitud) = mysql_fetch_row($result)){
				
				
				
				$fecha = fechas_html($fecha_ingreso);
				
				//$nombre =  nombre_usuario2($id_usuario);	
				//$entidad_padre = rescata_valor('sgs_entidad_padre',$id_entidad_padre,'entidad_padre'); 
				//$entidad_padre= acentos($entidad_padre);
				//$entidad= acentos($entidad);
				
				$comprobante = html_template('comprobante_user_no_registrado_print');
     		  	//$comprobante = cms_replace("#USUARIO#","$nombre",$comprobante);	
				$comprobante = cms_replace("#FOLIO#","$folio",$comprobante);	
				$id_servicio = configuracion_cms('id_servicio');
				$entidad = rescata_valor('sgs_entidades',$id_entidad,'entidad');
				$entidad = utf8_decode($entidad);
				$servicio = rescata_valor('sgs_entidad_padre',$id_servicio,'entidad_padre'); 
				$comprobante = cms_replace("#SERVICIO#","$servicio",$comprobante);	
				$comprobante = cms_replace("#ENTIDAD#","$entidad",$comprobante);	
				//$comprobante = cms_replace("#IDENTIFICACION_DOCUMENTOS#","$consulta",$comprobante);	
				$comprobante = cms_replace("#FECHA#","$fecha",$comprobante);	
				//$link = " href=\"#\" onclick=\"MM_openBrWindow('?accion=$accion&act=5&folio=$folio&axj=1','','scrollbars=yes,width=650,height=800')\" ";
				
				//$link = " href=\"?accion=$accion&act=7&folio=$folio&axj=1\" class=\"comprobante\" ";
				
				//$comprobante = cms_replace("#LINK_EDITAR#","$link_editar",$comprobante);
				//$comprobante = cms_replace("#DIAS#","$dias",$comprobante);
				//$observacion .=htmlspecialchars_decode("<p ID=\"comprobante\">".$consulta."</p>",ENT_QUOTES);
				$observacion =htmlspecialchars_decode($consulta,ENT_QUOTES);
				$comprobante = cms_replace("#OBS#","$observacion",$comprobante);
				//$comprobante = cms_replace("#ACCION#","$accion",$comprobante);
				//$comprobante = cms_replace("#LINK_PRINT#","$link_print",$comprobante);
				//if($notificacion==0)$notificacion="No";
				//if($notificacion==1)$notificacion="Si";
				
				//$comprobante = cms_replace("#MEDIO_NOTIFICACION#","$notificacion",$comprobante);
				
				//$forma_recepcion = rescata_valor('sgs_forma_recepcion',$id_forma_recepcion,'forma_recepcion') ;
				//$comprobante = cms_replace("#FORMA_RECEPCION#","$forma_recepcion",$comprobante);
				$estado_solicitud = rescata_valor('sgs_estado_solicitudes',$id_estado_solicitud,'estado_para_usuario') ;
				
				$formato_entrega = rescata_valor('sgs_formato_entrega',$id_formato_entrega,'formato_entrega') ;
				$comprobante = cms_replace("#FORMA_ENTREGA#","$formato_entrega",$comprobante);
				
				$tipo_solicitud = rescata_valor('sgs_tipo_solicitud',$id_tipo_solicitud,'tipo_solicitud');
				$comprobante = cms_replace("#TIPO_SOLICITUD#","$tipo_solicitud",$comprobante);
				

				$img ="<img src=\"http://#URL_SERVIDOR#/code39/html/image.php?code=code128&o=1&t=30&r=1&text=$hash&f1=Arial.ttf&f2=14&a1=&a2=B&a3=\" alt=\"\" border=\"0\">";
				$comprobante = cms_replace("#IMG#","$img",$comprobante);
				$comprobante = cms_replace("#URL_SERVIDOR#",configuracion_cms('url'),$comprobante);
				
				$newString = str_replace("&nbsp;"," ",$comprobante);
				$newString = str_replace("&ntilde;","ñ",$newString);
				$newString = str_replace("&Ntilde;","Ñ",$newString);
				$newString = str_replace("&aacute;","á",$newString);
				$newString = str_replace("&eacute;","é",$newString);
				$newString = str_replace("&iacute;","í",$newString);
				$newString = str_replace("&oacute;","ó",$newString);
				$newString = str_replace("&uacute;","ú",$newString);
				$newString = str_replace("&Aacute;","Á",$newString);
				$newString = str_replace("&Eacute;","É",$newString);
				$newString = str_replace("&Iacute;","Í",$newString);
				$newString = str_replace("&Oacute;","Ó",$newString);
				$newString = str_replace("&Uacute;","Ú",$newString);
				$newString = str_replace("&ordm;","º",$newString);
				$newString = str_replace("&ldquo;","“",$newString);
				$newString = str_replace("&rdquo;","”",$newString);

								   
        }

		$existe_carpeta = is_dir("sgs/documentos_sistema/docs/$folio/");
		if(!$existe_carpeta){
			mkdir("sgs/documentos_sistema/docs/$folio/",0777);
			$carpeta = "sgs/documentos_sistema/docs/$folio/";
		}else{
			$carpeta = "sgs/documentos_sistema/docs/$folio/";
		}
		$archivo = "solicitud_$folio.pdf";
		
		require_once("deuman/dompdf2/dompdf_config.inc.php");
		$dompdf = new DOMPDF();
		$dompdf->load_html($comprobante);
		$dompdf->render();
		
		$contenidox = $dompdf->output();
		
		file_put_contents($carpeta."$archivo", $contenidox);
		
		
		

?>