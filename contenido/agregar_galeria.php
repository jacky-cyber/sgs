<?php
//agrega galeria

$tamanio_imagen=80;


  $query= "SELECT id_cliente, id_galeria,fecha, nombre,descripcion    
           FROM  galerias
           where id_galeria= $id_galeria";
   //echo "$query";
     $result1= cms_query($query)or die (error($query,mysql_error(),$php));
  list($id_cliente, $id_galeria,$fecha, $nombre,$descripcion) = mysql_fetch_row($result1);
 
      	
      
      	  $query= "SELECT imagen1, pie_esp
      	           FROM  imagenes
      	           WHERE id_galeria='$id_galeria'
      	           Limit 0,30";  
      	              	  
      	
      	     $result2= cms_query($query)or die (error($query,mysql_error(),$php));
      	     while(list($imagen1, $pie) = mysql_fetch_row($result2)){
      	    	$cont_gal++; 
      	
      	if($imagen1!=""){
      		
      		
      	$imagen.="
      	
				<div class=\"imageElement\">
					<h3>$descripcion</h3>
					<p>$pie</p>
					<a href=\"#\" title=\"Abrir imagen $cont_gal\" class=\"open\"></a>
					<img src=\"gal/imagen_chica_gal?filename=$imagen1&id_cliente=$id_cliente&id_galeria=$id_galeria&tamanio_image=450\" class=\"full\" />
					<img src=\"gal/imagen_chica_gal?filename=$imagen1&id_cliente=$id_cliente&id_galeria=$id_galeria&tamanio_image=$tamanio_imagen\" class=\"thumbnail\" />
				</div>\n";
     
      			}

		 }
	
 
 $galeria ="<script type=\"text/javascript\">
			function startGallery() {
				var myGallery = new gallery($('myGallery'), {
					timed: false
				});
			}
			window.addEvent('domready',startGallery);
		</script>
		<table width=\"90\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
		 <tr >
      	      <td align=\"center\" >
      	      
      	      
		<div class=\"content\">
			     <div id=\"myGallery\">								
				 
              $imagen
            			
			</div>
		   </div>
		    </td>
      	      </tr>
      	       <tr><td align=\"center\" class=\"textos\"> &nbsp;</td></tr>
      	    <tr >
      	    
      	      <td align=\"center\" class=\"textos\">
      	      
      	      <a href=\"index.php?accion=galeria&act=1&id_cliente=$id_cliente&id_galeria=$id_galeria\">      	
      	      >>Ver galer&iacute;a Completa<<</a>
      	      </td>
      	      </tr>
      		</table>
		   ";
      
      	
      	 
?>