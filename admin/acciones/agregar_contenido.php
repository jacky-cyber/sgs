<?php

$id = $_GET['id'];
$id_contenido= $_GET['id_noticia'];
$id_gru= $_GET['id_gru'];


	$qry_insert="INSERT INTO accion_contenido ( id_accion_contenido,accion,id_contenido)
 					values (null,'$id','$id_contenido')";
              
	//echo "$qry_insert";
	
                $result_insert=cms_query($qry_insert)  or die("$MSG_DIE - QR-Problemas al insertar $qry_insert");



header("Location:index.php?accion=$accion&act=11&id_gru=$id_gru&id_noticia=$id_contenido_accion&id=$id");
?>