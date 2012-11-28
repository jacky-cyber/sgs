<?php

//cambia foto principal galeria
$id_imagen = $_GET['id_imagen'];


  $query= "SELECT imagen1    
           FROM  imagenes
           WHERE id_imagen='$id_imagen'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
     list($imagen) = mysql_fetch_row($result);
	 

$Sql ="UPDATE galerias 
	   SET imagen ='$imagen'
	   WHERE id_galeria ='$id_galeria'";

 cms_query($Sql)or die (error($Sql,mysql_error(),$php));
	 
       header("Location:index.php?accion=$accion&act=3&id_galeria=$id_galeria");

?>