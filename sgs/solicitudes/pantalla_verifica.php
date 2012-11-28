<?php
function crea_var_sess_post($variable){
session_register_cms($variable);
			$_SESSION[$variable]=$_POST[$variable];
			
return $_SESSION[$variable];
}
			$_POST['id_entidad_padre']=  configuracion_cms('id_servicio');
			$id_entidad_padre=crea_var_sess_post('id_entidad_padre');
	       	$id_entidad = crea_var_sess_post('id_entidad');
		    $id_forma_recepcion = crea_var_sess_post('id_forma_recepcion');
		    $id_formato_entrega = crea_var_sess_post('id_formato_entrega');
		    
			
			$dias_de_plazo=  configuracion_cms('dias_de_plazo');
			
			$_POST['fecha_inicio']= date(d)."-".date(m)."-".date(Y);
			$fecha_inicio=crea_var_sess_post('fecha_inicio');
			
			$_POST['fecha_formulacion']= date(d)."-".date(m)."-".date(Y);
			$fecha_formulacion=crea_var_sess_post('fecha_formulacion');
			/*
			$fecha_mas_20 = suma_fechas($_POST['fecha_inicio'],$dias_de_plazo);
			$fecha_mas = rectifica_fechas ($_POST['fecha_inicio'], $fecha_mas_20);
			*/
			$nombre = rescata_valor('usuario',$id_usuario,'nombre'); 
			$paterno = rescata_valor('usuario',$id_usuario,'paterno'); 
			$materno = rescata_valor('usuario',$id_usuario,'materno'); 
			$email = rescata_valor('usuario',$id_usuario,'email'); 
			
			$_POST['fecha_termino']= sumaDiasHabiles(fechas_html($_POST['fecha_inicio']),$dias_de_plazo);
			
			$_POST['fecha_termino']= fechas_bd($_POST['fecha_termino']);
			$fecha_termino= crea_var_sess_post('fecha_termino');
			$_POST['fecha_digitacion']=$_POST['fecha_formulacion'];
		
			$fecha_digitacion=crea_var_sess_post('fecha_digitacion');
			//echo $_POST['fecha_termino'];
			$_POST['id_usuario']=id_usuario($id_sesion);
			//crea_var_sess_post('id_usuario');
			$_POST['id_responzable']="0";
			$id_responzable=crea_var_sess_post('id_responzable');
			$_POST['id_estado_solicitud']="1"; //Estado Ingresada
			$id_estado_solicitud=crea_var_sess_post('id_estado_solicitud');
			$_POST['id_sub_estado_solicitud']="1"; // sub estado no asignada
			$id_sub_estado_solicitud=crea_var_sess_post('id_sub_estado_solicitud');
			$_POST['identificacion_documentos'] = htmlentities($_POST['identificacion_documentos']);
			$identificacion_documentos=crea_var_sess_post('identificacion_documentos');
			$identificacion_documentos= nl2br($identificacion_documentos);
			
			$id_servicio = configuracion_cms('id_servicio');
			$_POST['folio']= genera_folio($_POST['id_entidad'],'W');	
			//crea_var_sess_post('folio');
			$hash = $_POST['fecha_formulacion'].$_POST['folio'].$_POST['identificacion_documentos'];
			$_POST['hash']=md5($hash);
			
			

	
			
			    $fecha = fechas_html($fecha_ingreso);
				$nombre =  nombre_usuario($id_usuario);	
					
				$entidad_padre = rescata_valor('sgs_entidad_padre',$id_entidad_padre,'entidad_padre'); 
				$entidad = rescata_valor('sgs_entidades',$id_entidad,'entidad'); 
				$entidad_padre= acentos($entidad_padre);
				$entidad= acentos($entidad);
				$contenido = html_template('verificacion_electronico_de_ingreso');	
				 
     		  	$contenido = cms_replace("#USUARIO#","$nombre",$contenido);	
				$contenido = cms_replace("#FOLIO#","$folio",$contenido);	
				$contenido = cms_replace("#SERVICIO#","$entidad_padre",$contenido);	
				$contenido = cms_replace("#ENTIDAD#","$entidad",$contenido);	
				$contenido = cms_replace("#IDENTIFICACION_DOCUMENTOS#","$identificacion_documentos",$contenido);	
				$contenido = cms_replace("#FECHA#","$fecha_inicio",$contenido);	
				$link = " href=\"#\" onclick=\"MM_openBrWindow('?accion=$accion&act=5&folio=$folio&axj=1','','scrollbars=yes,width=650,height=800')\" ";
				
				
					$contenido = cms_replace("#LINK_EDITAR#","$link_editar",$contenido);
						$contenido = cms_replace("#DIAS#","$dias",$contenido);
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
						$contenido = cms_replace("#LINK_ACEPTAR# ","<input type=\"hidden\" name=\"folio_hidden\" value=\"$folio\"><input type=\"submit\" name=\"Aceptar\" id=\"Aceptar\" value=\"Verificar Esta Informaci&oacute;n\" />",$contenido);
						
						if($oficina!=""){
						
						
						$retiro_oficina ="  <tr>
           									 <td><strong>Retiro en Oficina</strong></td>
            								 <td colspan=\"3\">$oficina &nbsp;   </td>
       									 </tr>";
						}
						$contenido = cms_replace("#RETIRO_OFICINA#","$retiro_oficina",$contenido);
						 	//$img ="<img src=\"code39/html/image.php?code=code128&o=1&t=30&r=1&text=$hash&f1=Arial.ttf&f2=8&a1=&a2=B&a3=\" alt=\"\" border=\"0\">";

					$contenido = cms_replace("#IMG#","$img",$contenido);	
				
			
				$contenido = cms_replace("#LINK#","$link",$contenido);	
								   
			$accion_form = "index.php?accion=$accion&act=6";
			
			
			
			
			
			
			//$estado_insert=inserta("sgs_solicitud_acceso");
			
			
			/*
			if($estado_insert=="ok"){
			$folio = $_POST['folio'];
			 header("Location:index.php?accion=$accion&act=5&folio=$folio");
			}else{
			   $contenido = "Upss. <br> $estado_insert";
			}*/
			
?>