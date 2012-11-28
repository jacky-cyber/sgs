<?php
$act_n = $_GET['act_n'];



if ($act_n=='1' and $guardar!="")
   {
   
   //$titulo = nl2br($titulo);
  //$titulo2_corto=nl2br($titulo2_corto);
  //$contenido2 = nl2br($contenido2);
   
  
  
   /*******************************************
   ** Se crea un nuevo ID para el contenido. **
   *******************************************/
   $id_contenido = new_uid();
   $fecha_contenido =  date('Y')."-".date('m')."-".date('d');
   /****************************************
   ** Ingresa la nueva noticia a la BD. **
   ****************************************/
 //  $contenido = nl2br($contenido);
   
 $comilla='"';
//$titulo = str_replace("<p>","",$titulo);
//$titulo = str_replace("</p>","",$titulo);
//$titulo2_corto = str_replace("<p>","",$titulo2_corto);
//$titulo2_corto = str_replace("</p>","",$titulo2_corto);
$titulo = str_replace("<p>&nbsp;</p>","",$titulo);
//$contenido2 = str_replace("<p>","",$contenido2);
//$contenido2 = str_replace("</p>","",$contenido2);
$contenido2 = str_replace("'","''",$contenido2);
$contenido2 = str_replace("&quot;","\"",$contenido2);



$titulo_url = friendlyURL($titulo);



$titulo= trim(utf8_decode($titulo));

 
  if ($imagen==""){
  
  
    $query_agregar = "INSERT
                     INTO noticias (id_noticia, idioma, titulo,titulo_url, titulo_corto,contenido_corto, contenido, id_tipo, visible, imprimir,amigo,fuente, fecha,id_autor,destacado,fecha_publicacion)
                     VALUES ('$id_contenido','esp','$titulo','$titulo_url','$titulo2_corto','$bajada','$contenido2','$id_tipo','$visible','$imprimir','$amigo','$fuente','$fecha_contenido',$id_usuario,'$destacado','$fecha_contenido')";
   //echo "$query_agregar";
   if(cms_query($query_agregar) or die ("No se pudo conectar!! $query_agregar")){
    
        
   }
  
  }elseif($imagen<>"none" and $imagen<>""){
     
  if(!is_dir("images/news/$id_contenido")){
			mkdir("images/news/$id_contenido",0777);	
			chmod("images/news/$id_contenido",0777);					
			}
			
   	     $imagen2 = ereg_replace('&','*',$imagen_name);
				      $imagen2 = ereg_replace(' ',':',$imagen2);
					      if (!copy($imagen, "images/news/$id_contenido/$imagen2"))
					         {
					         echo "Fallo, La imagen chica no se a podido subir al servidor. <br>";
					         echo "La imagen chica no exixte o es muy grande.<br>
							 imagen temp: $imagen<br> imagen nombre : $imagen_name";
					         }else{
							 
							 
						 
					 $query_agregar_foto = "INSERT
                     INTO imagenes (id_imagen, imagen1, imagen2, pie_esp, click, id_cliente, fecha_clasificacion)
                     VALUES ('', '$imagen_name', 'NULL', '$pie', '0', 'NULL', 'NULL')";

 cms_query($query_agregar_foto) or die ("No se pudo insertar foto a tabla!! $query_agregar");

				  $query = "SELECT id_imagen
                				FROM imagenes
				                WHERE 1 AND imagen1
				                LIKE '%$imagen2%'";
      
      				$result = cms_query($query);
		            list($id_imagen) = mysql_fetch_row($result);
					
			    $query_agregar = "INSERT
                               INTO noticias (id_noticia, idioma, titulo,titulo_url, titulo_corto,contenido_corto, contenido, id_imagen,id_tipo, visible,fuente, fecha,id_autor,destacado)
                     VALUES ('$id_contenido','esp','$titulo','$titulo_url','$titulo2_corto','$bajada','$contenido2','$id_imagen','$id_tipo','$visible','$fuente','$fecha_contenido','$id_usuario','$destacado')";

 cms_query($query_agregar) or die ("No se pudo conectar!! $query_agregar");
							 
				
 
                   }
   
  }
  /*$query= "SELECT id_noticia
                    FROM  noticias
                    WHERE titulo='$titulo'";
            $result= @cms_query($query) or die("$MSG_DIE -1 QR-$query");
     list($id_contenido) = mysql_fetch_row($result);*/
     //echo "primera opcion";
	include("lib/guarda_cuadro_perfiles.php");

   Header("Location: index.php?accion=$accion&act=2&id_contenido=$id_contenido");
}else{


/*********************************************************
** Se seleccionan todas las secciones del sitio de la   **
** BD y luego se arma un combobox con estas.            **
*********************************************************/
$query = "SELECT id_tipo, descripcion
          FROM contenido_tipo
          ORDER BY 'id_tipo'";
$result = cms_query($query);
while (list($id_tipo, $descripcion) = mysql_fetch_row($result)){

$lista_tipos .= "<option value=\"$id_tipo\">$descripcion</option>\n";
}

$accion_form ="index.php?id_usuario=$id_usuario&accion=$accion&act=$act&act_f=$act_f&act_n=1";

include("admin/GNews/formulario.php");



}



?>
