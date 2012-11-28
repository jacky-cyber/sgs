<?php

switch ($act) {

	case 8:
		include ("chileatiende/documentos_sistema/ingreso_archivos.php");
		break;
	case 9:
		include ("chileatiende/documentos_sistema/actualizar_archivos.php");
		include ("chileatiende/documentos_sistema/listado.php");
		//$contenido = $lista;
		break;
	case 10:
		include ("chileatiende/documentos_sistema/descarga.php");
		break;
		
	default:

}

?>