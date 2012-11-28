<?php

  $query= "SELECT accion,descrip_php_esp ,id_tipo  
           FROM  acciones
		   
		   order by descrip_php_esp asc";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($accion_list,$descrip_php_esp_list,$id_tipo_list) = mysql_fetch_row($result)){
			
			
			$lista_acciones .="<option value=\"?accion=$accion&act=20&atc_o=$act&id=$id&acc_add=$accion_list&opcion=$opcion&id_gru=$id_gru\">$descrip_php_esp_list</option>"; 
			
			
						   
		 }
	
		 
		 
		 
		   $query= "SELECT acciones
                    FROM  accion_acciones
                    WHERE accion=$id";
              $result= cms_query($query)or die (error($query,mysql_error(),$php));
               while (list($acciones) = mysql_fetch_row($result)){
         				
						
						  $query= "SELECT descrip_php_esp,php   
                                   FROM  acciones 
                                   WHERE accion ='$acciones'";
                             $result3= cms_query($query)or die (error($query,mysql_error(),$php));
                             list($descrip_php_esp_l,$php_l) = mysql_fetch_row($result3);
							 
							 
						
						
						$lista_acciones_asignadas .="<tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">
														<td align=\"left\" class=\"textos\" title=\"$php_l\">$descrip_php_esp_l </td>
														<td align=\"center\" class=\"textos\" title=\"$php_l\">
                                                                <a href=\"?accion=$accion&act=21&atc_o=$act&id=$id&acc_del=$acciones&opcion=$opcion&id_gru=$id_gru\">
                                                                 <img src=\"images/del.gif\" alt=\"\" border=\"0\">
                                                                </a>
                                                          </td>
													</tr> ";
						
						
								   
         		 }
		 
		 
		 $lista_acciones_incluidas  = "<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"cuadro\">
                         <tr>
                           <td align=\"center\" class=\"cabeza_rojo\" colspan=\"2\">Lista de Acciones asiganadas a este modulo</td>
                         </tr>
						 $lista_acciones_asignadas
                       </table>";
		 
		 
		 $contenido .= "<table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\">
                         <tr>
                           <td align=\"center\" class=\"textos\">Agregar una acci&oacute;n</td>
                         </tr>
						 <tr><td align=\"center\" class=\"textos\">
						 <select name=\"menu1\" onChange=\"MM_jumpMenu('parent',this,0)\">
         <option value=\"#\">Seleccione el modulo a agregar</option>
        $lista_acciones
         </select>  </td></tr> 
		 <tr><td align=\"center\" class=\"textos\">
		 $lista_acciones_incluidas
		  </td></tr> 
                       </table>";
					   
					   
		
					   

?>