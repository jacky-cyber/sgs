<?php

$id_apps = $_GET['id_apps'];
     
     $query= "SELECT id_auto_admin 
           FROM  acciones
           WHERE accion='$accion'";
//echo $query;
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
    list($id_auto_admin) = mysql_fetch_row($result);
     
     $nom_tabla =tabla($id_auto_admin);
     
     
     
     
     $query= "SELECT ico_apps
           FROM  auto_admin_apps
           WHERE id_apps=$id_apps";  

     $result5= cms_query($query)or die (error($query,mysql_error(),$php));
     list($ico_apps) = mysql_fetch_row($result5);
     
     
     
          if($ico_apps!=""){
            	$ruta= "images/sitio/sistema";
				$link ="$ruta/$nom_tabla/auto_admin_apps/ico_apps/$ico_apps";
				
				
				
				  if(is_file($link)){				
			
			    unlink($link);					  
				 
				 }
			 
			}
     
    


 $Sql_1 ="DELETE 
        FROM auto_admin_apps
        WHERE id_apps=$id_apps";
 //echo $Sql;

 cms_query($Sql_1);
  
  
   $Sql ="DELETE 
          FROM  auto_admin_apps_permisos
          WHERE id_apps=$id_apps";

 cms_query($Sql);
    
    

?>