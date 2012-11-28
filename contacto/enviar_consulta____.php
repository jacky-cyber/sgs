<?php

set_time_limit(0); 

$mensaje = $_GET['mensaje'];
$consulta = $_POST['consulta'];

$nombre = $_POST['nombre'];
$email = $_POST['email'];
$id_mail = $_POST['id_mail'];

$dominio = $_SERVER["HTTP_HOST"]; 



  $query= "SELECT mail_contacto   
           FROM  contacto_mails
		   WHERE id_contacto=$id_mail ";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      list($mail_contacto) = mysql_fetch_row($result);


	

/*
  $query= "SELECT nombre, apellido, email   
           FROM  usuario
           WHERE session='$id_sesion'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
       list($nombre, $apellido, $email) = mysql_fetch_row($result);
						   
		*/
include ("captcha/verificar.php");



$fecha = date(Y)."-".date(m)."-".date(d);
/*
$qry_insert2="INSERT INTO contactos (id_contacto,nombre,mail,comentario,fecha,mail_contacto) values (null,'$nombre','$email','$consulta','$fecha','$mail_contacto')";
            
   $result_insert= cms_query($qry_insert2) or die("$MSG_DIE - QR-Problemas al insertar $qry_insert2");
   */

		inserta('contactos');
		//echo $qry_insert2;


		
$subject_cliente .="Contacto de usuario desde $dominio";		
		
		

$mensaje_cliente .="nombre: $nombre $apellido <br>";
$mensaje_cliente .="email: $email <br>";
$mensaje_cliente .="La Consulta es : $consulta<br>";

$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 


$headers .= "From: Servidor $dominio <no-reply@quillayes.cl>\r\n"; 


$headers .= "Reply-To: no-reply@quillayes.cl\r\n";




$mail_from = "FROM: $email";
if(!cms_mail("$mail_contacto", "$subject_cliente","$mensaje_cliente","$headers")){


$contenido .="<table width=\"70%\"  border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"3\" class=\"cuadro_light\">
    <tr>
      <td  bgcolor=\"#DEE7F8\" align=\"center\" class=\"textos\">
      <div align=\"center\"  class=\"textos\">Si existe algun tipo de problema intente mas tarde Gracias.</div></td>
      </tr>
	</table>";
 


   }else{

 $contenido .="<table width=\"70%\"  border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"3\" class=\"cuadro_light\">
    <tr>
      <td   align=\"center\" class=\"textos\">
      Gracias: $nombre $apellido  </div></td>
      </tr>
	  <tr><td align=\"center\" class=\"textos\"> la consulta <br>\"$consulta\"</td></tr> 
	  <tr><td align=\"center\" class=\"textos\">ser&aacute; respondida a la brevedad a tu Email $email </td></tr> 
	</table>";
 
 
   }

   
   
	$contenido ="
	

<table width=\"754\" border=\"0\" height=\"474\"  cellspacing=\"0\" cellpadding=\"0\" class=\"bg_productos\">
  <tr>
    <td>
	
	


<table width=\"754\" height=\"474\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" >
          <tr>
            <td height=\"71\"><script type=\"text/javascript\">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0','width','754','height','71','src','swf/productos_interior','quality','high','pluginspage','http://www.macromedia.com/go/getflashplayer','wmode','transparent','movie','swf/productos_interior' ); //end AC code
        </script>
                <noscript>
                  <object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0\" width=\"754\" height=\"71\">
                  <param name=\"movie\" value=\"swf/productos_interior.swf\">
                  <param name=\"quality\" value=\"high\">
                  <param name=\"wmode\" value=\"transparent\">
                  <embed src=\"swf/productos_interior.swf\" width=\"754\" height=\"71\" quality=\"high\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" type=\"application/x-shockwave-flash\" wmode=\"transparent\"></embed>
                </object>
              </noscript></td>
          </tr>
          <tr>
            <td height=\"365\">
			
			$contenido
		</td></tr> 
		<tr><td align=\"center\" class=\"textos\">&nbsp; </td></tr> 
	       </table>
			</td>
          </tr>
          <tr>
            <td height=\"38\"><script type=\"text/javascript\">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0','width','754','height','38','src','swf/productos_footer','quality','high','pluginspage','http://www.macromedia.com/go/getflashplayer','wmode','transparent','movie','swf/productos_footer' ); //end AC code
        </script>
                <noscript>
                  <object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0\" width=\"754\" height=\"38\">
                  <param name=\"movie\" value=\"swf/productos_footer.swf\">
                  <param name=\"quality\" value=\"high\">
                  <param name=\"wmode\" value=\"transparent\">
                  <embed src=\"swf/productos_footer.swf\" width=\"754\" height=\"38\" quality=\"high\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" type=\"application/x-shockwave-flash\" wmode=\"transparent\"></embed>
                </object>
              </noscript></td>
          </tr>
        </table>
	</td>
  </tr>
</table>"; 		
    
?>