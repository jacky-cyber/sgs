<?php

include("../../lib/connect_db.inc.php");
include("../../lib/lib.inc.php");
include("../../lib/lib.inc2.php");

include("../../lib/seguridad.inc.php");



$tabla = "sgs_estado_solicitudes";
// Array que vincula los IDs de los selects declarados en el HTML con el nombre de la tabla donde se encuentra su contenido
$listadoSelects=array(
"id_estado_solicitud"=>"select_1",
"id_etapas"=>"select_2"
);

function validaSelect($selectDestino)
{
	// Se valida que el select enviado via GET exista
	global $listadoSelects;
	if(isset($listadoSelects[$selectDestino])) return true;
	else return false;
}

function validaOpcion($opcionSeleccionada)
{
	// Se valida que la opcion seleccionada por el usuario en el select tenga un valor numerico
	if(is_numeric($opcionSeleccionada)) return true;
	else return false;
}

$selectDestino=$_GET["select"]; 
$opcionSeleccionada=$_GET["opcion"];

if(validaSelect($selectDestino) && validaOpcion($opcionSeleccionada))
{
	$tabla=$listadoSelects[$selectDestino];

	//$consulta=cms_query("") or die(mysql_error());
	  $query= "SELECT id_estado_solicitud,estado_solicitud 
	  FROM sgs_estado_solicitudes 
	  WHERE id_estado_padre ='$opcionSeleccionada' and id_estado_solicitud != id_estado_padre";
         $consulta= cms_query($query)or die (error($query,mysql_error(),$php));
        //and id_estado_solicitud<> '$opcionSeleccionada'  
		
	// Comienzo a imprimir el select
	echo "<select name='id_etapas' id='id_etapas' >";
	echo "<option value='0'>Seleccione un Estado</option>";
	while($registro=mysql_fetch_row($consulta))
	{
		//$registro[1] =cambio_texto($registro[1]);
		echo "<option value='".$registro[0]."'>".$registro[1]."</option>";
	}			
	echo "</select>";

}
?>