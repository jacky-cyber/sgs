<?php

	$accion_form = "index.php?accion=$accion&act=12";

							  
							  
		  $query= "SELECT id_campo,campo,xml,pk,txt
                   FROM  auto_admin_campo
                   WHERE id_auto_admin='$id_auto_admin'";
             $result= cms_query($query)or die (error($query,mysql_error(),$php));
              while (list($id_campo,$campo,$xml,$pk,$txt) = mysql_fetch_row($result)){
        			//echo $id_campo;
					
					if($pk==1 or $txt==1){
					
					$Sql ="UPDATE auto_admin_campo 
	  					   SET xml=1 WHERE id_campo ='$id_campo'";

 cms_query($Sql)or die (error($Sql,mysql_error(),$php));
						$xml=1;
						
						$lista_campos_xml .="<tr >
											<td align=\"left\" class=\"textos\">$campo</td>
											<td align=\"center\" class=\"textos\">
											<span class=\"icon-ok\"></spam></td> 
											
										 </tr> ";
										 
										 if($pk==1){
										 $campo_pk= $campo;
										 }
										 
					}else{
					
					
					
					
					   	
					
					if($xml==1){
					$imagen="<span class=\"icon-ok\"></spam>";
					//$check_xml= "checked";
					}else{
					$imagen="<span class=\"icon-remove\"></spam>";
					}
					
					$lista_campos_xml .="<tr >
											<td align=\"left\" class=\"textos\">$campo</td>
											<td align=\"center\" class=\"textos\">
											<div id=\"nombre_$id_campo\" style=\"cursor: hand\" onclick=\"ObtenerDatos('index.php?accion=$accion&act=19&id_campo=$id_campo&axj=1','nombre_$id_campo');\">$imagen</div></td> 
											
										 </tr> ";
					
					}			   
        		 }
				 
				   $tabla_xml = "<table  width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"1\" cellspacing=\"1\" class=\"table table-bordered table-striped\" >
                     <tr class= \"cabeza\">
                       <th align=\"left\" class=\"textos\">Columna</th>
					   <th align=\"center\" class=\"textos\">Incluir en Xml</th> 
                       </tr>
					   $lista_campos_xml
                 	</table>";
			
			
							$contenido .= "<div class=\"span8 alert alert-warning\">
							<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" >
                                <tr>
                                  <td align=\"center\" >IMPORTAR archivo o Poblar tabla</td>
                                </tr>
								<tr><td align=\"left\" class=\"textos\">
								  <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\">
                                    <tr >
                                      <td align=\"left\" class=\"textos\">
									  Archivo <input type=\"file\" name=\"archivo\">
									  </td>
                                      </tr>
									  <tr><td align=\"left\" class=\"textos\">Soobre escribir registros existentes <input type=\"checkbox\" name=\"borra\" value=\"checkbox\"> </td></tr> 
									  <tr><td align=\"left\" class=\"textos\">Separador <input type=\"text\" name=\"separador\" value=\";\" size=\"1\" class=\"input-mini\"> </td></tr> 
								<tr><td align=\"center\" class=\"textos\">
								<input type=\"submit\" name=\"Submit\" value=\"Subir Archivo\" class=\"btn btn-warning\" > </td></tr>
                                	</table>
								
								
								 </td></tr> 
								
                              </table>
			      
			      </div>
			      <div class=\"span8\">
			      
							    <table  width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" >
                                  <tr><td align=\"center\" class=\"textos\"><strong>EXPORTAR DATOS</strong> </td></tr> 
								  <tr>
                                    <td align=\"center\" class=\"textos\">$tabla_xml</td>
                                    </tr>
									<tr><td align=\"center\" class=\"textos\">
									 <table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" >
							  <tr>
							  <td align=\"center\" class=\"textos\"><a href=\"xmlg.php?id=$id_auto_admin\">
							  <img src=\"images/abrir.gif\" alt=\"\" border=\"0\"></br>Clickea Aqui para Exportar tu seleccion a un Archivo Excel</a></td>
							  </tr>
							  
							  <tr><td align=\"center\" class=\"textos\">
							  <font color=\"#FF0000\">Atenci&oacute;n el campo <strong>\"$campo_pk\" NO</strong> debe ser cambiado</font>  </td></tr> 
							  </table>
									 </td></tr> 
                              	</table>
					</div>		  
							 ";

?>