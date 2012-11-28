<?php

$lista_perfiles = select_tabla('usuario_perfil',$id_campo_selecionado,'id_perfil','perfil',$js_sel,$clase);


$contenido = "<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                <tr>
                  <td align=\"center\" class=\"textos\">Seleccione un perfil para clonar vista: $lista_perfiles</td>
                </tr>
				<tr><td align=\"center\" class=\"textos\"> <input type=\"submit\" name=\"Submit\" value=\"Clonar Perfil\"></td></tr> 
              </table>";
			  
			  
			  
			  
	
?>