<?php

	// Entrega la plantilla de acuerdo al template seleccionado
	if($_POST['template']){		
		$plantilla_elegida = $_POST['template'];
		$folio = $_POST['folio'];
		$query_plantilla_select = "SELECT plantilla
			FROM sgs_plantilla_respuestas
			WHERE id_plantilla = '$plantilla_elegida'";
		
		$result_plantilla_elegida = mysql_query($query_plantilla_select)or die (error($query_plantilla_select,mysql_error(),$php));
		list($plantilla) = mysql_fetch_row($result_plantilla_elegida);

		$query= "SELECT u.nombre, u.paterno
				   FROM  sgs_solicitud_acceso sg, usuario u
				   WHERE sg.folio ='$folio'
				   AND sg.id_usuario = u.id_usuario";
				   	   
		$result= mysql_query($query)or die (error($query,mysql_error(),$php));
		list($nombre,$paterno) = mysql_fetch_row($result);
		$plantilla = str_replace("#NOMBRE#","$nombre",$plantilla);
		$plantilla = str_replace("#APELLIDO#","$paterno",$plantilla);
		$plantilla = str_replace("#FOLIO#","$folio",$plantilla);
		
		exit($plantilla);
		
	}
	
	
?>