<?php

$id_apps = $_GET['id_apps']; 
  
  
  
$ico_apps_name= $HTTP_POST_FILES['ico_apps']['name'];
$ico_apps= $HTTP_POST_FILES['ico_apps']['tmp_name'];



  $query= "SELECT ico_apps
           FROM  auto_admin_apps
           WHERE id_apps='$id_apps'";
 // echo $query;

     $resultins= cms_query($query)or die (error($query,mysql_error(),$php));
     list($ico_apps_r) = mysql_fetch_row($resultins);
     
     


$query= "SELECT id_auto_admin 
           FROM  acciones
           WHERE accion='$accion'";

     $result= cms_query($query)or die (error($query,mysql_error(),$php));
    list($id_auto_admin) = mysql_fetch_row($result);
    
    
    
    $Sql ="UPDATE auto_admin_apps
	   SET id_apps='$id_apps',apps='$apps',nom_apps='$nom_apps',ico_apps='$ico_apps_name',accion='$accion',id_auto_admin='$id_auto_admin',autor='$autor',fecha='$fecha',orden='$orden'
	   WHERE id_apps='$id_apps'";

 cms_query($Sql)or die (error($query,mysql_error(),$php));

               
$nom_tabla =tabla($id_auto_admin);

if($ico_apps_name!=""){

		$ruta= "images/sitio/sistema";					
					 	
					 	if(!is_dir("$ruta/$nom_tabla")){
					 		
					 		@mkdir("$ruta/$nom_tabla",0777);
					 		@chmod("$ruta/$nom_tabla",0777);
					 		
					 	}
					 	
					 	
						if(!is_dir("$ruta/$nom_tabla/auto_admin_apps")){
					 		
					 		@mkdir("$ruta/$nom_tabla/auto_admin_apps",0777);
					 		@chmod("$ruta/$nom_tabla/auto_admin_apps",0777);
					 		
					 	}

						if(!is_dir("$ruta/$nom_tabla/auto_admin_apps/ico_apps")){
					 		
					 		@mkdir("$ruta/$nom_tabla/auto_admin_apps/ico_apps",0777);
					 		chmod("$ruta/$nom_tabla/auto_admin_apps/ico_apps",0777);
					 		
					 	}


					 	if (isset($ico_apps)){

                      $imagen2 = ereg_replace('&','*',$ico_apps_name);
				      $imagen2 = ereg_replace(' ',':',$imagen2);

					   if (!copy($ico_apps, "$ruta/$nom_tabla/auto_admin_apps/ico_apps/$imagen2"))
						     {

					         echo "Fallo, La imagen chica no se a podido subir al servidor. <br>";
					         echo "La imagen chica no exixte o es muy grande.<br>
							 imagen temp: $imagen<br> imagen nombre : $imagen_name";

					         }
							 if(is_file("$ruta/$nom_tabla/auto_admin_apps/ico_apps/$ico_apps_r")){
							  unlink("$ruta/$nom_tabla/auto_admin_apps/ico_apps/$ico_apps_r");
							 }
							
                      } 

}
				



?>