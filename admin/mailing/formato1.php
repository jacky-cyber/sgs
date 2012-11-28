<?php


$contenido .="<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
              <tr>
                              <td align=\"left\" class=\"textos\">Mail nombre <b>\"$nombre_mailing\"  </b></td>
                            </tr>
                             $titulo_subjet
			  <tr>
               <td align=\"left\"  class=\"textos\">Ingresar Imagen del Mailing</td>
              </tr>
			  <tr>
               <td align=\"left\"  class=\"textos\">
			   <input type=\"file\" name=\"imagen\" class=\"texto\"></td>
              </tr>
			  <tr>
			   <td align=\"left\"  class=\"textos\">
			   Link de Imagen  (ejm: http://".$_SERVER['SERVER_NAME'].")</td>
              </tr>
			  <tr>
			   <td align=\"left\"  class=\"textos\">
			   <input type=\"text\" name=\"link\" value=\"http://".$_SERVER['SERVER_NAME']."\" size=\"40\"></td>
              </tr>
			   <tr>
                              <td align=\"center\" class=\"textos\">
                                &nbsp;
								
								<input type=\"hidden\" name=\"id_mailing\" value=\"$id_mailing\">
								<input type=\"hidden\" name=\"id_tipo\" value=\"$predefinido\">
								</td>		
								 </tr>	
								 
					<tr>
                              <td align=\"center\" class=\"textos\">
							  <input name=\"Submit\" type=\"image\" value=\"Enviar\" src=\"images/bot_aceptar.gif\">
                              </td>  
                            </tr>
		    </table>";

?>