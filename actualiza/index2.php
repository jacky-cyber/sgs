<?php

include("../lib/connect_db.inc.php");    


  $Sql ="DELETE FROM acciones WHERE php='actualiza/actualiza.php'";
  cms_query($Sql)or die ("ERROR $php <br>$Sql");
  
  $Sql ="DELETE FROM accion_perfil WHERE accion='54800'";
  cms_query($Sql)or die ("ERROR $php <br>$Sql");
  
  $Sql ="DELETE FROM cms_configuracion WHERE configuracion='en_mantencion'";
  cms_query($Sql)or die ("ERROR $php <br>$Sql");
  

$qry_insert="INSERT IGNORE INTO acciones VALUES (1901, 54800, 0, 'actualiza/actualiza.php', 'Actualizaci&oacute;n Sistema', '', 'Actualizacion-Sistema', 'si', '', 999, 0, 0, 0, '', 0, 0, '', 0, '', 0, 3, 0)";
              
$result_insert=cms_query($qry_insert);

$qry_insert="INSERT IGNORE INTO accion_perfil VALUES (999, 54800, 0, 0)";
$result_insert=cms_query($qry_insert)or die ("ERROR $php <br>$qry_insert");

$qry_insert="INSERT IGNORE INTO accion_perfil VALUES (1004, 54800, 0, 0)";
$result_insert=cms_query($qry_insert)or die ("ERROR $php <br>$qry_insert");

$qry_insert="INSERT IGNORE INTO cms_configuracion(id_configuracion,configuracion,valor,descripcion,publico,orden,txt,obligatorio) 
			 VALUES (null, 'en_mantencion', '0', '<p>Con esta variable se podra detener el sitio y sera mostrada la p&aacute;gina de Mantenci&oacute;n</p>', 0, 65, 0, 0)";
$result_insert=cms_query($qry_insert)or die ("ERROR $php <br>$qry_insert");




header("Location:../index.php?accion=Actualizacion-Sistema");



?>