<?php
$act_perfiles = $_GET['act_perfiles'];

$id_perfil_admin=999;

switch ($act_perfiles) {
     case 1:

         include ("admin/perfiles/add_perfil.php");
         break;
 	 case 2:
         include ("admin/perfiles/edit_perfil.php");
         break;
 	
   	default:
	   include ("admin/perfiles/cuadro_perfiles.php");


}
   
?>