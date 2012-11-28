<?php

$id_apps_permisos = $_GET['id_apps_permisos'];
$id_apps = $_GET['id_apps'];


 $Sql ="DELETE FROM auto_admin_apps_permisos where id_apps_permisos=$id_apps_permisos";

 cms_query($Sql)or die (error($Sql,mysql_error(),$php));

?>