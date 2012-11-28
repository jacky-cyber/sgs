<?php

$id_usuario = id_usuario($id_sesion);

  $query= "SELECT id_perfil,perfil  
           FROM  usuarios_perfil
           WHERE id_usuario='$id_usuario'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($id_perfil,$perfil) = mysql_fetch_row($result)){
					$tabla_perfil .= "<td align=\"center\" class=\"textos\">$perfil</td>";	 
					
					  $query= "SELECT accion,php,descrip_php_$idm    
					           FROM  acciones";
					     $result= cms_query($query)or die (error($query,mysql_error(),$php));
					      while (list($accion,$php,$descrip_php) = mysql_fetch_row($result)){
									
					      	
					      			$tabla_check .= "<td align=\"center\" class=\"textos\"> &nbsp;</td>";
					      			
					      			  
							 }
					  
		 }

?>