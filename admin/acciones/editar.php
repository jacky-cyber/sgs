<?php
	 
	 
	 
	 $query= "SELECT id_acc,accion,act,php,descrip_php_esp,descrip_php_eng,home,icono,id_grupo,defecto,orden,id_tipo,id_contenido,id_auto_admin,publica_noticia,help ,etiqueta,presente,id_templates,opcion,id_tipo_noticia    
                       FROM  acciones
                       WHERE id_acc='$id'";
			// echo $query;
                 $result= cms_query($query)or die (error($query,mysql_error(),$php));
                 list($id_acc,$new_accion,$act,$php_a,$descrip_php,$descrip_php_eng,$home,$icono,$id_grupo,$defecto,$orden,$id_tipo,$id_contenido,$id_auto_admin,$publica_noticia,$help,$etiqueta,$presente,$id_templates,$opcion,$id_tipo_noticia) = mysql_fetch_row($result);
					
					$var = "home_$home";
					$$var = "checked";
					$var = "presente_$presente";
					$$var="checked";
					
					
					
					
  $query= "SELECT  id_opcion_menu,opcion   
           FROM  accion_opciones_menu";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($id_opcion_menu,$opcion_men) = mysql_fetch_row($result)){
	  		if($id_opcion_menu==$opcion){
			
			$lista_sel .="<option value=\"?accion=$accion&id=$id&act=18&opcion=$id_opcion_menu&id_gru=$id_gru\" selected>$opcion_men</option>";		   
		
			}else{
			
			$lista_sel .="<option value=\"?accion=$accion&id=$id&act=18&opcion=$id_opcion_menu&id_gru=$id_gru\">$opcion_men</option>";		   
		
			}
	  
		 }

		 if($_SESSION['php_last']!="" and $_SESSION['id_php_ant']==$id){
		 
		 $volver ="<a href=\"?accion=$accion&id=$id&act=19&id_gru=$id_gru\">Volver a la opción anterior</a>";
		 }
		 
	
  $lista_opciones="<table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
    
	<tr><td align=\"center\" class=\"textos_plomo\">$volver</td></tr> 
	<tr >
      <td align=\"center\" class=\"textos\">Cambiar tipo de Menu
	  <select name=\"menu1\" onChange=\"MM_jumpMenu('parent',this,0)\">
          <option value=\"#\">Selecciona para cambiar</option>
		  $lista_sel
        </select>
	  </td>
      </tr>
	</table>";
	
		
		
							
			

		
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
           	 case 4:
                 include ("admin/acciones/formularios/formulario_noticia.php");
                 break;
           	default:
        	    include ("admin/acciones/formularios/formulario_menu_contenido.php");
        	 
               
         }
	
			
	
		
		


?>