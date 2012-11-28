<?php
$error = $_GET['error'];
$new_accion = $_POST['new_accion'];
$new_act = $_POST['new_act'];
$php = $_POST['php'];
$descrip_php = $_POST['descrip_php'];
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
$$descrip_php_esp = $_POST['$descrip_php_esp'];
$etiqueta = $_POST['etiqueta'];
$id_etiqueta = $_GET['id_etiqueta'];
$publica_noticia = $_POST['publica_noticia'];
$etiqueta = $_POST['etiqueta'];
$presente = $_POST['presente'];
$id_templates = $_POST['id_templates'];


$help = $_POST['help'];


//echo "$cambia";
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
          header("Location:?accion=$accion&act=6&id_gru=$id_gru&id=$id");  
  									
         break;
    
    case 9:
    	borrar('accion_etiqueta',$id_etiqueta);
        header("Location:?accion=$accion&act=6&id_gru=$id_gru&id=$id");
         break;     
   case 10:
	$new_acci = $_GET['new_accion'];
		
		if(is_numeric($new_acci)){
		$tabla="acciones";
		$id_campo_selecionado = $new_acci;
		$condicion =" accion= $new_acci";
		$campo = "id_acc";
	 
	   $query= "SELECT $campo   
                FROM  $tabla
                WHERE  $condicion";
          $result= cms_query($query)or die (error($query,mysql_error(),$php));
           list($campo_res) = mysql_fetch_row($result);
		   
		   
	 			if($campo_res!=""){
	 					$contenido="<img src=\"images/not_ok2.gif\" alt=\"La acción ya existe\" border=\"0\">La acci&oacute;n ya existe";
	 				}else{
	 					$contenido="<img src=\"images/ok2.gif\" border=\"0\">";
	 				}
		}elseif($new_acci!=""){
		$contenido="<img src=\"images/not_ok2.gif\" alt=\"Solo numeros\" border=\"0\">Solo numeros";
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
	     
   	default:
	   
	 
      
	  
	   
 

 if($msg==1){
 	
 	echo "<script>alert('Esta Acción ya Existe'); </script>\n";
 }
 
 
 $id_p = $_GET['id_p'];
 
 
  if($id_p!=""){
		 $tablas_cond =", usuario_perfil_relacion";
		 $condicion_relacion ="WHERE id_perfil_padre=$id_p AND id_perfil= id_perfil_hijo";
		 $nivel_perfil_p= nivel_perfil($id_p);
		 $nivel_perfil_p++;
		 $url_id_p="&id_p=$id_p";
		 $nivel=nivel_perfil($id_p);
	     $nivel++;
		 
	}else{
		 
		 $nivel_perfil_p=0;
		 $nivel=0;
	}
 
 
 
$query = "SELECT id_perfil,perfil  
          FROM usuario_perfil $tablas_cond
		  $condicion_relacion
		  ORDER BY id_perfil";		  

	
$result_user = cms_query($query) or die ("problemas en la consulta 1.<br>$query");


 while(list($id_perfil_check,$perfil) = mysql_fetch_row($result_user)){
			
		$id_acc=accion_id_acc($id);
		
		 $query= "SELECT accion   
                   FROM  accion_perfil
                   WHERE accion='$id_acc' and id_perfil=$id_perfil_check";
         // echo $query."<br>";
			 $result_aci_perf= cms_query($query)or die (error($query,mysql_error(),$php));
              list($accion_res) = mysql_fetch_row($result_aci_perf);
        	//echo $accion_res." c<br>";
				if($accion_res!=""){
					$check="checked";		   
        		 }else{
				 	$check="";
				 }
				 
				 
	        $nivel2= nivel_perfil($id_perfil_check);
			if($nivel==$nivel2 and hijos_perfil($id_perfil_check)==true){
				
		
				
				$check_perfiles .= "<td align=\"center\" class=\"textos\">
				<a href=\"index.php?accion=$accion&id_p=$id_perfil_check".$url_grupo."\">
				<font color=\"#FF0000\">$perfil</font></a>
       	<input type=\"checkbox\" name=\"perfil_$id_perfil_check\" value=\"checkbox\" $check></td>";
       
		    }elseif($nivel==$nivel2){
				
				$check_perfiles .= "<td align=\"center\" class=\"textos\">$perfil
       	<input type=\"checkbox\" name=\"perfil_$id_perfil_check\" value=\"checkbox\" $check></td>";
       
				
			}
	
 }
 
 if($id_p!=""){
$accion_form_url ="&id_p=$id_p";


$id_perf_padre = perfil_padre($id_p);
	
$nivel_perfil=0;
	    $perfil = perfil_padre($id_p);
		//echo $perfil;
		$perfil_nombre = nombre_perfil($id_p);
		$camino_perfil = "<a href=\"index.php?accion=$accion&id_p=$id_p".$url_grupo."\">$perfil_nombre</a> / ".$camino_perfil;
		
	    while($perfil!=0){
		    
			$perfil_nombre = nombre_perfil($perfil);
			$camino_perfil = "<a href=\"index.php?accion=$accion&id_p=$perfil".$url_grupo."\">$perfil_nombre</a> / ".$camino_perfil;
			$perfil = perfil_padre($perfil);
		}
$camino_perfil = "<a href=\"index.php?accion=$accion".$url_grupo."\">Raiz</a> / ".$camino_perfil;
			
}
 


 		 
 		 
 		 
 
$perfil_usuarios=  "<table width=\"60%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
    <tr >
      $check_perfiles 
      </tr>
	</table>";
  







if(isset($error)){
$mensaje = "  <table width=\"300\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                 <tr>
                   <td align=\"center\" class=\"textos1\">
				   <font color=\"#FF0000\">No se ha logrado agregar el m&oacute;dulo</font> 
				   </td>
                   </tr>
				   <tr>
                   <td align=\"center\" class=\"textos1\">
				   &nbsp;
				   </td>
                   </tr>
             	</table>";
}



$query= "SELECT id_grupo,grupo 
 		            FROM  accion_grupo
 		            ORDER BY id_grupo asc";
 		      $result2= cms_query($query)or die (error($query,mysql_error(),$php));
 		       while (list($id_grupo,$grupo) = mysql_fetch_row($result2)){
 		 				if($id_grupo==$id_gru){
 		 					$lista_sel .="<option value=\"$id_grupo\" selected>$grupo</option>";
 		 				}else{
 		 					$lista_sel .="<option value=\"$id_grupo\" >$grupo</option>";
 		 				}
 		 		 }
 		$grupo = " <select name=\"id_grupo\" >
 		 
 		 $lista_sel
 		 </select>";

 		$js .="<script language=\"JavaScript\">
 		function validaforma(theForm){
 		
 			if (theForm.new_accion.value == \"\"){
 					alert(\"Por favor Ingrese una Acción.\");
 					theForm.new_accion.focus();
 					return false;
 			}
 			if (theForm.php.value == \"\"){
 					alert(\"Por favor Ingrese un Php.\");
 					theForm.php.focus();
 					return false;
 			}
 			if (theForm.descrip_php.value == \"\"){
 					alert(\"Por favor Ingrese una Descripción.\");
 					theForm.descrip_php.focus();
 					return false;
 			}
 			
 		
 		}
		
		
 		
	 
	 function activa(){
if (document.forms.form1.id_tipo_f.value == 1){
	
	document.forms.form1.php.value='admin/administracion_sistema/administracion_sistema.php';

	
	
 }
if (document.forms.form1.id_tipo_f.value == 2){
	
	document.forms.form1.php.value='contenido/contenido_estatico.php';

	
	
 }
if (document.forms.form1.id_tipo_f.value == 3){
	
	document.forms.form1.php.value='admin/admin_auto_fichas/admin_auto_fichas.php';

	
	
 }
}
 
 
 
 

 
 </script>
		";
 		
		
		if($edit=="ok"){
			  $query= "SELECT id_acc,accion,act,php,descrip_php_esp,descrip_php_eng,home,icono,id_grupo,defecto,orden,id_tipo,id_contenido,id_auto_admin,publica_noticia,help ,etiqueta,presente,id_templates    
                       FROM  acciones
                       WHERE id_acc='$id'";
                 $result= cms_query($query)or die (error($query,mysql_error(),$php));
                 list($id_acc,$new_accion,$act,$php,$descrip_php,$descrip_php_eng,$home,$icono,$id_grupo,$defecto,$orden,$id_tipo,$id_contenido,$id_auto_admin,$publica_noticia,$help,$etiqueta,$presente,$id_templates) = mysql_fetch_row($result);
					
					$var = "home_$home";
					$$var = "checked";
					$var = "presente_$presente";
					$$var="checked";
					
				/*	$presente_0
			  $query= "SELECT id_perfil    
                       FROM  accion_perfil
                       WHERE accion ='$new_accion'";
                 $result= cms_query($query)or die (error($query,mysql_error(),$php));
                  while (list($id_perfil_accion) = mysql_fetch_row($result)){
            						   
            		 }
			
			*/
			$accion_form = $PHP_SELF."?accion=$accion&act=4&id=$id";		 
		}else{
			$accion_form = $PHP_SELF."?accion=$accion&act=2";	
			$home_si="checked";
			
		}
		
 		
		
		  $query= "SELECT id_auto_admin,tabla   
                   FROM  auto_admin";
             $result_t= cms_query($query)or die (error($query,mysql_error(),$php));
              while (list($id_auto_admin_t,$tabla) = mysql_fetch_row($result_t)){
			  		if($id_auto_admin==$id_auto_admin_t){
					$selected="selected";
					}else{
					$selected="";
					}
        				$lista_tabla .="<option value=\"$id_auto_admin_t\" $selected>$tabla</option>";		   
        		 }
		
	//seleccionamos noticias de contenido estatico 3
		  $query= "SELECT id_noticia,titulo  
                   FROM  noticias
				   where id_tipo =3";
             $result_t= cms_query($query)or die (error($query,mysql_error(),$php));
              while (list($id_noticia,$titulo) = mysql_fetch_row($result_t)){
			  $titulo= substr($titulo,0,30);
			  $titulo .="...";
        				$lista_contenido .="<option value=\"$id_noticia\">$titulo</option>";		   
        		 }
		
		
		  $query= "SELECT id_templates, templates  
                   FROM  templates_acciones
				   order by orden";
             $result_t= cms_query($query)or die (error($query,mysql_error(),$php));
              while (list($id_templates_bd, $templates) = mysql_fetch_row($result_t)){
			 		if($id_templates==$id_templates_bd){
						$lista_templates .="<option value=\"$id_templates_bd\" selected>$templates</option>";	
					}else{
						$lista_templates .="<option value=\"$id_templates_bd\">$templates</option>";	
					}
						   
        		 }
		
		
		
 	$onsubmit ="onSubmit=\"return validaforma(this)\"";
 	
	if($publica_noticia==""){
		
		$publica_noticia= 1;
		
	}
	
	$var="publica_noticia_$publica_noticia";
	$$var="checked";
	
$js.=" <script type=\"text/javascript\" src=\"fckeditor/fckeditor.js\"></script>
<script type=\"text/javascript\">
      window.onload = function()
      {
        
     
        var oFCKeditor2 = new FCKeditor( 'help' ) ;
        oFCKeditor2.BasePath = \"fckeditor/\" ;
		oFCKeditor2.ToolbarSet = \"Basic\";
		oFCKeditor2.Height = 100 ;
        oFCKeditor2.ReplaceTextarea() ;
     
      }
	  
	  
	  
	  
	  

	  
    </script>
	

 
	
	
	";
	
	
	

$contenido .="<br>$mensaje
			<table width=\"80%\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\" align=\"center\">
                <tr> 
                  <td class=\"textos\" width=\"49%\" align=\"left\">&nbsp;Acci&oacute;n</td>
                  <td class=\"textos\"  align=\"left\"> 
                    <input class=\"textos\" type=\"text\" name=\"new_accion\" id=\"new_accion\" value=\"$new_accion\" size=\"4\" onkeyup=\"ObtenerDatos('index.php?accion=$accion&act=10&new_accion='+ form1.new_accion.value +'&axj=1' ,'new_a');\"><div id=\"new_a\"></div>
    </td>
  </tr>
   <tr> 
                  <td class=\"textos\" width=\"49%\" align=\"left\">&nbsp;Act</td>
                  <td class=\"textos\" width=\"50%\" align=\"left\"> 
                    <input class=\"textos\" type=\"text\" name=\"new_act\" value=\"$new_act\" size=\"4\">
    </td>
  </tr>
  <tr> 
                  <td class=\"textos\" width=\"49%\" align=\"left\">&nbsp;Tipo</td>
                  <td class=\"textos\" width=\"51%\" align=\"left\"> 
                    <select name=\"id_tipo_f\" id=\"id_tipo_f\" onChange=\"activa()\">
                    
                     <option value=\"0\" selected>clasico</option>
                    <option value=\"1\">Modulo</option>
                   <option value=\"3\">Fichas</option>
                   <option value=\"2\">contenido</option>
                    </select>
    </td>
    </tr>
   <tr> 
                  <td class=\"textos\" width=\"49%\" align=\"left\">&nbsp;Php<font color=\"#FF0000\">(*)</font></td>
                  <td class=\"textos\" width=\"51%\" align=\"left\"> 
                    <input class=\"textos\" type=\"text\" name=\"php\" value=\"$php\">
    </td>
  </tr>
   <tr> 
                  <td class=\"textos\" width=\"49%\" align=\"left\">&nbsp;Descripci&oacute;n</td>
                  <td class=\"textos\" width=\"51%\" align=\"left\"> 
                    <input class=\"textos\" type=\"text\" name=\"descrip_php\" value=\"$descrip_php\">
    </td>
     </tr>
     <tr> 
                  <td class=\"textos\" width=\"49%\" align=\"left\">&nbsp;Grupo</td>
                  <td class=\"textos\" width=\"51%\" align=\"left\"> 
                    $grupo
    </td>
    </tr>
	 
	 <tr> 
                  <td class=\"textos\" width=\"49%\" align=\"left\">&nbsp;Tabla</td>
                  <td class=\"textos\" width=\"51%\" align=\"left\"> 
                    <select name=\"id_tabla\">
					<option value=\"0\" selected>----></option>
                   $lista_tabla
                    </select>
    </td>
    </tr>
	 <tr> 
                  <td class=\"textos\" width=\"49%\" align=\"left\">&nbsp;Template</td>
                  <td class=\"textos\" width=\"51%\" align=\"left\"> 
                    <select name=\"id_templates\">
					<option value=\"0\" >----></option>
                   $lista_templates
                    </select>
    </td>
    </tr>
	
	 <!-- <tr> 
                  <td class=\"textos\" width=\"49%\" align=\"left\">&nbsp;Contenido</td>
                  <td class=\"textos\" width=\"51%\" align=\"left\"> 
                    <select name=\"id_contenido\">
                   $lista_contenido
                    </select>
    </td>
    </tr>-->
	
	
	<tr> 
                  <td class=\"textos\" width=\"49%\" align=\"left\">&nbsp;Menu</td>
                  <td class=\"textos\" width=\"51%\" > 
                    <input type=\"radio\" name=\"home\" value=\"si\" $home_si>
                    &nbsp;SI &nbsp;&nbsp;
                    <input type=\"radio\" name=\"home\" value=\"no\" $home_no>&nbsp;NO
                  </td>
  </tr>
  <tr> 
                  <td class=\"textos\" width=\"49%\" align=\"left\">&nbsp;Acepta Noticia</td>
                  <td class=\"textos\" width=\"51%\" > 
                    <input type=\"radio\" name=\"publica_noticia\" value=\"1\" $publica_noticia_1>
                    &nbsp;SI &nbsp;&nbsp;
                    <input type=\"radio\" name=\"publica_noticia\" value=\"0\" $publica_noticia_0>&nbsp;NO
                  </td>
  </tr>

<tr> 
                  <td class=\"textos\" width=\"49%\" align=\"left\">&nbsp;Etiqueta</td>
                  <td class=\"textos\" width=\"51%\" > 
                    <input type=\"text\" name=\"etiqueta\" value=\"$etiqueta\">
                  </td>
  </tr>

<tr> 
                  <td class=\"textos\" width=\"49%\" align=\"left\">&nbsp;Cargar siempre</td>
                  <td class=\"textos\" width=\"51%\" > 
                    <input type=\"radio\" name=\"presente\" value=\"1\" $presente_1>
                    &nbsp;SI &nbsp;&nbsp;
                    <input type=\"radio\" name=\"presente\" value=\"0\" $presente_0>&nbsp;NO
                  </td>
  </tr>


</table>
  
    <table width=\"90%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
        <tr>
            <td align=\"left\" class=\"textos\">
		      $camino_perfil
		    </td>
          </tr>
    	</table>

     $perfil_usuarios
 
  
  <table width=\"80%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" >
    <tr>
      <td  class=\"textos\">
	  &nbsp;</tr>
	  <tr> 
                  <td class=\"textos\" width=\"49%\" align=\"left\">Help</td>
                  
  </tr>
	  <tr> 
                  <td class=\"textos\" width=\"49%\" align=\"left\" >
				  
				     <textarea name=\"help\" id=\"help\" class=\"textos\">$help</textarea>
				  </td>
                  
  </tr>
	<tr>
      <td  class=\"textos\" align=\"center\">

      <input type=\"submit\" name=\"Submit\" value=\"Aceptar\" class=\"boton\">
      </td>
      </tr>
      <tr><td align=\"center\" class=\"textos\"> &nbsp;</td></tr>
	</table>
	";


include("admin/acciones/admin_menu.php");

}
?>