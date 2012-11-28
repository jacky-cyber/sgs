<?php
//update formulario

$Sql ="UPDATE auto_admin 
	   SET formulario ='$formulario'
	   WHERE id_auto_admin ='$id_auto_admin'";
	//echo "$Sql";

 cms_query($Sql)or die (error($query,mysql_error(),$php));
                
      
                
 
?>