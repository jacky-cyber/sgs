<?php


$id = $_GET['id'];
$accion = traduce_accion($accion);
$pag = $_GET['pag'];
$id_a = $_GET['id_a'];

$id_auto_admin=$_GET['id_auto_admin'];

session_register_cms('mensaje_tool');


include ("admin/administracion_sistema/lib.inc.php");

include ("admin/administracion_sistema/proc/consulta.php");
$id_perfil = perfil($id_sesion);

function mensaje_tool($mensaje_session,$opcion){
 	           
			   if($mensaje_session==""){
		    		$mensaje_tool ="$opcion";
		    		$_SESSION['mensaje_tool']="";
			    }else{
		    		$mensaje_tool=$mensaje_session;
		    		$_SESSION['mensaje_tool']="";
			    } 
return $mensaje_tool;
}

$tabla = tabla($id_auto_admin); 

if(verfica_permiso($id_auto_admin,$id_perfil,'propietario')){


	$existe_id_usuario=0;
 $sql_master = "SELECT  * FROM $tabla";
 
  $qry = cms_query($sql_master)or die (error($query,mysql_error(),$php));
  $num_campos = mysql_num_fields($qry)or die (error($query,mysql_error(),$php));
  
  
  if($num_campos!=0){
   while($a<$num_campos){
  
    $nom_campo = mysql_field_name($qry,$a);
   
  	if($nom_campo=="id_usuario"){
			$existe_id_usuario=1;
	}
	
  $a++;
  }
			   
  		 
 }

if($existe_id_usuario!=0){


 $query= "ALTER TABLE $tabla ADD id_usuario INT NOT NULL";
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
    	
}



$id_usuario     = id_usuario($id_sesion);
$condicion_propietario = " and id_usuario=$id_usuario";

}

$contenido ="";
$js .="";

