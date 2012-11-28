<?php
$id_app=$_POST["id_app"];
$nombre_app=$_POST["nombre_app"];
$desc_app=$_POST["desc_app"];
$estado_app=$_POST["estado_app"];



$query= "	SELECT nombre_app,descripcion_app,estado_app
	        FROM  deuman_app_desarrollo
	        WHERE id=$id_app
			AND id_desarrollador=$id_usuario	
		 ";
$result= cms_query($query)or die (error($query,mysql_error(),$php));
//echo $query;
list($nombre_app,$descripcion_app,$estado_app) = mysql_fetch_row($result);

exit(json_encode(array("nombre_app"=>$nombre_app,"descripcion_app"=>$descripcion_app,"estado_app"=>$estado_app)));



	
?>