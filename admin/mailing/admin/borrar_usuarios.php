<?php
$tipo = $HTTP_GET_VARS['tipo'];
$id_usuario = $HTTP_GET_VARS['id_usuario'];


 $Sql ="DELETE FROM mailing_usuario
        WHERE id_usuario='$id_usuario'";
  cms_query($Sql);
  
   header("Location:$PHP_SELF?accion=$accion&act=3010&tipo=$tipo&act_all=1");

?>