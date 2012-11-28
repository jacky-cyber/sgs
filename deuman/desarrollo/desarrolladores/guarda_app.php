<?php

$nombre_app=$_POST["nombre_app"];
$desc_app=$_POST["desc_app"];
$estado_app=1;
//$fecha_ingreso=fechas_bd($_POST["fecha_ingreso"]);

$fecha_= new DateTime();
$fecha_= $fecha_->format('Y-m-d h:i:s A');
$token=$fecha_;
$token.=rand();
if($desc_app=="")
	$desc_app="sin descripci&oacute;n";

$qry_insert="INSERT INTO deuman_app_desarrollo(nombre_app,descripcion_app,fecha_creacion_app,estado_app,id_desarrollador,token_app) 
			  values ('$nombre_app','$desc_app',NOW(),$estado_app,$id_usuario,md5('$token'))";
echo $qry_insert;
$result_insert=cms_query($qry_insert) or die (error($qry_insert,mysql_error(),$php));

	
?>