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

$Sql ="UPDATE accion_grupo SET id_grupo = 0 WHERE grupo='Sitio'; ";
cms_query($Sql)or die (error($Sql,mysql_error(),$php));


include ("admin/administracion_sistema/lib.inc.php");

//include ("admin/administracion_sistema/proc/consulta.php");
$id_perfil = perfil($id_sesion);


switch ($act) {
     case 1:
     	
         
		 //include ("sgs/admin_usuarios/proc/relacion_colegios_perfiles.php");  
		 $id_user = $_GET['id_user'];
		 include ("sgs/admin_usuarios/proc/consulta.php");        
         include ("sgs/admin_usuarios/form/formulario.php");
           
         $accion_form = "index.php?accion=$accion&act=2&id_user=$id_user";
         break;
	 case 2:
	 
	 	
			
		
		if($_POST['email']!="" ){
		
		
			include ("sgs/admin_usuarios/proc/modificar.php");  
			 
			//  echo "<script>alert('Sus datos han sido creados satisfactoriamente'); document.location.href='index.php?accion=$accion';</script>\n";      
        
		}else{
	//	header("HTTP/1.0 307 Temporary redirect");
        //header("Location:index.php?accion=$accion&act=1&id_user=$id_user");
		
		}
 		// echo "<script>alert('Sus datos han sido modificados satisfactoriamente'); document.location.href='index.php?accion=$accion';</script>\n";
     /*if($boton!=""){  
		}else{
		
        header("Location:index.php?accion=$accion&act=1&id_user=$id_user");
		}*/
	 
	 	  
         break;
   	 case 3:
       include ("sgs/admin_usuarios/proc/borrar.php");
         break;
		 
		 
		 
		
    case 4:
         $value_pass="value=\"$password_u\"";
         include ("sgs/admin_usuarios/form/formulario.php");           
         $accion_form = "index.php?accion=$accion&act=5";
        
         break;
         
    case 5:
	
		
		if($_POST['email']!="" and $_POST['password']!=""){
		
 			include ("sgs/admin_usuarios/proc/insertar.php");
   			echo "<script>alert('Sus datos han sido creados satisfactoriamente'); document.location.href='index.php?accion=$accion';</script>\n";
   
		}else{
		header("HTTP/1.0 307 Temporary redirect");
        header("Location:index.php?accion=$accion&act=4");
		}
          
       break;
     case 6:
       include ("sgs/admin_usuarios/proc/borrar_perfiles_establ.php");
         break;
         
      case 7:
       include ("sgs/admin_usuarios/proc/activa_usuario.php");
         break;    
      case 77:
       include ("sgs/admin_usuarios/proc/activa_usuario2.php");
         break;    
         
      case 8:
      	include ("sgs/admin_usuarios/proc/historial_compras.php") ;   
		  break;
	  case 9:
			
		include ("sgs/admin_usuarios/proc/xls.php");
		
				//header("Location:index.php?accion=$accion");
		   break;
		   	  
     case 10:
			
		include ("sgs/admin_usuarios/proc/verifica_email.php");
		
				//header("Location:index.php?accion=$accion");
		   break;
	 case 11:
			
		
		include ("sgs/admin_usuarios/proc/export_xls_registrados.php");
		
				//header("Location:index.php?accion=$accion");
		   break;
		   	  
   	 case 12:
			
		
		include ("sgs/admin_usuarios/listado.php");
		
				//header("Location:index.php?accion=$accion");
		   break;
		 case 13:
			
		include ("sgs/admin_usuarios/proc/consulta.php"); 
		include ("sgs/admin_usuarios/ficha_registrado.php");
		
				//header("Location:index.php?accion=$accion");
		   break;
		   	  
   	    default:
	 // include ("sgs/admin_usuarios/proc/lista_usuarios.php");
	    include ("sgs/admin_usuarios/pantalla_ini.php");
   }
    
    
/*if($axj==""){
include("admin/administracion_sistema/tool.php");
$contenido = $tool ."<div id=\"lista\">$contenido	</div>";

}*/

if($axj==""){
 //$contenido=$modulo_usuarios;
}


$carpetas_verifica_permisos = configuracion_cms('verifica permisos carpetas');				      
$aux3=explode(",", $carpetas_verifica_permisos);
$i=0;
 for( $i = 0; $i < count($aux3); $i ++)
    {
      $carpeta_permisos =  trim($aux3[$i]);
      $carpeta_permisos_aux=explode("#", $carpeta_permisos);
      $carpeta = $carpeta_permisos_aux[0];
      $permisos_necesarios=$carpeta_permisos_aux[1];
      if(!is_writable ( $carpeta )){
	  $carpetas .="$carpeta ";
      }
      
     // $permiso = substr(decoct( fileperms ($carpeta) ), 2);
      
      
    }
    
    if($carpetas!=""){
     
   
     
     $lista_de_permisos_archivos= "<table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\" class=\"cuadro_light\">
				     <tr><td align=\"center\" class=\"textos\" colspan=\"2\">
				     <img src=\"images/ordenar.gif\" alt=\"\" border=\"0\">
				     <Strong>Lista de Carpetas con necesidad de permisos lectura y escritura</strong> </td></tr> 				   
				     $lista_carpetas
				  </table>";
     
     
      $_SESSION['cont_msg']++;
		    $texto = "Verifique permisos de escritura en carpetas $carpetas, si ud no ve el menu del sitio es por permisos en la carpeta \"cache/tmp\" (chmod 0777 -R cache/tmp)";
                    $mensaje_tool= genera_alerta($texto,'error',$posicion='top');  
    }



?>