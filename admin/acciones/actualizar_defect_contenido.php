<?php

$id = $_GET['id'];
$id_accion_contenido=$_GET['id_accion_contenido'];

$Sql ="UPDATE accion_contenido
	   SET defecto ='0'
	   WHERE accion='$id'";

 cms_query($Sql)or die (error($query,mysql_error(),$php));
	   
	   
$Sql2 ="UPDATE accion_contenido
	   SET defecto ='1'
	   WHERE id_accion_contenido='$id_accion_contenido'";

 cms_query($Sql2)or die (error($query,mysql_error(),$php));
	   
	      
header("Location:index.php?accion=$accion&act=11&id_gru=$id_gru&id=$id");

?>