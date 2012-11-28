<?php


$rechazo_reasignar = $_POST['rechazo_reasignar'];
$obs_rechazo = $_POST['obs_rechazo'];
$id_responsable = $_POST['id_responsable'];
$id_solicitud_asignacion= $_POST['id_solicitud_asignacion'];


$id_usuario_reasig= $_POST['id_usuario_reasig'];
$id_estado_solicitud= $_POST['id_estado_solicitud'];

$nombre_usuario = nombre($id_sesion);


    $query= "SELECT folio   
           FROM  sgs_solicitud_asignacion 
           WHERE id_solicitud_asignacion='$id_solicitud_asignacion'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      list($folio) = mysql_fetch_row($result);
	  
	  


  $query= "SELECT id_solicitud_acceso,id_entidad_padre,id_entidad,id_estado_solicitud,id_sub_estado_solicitud 
           FROM   sgs_solicitud_acceso 
           WHERE folio='$folio'";
		  // echo $query."<br>";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
     list($id_solicitud_acceso,$id_entidad_padre,$id_entidad,$id_estado_solicitud,$id_sub_estado_solicitud) = mysql_fetch_row($result);
	 
	



if($rechazo_reasignar!=""){
	$obs_rechazo= acentos($obs_rechazo);
	$fecha_acepta = date(Y)."-".date(m)."-".date(d);
	
	$Sql ="UPDATE sgs_solicitud_asignacion 
    	   SET id_estado_asignacion =3, 
		   respuesta ='$obs_rechazo',
		   id_asignador =$id_usuario,
		   fecha_acepta='$fecha_acepta'
    	   WHERE id_solicitud_asignacion ='$id_solicitud_asignacion'";
    		//echo $Sql;

 cms_query($Sql)or die (error($Sql,mysql_error(),$php));
		 
		 
		 
		 
	/*Enivo de mail */
	$mail_destino = rescata_valor('usuario',$id_usuario_reasig,'email') ;
	
	
	$template="asunto_rechazo_solicitud_reasignacion";
	
	$asunto =configuracion_cms($template);
	
	
	
	if($asunto=="$template no existe"){
		$valor= "Se ha rechazado su solicitud de reasignaci&oacute;n";
		$tabla = "cms_configuracion";
		$publico = 1;	
			$_POST['configuracion']="$template";
			$_POST['valor']=$valor;
			$_POST['descripcion']="Subjet mensaje de solicitud de reasignaci&oacute;n";
			
			$_POST['publico']=$publico;
			inserta($tabla);
		//echo $asunto;	
		}
	$asunto = $valor;
	
	$template="cuerpo_rechazo_solicitud_reasignacion";
	$asunto =configuracion_cms($template);
	
	
	if($asunto=="$template no existe"){
		$valor= "Se ha rechazado su solicitud de reasignaci&oacute;n";
		$tabla = "cms_configuracion";
		$publico = 1;	
		
			$_POST['configuracion']="$template";
			$_POST['valor']=$valor;
			$_POST['txt']=1;
			$_POST['descripcion']="Cuerpo mensaje de solicitud de reasignaci&oacute;n";
			
			$_POST['publico']=$publico;
			inserta($tabla);
		//echo $asunto;	
		}
	
	$cuerpo = $valor;
	
	
	$asunto .= " por $nombre_usuario";
	$cuerpo = " por $nombre_usuario <br><br>Comentario: <br><br>$obs_rechazo ";
	cms_mail($mail_destino,$asunto,$cuerpo,$headers);
	/*Fin envio mail*/
	
	
	/*Historial*/
	$obs_rechazo= "Solicitud de reasignaci&oacute;n rechazada <br>".$obs_rechazo;
	$fecha = date(Y)."-".date(m)."-".date(d);
			 $qry_insert="INSERT INTO sgs_flujo_estados_solicitud (folio,id_estado_solicitud,id_estado_respuestas,fecha,id_usuario,observacion) 
							 values ('$folio','$id_estado_solicitud','$id_prorroga','$fecha','$id_usuario','$obs_rechazo')";
				$result_insert=cms_query($qry_insert) or die("$MSG_DIE $php - QR-Problemas al insertar $qry_insert<br>".mysql_error());		
		
		session_register_cms('mensaje_reasignacion');
	$_SESSION['mensaje_reasignacion'] ="Solicitud Folio: $folio <strong>Rechazada</strong>";
		
	
	/*Fin Historial*/
	
}else{


$obs_rechazo= acentos($obs_rechazo);
	$fecha_acepta = date(Y)."-".date(m)."-".date(d);
	
	$Sql ="UPDATE sgs_solicitud_asignacion 
    	   SET id_estado_asignacion =2, 
		   respuesta ='$obs_rechazo',
		   id_asignador =$id_usuario,
		   fecha_acepta='$fecha_acepta'
    	   WHERE id_solicitud_asignacion ='$id_solicitud_asignacion'";
    		//echo $Sql."<br>";

 cms_query($Sql)or die (error($Sql,mysql_error(),$php));
		 
		 
		 
		 
	/*Enivo de mail */
	$mail_destino = rescata_valor('usuario',$id_usuario_reasig,'email') ;
	
	
	
	$template="asunto_rechazo_aceptado_solicitud_reasignacion";
	$asunto =configuracion_cms($template);
	
	$valor= "Se ha aceptado su solicitud de reasignaci&oacute;n";
	$tabla = "cms_configuracion";
	$publico = 1;
	if($asunto=="$template no existe"){
			
			$_POST['configuracion']="$template";
			$_POST['valor']=$valor;
			$_POST['descripcion']="Asunto mensaje de confirmaci&oacute;n ok de solicitud de reasignaci&oacute;n";
			$_POST['publico']=$publico;
			inserta($tabla);
		//echo $asunto;	
		$asunto = $valor;
		}
	
	
	$template="cuerpo_rechazo_aceptado_solicitud_reasignacion";
	$cuerpo =configuracion_cms($template);
	
	if($cuerpo=="$template no existe"){
			
			$valor= "Se ha aceptado su solicitud de reasignaci&oacute;n";
			$tabla = "cms_configuracion";
			$publico = 1;
			
			$_POST['configuracion']="$template";
			$_POST['valor']=$valor;
			$_POST['txt']=1; //solo cuando queremos 
			$_POST['descripcion']="Cuerpo mensaje de confirmaci&oacute;n ok de solicitud de reasignaci&oacute;n";
			
			$_POST['publico']=$publico;
			inserta($tabla);
		//echo $asunto;	
		$cuerpo = $valor;
		}
	
	
	
	
	$asunto .= " por $nombre_usuario";
	$cuerpo .= " por $nombre_usuario <br><br>Comentario: <br><br>$obs_rechazo ";
	cms_mail($mail_destino,$asunto,$cuerpo,$headers);
	/*Fin envio mail*/
	
	
	/*Historial*/
	$obs_rechazo= "Solicitud de reasignaci&oacute;n aceptada <br>".$obs_rechazo;
	$fecha = date(Y)."-".date(m)."-".date(d);
			 $qry_insert="INSERT INTO sgs_flujo_estados_solicitud (folio,id_estado_solicitud,id_estado_respuestas,fecha,id_usuario,observacion) 
							 values ('$folio','$id_estado_solicitud','$id_prorroga','$fecha','$id_usuario','$obs_rechazo')";
				$result_insert=cms_query($qry_insert) or die("$MSG_DIE $php - QR-Problemas al insertar $qry_insert<br>".mysql_error());		
		
			
	
	/*Fin Historial*/
	
	
	/*REASIGNACION*/
	$id_responsable = $_POST['id_responsable'];
	
	 $Sql ="UPDATE sgs_solicitud_acceso 
     	   SET id_responsable ='$id_responsable'
     	   WHERE folio ='$folio'";
     	//echo $Sql;

 cms_query($Sql)or die (error($Sql,mysql_error(),$php));
	
	/*******************/
	
	session_register_cms('mensaje_reasignacion');
	$_SESSION['mensaje_reasignacion'] ="Solicitud Folio: $folio modificada";
	//echo $_SESSION['mensaje_reasignacion'];
	

}




header("Location:index.php?accion=$accion");

?>