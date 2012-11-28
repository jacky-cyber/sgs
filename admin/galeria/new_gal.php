<?php

$id_galeria = $_GET['id_galeria'];

$id_perfil_2= perfil($id_sesion);

      $query = "SELECT gg.id_grupo_galeria,gg.grupo_galeria  
           FROM grupo_galeria gg, grupo_galeria_perfiles gp
           WHERE gg.id_grupo_galeria = gp.id_grupo_galeria
           AND gp.id_perfil = $id_perfil
          ORDER BY 'id_grupo_galeria'";
   //  echo $query;
		$result_gr = cms_query($query);
	while(list($id_grupo_galeria,$grupo_galeria) = mysql_fetch_row($result_gr)){

		$lista_grupo_galeria .= "<option value=\"$id_grupo_galeria\">$grupo_galeria</option>\n";
		
	}
      
 
      
  
      

  $query= "SELECT id_cliente,fecha,nombre,descripcion,imagen
           FROM  galerias 
           WHERE id_galeria ='$id_galeria'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
     list($id_cliente,$fecha,$nombre,$descripcion,$imagen) = mysql_fetch_row($result);
	 
	if(@is_file("$id_cliente/$id_galeria/$imagen")){
	$imagen_galeria="<img src=\"gal/imagen_chica_gal.php?filename=$imagen&id_cliente=$id_cliente&id_galeria=$id_galeria&tamanio_image=200\" alt=\"\" border=\"0\">";
	
	}else{
	$imagen_galeria="<img src=\"images/sin_imagen.jpg\" alt=\"\" border=\"0\">";
	
	}
	  
 
  if($id_perfil==999){
 	
 	$agregar_grupo="<tr>
                	  <td align=\"left\" class=\"textos\" colspan=\"2\">
				  		Si quieres agregar un nuevo grupo de galer&iacute;a pincha
				  		<a href=\"index.php?accion=grupo_galeria\">aqu&iacute;</a> 
					  </td>
                
                </tr>";
 }    
 
   
$accion_form = "index.php?accion=$accion&act=2";

include("lib/cuadro_perfiles.php");

    
$contenido = "<table width=\"80%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                <tr>
                  <td align=\"left\" class=\"textos\">Nombre Galer&iacute;a</td>
                 <td align=\"center\" class=\"textos\">
				 <input type=\"text\" name=\"nombre\" value=\"$nombre\" size=\"49\"></td>
                </tr>
              <tr>
                  <td align=\"left\" valign=\"top\" class=\"textos\">Descripci&oacute;n</td>
                 <td align=\"center\" class=\"textos\">
				 <textarea name=\"descripcion\" cols=\"50\" rows=\"6\" class=\"textos\">$descripcion</textarea>
				 </td>
                </tr>
              <tr>
                  <td align=\"left\" valign=\"top\" class=\"textos\">Grupo Galer&iacute;a</td>
                 <td align=\"center\" class=\"textos\">
						  <select name=\"id_grupo_galeria\" class=\"textos\">
						   $lista_grupo_galeria
						   </select>
						   </td>
				 </td>
                </tr>
                $agregar_grupo
              <tr>
                  <td align=\"left\" class=\"textos\">$imagen_galeria</td>
                 <td align=\"center\" class=\"textos\">
				 
				 <input type=\"file\" name=\"imagen\">
				 </td>
                </tr>
   				 <tr>
                	  <td align=\"left\" class=\"textos\" colspan=\"2\">
				  		$cuadro_perfiles_colegios
					  </td>
                
                </tr>

            <tr>
                  
                 <td align=\"center\" class=\"textos\" colspan=\"2\">
				 <input type=\"submit\" name=\"Submit\" value=\"Guardar Cambios\" class=\"boton\">
				 </td>
                </tr>
               </table>";
			   
			   

?>