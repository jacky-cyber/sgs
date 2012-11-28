<?php

 $id_usuario     = id_usuario($id_sesion);
 
     $query= "SELECT id_entidad   
            FROM  usuario
            WHERE id_usuario='$id_usuario'";
      $result_alerta= cms_query($query)or die (error($query,mysql_error(),$php));
       list($id_entidad) = mysql_fetch_row($result_alerta);
	   
	   $lista_solicitudes_des="";

    $query= "SELECT folio
           FROM  sgs_solicitud_acceso 
           WHERE id_sub_estado_solicitud = 26 and id_entidad='$id_entidad'";
     $result_alerta= cms_query($query)or die (error($query,mysql_error(),$php));
    while(list($folio) = mysql_fetch_row($result_alerta)){
	$cont_des++;
	$lista_solicitudes_des .="<tr><td align=\"center\" >
	<a href=\"index.php?accion=gestion-de-solicitudes&act=1&folio=$folio\" >$folio <img src=\"images/click_arrow.gif\" alt=\"\" border=\"0\"></a></td></tr> ";
	
	}
	
	if($lista_solicitudes_des!=""){
	$texto_alerta = configuracion_cms("alerta_solicitud_desisitimiento");
	
	$texto_alerta = "<tr><td  > $texto_alerta</td></tr> 
	$lista_solicitudes_des";
	$alerta .= cuadro_alerta($texto_alerta);
	} 

?>