<?php

//sacar los usuarios del historial
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
				   order by id_flujo_estados_solicitud asc ";
		   
		   
	$tab = "<!--<br><br><h3>Resumen d&iacute;as de tr&aacute;mite</h3><br>-->
	
				<table width=\"100%\" border=\"0\" cellspacing=\"2\" cellpadding=\"2\">
				<tr>
					<td class=\"datos_sgs\"><table width=\"100%\" border=\"0\" align=\"left\" cellpadding=\"2\" cellspacing=\"0\">
						<tr>
						  <th>Resumen d&iacute;as de tr&aacute;mite</th>
						</tr>		
					
					</table>
					</td>
				</tr>
			</table>
			
			<table id=\"listado\" class=\"textos\" width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
			  <thead>
			  <tr>
				<th width=\"25%\">Modificado por</th>
				<th width=\"20%\">Perfil</th>
				<th width=\"25%\">Estado</th>
				<th width=\"15%\">Fecha</th>
				<th width=\"15%\">Días de trámite</th>
				#REGISTROS#
			  </tr>
			 </thead>
			  
			</table><br>";	
	$registro = "<tr>
					<td>#USUARIO#&nbsp;</td>
					<td>#PERFIL#&nbsp;</td>
					<td>#ESTADO#&nbsp;</td>
					<td>#FECHA#&nbsp;</td>
					<td><div align=\"right\">#DIAS_TRAMITE#&nbsp;</div></td>
				  </tr>";
		   
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
	 $fecha_calculo="";
	
	  while (list($id_estado_solicitud,$id_estado_respuestas,$fecha,$id_usuario_responsable,$observacion,$nombre,$nombre_perfil,$funcionario) = mysql_fetch_row($result)){
	  
			
	  
			$dias_tramite = 0;
			$fecha_bd = $fecha;
			if ($fecha_calculo==""){
				$sql = "Select fecha_inicio from sgs_solicitud_acceso where folio = '$folio'";
				$result_3= cms_query($sql)or die (error($query,mysql_error(),$php));
				list($fecha_inicio) = mysql_fetch_row($result_3);
				$fecha_calculo = $fecha_inicio;
			}
			//echo "\nfecha historial:".$fecha."   fecha inicio:".$fecha_calculo."\n";
			$dias_tramite = calculaDiasHabilesEntreFechas($fecha_calculo,$fecha_bd);
			$fecha_calculo = $fecha;
		
		  /*if($nombre_perfil !="Solicitante Web"){*/
		 
		  $fecha = fechas_html($fecha);
		  $responsable = nombre_usuario2($id_usuario_responsable);
		  $query = "select estado_solicitud 
					  from sgs_estado_solicitudes 
					  where id_estado_solicitud = $id_estado_solicitud ";
		   $result2= cms_query($query)or die (error($query,mysql_error(),$php));
      	   list($estado_respuesta) = mysql_fetch_row($result2);
		  
		  
		  $registros .= $registro;
		  $registros = cms_replace("#USUARIO#",$responsable,$registros);
		  $registros = cms_replace("#PERFIL#",$nombre_perfil,$registros);
		  $registros = cms_replace("#ESTADO#",acentos($estado_respuesta),$registros);
		  $registros = cms_replace("#FECHA#",$fecha,$registros);
		  if($dias_tramite == 0){
		  
			$resumen_dias_cero = configuracion_cms('resumen_dias_cero');
			$registros = cms_replace("#DIAS_TRAMITE#",$resumen_dias_cero,$registros);
		  }else{
			$registros = cms_replace("#DIAS_TRAMITE#",$dias_tramite,$registros);
		  
		  }
													  
		   
		//}
		  
	  }
	  
	  $tab = cms_replace("#REGISTROS#",$registros,$tab);
	  $contenido = cms_replace("#GESTION#",$tab,$contenido);

?>