<?php
$id_galeria = $_GET['id_galeria'];


$id_contenido=$id_galeria;

include("lib/cuadro_perfiles.php");

$css="<style>

#principal {
	MARGIN: 2px auto; 
	POSITION: relative;
	border:1px solid #000;
}
#principal UL {
	
}
#principal LI {
	DISPLAY: inline; 
	FLOAT: left
	border:2px solid #000;
	
}
</style>
";
	
	
	
	$js .="<script src=\"js/thickbox.js\" type=\"text/javascript\"></script>";
	
	
	$css.="<link rel=\"stylesheet\" href=\"css/image-slideshow-5.css\" type=\"text/css\">";



  $query= "SELECT id_cliente,id_galeria,fecha, nombre,descripcion,imagen 
           FROM  galerias
		   where id_galeria=$id_galeria";
		   
   $result= cms_query($query)or die (error($query,mysql_error(),$php));
	 
      list($id_cliente,$id_galeria,$fecha,$nombre,$descripcion,$imagen) = mysql_fetch_row($result);
	  
	  
	  $dir = opendir("$fuente_relativa/$id_cliente/$id_galeria/"); 
			$i = 0;
			while ($images[$i][0] = readdir($dir)){
				if($images[$i][0]=="." or $images[$i][0]=="..") continue;				 
				$aux = filesize("$fuente_relativa/$id_cliente/$id_galeria/".$images[$i][0])/1048576;
				$images[$i][1] = round($aux,2);
			  $peso_carpeta= $peso_carpeta + $images[$i][1];
			}

	  
	  
	  
$contenido = "<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                <tr>
                  <td align=\"center\" class=\"textos\">Galeria : <b>$nombre</b></td>
                </tr>
				 <tr>
                  <td align=\"center\" class=\"textos\">Peso : <b>$peso_carpeta Mg</b></td>
                </tr>
              <tr>
                  <td align=\"center\" class=\"textos\">
				  <img src=\"gal/imagen_chica_gal.php?filename=$imagen&id_cliente=$id_cliente&id_galeria=$id_galeria&tamanio_image=100\" alt=\"thumbnail\"  border=\"0\" 
					title=\"Nombre: $nombre_gal\nDescripcion : $descripcion\" class=\"cuadro\"/>
				  </td>
                </tr>
				 <tr>
                  <td align=\"center\" class=\"textos\">&nbsp;</td>
                </tr>
              </table>";

			  $imagen_ini ="<img src=\"gal/imagen_chica_gal.php?filename=$imagen&id_cliente=$id_cliente&id_galeria=$id_galeria&tamanio_image=200\"   border=\"0\" />";
			  
