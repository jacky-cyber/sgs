<?php

switch ($act) {
     case 1:
         
     	
     	if(!is_numeric($accion)){

		$accion = traduce_accion($accion);

		}


		$query= "SELECT id_tipo_noticia
				 FROM acciones
				 WHERE accion='$accion'";
		$result_p= cms_query($query)or die (error($query,mysql_error(),$php));
		list($tipo) = mysql_fetch_row($result_p);

		include("contenido/ver_principal.php");


         break;
	
   	default:

   		if(!is_numeric($accion)){
			
		$accion = traduce_accion($accion);
		
	    }
	
	
	
	
	
  $query= "SELECT id_tipo_noticia,descrip_php_esp 
           FROM  acciones
           WHERE accion='$accion'";
  //echo $query;
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
    list($tipo,$descrip_php_esp) = mysql_fetch_row($result);
	
	  //include("contenido/ver_principal.php");
$seccion_titulo = $descrip_php_esp;
	  	   

	$query= "SELECT plantilla_html   
	         FROM  noticia_plantilla
	         WHERE nombre_plantilla='plantilla_grupo_noticias'";
	  $result= cms_query($query)or die (error($query,mysql_error(),$php));
	      list($plantilla_grupo) = mysql_fetch_row($result);
	
	      
	   
	        $query= "SELECT plantilla_html   
	                 FROM noticia_plantilla
	                 WHERE nombre_plantilla='plantilla_noticia_principal'";
	           $result= cms_query($query)or die (error($query,mysql_error(),$php));
	            list($plantilla_noticia_principal) = mysql_fetch_row($result);
	
	           $accion= accion_palabra($accion); 	

	         $query= "SELECT id_noticia,titulo,titulo_url,titulo_corto,contenido,id_imagen,id_tipo, visible,fecha,id_autor
           	  		  FROM noticias
		  	  		  WHERE 1 and estado=1 and id_tipo='$tipo' and destacado=1       
		  	  		  ORDER BY id_noticia DESC";
	                 $result_t= cms_query($query)or die (error($query,mysql_error(),$php));
	   //echo "$query<br>";           
	          while(list($id_contenido, $titulo_prin, $titulo_url, $titulo2_corto_prin, $contenido2_prin, $id_imagen_prin, $id_tipo_n_prin,$visible_prin, $fecha_prin,$id_autor_prin) = mysql_fetch_row($result_t)){
//echo "$titulo_url<br>";
	        $id_contenido = titulo_url($titulo_prin);
	         
			 
			
	   
	  $link_noticia_pri="<a href=\"index.php?accion=$accion&act=5&id_contenido=$id_contenido\">$titulo_prin</a>"; 
	  $link_pri="<a href=\"index.php?accion=$accion&act=5&id_contenido=$id_contenido\">Leer m&aacute;s...</a>"; 
	         		
	         
	 $plantilla_noticia_principal = str_replace("#TITULO_PRINCIPAL#","$link_noticia_pri",$plantilla_noticia_principal);
  	 $plantilla_noticia_principal = str_replace("#BAJADA_PRINCIPAL#","$titulo2_corto_prin",$plantilla_noticia_principal);
  	 $plantilla_noticia_principal = str_replace("#VER_MAS#","$link_pri",$plantilla_noticia_principal);
 
	          }
	    
	              

	        $cont=0;    
	$query = "SELECT id_noticia,idioma,titulo,titulo_url,titulo_corto,contenido,id_imagen,id_tipo, visible,fecha,id_autor,click
           	  FROM noticias
		  	  WHERE 1 and estado=1 and id_tipo='$tipo' and destacado=0       
		  	  ORDER BY id_noticia DESC
		   		$limite";
		//echo "$query<br>";
	$result0 = cms_query($query)or die("$MSG_DIE -1 QR-$query");

 

 $noticia ="";
	while(list($id_contenido, $idioma, $titulo, $titulo_url,$titulo2_corto, $contenido2, $id_imagen, $id_tipo_n,$visible, $fecha,$id_autor,$click)= mysql_fetch_row($result0)){
		$cont ++;
	
		 $query= "SELECT plantilla_html   
	                 FROM noticia_plantilla
	                 WHERE nombre_plantilla='plantilla_noticia'";
	           $result_9= cms_query($query)or die (error($query,mysql_error(),$php));
	            list($plantilla_noticia) = mysql_fetch_row($result_9);
	
		
		
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

$tamanio_image =80;
 $query= "SELECT imagen1,pie_esp   
          FROM  imagenes
          WHERE id_imagen='$id_imagen'";
 //echo "$query<br>";
           $result21= @cms_query($query) or die("$MSG_DIE -1 QR-$query");
           list($imagen,$pie) = mysql_fetch_row($result21);
		  
           if(is_file("images/news/$id_contenido/$imagen")){
           
		if($imagen!=""){
	    $imagen= " <a href=\"index.php?accion=$accion&act=5&id_contenido=$id_contenido\">
				   <img src=\"contenido/imagen_chica.php?imagen=$imagen&tamanio_image=$tamanio_image&id_contenido=$id_contenido\" alt=\"$pie\" border=\"0\"></a>
						";
		   		 }
		   
		   }else {
		   $imagen ="";
		   }
		   
		   
		   
		   $titulo2_corto = nl2br($titulo2_corto);
	
	//$id_contenido= texto_to_url($titulo);
	 	$id_contenido = titulo_url($titulo);
	
	$link_noticia="<a href=\"index.php?accion=$accion&act=5&id_contenido=$id_contenido\">$titulo</a>";
	$link_ver_mas="<a href=\"index.php?accion=$accion&act=5&id_contenido=$id_contenido\">Leer m&aacute;s...</a>";
	
  $plantilla_noticia = str_replace("#TITULO#","$link_noticia",$plantilla_noticia);
  $plantilla_noticia = str_replace("#BAJADA#","$titulo2_corto",$plantilla_noticia);
  $plantilla_noticia = str_replace("#VER_MAS#","$link_ver_mas",$plantilla_noticia);
  //echo $plantilla_noticia;
	
  
  
  $var= "noticia$cont";		
  $$var= $plantilla_noticia;	
                

  }

 
   
}

	  $link_4="<a href=\"?accion=$accion&act=1\">Ver todas...</a>"; 
	
	$plantilla_grupo = str_replace("#PRINCIPAL#","$plantilla_noticia_principal",$plantilla_grupo);
	$plantilla_grupo = str_replace("#NOTICIA_1#","$noticia1",$plantilla_grupo);
	$plantilla_grupo = str_replace("#NOTICIA_2#","$noticia2",$plantilla_grupo);
	$plantilla_grupo = str_replace("#NOTICIA_3#","$noticia3",$plantilla_grupo);
	$plantilla_grupo = str_replace("#NOTICIA_4#","$noticia4",$plantilla_grupo);
	$plantilla_grupo = str_replace("#VER_MAS#","$link_4",$plantilla_grupo);


		$contenido = $plantilla_grupo;

		 

 }
    
    

	  
	
?>