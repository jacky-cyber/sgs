<?php

$id = $_GET['id'];
$id_contenido= $_GET['id_noticia'];
$id_gru= $_GET['id_gru'];
$id_accion_contenido=$_GET['id_accion_contenido'];

 $Sql ="DELETE FROM accion_contenido
 		WHERE id_accion_contenido=$id_accion_contenido";
 
 //echo "$Sql";

 cms_query($Sql)or die (error($query,mysql_error(),$php));


 header("Location:index.php?accion=$accion&act=11&id_gru=$id_gru&id=$id");
 
?>