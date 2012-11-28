<?php
$error = $_GET['error'];
$new_accion = $_POST['new_accion'];
$new_act = $_POST['new_act'];
$php = $_POST['php'];
$descrip_php = $_POST['descrip_php'];
//$descrip_php=acentos($descrip_php);
$home = $_POST['home'];
$id_gru = $_GET['id_gru'];

$id_tabla = $_POST['id_tabla'];
$id_contenido = $_POST['id_contenido'];

$id_grupo = $_POST['id_grupo'];

$id = $_GET['id'];
$msg = $_GET['msg'];
$edit = $_GET['edit'];
$cascada = $_POST['cascada'];
$cambia = $_GET['cambia'];


$id_tipo_f = $_POST['id_tipo_f'];
$id_contenido = $_POST['id_contenido'];
$id_tabla = $_POST['id_tabla'];
$descrip_php_esp = $_POST['$descrip_php_esp'];
$etiqueta = $_POST['etiqueta'];
$id_etiqueta = $_GET['id_etiqueta'];
$publica_noticia = $_POST['publica_noticia'];
$etiqueta = $_POST['etiqueta'];
$presente = $_POST['presente'];
$id_templates = $_POST['id_templates'];
$opcion = $_POST['opcion'];
$nombre_accion = $_POST['nombre_accion'];
$id_tipo_noticia = $_POST['id_tipo_noticia'];
$php = $_POST['php'];




$id_p = $_GET['id_p'];

$help = $_POST['help'];



include("admin/acciones/menu_acciones.php");

switch ($act) {
     case 1:
	 	 include ("admin/acciones/delete.php");
         break;
         
  	case 2:
         include ("admin/acciones/add_accion.php");
         break;
	 
 	case 3:
         include ("admin/acciones/relocaliza.php"); //no estoy 100% que se utilice
         break;
	case 4:
		
		include ("admin/acciones/update_acciones.php");
         break;
	case 5:
         include ("admin/acciones/visible_acciones.php");
         break;
   
    case 6:
         include ("admin/acciones/lista_contenido.php");
         break;
	case 7:
         include ("admin/acciones/formulario.php");
         break;
         
    case 8:       	    	
         inserta('accion_etiqueta');         
          header("Location:?accion=$accion&act=17&id_gru=$id_gru&id=$id");  
  									
         break;
    
    case 9:
    	 borrar('accion_etiqueta',$id_etiqueta);
         header("Location:?accion=$accion&act=17&id_gru=$id_gru&id=$id");
         break;     
   case 10:
	    $descrip_php = $_GET['descrip_php'];
		
		/*if(is_numeric($new_acci)){
		}elseif($new_acci!=""){
		$contenido="<img src=\"images/not_ok2.gif\" alt=\"Solo numeros\" border=\"0\">Solo numeros";
		}*/
		
		if($descrip_php!=""){
			
		
		$tabla="acciones";
		$id_campo_selecionado = $new_acci;
		$condicion =" descrip_php_esp= '$descrip_php'";
		$campo = "id_acc";
	 
	   $query= "SELECT $campo   
                FROM  $tabla
                WHERE $condicion";
          $result= cms_query($query)or die (error($query,mysql_error(),$php));
           list($campo_res) = mysql_fetch_row($result);
		   
		   
	 			if($campo_res!=""){
	 					$contenido="<img src=\"images/not_ok2.gif\" alt=\"La acción ya existe\" border=\"0\">La acci&oacute;n ya existe";
	 				}else{
	 					$contenido="<img src=\"images/ok2.gif\" border=\"0\">";
	 				}
		
		
	 }else{
	 	
	 	$contenido = "";
	 }
  
         break; 
		 
	case 11:
	$id_contenido = $_GET['id_contenido'];
    $id_noticia = $_GET['id_noticia'];
	include("admin/acciones/contenido_estatico_admin.php");
	 break;
		case 12:
	
	include("admin/acciones/agregar_contenido.php");
	 break;
	 case 13:
	
	include("admin/acciones/borrar_contenido.php");
	 break; 
	 
	 case 14:
	 
	 include("admin/acciones/actualizar_defect_contenido.php");
	 break;
	 
	 case 15:
	 

	 include("admin/acciones/lista_opciones_menu.php");
	 break;
	 
	case 16:
	 
	 include("admin/acciones/formulario_contenido.php");
	 
	 break;
	 
	case 17:
	 
	 include("admin/acciones/editar.php");
	 include("admin/acciones/accion_acciones.php");
	 include ("admin/acciones/lista_contenido.php");
	 $accion_form = $PHP_SELF."?accion=$accion&act=4&id=$id";		
	 break;
	case 18:
	 
	 include("admin/acciones/update_opcion.php");
	 header("Location:?accion=$accion&id=$id&act=17&opcion=$opcion&id_gru=$id_gru");
	 break;
	case 19:
	 
	 include("admin/acciones/volver_opcion.php");
	 header("Location:?accion=$accion&id=$id&act=17&opcion=$opcion&id_gru=$id_gru");
	 break;
	     
   	default:
	case 20:
	 
	 include("admin/acciones/add_accion_acciones.php");
	 header("Location:?accion=$accion&id=$id&act=17&opcion=$opcion&id_gru=$id_gru");
	 break;
	case 21:
	 
	 include("admin/acciones/del_accion_acciones.php");
	 header("Location:?accion=$accion&id=$id&act=17&opcion=$opcion&id_gru=$id_gru");
	 break;
	case 22:
		include ("admin/acciones/add_accion_idioma.php");
	 break;
	 case 23:
	 $id_id = $_GET['id_idioma'];
	 $query= "SELECT accion
               FROM  accion_idioma
			    WHERE id_accion_idioma=$id_id";
			 $result23= cms_query($query)or die (error($query,mysql_error(),$php));	 
			list($id_accion) = mysql_fetch_row($result23);	
	
	 	 $Sql ="DELETE FROM accion_idioma where id_accion_idioma=$id_id";
          cms_query($Sql)or die ("ERROR $php <br>$Sql");
		  
		 	 $query= "SELECT id_accion_idioma,traduccion,id_idioma
               FROM  accion_idioma
			    WHERE accion='$id_accion'";
			
         $result23= cms_query($query)or die (error($query,mysql_error(),$php));
          while (list($id_accion_idioma,$traduccion,$id_idioma) = mysql_fetch_row($result23)){
		  
		  	   $idioma = rescata_valor('deuman_idioma',$id_idioma,'idioma');
		
    				$lista_idiomas .="<tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">
					<td align=\"center\" class=\"textos\">
					$idioma </td>
					<td align=\"center\" class=\"textos\">$traduccion</td> 
					<td align=\"center\" class=\"textos\">
					<a href=\"#\" onclick=\"ObtenerDatos('index.php?accion=$accion&act=23&id_idioma=$id_accion_idioma&axj=1','div_respuesta');\">
					<img src=\"images/del.gif\" alt=\"Eliminar\" border=\"0\"></a>
					</td> </tr> ";		   
    		 }
			
			 $contenido ="<table width=\"300\"  border=\"0\" align=\"center\" cellpadding=\"1\" cellspacing=\"1\">
                             $lista_idiomas
                          	</table>";
							
							
							 
		 
	 break;
	   case 24:
			   
		
			
			 include ("admin/acciones/ordena_acciones_ajax.php");
		
			   
				
		   break; 
		    
   	default:
	 include("admin/acciones/admin_menu2.php");


     }


?>