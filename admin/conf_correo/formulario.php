<?php

 



 

$jsxx .= "<script language=\"JavaScript\">

$(document).ready(function () 
		{
			$('#boton').click(function() 
			{ procesar('index.php?accion=$accion&act=1&axj=1','div_respuesta');
			});
		});
		</script>";


		$accion_form = "index.php?accion=$accion&act=1";
		
$contenido =  "
$prototipe

  <table  border=\"0\" align=\"center\" cellpadding=\"3\" cellspacing=\"3\">
    <tr>
      <td class=\"textos\"align=\"center\"><strong>Configuraci&oacute;n de env&iacute;o de Correos</strong></td>
    </tr>
	<tr><td align=\"center\" class=\"textos\">Activar envios de Correos (se seguiran guardando en base de datos)
	<input type=\"checkbox\" name=\"parar_mail\" title=\"Activar el envio de correos.\" id=\"parar_mail\" value=\"1\" $check_parar_mail> </td></tr> 
    <tr>
      <td class=\"textos\" align=\"center\" >
	  <table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\" class=\"cuadro\">
        <tr>
          <td class=\"textos\" >Servidor de env&iacute;o :</td>
          <td class=\"textos\"><label> <input size=\"40\"  name=\"host\" type=\"text\" id=\"host\" value=\"$host\" title=\"Este campo contiene el nombre o Ip del servidor de envio de correos, por lo general si se trata del mismo servidor deberia localhost si no el nombre o Ip de servidor de envio\"/>
		  </label></td>
        </tr>
        
         <tr>
            <td class=\"textos\">Mail de env&iacute;o :</td>
            <td class=\"textos\"><label>
              <input size=\"40\"  name=\"remitente\" type=\"text\" id=\"remitente\" value=\"$remitente\" />
            </label></td>
          </tr>
          <tr>
            <td class=\"textos\">Nombre de env&iacute;o :</td>
            <td class=\"textos\"><label>
              <input size=\"40\"  name=\"nombre_remitente\" type=\"text\" id=\"nombre_remitente\" value=\"$nombre_remitente\" />
            </label></td>
          </tr>
          <tr>
            <td class=\"textos\">M&eacute;todo de env&iacute;o</td>
            <td class=\"textos\"><label>
              <input size=\"40\"  name=\"metodo_envio\" type=\"radio\" $check_mail id=\"radio\" value=\"mail\" title=\"Lo m&aacute;s usado sobre un servidor Linux con envio de correos nativo desde instrucci&oacute;n Mail\" />
              Mail 
            </label><label>
              <input type=\"radio\" name=\"metodo_envio\" id=\"radio\" $check_sendmail value=\"sendmail\" title=\"Usado sobre un servidor Linux con envio de correos nativo desde instrucci&oacute;n Sendmail\"/>
              Sendmail 
            </label><label>
              <input type=\"radio\" name=\"metodo_envio\" id=\"radio\" $check_smtp value=\"smtp\" title=\"Opci&oacute;n para envio de servidores externos por medio de conecci&oacute;n SMTP\"/>
              SMTP
            </label></td>
          </tr>
     
          <tr>
            <td class=\"textos\">Port</td>
            <td class=\"textos\"><label>
              <input size=\"40\"  name=\"port\" type=\"text\" id=\"port\" value=\"$port\" />
            </label>
            
            </td>
          </tr>
        <tr>
            <td class=\"textos\">SMTP autentificaci&oacute;n</td>
            <td class=\"textos\"><label>
              <input type=\"radio\" name=\"smtp\" $check_1 id=\"radio2\" value=\"1\" />Si 
              <input size=\"40\"  name=\"smtp\" $check_0 type=\"radio\" id=\"radio2\" value=\"0\" />No
            </label></td>
          </tr>
       <tr>
            <td class=\"textos\">Cuenta de usuario para Smtp</td>
            <td class=\"textos\"><label>
              <input size=\"40\"  name=\"username\" type=\"text\" id=\"username\" value=\"$username\" />
            </label></td>
          </tr>
       <tr>
            <td class=\"textos\">Contrase&ntilde;a de usuario para Smtp</td>
            <td class=\"textos\"><label>
              <input size=\"40\"  name=\"password\" type=\"text\" id=\"password\" value=\"$password\" />
            </label></td>
          </tr>
           <tr>
      <td class=\"textos\"height=\"12\" colspan=\"2\"></td>
   
    </tr>

 		<tr>
            <td class=\"textos\" align=\"center\"  colspan=\"2\">&nbsp;</td>
            
          </tr>
 	<tr>
            <td class=\"textos\" align=\"center\"  colspan=\"2\">Pie de P&aacute;gina para env&iacute;o de correos</td>
            
          </tr>
 	<tr>
            <td class=\"textos\" align=\"left\"  colspan=\"2\">
			   <textarea name=\"firma_envio_mails\" id=\"firma_envio_mails\"cols=\"80\" rows=\"5\" class=\"textos\">$firma_envio_mails</textarea>
			</td>
            
          </tr>
		   
		<tr>
            <td class=\"textos\" align=\"center\"  colspan=\"2\">
			   -------------------------------------------------------------------</td>
            
          </tr>
		       <tr>
            <td class=\"textos\">Mail para test de env&iacute;o de correo</td>
            <td class=\"textos\"><label>
              <input size=\"40\"  name=\"mail_test\" type=\"text\" id=\"mail_test\" value=\"$mail_test\" />*
			  <input   name=\"axj\" type=\"hidden\" id=\"axj\" value=\"1\" />
            </label></td>
          </tr>
		  <tr>
            <td class=\"textos\" align=\"center\"  colspan=\"2\">
			<input type=\"checkbox\" name=\"guardar\" value=\"1\">Guardar esta configuraci&oacute;n</td>
            
          </tr>
      <tr>
            <td class=\"textos_plomo\" align=\"center\"  colspan=\"2\">*Opcional Solo si desea comprobar esta configuraci&oacute;n</td>
            
          </tr>
    <tr>
      <td class=\"textos\" colspan=\"2\" align=\"center\" ><label>
        <input type=\"submit\" name=\"boton\" id=\"boton\" value=\"Probar y Guardar configuraci&oacute;n\" />
      </label></td>
      </tr> 
      </table>
	  
	  </td>
    </tr>
	<tr><td align=\"center\" class=\"textos\"> 
		     <table width=\"100%\"  border=\"0\" align=\"left\" cellpadding=\"0\" cellspacing=\"0\">
     <tr >
       <td class=\"textos\" align=\"center\" class=\"textos\">
	 
			  <div id=\"div_cargando\" style=\"display:none\">Enviado datos, Espere...</div>
			  <div id=\"div_respuesta\" align=\"center\">$contenido</div>
	   </td>
       </tr>
 	</table>
		  </td></tr>
    <tr>
      <td class=\"textos\">&nbsp;</td>
   
    </tr>
	
	
	   
  </table>


<br>
  <table width=\"90%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
    <tr><td align=\"left\" class=\"textos\">
	 <p><strong>Instrucciones</strong>
</p>
<p>1- Llenar el Formulario con los datos solicitados</p>
<p>2- Luego de llenar los datos puede probar la configuraci&oacute;n ingresando un correo en &quot;Mail para test de envi&oacute; de correo&quot;</p>
<p>3- Si la configuracion de correo est&aacute; correcta, puede guardar esta configuraci&oacute;n clickeando el campo check 
&quot;Guardar esta configuraci&oacute;n&quot; y luego hacer click sobre bot&oacute;n &quot;Probar Configuraci&oacute;n&quot;</p>
<p>&nbsp;</p> 
	 </td></tr> 
	</table><br>
	<!--    
	Este correo electr&oacute;nico es generado en forma autom&aacute;tica, por favor no responda a este mensaje.
   -->





";



?>