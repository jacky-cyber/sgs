<?php

$id_auto_admin = $_GET['id_auto_admin'];


/*
 * Select tabla auto_admin
 * 
 */
$query= "SELECT control_version  
           FROM  auto_admin
           WHERE id_auto_admin = '$id_auto_admin'";
     $result_auto_admin= cms_query($query)or die (error($query,mysql_error(),$php));
      list($control_version) = mysql_fetch_row($result_auto_admin);
      
      
/** fin select auto_admin***/


if($control_version==1){
    $Sql ="UPDATE auto_admin
 	   SET control_version='0'
 	   WHERE id_auto_admin ='$id_auto_admin'";
 				  
 	   cms_query($Sql)or die ("ERROR $php <br>$Sql");
           
        $contenido="<img style=\"cursor: pointer;  cursor: hand;\" onclick=\"ObtenerDatos('index.php?accion=$accion&act=19&id_auto_admin=$id_auto_admin&axj=1','v_$id_auto_admin');\" src=\"images/ciculo_warring.gif\" border=\"0\" alt=\"\">
						";
    
}else{
     $Sql ="UPDATE auto_admin
 	   SET control_version='1'
 	   WHERE id_auto_admin ='$id_auto_admin'";
 				  
 	   cms_query($Sql)or die ("ERROR $php <br>$Sql");
           
        $contenido="<img style=\"cursor: pointer;  cursor: hand;\" onclick=\"ObtenerDatos('index.php?accion=$accion&act=19&id_auto_admin=$id_auto_admin&axj=1','v_$id_auto_admin');\" src=\"images/ciculo_ok.gif\" border=\"0\" alt=\"\">";
 
    
}


?>