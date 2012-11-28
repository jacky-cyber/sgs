<?php

 
include("lib/connect_db.inc.php");
include("lib/lib.inc.php");
include("lib/lib.inc2.php"); 


/*
 * Select tabla usuario
 * 
 */

echo "<table   border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
    
	";
$query= "SELECT id_usuario,nombre,paterno,email,login  
           FROM  usuario
           WHERE  id_perfil= 1047";
     $result_usuario= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($id_usuario,$nombre,$paterno,$email,$login) = mysql_fetch_row($result_usuario)){
			echo "<tr><td >$id_usuario</td><td >$nombre</td><td >$paterno</td><td >$email</td><td >$login</td></tr>";			   
		 }
/** fin select usuario***/
echo "</table>";
?>