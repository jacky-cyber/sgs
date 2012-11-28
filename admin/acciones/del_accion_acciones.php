<?php

$acc_del = $_GET['acc_del'];

 $Sql ="DELETE FROM accion_acciones where acciones= $acc_del and accion= $id";

 cms_query($Sql)or die (error($query,mysql_error(),$php));


?>