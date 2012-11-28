<?php

    $query= "SELECT id_usuario,nombre   
           FROM  usuario
           WHERE id_usuario='$id_usuario'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($id_usuario,$nombre) = mysql_fetch_row($result)){
						   
		 }

?>