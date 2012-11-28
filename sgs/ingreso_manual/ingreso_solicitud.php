<?php

if( $_POST['tipo_folio']=="P"  and  verifica_folio($_POST['folio'])=="ok" ){
				
		
			
			$_POST['login']=md5($_POST['email'].date("Y-m-d H:i:s").rand(1,50));
			//$_POST['fecha_crea']= date(d)."-".date(m)."-".date(Y);
			$id_auto_admin= id_tabla('usuario');
			//$id_auto_admin="usuario";
			$_GET['id_auto_admin']=$id_auto_admin;
			$password=$_POST['pass'];
			$_POST['pass']=md5($_POST['pass']);
			$_POST['password']=$_POST['pass'];
			$_POST['establecimiento']=11;
			$_POST['estado']=0;
			
			$_POST['id_perfil']=2;//2 usuario perfil papel
			$_POST['session']="xx".$id_sesion;
			
			
			$_POST['fecha_crea '] = date(Y)."-".date(m)."-".date(d);
			//echo $query_vta;
			inserta('usuario');
			
			$query = "select id_usuario from usuario where login = '".$_POST['login']."'";
			
			$result = cms_query($query);
			list($id_usuario_carta) = mysql_fetch_row($result);

			//include ("sgs/ingreso_manual/ingreso_solicitud.php");		 
				
				
			$_POST['id_entidad_padre']=  configuracion_cms('id_servicio');
			$dias_de_plazo=  configuracion_cms('dias_de_plazo');

			//$_POST['fecha_formulacion']= date(d)."-".date(m)."-".date(Y);
			//$fecha_formulacion = 
			
			$fecha_digitacion = date(d)."-".date(m)."-".date(Y);
			$_POST['fecha_digitacion'] = $fecha_digitacion;
			
			$_POST['fecha_inicio'] = $_POST['fecha_ingreso'];
			$_POST['fecha_formulacion'] = $_POST['fecha_ingreso'];
			
			if($_POST['direccion'] == "" &&  $_POST['email'] == ""){
				$_POST['id_estado_solicitud'] = configuracion_cms('en_proceso');
				$_POST['id_sub_estado_solicitud'] = configuracion_cms('estado_pendiente_rectificacion');
				$dias_de_plazo = configuracion_cms('dias_de_plazo_recitificacion');
			}else{
				$_POST['id_estado_solicitud'] = "1"; //Estado Ingresada
				$_POST['id_sub_estado_solicitud']="2"; // sub estado no asignada
			}

			$fecha_mas = sumaDiasHabiles(fechas_html($_POST['fecha_inicio']),$dias_de_plazo);
			//echo "<br>fecha_inicio:".fechas_bd($_POST['fecha_inicio']);
			//echo "<br>fecha mas 20:".$fecha_mas;
			//$fecha_mas = rectifica_fechas ($_POST['fecha_inicio'], $fecha_mas_20);
			//$fecha_mas =sumaDiasHabiles(fechas_bd($_POST['fecha_inicio']),$dias_de_plazo);
			
			
			$_POST['fecha_termino']= fechas_bd($fecha_mas);
			$_POST['id_usuario'] = $id_usuario_carta;//variable nuevo id usuario, cambiar esto
			$_POST['id_responzable']="0";

			
			//$_POST['identificacion_documentos'] = $_POST['identificacion_documentos'];
			//$_POST['identificacion_documentos'] = str_replace("'"," ",$_POST['identificacion_documentos']);
			$_POST['identificacion_documentos'] = nl2br($_POST['identificacion_documentos']);
			$id_servicio = configuracion_cms('id_servicio');
			
			$_POST['id_digitador'] = id_usuario($id_sesion);
			
			if($_POST['tipo_folio']!="P"){
			$_POST['folio']= genera_folio($_POST['id_entidad'],$_POST['tipo_folio']);	
			}
			$_POST['folio']= strtoupper($_POST['folio']);
			
			
			$_POST['observacion_adicional'] = $_POST['observaciones_adicionales'];
			$folio = $_POST['folio'];
			
				$hash = $_POST['fecha_formulacion'].$_POST['folio'].$_POST['identificacion_documentos'];
			$_POST['hash']=md5($hash);
			//$_POST['firmado']=md5($hash);
			
			/** Select tabla sgs_tipo_solicitud
			* 
			*/
			$tipo_sol = $_POST['tipo_folio'];
			
			$query= "SELECT  id_tipo_solicitud 
				 FROM  sgs_tipo_solicitud
				 WHERE codigo = '$tipo_sol'";
			$result_sgs_tipo_solicitud= cms_query($query)or die (error($query,mysql_error(),$php));
			if(list($id_tipo_solicitud) = mysql_fetch_row($result_sgs_tipo_solicitud)){
						
			$_POST['id_tipo_solicitud']=$id_tipo_solicitud;			
			}else{
						
			$_POST['id_tipo_solicitud']=1;			
			}
			
/** fin select sgs_tipo_solicitud***/
			
		
			$estado_insert=inserta("sgs_solicitud_acceso");
			
			// Si existen archivos
			for($j=1; $j<4; $j++){
				if($_FILES["archivo_$j"]){
					$existe_carpeta = is_dir("sgs/documentos_sistema/docs/$folio/");
					if(!$existe_carpeta){
						mkdir("sgs/documentos_sistema/docs/$folio/",0777);
						$path = "sgs/documentos_sistema/docs/$folio/";
					}
					else{
						$path = "sgs/documentos_sistema/docs/$folio/";
					}
					
					$name = $_FILES["archivo_$j"]["name"];
					$size = $_FILES["archivo_$j"]["size"];
					$valid_formats = array("txt","gif","doc","xls","pdf","docx","jpeg","jpg");
					
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
							$tmp = $_FILES["archivo_$j"]["tmp_name"];
							copy($tmp, $path.$name);
						}
					}
				}
			}

		
			
			switch ($_POST['tipo_folio']) {
                 case 'C':
                     $tipo_sol= "Carta";
                     break;
            	  case 'P':
                     $tipo_sol= "Formulario en Papel";
                     break;
            	  case 'D':
                     $tipo_sol= "Derivaci&oacute;n";
					 
                     break;
            	
               	default:
                    
             }
			
			
			$observacion="Ingreso Manual de solicitud tipo $tipo_sol";
				
			Insertar_historial($folio,1,$observacion);
			
			if($estado_insert!=""){
			$folio = $_POST['folio'];
			//RR
			header("Location:index.php?accion=$accion&act=5&folio=$folio");
			}else{
			   $contenido = "Upss. <br> $estado_insert";
			}
				
				
}elseif( ( $_POST['tipo_folio']=="C" ) or ( $_POST['tipo_folio']=="D" ) ){
			
			
			$_POST['login']=md5($_POST['email'].date("Y-m-d H:i:s").rand(1,50));
			//$_POST['fecha_crea']= date(d)."-".date(m)."-".date(Y);
			$id_auto_admin= id_tabla('usuario');
			//$id_auto_admin="usuario";
			$_GET['id_auto_admin']=$id_auto_admin;
			$password=$_POST['pass'];
			$_POST['pass']=md5($_POST['pass']);
			$_POST['password']=$_POST['pass'];
			$_POST['establecimiento']=11;
			$_POST['estado']=0;
			
			$_POST['id_perfil']=2;//2 usuario perfil papel
			$_POST['session']="xx".$id_sesion;
			
			//echo "dfgdfgddddddddddddd. linea 144 ingreso_solicitud.php<br>\n";
			inserta('usuario');
			//echo "dsfsdfftttttttt. linea 146 ingreso_solicitud.php<br>\n";
			
			$query = "select id_usuario from usuario where login = '".$_POST['login']."'";
//			echo $query." 2<br>";
			
			$result = cms_query($query);
			list($id_usuario_papel) = mysql_fetch_row($result);

				
			$_POST['id_entidad_padre']=  configuracion_cms('id_servicio');
			$dias_de_plazo=  configuracion_cms('dias_de_plazo');

			//$_POST['fecha_formulacion']= date(d)."-".date(m)."-".date(Y);
			//$fecha_formulacion = 
			
			$fecha_digitacion = date(d)."-".date(m)."-".date(Y);
			$_POST['fecha_digitacion'] = $fecha_digitacion;
			
			$_POST['fecha_inicio'] = $_POST['fecha_ingreso'];
			$_POST['fecha_formulacion'] = $_POST['fecha_ingreso'];
			
			$fecha_mas = sumaDiasHabiles(fechas_html($_POST['fecha_inicio']),$dias_de_plazo);
			
			
			$_POST['fecha_termino']= fechas_html($fecha_mas);
			$_POST['id_usuario'] = $id_usuario_papel;//variable nuevo id usuario, cambiar esto
			$_POST['id_responzable']="0";
			
			
			if($_POST['tipo_folio']=="D"){
				$_POST['tipo_folio'] = "C";
				$_POST['folio_origen']= $_POST['folio'];	
			}
			
			//echo "direccion--".$_POST['direccion']."<br>";
			//echo "email--".$_POST['email']."<br>";
			
			if($_POST['tipo_folio']=="C"){
				if($_POST['direccion'] == "" && $_POST['email'] == ""){
				
					//echo "entra 1";
					/*$_POST['id_estado_solicitud'] = 3;
					$_POST['id_sub_estado_solicitud'] = 5;
					$dias_de_plazo = 6;*/
					$_POST['id_estado_solicitud'] = configuracion_cms('en_proceso');
			                $_POST['id_sub_estado_solicitud'] = configuracion_cms('estado_pendiente_rectificacion');
			                $dias_de_plazo = configuracion_cms('dias_de_plazo_recitificacion');
					
				}else{
				
					//echo "entra 2";
				
					$_POST['id_estado_solicitud'] = "1"; //Estado Ingresada
					$_POST['id_sub_estado_solicitud']="2"; // sub estado no asignadaº
					
				}
			}else{
			
				//echo "entra 3";
			
				$_POST['id_estado_solicitud'] = "1"; //Estado Ingresada
				$_POST['id_sub_estado_solicitud']="2"; // sub estado no asignada
			}			
			
			
			$fecha_mas = sumaDiasHabiles(fechas_bd($_POST['fecha_inicio']),$dias_de_plazo);
			
			//echo "<br>fecha_inicio:".fechas_bd($_POST['fecha_inicio']);
			//echo "<br>fecha mas 20:".$fecha_mas;
			//$fecha_mas = rectifica_fechas ($_POST['fecha_inicio'], $fecha_mas_20);
			//$fecha_mas =sumaDiasHabiles(fechas_bd($_POST['fecha_inicio']),$dias_de_plazo);
			
			
			
			
			
			
			$_POST['identificacion_documentos'] = $_POST['identificacion_documentos'];
			$_POST['identificacion_documentos'] = str_replace("'"," ",$_POST['identificacion_documentos']);
			$id_servicio = configuracion_cms('id_servicio');
			$_POST['id_digitador'] = id_usuario($id_sesion);
			
			if($_POST['tipo_folio']=="C"){
			  $_POST['folio']= genera_folio($_POST['id_entidad'],$_POST['tipo_folio']);	
			}
			
			$_POST['observacion_adicional'] = $_POST['observaciones_adicionales'];
			$folio = $_POST['folio'];
			
			$_POST['url_documento_origen']  = $_POST['url_1'];
			$_POST['observacion_origen'] = $_POST['observacion'];
			$_POST['otra_entidad_origen'] = cms_replace("#COMIDIN#","",$_POST['entidad_origen']);

			$id_usuario = id_usuario($id_sesion);
			$_POST['folio']= strtoupper($_POST['folio']);
			$hash = $_POST['fecha_formulacion'].$_POST['folio'].$_POST['identificacion_documentos'];
			$_POST['hash']=md5($hash);
			
			$tipo_sol = $_POST['tipo_folio'];
			
			$query= "SELECT  id_tipo_solicitud 
				 FROM  sgs_tipo_solicitud
				 WHERE codigo = '$tipo_sol'";
			$result_sgs_tipo_solicitud= cms_query($query)or die (error($query,mysql_error(),$php));
			if(list($id_tipo_solicitud) = mysql_fetch_row($result_sgs_tipo_solicitud)){
						
			$_POST['id_tipo_solicitud']=$id_tipo_solicitud;			
			}else{
						
			$_POST['id_tipo_solicitud']=1;			
			}			
			
			/*
			echo $_POST['id_estado_solicitud']."<br>";
			echo $_POST['id_sub_estado_solicitud']."<br>";*/
			
			$estado_insert = inserta("sgs_solicitud_acceso");
			
			// Si existen archivos
			for($j=1; $j<4; $j++){
				if($_FILES["archivo_$j"]){
					$existe_carpeta = is_dir("sgs/documentos_sistema/docs/$folio/");
					if(!$existe_carpeta){
						mkdir("sgs/documentos_sistema/docs/$folio/",0777);
						$path = "sgs/documentos_sistema/docs/$folio/";
					}
					else{
						$path = "sgs/documentos_sistema/docs/$folio/";
					}
					
					$name = $_FILES["archivo_$j"]["name"];
					$size = $_FILES["archivo_$j"]["size"];
					$valid_formats = array("txt","gif","doc","xls","pdf","docx","jpeg","jpg");
					
					if(strlen($name)){
						list($txt, $ext) = explode(".", $name);
						if(in_array($ext,$valid_formats)){
								
							$qry_insert="INSERT INTO sgs_solicitudes_documentos (folio,archivo_solicitudes_doc,id_usuario,observacion_solicitudes_doc) VALUES ('$folio','$name',$id_usuario,'$name')";
							$result_insert=mysql_query($qry_insert) or die("$MSG_DIE - QR-Problemas al insertar $qry_insert");
							
							
							$query="SELECT MAX(id_solicitudes_doc) 
								FROM sgs_solicitudes_documentos WHERE folio='$folio'";
							$result_select= cms_query($query)or die (error($query,mysql_error(),$php));
							list($id_sol) = mysql_fetch_row($result_select);
							
							mkdir("sgs/documentos_sistema/docs/$folio/$id_sol/",0777);
							$path = "sgs/documentos_sistema/docs/$folio/$id_sol/";
							$tmp = $_FILES["archivo_$j"]["tmp_name"];
							copy($tmp, $path.$name);
						}
					}
				}
			}
			
			
			
			switch ($_POST['tipo_folio']) {
                 case 'C':
                     $tipo_sol= "Carta";
                     break;
            	  case 'P':
                     $tipo_sol= "Formulario en Papel";
                     break;
            	  case 'D':
                     $tipo_sol= "Derivaci&oacute;n";
                     break;
            	
               	default:
            	   
            	 
                   
             }
			
			$folio= $_POST['folio'];
			
			$observacion="Ingreso Manual de solicitud tipo $tipo_sol";
				/*$qry_insert="INSERT INTO sgs_flujo_estados_solicitud (folio,id_estado_solicitud,id_estado_respuestas,fecha,id_usuario,observacion) 
					 values ('$folio','1','2','$fecha','$id_usuario','$observacion')";
		$result_insert=cms_query($qry_insert) or die (error($query,mysql_error(),$php));
			*/
			if($_POST['direccion'] == "" && $_POST['email'] == ""){
				$observacion="Cambio por reasignaci&oacute;n autom&aacute;tica por ingreso de solicitud sin datos de contacto, 
				se cambia a estado Pendiente Rectificaci&oacute;n (Inadmisibilidad provisoria)";
				Insertar_historial($folio,5,$observacion);
			}else{
				
				Insertar_historial($folio,2,$observacion);
			}
			
			if($_POST['firmada']==1){
				
				if($estado_insert!=""){
					$folio = $_POST['folio'];
					//RR
					 header("Location:index.php?accion=$accion&act=5&folio=$folio");
					}else{
			  		 $contenido = "Upss. <br> $estado_insert";
				}
			
			}else{
				//si la solicitud no esta firmada se cambian de forma automatica sus estados a solicitudes pendientes de rectificación
				$folio = $_POST['folio'];
				$observacion="Cambio por reasignaci&oacute;n autom&aacute;tica por ingreso de solicitud no firmada, 
				se cambia a estado Pendiente Rectificaci&oacute;n";
				Insertar_historial($folio,5,$observacion);
		
		
		    $query= "SELECT id_perfil   
                   FROM  usuario_perfil 
                   WHERE perfil='Digitador'";
             $result= cms_query($query)or die (error($query,mysql_error(),$php));
             list($id_perfil_digitador) = mysql_fetch_row($result);
			 
			 if($id_perfil_digitador==perfil($id_sesion)){
			 	$id_perfil_asignacion_automatica = configuracion_cms('perfil_asignacion_defecto');
				
				    $query= "SELECT id_entidad
                           FROM  sgs_solicitud_acceso
                           WHERE folio = '$folio'";
                     $result= cms_query($query)or die (error($query,mysql_error(),$php));
                      list($id_entidad_auto) = mysql_fetch_row($result);
					  
				$query= "SELECT id_usuario
                                 FROM  usuario
                                 WHERE id_perfil='$id_perfil_asignacion_automatica' and id_entidad='$id_entida_auto'";
				 
                           $result2= cms_query($query)or die (error($query,mysql_error(),$php));
                           if(!list($id_usuario_asig) = mysql_fetch_row($result2)){
						   $id_usuario_asig = id_usuario($id_sesion);
						   }
						   $responsable_asig = nombre_usuario2($id_usuario_asig);
				
				
			 }else{
			  $id_usuario_asig = id_usuario($id_sesion);
			  $responsable_asig = nombre_usuario2($id_usuario_asig);
			 }
			 
			 
				$Sql ="UPDATE sgs_solicitud_acceso 
					   SET id_responsable = '$id_usuario_asig'
					   WHERE folio ='$folio'";

 					cms_query($Sql)or die (error($query,mysql_error(),$php));
				    
				echo "<script>alert('La solicitud $folio NO ha sido firmada, se ha ingresado como una solicitud pendiente de Rectificaci\u00F3n y asignada a $responsable_asig'); document.location.href='index.php?accion=$accion&act=5&folio=$folio';</script>\n";
				
			}
			
				
				
				
				}else{
			   //header("HTTP/1.0 307 Temporary redirect");
              
			  echo  "<script>alert('Existe algun problema con el folio.'); document.location.href='index.php?accion=$accion'; </script>\n";
			  // header("Location:index.php?accion=$accion");
				
			
}



			
	
?>