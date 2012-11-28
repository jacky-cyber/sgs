<?php

  $accion_form= "$PHP_SELF?accion=$accion&act=1001";
	   
	   
       $contenido ="<table width=\"400\" border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\">
         <tr>
           <td align=\"center\"  class=\"textos\">Ingresar Nombre de Mailing</td>
         </tr>
		 <tr>
           <td align=\"center\" class=\"textos\">
		   <input type=\"text\" name=\"nombre_mailing\"></td>
         </tr>
		
		  
		 <tr>
           <td align=\"center\" class=\"textos\">
		   
           <input type=\"radio\" name=\"predefinido\" value=\"1\" checked>Imagen
         
           <input type=\"radio\" name=\"predefinido\" value=\"3\">Html Predefinido
 
           </td>
		  </tr>
		    <tr>
             <td align=\"center\">
			 <input name=\"Submit\" type=\"image\" value=\"Enviar\" src=\"images/bot_aceptar.gif\">
             </td>
           </tr>
		
       </table>
   ";   

   // <input type=\"radio\" name=\"predefinido\" value=\"2\">Formato Libre  
   
?>