<?php









			

$mail=new PHPMailer();
$mail->Host=$host;
$mail->From=$remitente;
$mail->FromName=$nombre_remitente;
$mail->Mailer=$metodo_envio;

$configuracion ='
  <table  border="0" align="left" cellpadding="0" cellspacing="0">
    <tr >
      <td align="left" class="textos">$mail=</td>
      <td align="left" class="textos">new PHPMailer();</td>
    </tr>
	 <tr >
      <td align="left" class="textos">$mail-></td>
      <td align="left" class="textos">Host="'.$host.'";</td>
    </tr>
	 <tr >
      <td align="left" class="textos">$mail-></td>
      <td align="left" class="textos">From="'.$remitente.'";</td>
    </tr>
	 <tr >
      <td align="left" class="textos">$mail-></td>
      <td align="left" class="textos">FromName="'.$nombre_remitente.'";</td>
    </tr>
	
	 <tr >
      <td align="left" class="textos">$mail-></td>
      <td align="left" class="textos">Mailer="'.$metodo_envio.'";</td>
    </tr>
	
	  
	';



if($metodo_envio!="mail" and $smtp==1){

$mail->SMTPAuth=true;
$mail->Port=$port;
$mail->Username=$username;
$mail->Password=$password;


$configuracion .='<tr >
      					<td align="left" class="textos">$mail-></td>
      					<td align="left" class="textos">SMTPAuth=true;</td>
    			  </tr>
				  <tr >
      					<td align="left" class="textos">$mail-></td>
      					<td align="left" class="textos">Port='.$port.';</td>
    			  </tr>
				   <tr >
      					<td align="left" class="textos">$mail-></td>
      					<td align="left" class="textos">Username="'.$username.'";</td>
    			  </tr>
				  <tr >
      					<td align="left" class="textos">$mail-></td>
      					<td align="left" class="textos">Password="'.$password.'";</td>
    			  </tr>';

}

$configuracion .="</table>";
	




if( $mail_test!=""){



$asunto="Test de configuración mail servidor $hots";
$body= "Cuerpo del mensaje";

$firma_web = configuracion_cms('firma_envio_mails');
$mail->Subject="$asunto";
$mail->AddAddress($destinatario,"d");
$body  = "$cuerpo\n<br>
		  $firma_web";
$mail->Body = $body;
$mail->AltBody = "$asunto";
if($mail->Send()){
 

	$contenido ="  <table width=\"500\"  border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\">
              <tr>
                <td align=\"center\" class=\"textos\"><img src=\"images/ok2.gif\" alt=\"\" border=\"0\">&nbsp;Mail enviado exitosamente a <strong>$destinatario</strong> </td>
                </tr>
				<tr><td align=\"center\" class=\"textos\"> Configuraci&oacute;n necesaria</td></tr> 
				<tr><td align=\"center\" class=\"textos\">$configuracion</td></tr> 
				
          	</table>";
}else{
$error= $mail->ErrorInfo;




$contenido = "  <table width=\"300\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
              <tr><td align=\"center\" class=\"textos\"><img src=\"images/warning.gif\" alt=\"\" border=\"0\">&nbsp;Problema de envio de correo </td></tr>
			  <tr><td align=\"center\" class=\"textos\">&nbsp; </td></tr> 
			  <tr>
                <td align=\"center\" class=\"textos_rojo\">$error </td>
                </tr>
          	<tr>
                <td align=\"center\" class=\"textos\">$configuracion </td>
                </tr>
          	</table>";
	}

}else{



$contenido = "<table width=\"80%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                <tr>
                  <td align=\"center\" class=\"textos\"><img src=\"images/ok2.gif\" alt=\"\" border=\"0\">&nbsp;Los Datos han sido guardados exitosamente, pero no se comprobo la nueva configuraci&oacute;n para esto debe ingresar un mail de test.</td>
                </tr>
              </table>";


}
?>