<?php


 

 $Sql ="DELETE FROM accion_etiquetas
        WHERE accion='$id'";
 
 //echo "$Sql";
  //cms_query($Sql);
 
  
  
  
  header("Location:$PHP_SELF?accion=$accion&id_gru=$id_grupo");

?>