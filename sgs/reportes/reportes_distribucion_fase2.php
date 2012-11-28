<?
	error_reporting(E_PARSE);
	
	
	$accion_form = "?accion=$accion&act=$act";
	$csv_separador=";";
	$csv_fin_linea = "\n";
	$_SESSION['titulo_informe'] = "Distribución porcentual de solicitudes según factor";

	$nivel = "gubernamental";
	if (isset($_POST["id_factor"])){
		$id_factor = $_POST["id_factor"];
	}else{
		$id_factor = "";
	}
	
	include  ("sgs/reportes/reportes_crea_filtros.php");
	
	$entidades_configuradas = configuracion_cms("id_entidad");
	
	//echo "<br>id_factor_seleccionado:".$id_factor_seleccionado;
	$resultado_reporte = html_template('reporte_distribucion_solicitudes');	
	
		
	$fecha_inicio = $_POST['fecha_inicio'];
	$fecha_termino = $_POST['fecha_termino'];
	
	//echo "<br>fecha inicio:".$fecha_inicio;
	//echo "<br>fecha termino:".$fecha_termino;
	
	$campo_inicio = "<input type=\"date\"  name=\"fecha_inicio\" id=\"fecha_inicio\"  readonly=\"readonly\"  /><img src=\"images/calendario.gif\" alt=\"\" border=\"0\"  value=\"$fecha_inicio\" >";
					
	$campo_termino = "<input type=\"text\" class=\"calendario_datepicker\" name=\"fecha_termino\" id=\"fecha_termino\"  readonly=\"readonly\"   value=\"$fecha_termino\"/> <img src=\"images/calendario.gif\" alt=\"\" border=\"0\" >";
	
	$resultado_reporte = cms_replace("#FECHA_INICIO#","$campo_inicio",$resultado_reporte);
	$resultado_reporte = cms_replace("#FECHA_TERMINO#","$campo_termino",$resultado_reporte);
	
	$fecha_inicio = fechas_bd($fecha_inicio); 
	$fecha_termino = fechas_bd($fecha_termino); 
	
	
	$js.= "<script>
		function validaFechas(){
			
			fecha_inicio = document.form1.fecha_inicio.value;
			fecha_termino = document.form1.fecha_termino.value;
	
			if ((fecha_inicio!=\"\")&&(fecha_termino!=\"\")){
				aFecha = fecha_inicio.split('-');
				fecha_inicio = aFecha[2]+aFecha[1]+aFecha[0];
				fecha_inicio = parseFloat(fecha_inicio);
				
				aFecha = fecha_termino.split('-');
				fecha_termino = aFecha[2]+aFecha[1]+aFecha[0];
				fecha_termino = parseFloat(fecha_termino);
				
				if (fecha_termino >= fecha_inicio){
					return true;
				}else{
					alert ('La fecha de término debe ser mayor o igual que la fecha de inicio');
					return false;
				}
			}else{
				return true;
			}
			
			
		}
		
		$(document).ready(function(){
			//$(\"#fecha_inicio\").datepicker({'defaultDate':'05-06-2012'});
			$('#fecha_inicio' ).datepicker();
			$('#fecha_inicio').val('".fechas_html($fecha_inicio)."');
			$('#fecha_termino' ).datepicker();
			$('#fecha_termino').val('".fechas_html($fecha_termino)."');
			//$(\".calendario_datepicker\").datepicker( \"option\", \"dateFormat\",'dd-mm-yyyy');
	
		});
		
		</script>";
	
	//echo "<br>fecha termino:".$fecha_termino;
	if (($fecha_inicio!="")&&($fecha_termino=="")){
		$condicion = " and fecha_inicio >='$fecha_inicio'";
	}
	if (($fecha_inicio=="")&&($fecha_termino!="")){
		$condicion = " and fecha_inicio <='$fecha_termino'";
	}
	if (($fecha_inicio!="")&&($fecha_termino!="")){
		$condicion = " and fecha_inicio >='$fecha_inicio' and fecha_inicio <='$fecha_termino'";
	}
	if ($nivel==""){
		$nivel = "gubernamental";
	}
	$condicion .=" and a.id_entidad in ($entidades_configuradas)  and a.id_sub_estado_solicitud > 0 and a.id_sub_estado_solicitud < 29 ";
	//echo $condicion;
	
	$sql = "";
	if ($id_factor_seleccionado==""){
		$id_factor_seleccionado = 1;
		$item_tabla = "Regi&oacute;n";
	}
	//echo "<br>nivel :".$nivel;
	//echo " <br>id_factor_seleccionado:".$id_factor_seleccionado;
	switch ($nivel) {
		 case "gubernamental":
				 //$titulo_informe = "Ingresos Totales seg&uacute;n per&iacute;odo (Resumen por Servicio)";
				 //filtro
				
				 $resultado_reporte = cms_replace("#FACTOR#","$filtro_factor",$resultado_reporte);
				 $resultado_reporte = cms_replace("#ITEM#","$item_tabla",$resultado_reporte);
				 
				
				switch ($id_factor_seleccionado){
					case 1:
					   $sql = "select b.region,
									   COUNT(*) as cantidad
					  				from regiones b
									 left outer join comunas c on c.id_region = b.id_region 
									 left outer join usuario u on c.id_comuna = u.id_comuna
									 LEFT OUTER JOIN sgs_solicitud_acceso a on a.id_usuario = u.id_usuario    
								where a.id_entidad > 0
									$condicion 
								GROUP by b.region";
						$sql_suma = "Select COUNT(*) as cantidad
					  				from regiones b
									 left outer join comunas c on c.id_region = b.id_region 
									 left outer join usuario u on c.id_comuna = u.id_comuna
									 LEFT OUTER JOIN sgs_solicitud_acceso a on a.id_usuario = u.id_usuario    
								where a.id_entidad > 0
									$condicion ";
							//echo "<br>$sql_suma";
							$result_suma= mysql_query($sql_suma)
							or die ("<br>ERROR $php <br>$query<br><br><span style='color:#FF0000'><b>".mysql_error()."</b></span>");
								
						
						break;
					case 2:
						$sql = "select b.rango_edad,
									   COUNT(*) as cantidad
								from sgs_solicitud_acceso a
                                      left outer join usuario u on a.id_usuario = u.id_usuario
									  LEFT OUTER JOIN usuario_rango_edad b on u.id_rango_edad = b.id_rango_edad 
								where a.id_entidad > 0
									$condicion 
								GROUP by  b.rango_edad";	
								
						$sql_suma = "Select COUNT(*) as cantidad
					  				 from sgs_solicitud_acceso a
                                      left outer join usuario u on a.id_usuario = u.id_usuario
									  LEFT OUTER JOIN usuario_rango_edad b on u.id_rango_edad = b.id_rango_edad   
								where a.id_entidad > 0
									$condicion ";
							//echo "<br>$sql_suma";
							$result_suma= mysql_query($sql_suma)
							or die ("<br>ERROR $php <br>$query<br><br><span style='color:#FF0000'><b>".mysql_error()."</b></span>");
						
								
						break;
					case 3:
						$sql = " select b.sexo,
									   COUNT(*) as cantidad
								from sgs_solicitud_acceso a
                                      left outer join usuario u on a.id_usuario = u.id_usuario
									  LEFT OUTER JOIN usuario_sexo b on u.id_sexo = b.id_sexo 
								where a.id_entidad > 0
									$condicion 
								GROUP by b.sexo";	
								
						$sql_suma = "Select COUNT(*) as cantidad
					  				 from sgs_solicitud_acceso a
                                      left outer join usuario u on a.id_usuario = u.id_usuario
									  LEFT OUTER JOIN usuario_sexo b on u.id_sexo = b.id_sexo 
								where a.id_entidad > 0
									$condicion ";
							//echo "<br>$sql_suma";
						$result_suma= mysql_query($sql_suma)
							or die ("<br>ERROR $php <br>$query<br><br><span style='color:#FF0000'><b>".mysql_error()."</b></span>");
						break;
					case 4:
						$sql = "  select b.nacionalidad,
									   COUNT(*) as cantidad
								from sgs_solicitud_acceso a
                                      left outer join usuario u on a.id_usuario = u.id_usuario
									  LEFT OUTER JOIN usuario_nacionalidad b on u.id_nacionalidad = b.id_nacionalidad 
									 where a.id_entidad > 0
									 	$condicion 
								GROUP by b.nacionalidad";	
								
							$sql_suma = "Select COUNT(*) as cantidad
					  				 from sgs_solicitud_acceso a
                                      left outer join usuario u on a.id_usuario = u.id_usuario
									  LEFT OUTER JOIN usuario_sexo b on u.id_sexo = b.id_sexo 
								where a.id_entidad > 0
									$condicion ";
							//echo "<br>$sql_suma";
						$result_suma= mysql_query($sql_suma)
							or die ("<br>ERROR $php <br>$query<br><br><span style='color:#FF0000'><b>".mysql_error()."</b></span>");	
							
						break;
						
					case 5:
						$sql = " select b.nivel_educacional,
									   COUNT(*) as cantidad
								from sgs_solicitud_acceso a
                                      left outer join usuario u on a.id_usuario = u.id_usuario
									  LEFT OUTER JOIN usuario_nivel_educacional b on u.id_nivel_educacional = b.id_nivel_educacional
								where a.id_entidad > 0
									$condicion 
								GROUP by b.nivel_educacional";	
								
								
						$sql_suma = "Select COUNT(*) as cantidad
					  				 from sgs_solicitud_acceso a
                                      left outer join usuario u on a.id_usuario = u.id_usuario
									  LEFT OUTER JOIN usuario_nivel_educacional b on u.id_nivel_educacional = b.id_nivel_educacional
								where a.id_entidad > 0
									$condicion ";
							//echo "<br>$sql_suma";
						$result_suma= mysql_query($sql_suma)
							or die ("<br>ERROR $php <br>$query<br><br><span style='color:#FF0000'><b>".mysql_error()."</b></span>");	
						break;
					case 6:
						$sql = "select b.organizacion,
									   COUNT(*) as cantidad
								from sgs_solicitud_acceso a
                                      left outer join usuario u on a.id_usuario = u.id_usuario
									  LEFT OUTER JOIN usuario_organizacion b on u.id_organizacion = b.id_organizacion 
								where a.id_entidad > 0
									$condicion 
								GROUP by b.organizacion";	
								
						$sql_suma = "Select COUNT(*) as cantidad
					  				from sgs_solicitud_acceso a
                                      left outer join usuario u on a.id_usuario = u.id_usuario
									  LEFT OUTER JOIN usuario_organizacion b on u.id_organizacion = b.id_organizacion 
								where a.id_entidad > 0
									$condicion ";
							//echo "<br>$sql_suma";
						$result_suma= mysql_query($sql_suma)
							or die ("<br>ERROR $php <br>$query<br><br><span style='color:#FF0000'><b>".mysql_error()."</b></span>");	
						break;
					case 7:
						$sql = "select b.ocupacion,
									   COUNT(*) as cantidad
								from sgs_solicitud_acceso a
                                      left outer join usuario u on a.id_usuario = u.id_usuario
									  LEFT OUTER JOIN usuario_ocupacion b on u.id_ocupacion = b.id_usuario_ocupacion 
								where a.id_entidad > 0
									 	$condicion 
								GROUP by b.ocupacion";	
								
								$sql_suma = "Select COUNT(*) as cantidad
					  				 from sgs_solicitud_acceso a
                                      left outer join usuario u on a.id_usuario = u.id_usuario
									  LEFT OUTER JOIN usuario_ocupacion b on u.id_ocupacion = b.id_usuario_ocupacion 
								where a.id_entidad > 0
									$condicion ";
							//echo "<br>$sql_suma";
						$result_suma= mysql_query($sql_suma)
							or die ("<br>ERROR $php <br>$query<br><br><span style='color:#FF0000'><b>".mysql_error()."</b></span>");	
						break;
					case 8:
						$sql = "Select tipo_solicitud,count(SUBSTRING(folio,3,CHAR_LENGTH(folio)-2))
								from sgs_solicitud_acceso a
									 left outer join sgs_tipo_solicitud b on SUBSTRING(folio,3,CHAR_LENGTH(folio)-2) like CONCAT('%',b.codigo,'%') and a.id_entidad > 0
								WHERE 1 $condicion 
								group by b.codigo";	
								
						$sql_suma = "Select count(SUBSTRING(folio,3,CHAR_LENGTH(folio)-2))
								from sgs_solicitud_acceso a
									 left outer join sgs_tipo_solicitud b on SUBSTRING(folio,3,CHAR_LENGTH(folio)-2) like CONCAT('%',b.codigo,'%') and a.id_entidad > 0
									$condicion ";
							//echo "<br>$sql_suma";
						$result_suma= mysql_query($sql_suma)
							or die ("<br>ERROR $php <br>$query<br><br><span style='color:#FF0000'><b>".mysql_error()."</b></span>");			
								
						break;
						
						
				}
				
				//echo "<br> sql:".$sql;
				if ($sql!=""){
				
					$result= mysql_query($sql)
					or die ("<br>ERROR $php <br>$query<br><br><span style='color:#FF0000'><b>".mysql_error()."</b></span>");
					//echo"<br>total_solicitudes:".mysql_num_rows($result);
				}
			

				
					
			 	list($total_solicitudes )=  mysql_fetch_row($result_suma);
				
				//echo"<br>total_solicitudes:".$total_solicitudes;
				$lineas = " ";	
				$aLabel = array();
				$aValor = array();	
				$i=0;
				
				$estilo = "primerRegistro";
				while (list($registro_factor,$cantidad_factor) = mysql_fetch_row($result)){
						if($registro_factor=="" or $registro_factor=="NULL"){
							$registro_factor = "No especifica";
						}
						$registro_factor = $registro_factor;
						$aLabel[$i] = $registro_factor;
						$linea = html_template('reporte_registro_distribucion_solicitudes');	
						$linea = cms_replace("#REGISTRO_ITEM#",$registro_factor,$linea);
						$linea = cms_replace("#CANTIDAD#",formateaEnteros($cantidad_factor),$linea);
						$porcentaje_factor = round( (($cantidad_factor/$total_solicitudes)*100),2) ;
						$aValor[$i] = $porcentaje_factor;
						$linea = cms_replace("#PORCENTAJE#","$porcentaje_factor",$linea);
						$linea = cms_replace("#ESTILO#","",$linea);
						$lineas = $lineas . $linea;
						$estilo = poneEstilo($estilo);
						//echo "<br>label:".$aLabel[$i] ." &nbsp;&nbsp;&nbsp;&nbsp;aValor:".$aValor[$i] ;
						$porcentaje_factor = str_replace(".",",",$porcentaje_factor);
						if ($id_factor_seleccionado==1){
							$registro_factor = utf8_decode($registro_factor);
						}
						$tabla_csv .= acentos_inverso($registro_factor).$csv_separador.formateaEnteros($cantidad_factor).$csv_separador.$porcentaje_factor.$csv_fin_linea;
						$i++;	
						//echo "<br>entra";
				 }
				 if (mysql_num_rows($result)==0){
					 $lineas = html_template('reporte_registro_distribucion_solicitudes_vacio');
				 }
				 $resultado_reporte = cms_replace("#REGISTROS#","$lineas",$resultado_reporte);
				 

				
			 break;
				   
	 }
	 
	 $cabecera_csv = acentos_inverso($item_tabla).$csv_separador."Cantidad".$csv_separador." % ".$csv_fin_linea;
	 $_SESSION['tabla_csv'] =  $cabecera_csv.$tabla_csv;
	

	$resultado_reporte = cms_replace("#REGISTROS_MUESTRA#","$lineas",$resultado_reporte);
	$resultado_reporte = cms_replace("#TOTAL_GENERAL#",formateaEnteros($total_solicitudes),$resultado_reporte);
	
	$resultado_reporte = cms_replace("#INFORMACION#","$informacion",$resultado_reporte);
	


/******************PARA EL GRAFICO********************/

	include("sgs/estadisticas/FusionCharts.php");
	$xAxisName = "$item_tabla";
	
	if (($id_factor==3)or($id_factor==4)or($id_factor==6)or($id_factor==8)) {
		$nombreGrafico = "single_series_pie_2d";
		
		$cuerpo = armaCuerpoGrafico($aLabel,$aValor,$aSeries,$nombreGrafico);
		
		$strXML = "<chart palette='1' caption='$titulo_informe'  showBorder='0' shownames='1'  showPercentageValues='1' decimals='0' decimals='2' paletteColors='006CB7,DB4144,D7D6CA,848484,585858,2E2E2E'>";
		$strXML .= $cuerpo;
		$strXML .= "</chart>";
		
		$grafico =  renderChartHTML("sgs/estadisticas/Charts/Pie2D.swf", "", $strXML, "myNext", 740, 400, false);
	}else{
		
		$nombreGrafico = "single_series_column_3d";
		$alto = count($aValor) * 20 + 200;
		
		$cuerpo = armaCuerpoGrafico($aLabel,$aValor,$aSeries,$nombreGrafico);
		//echo "<br>cuerpo:".$cuerpo;
	
		$strXML .= "<chart caption='$titulo_informe' xAxisName='$xAxisName'  yAxisName=' Porcentaje Solicitudes' showShadow='1' decimals='2' showBorder='0' legendBorderAlpha='0' slantLabels='1' labelDisplay='ROTATE' overlapColumns='2' labelDisplay='WRAP' paletteColors='006CB7,DB4144,D7D6CA,848484,585858,2E2E2E' >";
		$strXML .= $cuerpo;
		//echo"<br>cuerpo:".$cuerpo;				

		$strXML .= "</chart>";
		
		$alto = 100 + $alto;		
		$grafico =  renderChartHTML("sgs/estadisticas/Charts/Column3D.swf", "", $strXML, "myNext", 750, $alto, false);

	}

function armaCuerpoGrafico($aLabel,$aValor,$aSeries,$nombreGrafico)
{
	$cuerpo = "";
		if (count($aValor)>0){
	
	
			switch ($nombreGrafico){
			
				case "single_series_bar_2d":
				
						for($i=0;$i<count($aLabel);$i++){
							$cuerpo = $cuerpo."<set label='".$aLabel[$i]."' value='".$aValor[$i]."' />";
						}
						break;
			
				case "single_series_column_3d":
				
						for($i=0;$i<count($aLabel);$i++){
							$cuerpo = $cuerpo."<set label='".$aLabel[$i]."' value='".$aValor[$i]."'  />";
						}
						break;
				
				case "single_series_pie_2d":
						
						//encontrar el valor mayor
						$mayor = 0;
						for($i=0;$i<count($aValor);$i++){
							
							if ($aValor[$i] > $mayor){
								$mayor = $aValor[$i];
							}
						}
						
						for($i=0;$i<count($aLabel);$i++){
							if ($aValor[$i] == $mayor){
								
								$isSliced = " isSliced='1'";
							}else{
								$isSliced = "";
							}
							
							$cuerpo = $cuerpo."<set label='".$aLabel[$i]."' value='".$aValor[$i]."' ".$isSliced." />";
						}
						break;		
						
				case "stacked_column_3d":
					//arma las categorias
					$cuerpo = "<categories>";
					for($i=0;$i<count($aLabel);$i++){
						$cuerpo = $cuerpo."<category label='".$aLabel[$i]."' /> ";
					}
					$cuerpo = $cuerpo ."</categories>";
					//arma las series
					$cantidad_arreglos = count($aSeries);
					//echo "<BR>EN FUNCION:";
					//echo "<br>cantidad arreglos:".$cantidad_arreglos;
					$aMeses = $aSeries[0];
					for($j=0;$j<count($aMeses);$j++){
						$cuerpo = $cuerpo . "<dataset seriesName='".$aMeses[$j]."' showValues='0'>";
						$k= $j+1;
						$datos = $aSeries[$k];
						$aDatos = split(",",$datos);
						//echo "<br>en datos ".count($aDatos);
						for($m=0;$m<count($aDatos);$m++){
						//	echo "<br>cantidad datos arreglo  $k:".count($aDatos);
							$cuerpo = $cuerpo . "<set value='".$aDatos[$m]."' />"; 
						}			
						$cuerpo = $cuerpo . "</dataset>";
					}
					break;
			}
	}
	return $cuerpo;
}

	
	/**************************************/
	
	 if (mysql_num_rows($result)==0){
		 echo "entra";
		 $grafico="";
		 $resultado_reporte = str_replace("<img id=\"csv\" width=\"16\" height=\"16\" border=\"0\" alt=\"Exportar a CSV\" src=\"images/excel_min.jpg\">","",$resultado_reporte);
	 }
	$resultado_reporte = cms_replace("#GRAFICO#",$grafico,$resultado_reporte);
	$contenido = $resultado_reporte;
	
	
	function formateaEnteros($numero){
		$numero = number_format($numero,0,',', '.');
		$numero = str_replace (",",".",$numero);
		return $numero;
	}
	
	function poneEstilo($estilo){
	if ($estilo=="primerRegistro"){
		$estilo = "segundoRegistro";
	}else{
		$estilo = "primerRegistro";
	}
	return $estilo;
}
	function formateaPorcentaje($numero){
		$numero = str_replace (".",",",$numero);
		return $numero;
	}
	 
?>