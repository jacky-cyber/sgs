<?php

	  $query= "SELECT max(accion)  
	           FROM  acciones";
	     $result= cms_query($query)or die (error($query,mysql_error(),$php));
	      list($tot_accion) = mysql_fetch_row($result);
							   
		$new_accion = $tot_accion +1;

	  $query= "SELECT id_acc   
	           FROM  acciones
	           WHERE accion='$new_accion'";
	// echo "$query<br>";
	  
	     $result= cms_query($query)or die (error($query,mysql_error(),$php));
	     if (!list($id_acc) = mysql_fetch_row($result)){
		 
		   $descrip_url = friendlyURL($descrip_php);
		   $descrip_php= trim($descrip_php);
			$qry_insert="INSERT INTO acciones(id_acc,accion,php,descrip_php_esp,descrip_url,descrip_php_eng,home,icono,id_grupo,id_tipo ,id_contenido,id_auto_admin,publica_noticia,help,presente,etiqueta,id_templates,opcion,id_tipo_noticia)
             values ('','$new_accion','$php','$descrip_php','$descrip_url','$descrip_php','$home','','$id_grupo','$id_tipo','$id_contenido','$id_tabla','$publica_noticia','$help','$presente','$etiqueta','$id_templates','$opcion','$id_tipo_noticia')";
			//echo "$qry_insert <br>";
			$qry_insert= acentos($qry_insert);
			
			$result_insert=mysql_query($qry_insert) or die("$MSG_DIE - QR-Problemas al insertar $qry_insert");	
				
			$id_ac= mysql_insert_id();	
				
			    $query= "SELECT id_perfil  
           			     FROM  usuario_perfil";
     			 $result= cms_query($query)or die (error($query,mysql_error(),$php));
      			 while (list($id_perfil2) = mysql_fetch_row($result)){
       				
					
					
      			 	$var = "perfil_$id_perfil2";
       				if(isset($_POST[$var])){
       					$qry_insert="INSERT INTO accion_perfil(id_perfil,accion,act)
             				         values ('$id_perfil2','$new_accion','$new_act')";
						 $result_insert=cms_query($qry_insert) or die("$MSG_DIE - QR-Problemas al insertar $qry_insert");	
						  if($cascada!=""){
							marca_arbol($id_per,$acc);
				  			}
						
						if($id_tabla!=""){
				
                		$qry_insert="INSERT INTO auto_admin_permisos(id_auto_admin_permisos,id_auto_admin,id_perfil,ordenar,listar,ver,editar,crear,borrar,configurar)  
							values (null,'$id_tabla','$id_perfil2','1','1','1','1','1','1','1')";
                              
                                $result_insert=cms_query($qry_insert) or die("$MSG_DIE $php - QR-Problemas al insertar qry_insert");
				
						}
						
							
							
       				}
       	         
      			  }
			  
			  
			 
      			//  header("HTTP/1.0 307 Temporary redirect");
				$url ="?accion=$accion&id=$id_ac&act=17&opcion=$opcion&id_gru=no";	
			       header("Location:$url");  
      			  
      			  
			 }else{
			 	// header("HTTP/1.0 307 Temporary redirect");
 				 header("Location:$PHP_SELF?accion=$accion&id_gru=$id_grupo&msg=1");
			 	
			 }

 




 
 

?>