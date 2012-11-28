<?php

$id_permiso = $_GET['id_permiso'];


    $query= "SELECT id_perfil   
           FROM  auto_admin_permisos
           WHERE id_auto_admin_permisos=$id_permiso";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
     list($id_perfil2) = mysql_fetch_row($result);
	 
	    $query= "SELECT count(*) 
               FROM  auto_admin_permisos
               WHERE id_auto_admin='$id_auto_admin' and id_perfil = '$id_perfil2'";
         $result= mysql_query($query)or die (error($query,mysql_error(),$php));
        list($tot_permisos) = mysql_fetch_row($result);
		
	 if($tot_permisos==1){
		 if(perfil($id_sesion)!=$id_perfil2){
		
				$Sql ="DELETE FROM auto_admin_permisos
 						WHERE id_auto_admin_permisos='$id_permiso'";
 				
				cms_query($Sql) or die (error($query,mysql_error(),$php));

			}
	 }else{
	 	$Sql ="DELETE FROM auto_admin_permisos
 						WHERE id_auto_admin_permisos='$id_permiso'";

				cms_query($Sql) or die (error($query,mysql_error(),$php));

	 }
	
 
	header("Location:index.php?accion=$accion&act=8");
?>