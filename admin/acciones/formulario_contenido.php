<?php


$opcion = $_GET['opcion'];


  $query= "SELECT php   
           FROM  accion_opciones_menu 
           WHERE id_opcion_menu='$opcion'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      list($php) = mysql_fetch_row($result);
	  
	  
	$accion_form = $PHP_SELF."?accion=$accion&act=2";	  

switch ($opcion) {
     case 1:
         include ("admin/acciones/formularios/formulario_menu_contenido.php");
         break;
	 case 2:
         include ("admin/acciones/formularios/formulario_modulo_auto_admin2.php");
         break;
   	 case 3:
         include ("admin/acciones/formularios/formulario_modulo_clasico.php");
         break;
   	default:
	 case 4:
         include ("admin/acciones/formularios/formulario_noticia.php");
         break;
   	default:
	 header("HTTP/1.0 307 Temporary redirect");
	 header("Location:index.php?accion=$accion&act=15");
   }





?>