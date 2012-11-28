<?php


$cantidad = $_GET['cantidad'];
$tipo = $_GET['tipo'];

$id_contenido = $_GET['id_contenido'];
if($id_contenido!="" and $act==""){


$act=1;
}

switch ($act) {
	 case 1:
	
         include ("contenido/ver_principal.php");
         break;
         
     case 5:
         include ("contenido/VerNoticia.php");
         break;
	
	 case 6:
         include ("contenido/imprimir_noticia.php");
         break;
	case 7:
         include ("contenido/enviar_amigo.php");
         break;
   	default:
	 
	 
      include("contenido/portada.php");
 }


?>