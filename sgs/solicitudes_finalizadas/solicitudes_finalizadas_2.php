<?php
$id_usuario     = id_usuario($id_sesion);


switch ($act) {
     case 1:
	 
         include ("sgs/mis_solicitudes_asignadas/admin_solicitudes_ver.php");
         break;
	 case 2:
	 	 //include ("sgs/mis_solicitudes_asignadas/admin_solicitudes_update.php");
		 include ("sgs/mis_solicitudes_asignadas/admin_solicitudes_cambia_estado.php");
		 header("location:index.php?accion=$accion&act=1&folio=$folio&mensaje=$mensaje");
         break;
   case 3:
       
	    if ($_POST["type"] == "xml")	
		$contenido ="header (\"content-type: text/xml\");
          <select id=\"destino\" name=\"destino\">
             <option value=\"-1\">Selecciona una zona</option>";
        if ($_POST["pais"] == "ES"){ 
					$contenido .=" <option value=\"PMI\">Palma de Mallorca</option>
					<option value=\"AGP\">Malaga</option>
					<option value=\"BCN\">Barcelona</option>";
 			} else if($_POST["pais"] == "FR") { 
					$contenido .="<option value=\"TOU\">Toulousse</option>
					<option value=\"CHD\">Charles de Gaulle</option>";
		 } 
		$contenido .="</select>";
		 
		 $contenido = "<select name=\"select\">
                       <option value=\"uno\">uno</option>
                       <option value=\"dos\">dos</option>
                       </select>";
		 
         break;
		  case 4:
        		 $id_e = $_GET['id_e'];
				 
					$contenido = rescata_valor('sgs_estado_solicitudes',$id_e,'pregunta');
					
					//$contenido =  "hola";
         break;
   
   	default:
	   $def ="ok";
	
	
	include("sgs/mis_solicitudes_asignadas/lista_admin_solicitudes.php");
	
	 
       
 }

?>