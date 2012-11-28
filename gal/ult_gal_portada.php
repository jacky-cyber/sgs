<?php


$contenido .="<style type=\"text/css\">

/*Credits: Dynamic Drive CSS Library */
/*URL: http://www.dynamicdrive.com/style/ */

.toggleopacity img{
filter:progid:DXImageTransform.Microsoft.Alpha(opacity=80);
-moz-opacity: 0.5;
}

.toggleopacity:hover img{
filter:progid:DXImageTransform.Microsoft.Alpha(opacity=100);
-moz-opacity: 1;
}

.toggleopacity img{
border: 3px solid #ccc;
}

.toggleborder:hover img{
border: 1px solid navy;
}

.toggleborder:hover{
color: red; /* Dummy definition to overcome IE bug */
}

</style>
";

 $query= "SELECT id_cliente,id_galeria,fecha,nombre,descripcion,imagen    
                   FROM  galerias
				   ORDER BY id_galeria DESC 
				   LIMIT 0, 6";
           $result= @cms_query($query) or die("$MSG_DIE -1 QR-$query");
           while (list($id_cliente,$id_galeria,$fecha,$nombre_gal,$descripcion,$imagen) = mysql_fetch_row($result)){
		   		   
		    $fuente ="../images/sitio/gal/$id_cliente/$id_galeria/$imagen";
		
				
                    $link ="gal/marca.php?imagen=$imagen&id_cliente=$id_cliente";
		            $click =0;
		            $link_foto ="index.php?accion=Galerias&act=1&id_cliente=$id_cliente&id_galeria=$id_galeria";
		            $tum2 ="<a href=\"$link_foto\"  border=\"0\" class=\"toggleopacity\">
					<img src=\"gal/imagen_chica_gal.php?filename=$imagen&id_cliente=$id_cliente&id_galeria=$id_galeria&tamanio_image=100\" alt=\"thumbnail\"  border=\"0\" 
					title=\"Nombre: $nombre_gal\" /></a>";
				
				$fecha= fechas_html($fecha);
				
				$ult_gal .=" <tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\" bgcolor=\"#f8f8f8\">
            				   <td align=\"center\" valign=\"middle\" class=\"textos\" width=\"80\">$tum2</td>
                                           
                                 <td align=\"left\" valign=\"top\"  class=\"textos\" >
								   <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" >
                                     <tr>
                                       <td align=\"left\" class=\"textos\" width=\"80\">Nombre</td>
                                      <td align=\"left\" class=\"textos\">:</td>
                                       <td align=\"left\" class=\"textos\"><b>$nombre_gal</b></td>
                                       </tr>
                                 	 <tr>
                                       <td align=\"left\" valign=\"top\" class=\"textos\" width=\"80\">Descripción</td>
                                      <td align=\"left\" class=\"textos\">:</td>
                                       <td align=\"left\" valign=\"top\" class=\"textos\">$descripcion</td>
                                       </tr>
                                 	 <tr>
                                       <td align=\"left\" class=\"textos\" width=\"80\">Fecha</td>
                                      <td align=\"left\" class=\"textos\">:</td>
                                       <td align=\"left\" class=\"textos\">$fecha</td>
                                       </tr>
                                 	</table>
								 
								</td>
                            </tr>  ";
						   
		   }
		   		   
	$contenido .="<table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\" >
                    <tr>
                  <td align=\"center\" class=\"textos\" colspan=\"2\">Ultimas Galer&iacute;as Ingresadas...</td>
                </tr>
				   <tr>
                  <td align=\"center\" class=\"textos\" colspan=\"2\">&nbsp;</td>
                </tr>
				
				       
                  </table>
				  <table width=\"80%\"  border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\" class=\"cuadro\">
                    
				
				     $ult_gal	    
                  </table>";	   
?>