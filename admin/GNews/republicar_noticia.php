<?php
$id_noticia = $_GET['id_noticia'];


$fecha = date(Y)."-".date(m)."-".date(d);

$Sql ="UPDATE noticias   
 	   SET fecha_publicacion ='$fecha'
 	   WHERE id_noticia ='$id_noticia'";
 				  
 	   cms_query($Sql)or die ("ERROR $php <br>$Sql");



    header("Location:index.php?accion=$accion&act=2&id_contenido=$id_noticia");
	
?>