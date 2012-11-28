<?php
$id = $_GET['id'];

$Sql ="UPDATE noticia_plantilla
	   SET defecto =0";

 cms_query($Sql)or die (error($Sql,mysql_error(),$php));
	   
	   
	   
$Sql ="UPDATE noticia_plantilla
	   SET defecto =1
	   WHERE id_plantilla_noticia ='$id'";

 cms_query($Sql)or die (error($Sql,mysql_error(),$php));

?>