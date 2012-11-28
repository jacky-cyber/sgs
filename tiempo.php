<?php
include("lib/connect_db.inc.php");
 

/*
 * Select tabla estadisticas_accion
 * 
 */


$query= "SELECT id_estadistica,tiempo  
           FROM  estadisticas_acciones
           ORDER BY id_estadistica desc";
     $result_estadisticas_accion= mysql_query($query);
      list($id_estadistica,$tiempo) = mysql_fetch_row($result_estadisticas_accion);




      echo $tiempo;
/** fin select estadisticas_accion***/
        
?>