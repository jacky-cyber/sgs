<?php
$id_contenido = $_GET['id_noticia'];




//if($perfil==$perfil_wm){}



 $query= "SELECT id_imagen 
                   FROM  noticias
                   WHERE id_noticia='$id_contenido'";
           $result= @cms_query($query) or die("$MSG_DIE -1 QR-$query");
           list($id_imagen) = mysql_fetch_row($result);
             
			 
			  $query= "SELECT imagen1   
                                FROM  imagenes
                                WHERE id_imagen='$id_imagen'";
                        $result= @cms_query($query) or die("$MSG_DIE -1 QR-$query");
                        list($imagen) = mysql_fetch_row($result);
						
						
			    if($imagen!=""){
				$link ="images/news/$id/$imagen";
				
				 if (@unlink($link) ){
				 
				 unlink("images/news/$id_contenido");
				   $Sql ="DELETE FROM imagenes
             			          WHERE id_imagen='$id_imagen'";

 cms_query($Sql) or die("$MSG_DIE -1 QR-$Sql");
			  
				 
				 }
			 
				
				}
				
				
			 

   $query_borrar = "DELETE
                    FROM noticias
                    WHERE id_noticia = '$id_contenido'";
  
  //echo $query_borrar;

 cms_query($query_borrar)or die("$MSG_DIE -1 QR-$query_borrar");
   

  $Sql ="DELETE FROM contenido_tag  where id_contenido = '$id_contenido'";
  cms_query($Sql)or die ("ERROR $php <br>$Sql");

 header ("location:index.php?accion=$accion");




?>
