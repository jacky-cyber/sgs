<?php
//agrega comentario a la foto

$comentario = $_POST['comentario'];

if($comentario!=""){

$Sql ="UPDATE imagenes
	   SET pie_esp ='$comentario'
	   WHERE id_imagen ='$id_imagen'";

 cms_query($Sql)or die (error($Sql,mysql_error(),$php));
$contenido = "<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                <tr>
                  <td align=\"center\" class=\"textos\"><font color=\"#FF0000\">Comentario Actualizado</font> </td>
                </tr>
              </table>";
}


$id_imagen = $_GET['id_imagen'];
$id_galeria = $_GET['id_galeria'];

 

  $query= "SELECT imagen1 , pie_esp   
           FROM  imagenes
           WHERE id_imagen='$id_imagen'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
     list($imagen,$pie_esp) = mysql_fetch_row($result);
	 

	 $imagen_grande="gal/imagen_chica_gal.php?filename=$imagen&id_cliente=1&id_galeria=$id_galeria&tamanio_image=200";

	 $accion_form = "index.php?accion=$accion&act=$act&id_galeria=$id_galeria&id_imagen=$id_imagen";
	 
	$contenido .= "<table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                    <tr>
                      <td align=\"center\" class=\"textos\">
					  <img src=\"$imagen_grande\" alt=\"\" border=\"0\">
					  </td>
                    </tr>
					<tr><td align=\"center\" class=\"textos\"> 
					   <textarea name=\"comentario\" cols=\"60\" rows=\"10\" class=\"textos\">$pie_esp</textarea>
					</td></tr> 
					<tr><td align=\"center\" class=\"textos\">
					<input type=\"submit\" name=\"Submit\" value=\"Agregar comentario\"> </td></tr> 
                  </table>";
	 


?>