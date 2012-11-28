<?php

$nuevo_email = $_POST['nuevo_email'];



$email = email($id_sesion);

$nuevo_email = htmlentities($nuevo_email);

if($email==$nuevo_email){
$contenido = "<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                <tr>
                  <td align=\"center\" >Email Actualizado</td>
                </tr>
              </table>";

}else{

  $query= "SELECT id_usuario   
           FROM  usuario
           WHERE email='$nuevo_email'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
     if (!list($id_u) = mysql_fetch_row($result)){
	$Sql ="DELETE FROM usuario_cambio_email where id_usuario=$id_usuario";

 cms_query($Sql)or die (error($Sql,mysql_error(),$php));			   
		$solicitud_de_cambio_email1 = html_template('solicitud_de_cambio_email1');	

		$fecha = date(Y)."-".date(m)."-".date(d);
		
        $qry_insert="INSERT INTO usuario_cambio_email(id_cambio_mail,id_usuario,id_session,nuevo_email,mail_actual,fecha) 
					values (null,$id_usuario,'$id_sesion','$nuevo_email','$email','$fecha')";
                      
        $result_insert=cms_query($qry_insert) or die("$MSG_DIE $php - QR-Problemas al insertar $qry_insert<br>".mysql_error());
		
		
		
		$texto_mail_envio_solicitud1 = html_template('texto_mail_envio_solicitud1');
		
		            $nombre = nombre_usuario2($id_usuario);
				    $id_entidad_padre = configuracion_cms('id_servicio');
				    $url = configuracion_cms('url');
				    $remitente = configuracion_cms('mail_remitente');
				    $entidad_padre = rescata_valor('sgs_entidad_padre',$id_entidad_padre,'entidad_padre'); 
					$entidad_padre= acentos($entidad_padre);
				
					$texto_mail_envio_solicitud1 = str_replace("#USUARIO#",$nombre,$texto_mail_envio_solicitud1);
				    $texto_mail_envio_solicitud1 = str_replace("#SERVICIO#",$entidad_padre,$texto_mail_envio_solicitud1);
				
				   
				   
			
		$texto_mail_envio_solicitud1 = str_replace("#EMAIL#","$email",$texto_mail_envio_solicitud1);
		$texto_mail_envio_solicitud1 = str_replace("#NUEVO_EMAIL#","$nuevo_email",$texto_mail_envio_solicitud1);
		$texto_mail_envio_solicitud1 = str_replace("#URL#","$url/index.php?accion=$accion&act=2&id=$id_sesion",$texto_mail_envio_solicitud1);
		
		
	$cuerpo = "$texto_mail_envio_solicitud1";
					  
$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
$headers .= "From: Sgs<$remitente>\r\n"; 
$headers .= "Reply-To: $remitente\r\n"; 

$asunto = acentos_inverso(html_template('subjet_mail_envio_solicitud1'));
		

		
	if($_SERVER['HTTP_HOST']=='localhost'){
		$contenido = "<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                        <tr>
                          <td align=\"center\" class=\"textos\">
						  
						  <a href=\"http://localhost/sgs/index.php?&accion=$accion&act=2&id=$id_sesion\">Activar email esto es solo cuando se detecta que esta en localhost</a></td>
                        </tr>
                      </table>";
		}
	
		cms_mail($email,$asunto,$cuerpo,$headers) ;
		
		
		
		
		$texto_de_cambio_email1 = html_template('texto_de_cambio_email1');	
		
		 $nombre = nombre_usuario2($id_usuario);
				    $id_entidad_padre = configuracion_cms('id_servicio');
				    $entidad_padre = rescata_valor('sgs_entidad_padre',$id_entidad_padre,'entidad_padre'); 
					$entidad_padre= acentos($entidad_padre);
				
					$texto_de_cambio_email1 = str_replace("#USUARIO#",$nombre,$texto_de_cambio_email1);
				   $texto_de_cambio_email1 = str_replace("#SERVICIO#",$entidad_padre,$texto_de_cambio_email1);
				
				    
		$texto_de_cambio_email1= str_replace("#EMAIL_ACTUAL#",$email,$texto_de_cambio_email1);
		$texto_de_cambio_email1= str_replace("#NUEVO_EMAIL#",$nuevo_email,$texto_de_cambio_email1);
		
		
		$contenido .= "$texto_de_cambio_email1";
 }else{
 $contenido = "<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                <tr>
                  <td align=\"center\" >Este mail ya esta siendo utilizado.</td>
                </tr>
              </table>";
 
 }
}
//usuario_cambio_email



?>