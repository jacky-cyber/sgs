<?php

	
$archivo_name= $_FILES['archivo_imagen']['name'];
$archivo= $_FILES['archivo_imagen']['tmp_name'];
			
	   if (isset($archivo)){
                     // $archivo2 = ereg_replace('&','*',$archivo_name);
				      //$archivo2 = ereg_replace(' ',':',$archivo2);
					      if (!copy($archivo, "sgs/images/$archivo_name"))
					         {
					        	$contenido_img = "<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"tabla_rojo_sin_ico\">
                                                <tr>
                                                  <td align=\"center\" class=\"textos\">No fue posible subir el archivo imagen</td>
                                                </tr>
                                              </table>"; 
							 }else{
							 	$contenido_img = "<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"tabla_verde_sin_ico\">
                                                <tr>
                                                  <td align=\"center\" class=\"textos\">El archivo fue subido imagen</td>
                                                </tr>
                                              </table>";
							 
							 
							 }
					
                      }		
		

					  
				

?>