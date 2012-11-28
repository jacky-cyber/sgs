<?php

//opcion2
	   
 

 if($msg==1){
 	
 	echo "<script>alert('Esta Acci&oacute;n ya Existe'); </script>\n";
 }
 
 
 
 
 
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
  		 
 
$perfil_usuarios=  "<table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\">
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
 		
 			
 			
 			if (theForm.descrip_php.value == \"\"){
 					alert(\"Por favor Ingrese una Descripci&oacute;n.\");
 					theForm.descrip_php.focus();
 					return false;
 			}
			if (theForm.id_tabla.value == \"#\"){
 					alert(\"Por favor selecciona una tabla.\");
 					theForm.id_tabla.focus();
 					return false;
 			}
 			
 		
 		}
				
	 
	 
 
 </script>";
 		
		
 		/*
 		
		if($edit=="ok"){
			  $query= "SELECT id_acc,accion,act,php,descrip_php_esp,descrip_php_eng,home,icono,id_grupo,defecto,orden,id_tipo,id_contenido,id_auto_admin,publica_noticia,help ,etiqueta,presente,id_templates    
                       FROM  acciones
                       WHERE id_acc='$id'";
                 $result= cms_query($query)or die (error($query,mysql_error(),$php));
                 list($id_acc,$new_accion,$act,$php,$descrip_php,$descrip_php_eng,$home,$icono,$id_grupo,$defecto,$orden,$id_tipo,$id_contenido,$id_auto_admin,$publica_noticia,$help,$etiqueta,$presente,$id_templates) = mysql_fetch_row($result);
					if($presente==""){
					$presente=0;
					}
					
					$var = "home_$home";
					$$var = "checked";
					$var = "presente_$presente";
					$$var="checked";
					$var = "presente_$presente";
					
					$$var = "checked";

			$accion_form = $PHP_SELF."?accion=$accion&act=4&id=$id";		 
		}else{*/
			$accion_form = $PHP_SELF."?accion=$accion&act=2";	
			$home_si="checked";
			
			if($presente==""){
					$presente=0;
					}
					
					$var = "home_$home";
					$$var = "checked";
					$var = "presente_$presente";
					$$var="checked";
					$var = "presente_$presente";
					
					$$var = "checked";
			
	//	}
		
 		
		
		  $query= "SELECT id_auto_admin,tabla   
                   FROM  auto_admin
				   order by tabla";
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
	
$js .=" <script type=\"text/javascript\" src=\"fckeditor/fckeditor.js\"></script>
<script type=\"text/javascript\">
      window.onload = function()
      {
        
     
        var oFCKeditor2 = new FCKeditor( 'help' ) ;
        oFCKeditor2.BasePath = \"fckeditor/\" ;
		oFCKeditor2.ToolbarSet = \"Basic\";
		oFCKeditor2.Height = 100 ;
        oFCKeditor2.ReplaceTextarea() ;
     
      }
	  
    </script>";


$contenido .="<br>$mensaje
<input class=\"textos\" type=\"hidden\" name=\"opcion\" value=\"$opcion\">
<input class=\"textos\" type=\"hidden\" name=\"php\" value=\"$php\">
			<table width=\"95%\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\" align=\"center\" class=\"cuadro_light\">
                
  <tr><td align=\"center\" class=\"texnormalbold2\" colspan=\"2\"><h3>Men&uacute; de Administraci&oacute;n Autom&aacute;tica </h3></td></tr> 
   <tr><td align=\"center\" class=\"textos\" colspan=\"2\">  $lista_opciones </td></tr>  


     <tr> 
                  <td class=\"textos\" width=\"49%\" align=\"left\">&nbsp;Descripci&oacute;n</td>
                  <td class=\"textos\" width=\"51%\" align=\"left\"> 
				    <table   border=\"0\" align=\"left\" cellpadding=\"0\" cellspacing=\"0\">
                      <tr >
                        <td align=\"left\" class=\"textos\">
						<input type=\"text\" name=\"descrip_php\" value=\"$descrip_php\" onkeyup=\"ObtenerDatos('index.php?accion=$accion&act=10&descrip_php='+ form1.descrip_php.value +'&axj=1' ,'new_a');\">
						&nbsp;</td>
                       <td align=\"left\" class=\"textos\"><div id=\"new_a\"></div> </td></tr> 
                  	</table>
                   
    </td>
    </tr>
	 <tr> 
                  <td class=\"textos\" width=\"49%\" align=\"left\">&nbsp;Grupo de Menu</td>
                  <td class=\"textos\" width=\"51%\" align=\"left\"> 
                    $grupo
    </td>
    </tr>
	 
	 <tr> 
                  <td class=\"textos\" width=\"49%\" align=\"left\">&nbsp;Selecciona Tabla</td>
                  <td class=\"textos\" width=\"51%\" align=\"left\"> 
                    <select name=\"id_tabla\">
					<option value=\"#\" selected>----></option>
                   $lista_tabla
                    </select>
    </td>
    </tr>
	
	
	
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
                  <td class=\"textos\" width=\"49%\" align=\"left\">&nbsp;Cargar siempre</td>
                  <td class=\"textos\" width=\"51%\" > 
                    <input type=\"radio\" name=\"presente\" value=\"1\" $presente_1>
                    &nbsp;SI &nbsp;&nbsp;
                    <input type=\"radio\" name=\"presente\" value=\"0\" $presente_0>&nbsp;NO
                  </td>
  </tr>
<tr><td align=\"left\" class=\"textos\" colspan=\"2\"> &nbsp;<b>Visualizar por perfiles</b> </td></tr> 
<tr><td align=\"left\" class=\"textos\" colspan=\"2\"> $camino_perfil </td></tr> 
<tr><td align=\"left\" class=\"textos\" colspan=\"2\"> $perfil_usuarios </td></tr> 
<tr><td align=\"left\" class=\"textos\" colspan=\"2\"> &nbsp;<b>Descripci&oacute;n del M&oacute;dulo</b> </td></tr> 
  <tr> 
                  <td class=\"textos\" colspan=\"2\" align=\"left\" >
				  
				     <textarea name=\"help\" id=\"help\" class=\"textos\">$help</textarea>
				  </td>
                  
  </tr>
<tr><td align=\"center\" class=\"textos\" colspan=\"2\"> <input type=\"submit\" name=\"Submit\" value=\"Aceptar\" class=\"boton\"> </td></tr> 
<tr><td align=\"left\" class=\"textos\" colspan=\"2\"> &nbsp; </td></tr> 

</table>";

/* <!--  
	 <tr> 
                  <td class=\"textos\" width=\"49%\" align=\"left\">&nbsp;Template</td>
                  <td class=\"textos\" width=\"51%\" align=\"left\"> 
                    <select name=\"id_templates\">
					<option value=\"0\" >----></option>
                   $lista_templates
                    </select>
    </td>
    </tr>
	
	<tr> 
                  <td class=\"textos\" width=\"49%\" align=\"left\">&nbsp;Contenido</td>
                  <td class=\"textos\" width=\"51%\" align=\"left\"> 
                    <select name=\"id_contenido\">
                   $lista_contenido
                    </select>
    </td>
    </tr>
	-->*/

?>