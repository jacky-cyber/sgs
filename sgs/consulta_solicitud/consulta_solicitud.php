<?php
	
	
switch ($act) {
     case 1:

	 
        include ("sgs/consulta_solicitud/respuesta.php");
         break;
   
   	default:
	
$js .= "<script language=\"JavaScript\">

$(document).ready(function () 
		{
			$('#boton').click(function() 
			{ procesar('index.php?accion=$accion&act=1&axj=1','div_respuesta');
			});
		});
		</script>";

	
	  // $accion_form = "index.php?accion=$accion&act=1";
	    include("sgs/consulta_solicitud/formulario_captcha_solicitudes.php");
 }
 

?>