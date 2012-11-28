<?php

$id_apps = $_GET['id_apps'];

  $query= "SELECT id_apps,apps,nom_apps,ico_apps,accion,id_auto_admin,autor,fecha,orden   
           FROM  auto_admin_apps
           WHERE id_apps=$id_apps";
 // echo $query;

     $result= cms_query($query)or die (error($query,mysql_error(),$php));
     list($id_apps_ap,$apps,$nom_apps,$ico_apps,$accion,$id_auto_admin,$autor,$fecha,$orden) = mysql_fetch_row($result);
     
     
     
     /*  $query= "SELECT id_apps_permisos,id_apps,id_perfil  
                FROM  auto_admin_apps_permisos
                WHERE id_apps=$id_apps";
      // echo $query;

          $result4= cms_query($query)or die (error($query,mysql_error(),$php));
          list($id_apps_permisos,$id_apps,$id_perfil) = mysql_fetch_row($result4);*/
?>