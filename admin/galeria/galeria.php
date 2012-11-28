<?php
include("gal/config_gal.php");

$id_galeria = $_GET['id_galeria'];
$id_imagen = $_GET['id_imagen'];

$sig = $_GET['sig'];
$ini = $_GET['ini'];
if(!isset($ini)){
$ini=0;
}

if(!isset($sig)){
$sig=3;
}

switch ($act) {
     case 1:
         include ("admin/galeria/new_gal.php");
         break;
  	  case 2:
         include ("admin/galeria/add_gal.php");
         break;
  	  case 3:
         include ("admin/galeria/formulario_foto.php");
         break;
  	  case 4:
         include ("admin/galeria/add_foto.php");
         break;
  	  case 5:
         include ("admin/galeria/edit_gal.php");
         break;
  	 case 6:
         include ("admin/galeria/del.php");
         break;
     case 7:
         include ("admin/galeria/foto_portada.php");
         break;
     case 8:
         include ("admin/galeria/comentario_foto.php");
         break;

  	default:
	  include ("admin/galeria/gal.php");
      
       
 }

?>