<?php
//agregar
 
//echo "hola";

$id_perfil_us = $_GET['id_perfil_us'];
$id_apps = $_GET['id_apps'];

	$qry_insert="INSERT INTO auto_admin_apps_permisos (id_apps_permisos,id_apps,id_perfil)
 					values (null,'$id_apps','$id_perfil_us')";
              

	
                $result_insert=cms_query($qry_insert)  or die("$MSG_DIE - QR-Problemas al insertar $qry_insert");





?>