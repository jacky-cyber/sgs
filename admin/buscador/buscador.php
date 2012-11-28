<?php

if ($_POST['volver']=="volver")
{
	$tabla = $_POST['tabla'];
	for($contar = 0; $contar < sizeof($tabla); $contar++)
	{
		$Sql = "select tabla from tab_busqueda where tabla = '".$tabla[$contar]."'";
		$result = cms_query($Sql) or die("$MSG_DIE - No Resulto $Sql");
		list($tabla_accion) = mysql_fetch_row($result);
		
		if ($tabla_accion != $tabla[$contar])
		{
			$qry_insert = "insert into tab_busqueda (tabla) VALUES ('".$tabla[$contar]."')";
			$result_insert = cms_query($qry_insert) or die("$MSG_DIE - QR-Problemas al insertar $qry_insert");
		}
	} 
}

include("tablas.php");

$eleccion = $_POST['btn'];
 
switch ($eleccion)
{	
	case "Elegir":
		include("mastablas.php");
	break;	
	case "campos":
	
		$Sql = "select tabla from tab_busqueda";
		$result = cms_query($Sql) or die("$MSG_DIE - No Resulto $Sql");
		
		$i = 0;
		while (list($tabla_accion) = mysql_fetch_row($result))
		{ 
			$i = $i + 1;
			$accion = $_POST[$tabla_accion];

			$qry_update = "update tab_busqueda set accion = '".$accion."' where tabla = '".$tabla_accion."'";

 cms_query($qry_update) or die("$MSG_DIE - QR-Problemas al actualizar $qry_update");
		}
		
		$columna = $_POST['columna'];
	
		$qry_d = "delete from tab_camp";

 cms_query($qry_d) or die("$MSG_DIE - QR-Problemas al insertar $qry_d");
	
		for($contar = 0; $contar < sizeof($columna); $contar++)
		{
			$elements = explode("-", $columna[$contar]);
			$tabla = $elements[0];
			$campo = $elements[1];
		
			$qry_insert = "insert into tab_camp (tabla, campo) VALUES ('".$tabla."', '".$campo."')";
			$result_insert = cms_query($qry_insert) or die("$MSG_DIE - QR-Problemas al insertar $qry_insert"); 	
		}
		$contenido = "<br /><br /><br /><div alig='center'>Tablas para la Busqueda Escojidas</div>";
	break;
}
?> 




  

