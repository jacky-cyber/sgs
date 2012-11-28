<?php

$nombre_app=$_POST["nombre_app2"];
$desc_app=$_POST["desc_app2"];
$estado_app=$_POST["estado_app2"];
$id_app=$_POST["id_app"];
//$fecha_ingreso=fechas_bd($_POST["fecha_ingreso"]);
$qry_insert="UPDATE deuman_app_desarrollo  SET nombre_app='$nombre_app'
					   ,descripcion_app='$desc_app'
					   ,estado_app=$estado_app
			 WHERE id=$id_app
			 AND id_desarrollador=$id_usuario 
			 ";
					   
					  
$result_insert=cms_query($qry_insert) or die (error($qry_insert,mysql_error(),$php));

	
?>