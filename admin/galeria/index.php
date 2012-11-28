<?php
$act = $_GET['act'];
$id_galeria = $_GET['id_galeria'];

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
         include ("admin/mailing_galeria/gal.php");
         break;
  	  case 2:
         include ("admin/mailing_galeria/edit_gal.php");
         break;
  	  case 3:
         include ("admin/mailing_galeria/edit_gal.php");
         break;
  	default:
	  include ("admin/mailing_galeria/gal.php");
      
       
 }


?>