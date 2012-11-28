<?php

$destinatario = $_POST['mail_test'];



switch ($act) {
     case 1:
        
$remitente = $_POST['remitente'];
$host = $_POST['host'];
$remitente = $_POST['remitente'];
$nombre_remitente = $_POST['nombre_remitente'];
$metodo_envio = $_POST['metodo_envio'];
$port = $_POST['port'];
$smtp = $_POST['smtp'];
$username = $_POST['username'];
$password = $_POST['password'];
$mail_test = $_POST['mail_test'];
$firma_envio_mails = $_POST['firma_envio_mails'];

$parar_mail = $_POST['parar_mail'];
//echo $firma_envio_mails;

if($_POST['guardar']){

//$firma_envio_mails= htmlentities($firma_envio_mails);
//echo $firma_envio_mails;
//$firma_envio_mails=utf8_decode($firma_envio_mails);

actualiza_configuracion_cms('mail_remitente',$remitente);
actualiza_configuracion_cms('nombre_de_envio',$nombre_remitente);
actualiza_configuracion_cms('mail_remitente',$remitente);
actualiza_configuracion_cms('servidor_de_envio',$host);
actualiza_configuracion_cms('metodo_de_envio',$metodo_envio);
actualiza_configuracion_cms('port',$port);
actualiza_configuracion_cms('smtp_autentification',$smtp);
actualiza_configuracion_cms('cuenta_smtp',$username);
actualiza_configuracion_cms('pass_smtp',$password);
actualiza_configuracion_cms('firma_envio_mails', $firma_envio_mails );
actualiza_configuracion_cms('parar_mail',$parar_mail);



}

if($destinatario!="" ){

include("admin/conf_correo/envio_correo.php");

}
include("admin/conf_correo/datos_configuracion.php");
include("admin/conf_correo/formulario.php");



         break;
	
   	default:
	   



include("admin/conf_correo/datos_configuracion.php");

include("admin/conf_correo/formulario.php");
	 
       
 }
 
 
 






/*

if($_POST['html']!=""){


 $Sql ="DELETE FROM test";
  mysql_query($Sql)or die ("ERROR $php <br>$Sql");

$html= caracteres_html($_POST['html']);


//$html = caracteres_html($html);

//INSERT INTO tabla VALUES (CONVERT(_latin1'Pepito Pérez' USING utf8), '1', md5("12345"));
$qry_insert="INSERT INTO test (id_test,tests)values (null,'$html')";
              
 $result_insert=cms_query($qry_insert) or die("$MSG_DIE $php - QR-Problemas al insertar $qry_insert");

 
}

     $query= "SELECT tests  
            FROM  test";
      $result= mysql_query($query)or die (error($query,mysql_error(),$php));
      list($html) = mysql_fetch_row($result);
	  
	  $contenido=  $html;
$contenido = "<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                <tr>
                  <td align=\"center\" class=\"textos\">
				     <textarea name=\"html\" cols=\"60\" rows=\"10\" class=\"textos\">$html</textarea>
				  </td>
                </tr>
				<tr><td align=\"center\" class=\"textos\">
				<input type=\"checkbox\" name=\"rpta\" value=\"0\"><br>
    <input type=\"checkbox\" name=\"rpta[]\" value=\"1\"><br>
    <input type=\"checkbox\" name=\"rpta[]\" value=\"2\"><br>
    <input type=\"checkbox\" name=\"rpta[]\" value=\"3\"><br>

				 </td></tr> 
				<tr><td align=\"center\" class=\"textos\">
				<input type=\"submit\" name=\"Submit\" value=\"Enviar\"> </td></tr> 
              </table>";*/
?>