<?php

if($id_est!=""){
 $Sql ="DELETE FROM usuario_establecimientos
 		WHERE id_usuario=$id_user and id_establecimiento=$id_est";

 cms_query($Sql)or die (error($Sql,mysql_error(),$php));
  
  }


if($id_perf!=""){
 $Sql ="DELETE FROM usuario_perfiles where id_perfil = $id_perf and id_usuario=$id_user";

 cms_query($Sql)or die (error($Sql,mysql_error(),$php));
}


header("HTTP/1.0 307 Temporary redirect");
header("Location:index.php?accion=$accion&act=1&id_user=$id_user");


?>