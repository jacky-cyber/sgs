<?php


 $criterio_get = $_GET['criterio'];
 
 $aux_get=explode(",", $criterio_get);
 $criterio_txt = $aux_get[0];
 $criterio_id = $aux_get[1];
 
 $tipo = $_GET['tipo'];

  //echo "$tipo#$criterio_txt#$criterio_id";

 $_SESSION['criterios_sess'] .="$tipo#$criterio_txt#$criterio_id,";

 //$criterios_sess = $_SESSION['criterios_sess'];



include("sgs/estadisticas_opcionales/lista_criterios_ajax.php");

 $contenido = $lista_criterios_ajax;
 
 
 
 
?>