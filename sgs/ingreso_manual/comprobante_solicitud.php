<?php
$css .="<link href=\"images/sitio/sgs/css/base_print.css\" rel=\"stylesheet\" type=\"text/css\" />
";
$folio = $_GET['folio'];
    	
			   $query= "SELECT id_solicitud_acceso,folio,id_entidad,id_entidad_padre,id_usuario,identificacion_documentos,notificacion,id_forma_recepcion,oficina,id_formato_entrega,fecha_inicio,fecha_termino,orden,id_estado_solicitud,id_sub_estado_solicitud,id_responsable,fecha_formulacion,id_digitador,hash,observacion_adicional 
                        FROM  sgs_solicitud_acceso 
                        WHERE folio= '$folio'";
                  $result= cms_query($query)or die (error($query,mysql_error(),$php));
                  if (list($id_solicitud_acceso,$folio,$id_entidad,$id_entidad_padre,$id_usuario_s,$identificacion_documentos,$notificacion,$id_forma_recepcion,$oficina,$id_formato_entrega,$fecha_ingreso,$fecha_termino,$orden,$id_estado_solicitud,$id_sub_estado_solicitud,$id_responsable,$fecha_formulacion,$id_digitador,$hash,$observacion_adicional) = mysql_fetch_row($result)){
             		
					$identificacion_documentos = nl2br($identificacion_documentos);
					
					$fecha = fechas_html($fecha_ingreso);
					
					$nombre =  nombre_usuario2($id_usuario_s);	
					
					$entidad_padre = rescata_valor('sgs_entidad_padre',$id_entidad_padre,'entidad_padre'); 
					$entidad = rescata_valor('sgs_entidades',$id_entidad,'entidad'); 
					$entidad_padre= acentos($entidad_padre);
				$entidad= acentos($entidad);
				$contenido = html_template('comprobante_electronico_de_ingreso3');	
				
				$accion_form = "index.php";
				$boton_volver = "<input id=\"boton_volver\" name=\"boton_volver\" type=\"submit\" value=\"Aceptar\"/>";
				$contenido = cms_replace("#BOTON_VOLVER#","$boton_volver",$contenido);	
				 
     		  	$contenido = cms_replace("#USUARIO#","Estimado/a $nombre",$contenido);	
				$contenido = cms_replace("#FOLIO#","$folio",$contenido);	
				$contenido = cms_replace("#SERVICIO#","$entidad_padre",$contenido);	
				$contenido = cms_replace("#ENTIDAD#","$entidad",$contenido);	
				$contenido = cms_replace("#IDENTIFICACION_DOCUMENTOS#","$identificacion_documentos",$contenido);	
				$contenido = cms_replace("#FECHA#","$fecha",$contenido);	
				//$link = " href=\"#\" onclick=\"MM_openBrWindow('?accion=$accion&act=5&folio=$folio&axj=1','','scrollbars=yes,width=650,height=800')\" ";
				
				  
					    $contenido = cms_replace("#BOTON_TERMINAR#","",$contenido);
						$contenido = cms_replace("#SOLICITUD_ENVIADA#","",$contenido);
						$contenido = cms_replace("#LINK_EDITAR#","$link_editar",$contenido);
						$contenido = cms_replace("#DIAS#","$dias",$contenido);
						$contenido = cms_replace("#OBS#","$identificacion_documentos",$contenido);
						$contenido = cms_replace("#ACCION#","$accion",$contenido);
						$contenido = cms_replace("#LINK_PRINT#","$link_print",$contenido);
						if($observacion_adicional!=""){
						$tr_adicional=" <tr>
							            <td colspan=\"5\" class=\"alt\"><strong>Informaci&oacute;n adicional</strong></td>
							          </tr>
							          <tr>
							            <td colspan=\"5\" align=\"left\">$observacion_adicional</td>
							          </tr>";
						
						$contenido = cms_replace("#OBS_ADICIONAL#",$observacion_adicional,$contenido);
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
							$retiro_oficina ="  <tr>
												 <td><strong>Retiro en Oficina</strong></td>
												 <td colspan=\"3\">$oficina &nbsp;   </td>
											 </tr>";
						}
						$contenido = cms_replace("#RETIRO_OFICINA#","$retiro_oficina",$contenido);
						 	$img ="<img src=\"code39/html/image.php?code=code128&o=1&t=30&r=1&text=$hash&f1=Arial.ttf&f2=8&a1=&a2=B&a3=\" alt=\"\" border=\"0\">";

					$contenido = cms_replace("#IMG#","$img",$contenido);	
				$link = " href=\"javascript:window.print();\" ";
				if($axj==1){
				$html = html_template('html_vacio');	
				
				
				
				$html = cms_replace("#CONTENIDO#","$contenido",$html);	
				$contenido = cms_replace("#LINK#","$link",$html);	
				
				}
				$contenido = cms_replace("#LINK#","$link",$contenido);	
								   
             		 }else{
					 header("Location:index.php");
					 }


?>