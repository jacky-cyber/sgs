<?php
require_once("lib/class.phpmailer.php");



function cms_mail($destinatario,$asunto,$cuerpo,$headers, $envio_stop = 0, $folio = 0){

$time_ini_correo = @getmicrotime();

//$destinatario= acentos_inverso($destinatario);
$remitente =configuracion_cms('mail_remitente');
$nombre_remitente =configuracion_cms('nombre_de_envio');
$host =configuracion_cms('servidor_de_envio');

$metodo_envio =configuracion_cms('metodo_de_envio');
$port =configuracion_cms('port');
$smtp =configuracion_cms('smtp_autentification');
$username =configuracion_cms('cuenta_smtp');
$password =configuracion_cms('pass_smtp');
$formato_envio_correos =configuracion_cms('formato_envio_correos');


$firma_web= configuracion_cms('firma_envio_mails');
$url= configuracion_cms('url');
$firma_web .= "<br><br><a href=\"http://$url\">Sistema de Gesti&oacute;n de Solicitudes</a>";
/**/
if($envio_stop==0){
	  $query= "SELECT valor   
               FROM  cms_configuracion
               WHERE configuracion ='parar_mail'";
         $result= mysql_query($query);
          list($envio_stop) = mysql_fetch_row($result);
}
	  




if($envio_stop==1){

		$mail=new PHPMailer();
		$mail->Host=$host;
		$mail->Mailer=$metodo_envio;
		
		$mail->ContentType = $formato_envio_correos;
					
		
			if($smtp==1){
				$mail->SMTPAuth=true;
				
				$mail->Username=$username;
				$mail->Password=$password;
				
			}
		$mail->Port=$port;
		
		//$asunto = acentos_inverso($asunto);
		$asunto = acentos_inverso($asunto);
		$mail->From="$remitente";
		$mail->Subject="$asunto";
	

	$cuerpo = acentos($cuerpo);

	if($folio != 0){	
		
		$nombre_archivo = $archivo;
		list($nombre,$extension) = explode(".",$nombre_archivo);
		$mail->AddAttachment("sgs/documentos_sistema/$folio/solicitud_$folio.pdf","solicitud_$folio");
	}


$body  = "$cuerpo\n <br>\n <br>
		  $firma_web";
$mail->Body = $body;
  

$mail->AltBody = $body; 


$aux=explode(";", $destinatario);
$tot_reg = count($aux);
//se deja estatico un maximo de envio de 5 correos por envio
if($tot_reg>5){
$tot_reg=5;
}
     for ($i=0;$i<$tot_reg;$i++) { 
	 usleep(50);
		     	$destino=$aux[$i];
				$mail->AddAddress("$destino","d");
				
 				if($mail->Send()){
					$micro = microtime();
					$micro = explode(" ",$micro);
					$time_fin  = $micro[1] + $micro[0];
					
				    
					$tiempo_ejecucion = $time_fin-$time_ini_correo;
					$tiempo_ejecucion_correo= round($tiempo_ejecucion,2);
					
									$var_envia= true;
					$enviado=1;
				}else{
					$var_envia= false;
					$error_info = $mail->ErrorInfo;
					$enviado=0;
				}
} 

$mail->ClearAddresses();


}else{
$enviado=0;

$var_envia= false;

$_SESSION['mail_enviado'] = "  <table width=\"300\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                                 <tr>
                                   <td align=\"left\" class=\"textos\">Destinatario : $destinatario</td>
                                   </tr>
                             	 <tr>
                                   <td align=\"left\" class=\"textos\">Asunto : $destinatario</td>
                                   </tr>
                             	 <tr>
                                   <td align=\"left\" class=\"textos\">Mensaje</td>
                                   </tr>
                             	 <tr>
                                   <td align=\"left\" class=\"textos\">$cuerpo</td>
                                   </tr>
                             	</table>";


}





$id_usuario  = id_usuario($id_sesion);

    $query= "SELECT id_usuario
             FROM  usuario
             WHERE email='$destinatario'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      list($id_destinatario) = mysql_fetch_row($result);
	  

		$_POST['remitente']=$remitente;
		$_POST['destinatario']=$destinatario;
		$_POST['asunto']=$asunto;
		$_POST['cuerpo']=$cuerpo;
		$_POST['id_usuario']=$id_usuario;
		$_POST['id_destinatario']=$id_destinatario;
		$_POST['fecha']=date(Y)."-".date(m)."-".date(d);
		$_POST['hora']=date('H:i:s');
		$_POST['error_envio']=$error_info;
		$_POST['enviado']=$enviado;
		$_POST['tiempo_ejecucion_correo']=$tiempo_ejecucion_correo;
		
		
		
		inserta('deuman_mails');

return $var_envia;

}




/*
function finalizar_contrato_cms_mail($id_user,$id_contratop){
}

function objetar_contrato_cms_mail($id_user,$id_contrato){
		   }
	    
function envia_mail_central($id_user,$id_contrato){
}	    
	    
function envia_mail_director($id_user,$id_contrato){
}
*/




