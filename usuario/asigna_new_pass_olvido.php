<?php

$sess_pass = $_GET['sess_pass'];

         
		   $query= "SELECT id_usuario_cambia_pass,id_usuario   
                    FROM  usuario_cambio_pass
                    WHERE session='$sess_pass'";
					
              $result= cms_query($query)or die (error($query,mysql_error(),$php));
               if (list($id_usuario_cambia_pass,$id_usuario_pass) = mysql_fetch_row($result)){
         				
						 $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
	   						$cad = "";
	   							for($i=0;$i<7;$i++) 
	   									{
	   										$cad .= substr($str,rand(0,62),1);
	   									}

						
						 $encriptar_password= md5($cad);
						 
						 	    $Sql ="UPDATE usuario
	    	  							 SET password ='$encriptar_password'
	    	  							 WHERE id_usuario ='$id_usuario_pass'";

 cms_query($Sql)or die (error($query,mysql_error(),$php));
								
								
							  $query= "SELECT rut,nombre,paterno,materno, email,login
          								 FROM  usuario
           								WHERE id_usuario='$id_usuario_pass'";  
										
 
     						$result2= cms_query($query)or die (error($query,mysql_error(),$php));
      						list($rut,$nombre,$paterno,$materno, $email,$login) = mysql_fetch_row($result2);
      				//echo "$rut,$nombre,$paterno,$materno, $email,$login";	
						
			   $asunto = html_template('recuperacion_contrasenia_2_subjet_correo');
			   $cuerpo = html_template('recuperacion_contrasenia_2_texto_correo');
			  
			  
			  $url = configuracion_cms('url');
			  $link = "<a href=\"http://$url/index.php\">Sgs</a>";
			  
			   
			   $cuerpo = str_replace("#LOGIN#",$login,$cuerpo);
	           $cuerpo = str_replace("#CAD#",$cad,$cuerpo);
			   $cuerpo = str_replace("#SGS#",$link,$cuerpo);
			   
			   
	    $email_contacto = configuracion_cms('mail_remitente');	
		$destinatario = $email;
	    //para el envío en formato HTML 
	   
	    $headers = "MIME-Version: 1.0\r\n"; 
	    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
	    
	    //dirección del remitente 
	    $headers .= "From: $email_contacto\r\n"; 
	    
	    //dirección de respuesta, si queremos que sea distinta que la del remitente 
	   // $headers .= "Reply-To: $email_contacto\r\n"; 
	    
	  
	    
	  
	   		
      	cms_mail($destinatario,$asunto,$cuerpo,$headers);
		$contenido = html_template('gracias_envio_clave_olvidada');
		 $Sql ="DELETE FROM usuario_cambio_pass
                    WHERE session='$sess_pass'";

 cms_query($Sql)or die (error($Sql,mysql_error(),$php));
				
         		 /* if() {}else{
				 $contenido = html_template('upss');
				 		   
		
				// header("Location:index.php");
				 }*/
}else{

$contenido = html_template('solicitud_caducada');
}


 
 
 

?>