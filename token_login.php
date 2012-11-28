<?php

	include("lib/connect_db.inc.php");
	include("lib/lib.inc.php"); 
	include("lib/lib.inc2.php");

	$resp = utf8_encode($_POST['json']);
	$var= "\ ";
	$var= trim($var);
	$resp = str_replace($var,"",$resp);
	$resp = json_decode($resp);
	
	
	$token = $resp->{'Token'};
	$folio = $resp->{'Folio'};
	$apellido_paterno = $resp->{'apellidos_Beneficiario'};
	
	
	
	$query = "SELECT id, ping_app
				FROM app_desarrollo
				WHERE token_app LIKE '%$token%'";
	$result = cms_query($query)or die(mysql_error());
	
	if(list($app,$ping_app) = mysql_fetch_row($result)){
		
		$query = "
	
				SELECT sgs.id_estado_solicitud
				FROM sgs_solicitud_acceso sgs, usuario u
				WHERE sgs.id_usuario = u.id_usuario
				AND sgs.folio LIKE '%$folio%'
				AND u.paterno LIKE '%$apellido_paterno%'";
		
		
		$result = cms_query($query)or die(mysql_error());
		if(list($id_estado_solicitud) = mysql_fetch_row($result)){	
				
			$query = "SELECT estado_solicitud
				FROM sgs_estado_solicitudes
				WHERE id_estado_solicitud = '$id_estado_solicitud'";
			$result = cms_query($query)or die(mysql_error());
			list($estado_solicitud) = mysql_fetch_row($result);
			
			$ping_app++;
			$query_update = "UPDATE app_desarrollo SET ping_app = '$ping_app' WHERE token_app LIKE '%$token%' ";
			$result_update = cms_query($query_update)or die(mysql_error());
			
			echo "estado de la solicitud <b>$folio</b>: ".$estado_solicitud;
		
		}else{
			echo "Error en el folio o el apellido paterno, favor verificar";
		}
		
	}else{
		echo "Error en el token entregado";
	
	}

	






?>