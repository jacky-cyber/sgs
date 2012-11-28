<?php
$id_receptor = $HTTP_GET_VARS['id_receptor'];

 $Sql ="DELETE FROM mailing_receptores where id_receptor=$id_receptor";
  cms_query($Sql);
 header("Location:$PHP_SELF?accion=$accion&act=3030");
  
?>