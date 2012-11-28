<?php


switch ($act) {
     case 1:
        include ("sgs/reasignacion/detalle_reasignacion.php");
     
         break;
	 case 2:
         include ("sgs/reasignacion/reasignar_solicitud.php");
         break;

   	default:
	    include ("sgs/reasignacion/lista_solicitudes_reasignacion.php");
	    
   }
   
   
   
?>