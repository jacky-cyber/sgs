<?php

switch ($act) {
     case 1:
         include ("usuario/envia_solicitud_actualiza_email1.php");
         break;
	 case 2:
         include ("usuario/verificacion_nuevo_email.php");
         break;
    case 3:
         include ("usuario/activacion_nuevo_email.php");
         break;
   	default:
	   


 $js .="<style type=\"text/css\">


.cmxform  p.error  { 

color: red; 
}

input.error { 

border: 2px solid red; 
}

</style>

<script type=\"text/javascript\">

$.validator.setDefaults({
	//submitHandler: function() { alert(\"submitted!\"); }
});





$().ready(function() {

	
	// validate signup form on keyup and submit
	$(\"#form1\").validate({
		rules: {
			
			nuevo_email: {
				required: true,
				email: true
			}
		},
		messages: {
			nuevo_email: \"Email no v&aacute;lido\"
		}
	});
});







</script>";
 $email = email($id_sesion);
 $accion_form = "?accion=$accion&act=1";
 
 $contenido = html_template('formulario_olvido1');	
 $contenido = str_replace("#CORREO#","<STRONG>$email</STRONG>",$contenido);

	 
     
 }
 
 $contenido .= "<br><br><br><br><br><br><br><br><br><br><br><br>";
?>