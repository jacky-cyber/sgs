<?php

	$accion_form = "index.php?accion=$accion&act=12";

							  
							  
		  $query= "SELECT id_campo,campo,xml
                   FROM  auto_admin_campo
                   WHERE id_auto_admin='$id_auto_admin'";
             $result= cms_query($query)or die (error($query,mysql_error(),$php));
              while (list($id_campo,$campo,$xml) = mysql_fetch_row($result)){
        			//echo $id_campo;
					if($xml==1){
					$imagen="<img src=\"images/ok2.gif\" alt=\"\" border=\"0\">";
					//$check_xml= "checked";
					}else{
					$imagen="<img src=\"images/not_ok2.gif\" alt=\"\" border=\"0\">";
					}
					
					$lista_campos_xml .="<tr>
											<td align=\"left\" class=\"textos\">$campo</td>
											<td align=\"center\" class=\"textos\"><div id=\"nombre_$id_campo\" style=\"cursor: hand\" onclick=\"ObtenerDatos('index.php?accion=$accion&act=19&id_campo=$id_campo&axj=1','nombre_$id_campo');\">$imagen</div></td> 
											<td align=\"center\" class=\"textos\">&nbsp</td> 
										 </tr> ";
					
								   
        		 }
				 
				   $tabla_xml = "<table width=\"300\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"cuadro\">
                     <tr class= \"cabeza\">
                       <td align=\"left\" class=\"textos\">Columna</td>
					   <td align=\"center\" class=\"textos\">Incluir en Xml</td> 
                       </tr>
					   $lista_campos_xml
                 	</table>";
			
			
							$contenido .= "<br><br><br><table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"cuadro\">
                                <tr>
                                  <td align=\"center\" class=\"cabeza_rojo\">Poblar tabla</td>
                                </tr>
								<tr><td align=\"left\" class=\"textos\">
								  <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\">
                                    <tr >
                                      <td align=\"left\" class=\"textos\">
									  Archivo <input type=\"file\" name=\"archivo\">
									  </td>
                                      </tr>
									  <tr><td align=\"left\" class=\"textos\">Soobre escribir registros existentes <input type=\"checkbox\" name=\"borra\" value=\"checkbox\"> </td></tr> 
									  <tr><td align=\"left\" class=\"textos\">Separador <input type=\"text\" name=\"separador\" value=\";\" size=\"1\"> </td></tr> 
								<tr><td align=\"center\" class=\"textos\">
								<input type=\"submit\" name=\"Submit\" value=\"Subir Archivo\"> </td></tr>
                                	</table>
								
								
								 </td></tr> 
								
                              </table><br/>
							  $tabla_xml";

?>