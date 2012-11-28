<?php
include("../../lib/connect_db.inc.php");

// Array que vincula los IDs de los selects declarados en el HTML con el nombre de la tabla donde se encuentra su contenido
$listadoSelects=array(
"id_entidad_padre"=>"sgs_entidad_padre",
"id_entidad"=>"sgs_entidades"
);



$selectDestino=$_GET["select"]; 
$opcionSeleccionada=$_GET["opcion"];


	$tabla=$listadoSelects[$selectDestino];

	$consulta=cms_query("SELECT id_entidad, entidad FROM sgs_entidades WHERE id_entidad_padre='$opcionSeleccionada'") or die(mysql_error());
	
		
	// Comienzo a imprimir el select
	echo "<select name='".$selectDestino."' class='combo' id='".$selectDestino."' onChange=\"validaCombos();\" >";
	echo "<option value='0'>Seleccione...</option>";
	while($registro=mysql_fetch_row($consulta))
	{
		// Convierto los caracteres conflictivos a sus entidades HTML correspondientes para su correcta visualizacion
		//$registro[1]=htmlentities($registro[1]);
		//$registro[1]=acentos_inverso($registro[1]);
		// Imprimo las opciones del select
		echo "<option value='".$registro[0]."'>".$registro[1]."</option>";
	}			
	echo "</select>";



?>