switch ($act) {
     case 1:
	if(verfica_permiso($id_auto_admin,$id_perfil,'crear')){
		
		if($id==""){
	   			$mensaje_tool = mensaje_tool($_SESSION['mensaje_tool'],"Crear Registro");
	   	 		$accion_form = "index.php?accion=$accion&id_a=$id_auto_admin&act=2";
		}else{
				$mensaje_tool = mensaje_tool($_SESSION['mensaje_tool'],"Editar Registro"); 
			
		 
			
		$accion_form = "index.php?accion=$accion&id_a=$id_auto_admin&id=$id&act=3";
		
		}
		$id = $_GET['id'];
		
		
		
        	 include ("admin/administracion_sistema/form/formulario.php");
         
     }elseif(verfica_permiso($id_auto_admin,$id_perfil,'editar')){
			
			$mensaje_tool = mensaje_tool($_SESSION['mensaje_tool'],"Editar Registro"); 
			$accion_form = "index.php?accion=$accion&id_a=$id_auto_admin&id=$id&act=3";
			  include ("admin/administracion_sistema/form/formulario.php");
		
	}else{
			
			header("Location:index.php?accion=$accion");
	}
         break;
		 
	 case 2:
	 	if(verfica_permiso($id_auto_admin,$id_perfil,'crear')){
				
		include ("admin/administracion_sistema/proc/insertar.php");
		
		if($_POST['Aceptar']!=""){
		$_SESSION['mensaje_tool'] ="Registro Actualizado";

		  $id = $_GET['id2'];
		  header("Location:index.php?accion=$accion&act=1&id_a=$id_a&id=$id");			
		}elseif($_POST['crear_otro']!=""){
		 $_SESSION['mensaje_tool'] ="Registro Creado";
	     header("Location:index.php?accion=$accion&act=1&id_a=$id_a");		
		}else{
		
		$_SESSION['mensaje_tool'] ="Registro Agregado";

		//  $id = $_GET['id2'];
		 //  header("Location:index.php?accion=$accion&act=1&id_a=$id_a&id=$id");			
		 header("Location:index.php?accion=$accion");			
		
		
		}
					 
         }else{			
			header("Location:index.php?accion=$accion");
		}
        
         break;
    case 3:
	
	
    	if(verfica_permiso($id_auto_admin,$id_perfil,'editar')){
			//echo "hola";
		include ("admin/administracion_sistema/proc/actualizar.php");
		//echo "actualiza";
		$_SESSION['mensaje_tool'] ="Registro Actualizado";
		
		if($_POST['aceptar']!=""){
			//echo "no autorizado";
			$id = $_GET['id'];
			$Sql ="UPDATE auto_admin_control_version
			       SET abierto='0'
			       WHERE id_auto_admin ='$id_auto_admin'
			       and id_registro='$id'
			       and abierto=1";
 				  
			   cms_query($Sql)or die ("ERROR $php <br>$Sql");
			
			   header("Location:index.php?accion=$accion");
		
		}elseif($_POST['actualizar']!=""){
		
			   header("Location:index.php?accion=$accion&act=1&id_a=$id_a&id=$id");
		//header("Location:index.php?accion=$accion");
		
		}
		 
		 
         }else{
			echo "no autorizado";
			//header("Location:index.php?accion=$accion");
		}
         
         break;
    case 4:
    	if(verfica_permiso($id_auto_admin,$id_perfil,'borrar')){
  
    	
		$_SESSION['mensaje_tool']= "Registro Borrado";
		include ("admin/administracion_sistema/proc/borrar.php");	 
		 
         }else{
			
			header("Location:index.php?accion=$accion");
		}
         
         break;
  	case 5:
  		if(verfica_permiso($id_auto_admin,$id_perfil,'ordenar')){
    		
		
			     // include ("admin/administracion_sistema/proc/ordenar.php");
			    // include ("admin/administracion_sistema/proc/ordenar2.php");
			   include ("admin/administracion_sistema/new_orden.php");
		 
		 
			   }else{
			
			header("Location:index.php?accion=$accion");
		}
		 break;
   case 6:
   	
         include ("admin/administracion_sistema/proc/select_tabla.php");
		  break;
	 case 7:
	 	if(verfica_permiso($id_auto_admin,$id_perfil,'editar')){
			
		include ("admin/administracion_sistema/proc/borrar_imagen.php");
		 
         }else{
			
			header("Location:index.php?accion=$accion");
		}
		  break;
		  
	case 8:
		
		if(verfica_permiso($id_auto_admin,$id_perfil,'configurar')){
			include ("admin/administracion_sistema/proc/lista_configuracion.php");
			include ("admin/administracion_sistema/apps/apps.php");
			
			
		}elseif($id_perfil=999){
			
		include ("admin/administracion_sistema/proc/lista_configuracion.php");
		}else{
		header("Location:index.php?accion=$accion");
		}
         
		  break; 
	case 9:
			include ("admin/administracion_sistema/proc/configurar_permisos.php");
			header("Location:index.php?accion=$accion&act=8");
		  break; 
	case 10:
			include ("admin/administracion_sistema/proc/agregar.php");
				header("Location:index.php?accion=$accion&act=8");
		  break; 
	case 11:
			include ("admin/administracion_sistema/proc/borrar_privilegios.php");
		
		  break; 
	case 12:
			if(verfica_permiso($id_auto_admin,$id_perfil,'configurar')){
				include ("admin/administracion_sistema/proc/importar.php");
				//header("Location:index.php?accion=$accion");
			}else{
			
				header("Location:index.php?accion=$accion");
			}
		
		   break; 		   		  		   		 
   case 13:
			if(verfica_permiso($id_auto_admin,$id_perfil,'crear')){
			
				include ("admin/administracion_sistema/form/formulario_tabla.php");
				//header("Location:index.php?accion=$accion");
			}
		
		   break; 		   		  		   		 
  case 14:
			if(verfica_permiso($id_auto_admin,$id_perfil,'ver')){
			$mensaje_tool = mensaje_tool($_SESSION['mensaje_tool'],"Busqueda Avanzada"); 
				include ("admin/administracion_sistema/proc/busqueda_avanzada.php");
				//header("Location:index.php?accion=$accion");
			}
		
		   break; 		   		  		   		 
  case 15:
				//verificar unico
		
		$nom_cmpo = $_GET['nom_cmpo'];
		$new_dato = $_GET['new_dato'];
		
		$tabla=$nom_tabla;
		$id_campo_selecionado = $new_acci;
		$condicion =" $nom_cmpo= '$new_dato'";
		$campo = $nom_cmpo;
		
		
		
		
		
	 
	   $query= "SELECT $campo   
                FROM  $tabla
                WHERE  $condicion";
          $result= cms_query($query)or die (error($query,mysql_error(),$php));
           list($campo_res) = mysql_fetch_row($result);
		   
		   
	 			if($campo_res!=""){
	 					$contenido="<img src=\"images/atencion_pequenia.gif\" alt=\"La acción ya existe\" border=\"0\">Este valor ya existe";
	 				}
		
		
		
		   break; 	
		   
		   case 16:
			if(verfica_permiso($id_auto_admin,$id_perfil,'ver')){
				
			}
			include ("admin/administracion_sistema/proc/xls.php");
				//header("Location:index.php?accion=$accion");
		   break; 

		  
		   case 17:
			
		include ("admin/administracion_sistema/index_apps.php");
				//header("Location:index.php?accion=$accion");
		   break;  
		   
		 case 18:
			
		include ("admin/administracion_sistema/proc/ver.php");
				$contenido = $datos_registro;
				//header("Location:index.php?accion=$accion");
		   break;  
		   case 19:
						
			   include ("admin/administracion_sistema/proc/cambia_estado_xml.php");
				//header("Location:index.php?accion=$accion");
		   break; 
		   case 20:
		   $campo = $_GET['campo'];
				$query= "SELECT help,unic   
               FROM  auto_admin_campo 
               WHERE id_auto_admin='$id_auto_admin' and campo = '$campo'";
			   
			  
         $result3= cms_query($query)or die (error($query,mysql_error(),$php));
		 list($help_txt,$unic) = mysql_fetch_row($result3);
		 $contenido = 	  "<table   border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                            <tr >
                              <td align=\"left\" class=\"textos\">$help_txt</td>
                              </tr>
                        	</table>";	
		 
		//include ("admin/administracion_sistema/proc/cambia_estado_xml.php");
				//header("Location:index.php?accion=$accion");
		   break; 
		   
	/*  $query= "SELECT help,unic   
               FROM  auto_admin_campo 
               WHERE id_auto_admin='$id_auto_admin' and campo = '$nom_campo'";
			   
			  
         $result3= cms_query($query)or die (error($query,mysql_error(),$php));
		 list($help_txt,$unic) = mysql_fetch_row($result3);
	*/ 
			   case 22:
			   
			   
						
			   include ("admin/administracion_sistema/lista.php");
		
			   
				//header("Location:index.php?accion=$accion");
		   break; 
		    
		  
   	default:
	
	$tabla=$nom_tabla;
   		if(verfica_permiso($id_auto_admin,$id_perfil,'listar')){
    		 
		$mensaje_tool = mensaje_tool($_SESSION['mensaje_tool'],"lista Registro"); 
		$query= "SELECT count(*)
                FROM  $tabla";
          $result= cms_query($query)or die (error($query,mysql_error(),$php));
		  $max_lista_auto_admin= configuracion_cms('max_lista_auto_admin');
		  if($max_lista_auto_admin==""){
		  	$max_lista_auto_admin=1000;
		  }
	  list($tot_reg) = mysql_fetch_row($result);
      
	  if($_GET['tp']==3){
	   if($tot_reg<$max_lista_auto_admin){
			   include ("admin/administracion_sistema/proc/listar.php");
	   }else{
			    include ("admin/administracion_sistema/proc/listar-old.php");		   
	   }
	  
	  }else{
			   
			 include ("admin/administracion_sistema/pantalla_ini.php");   
	  }
	  
		   
		
			   
         
         }
         
		
         
}
$mensaje_tool="";

if($axj==""){


    include("admin/administracion_sistema/tool.php");


$contenido = $tool ."<div id=\"lista\">$contenido </div>


";
}


?>