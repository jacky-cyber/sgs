<?php

  $query= "SELECT id_auto_admin   
           FROM auto_admin
           WHERE tabla='$nom_tabla'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
   list($id_auto_admin) = mysql_fetch_row($result);
   
   
    $Sql ="DELETE FROM auto_admin_campo WHERE id_auto_admin=$id_auto_admin";

 cms_query($Sql);

	  $Sql ="DELETE FROM auto_admin WHERE id_auto_admin=$id_auto_admin";

 cms_query($Sql);
	 
	 
	 echo "<script>alert('Tabla borrada'); document.location.href='index.php?accion=$accion';</script>\n";

	 
?>