<?php
// se trae la informacion de las solicitudes

switch ($nivel) {
			case "Solicitud":
				//armar el listado de solicidtudes
				include  ("sgs/reportes/reportes_arma_listado_solicitudes.php");
				break;
			case "Detalle":
				include  ("sgs/reportes/reportes_arma_listado_solicitudes.php");
				break;
	}
				
	


?>