function envia_asignacion_solicitud($id,$folio){

global $id_sesion;

	
  $query= "SELECT rut,nombre,paterno,materno, email,login
           FROM  usuario
           WHERE id_usuario='$id'";  
 
     $result2= cms_query($query)or die (error($query,mysql_error(),$php));
      list($rut,$nombre,$paterno,$materno, $email,$login) = mysql_fetch_row($result2);
      
    
	    	   $asunto = html_template('subjet_asigna_solicitud');
			   $cuerpo = html_template('cuerpo_asigna_solicitud');
			  
			  
			  $url = configuracion_cms('url');
			  
			  
			  $link = "<a href=\"http://$url/index.php?accion=gestion-de-solicitudes&act=1&folio=$folio\">Ir a a la solicitud </a>";
			   
			   $cuerpo = str_replace("#NOMBRE#",$nombre,$cuerpo);
	           $cuerpo = str_replace("#PATERNO#",$paterno,$cuerpo);
	           $cuerpo = str_replace("#MATERNO#",$materno,$cuerpo);
	           $cuerpo = str_replace("#FOLIO#",$folio,$cuerpo);
	           $cuerpo = str_replace("#LINK#",$link,$cuerpo);
	         
			   
			   
	    $email_contacto = configuracion_cms('mail_remitente');	
		$destinatario = $email;
	   
	    
		$asunto = acentos_inverso($asunto);
	  
	    
	   if(!cms_mail($destinatario,$asunto,$cuerpo,$headers)) {
	   		
			
			
			return false;
	   }else{
	   		return true;
	   }
	   


}



function envia_mail_rescate_contrasena($id){

	//include("tienda/config.php");
global $id_sesion;

	//$email_contacto= "info@grau.cl";
  $query= "SELECT rut,nombre,paterno,materno, email,login
           FROM  usuario
           WHERE id_usuario='$id'";  
 
     $result2= cms_query($query)or die (error($query,mysql_error(),$php));
      list($rut,$nombre,$paterno,$materno, $email,$login) = mysql_fetch_row($result2);
      
	  	   $asunto = html_template('recuperacion_contrasenia_1_subjet_correo');
		   $cuerpo = html_template('recuperacion_contrasenia_1_texto_correo');
			  
			  
			  $url = configuracion_cms('url');
			  $link = "$url/index.php?accion=olvido&act=1&sess_pass=$id_sesion";
			   
			   $cuerpo = str_replace("#LOGIN#",$login,$cuerpo);
	           $cuerpo = str_replace("#CAD#",$cad,$cuerpo);
			   $cuerpo = str_replace("#URL#",$link,$cuerpo);
			   
			   
	    $email_contacto = configuracion_cms('mail_remitente');	
		$destinatario = $email;
	    
		$asunto = acentos_inverso($asunto);
	    cms_mail($destinatario,$asunto,$cuerpo,$headers);
	   	return true;
	  
	   
	    
}

function aviso_eliminar_foto($archivo_foto,$id_usr){
}

function envia_amigo($id_usuario,$nombre_amigo,$mail_amigo,$id_mail){
}

function enviar_mail_gracias_registro($login, $pass1, $email, $id_sesion){


        $email_rem= configuracion_cms('mail_remitente');
	    $url= configuracion_cms('url');
	    $id_servicio= configuracion_cms('id_servicio');
	    
	    $servicio = rescata_valor('sgs_entidad_padre',$id_servicio,'entidad_padre') ;
	   
	    $destinatario = $email; 
	    $asunto = html_template('asunto_mail_activa_cuenta');	
		$asunto = str_replace("<","",$asunto);
		$asunto = str_replace("p>","",$asunto);
		$asunto = str_replace("/","",$asunto);
		$cuerpo = html_template('texto_correo_activa_cuenta');	
		$cuerpo = str_replace("#LOGIN#",$login,$cuerpo);
		$cuerpo = str_replace("#LOGIN#",$login,$cuerpo);
		$cuerpo = str_replace("#PASS1#",$pass1,$cuerpo);
		$cuerpo = str_replace("#SESSION#",$id_sesion,$cuerpo);
		$cuerpo = str_replace("#URL#",$url,$cuerpo);
		$cuerpo = str_replace("#SERVICIO#",$servicio,$cuerpo);
		
		$formulario_registro = html_template('texto_mail_activa_cuenta');	
	   
	   if(!cms_mail($destinatario,$asunto,$cuerpo,$headers)) {
	   		// echo "No se ha dado aviso de la creación del contrato via mail";
	   		// echo "No se ha dado aviso de la creaci&oacute;n del contrato via mail<br>$destinatario,$asunto";
	   }
   
   }
 
   
function enviar_mail_cambio_contrasena($login, $password, $email, $id_sesion){

   
   }

function envia_correo_jefatura($id_jefaturas,$funcionario){

	$id_jefaturas = explode(",",$id_jefaturas);
	global $id_sesion;
	
	// Datos funcionario
	$query= "SELECT nombre,paterno,materno
			   FROM usuario
			   WHERE id_usuario='$funcionario'";
	$result2= cms_query($query)or die (error($query,mysql_error(),$php));
	list($nombre,$paterno,$materno) = mysql_fetch_row($result2);
	$solicitante = $nombre." ".$paterno." ".$materno;

	for($j=0; $j<count($id_jefaturas); $j++){
		$query= "SELECT rut,nombre,paterno,materno, email,login
			   FROM usuario
			   WHERE id_usuario='$id_jefaturas[$j]'";
		
		$result2= cms_query($query)or die (error($query,mysql_error(),$php));
		list($rut,$nombre,$paterno,$materno, $email,$login) = mysql_fetch_row($result2);
		
	  	$asunto = html_template('solicitud_cambio_clave');
		$cuerpo = html_template('cuerpo_solicitud_cambio_clave');
		
		$url = configuracion_cms('url');
		$link = "$url/index.php?accion=cambio-clave-funcionario&sess_pass=$id_sesion";
		
		$cuerpo = str_replace("#FUNCIONARIO#",$solicitante,$cuerpo);
		$cuerpo = str_replace("#URL#",$link,$cuerpo);
		$destinatario = $email;
	    
		$asunto = acentos_inverso($asunto);
	    cms_mail($destinatario,$asunto,$cuerpo,$headers);
	}
	return true;
	  
	   
	    
}




?>