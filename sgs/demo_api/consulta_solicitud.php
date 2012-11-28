<?php

	$resp = utf8_encode($_GET['json']);
	$var= "\ ";
	$var= trim($var);
	$resp = str_replace($var,"",$resp);
	$json = json_decode($resp);
	
	$login = $resp->{'login_Usuario'};
	$password = $resp->{'pass_Usuario'};
	//$id_app = $resp->{'id_App'};
	$token = $resp->{'token_App'};
	$folio = $resp->{'folio'};
	$apellido_paterno = $resp->{'apellido_paterno'};
	
	$query = "SELECT id_app
				FROM app_desarrollo
				WHERE token_app LIKE '%$token%'";
	$result = cms_query($query)or die (error($query,mysql_error(),$php));
	if(list($app) = mysql_fetch_row($result)){
		
		$query = "
	
				SELECT sgs.id_estado_solicitud
				FROM sgs_solicitud_acceso sgs, usuario u
				WHERE sgs.id_usuario = u.id_usuario
				AND sgs.folio LIKE '%$folio%'
				AND u.paterno LIKE '%$apellido_paterno%'";
		
		$result = cms_query($query)or die (error($query,mysql_error(),$php));
		if(list($estado_solicitud) = mysql_fetch_row($result)){	
			
			
		
		}
		
	}








?>