<?php
//insertar aplicacion


$ico_apps_name= $HTTP_POST_FILES['ico_apps']['name'];
$ico_apps= $HTTP_POST_FILES['ico_apps']['tmp_name'];



$query= "SELECT id_auto_admin 
           FROM  acciones
           WHERE accion='$accion'";

     $result= cms_query($query)or die (error($query,mysql_error(),$php));
    list($id_auto_admin) = mysql_fetch_row($result);


$qry_insert="INSERT INTO auto_admin_apps (id_apps,apps,nom_apps,ico_apps,accion,id_auto_admin,autor,fecha,orden)
 values (null,'$apps','$nom_apps','$ico_apps_name','$accion','$id_auto_admin','$autor','$fecha','$orden')";          


                mysql_query($qry_insert) or die("$MSG_DIE - QR-Problemas al insertar qry_insert");
              
              $id_apps = mysql_insert_id();
                
                  
$nom_tabla =tabla($id_auto_admin);


						$ruta= "images/sitio/sistema";
					 //	$ruta_apps= "auto_admin_apps/ico_apps";
					 	
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


					 	if ($ico_apps!=""){

                      $imagen2 = ereg_replace('&','*',$ico_apps_name);
				      $imagen2 = ereg_replace(' ',':',$imagen2);

					   if (!copy($ico_apps, "$ruta/$nom_tabla/auto_admin_apps/ico_apps/$imagen2"))
						     {

					         echo "Fallo, La imagen chica no se a podido subir al servidor. <br>";
					         echo "La imagen chica no exixte o es muy grande.<br>
							 imagen temp: $imagen<br> imagen nombre : $imagen_name";

					         }
                      }
	 


?>