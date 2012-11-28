<?php
//voy a actualizar los usuarios
$id_user = $_GET['id_user'];
$id_empresa_u = $_POST['id_empresa_u'];
$nombre_u = $_POST['nombre_u'];
$apellido_u = $_POST['apellido_u'];
$login_u = $_POST['login_u'];
$email_u = $_POST['email_u'];
$password_u = $_POST['password_u'];
$id_empresa_u = $_POST['id_empresa_u'];
$direccion_u = $_POST['doreccion_u'];
$id_perfil_u = $_POST['id_perfil_u'];





  $query= "SELECT login, password
           FROM  usuario
           WHERE login='$login_u' and id_usuario <> '$id_user'";
           $result= cms_query($query)or die (error($query,mysql_error(),$php));
        if(!list($login, $password) = mysql_fetch_row($result)){
        	
        	if($id_perfil==3){
        		 if($password_u!=""){
	   	
	   					$password_u = md5($password_u);
	   	
	   						$Sql ="UPDATE usuario 
	  							   SET id_empresa='$id_empresa_u',nombre='$nombre_u',apellido='$apellido_u',
	  							   login='$login_u',email='$email_u',password='$password_u',id_perfil='$id_perfil_u',
								   celular='$celular_u',equipo='$equipo_u'
	  							   WHERE id_usuario ='$id_user'";

 cms_query($Sql)or die (error($Sql,mysql_error(),$php));
	   	
          	       }else{
        	
            				$Sql ="UPDATE usuario 
	  							   SET id_empresa='$id_empresa_u',nombre='$nombre_u',apellido='$apellido_u',email='$email_u',
								   celular='$celular_u',equipo='$equipo_u'
	  							   WHERE id_usuario ='$id_user'";

 cms_query($Sql)or die (error($Sql,mysql_error(),$php));	
           	
                     }    
                    
	         }elseif ($id_perfil==1){
	         	
	         	  $query= "SELECT id_perfil 
	         	           FROM  usuario
	         	           WHERE id_usuario='$id_user'";
	         	     $result= cms_query($query)or die (error($query,mysql_error(),$php));
	         	     list($id_perfil_p) = mysql_fetch_row($result);
	         				
	         	   			if($id_perfil_p!=3){
	         	   				
	         	   				if($password_u!=""){
	   	
	   					        $password_u = md5($password_u);
	   	
	   						$Sql ="UPDATE usuario 
	  							   SET id_empresa='$id_empresa_u',nombre='$nombre_u',apellido='$apellido_u',
	  							   login='$login_u',email='$email_u',password='$password_u',id_perfil='$id_perfil_u',
								   celular='$celular_u',equipo='$equipo_u'
	  							   WHERE id_usuario ='$id_user'";

 cms_query($Sql)or die (error($Sql,mysql_error(),$php));
	   	
          	                    }else{
        	
            				$Sql ="UPDATE usuario 
	  							   SET id_empresa='$id_empresa_u',nombre='$nombre_u',apellido='$apellido_u',email='$email_u',
								   celular='$celular_u',equipo='$equipo_u'
	  							   WHERE id_usuario ='$id_user'";

 cms_query($Sql)or die (error($Sql,mysql_error(),$php));	
           	
                                } 
                              
	         	   				
	         	   			}else{
	         	   				
	         	   				
	         	   			}
	         	   	     
	         	     
	         	     			   
	         			 }
	              	
	         }
	   
	   
	   
	         	   			   
?>	   
	   

