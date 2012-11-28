<?php

$id_perfil_u = $_GET['id_perfil_u'];
   
   
    $query= "SELECT id_auto_admin_permisos
           FROM  auto_admin_permisos
           WHERE id_auto_admin='$id_auto_admin' and id_perfil='$id_perfil_u'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
     if(!list($id) = mysql_fetch_row($result)){
						   
		
	$qry_insert="INSERT INTO auto_admin_permisos (id_auto_admin_permisos,id_auto_admin,id_perfil,ordenar,listar,ver,editar,crear,borrar,configurar)
 					values (null,'$id_auto_admin','$id_perfil_u','0','1','1','0','0','0','0')";
         $result_insert=cms_query($qry_insert)  or die("$MSG_DIE - QR-Problemas al insertar $qry_insert");

 }

?>