<?php
$id_usuario     = id_usuario($id_sesion);


switch ($act) {
     case 1:
	 
         include ("sgs/solicitudes_respondidas/admin_solicitudes_ver.php");
         break;
	 case 2:
	 	 //include ("sgs/mis_solicitudes_asignadas/admin_solicitudes_update.php");
		 include ("sgs/solicitudes_respondidas/admin_solicitudes_cambia_estado.php");
		// header("location:index.php?accion=$accion&act=1&folio=$folio&mensaje=$mensaje");
         break;
   case 3:
       
	    
		 
         break;
		  case 4:
        		 $id_e = $_GET['id_e'];
				 
					$contenido = rescata_valor('sgs_estado_solicitudes',$id_e,'pregunta');
					
					//$contenido =  "hola";
         break;
   
   
   	default:
	   $def ="ok";
	
	$condicion_mis_solicitudes = "";
	include("sgs/solicitudes_respondidas/lista_admin_solicitudes.php");
	
	 
       
 }

?>