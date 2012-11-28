<?php




$datos= array();
/*
 * Select tabla estadisticas_acciones
 * 
 */
$query= "SELECT  id_estadistica,tiempo,online
           FROM  estadisticas_acciones
           ORDER BY id_estadistica
           LIMIT 0,10";
     $result_estadisticas_accion= mysql_query($query)or die (mysql_error());
     
     while (list($id_estadistica,$tiempo,$online) = mysql_fetch_row($result_estadisticas_accion)){
			
			$datos[] = array(
                                         "id_estadistica" => $id_estadistica,
                                         "tiempo" => $tiempo,
                                         "online" => $online
                                        );
			
                       
                       
                        
                         }
/** fin select estadisticas_acciones***/


	echo '' . json_encode($datos) . '';
        
        

        
?>