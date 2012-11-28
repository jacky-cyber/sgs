<?php

//echo "hola";
$lista_contenido ="";

 $query= "SELECT descrip_php_esp
           FROM   acciones
           WHERE accion='$id'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
     list($descrip_php_esp) = mysql_fetch_row($result);
     
     
      			
$query= "SELECT id_accion_etiqueta,etiqueta,id_contenido    
           FROM  accion_etiqueta
           WHERE accion='$id'";

//echo"$query";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($id_etiqueta,$etiqueta,$id_contenido) = mysql_fetch_row($result)){
	  
	
		  $query= "SELECT titulo
           FROM  noticias
           WHERE id_noticia=$id_contenido";
     $result22= cms_query($query)or die (error($query,mysql_error(),$php));
      list($titulo_noticia) = mysql_fetch_row($result22);
				
   			
			
      	$lista_contenido .="<tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\" bgcolor=\"#f8f8f8\">
			<td align=\"center\" class=\"textos\">$titulo_noticia</td>
			<td align=\"center\" class=\"textos\">$etiqueta</td>
			<td align=\"right\" width=\"30\" class=\"textos\">
			<a href=\"javascript:confirmar('Esta Seguro de Borrar $etiqueta','?accion=$accion&act=9&id_etiqueta=$id_etiqueta&id_gru=$id_gru&id=$id')\">
			<img src=\"images/del.gif\" alt=\"borrar\" border=\"0\"></a>
      		</td>			
			</tr>"; 
		 }
		 
	
		 
		 
	$contenido .="<script languaje=\"javascript\">
      	function confirmar( mensaje, destino) {  
      	  if (confirm(mensaje)) {     
      	     document.location = destino ;  
      		   }
      	}
      	
      	</script>
      	
      	
	<br><br><br>
	
	<table width=\"90%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
		     		<tr>
				       <td align=\"left\" class=\"textos\">&nbsp;</td>
		       			<td align=\"right\" width=\"70\"  class=\"textos\">
					       <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
		    			  <tr>
		        			  <td align=\"center\" class=\"textos\">
		        				<a href=\"?accion=$accion&act=7&id_gru=$id_gru&id=$id\">
		   						<img src=\"images/new.gif\" alt=\"\" border=\"0\"></a>
		  		 			  </td>
		        		</tr>
		  				<tr >
		        			<td align=\"center\" class=\"textos\">
		        			<a href=\"?accion=$accion&act=7&id_gru=$id_gru&id=$id\">Nuevo</a>
		        			</td>
		        		</tr>
		       			<tr><td align=\"center\" class=\"textos\"> &nbsp;</td></tr>
		  					</table>
		       
		       			</td>
		       		</tr>
		 		</table>
		 
		       <table width=\"90%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"1\" class=\"cuadro\">
    				<tr><td align=\"center\" class=\"textos\" colspan=\"3\">Seleccionar un contenido est&aacute;tico y asignarlo a alguna etiqueta del template </td></tr> 
					
					<tr class=\"cabeza_rojo\">
       					<td align=\"center\" >Contenido</td>
			  	        <td align=\"center\" >Etiqueta</td>
		       			<td align=\"center\" width=\"10\">Borrar</td>
      				</tr>
      					$lista_contenido
				</table>";

	
	    $query= "SELECT id_accion_idioma,traduccion,id_idioma
               FROM  accion_idioma
			    WHERE accion='$new_accion'";
			  
         $result23= cms_query($query)or die (error($query,mysql_error(),$php));
          while (list($id_accion_idioma,$traduccion,$id_idioma) = mysql_fetch_row($result23)){
		  
		  	   $idioma = rescata_valor('deuman_idioma',$id_idioma,'idioma');
		  
    				$lista_idiomas .="<tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">
					<td align=\"center\" class=\"textos\">
					$idioma </td>
					<td align=\"center\" class=\"textos\">$traduccion</td> 
					<td align=\"center\" class=\"textos\">
					<a href=\"#\" onclick=\"ObtenerDatos('index.php?accion=$accion&act=23&id_idioma=$id_accion_idioma&axj=1','div_respuesta');\">
					<img src=\"images/del.gif\" alt=\"Eliminar\" border=\"0\"></a>
					</td> </tr> ";			   
    		 }

			 
			     $query= "SELECT id_idioma,idioma 
                        FROM  deuman_idioma
                        WHERE activo = 1";
                  $resultds= cms_query($query)or die (error($query,mysql_error(),$php));
                   while (list($id_idioma,$idioma) = mysql_fetch_row($resultds)){
             				$lista_salta .="<option value=\"$id_idioma\">$idioma</option>";
             		 }
					 
			 $js .= "<script language=\"JavaScript\">
					
					function procesar_leg_accion(url)
		{
		var url_consulta=url;
				
			$.ajax ({
				url:  url_consulta,								/* URL a invocar asíncronamente */
				type: 'post',										/* Método utilizado para el requerimiento */
				data: $('#form2').serialize(),		/* Información local a enviarse con el requerimiento */
				
				async:true,
       			beforeSend: function(objeto){ /*mostramos un mensaje de espera*/
          		   $('#div_cargando').show(); 
				   $('#div_respuesta').hide();
				   $('#boton').attr('disabled',true);
       			 },
				success: function(request, settings)/* Que hacer en caso de ser exitoso el requerimiento */
				{	
					 $('#div_cargando').hide();
					 $('#div_respuesta').show(); 
					 $('#div_respuesta').html(request); /*Mostramos resultados del php*/
					 $('#boton').attr('disabled',false);
					   resetForm('form2');
				},
				error: function(request, settings)/*Upsss... algun problema*/
				{
					$('#div_respuesta').html('Error');
				}				
			});
		}
		
		
					
					
				$(document).ready(function () 
					{
						$('#boton').click(function() 
						{ procesar_leg_accion('index.php?accion=$accion&act=22&id_a=$id&axj=1');
						});
					});
				</script>";
			 
			$contenido .=" <br>  </form>
			 <form action=\"\" method=\"post\" enctype=\"multipart/form-data\" name=\"form2\" id=\"form2\" accept-charset=\"UTF-8\">
                               
								 <table width=\"300\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                                   <tr >
                                     <td align=\"center\" class=\"textos\">Traducci&oacute;n de menu para esta Acci&oacute;n</td>
                                     </tr>
									 <tr><td align=\"center\" class=\"textos\">Seleccione un idioma
									 <select name=\"id_idioma\" >
									 <option value=\"#\">-----></option>
                                			$lista_salta 
                             		 </select>	
									  </td></tr>
									  <tr><td align=\"center\" class=\"textos\">Traducci&oacute;n 
									  <input type=\"text\" name=\"traduccion\" id=\"traduccion\"> </td></tr> 
									  <tr>
      <td class=\"textos\" align=\"center\" ><label>
        <input type=\"button\" name=\"boton\" id=\"boton\" value=\"Agregar Traducci&oacute;n\" />
      </label></td>
      </tr>
	  <tr><td align=\"center\" class=\"textos\">&nbsp; </td></tr> 
									 <tr><td align=\"center\" class=\"textos\"> 
			
			</td></tr> 
                               	</table>
								   <table width=\"100%\"  border=\"0\" align=\"left\" cellpadding=\"0\" cellspacing=\"0\">
     <tr >
       <td class=\"textos\" align=\"center\" class=\"textos\">
	   <div id=\"div_respuesta\" align=\"center\">
	  					 <table width=\"300\"  border=\"0\" align=\"center\" cellpadding=\"1\" cellspacing=\"1\">
                             $lista_idiomas
                          	</table></div>
<div id=\"div_cargando\" style=\"display:none\">Enviado datos, Espere...</div>
	   </td>
       </tr>
 	</table>";	
				
			
?>