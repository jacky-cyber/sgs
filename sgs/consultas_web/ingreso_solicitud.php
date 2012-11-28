<?php
 $sesion_conectado = session_id();
 $nom_session = "sess_capt_".$sesion_conectado;
 


	if(isset($_POST['correo_'.$sesion_conectado],$_POST['nombres'],$_POST['apellido_paterno'],$_POST['apellido_materno'],$_POST['identificacion_documentos'],$_POST['id_entidad']) and $_POST['texto_ingresado']==$_SESSION[$nom_session] and $_SERVER['HTTP_USER_AGENT'] !="" and  $_SERVER['HTTP_REFERER'] !="" ){

		// Datos solicitante
		$id_usuario = 0;
		$folio = 0;
		
		
			
		$_POST['nombre'] = $_POST['nombres'];
		$_POST['paterno'] = $_POST['apellido_paterno'];
		$_POST['materno'] = $_POST['apellido_materno'];
		$_POST['fono'] = $_POST['telefono'];
		$_POST['email'] = $_POST['correo_'.$sesion_conectado];
		$email_usuario = $_POST['email'];
		$_POST['login'] = $_POST['email'];
		$_POST['password'] = md5("123456");
		
		$query = "SELECT valor
					FROM cms_configuracion
					WHERE configuracion LIKE '%perfil_solicitante_no_registrado%'";
		$result= cms_query($query)or die (error($query,mysql_error(),$php));
		list($perfil_solicitante_no_registrado) = mysql_fetch_row($result);
		
		$_POST['id_perfil'] = $perfil_solicitante_no_registrado;
		$_POST['id_sexo'] = $_POST['id_sexo'];
		$_POST['id_formato_entrega'] = $_POST['id_formato_entrega'];
		$_POST['direccion'] = $_POST['direccion'];
		$_POST['numero'] = $_POST['numero'];
		$_POST['depto'] = $_POST['depto'];
		$_POST['id_nacionalidad'] = $_POST['id_nacionalidad'];
		$_POST['id_nivel_educacional'] = $_POST['id_nivel_educacional'];
		$_POST['id_rango_edad'] = $_POST['id_rango_edad'];
		$_POST['id_ocupacion'] = $_POST['id_ocupacion'];
		$_POST['id_organizacion'] = $_POST['id_organizacion'];
		$_POST['id_pais'] = $_POST['id_pais'];
		$_POST['id_region'] = $_POST['id_region'];
		$_POST['id_comuna'] = $_POST['id_comuna'];
		$_POST['id_frecuencia_organizacion'] = $_POST['id_frecuencia_organizacion'];
		$_POST['rut'] = str_replace(".","",$_POST['rut']);
		$_POST['rut'] = str_replace("-","",$_POST['rut']);
		$rut = $_POST['rut'];
		$_POST['login'] = md5($_POST['nombre'].$_POST['paterno'].date("Y-m-d H:i:s"));
		$login = $_POST['login'];
		
		$query= "SELECT id_usuario
			   FROM usuario
			   WHERE login LIKE '%$login%'";
		$result= cms_query($query)or die (error($query,mysql_error(),$php));
		if(!list($id_usuario) = mysql_fetch_row($result)){
			inserta("usuario");
			$id_usuario = mysql_insert_id();
		}
		else{
			$id_usuario = $id_usuario;
		}
		
		
		// Datos solicitud
		$query = "SELECT id_usuario FROM usuario WHERE login = '".$_POST['login']."'";
		$result = cms_query($query);
		list($id_usuario_papel) = mysql_fetch_row($result);
		
		$id_servicio = configuracion_cms('id_servicio');
		$_POST['id_entidad_padre']=  $id_servicio;
		$dias_de_plazo=  configuracion_cms('dias_de_plazo');
		$fecha_digitacion = date(d)."-".date(m)."-".date(Y);
		$_POST['fecha_digitacion'] = $fecha_digitacion;
		$_POST['fecha_inicio'] = $fecha_digitacion;
		$_POST['fecha_formulacion'] = $fecha_digitacion;
		
		$fecha_mas = sumaDiasHabiles(fechas_bd($_POST['fecha_inicio']),$dias_de_plazo);
		
		$_POST['fecha_termino']= fechas_html($fecha_mas);
		$_POST['id_usuario'] = $id_usuario_papel;
		$_POST['id_responzable']= "0";
		$_POST['id_estado_solicitud'] = "1"; //Estado Ingresada
		$_POST['id_sub_estado_solicitud'] = "2"; // sub estado no asignada
		$_POST['identificacion_documentos'] = $_POST['identificacion_documentos'];
		$_POST['identificacion_documentos'] = str_replace("'"," ",$_POST['identificacion_documentos']);
		$_POST['observacion_adicional'] = $_POST['observacion_adicional'];
		$_POST['observacion_adicional'] = str_replace("'"," ",$_POST['observacion_adicional']);
		$_POST['id_digitador'] = $id_usuario;
		
		$id_tipo_solicitud = $_POST['id_tipo_solicitud'];
		$codigo = rescata_valor('sgs_tipo_solicitud',$id_tipo_solicitud,'codigo');
		$_POST['folio']= genera_folio($_POST['id_entidad'],$codigo);
		
		$hash = $_POST['fecha_formulacion'].$_POST['folio'].$_POST['identificacion_documentos'];
		$_POST['hash'] = md5($hash);
		$_POST['id_tipo_solicitud'] = $id_tipo_solicitud;
		$_POST['id_forma_recepcion'] = $_POST['id_forma_recepcion'];
		$_POST['oficina'] = $_POST['oficina'];
		
		
		$estado_insert = inserta("sgs_solicitud_acceso");
		
		$folio = $_POST['folio'];
		
		
		// Si existe archivo
		if($_FILES["archivo_adjuntar"]){
			$existe_carpeta = is_dir("sgs/documentos_sistema/docs/$folio/");
			if(!$existe_carpeta){
				mkdir("sgs/documentos_sistema/docs/$folio/",0777);
				$path = "sgs/documentos_sistema/docs/$folio/";
			}
			else{
				$path = "sgs/documentos_sistema/docs/$folio/";
			}
			
			$name = $_FILES["archivo_adjuntar"]["name"];
			$size = $_FILES["archivo_adjuntar"]["size"];
			//$valid_formats = array("txt","gif","doc","xls","pdf","docx","jpeg","jpg");
			
			$formato_per=configuracion_cms("formato_permitido");	
			$valid_formats = explode(",",$formato_per);
			
			if(strlen($name)){
				list($txt, $ext) = explode(".", $name);
				if(in_array($ext,$valid_formats)){
				
									
					$qry_insert="INSERT INTO sgs_solicitudes_documentos (folio,archivo_solicitudes_doc,id_usuario,observacion_solicitudes_doc) VALUES ('$folio','$name',$id_usuario,'$name')";
					$result_insert=mysql_query($qry_insert) or die("$MSG_DIE - QR-Problemas al insertar $qry_insert");
					
					$query="SELECT MAX( id_solicitudes_doc) 
									FROM sgs_solicitudes_documentos WHERE folio='$folio'";
					$result_select= cms_query($query)or die (error($query,mysql_error(),$php));
					list($id_sol) = mysql_fetch_row($result_select);
					
					mkdir("sgs/documentos_sistema/docs/$folio/$id_sol/",0777);
					$path = "sgs/documentos_sistema/docs/$folio/$id_sol/";
					$tmp = $_FILES["archivo_adjuntar"]["tmp_name"];
					copy($tmp, $path.$name);
				}
			}
		}

			
		if($email_usuario != ""){
		
			//include("sgs/consultas_web/informacion_solicitud_pdf.php");
			
			$asunto = "Aviso de ingreso de solicitud";
			$cuerpo = "Gracias por ingresar solicitud:<br>
						FOLIO: $folio <br>";
			$destinatario = $email_usuario;
			$envio_stop = 1;
			cms_mail($destinatario,$asunto,$cuerpo,$headers,$envio_stop,$folio);
		}
		
		
		header("Location:index.php?accion=$accion&act=2&folio=$folio");

	}else{
		
		$contenido = html_template("faltan_datos");
	
	}
?>