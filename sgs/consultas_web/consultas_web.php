<?php


switch ($act) {

	case 1:
		include("sgs/consultas_web/ingreso_solicitud.php");
		break;
		
	case 2:
		include("sgs/consultas_web/comprobante_solicitud.php");
		$contenedor_lateral_derecho=html_template('ayuda_certificado_ingreso_solicitud_web');
		break;
	case 3:
		include("sgs/consultas_web/carga_combolist.php");
		break;
	case 4:
		include("captcha/verificar2.php");
		break;		
	case 7:
		 include("sgs/consultas_web/imprimir_comprobante.php");
         break;		
	default:
		
		include("sgs/consultas_web/formulario_acceso.php");

}



?>