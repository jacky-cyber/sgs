<?php
$js .="<script language=\"JavaScript\" type=\"text/javascript\" src=\"js/ajax.js\"></script>";


switch ($act) {
     case 1:
         include ("usuario/datos_persona.php");
         break;
		default:
	   $def ="ok";
	 include("usuario/lista_usuarios.php");
       
 }




?>