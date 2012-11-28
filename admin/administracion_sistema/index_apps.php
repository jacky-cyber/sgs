<?php
//index_apps_php

$id_apps = $_GET['id_apps'];


$id_sesion = session_id();
$id_perfil = perfil($id_sesion);




  $query= "SELECT ap.apps   
           FROM  auto_admin_apps ap,auto_admin_apps_permisos app
           WHERE ap.id_apps= app.id_apps
  		   AND app.id_perfil=$id_perfil
           AND ap.id_apps=$id_apps";
 
 //echo $query;
     $result_2= cms_query($query)or die (error($query,mysql_error(),$php));
      while(list($apps) = mysql_fetch_row($result_2)){
      	
    //
           
					
      	
      	
      	$query= "SELECT id_auto_admin
				FROM acciones
				WHERE accion='$accion'";
    	
			$result= cms_query($query)or die (error($query,mysql_error(),$php));
			list($id_auto_admin) = mysql_fetch_row($result);



$nom_tabla =tabla($id_auto_admin);


$ruta= "images/sitio/sistema/$nom_tabla/auto_admin_apps/$apps";


if(!is_file($ruta)){



include("desarrollo.php");	
}else{
	include("$ruta");
}



      	
      }  		   
		 


?>