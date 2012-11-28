<?php

$campo = $_GET['campo'];
$id_permiso = $_GET['id_permiso'];	//es el id del id_auto_admin_permisos
$id_perfil_usuario = $_GET['id_perfil_usuario'];
	
//	$permiso = verfica_permiso($id_auto_admin,$id_perfil_usuario,$campo);



$query= "SELECT $campo
               FROM  auto_admin_permisos
               WHERE id_auto_admin_permisos='$id_permiso'";
   //echo "$query<br>";  
     
         $result22= cms_query($query)or die (error($query,mysql_error(),$php));
      list($respuesta_campo_permiso) = mysql_fetch_row($result22);
	
	//echo "$respuesta_campo_permiso";
	//echo "$id_auto_admin,$id_permiso,$campo";
	
	
	if ($respuesta_campo_permiso==0){
		$respuesta_campo_permiso=1;
		
	}elseif($respuesta_campo_permiso==1){
		$respuesta_campo_permiso=0;
	}


$Sql ="UPDATE auto_admin_permisos 
	   SET $campo= '$respuesta_campo_permiso'
	   WHERE id_auto_admin_permisos='$id_permiso'";

	//echo "$Sql";

 cms_query($Sql)or die (error($Sql,mysql_error(),$php));


	
?>