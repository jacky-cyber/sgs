<?php


  $query= "SELECT id_grupo  
           FROM  acciones
           WHERE accion='$id'";
  
//  echo"$query<br>";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
     list($id_grupo) = mysql_fetch_row($result);
     
     

 $Sql ="DELETE FROM acciones
        WHERE accion='$id'";

 cms_query($Sql);
 
  $Sql ="DELETE FROM accion_perfil
        WHERE accion='$id'";

 cms_query($Sql);
  
  
  header("Location:$PHP_SELF?accion=$accion&id_gru=$id_grupo");

?>