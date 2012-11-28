<?php

$id = $_GET['id'];


  $query= "SELECT id_cambio_mail,nuevo_email   
           FROM usuario_cambio_email
           WHERE id_session ='$id'";
		  // echo $query;
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      if (list($id_cambio_mail,$nuevo_email) = mysql_fetch_row($result)){
			
			$Sql ="UPDATE usuario_cambio_email
            	   SET id_session  ='$id_sesion',estado=1
            	   WHERE id_session ='$id'";

 cms_query($Sql)or die (error($Sql,mysql_error(),$php));
				   
				   
				
				   
				  		$texto_mail_envio_solicitud1 = html_template('texto_mail_envio_solicitud2');	

		 $nombre = nombre_usuario($id_usuario);
				    $id_entidad_padre = configuracion_cms('id_servicio');
				    $url = configuracion_cms('url');
				    $remitente = configuracion_cms('mail_remitente');
				    $entidad_padre = rescata_valor('sgs_entidad_padre',$id_entidad_padre,'entidad_padre'); 
					$entidad_padre= acentos($entidad_padre);
				
					$texto_mail_envio_solicitud1 = str_replace("#USUARIO#",$nombre,$texto_mail_envio_solicitud1);
				    $texto_mail_envio_solicitud1 = str_replace("#SERVICIO#",$entidad_padre,$texto_mail_envio_solicitud1);
						  		
				  		
		$texto_mail_envio_solicitud1 = str_replace("#EMAIL#","$email",$texto_mail_envio_solicitud1);
		$texto_mail_envio_solicitud1 = str_replace("#NUEVO_EMAIL#","$nuevo_email",$texto_mail_envio_solicitud1);
		$texto_mail_envio_solicitud1 = str_replace("#URL#","http://$url/index.php?&accion=$accion&act=3&id=$id_sesion",$texto_mail_envio_solicitud1);
		
	
			$url ="$url/index.php?&accion=$accion&act=3&id=$id_sesion";	  
			$cuerpo = html_template('texto_de_activacion_nuevo_email2');	
			$cuerpo = str_replace("#URL#","$url",$cuerpo);  
			
					  

$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
$headers .= "From: Sgs<$remitente>\r\n"; 
$headers .= "Reply-To: $remitente\r\n"; 

$asunto = html_template('subjet_mail_envio_solicitud2');

$asunto ="Activación de cambio de cuenta";

		$contenido = html_template('texto_de_activacion_nuevo_email');	
			
		$id_entidad_padre = configuracion_cms('id_servicio');
				    $url = configuracion_cms('url');
				    $remitente = configuracion_cms('mail_remitente');
				    $entidad_padre = rescata_valor('sgs_entidad_padre',$id_entidad_padre,'entidad_padre'); 
					$entidad_padre= acentos($entidad_padre);
				
					$contenido = str_replace("#USUARIO#",$nombre,$contenido);
				    $contenido = str_replace("#SERVICIO#",$entidad_padre,$contenido);
					
				    	
				    
	if($_SERVER['HTTP_HOST']=='localhost'){
		$contenido .= "<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                        <tr>
                          <td align=\"center\" class=\"textos\">
						  
						  <a href=\"http://localhost/sgs/index.php?&accion=$accion&act=3&id=$id_sesion\">Activar nuevo email esto es solo cuando se detecta que esta en localhost</a></td>
                        </tr>
                      </table>";
		}else{
		//enviar_mail_gracias_registro($login, $password, $email, $id_sesion);
		
		
		//header("Location:index.php?accion=$accion&msj=3");
		
		 $contenido = cuadro_verde($contenido);
		}			   
				   
			cms_mail($nuevo_email,$asunto,$cuerpo,$headers) ; 
						   
		 }else{
		 	$contenido = "<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                            <tr>
                              <td align=\"center\" >Lo sentimos esta solicitud ya caduco</td>
                            </tr>
                          </table>";
						  $contenido = cuadro_amarillo($contenido);
		 
		 }

?>