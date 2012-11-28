<?php

$id_usuario= id_usuario($id_sesion);
$perfil_admin = configuracion_cms('perfil_admin_sistemas_sgs');	 
	 
    $query= "SELECT id_entidad_padre,id_entidad  
           FROM  usuario u, usuario_perfil up 
           WHERE u.id_usuario='$id_usuario'
		   and u.id_perfil=up.id_perfil
		   and up.funcionario=1";
		  // echo $query;
     $result_entidad= cms_query($query)or die (error($query,mysql_error(),$php));
     if(list($id_entidad_padre,$id_entidad) = mysql_fetch_row($result_entidad)){
	 	if($id_entidad_padre=="0" or $id_entidad=="0"){
				//$texto_alerta = configuracion_cms("text_alerta_usuario_sin_entidad");
	
				$texto_alerta =" <tr>
                      				<td >
					 					 $texto_alerta
					  				</td>
                      			</tr>";
				$alerta = cuadro_alerta($texto_alerta);

	 	}elseif($id_perfil==$perfil_admin ){
			$alerta="";
		}
	
	 }elseif($id_perfil==$perfil_admin ){
	
	 	$alerta="";
	 
	 }
	 
	 
	
	



?>