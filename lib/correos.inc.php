<?php

include("lib/class.phpmailer.php");

function cms_mail($destinatario,$asunto,$cuerpo,$headers){

//echo "<br>en php mailer";
$phpmailer_conf = configuracion_cms('phpmailer');	

if($phpmailer_conf==1){
	//echo "<br>en php mailer 2";
	
	
	$remitente =configuracion_cms('mail_remitente');
	
	$firma_web = configuracion_cms('firma_envio_mails');
	
	$mail=new PHPMailer();
	//print_r($mail);
	//echo "<br>en php mailer 3";
	$mail->Host="localhost";
	$mail->From="$remitente";
	$mail->Subject="$asunto";
	$mail->AddAddress("$destinatario","d");
	$body  = "$cuerpo
			  $firma_web";
	$mail->Body = $body;
	$mail->AltBody = "$asunto";
	
	//$mail->Send();
	//echo "<br>llega a phpmailer";
	//$mail->Send(); 
	//echo "<br>result:".$result ;
		if(configuracion_cms('parar_mail')==1){
			if($mail->Send()){
				$var_envia= true;
				$enviado=1;
				//echo "Envio ok";
			}else{
				$var_envia= false;
				$error_info = $mail->ErrorInfo;
				//echo "Error en envío:<br>".$error_info;
				$enviado=0;
			}
		
		}
	
	
	//pclose($mail);
	$mail->ClearAddresses();
	//unset($mail);
	//$mail = NULL;
	
	

}else{
	//echo "<br>llega a mail";
		if( configuracion_cms('parar_mail')==1){
				mail($destinatario,$asunto,$cuerpo,$headers);	
		}


}



}





function finalizar_contrato_cms_mail($id_user,$id_contratop){
}

function objetar_contrato_cms_mail($id_user,$id_contrato){
		   }
	    
function envia_mail_central($id_user,$id_contrato){
}	    
	    
function envia_mail_director($id_user,$id_contrato){
}
function envia_mail_asignador($folio){


global $id_sesion;


  $query= "SELECT id_perfil   
           FROM  usuario_perfil 
           WHERE perfil='Asignador'";
     $result= mysql_query($query)or die ("ERROR $php <br>$query");
      list($id_asignador) = mysql_fetch_row($result);
	  
	$id_entidad_padre = configuracion_cms('id_servicio');
	
  $query= "SELECT id_entidad
           FROM  sgs_solicitud_acceso  
           WHERE folio='$folio'";
     $result= mysql_query($query)or die ("ERROR $php <br>$query");
      list($id_entidad) = mysql_fetch_row($result);
  

	//$email_contacto= "info@grau.cl";
  $query= "SELECT id_usuario,rut,nombre,paterno,materno, email,login
           FROM  usuario
           WHERE id_perfil='$id_asignador' and id_entidad = '$id_entidad'";  
 
     $result2= mysql_query($query)or die ("ERROR 1 <br>$query");
      while(list( $id_usuario,$rut,$nombre,$paterno,$materno, $email,$login) = mysql_fetch_row($result2)){
	  	//echo "<br>id:&nbsp;$id_usuario&nbsp;&nbsp; nombre&nbsp;:".$nombre."&nbsp;".$paterno."&nbsp;&nbsp;email:".$email."&nbsp;&nbsp;login:".$login;
		//echo "<BR><BR><BR>ACA PASA"				;
	    	   $asunto = html_template('subjet_ingreso_solicitud');
			   $asunto = str_replace("#FOLIO#",$folio,$asunto);
			   $cuerpo = html_template('cuerpo_ingreso_solicitud');
			  
			  
			  $url = configuracion_cms('url');
			  $link = "<a href=\"http://$url/index.php\">Ir a Sistema de solicitudes </a>";
			   
			  
			   
			   $cuerpo = str_replace("#NOMBRE#",$nombre,$cuerpo);
	           $cuerpo = str_replace("#PATERNO#",$paterno,$cuerpo);
	           $cuerpo = str_replace("#MATERNO#",$materno,$cuerpo);
	           $cuerpo = str_replace("#FOLIO#",$folio,$cuerpo);
	           $cuerpo = str_replace("#LINK#",$link,$cuerpo);
	         
			   
			   
	    $email_contacto = configuracion_cms('mail_remitente');	
		$destinatario = $email;
	    //para el envío en formato HTML 
	   
	    $headers = "MIME-Version: 1.0\r\n"; 
	    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
	    
	    //dirección del remitente 
	    $headers .= "From: $email_contacto\r\n"; 
	    
	    //dirección de respuesta, si queremos que sea distinta que la del remitente 
	    $headers .= "Reply-To: $email_contacto\r\n"; 
	    
		$asunto = acentos_inverso($asunto);
	  	//echo "<br> <b>antes de cms_mail:</b>";
	    cms_mail($email,$asunto,$cuerpo,$headers);
		
		
		
	   /*if(!) {
	   		
			
			//cms_mail("newtemopral@gmail.com",$asunto,$cuerpo,$headers);
			return false;
	   }else{
	   		return true;
	   }
	   */
	  
	  
	  }
      
      
      
	   



}


