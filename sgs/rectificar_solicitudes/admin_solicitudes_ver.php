<?php

	$Estados_etapa_fin= configuracion_cms('Estados_etapa_fin');	

	$folio =  $_GET['folio'];
	$mensaje =  $_GET['mensaje'];
	
	$tipo = trim(substr($folio, 5, 1));
	
	//sacar el html del contenido
	
						
	/*if ($tipo == "W"){
		include("sgs/rectificar_solicitudes/solicitud_web.php");
	}else{*/
		include("sgs/rectificar_solicitudes/solicitud_digitada.php");
	//}
	

	
?>