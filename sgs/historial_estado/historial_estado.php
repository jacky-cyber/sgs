<?php


$cont=0;


		 
		 $query=   "SELECT id_estado_solicitud,
  						id_estado_respuestas,
						fecha,
						a.id_usuario,
						observacion,
						concat(b.nombre,' ',paterno,' ',materno) as nombre  ,
						perfil,
						c.funcionario 
           FROM  sgs_flujo_estados_solicitud a,
		   			 usuario b,
                     usuario_perfil c
           WHERE folio='$folio'
		   			and a.id_usuario = b.id_usuario
		   			and b.id_perfil = c.id_perfil
    	   order by a.fecha desc,a.id_flujo_estados_solicitud desc  ";
		   
		   
		
		   
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($id_estado_solicitud,$id_estado_respuestas,$fecha,$id_usuario_responsable,$observacion,$nombre,$nombre_perfil,$funcionario) = mysql_fetch_row($result)){
			$template_historial = html_template('linea_estado_solicitud_user_registrado_nuevo');		
			
			$fecha = fechas_html($fecha);
			
			$responsable = nombre_usuario_($id_usuario_responsable);
			
			
			
			$query = "select estado_solicitud 
					  from sgs_estado_solicitudes 
					  where id_estado_solicitud = $id_estado_solicitud ";
			$result2= cms_query($query)or die (error($query,mysql_error(),$php));
      		list($estado_respuesta) = mysql_fetch_row($result2);
			
			//$estado_respuesta = rescata_valor('sgs_estado_solicitudes',$id_estado_solicitud,'estado_solicitud') ;
			
			$query = "select estado_solicitud 
					  from sgs_estado_solicitudes 
					  where id_estado_solicitud = $id_estado_solicitud";
			$result3= cms_query($query)or die (error($query,mysql_error(),$php));
      		list($id_padre) = mysql_fetch_row($result3);
			
			//$id_padre = rescata_valor('sgs_estado_solicitudes',$id_estado_respuestas,'id_estado_padre') ;
			
			$template_historial = cms_replace("#OBS#","$observacion",$template_historial);
			$template_historial = cms_replace("#ESTADO#",acentos($estado_respuesta),$template_historial);
			$template_historial = cms_replace("#OBSERVACION#","<i>$observacion</i>",$template_historial);
			$template_historial = cms_replace("#RESPONSABLE#","$responsable",$template_historial);
			$template_historial = cms_replace("#FECHA#","$fecha",$template_historial);
			$template_historial = cms_replace("#NOMBRE_USUARIO#","$responsable($nombre_perfil)",$template_historial);
			
			
			
			$cont++;	
			

			
			
			$lista_historial .="
			<div class=\"item\" id='item$cont'>	
				<div class=\"stbody\" id=\"stbody$cont\">
				
						$template_historial
					
				</div>	
			</div>
			";
			
			   
		 }
		 
		 /*
		 $template_historial = "  <table width=\"100%\"  border=\"0\" align=\"left\" cellpadding=\"3\" cellspacing=\"3\" style=\"font-family: Arial, Helvetica, sans-serif; font-size: 11px;\">
		 <tr><th align=\"left\" ><h3>Historial de Cambios de esta Solicitud</h3> </th></tr> 
                                   $lista_historial
                                	</table>";*/
		 
		 $template_historial = "<script src=\"sgs/historial_estado/js/jquery.masonry.min.js\"></script>
<script src=\"sgs/historial_estado/js/timeline.js\"></script><link href=\"sgs/historial_estado/css/timeline.css\" rel=\"stylesheet\" type=\"text/css\">".html_template('nueva_linea_historial');
		 $template_historial = cms_replace("#LISTA_HISTORIAL#","$lista_historial",$template_historial);
		 
		 
		 /*
		 $template_historial = "
		 
		 <table width=\"100%\" border=\"0\" cellspacing=\"2\" cellpadding=\"2\">
				<tr>
					<td class=\"datos_sgs\"><table width=\"100%\" border=\"0\" align=\"left\" cellpadding=\"2\" cellspacing=\"0\">
						<tr>
						  <th>Historial de Cambios de esta Solicitud</th>
						</tr>		
						$lista_historial
					</table>
					</td>
				</tr>
			</table>
		 
		 ";
		 
		 */
		 
		 if($cont==0){
		
		   $template_historial = html_template('lo_sentimos_no_existe_info');	
		 }
		 
		 

		
		 
		 /*
		 
		 
		 <table width="100%" border="0" cellspacing="0" cellpadding="0">
  
   <tr>
    <td>
        <strong>Fecha Asignaci&oacute;n:</strong> #FECHA#</td>
  </tr> <tr>
    <td><strong>Estado :</strong> #ESTADO#
      </td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><strong>Observaci&oacute;n</strong></td>
      </tr>
      <tr>
        <td>#OBSERVACION#</td>
      </tr>
    </table></td>
  </tr>
</table>
		 
		 */
		 
?>