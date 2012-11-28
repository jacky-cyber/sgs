<?php
include("config.inc");  

$act_all = $HTTP_GET_VARS['act_all'];
$ver = $HTTP_GET_VARS['ver'];
$estad = $HTTP_GET_VARS['estad'];
$id_mailing = $HTTP_GET_VARS['id_mailing'];
$id_usuario = $HTTP_GET_VARS['id_usuario'];


$nombre_mailing = $HTTP_POST_VARS['nombre_mailing'];

switch ($act) {
     case 1:
	 include("admin/mailing/accion1.php");
        
         break;
		 case 1001:
	     include("admin/mailing/accion2.php");
        
         break;
		 case 1002:
	     include("admin/mailing/accion3.php");
        
         break;
		  case 1003:
	     include("admin/mailing/accion4.php");
        
         break;
		  case 1004:
	     include("admin/mailing/cambia_imag.php");
        
         break;
		  case 1005:
	     include("admin/mailing/prueba.php");
        
         break;
		  case 1006:
	     include("admin/mailing/ver_aprobacion.php");
        
         break;
		  case 1007:
	     include("admin/mailing/mandar_mailing.php");
        
         break; 
		 case 1008:
	     include("admin/mailing/envio_de_mailing.php");
        
         break;
		 case 1020:
	     include("admin/mailing/editar_mailing.php");//no poseee programa
        
         break;
		 case 1021:
	     include("admin/mailing/add_text.php");
        
         break;
		 
	   case 2:
        include("admin/mailing/estadistica/estadistica.php");
         break;
	  case 3:
        include("admin/mailing/admin/administracion.php");
		//listar_mails.php
         break;
		  case 3010:
        include("admin/mailing/admin/usuarios.php");
		//listar_mails.php
         break; 
		 
		 case 3020:
        include("admin/mailing/admin/listar_mails.php");
		//listar_mails.php
         break;
		case 3021:
        include("admin/mailing/admin/borrar_mails.php");
		//listar_mails.php
         break;
		 case 3022:
        include("admin/mailing/admin/borrar_mails2.php");
		//listar_mails.php
         break;
		 
		 case 3030:
        include("admin/mailing/admin/receptores.php");
		//listar_mails.php
         break;
		   case 3031:
        include("admin/mailing/admin/add_receptores.php");
		//listar_mails.php
         break;
		 case 3032:
        include("admin/mailing/admin/edit_receptores.php");
		//listar_mails.php
         break;
		  case 3033:
        include("admin/mailing/admin/borrar_receptores.php");
		//listar_mails.php
         break;
	    case 3040:
        include("admin/mailing/admin/ver_estados.php");
         break;
		
	 
   	default:
	   include("admin/mailing/accion1.php");
	 
       
 }

include("admin/mailing/menu_izquierdo.php");
?>
