<?php

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
	 
	//hacer la asignación del responsable
	
	if (isset($_POST['prorroga'])){
		$prorroga = $_POST['prorroga'];
	}else{
		$prorroga ="";
	}
	$mensaje = "";
	//echo "<br>prorroga: ".$prorroga;
	
	
	
	if ($prorroga!=""){
	
	
			//echo "<br>entra a prorroga<br>";
			$sql = "select fecha_inicio,fecha_termino from sgs_solicitud_acceso where folio = '$folio'";
			$result = cms_query($sql) or die("<br>La consulta falló<br>".mysql_error());
			list($fecha_inicio,$fecha_termino) = mysql_fetch_row($result);
			
			
			$dias_de_plazo=  configuracion_cms('dias_de_plazo_prorroga');
			
			$fecha_termino = sumaDiasHabiles($fecha_termino,$dias_de_plazo);
			
			$sql = "UPDATE sgs_solicitud_acceso set prorroga = 1, fecha_termino ='$fecha_termino'  where folio = '$folio'";

 cms_query($sql)
					or die("<br>La consulta falló<br>".mysql_error());
			
			 $id_prorroga = configuracion_cms('id_prorroga');
			 $observacion = configuracion_cms('observacion_prorroga');
			 
			 $qry_insert="INSERT INTO sgs_flujo_estados_solicitud (folio,id_estado_solicitud,id_estado_respuestas,fecha,id_usuario,observacion) 
							 values ('$folio','$id_prorroga','$id_estado_respuestas','$fecha','$id_usuario','$observacion')";
				$result_insert=cms_query($qry_insert) or die("$MSG_DIE $php - QR-Problemas al insertar $qry_insert<br>".mysql_error());		
					
					
			$mensaje = "pro";
			
	}elseif($_POST['reasignar']==1){
			$fecha_actual =date(d)."-".date(m)."-".date(Y);
			
			$_POST['fecha_solicita']=$fecha_actual;
			$_POST['id_usuario']=$id_usuario;
			$_POST['folio']=$folio;
			$_POST['hora_solicita']=date('h:i:s');
			
			inserta('sgs_solicitud_asignacion');	
			
			
			
	}else{
	
	
			$id_estado_solicitud = $_POST['id_estado_solicitud'];
			$id_etapas = $_POST['id_etapas'];
			$observacion = $_POST['observacion'];
			$observacion = acentos($observacion. " ".$url_1." ".$url_2);
			
			   $query= "SELECT id_estado_solicitud
					   FROM  sgs_solicitud_acceso
					   WHERE folio='$folio'";
				 $result= cms_query($query)or die (error($query_a,mysql_error(),$php));
				  list($id_estado_actual) = mysql_fetch_row($result);
			
			
			$query= "UPDATE sgs_solicitud_acceso 
						 SET id_responsable = $id_usuario ,
						 id_estado_solicitud =$id_estado_solicitud,
						 id_sub_estado_solicitud  = $id_etapas
						 WHERE folio = '$folio' ";
						
			$result= cms_query($query)or die (error($query,mysql_error(),$php));
			
			$fecha = date(Y)."-".date(m)."-".date(d);
			 " id_estado_respuestas:  ". $id_estado_respuestas ;
			
			$query= "SELECT count(*) as cantidad FROM sgs_flujo_estados_solicitud	
					WHERE  id_estado_solicitud = $id_etapas  
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
				 $qry_insert="INSERT INTO sgs_flujo_estados_solicitud (folio,id_estado_solicitud,id_estado_respuestas,fecha,id_usuario,observacion) 
							 values ('$folio','$id_etapas','$id_estado_respuestas','$fecha','$id_usuario','$observacion')";
				$result_insert=cms_query($qry_insert) or die("$MSG_DIE $php - QR-Problemas al insertar $qry_insert<br>".mysql_error());
		//	}
			$mensaje="ok";
	
	}
	
	

?>