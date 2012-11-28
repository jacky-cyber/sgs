<?php 

switch ($act) {
	case 1:
		include("admin/estadisticas_acciones/graficar_usuarios_conectados.php");
	break;
	case 2:
		include("admin/estadisticas_acciones/graficar_cache.php");
	break;
	case 3:
		include("admin/estadisticas_acciones/graficar_sin_cache.php");
	break;
	case 4:
		include("admin/estadisticas_acciones/graficar_sql.php");
	break;
	case 5:
		include("admin/estadisticas_acciones/graficar_visitas.php");
	break;
	case 6:
		include("admin/estadisticas_acciones/graficar_pie.php");
	break;
	case 7:
		include("admin/estadisticas_acciones/graficar_tiempo_conectados.php");
	break;
	default:
		include("admin/estadisticas_acciones/pantalla_estadistica.php");
		//include("admin/estadisticas_acciones/graficar_pie.php");
	break;	 
}		 

?>