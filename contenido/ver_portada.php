<?php 

$accion = "noticias";

$query= "SELECT plantilla_html   
           FROM  noticia_plantilla
           WHERE defecto=1";
     $result4= cms_query($query)or die (error($query,mysql_error(),$php));
    list($plantilla_html) = mysql_fetch_row($result4);
    
    
   /* 
  $query= "SELECT id_tipo,descripcion    
           FROM  contenido_tipo
           WHERE portada = 1";
     $result_tipo= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($id_tipo_a,$descripcion_a) = mysql_fetch_row($result_tipo)){
      	
			$tipo_link .=" <a href=\"index.php?accion=$accion&act=1&tipo=$id_tipo_a\">
	        $descripcion_a</a>&nbsp;&nbsp;";			   
		 }
		 

$contenido= " <table width=\"300\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
    <tr>
      <td align=\"center\" class=\"textos\">$tipo_link</td></tr>
	  <tr>
      <td align=\"center\" class=\"textos\">&nbsp;</td></tr>
	</table>";
 
		*/
$tamanio_image =80;
/************************************************************
** Se seleccionan todas las secciones del sitio en la BD y **
** luego se arma un combobox con estas, seleccionando el   **
** nombre y el id correspondiente a esa sección.           **
************************************************************/
$query= "SELECT id_tipo,cant_noticias,descripcion, titulo, bajada, foto, titulo_css,bajada_css,imagen_css
   
           FROM  contenido_tipo
           WHERE portada = 1 ";


     $result_tipo2= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($id_tipo_u,$cant_noticias_u,$descripcion_u, $titulo_u, $bajada_u, $foto_u,$titulo_css,$bajada_css,$imagen_css) = mysql_fetch_row($result_tipo2)){
      	
      //echo "$id_tipo $titulo_u<br>";
      $limite ="limit 0, $cant_noticias_u";



if(isset($id_tipo_u)){
$cond= " and id_tipo='$id_tipo_u'";
}

$query = "SELECT id_noticia,idioma,titulo,titulo_corto,contenido,id_imagen,id_tipo, visible,fecha,id_autor,click
          FROM noticias
		  WHERE 1 and estado=1 
		  $cond
		  ORDER BY id_noticia DESC
		   $limite  
		  ";
//echo "$query<br>";
$result0 = cms_query($query)or die("$MSG_DIE -1 QR-$query");

 //$cont_conte=1;
 $noticia ="";
while(list($id_contenido, $idioma, $titulo, $titulo2_corto, $contenido2, $id_imagen, $id_tipo_n,$visible, $fecha,$id_autor,$click)= mysql_fetch_row($result0)){



if(noticia_perfil($id_contenido,$id_usuario)){

//$autor = datos_encuestas($id_autor,1,0);
$autor = $autor[1];

  $query_a= "SELECT nombre   
           FROM  usuario
           WHERE id_usuario='$id_autor'";
     $result_a= cms_query($query_a)or die (error($query_a,mysql_error(),$php));
    list($autor) = mysql_fetch_row($result_a);
	

$id= $id_contenido;

$fecha_noticia = fechas_html($id_contenido);
if($foto_u==1 and $id_imagen!=""){
 $query= "SELECT imagen1,pie_esp   
          FROM  imagenes
          WHERE id_imagen='$id_imagen'";
 //echo "$query<br>";
           $result21= @cms_query($query) or die("$MSG_DIE -1 QR-$query");
           list($imagen,$pie) = mysql_fetch_row($result21);
}  
           if(is_file("images/news/$id_contenido/$imagen")){
           	
           	if($imagen_css!=""){
		$css .= "$imagen_css";
		$clase_imagen = $descripcion_u."_imagen";

		}else{
		$clase_imagen="imagen_portada";
		}
          
		if($imagen!="" and $foto_u==1){
	$imagen= " <a href=\"index.php?accion=$accion&act=5&id_contenido=$id_contenido\" valing=\"top\" aling=\"left\" >
               <img type=\"image\" class=\"$clase_imagen\" hspace=\"2\"  src=\"contenido/imagen_chica.php?imagen=$imagen&tamanio_image=$tamanio_image&id_contenido=$id_contenido\" alt=\"$pie\" align=\"left\" vspace=\"2\" border=\"0\">
	           
				</a>
						";
		   		}else{
		   			$imagen="";
		   		}
		   
		   }else {
		   $imagen ="";
		   }
		   
	  $titulo2_corto = nl2br($titulo2_corto);
	
	
	
	 $id_contenido= texto_to_url($titulo);
		   
		   
		   if($titulo_u==0){
		   	
		   	$titulo="";
		   	}
		   	
		   	if($bajada_u==0){
		   		$titulo2_corto="";
		   	}
		   	        
		if($titulo_css!=""){
		$css .= "$titulo_css";
		$clase_titulo = $descripcion_u."_titulo";
		
		}else{
		$clase_titulo="titulo_portada";
		}
		
		
		if($bajada_css!=""){
			
		$css .= "$bajada_css";
		$clase_bajada = $descripcion_u."_bajada";	
			
		}else{
			
		$clase_bajada ="bajada_portada";
			
		}
		
	
	

	$td= "<table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
	       <tr>       
	       	      
	           <td  valing=\"top\">
			
	$imagen
	
	<a href=\"index.php?accion=$accion&act=5&id_contenido=$id_contenido\"><p class=\"$clase_titulo\">$titulo</p></a>
    <a href=\"index.php?accion=$accion&act=5&id_contenido=$id_contenido\" ><p class=\"$clase_bajada\">$titulo2_corto</p></a>
				  
			</td>
			  
		   </tr>
	      
	      </table> ";
	
	$noticia.= "$td";
	
	
	 /*<tr>
                 <td align=\"right\" class=\"textos_plomo\">Autor: $autor &nbsp;</td>
                 <td align=\"right\" class=\"textos_plomo\">Ingreso $fecha</td>
            </tr>
            <tr>
                <td align=\"left\" class=\"texto-bold_det\" colspan=\"2\">
				<a href=\"index.php?accion=$accion&act=5&id_contenido=$id_contenido\">
                Ver Mas...(visitada $click veces)</a></td>
          </tr>  */            
                 
  }

}

$plantilla_html = str_replace("#$descripcion_u#","$noticia",$plantilla_html);
}

$contenido.= $plantilla_html;
		
?> 