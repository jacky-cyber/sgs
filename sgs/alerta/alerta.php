<?php
//2005-11-30ffgg


$cantidad_dias_minimo=10;

$fecha_actual  = date(Y)."-".date(m)."-".date(d);

 $ndias = -30;
 
 $estados_alerta= configuracion_cms('Estados_alerta');
 $cant_solicitudes_alerta= configuracion_cms('cantidad_solicitudes_alerta');
 //$cant_solicitudes_alerta= configuracion_cms('cantidad_solicitudes_alerta');
 
 $id_usuario     = id_usuario($id_sesion);
 
     $query= "SELECT id_entidad   
            FROM  usuario
            WHERE id_usuario='$id_usuario'";
      $result_alerta= cms_query($query)or die (error($query,mysql_error(),$php));
       list($id_entidad) = mysql_fetch_row($result_alerta);
	   
	   
		 
		 $fecha2 = strtotime($fecha) + $ndias*24*60*60;
		 $nuevafecha= date('Y-m-d', $fecha2); 
		
    $query= "SELECT folio ,fecha_termino ,fecha_inicio
           FROM  sgs_solicitud_acceso
		   WHERE  	id_estado_solicitud <>13
		  
		   and id_entidad= '$id_entidad'
		   ORDER BY fecha_termino asc
		   LIMIT 0,$cant_solicitudes_alerta";
		   
		/*		$contendor_ul=html_template('contenedor_ul_alerta');
				$contendor_ul=cms_replace("#CANTIDAD_ALERTAS#",$cant_solicitudes_alerta,$contendor_ul);  
		*/
     $result_alerta= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($folio ,$fecha_termino,$fecha_respuesta) = mysql_fetch_row($result_alerta)){
	 		
			$aux=explode("-", $fecha_termino);
    		$aux1=explode("-", $fecha_actual);
    			
				//echo $aux[0]."<br>";
				if($aux[0]>2007 and $aux1[0]>2007){
				 
				  //$dias = diferencia_entre_fechas($fecha_termino,$fecha_actual);
				
				 $fecha_termino2 = fechas_bd($fecha_termino);
				$fecha_respuesta2 = fechas_bd($fecha_respuesta);
				  $dias = calculaDiasHabilesEntreFechas($fecha_actual,$fecha_termino2);
				 
				  if($dias==0){
				    $dias=1;
				  }else{
				  	//$dias=$dias-1;
				  }
				  
				}
				#CANTIDAD_ALERTAS#$cant_solicitudes_alerta
				
				if($dias<$cantidad_dias_minimo){
				/*$lista_contenido_alerta .= "<tr>
				<td align=\"center\"  ><a href=\"index.php?accion=gestion-de-solicitudes&act=1&folio=$folio\" >
				$folio <img src=\"images/click_arrow.gif\" alt=\"\" border=\"0\"></a></td>
				<td align=\"center\"  title=\"\">$dias</td> </tr>\n";	
				*/
				$lista_contenido_alerta.=html_template('contenedor_alerta');
				$lista_contenido_alerta=cms_replace("#LINK_ALERTA#","index.php?accion=gestion-de-solicitudes&act=1&folio=$folio",$lista_contenido_alerta);				
				$lista_contenido_alerta=cms_replace("#FOLIO_ALERTA#",$folio,$lista_contenido_alerta);				
				$lista_contenido_alerta=cms_replace("#ALERTA_DIAS#",$dias,$lista_contenido_alerta);		
				
			
				}
			
									   
		 }
		
		

					if($lista_contenido_alerta !=""){
					/*$texto_alerta= "<tr><td align=\"center\"  colspan=\"2\"><strong>Solicitudes prontas a vencer</strong></td></tr> 
							<tr><td align=\"center\"  colspan=\"2\">Folio y D&iacute;as para vencer</td>
							</tr> 
							$lista_contenido_alerta ";
					*/
							$ul_contenido_alerta.=html_template('ul_contenedor_alerta');
							$texto_alerta.=	html_template('titulo_contenedor_alerta');
							$ul_contenido_alerta=cms_replace("#LI_ALERTA#",$lista_contenido_alerta,$ul_contenido_alerta);				
							$texto_alerta.=$ul_contenido_alerta;
							$alerta .= $texto_alerta;
							
							}
							
					

				

?>