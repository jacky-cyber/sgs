<?php

switch ($act) {
     case 1:
         include ("admin/grupos/editar_grupo.php");
         break;
	 case 2:
         include ("admin/grupos/add_grupo.php");
         break;
	 case 3:
         include ("admin/grupos/del_grupo.php");
         break;
	 case 4:
         include ("admin/grupos/modificar_grupo.php");
         break;
   	default:
	   include ("admin/grupos/listar_grupo.php");
	 
       
 }

?>