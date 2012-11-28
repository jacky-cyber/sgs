<?php




$folio_hidden = $_POST['folio_hidden'];


/*CAPTURAMOS TODOS LOS CAMPOS DE LA TABLA */
$tabla_leer = "sgs_solicitud_acceso_temp";
$campo_busca= "folio";
$id_campo_valor_buscar="$folio_hidden";

$query  = "SELECT * 
		   FROM $tabla_leer
		   WHERE $campo_busca='$id_campo_valor_buscar'"; 
		   
$result_q= cms_query($query)or die (error($query,mysql_error(),$php)); 
$num_filas = mysql_num_fields($result_q); 
$resultado = mysql_fetch_row($result_q); 
for ($i = 1; $i < $num_filas; $i++){ 
		$nom_campo = mysql_field_name($result_q,$i); 
		$valor = $resultado[$i]; 
		$$nom_campo = $valor; 
}

		    $id_usuario     = id_usuario($id_sesion);
		
			$_POST['id_entidad_padre']=  configuracion_cms('id_servicio');
			$_POST['id_entidad']=  $id_entidad;
			$dias_de_plazo=  configuracion_cms('dias_de_plazo');

			$_POST['fecha_inicio']= fechas_html($fecha_inicio);
			$_POST['fecha_formulacion']= date(d)."-".date(m)."-".date(Y);
			/*
			$fecha_mas_20 = suma_fechas($_POST['fecha_inicio'],$dias_de_plazo);
			$fecha_mas = rectifica_fechas ($_POST['fecha_inicio'], $fecha_mas_20);
			*/
			$nombre = rescata_valor('usuario',$id_usuario,'nombre'); 
			$paterno = rescata_valor('usuario',$id_usuario,'paterno'); 
			$materno = rescata_valor('usuario',$id_usuario,'materno'); 
			$email = rescata_valor('usuario',$id_usuario,'email'); 
			
			$_POST['fecha_termino']= fechas_html($fecha_termino);
			
			$_POST['fecha_digitacion']=date(d)."-".date(m)."-".date(Y);
			//echo $_POST['fecha_termino'];
			$_POST['id_usuario']=id_usuario($id_sesion);
			$_POST['id_responzable']="0";
			$_POST['id_estado_solicitud']="1"; //Estado Ingresada
			$_POST['id_sub_estado_solicitud']="2"; // sub estado no asignada
			$_POST['identificacion_documentos'] = $identificacion_documentos;
			$_POST['id_servicio'] = configuracion_cms('id_servicio');
			$_POST['folio'] = strtoupper(genera_folio($id_entidad,'W'));	
			//$folio = $_POST['folio'];
			$estado_solicitud = $_POST['id_estado_solicitud'];
			
			$_POST['id_forma_recepcion']= $id_forma_recepcion;	
			$_POST['oficina']= $oficina;	
			$_POST['id_formato_entrega']= $id_formato_entrega;	
			$_POST['notificacion']= $notificacion;	
			$_POST['firmada']= $firmada;	
			
			if($_POST['id_tipo_solicitud']==""){
			$_POST['id_tipo_solicitud']= 1;	
			}
			
			
			/*
			$query = "SELECT email
						FROM usuario
						WHERE id_usuario = '$id_usuario'";
			$result= cms_query($query)or die (error($query,mysql_error(),$php));
			if(list($email_usuario) = mysql_fetch_row($result)){
				
				
				include("sgs/solicitudes/informacion_solicitud_pdf.php");
				$asunto = "Aviso de ingreso de solicitud";
				$cuerpo = "Gracias por ingresar solicitud:<br>
							FOLIO: $folio <br>";
				$destinatario = $email_usuario;
				$envio_stop = 1;
				cms_mail($destinatario,$asunto,$cuerpo,$headers,$envio_stop,$folio);
			}
			*/
			
			
			$hash = $fecha_formulacion.$folio.$identificacion_documentos;
			$_POST['hash']=md5($hash);
			
			$_POST['identificacion_documentos']= trim($_POST['identificacion_documentos']);
			
			$_POST['observacion_adicional']= $observacion_adicional;
			
			if($_POST['identificacion_documentos']!=""){
			
			$estado_insert=inserta("sgs_solicitud_acceso");
			}else{
			
            header("Location:index.php?accion=$accion");
			}
			
			
			$Sql ="DELETE FROM sgs_solicitud_acceso_temp where folio= '$folio'";
 			cms_query($Sql)or die (error($Sql,mysql_error(),$php));
			  
			/*  
			if(configuracion_cms('aviso_solicitud_ingresada')){
				//envia_mail_asignador($_POST['folio']);	
				Insertar_historial($_POST['folio'],$_POST['id_sub_estado_solicitud'],$observacion);	  
			}
			*/
			
			if($estado_insert!=""){
			$folio = $_POST['folio'];
			
				$observacion = "Ingreso de solicitud";
				Insertar_historial($folio,$estado_solicitud,$observacion);

				 // $Sql ="DELETE FROM sgs_solicitud_acceso ";
				  // cms_query($Sql)or die (error($Sql,mysql_error(),$php));
				 // $observacion = html_template('subjet_ingreso_solicitud');
				 
				$query = "SELECT email,nombre,paterno
				FROM usuario
				WHERE id_usuario = '$id_usuario'";
				$result= cms_query($query)or die (error($query,mysql_error(),$php));
				if(list($email_usuario,$nombre,$paterno) = mysql_fetch_row($result)){
						
					
					/*
					 include("sgs/consultas_web/informacion_solicitud_pdf.php");
					*/
					/*
						* Select tabla deuman_mails_alerta_perfil
						* 
						*/
					       $query= "SELECT subjet,cuerpo  
							  FROM  deuman_mails_alerta_perfil
							  WHERE id_mails_alerta_perfil = '8'";
						    $result_deuman_mails_alerta_perfil= cms_query($query)or die (error($query,mysql_error(),$php));
						     list($subjet,$cuerpo) = mysql_fetch_row($result_deuman_mails_alerta_perfil);
					      
					       /** fin select deuman_mails_alerta_perfil***/
						$consulta = $_POST['identificacion_documentos'];
						$consulta = utf8_decode($consulta);
						$cuerpo = str_replace("#NOMBRE_CIUDADANO#","$nombre $paterno",$cuerpo);	
						$cuerpo = str_replace("#FOLIO#","$folio",$cuerpo);	
						$cuerpo = str_replace("#CONSULTA#","$consulta",$cuerpo);	
					
					$destinatario = $email_usuario;
					
					cms_mail($destinatario,$subjet,$cuerpo,$headers,$envio_stop,$folio);
				}
				
				
			  
		     header("Location:index.php?accion=$accion&act=5&folio=$folio");
			}else{
			   $contenido = "Upss. <br> $estado_insert";
			}
			
			
?>