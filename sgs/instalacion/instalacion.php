<?php


switch ($act) {
     case 1:
         include ("sgs/instalacion/actualiza_configuracion.php");
         break;
    case 2:
        $contenido = html_template('mensaje_configuracion_guardada');	
         break;

   	default:
	   include("sgs/instalacion/formulario.php");
	   
	    
       
 }


?>