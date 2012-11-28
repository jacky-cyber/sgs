<?php
// formulario plantillas


 
      
	
$js.=" <script type=\"text/javascript\" src=\"fckeditor/fckeditor.js\"></script>
<script type=\"text/javascript\">
      window.onload = function()
      {
            
        var oFCKeditor3 = new FCKeditor( 'plantilla_html' );
        oFCKeditor3.BasePath = \"fckeditor/\" ;
		oFCKeditor3.Height = 300 ;
		oFCKeditor3.ReplaceTextarea() ;
      }
    </script>
	
 
"; 
$fecha = date(d)."-".date(m)."-".date(Y);

$contenido = "
<link href=\"tienda/css/tienda.css\" rel=\"stylesheet\" type=\"text/css\"/>
<link href=\"css/sitio.css\" rel=\"stylesheet\" tyspe=\"text/css\"/>
<table width=\"90%\"  border=\"0\" align=\"center\"  cellpadding=\"0\" cellspacing=\"0\" >
    			<tr>
      					<td align=\"center\" class=\"cabeza_rojo\">Plantilla Noticia</td>
    			</tr>
    			<tr><td align=\"center\" class=\"textos\"> &nbsp;</td></tr>
      			<tr>
      					<td align=\"left\" class=\"textos\">&nbsp;&nbsp;Nombre Plantilla
      						<input type=\"type\" name=\"nombre_plantilla\" value=\"$nombre_plantilla\" class=\"textos\">
      					</td>
      			</tr>
      			<tr><td align=\"center\" class=\"textos\"> &nbsp;</td></tr>
				<tr>
						<td align=\"left\" class=\"textos\" valign=\"top\">
						<textarea name=\"plantilla_html\" cols=\"50\" rows=\"8\" class=\"textos\">$plantilla_html</textarea>
						</td>
				</tr>
      			<tr>
      					<td align=\"center\" class=\"textos\"> &nbsp;</td>
      			</tr>
      			<tr> 
				 		<td align=\"center\" class=\"textos\">
						<input class=\"boton\" type=\"submit\" name=\"boton_ok\" value=\"Aceptar\">&nbsp;&nbsp;&nbsp;&nbsp;
						<input class=\"boton\" type=\"submit\" name=\"boton_actualiza\" value=\"Actualizar\"></td>
				</tr>
      			<tr>
      					<td align=\"center\" class=\"textos\"> &nbsp;</td>
      			</tr>
      			      			
      			</table>
      			<input type=\"hidden\" name=\"id_usuario\" id=\"id_usuario\" value=\"$id_usuario\">
      			<input type=\"hidden\" name=\"fecha\" id=\"fecha\" value=\"$fecha\">
      			<input type=\"hidden\" name=\"id_plantilla_noticia\" id=\"id_plantilla_noticia\" value=\"$id_plantilla_noticia\">
      			<input type=\"hidden\" name=\"defecto\" id=\"defecto\" value=\"$defecto\">
      			";








?>