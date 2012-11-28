<?php
//envia E-mail
$remitente = "ricardo@epsi.cl";
$titulo= "Generación de Registro Tubopack";

# Indicamos la dirección (nombre) del servidor

$server_name = "tubopack.cl";

# Indicamos el nombre de la persona que va a recibir el mensaje

$person_name = "$nombre_u";

# Indicamos la dirección de correo de esa persona



# Las tres líneas que vienen a continuación son necesarias
# para que la cabecera del mensaje esté en formato HTML

$header = "MIME-Version: 1.0\n";
$header .= "Content-Type: text/html; charset=iso-8859-1\n";
$header .="From: $remitente";

# Esto que viene es el mensaje. (Fíjate en los tags HTML)

$mensaje = "
<td bgcolor=\"#DEE7F8\" align=\"center\" class=\"textos\">
<table width=\"90%\"  border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\">
     <tr>
     <td align=\"left\" class=\"textos\">
      Sr(a)<br>
     $person_name<br>
     PRESENTE
     </td>
     </tr>
    <tr>
    <td align=\"left\" class=\"textos\">
    Estimado sr(a) junto con saludarle cordialmente le damos la bienvenida a nuestros servicios de Intranet Corporativa, para acceder a ella solo debe ingresar a la siguiente dirección web.<br><br>
    Su login:&nbsp;$login_u<br>
    Su password:&nbsp;$password_u<br>
    <a href='http://www.tubopack.cl/intranet'>http://www.tubopack.cl/intranet</a><br>
   <a href='mailto:ricardor@epsi.cl'>operaciones@tubopack.cl</a><br><br>
   
     </td>
    </tr>
     <tr>
     <td align=\"left\" class=\"textos\">     
   Sin otro particular;<br>
   </td>
    </tr>
    <td align=\"left\" class=\"textos\">     
   Saluda Atte. a Ud.,</td>
    </tr>
    <tr>
    <td align=\"center\" class=\"textos\">  
   Jorge Hemus <br>
   <b>Tubpack Packaging Solutions</b>
   </td>
    </tr>
 
   
	</table>
</td>
</tr>";





# Función de envío del mensaje

if(cms_mail($email_u,$titulo,"$mensaje","$header")){
//echo "Mensaje enviado.";
}else{
//echo "no paso na";
}

# Ten en cuenta que:
# $person_email es la dirección de correo de la persona que recibe el mensaje
# "Recomendación" es el Asunto del mensaje
# $mensaje es todo el texto del mensaje
# $header es la cabecera. En ella va incluida la dirección de remite.

# Para comprobar que el script ha funcionado, podemos poner lo siguiente:

//echo $mensaje;
?>