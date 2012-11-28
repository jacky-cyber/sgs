<?php

switch($act){
     case 1:
       
       break;

         
      case 2:
	 	$html = $_POST['html'];
         include ("contacto/enviar_consulta.php");
         break;

		case 3:
			include("contacto/datos.php");
		break;
		
		case 4:
			include("contacto/fin_contacto.php");
		break;
		
		
     default:
     	
     	include ("captcha/captcha.php");
	   include ("contacto/formulario.php");
}



?>



