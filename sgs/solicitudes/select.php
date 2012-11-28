<?php

include("../../lib/connect_db.inc.php");    

$id_entidad= $_POST["elegido"];

    $query= "SELECT id_entidad_oficina,oficina,direccion,id_entidad_padre
           FROM  sgs_entidades_oficinas 
           WHERE id_entidad='$id_entidad'";
     $result= cms_query($query)or die ($query);
      while (list($id_entidad_oficina,$oficina,$direccion,$id_entidad_padre ) = mysql_fetch_row($result)){
				$lista_sel .="<option value=\"$oficina\">$oficina</option>\n";		   
		 }
echo "<option value=\"0\">Seleccione una oficina</option>\n
		$lista_sel";
?>