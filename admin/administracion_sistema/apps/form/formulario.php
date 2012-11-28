<?php
///formulario aplicacion


$js .="<script language=\"JavaScript\">
function validaforma(theForm){

	if (theForm.nom_apps.value == \"\"){
			alert(\"Ingrese un nombre para la aplicación.\");
			theForm.nom_apps.focus();
			return false;
	}
	if (theForm.apps.value == \"\"){
			alert(\"Ingrese el nombre del Php.\");
			theForm.apps.focus();
			return false;
	}

}
</script>";


$onsubmit ="onSubmit=\"return validaforma(this)\"";

$contenido = "<table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"cuadro_light\">
                <tr>
                  <td align=\"center\" class=\"textos\">Aplicaciones</td>
                </tr>
                <tr>
				    <td align=\"center\" class=\"textos\"> &nbsp;</td></tr>					
				</tr>
 				<tr>
 					<td align=\"center\" class=\"textos\">
                		<table width=\"90%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                		
    						<tr>
					   			<td align=\"left\" class=\"textos\">Nombre Aplicaci&oacute;n</td>
					   			<td align=\"left\" class=\"textos\">
					   			<input name=\"nom_apps\" type=\"text\"  value=\"$nom_apps\" class=\"textos\"></td>
				 			</tr>
				 			<tr>
							   <td align=\"left\" class=\"textos\">Aplicaci&oacute;n (PHP)</td>
							   <td align=\"left\" class=\"textos\" height=\" 30\">
							   <input name=\"apps\" type=\"text\"  value=\"$apps\" id=\"$apps\" class=\"textos\" onkeyup=\"ObtenerDatos('index.php?accion=$accion&act=8&act_apps=h&id=&new_dato='+ form1.apps.value +'&axj=1' ,'div_apps');\" ></td>
							 </tr>
							 <tr>
							   <td align=\"left\" class=\"textos\">Icono</td>
							   <td align=\"left\" class=\"textos\">
							   <input type=\"file\" name=\"ico_apps\" value=\"$ico_apps\"></td>
				 			</tr>
				 			 <tr>
							   <td align=\"left\" class=\"textos\">$ico_apps</td>
							   <td align=\"left\" class=\"textos\">
							   </td>
				 			</tr>
				 			<tr>
				     			<td align=\"center\" class=\"textos\" colspan=\"2\"><div id=\"div_apps\" class=\"textos\"> &nbsp;</div></td>
							</tr>
							
				 			<tr>
								<td align=\"center\" align=\"center\" class=\"textos\" colspan=\"2\" >
								<input class=\"boton\" type=\"submit\" name=\"boton\" value=\"Aceptar\">
								</td>
							<tr>
							<tr>
				     			<td align=\"center\" class=\"textos\"> &nbsp;</td>
							</tr>
				 		</table>
					</td>
				</tr>
              </table>";

?>