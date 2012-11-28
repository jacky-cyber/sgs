<?php

$folio = $_GET['folio'];
//$respuesta = $_POST['respuesta'];
			
			$_POST['observacion'] = nl2br($_POST['observacion']);

if( $_POST['id_etapas']==""){
	
   header("Location:?accion=$accion&act=1&folio=$folio");
}elseif($_POST['id_estado_solicitud']==""){
    
     header("Location:?accion=$accion&act=1&folio=$folio");
}else{
 

if(trim($_POST['observacion'])==""){
$_POST['observacion']="Sin Observaci&oacute;n";
}

	$folio =  $_GET['folio'];
	$url_1 =  $_POST['url_1'];
	$url_2 =  $_POST['url_2'];
	if ($url_1!=""){
		$url_1 = str_replace("http://","",$url_1);
		$url_1 = "<br><a href=\"http://".$url_1."\" target=\"_blank\" >".$url_1."</a>";
	}
	if ($url_2!=""){
		$url_2 = str_replace("http://","",$url_2);
		$url_2 = "<br><a href=\"http://".$url_2."\" target=\"_blank\">".$url_2."</a>";
	}
	//$id_responsable =  $_POST['id_responsable'];	
	 
	//hacer la asignaci�n del responsable
	
	if (isset($_POST['prorroga'])){
		$prorroga = $_POST['prorroga'];
	}else{
		$prorroga ="";
	}
	$mensaje = "";
	//echo "<br>prorroga: ".$prorroga;
	
	
	
	if ($prorroga!=""){
	
	
			//echo "<br>entra a prorroga<br>";
			$sql = "select fecha_inicio,fecha_termino,prorroga from sgs_solicitud_acceso where folio = '$folio'";
			$result = cms_query($sql)or die (error($sql,mysql_error(),$php));
			list($fecha_inicio,$fecha_termino,$prorroga) = mysql_fetch_row($result);
			
			if($prorroga==0){
			
			
			$dias_de_plazo=  configuracion_cms('dias_de_plazo_prorroga');
			
			$fecha_termino = sumaDiasHabiles($fecha_termino,$dias_de_plazo);
			
			$sql = "UPDATE sgs_solicitud_acceso set prorroga = 1, fecha_termino ='$fecha_termino' where folio = '$folio'";

 			cms_query($sql)or die (error($sql,mysql_error(),$php));;
			
			    
				$template="id_prorroga";
				$configuracion_prorroga =configuracion_cms($template);
				$valor= "25";
				$tabla = "cms_configuracion";
				$publico = 0;
				if($configuracion_prorroga=="$template no existe"){
			        	$_POST['configuracion']="$template";
						$_POST['valor']=$valor;
						$_POST['descripcion']="id prorroga";
			 			$_POST['publico']=$publico;
						inserta($tabla);
		
				}
				  
			 $id_prorroga = configuracion_cms('id_prorroga');
			 
			    $template="observacion_prorroga";
				$configuracion_prorroga =configuracion_cms($template);
				$valor= "La solicitud ha sido prorrogada";
				$tabla = "cms_configuracion";
				$publico = 0;
				if($configuracion_prorroga=="$template no existe"){
			        	$_POST['configuracion']="$template";
						$_POST['valor']=$valor;
						$_POST['descripcion']="Mensaje la solicitud ha sido prorrogada";
			 			$_POST['publico']=$publico;
						inserta($tabla);
		
				}
				
			 $observacion = configuracion_cms('observacion_prorroga');
			 //$observacion .= "<br> <a>Link descarga respuesta </a>";
			 
			 
			$fecha = date(Y)."-".date(m)."-".date(d);	 
			$observacion = nl2br($observacion);
			 $qry_insert="INSERT INTO sgs_flujo_estados_solicitud (folio,id_estado_solicitud,id_estado_respuestas,fecha,id_usuario,observacion) 
							 values ('$folio','$id_prorroga','$id_estado_respuestas','$fecha','$id_usuario','$observacion')";
				$result_insert=cms_query($qry_insert) or die (error($qry_insert,mysql_error(),$php));
			
			alerta_etapa($id_etapas,$folio);		
					
			$mensaje = "pro";
			}
	}elseif($_POST['reasignar']==1){
		$observacion = $_POST['observacion'];
		
			//echo $observacion." dfdsf";
			$template="obs_solicitud_asignacion";
				$configuracion_prorroga =configuracion_cms($template);
				$valor= "Se solicita reasignaci&oacute;n de solicitud a otra persona";
				$tabla = "cms_configuracion";
				$publico = 0;
				if($configuracion_prorroga=="$template no existe"){
			        	$_POST['configuracion']="$template";
						$_POST['valor']=$valor;
						$_POST['descripcion']="Mensaje Observaci&oacute;n solicitud de asignacion";
			 			$_POST['publico']=$publico;
						inserta($tabla);
		
				}
				
			$observacion_reasignacion = configuracion_cms('obs_solicitud_asignacion');
			//$observacion_reasignacion = nl2br($observacion_reasignacion);
			
		if($observacion_reasignacion=="obs_solicitud_asignacion no existe"){
			
			$_POST['configuracion']="obs_solicitud_asignacion";
			$_POST['valor']="Se solicita reasignaci&oacute;n de solicitud a otra persona";
			$_POST['descripcion']="Subjet de solicitu de reasignaci&oacute;n";
			
			$_POST['publico']="1";
			$_POST['obligatorio']=0;
			//$_POST['observacion']="$observacion_reasignacion";
			inserta("cms_configuracion");
			$observacion =$_POST['valor'];
		}
		
		$fecha_actual =date(d)."-".date(m)."-".date(Y);
			$_POST['observacion']="$observacion_reasignacion  <br>$observacion";
			
			$_POST['fecha_solicita']=$fecha_actual;
			$_POST['id_usuario']=$id_usuario;
			$_POST['folio']=$folio;
			$_POST['id_estado_asignacion']=1;
			$_POST['hora_solicita']=date('h:i:s');
			//$tp=1;
			inserta('sgs_solicitud_asignacion');
		
			$template="subjet_aviso_solicitud_reasignacion";
						$valor= "Se ha solicitado una reasignaci&oacute;n de una solicitud";
						$subjet = configuracion_cms($template);
					if($subjet=="$template no existe"){
			
						$_POST['configuracion']="$template";
						$_POST['valor']=$valor;
						$_POST['descripcion']="Subjet de solicitud de reasignaci&oacute;n";
						$_POST['publico']="1";
						$POST['obligatorio']=0;
						inserta("cms_configuracion");
						//$subjet =$valor;
					$subjet = configuracion_cms($template);
					}	
					
					$template="cuerpo_aviso_solicitud_reasignacion";
						$valor= "Se ha solicitado una reasignaci&oacute;n de una solicitud";
						$cuerpo = configuracion_cms($template);
					if($cuerpo=="$template no existe"){
			
						$_POST['configuracion']="$template";
						$_POST['valor']=$valor;
						$_POST['descripcion']="Cuerpo de solicitud de reasignaci&oacute;n";
						$_POST['publico']="1";
						$POST['obligatorio']=0;
						inserta("cms_configuracion");
						//$cuerpo =$valor;
					$cuerpo = configuracion_cms($template);
					}	
		       $query= "SELECT u.id_usuario,u.email   
                      FROM  usuario u, usuario_perfil up
                      WHERE u.id_perfil =up.id_perfil  and up.perfil ='Asignador'";
                $result= cms_query($query)or die (error($query,mysql_error(),$php));
                while (list($id_usuario_destino,$email_destino) = mysql_fetch_row($result)){
                		
				//	cms_mail($email_destino,$subjet,$cuerpo,$headers);
										   
                }
		
		//alerta_etapa($id_etapas,$folio);
				
						
		
		    $id_estado_solicitud = $_POST['id_estado_solicitud'];
			$id_etapas = $_POST['id_etapas'];
			
		    $query= "SELECT id_estado_solicitud, id_sub_estado_solicitud  
                   FROM  sgs_solicitud_acceso
                   WHERE folio='$folio'";
             $result= cms_query($query)or die (error($query,mysql_error(),$php));
              list($id_estado_solicitud, $id_etapas) = mysql_fetch_row($result);
			  
		
		
		$query= "UPDATE sgs_solicitud_acceso 
						 SET 
						 id_estado_solicitud ='$id_estado_solicitud',
						 id_sub_estado_solicitud  = '$id_etapas',
						 id_responsable = $id_usuario 
						 WHERE folio = '$folio' ";
						
			$result= cms_query($query)or die (error($query,mysql_error(),$php));
		    $observacion = $_POST['observacion'];
			//$observacion .= "<br> <a>Link descarga respuesta </a>";

		//	$observacion = configuracion_cms('solicitud_adignacion');
			$fecha = date(Y)."-".date(m)."-".date(d);
			$qry_insert="INSERT INTO sgs_flujo_estados_solicitud (folio,id_estado_solicitud,id_estado_respuestas,fecha,id_usuario,observacion) 
							 values ('$folio','$id_estado_solicitud','$id_estado_respuestas','$fecha','$id_usuario','$observacion')";
				$result_insert=cms_query($qry_insert) or die (error($qry_insert,mysql_error(),$php));
		
			alerta_etapa($id_etapas,$folio);
			$mensaje = "rea";
			
	}else{
	
	
			$id_estado_solicitud = $_POST['id_estado_solicitud'];
			$id_etapas = $_POST['id_etapas'];
			$observacion = $_POST['observacion'];
			$observacion = acentos($observacion. " ".$url_1." ".$url_2);
			//$observacion .= "<br> <a>Link descarga respuesta </a>";
			
			   $query= "SELECT id_estado_solicitud
					   FROM  sgs_solicitud_acceso
					   WHERE folio='$folio'";
				 $result= cms_query($query)or die (error($query,mysql_error(),$php));
				  list($id_estado_actual) = mysql_fetch_row($result);
			
			/*
			$query= "UPDATE sgs_solicitud_acceso 
						 SET id_responsable = $id_usuario ,
						 id_estado_solicitud =$id_estado_solicitud,
						 id_sub_estado_solicitud  = $id_etapas
						 WHERE folio = '$folio' ";
		 */
		 	
			$query= "UPDATE sgs_solicitud_acceso 
						 SET 
						 id_estado_solicitud ='$id_estado_solicitud',
						 id_sub_estado_solicitud  = '$id_etapas',
						 id_responsable = $id_usuario
						 WHERE folio = '$folio' ";
						
			$result= cms_query($query)or die (error($query,mysql_error(),$php));
			
			$fecha = date(Y)."-".date(m)."-".date(d);
			 " id_estado_respuestas:  ". $id_estado_respuestas ;
			
			$query= "SELECT count(*) as cantidad FROM sgs_flujo_estados_solicitud	
					WHERE  id_estado_solicitud = '$id_etapas'  
						AND  folio = '$folio' ";
			 $resultB= cms_query($query)or die (error($query_a,mysql_error(),$php));
			list($cantidad) = mysql_fetch_row($resultB);
			
			// $cantidad_verificada = mysql_num_rows($resultB);
			
/*			if(($folio!="" )&&($cantidad == 1 ))
			{
				  $qry_insert="UPDATE sgs_flujo_estados_solicitud  SET observacion= '$observacion' WHERE folio = '$folio' AND  id_estado_solicitud = $id_etapas  ";
				$result_insert=cms_query($qry_insert) or die("$MSG_DIE $php - QR-Problemas al insertar $qry_insert<br>".mysql_error());
				
			}
			else
			{*/
			//Insertar_historial($folio,$id_estado_respuestas,$observacion); 
			
				 $qry_insert="INSERT INTO sgs_flujo_estados_solicitud (folio,id_estado_solicitud,id_estado_respuestas,fecha,id_usuario,observacion) 
							 values ('$folio','$id_etapas','$id_estado_respuestas','$fecha','$id_usuario','$observacion')";
				$result_insert=cms_query($qry_insert) or die (error($qry_insert,mysql_error(),$php));
				
				alerta_etapa($id_etapas,$folio);
				
		//	}
			//echo "<br>antes de mandar el correo";
			// si se pide rectificacion
			//echo "id estado solicitud :".$id_estado_solicitud;
			if ($id_etapas == 5){
				//echo "<br>manda el correo";
				//mandar el mail al solicitante
				$query= "SELECT id_usuario 
                   FROM  sgs_solicitud_acceso
                   WHERE folio='$folio'";
				$result_rr= cms_query($query)or die (error($query,mysql_error(),$php));
				list($id_usuario) = mysql_fetch_row($result_rr);
		//validar existencia de rectificacion
				$sql = "Select  id_tipo_persona , nombre , paterno , materno ,razon_social ,apoderado ,email , direccion , numero ,depto ,ciudad ,id_region ,id_comuna 						
						from sgs_rectificacion_solicitud
						where folio = '$folio' ";
				$result_rectificar = cms_query($sql)or die (error($sql,mysql_error(),$php));
				
				if (mysql_num_rows($result_rectificar)>0){
					list($id_tipo_persona,$nombre,$paterno,$materno,$razon_social,$apoderado,$correo_electronico,$direccion,$numero,$depto,$ciudad,$id_region,$id_comuna) = mysql_fetch_row($result_rectificar);
				}else{
					$nombre = rescata_valor('usuario',$id_usuario,'nombre');
					$paterno = rescata_valor('usuario',$id_usuario,'paterno');
					$materno = rescata_valor('usuario',$id_usuario,'materno');
					$razon_social = rescata_valor('usuario',$id_usuario,'razon_social');
					$apoderado = rescata_valor('usuario',$id_usuario,'apoderado');
					$correo_electronico = rescata_valor('usuario',$id_usuario,'email') ;			
				}
		//fin validar existencia rectificacion
				$asunto = "Rectificar solicitud Folio; $folio";
				$cuerpo = "Estimado $nombre $paterno $materno\n";
				$cuerpo .= "Favor rectificar la solicitud Folio $folio";
				$cuerpo .= "\nEl motivo de la rectificaci&oacute;n es :\n $observacion";
				
				$headers = "";
				cms_mail($correo_electronico,$asunto,$cuerpo,$headers);
				
			}
			$mensaje="ok";
	
	}
	   
    



 }
 	

?>