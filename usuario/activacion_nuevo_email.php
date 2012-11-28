<?php

$id = $_GET['id'];

  $query= "SELECT id_cambio_mail,nuevo_email,mail_actual   
           FROM usuario_cambio_email
           WHERE id_session ='$id'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      if (list($id_cambio_mail,$nuevo_email,$mail_actual) = mysql_fetch_row($result)){
	  
	  
	  $rand = rand(0,10);
	  $fecha = date(Y)."-".date(m)."-".date(d);
	  
	 $Sql ="UPDATE usuario_cambio_email
	  		SET fecha_cambio ='$fecha',
			mail_actual = '$rand $fecha $mail_actual'
	   		WHERE id_session ='$id'";
				  
	
	  


$Sql ="UPDATE usuario
	   SET login ='$nuevo_email',email='$nuevo_email'
	   WHERE email ='$mail_actual'";

 cms_query($Sql)or die (error($Sql,mysql_error(),$php));
	   
	   
	   $contenido = html_template('texto_de_fin_activacion_nuevo_email');	
	   
	   
	     $contenido = "<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                      <tr>
                        <td align=\"center\" >Gracias hemos cambiado su cuenta</td>
                      </tr>
                    </table>";
	   
	   $texto_mail_envio_fin_actualizacion = html_template('texto_mail_envio_fin_actualizacion');	
			$texto_mail_envio_fin_actualizacion = str_replace("#EMAIL#","$nuevo_email",$texto_mail_envio_fin_actualizacion);
	   	
	if($_SERVER['HTTP_HOST']=='localhost'){
		$contenido = "<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                        <tr>
                          <td align=\"center\" class=\"textos\">
						  Texto enviado via email al usuario <br>
						  $texto_mail_envio_fin_actualizacion
						  </td>
                        </tr>
                      </table>";
		}else{
				
			$cuerpo = "<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                        <tr>
                          <td align=\"center\" >$texto_mail_envio_fin_actualizacion
						  </td>
                        </tr>
                      </table>";
					  
$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
$headers .= "From: Sgs<no-reply@sgs.cl>\r\n"; 
$headers .= "Reply-To: no-reply@sgs.cl\r\n"; 
$asunto = "Cuenta de email y usuario Actualizada";

		
		//header("Location:index.php?accion=$accion&msj=3");
		
		
		}	
	cms_mail($nuevo_email,$asunto,$cuerpo,$headers) ;
		
	   
	  }else{
	  
	  
	  
	  $contenido = "<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                      <tr>
                        <td align=\"center\" >Lo sentimos esta solicitud ya fue caducada</td>
                      </tr>
                    </table>";
	  
	  }


?>