<?php

switch($act){
	
	case 1:
		include("deuman/desarrollo/desarrolladores/pantallaini.php");
	break;
	case 2:
		include("deuman/desarrollo/desarrolladores/listado_app.php");
	break;	
	case 3:
		include("deuman/desarrollo/desarrolladores/guarda_app.php");	
	break;
	case 4:
		include("deuman/desarrollo/desarrolladores/obtiene_app.php");	
	break;
	case 5:
		include("deuman/desarrollo/desarrolladores/actualiza_app.php");	
	break;
	default:
		include("deuman/desarrollo/desarrolladores/pantallaini.php");
	//include("deuman/desarrollo/desarrolladores/ingreso_aplicacion.php");
	
}

?>