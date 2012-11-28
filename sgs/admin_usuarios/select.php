<?php

include("../../lib/lib.inc.php");
include("../../lib/lib.inc2.php");
include("../../lib/connect_db.inc.php");    

$id_entidad= $_POST["elegido"];

    $query= "SELECT id_departamento ,departamento 
           FROM  sgs_departamentos
           WHERE id_entidad='$id_entidad'";
     $result= cms_query($query)or die ($query);
      while (list($id_departamento,$departamento ) = mysql_fetch_row($result)){
				$lista_sel .="<option value=\"$id_departamento\">$departamento</option>\n";		   
		 }
         echo "<option value=\"0\">Seleccione un Departamento</option>\n
		$lista_sel";

?>