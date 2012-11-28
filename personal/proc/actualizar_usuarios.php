<?php
//voy a actualizar los usuarios





  $query= "SELECT login, password
           FROM  usuario
           WHERE login='$login_u' and id_usuario <> '$id_user'";
           $result= cms_query($query)or die (error($query,mysql_error(),$php));
        if(!list($login, $password) = mysql_fetch_row($result)){
        	
        	if($id_perfil==3){
        		 if($password_u!=""){
	   	
	   					$password_u = md5($password_u);
	   	
	   						$Sql ="UPDATE usuario 
	  							   SET nombre='$nombre_u',apellido='$apellido_u',
	  							   login='$login_u',email='$email_u',password='$password_u',id_perfil='$id_perfil_u'
	  							   WHERE id_usuario ='$id_usuarior'";

 cms_query($Sql)or die (error($query,mysql_error(),$php));
	   	
          	       }else{
        	
            				$Sql ="UPDATE usuario 
	  							   SET nombre='$nombre_u',apellido='$apellido_u',email='$email_u'
	  							   WHERE id_usuario ='$id_usuario'";

 cms_query($Sql)or die (error($query,mysql_error(),$php));	
           	
                     }    
                     echo "<script>alert('Sus datos han sido cambiados exitosamente'); document.location.href='?accion=$accion&act_usuario=1&id_user=$id_user&id_emp=$id_emp';</script>\n";	
	   	
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
	  							   login='$login_u',email='$email_u',password='$password_u',id_perfil='$id_perfil_u'
	  							   WHERE id_usuario ='$id_user'";

 cms_query($Sql)or die (error($query,mysql_error(),$php));
	   	
          	                    }else{
        	
            				$Sql ="UPDATE usuario 
	  							   SET id_empresa='$id_empresa_u',nombre='$nombre_u',apellido='$apellido_u',email='$email_u'
	  							   WHERE id_usuario ='$id_user'";

 cms_query($Sql)or die (error($query,mysql_error(),$php));	
           	
                                } 
                                 echo "<script>alert('Sus datos han sido cambiados exitosamente'); document.location.href='?accion=$accion';</script>\n";	    		
	         	   				
	         	   				
	         	   			}else{
	         	   			echo "<script>alert('Sus datos han sido cambiados exitosamente'); document.location.href='?accion=$accion';</script>\n";	    		
	         	   				
	         	   				
	         	   			}
	         	   	     
	         	     
	         	     			   
	         			 }
	              	
	         }
	   
	   
	   
	
	   
?>	   
	   

