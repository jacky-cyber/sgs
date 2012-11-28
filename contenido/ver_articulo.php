<?php

$query= "SELECT plantilla_html   
           FROM  noticia_plantilla
           WHERE defecto=1";
     $result4= cms_query($query)or die (error($query,mysql_error(),$php));
    list($plantilla_html) = mysql_fetch_row($result4);
    
    
   $tamanio_image =80;

$query= "SELECT id_tipo,cant_noticias,descripcion    
           FROM  contenido_tipo
           WHERE portada = 1  and id_tipo=4";
     $result_tipo2= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($id_tipo_u,$cant_noticias_u,$descripcion_u) = mysql_fetch_row($result_tipo2)){
      	
   
      $limite ="limit 0, $cant_noticias_u";



if(isset($id_tipo_u)){
$cond= " and id_tipo='$id_tipo_u'";
}

$query = "SELECT id_noticia,idioma,titulo,titulo_corto,contenido,id_imagen,id_tipo, visible,fecha,id_autor,click
          FROM noticias
		  WHERE 1 and estado=1 and id_tipo=4
          $cond
		  ORDER BY id_noticia DESC
		   $limite  
		  ";
//echo "$query<br>";
$result0 = cms_query($query)or die("$MSG_DIE -1 QR-$query");

 //$cont_conte=1;
 $noticia ="";
while(list($id_contenido, $idioma, $titulo, $titulo2_corto, $contenido2, $id_imagen, $id_tipo_n,$visible, $fecha,$id_autor,$click)= mysql_fetch_row($result0)){

//echo "hola, $id_tipo_n <br>";

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
	
	$id_contenido= texto_to_url($titulo);
	
	$td ="  <td align=\"right\" class=\"pic\">$imagen</td>
	<td valign=\"top\">
							  <table  border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                                <tr> 
                                  <td align=\"left\" class=\"titulo\">
								    <a href=\"index.php?accion=$accion&act=5&id_contenido=$id_contenido\">
								   $titulo</a>
								  </td>
                                </tr>
								<tr> 
                                  <td align=\"left\"  class=\"textos_plomo\">
								  <a href=\"index.php?accion=$accion&act=5&id_contenido=$id_contenido\">
								  $titulo2_corto </a>
								  </td>
                                </tr>
                              </table>
			</td>
			
                             ";
						
		   $noticia2 .="
       					
				<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" >
                      <tr>
                        <td height=\"15\" valign=\"top\">
						  <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
                                <tr>
                                   <td align=\"right\" class=\"textos_plomo\">Autor: $autor &nbsp;&nbsp;</td>
                                   <td align=\"right\" class=\"textos_plomo\">Ingreso $fecha</td>
                                </tr>                        											 
                           </table>
						 </td>
                      </tr>
                      <tr>
                        <td>
						
                          <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                            <tr>
                             $td
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td align=\"left\" class=\"texto-bold_det\">
						<a href=\"index.php?accion=$accion&act=5&id_contenido=$id_contenido\">
                          Ver Mas...(visitada $click veces)</a>
                        </td>
                      </tr>
					  
					   <td align=\"left\" class=\"texto-bold_det\">
						-------------------------------------
                        </td>
                      </tr>
					  
                    </table> ";
                 

  }

}

$plantilla_html_2 = str_replace("#$descripcion_u#","$noticia2",$plantilla_html);
}

$contenido= $plantilla_html_2;
		 
    
?>