while($a<6){
$a++;
$tabla .=" <tr>
                  <td align=\"center\" class=\"textos\">
				  <input type=\"file\" name=\"file$a\" class=\"boton\">
				  </td>
                </tr>
";
}



  //		   where id_galeria=$id_galeria
	$a=0;

	
	
	$marca_ini ="id=\"firstThumbnailLink\"";
	  $query= "SELECT imagen1,id_cliente,id_imagen,pie_esp 
               FROM  imagenes
			   where id_galeria=$id_galeria";
         $result2= cms_query($query)or die (error($query,mysql_error(),$php));
          while (list($imagen1,$id_cliente,$id_imagen,$pie_esp) = mysql_fetch_row($result2)){
		  
		  
    			//echo $imagen1."<br>";
				
				$imagen_chica="<img src=\"gal/imagen_chica_gal.php?filename=$imagen1&id_cliente=$id_cliente&id_galeria=$id_galeria&tamanio_image=100\"  border=\"0\" />";
				$imagen_grande="gal/imagen_chica_gal.php?filename=$imagen1&id_cliente=$id_cliente&id_galeria=$id_galeria&tamanio_image=200";
				
				$imagen1 = str_replace(".","_",$imagen1);
				
				$galeria .=" 
				<table width=\"90%\"  border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" >
    					<tr>
      										<td align=\"center\" class=\"textos\">
      											<a $marca_ini href=\"#gal\" class=\"thickbox\">$imagen_chica</a>
      										</td>
      										<td align=\"center\" class=\"textos\">$pie_esp
      										</td>
      								</tr>
									<tr>
      										<td align=\"center\" class=\"textos\">
      <table width=\"90%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
	    <tr>
	      <td align=\"center\" class=\"textos\">
	      <a href=\"?accion=$accion&act=7&id_galeria=$id_galeria&id_imagen=$id_imagen\">Portada</a>
	      </td>
	      <td align=\"center\" class=\"textos\">
	      <a href=\"?accion=$accion&act=8&id_galeria=$id_galeria&id_imagen=$id_imagen\">Comentario</a>
	      </td>
	      <td align=\"center\" class=\"textos\">
	      <input type=\"checkbox\" name=\"$imagen1\" value=\"checkbox\">
	      </td>
	    </tr>
		</table>
      </td>
      </tr>
	</table>
	";
				
				
	
	}
 
	
	$mini_gal .="<table width=\"90%\"  border=\"0\" align=\"left\" cellpadding=\"0\" cellspacing=\"0\">
		<tr>
				<td align=\"center\" class=\"textos\">
					<input type=\"submit\" name=\"boton_eliminar\" value=\"Eliminar Fotos\" class=\"boton\">
				</td>
			</tr>
	    <tr>
	      <td align=\"center\" class=\"textos\">$galeria</td>
	      </tr>
		</table>";
			
	
	$accion_form = "index.php?accion=$accion&act=4&id_galeria=$id_galeria";
	
	$js .="<script type=\"text/javascript\" src=\"js/fancybox/jquery.fancybox-1.3.4.pack.js\"></script>
	<link rel=\"stylesheet\" type=\"text/css\" href=\"js/fancybox/jquery.fancybox-1.3.4.css\" media=\"screen\" />
	
	
	<script type=\"text/javascript\">
		$(document).ready(function() {
			/*
			*   Examples - images
			*/
		$(\"#subir_fotos\").fancybox({
				'width'				: '75%',
				'height'			: '75%',
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'type'				: 'iframe'
			});

			
		});
	</script>
	
	";
	
$contenido .= "<table width=\"35%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"cuadro\">
                           <tr>
                  				<td align=\"center\" class=\"cabeza\">
				 					 Ingrese Fotos
				 			 </td>
               			 </tr>
						    $tabla
							  
               			
						 
							 </table>
							 <table width=\"90%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
   							<tr>
                  				<td align=\"center\" >
				 					&nbsp;
				 			 </td>
							 </tr>
  							 <tr>
                  				<td align=\"center\" class=\"textos\">
				 					 <input type=\"submit\" name=\"Submit\" value=\"Enviar\" class=\"boton\">
				 			 </td>
							</tr>
							<tr><td align=\"center\" class=\"textos\">
							Agregar fotos
							 </td></tr> 
							<tr>
                  				<td align=\"center\" class=\"texto_plomo\">
				 					*Solo Formato jpg max 700kb c/u
				 			 </td>
							 </tr>
							 <tr>
                  
				  <td align=\"center\" class=\"textos\">
				 
				     $cuadro_perfiles_colegios
				  
				  </td>
                </tr>
							 <tr>
                  				<td align=\"center\" class=\"texto_plomo\">
				 					&nbsp;
				 			 </td>
							 </tr>
							<tr><td align=\"center\" class=\"textos\">
								 </td></tr>							 
							 <tr>
                  				<td align=\"center\" >
								
				 					$mini_gal
				 			 </td>
							 </tr>
	</table>
	<a id=\"subir_fotos\" href=\"http://sgs.probidadytransparencia.gob.cl/bkp_101/rr/blueimp-jQuery-File-Upload-3de48c6/blueimp-jQuery-File-Upload-3de48c6/\">Iframe</a>
	";
	
 
?>