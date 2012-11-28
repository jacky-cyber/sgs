<?php
$act_apps = $_GET['act_apps'];
$nom_apps = $_POST['nom_apps'];
$apps = $_POST['apps'];



$boton = $_POST['boton'];
$id_apps = $_GET['id_apps'];

  
						   
		


switch ($act_apps) {
     case 'a':
         include ("admin/administracion_sistema/apps/form/formulario.php");          
          $accion_form = "index.php?accion=$accion&act=8&act_apps=b";
         break;
         
	 case 'b': 
	 $id_apps = $_GET['id_apps'];
	    include ("admin/administracion_sistema/apps/proc/insertar.php");	   
        header("Location:index.php?accion=$accion&act=8&id_apps=$id_apps");       
       break;
       
     case 'c':      	
     	 include ("admin/administracion_sistema/apps/proc/consulta.php"); 
     	 include ("admin/administracion_sistema/apps/form/formulario.php");      
                
           $accion_form = "index.php?accion=$accion&act=8&id_apps=$id_apps&act_apps=e";
         break;
    case 'd':     	 
         include ("admin/administracion_sistema/apps/proc/borrar.php");           
           header("Location:index.php?accion=$accion&act=8&id_apps=$id_apps");
         break;
         
      case 'e':
      	$id_apps = $_GET['id_apps'];     	 
           include ("admin/administracion_sistema/apps/proc/editar.php");          
           header("Location:index.php?accion=$accion&act=8&id_apps=$id_apps");
         break;
         
       case 'f':     	 
           include ("admin/administracion_sistema/apps/proc/agregar_perfil.php");          
           header("Location:index.php?accion=$accion&act=8&id_apps=$id_apps");
         break;
             
      case 'g':     	 
           include ("admin/administracion_sistema/apps/proc/del_perfil.php");          
           header("Location:index.php?accion=$accion&act=8&id_apps=$id_apps");
         break;
         
          case 'h':
			
		
		$new_dato = $_GET['new_dato'];
		
		
		
$query= "SELECT id_auto_admin 
           FROM  acciones
           WHERE accion='$accion'";

     $result= cms_query($query)or die (error($query,mysql_error(),$php));
    list($id_auto_admin) = mysql_fetch_row($result);
    
    
    
    $nom_tabla =tabla($id_auto_admin);


						$ruta= "images/sitio/sistema/$nom_tabla/auto_admin_apps/$new_dato";
						
			if(!is_file("$ruta")){
				
		
	 					$contenido="<img src=\"images/atencion_pequenia.gif\" alt=\"La acción ya existe\" border=\"0\">Esta aplicaci&oacute;n no existe $ruta";
	 				}else{
	 					$contenido="";

	 				}
	 				
		
		   break; 	
             
         
         
   	default:
	   include ("admin/administracion_sistema/apps/proc/lista_apps.php");
   }


?>