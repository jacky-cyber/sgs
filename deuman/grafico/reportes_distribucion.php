<?

	$resultado_reporte = html_template('reporte_distribucion_solicitudes');	
	
	if ($nivel==""){
		$nivel = "gubernamental";
	}

	
	switch ($nivel) {
		 case "gubernamental":
				 //$titulo_informe = "Ingresos Totales seg&uacute;n per&iacute;odo (Resumen por Servicio)";
				 //filtro
				
				 $resultado_reporte = str_replace("#FACTOR#","$filtro_factor",$resultado_reporte);
				 $resultado_reporte = str_replace("#ITEM#","$item_tabla",$resultado_reporte);
			
				switch ($id_factor_seleccionado){
					case 1:
						$sql = " select region,
									   COUNT(*) as cantidad
								from usuario a
									 LEFT OUTER JOIN regiones b on a.id_region = b.id_region
								where id_entidad_padre > 0
									and id_entidad_hija > 0
								GROUP by a.id_region";
								
						
						break;
					case 2:
						$sql = " select b.rango_edad,
									   COUNT(*) as cantidad
								from usuario a
									 LEFT OUTER JOIN usuario_rango_edad b on a.id_rango_edad = b.id_rango_edad
								where id_entidad_padre > 0
									and id_entidad_hija > 0
								GROUP by a.id_rango_edad";								
						
								
						break;
					case 3:
						$sql = " select b.sexo,
									   COUNT(*) as cantidad
								from usuario a
									 LEFT OUTER JOIN usuario_sexo b on a.id_sexo = b.id_sexo
								where id_entidad_padre > 0
									and id_entidad_hija > 0
								GROUP by a.id_sexo";	
						break;
					case 4:
						$sql = " select b.nacionalidad,
									   COUNT(*) as cantidad
								from usuario a
									 LEFT OUTER JOIN usuario_nacionalidad b on a.id_nacionalidad = b.id_nacionalidad
									 where id_entidad_padre > 0
									and id_entidad_hija > 0
								GROUP by a.id_nacionalidad";	
						break;
						
					case 5:
						$sql = " select b.nivel_educacional,
									   COUNT(*) as cantidad
								from usuario a
									 LEFT OUTER JOIN usuario_nivel_educacional b on a.id_nivel_educacional = b.id_nivel_educacional
								where id_entidad_padre > 0
									and id_entidad_hija > 0
								GROUP by a.id_nivel_educacional";	
						break;
					case 6:
						$sql = " select b.organizacion,
									   COUNT(*) as cantidad
								from usuario a
									 LEFT OUTER JOIN usuario_organizacion b on a.id_organizacion = b.id_organizacion
								where id_entidad_padre > 0
									and id_entidad_hija > 0
								GROUP by a.id_organizacion";	
						break;
					case 7:
						$sql = " select b.ocupacion,
									   COUNT(*) as cantidad
								from usuario a
									 LEFT OUTER JOIN usuario_ocupacion b on a.id_ocupacion = b.id_usuario_ocupacion
									 where id_entidad_padre > 0
									and id_entidad_hija > 0
								GROUP by a.id_ocupacion";	
						break;
					case 8:
						$sql = "Select tipo_solicitud,
									   count(SUBSTRING(folio,6,1))
								from usuario a
									 LEFT OUTER JOIN sgs_tipo_solicitud b on SUBSTRING(a.folio,6,1) = b.codigo 
									 where id_entidad_padre > 0
									and id_entidad_hija > 0
								GROUP by SUBSTRING(folio,6,1)";	
						break;
				}
				
				$result= cms_query($sql)
					or die ("<br>ERROR $php <br>$query<br><br><span style='color:#FF0000'><b>".mysql_error()."</b></span>");

				$sql_suma = " select COUNT(*) as cantidad
								from usuario
								where id_entidad_padre > 0
									and id_entidad_hija > 0
								";

				$result_suma= cms_query($sql_suma)
					or die ("<br>ERROR $php <br>$query<br><br><span style='color:#FF0000'><b>".mysql_error()."</b></span>");
					
			 	list($total_solicitudes )=  mysql_fetch_row($result_suma);
				
				//echo "<br>total_solicitudes:".$total_solicitudes;
				$lineas = " ";	
				$aLabel = array();
				$aValor = array();	
				$i=0;
				while (list($registro_factor,$cantidad_factor) = mysql_fetch_row($result)){
						if($registro_factor==""){
							$registro_factor = "No especifica";
						}
						$aLabel[$i] = $registro_factor;
						$linea = html_template('reporte_registro_distribucion_solicitudes');	
						$linea = str_replace("#REGISTRO_ITEM#","$registro_factor",$linea);
						$linea = str_replace("#CANTIDAD#","$cantidad_factor",$linea);
						$porcentaje_factor = round( (($cantidad_factor/$total_solicitudes)*100),2) ;
						$aValor[$i] = $porcentaje_factor;
						$linea = str_replace("#PORCENTAJE#","$porcentaje_factor",$linea);
						$lineas = $lineas . $linea;	
						//echo "<br>label:".$aLabel[$i] ." &nbsp;&nbsp;&nbsp;&nbsp;aValor:".$aValor[$i] ;
						$i++;									  
				 }
				 $resultado_reporte = str_replace("#REGISTROS#","$lineas",$resultado_reporte);

				
			 break;
				   
	 }
	
	$sql = "select entidad_padre,
				   entidad,
				   count(*) 
			from sgs_estadisticas_opcionales a,
				 sgs_entidad_padre b,
				 sgs_entidades c
			where a.id_entidad_padre = b.id_entidad_padre
				  and a.id_entidad_hija = c.id_entidad
			GROUP by a.id_entidad_padre,a.id_entidad_hija,b.entidad_padre,c.entidad";
			
	$result_muestra = cms_query($sql)
						or die ("Error: en la consulta: ".mysql_error());
	$linea = "";
	$lineas = "";
	$i=1	;
	$total_solicitudes = 0;
	while (list($entidad_padre,$entidad,$cantidad)= mysql_fetch_row($result_muestra)){
		$linea = html_template('reporte_registro_muestra_servicio');
		
		$linea = str_replace("#NUMERO#","$i",$linea);
		$linea = str_replace("#DEPENDENCIA_MUESTRA#","$entidad_padre",$linea);	
		$linea = str_replace("#SERVICIO_MUESTRA#","$entidad",$linea);	
		$linea = str_replace("#TOTAL_MUESTRA#","$cantidad",$linea);
		$lineas = $lineas .$linea;
		$total_solicitudes = $total_solicitudes + $cantidad;
		$i++;
	}
	$resultado_reporte = str_replace("#REGISTROS_MUESTRA#","$lineas",$resultado_reporte);
	$resultado_reporte = str_replace("#TOTAL_GENERAL#","$total_solicitudes",$resultado_reporte);
	
	$resultado_reporte = str_replace("#INFORMACION#","$informacion",$resultado_reporte);

?>