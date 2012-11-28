<?php

  $query= "SELECT accion
           FROM  acciones
           WHERE id_acc='$id'";
  //echo $query."<br>";
     $result_p= cms_query($query)or die (error($query,mysql_error(),$php));
     list($new_accion) = mysql_fetch_row($result_p);
 
  $descrip_url = friendlyURL($descrip_php);
 


 if($php==""){
 
   $query= "SELECT php   
            FROM  acciones
            WHERE id_acc='$id'";
      $result= cms_query($query)or die (error($query,mysql_error(),$php));
       list($php) = mysql_fetch_row($result);
	   
 
 }
 $_POST['descrip_php_esp']=$descrip_php;
 $_POST['descrip_url']=$descrip_url;
 $_POST['id_tipo']=$id_tipo_f;
 $_POST['accion']=$new_accion;
 $_POST['id_auto_admin']=$id_tabla;
 $_POST['php']=$php;
 
 update('acciones',$id);
 /*
$Sql ="UPDATE acciones
	   SET accion ='$new_accion',
	   php ='$php',
	   descrip_php_esp='$descrip_php',
	   descrip_url='$descrip_url',
	   descrip_php_eng='$descrip_php',
	   home='$home',
	   icono='$icono',
	   id_grupo='$id_grupo',
	   id_tipo ='$id_tipo_f',
	   id_contenido='$id_contenido',
	   id_auto_admin='$id_tabla',
	   publica_noticia='$publica_noticia',
	   help='$help',
	   etiqueta='$etiqueta',
	   id_templates='$id_templates',
	   presente='$presente',
	   id_tipo_noticia='$id_tipo_noticia'
	   WHERE id_acc ='$id'";
	   */
	//echo $Sql;			  
	  // cms_query($Sql)or die (error($query,mysql_error(),$php));
	   
	   
	   
	    $Sql ="DELETE FROM accion_perfil WHERE accion='$new_accion'";

 cms_query($Sql);
		 
		 
	   $query= "SELECT id_perfil  
           			     FROM  usuario_perfil";
     			 $result= cms_query($query)or die (error($query,mysql_error(),$php));
      			 while (list($id_perfil2) = mysql_fetch_row($result)){
       				
					
					
					
					
      			 	$var = "perfil_$id_perfil2";
					$var_perf= $_POST[$var];
       				if($var_perf!=""){
       					$qry_insert="INSERT INTO accion_perfil(id_perfil,accion,act)
             				         values ('$id_perfil2','$new_accion','$new_act')";
						 $result_insert=cms_query($qry_insert) or die("$MSG_DIE - QR-Problemas al insertar $qry_insert");	
						 
						 
						 if($id_tabla!=""){
				
                		$qry_insert="INSERT INTO auto_admin_permisos(id_auto_admin_permisos,id_auto_admin,id_perfil,ordenar,listar,ver,editar,crear,borrar,configurar)  
							values (null,'$id_tabla','$id_perfil2','1','1','1','1','1','1','1')";
                              
                                $result_insert=cms_query($qry_insert) or die("$MSG_DIE $php - QR-Problemas al insertar qry_insert");
				
						}
						 
       				}
			}
	  
			
			
header("Location:index.php?accion=$accion&id_gru=$id_grupo");

?>