function envia_asignacion_solicitud($id,$folio){

global $id_sesion;

	//$email_contacto= "info@grau.cl";
  $query= "SELECT rut,nombre,paterno,materno, email,login
           FROM  usuario
           WHERE id_usuario='$id'";  
 
     $result2= mysql_query($query)or die ("ERROR 1 <br>$query");
      list($rut,$nombre,$paterno,$materno, $email,$login) = mysql_fetch_row($result2);
      
      
      
	     
	    /*

	    	   */
	    	   $asunto = html_template('subjet_asigna_solicitud');
			   $cuerpo = html_template('cuerpo_asigna_solicitud');
			  
			  
			  $url = configuracion_cms('url');
			  $link = "<a href=\"http://$url/index.php\">Ir a Sistema de solicitudes </a>";
			   
			   $cuerpo = str_replace("#NOMBRE#",$nombre,$cuerpo);
	           $cuerpo = str_replace("#PATERNO#",$paterno,$cuerpo);
	           $cuerpo = str_replace("#MATERNO#",$materno,$cuerpo);
	           $cuerpo = str_replace("#FOLIO#",$folio,$cuerpo);
	           $cuerpo = str_replace("#LINK#",$link,$cuerpo);
	         
			   
			   
	    $email_contacto = configuracion_cms('mail_remitente');	
		$destinatario = $email;
	    //para el envío en formato HTML 
	   
	    $headers = "MIME-Version: 1.0\r\n"; 
	    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
	    
	    //dirección del remitente 
	    $headers .= "From: $email_contacto\r\n"; 
	    
	    //dirección de respuesta, si queremos que sea distinta que la del remitente 
	    $headers .= "Reply-To: $email_contacto\r\n"; 
	    
		$asunto = acentos_inverso($asunto);
	  
	    
	   if(!cms_mail($destinatario,$asunto,$cuerpo,$headers)) {
	   		
			
			//cms_mail("newtemopral@gmail.com",$asunto,$cuerpo,$headers);
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
 
     $result2= mysql_query($query)or die ("ERROR 1 <br>$query");
      list($rut,$nombre,$paterno,$materno, $email,$login) = mysql_fetch_row($result2);
      
      
      
	     
	    /*

	    	   */
	    	   $asunto = html_template('recuperacion_contrasenia_1_subjet_correo');
			   $cuerpo = html_template('recuperacion_contrasenia_1_texto_correo');
			  
			  
			  $url = configuracion_cms('url');
			  $link = "$url/index.php?accion=olvido&act=1&sess_pass=$id_sesion";
			   
			   $cuerpo = str_replace("#LOGIN#",$login,$cuerpo);
	           $cuerpo = str_replace("#CAD#",$cad,$cuerpo);
			   $cuerpo = str_replace("#URL#",$link,$cuerpo);
			   
			   
	    $email_contacto = configuracion_cms('mail_remitente');	
		$destinatario = $email;
	    //para el envío en formato HTML 
	   
	    $headers = "MIME-Version: 1.0\r\n"; 
	    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
	    
	    //dirección del remitente 
	    $headers .= "From: $email_contacto\r\n"; 
	    
	    //dirección de respuesta, si queremos que sea distinta que la del remitente 
	    $headers .= "Reply-To: $email_contacto\r\n"; 
	    
		$asunto = acentos_inverso($asunto);
	  
	   // echo "$destinatario,$asunto,$cuerpo,$headers";
	   cms_mail($destinatario,$asunto,$cuerpo,$headers);
	   		return true;
	  
	   
	    
}

function aviso_eliminar_foto($archivo_foto,$id_usr){
}

function envia_amigo($id_usuario,$nombre_amigo,$mail_amigo,$id_mail){
}

 function enviar_mail_gracias_registro($login, $pass1, $email, $id_sesion){
//include("tienda/config.php");

   //$empresa = "Grau";
   //$email_rem = "info@grau.cl";
   //$url ="http://www.grau.cl";
   //$footer ="<b>Dansel</b> San Diego 675/ Santiago Centro/ Chile / Abierto de lunes a sábado de 10:00 a 20:00 hrs.<br> 
     //   telefonos: 367 10 77 / mail: info@dansel.cl ";
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
	   
	    
	    //para el envío en formato HTML 
	    $headers = "MIME-Version: 1.0\r\n"; 
	    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
	    
	    //dirección del remitente 
	    $headers .= "From: $email_rem\r\n"; 
	    
	    //dirección de respuesta, si queremos que sea distinta que la del remitente 
	    $headers .= "Reply-To: $email_rem\r\n"; 
	    
	//  echo "<br> des $destinatario,asun $asunto,cuer $cuerpo,$headers ddddd";
	  //  echo "$destinatario,$asunto,$cuerpo,$headers<br>";
	  if(!cms_mail($destinatario,$asunto,$cuerpo,$headers)) {
	   		// echo "No se ha dado aviso de la creación del contrato via mail";
	   		// echo "No se ha dado aviso de la creaci&oacute;n del contrato via mail<br>$destinatario,$asunto";
	 }
   
   }
   
   
function enviar_mail_cambio_contrasena($login, $password, $email, $id_sesion){

   
   }
  


?>