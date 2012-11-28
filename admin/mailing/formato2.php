<?php

			
						   
		

 $contenido .="<table width=\"400\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
         <tr>
                              <td align=\"center\" class=\"textos\">Mail nombre <b>\"\"$nombre_mailing </b></td>
                            </tr>
                            $titulo_subjet
		<tr>
           <td align=\"center\" class=\"textos\">Texto Html</td>
		  </tr>
		  <tr>
           <td align=\"center\" class=\"textos\">
		   <textarea name=\"html\" cols=\"60\" rows=\"10\" class=\"textos\"></textarea>
		   </td>
		 </tr>
		   <tr>
           <td align=\"center\" class=\"textos\">Texto Plano</td>
		 </tr>
		  <tr>
           <td align=\"center\" class=\"textos\">
		   <textarea name=\"texto_html\" cols=\"60\" rows=\"10\" class=\"textos\"></textarea>
		  </td>
		 </tr>
		   <tr>
             <td align=\"center\">&nbsp;</td>
           </tr>
           <tr>
             <td align=\"center\">
			 <input type=\"file\" name=\"imagen\" class=\"textos\">
             </td>
           </tr>
		   <tr>
             <td align=\"center\">
			 &nbsp;
             </td>
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
                              &nbsp;&nbsp;<a href=\"index.php?id_usuario=$id_usuario&user=$user&accion=$accion\">
                              <img src=\"images/bot_crear.gif\" border=\"0\" alt=\"\"></a>
                                </td>  
                            </tr>	
		    </table>";
	
	      
	
   


?>