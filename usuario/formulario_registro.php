<?php


if($er==1){
$msj= "Usuario o clave err&oacute;nea.";
}

$login_html ="
    
		<table width=\"196\" border=\"0\" cellpadding=\"2\" cellspacing=\"2\">
				<form name=\"form_login\" method=\"post\" action=\"index.php?accion=login\"  enctype=\"multipart/form-data\">
                        <tr>
                          <td class=\"tit_links\">Usuario:</td>
                          <td><div align=\"right\">
                              <input type=\"Text\" name=\"login\" value=\"Usuario\" class=\"campotexto\" onFocus=\"clearText(this);\">
                          	  </div>
						  </td>
                        </tr>
                        <tr>
                          <td class=\"tit_links\">Contrase&ntilde;a:</td>
                          <td><div align=\"right\">
                               <input type=\"password\" name=\"password\" class=\"campotexto\" value=\"PASSWORD\" onFocus=\"clearText(this);\">
                          	  </div>
						  </td>
                        </tr>
                        <tr>
                          <td height=\"10\" colspan=\"2\"><div align=\"right\">
                             <input  name=\"buscar2\" type=\"submit\" class=\"botones\" id=\"buscar2\" value=\"Ingresar\">
							 </div>																												  
						  </td>
                        </tr>
						<tr><td align=\"center\" class=\"error\" colspan=\"2\" height=\"9\"> $msj</td></tr> 
                  		<tr><td align=\"center\" class=\"error\" colspan=\"2\" height=\"9\">
				   			<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                        		<tr>
                          			<td class=\"tit_links\"><div align=\"left\">
						  			<a href=\"index.php?accion=Olvido\">
						 			&iquest;Olvid&oacute; su clave?</a>&nbsp;&nbsp;
						   			<a href=\"index.php?accion=Registro\">
						   			Reg&iacute;strese aqu&iacute;</a></div>
									</td>
                        		</tr>
                    		</table>
							</td></tr> 
				</form>
		</table> ";
					
				


?>