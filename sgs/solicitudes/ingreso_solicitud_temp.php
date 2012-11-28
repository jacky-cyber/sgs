<?php


			$_POST['id_entidad_padre']=  configuracion_cms('id_servicio');
			$_POST['id_entidad'] =  $_POST['id_entidad'];
			$dias_de_plazo=  configuracion_cms('dias_de_plazo');

			$_POST['fecha_inicio']= date(d)."-".date(m)."-".date(Y);
			$_POST['fecha_formulacion']= date(d)."-".date(m)."-".date(Y);
			/*
			$fecha_mas_20 = suma_fechas($_POST['fecha_inicio'],$dias_de_plazo);
			$fecha_mas = rectifica_fechas ($_POST['fecha_inicio'], $fecha_mas_20);
			*/
			$nombre = rescata_valor('usuario',$id_usuario,'nombre'); 
			$paterno = rescata_valor('usuario',$id_usuario,'paterno'); 
			$materno = rescata_valor('usuario',$id_usuario,'materno'); 
			$email = rescata_valor('usuario',$id_usuario,'email'); 
			
			$fecha_termino= sumaDiasHabiles(fechas_html($_POST['fecha_inicio']),$dias_de_plazo);
			$_POST['fecha_termino']= fechas_bd($fecha_termino);
			$_POST['fecha_digitacion']=$_POST['fecha_formulacion'];
			//echo $_POST['fecha_termino'];
			$_POST['id_usuario']=id_usuario($id_sesion);
			$_POST['id_responzable']="0";
			$_POST['id_estado_solicitud']="1"; //Estado Ingresada
			$_POST['id_sub_estado_solicitud']="1"; // sub estado no asignada
			//$_POST['identificacion_documentos'] = $_POST['identificacion_documentos'];
			//$_POST['identificacion_documentos'] = str_replace("\n","<br />",$_POST['identificacion_documentos']);
			//$_POST['identificacion_documentos'] = str_replace("'"," ",$_POST['identificacion_documentos']);
			$_POST['firmada'] =1;
			$_POST["id_tipo_consulta"] = $_POST["id_tipo_consulta"];
			$_POST["observacion_adicional"] = $_POST["observacion_adicional"];
			
			//echo "<br>id_formato_entrega: ". $_POST['id_formato_entrega']."<br>";
			
			
			$id_servicio = configuracion_cms('id_servicio');
			
			  $query= "SELECT max(id_solicitud_acceso)
                       FROM  sgs_solicitud_acceso_temp";
                 $result= cms_query($query)or die (error($query,mysql_error(),$php));
                  list($folio) = mysql_fetch_row($result);
				  $folio++;
				  
			$_POST['folio']= $folio;	
			
			$hash = $_POST['fecha_formulacion'].$_POST['folio'].$_POST['identificacion_documentos'];
			$_POST['hash']=md5($hash);
			
			$_POST['identificacion_documentos']= nl2br(trim($_POST['identificacion_documentos']));
			
			if($_POST['identificacion_documentos']!="" or $_POST['id_entidad_padre']=="" or $_POST['id_entidad']==""){
			
			$estado_insert=inserta("sgs_solicitud_acceso_temp");
			
			}else{
			//echo "r rr ".$_POST['identificacion_documentos'];
             header("Location:index.php?accion=$accion");
			}
			
			
			
			if($estado_insert!=""){
			
			
			$folio = $_POST['folio'];
			
 			  $Sql ="DELETE FROM sgs_solicitud_acceso_temp where id_usuario=$id_usuario and folio <>'$folio'";

 				cms_query($Sql)or die (error($Sql,mysql_error(),$php));
			
    	/*
			   $query= "SELECT id_solicitud_acceso,folio,id_entidad,id_entidad_padre,id_usuario,identificacion_documentos,notificacion,id_forma_recepcion,oficina,id_formato_entrega,fecha_inicio,fecha_termino,orden,id_estado_solicitud,id_sub_estado_solicitud,id_responsable,fecha_formulacion,id_digitador ,hash 
                        FROM  sgs_solicitud_acceso_temp 
                        WHERE  folio= '$folio'";
                
				  
				  $result= cms_query($query)or die (error($query,mysql_error(),$php));
                  if (list($id_solicitud_acceso,$folio,$id_entidad,$id_entidad_padre,$id_usuario,$identificacion_documentos,$notificacion,$id_forma_recepcion,$oficina,$id_formato_entrega,$fecha_ingreso,$fecha_termino,$orden,$id_estado_solicitud,$id_sub_estado_solicitud,$id_responsable,$fecha_formulacion,$id_digitador,$hash) = mysql_fetch_row($result)){
             	*/
				
				$tabla_leer = "sgs_solicitud_acceso_temp";
				$campo_busca= "folio";
				$id_campo_valor_buscar="$folio";
			
				$query  = "SELECT * 
						   FROM $tabla_leer
						   WHERE $campo_busca='$id_campo_valor_buscar'"; 
		   
				$result_q= cms_query($query)or die (error($query,mysql_error(),$php)); 
				$num_filas = mysql_num_fields($result_q); 
				
				if($num_filas){
				
				$resultado = mysql_fetch_row($result_q); 
				for ($i = 1; $i < $num_filas; $i++){ 
						$nom_campo = mysql_field_name($result_q,$i); 
						$valor = $resultado[$i]; 
						$$nom_campo = $valor; 
				}
				//echo $fecha_ingreso;
				
				$fecha = fechas_html($fecha_formulacion);
				$nombre =  nombre_usuario2($id_usuario);	
					
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
				$contenido = cms_replace("#OBSERVACIONES_ADICIONALES#","$observacion_adicional",$contenido);
				$contenido = cms_replace("#FECHA#","$fecha ",$contenido);	
				$contenido = cms_replace("#LINK_ACEPTAR# ","<input type=\"hidden\" name=\"folio_hidden\" value=\"$folio\">
				<input type=\"submit\" name=\"Aceptar\" id=\"Aceptar\" value=\"Enviar Solicitud\" />&nbsp;&nbsp;&nbsp;
				<input type=\"button\" name=\"Submit\" value=\"Volver\" onclick=\"history.back()\" >",$contenido);
								
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
						
						if($oficina!=""){
							$oficina =" <tr>
           								    <td><strong>Lugar de Retiro de La informaci&oacute;n</strong></td>
            								<td colspan=\"3\">$oficina</td>
    									</tr>";
						}
						 
						
						//echo "<br>forma_recepcion:".$forma_recepcion."<br>";
						$contenido = cms_replace("#FORMA_RECEPCION#","$forma_recepcion",$contenido);
						$contenido = cms_replace("#RETIRO_OFICINA#","$oficina",$contenido);
						
						$estado_solicitud = rescata_valor('sgs_estado_solicitudes',$id_estado_solicitud,'estado_para_usuario') ;
						
						//echo "<br>id_formato_entrega:".$id_formato_entrega."<br>";
						
						$formato_entrega = rescata_valor('sgs_formato_entrega',$id_formato_entrega,'formato_entrega') ;
						
						//echo "<br>formato_entrega:".$formato_entrega."<br>";
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
				
				if($axj==1){
				$html = html_template('html_vacio');	
				$link = " href=\"javascript:window.print();\" ";
				
				
				$html = cms_replace("#CONTENIDO#","$contenido",$html);	
				$contenido = cms_replace("#LINK#","$link",$html);	
				
				}
				$contenido = cms_replace("#LINK#","$link",$contenido);	
								   
             		 }else{
					// header("Location:index.php");
					 }

					 
					 
			
			
			
			
			}else{
			   $contenido = "Upss. <br> $estado_insert";
			}





			
			
?>