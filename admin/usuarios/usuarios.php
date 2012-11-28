<?php

$id_user = $_GET['id_user'];
//$act_usuario = $_GET['act_usuario'];
$id_perfil_u = $_POST['id_perfil_u'];
$pag = $_POST['pag'];
$login_u = $_POST['login_u'];
$nombre_u = $_POST['nombre_u'];
$apellido_u = $_POST['apellido_u'];
$password_u = $_POST['password_u'];
$ocupacion_u = $_POST['ocupacion_u'];
$edad_u = $_POST['edad_u'];
$direccion_u = $_POST['direccion_u'];
$fono_u = $_POST['fono_u'];
$escolaridad_u = $_POST['escolaridad_u'];
$rut_u = $_POST['rut'];
$email_u = $_POST['email_u'];
$password_u = $_POST['password_u'];
$fecha_nac_u = $_POST['fecha_nac_u'];
$estado_civil_u = $_POST['estado_civil_u'];
$hijos_u = $_POST['hijos_u'];
$establecimiento_u = $_POST['establecimiento_u'];
$celular_u = $_POST['celular_u'];
$equipo_u = $_POST['equipo_u'];
$id_region2 = $_POST['id_region'];
$id_comuna2 = $_POST['id_comuna'];
//$filtro=$_POST['filtro'];


$id_pe = $_GET['id_pe'];
$boton = $_POST['boton'];

$establecimiento_seg = $_POST['establecimiento_seg'];


$id_perf = $_GET['id_perf'];
$id_est = $_GET['id_est'];


$id = $_GET['id'];
$accion = traduce_accion($accion);
$pag = $_GET['pag'];
$id_a = $_GET['id_a'];


include ("admin/administracion_sistema/lib.inc.php");

include ("admin/administracion_sistema/proc/consulta.php");
$id_perfil = perfil($id_sesion);


switch ($act) {
     case 1:
     	
         include ("admin/usuarios/proc/consulta.php");  
		 include ("admin/usuarios/proc/relacion_colegios_perfiles.php");  
		 
		       
         include ("admin/usuarios/form/formulario.php");
           
         $accion_form = "index.php?accion=$accion&act=2&id_user=$id_user";
         break;
	 case 2:
	 
	 	if($boton!=""){
 			 include ("admin/usuarios/proc/modificar.php");        
        // echo "<script>alert('Sus datos han sido modificados satisfactoriamente'); document.location.href='index.php?accion=$accion';</script>\n";
       
		}else{
		header("HTTP/1.0 307 Temporary redirect");
        header("Location:index.php?accion=$accion&act=1&id_user=$id_user");
		}
	 
	 	  
         break;
   	 case 3:
       include ("admin/usuarios/proc/borrar.php");
         break;
		 
		 
		 
		
    case 4:
         $value_pass="value=\"$password_u\"";
         include ("admin/usuarios/form/formulario.php");           
         $accion_form = "index.php?accion=$accion&act=5";
        
         break;
         
    case 5:
		if($boton!="" and $login_u!="" and  $password_u!=""){
			
 			include ("admin/usuarios/proc/insertar.php");
   			  echo "<script>alert('Sus datos han sido creados satisfactoriamente'); document.location.href='index.php?accion=$accion';</script>\n";
   
		}else{
		//header("HTTP/1.0 307 Temporary redirect");
        header("Location:index.php?accion=$accion&act=4");
		}
          
       break;
     case 6:
       include ("admin/usuarios/proc/borrar_perfiles_establ.php");
         break;
         
      case 7:
       include ("admin/usuarios/proc/activa_usuario.php");
         break;    
         
     case 77:
       include ("admin/usuarios/proc/activa_usuario2.php");
         break;    
         
      case 8:
      	include ("admin/usuarios/proc/historial_compras.php") ;   
		  break;
	  case 9:
			
		include ("admin/usuarios/proc/xls.php");
		
				//header("Location:index.php?accion=$accion");
		   break;
	 case 10:
			
		include ("admin/usuarios/listado.php");
		
				//header("Location:index.php?accion=$accion");
		   break;
		   	  
   	    default:
	  if($_GET['tp']!=3){
	   include ("admin/usuarios/pantalla_ini.php");
	   $modulo_usuarios= $contenido;
	  }else{
	   include ("admin/usuarios/proc/lista_usuarios.php");
	  }
	  
   }
    
    
/*if($axj==""){
include("admin/administracion_sistema/tool.php");
$contenido = $tool ."<div id=\"lista\">$contenido	</div>";

}*/

$contenido=$modulo_usuarios;





?>