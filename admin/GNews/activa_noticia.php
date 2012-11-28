<?php

$id_noticia = $_GET['id_noticia'];


 
 
 
 /*
 * Select tabla noticias
 * 
 */
$query= "SELECT estado  
           FROM  noticias
           WHERE id_noticia = '$id_noticia'";
     $result_noticias= cms_query($query)or die (error($query,mysql_error(),$php));
     list($publica) = mysql_fetch_row($result_noticias);
     
/** fin select noticias***/
 
 
if($publica=='1'){
$Sql ="UPDATE noticias
	   SET estado ='0',
           visible ='no'
	   WHERE id_noticia ='$id_noticia'";

 cms_query($Sql)or die (error($query,mysql_error(),$php));
	 //  echo $Sql;
     //  header("Location:index.php?accion=$accion");
     $contenido ="<img style=\"cursor: pointer;  cursor: hand;\" onclick=\"ObtenerDatos('index.php?accion=$accion&act=14&id_noticia=$id_noticia&axj=1','v_$id_noticia');\" src=\"images/ciculo_warring.gif\" border=\"0\" alt=\"Activar Noticia\">";

}


if($publica==0){
    
    
$Sql ="UPDATE noticias
	   SET estado ='1',
           visible='si'
	   WHERE id_noticia ='$id_noticia'";

 cms_query($Sql)or die (error($query,mysql_error(),$php));
	   
	$contenido ="<img style=\"cursor: pointer;  cursor: hand;\" onclick=\"ObtenerDatos('index.php?accion=$accion&act=14&id_noticia=$id_noticia&axj=1','v_$id_noticia');\" src=\"images/ciculo_ok.gif\" border=\"0\" alt=\"Ocultar Noticia\">";   
	   
      
}

?>