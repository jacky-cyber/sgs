<?php
$id_contenido= $_GET['id_contenido'];
$tipo_new = $_GET['tipo_new'];
$act_n =$_GET['act_n'];

$imagen_name= $_FILES['imagen']['name'];
$imagen= $_FILES['imagen']['tmp_name'];

$id_noticia = $_POST['id_noticia'];
$idioma = $_POST['idioma'];
$titulo = $_POST['titulo'];
$titulo2_corto = $_POST['titulo2_corto'];
$contenido2 = $_POST['contenido2'];
$id_imagen = $_POST['id_imagen'];
$id_tipo_n = $_POST['id_tipo_n'];
$id_tipo = $_POST['id_tipo'];
$visible = $_POST['visible'];
$fecha= $_POST['fecha'];
$id_imagen_pub= $_POST['id_imagen_pub'];
$fuente = $_POST['fuente'];
$imprimir = $_POST['imprimir'];
$amigo = $_POST['amigo'];

$pie =$_POST['pie'];
 $comilla='"';
$titulo = str_replace("<p>","",$titulo);
$titulo = str_replace("</p>","",$titulo);
$titulo2_corto = str_replace("<p>","",$titulo2_corto);
$titulo2_corto = str_replace("</p>","",$titulo2_corto);
$titulo = str_replace("<p>&nbsp;</p>","",$titulo);
$contenido2 = str_replace("<p>","",$contenido2);
$contenido2 = str_replace("</p>","",$contenido2);
$contenido2 = str_replace("'","''",$contenido2);
$contenido2 = str_replace("&quot;","\"",$contenido2);


$titulo_url = friendlyURL($titulo);

$titulo = utf8_decode($titulo);





if ($act_n=="1" AND $titulo!="") {
     
	

	
	
	
  		 if ($imagen=="")
   			{
			//echo "dfdsfdsf fffffffffff";
      
 			 $query_actualizar = "UPDATE noticias
                                  SET titulo  = '$titulo',
				      titulo_url = '$titulo_url',
                                      titulo_corto = '$titulo2_corto',
                                      contenido = '$contenido2',
                                      id_imagen = '$id_imagen',
                                      visible = '$visible',
                                      imprimir ='$imprimir',
                                      amigo ='$amigo',
							          destacado  ='$destacado',
							          fuente = '$fuente',
							          id_tipo ='$id_tipo'
                                  WHERE id_noticia = '$id_contenido'";

 cms_query($query_actualizar);
			 
			    $query_actualizar = "UPDATE imagenes
                       		         SET pie_esp = '$pie'
	                                 WHERE id_imagen = '$id_imagen'";
					  //echo $query_actualizar;	//***** cms_query($query_actualizar);
			 
			 
			 
   			}elseif($imagen<>"none" and $imagen<>""){
			
			     $imagen2 = ereg_replace('&','*',$imagen_name);
				      $imagen2 = ereg_replace(' ',':',$imagen2);
					  if (!is_dir("images/news/$id_contenido/")){
					  	mkdir("images/news/$id_contenido/");
					  }
					      if (!copy($imagen, "images/news/$id_contenido/$imagen2"))		//copia un archivo
					         {
					         echo "Fallo, La imagen chica no se a podido subir al servidor. <br>";
					         echo "La imagen chica no existe o es muy grande.<br>
							 imagen temp: $imagen<br> imagen nombre : $imagen_name";
					         }
							// echo "images/news/$id_contenido/$imagen2";
							
							
							
							  $query= "SELECT imagen1   
                                       FROM  imagenes
                                       WHERE id_imagen='$id_imagen'";
							  
							
                                 $result= cms_query($query)or die (error($query,mysql_error(),$php));
                              list($imagen_borrar) = mysql_fetch_row($result);
							  if(is_file("images/news/$id_contenido/$imagen_borrar")){
							  
							     unlink("images/news/$id_contenido/$imagen_borrar");	// unlick  borra el fichero 
							
							  
							  $Sql ="UPDATE imagenes
                             	     SET imagen1 ='$imagen_name'
                             	     WHERE id_imagen='$id_imagen'";
                             		//echo "Sql";

 cms_query($Sql)or die (error($query,mysql_error(),$php));
					 
							  }else{
							  

                              $qry_insert="INSERT INTO imagenes(id_imagen,imagen1,pie_esp) 
							  				values (null,'$imagen_name','$pie')";
                                            
                              $result_insert=cms_query($qry_insert) or die("$MSG_DIE - QR-Problemas al insertar qry_insert");
							  $id_imagen = mysql_insert_id();
							  }
							
			 
				
   
   	  		  
					  
   					$query_actualizar = "UPDATE noticias
                        SET titulo  = '$titulo',
						    titulo_url = '$titulo_url',
                            titulo_corto = '$titulo2_corto',
                            contenido = '$contenido2',
                            id_imagen  = '$id_imagen',
                            visible = '$visible',
                            imprimir ='$imprimir',
                            amigo ='$amigo',
							destacado  ='$destacado',
                            fuente = '$fuente',
							id_tipo ='$id_tipo'
	                       WHERE id_noticia = '$id_contenido'";
					  
   					 //echo "$query_actualizar";

 cms_query($query_actualizar);
			       
				
			
			}
			
			
			//$id_contenido=$id;
	  include("lib/guarda_cuadro_perfiles.php");
   			
		
} 
   
 
/************************************************************
** Se seleccionan todas las secciones del sitio en la BD y **
** luego se arma un combobox con estas, seleccionando el   **
** nombre y el id correspondiente a esa sección.           **
************************************************************/
$query = "SELECT 
                 idioma,
                 titulo,
                 titulo_corto,
                 contenido,
                 id_imagen,
				 id_tipo,
                 visible,
				 destacado,
                 fecha,
				 fuente,
				 fecha_publicacion
          FROM noticias
          WHERE id_noticia='$id_contenido'";

$result = cms_query($query);

list( $idioma, $titulo, $titulo2_corto, $contenido2, $id_imagen, $id_tipo_n,$visible, $destacado,$fecha,$fuente,$fecha_publicacion)= mysql_fetch_row($result);

$fecha_publicacion = fechas_html($fecha_publicacion);
$titulo=utf8_encode($titulo);

 $query= "SELECT imagen1,pie_esp  
          FROM  imagenes
          WHERE id_imagen='$id_imagen'";
           $result= @cms_query($query) or die("$MSG_DIE -1 QR dd-$query");
           list($imagen,$pie) = mysql_fetch_row($result);

//echo "$id_noticia, $idioma, $titulo2, $titulo2_corto, $contenido2, $id_imagen, $visible, $fecha";
/*********************************************************
** Se seleccionan todas las secciones del sitio de la   **
** BD y luego se arma un combobox con estas.            **
*********************************************************/
$query = "SELECT id_tipo, descripcion
          FROM contenido_tipo
          ORDER BY 'id_tipo'";
$result = cms_query($query);
while (list($id_tipo, $descripcion) = mysql_fetch_row($result)){
if($id_tipo==$id_tipo_n){
$lista_tipos .= "<option value=\"$id_tipo\" selected>$descripcion</option>\n";
}
$lista_tipos .= "<option value=\"$id_tipo\" >$descripcion</option>\n";
}



$id = $PHP_SELF;
$accion_form .="?accion=$accion&act=$act&act_f=$act_f&act_n=1&id_contenido=$id_contenido";


include("admin/GNews/formulario.php");



?>