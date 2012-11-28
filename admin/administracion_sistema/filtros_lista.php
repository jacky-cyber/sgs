<?php

/*
 * Select tabla auto_admin_filtros
 * 
 */
$query= "SELECT id_filtro,filtro, filtro_sql  
           FROM  auto_admin_filtros";
     $result_auto_admin_filtros= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($id_filtro,$filtro, $filtro_sql) = mysql_fetch_row($result_auto_admin_filtros)){
			$filtros_sql .="<option value=\"$id_filtro\">$filtro</option>";			   
		 }
/** fin select auto_admin_filtros***/



$tabla_filtros = "  <div class=\"input-append\">
                                                        <div class=\"well_auto_admin\">
                                                           
                                                            
                                                            <select id=\"campo\" name=\"campo\" >
																<option value=\"uno\">Seleccione un campo</option>
																$lista_campos
                                                            </select>
															
															<select id=\"select\" name=\"select\">
																$filtros_sql
                                                            </select>
                                                                                            
                                                            <input  id=\"texto_filtro\" name=\"texto_filtro\" type=\"text\" class=\"input-small\" >
															<button id=\"filtrar\" name=\"filtrar\" class=\"btn boton_search_auto_admin\" type=\"button\">Filtrar</button>
															<button id=\"reset\" name=\"reset\" class=\"btn boton_search_auto_admin\" type=\"button\">Reiniciar</button>
															
                                                        </div>
                                                                
                                        </div>
                                        
                                        
                                        ";



?>