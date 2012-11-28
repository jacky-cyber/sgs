<?php

	$aLabel = array();
	$aValor = array();// en la matriz de valores guardar para cada servicio los datos asociados a las lecturas
	
	$aSeries = array();
	$glosa_registro = "";
	$csv_tabla = "Entidad".$csv_separador."Ene".$csv_separador."Feb".$csv_separador."Mar".$csv_separador."Abr".$csv_separador."May".$csv_separador."Jun".$csv_separador."Jul".$csv_separador."Ago".$csv_separador."Sep".$csv_separador."Oct".$csv_separador."Nov".$csv_separador."Dic".$csv_separador."Total".$csv_fin_linea;
	 
	 $grilla = array();
	 $grilla_csv = array();
	 for($fila = 0;$fila < $cantidad_registros;$fila++){
	 	 for($columna = 0;$columna < 14;$columna++){
			$grilla[$fila][$columna]= "0";
			$grilla_csv[$fila][$columna]= "0";
		 }
	 }
	 //asignacion de valores a la matriz
if (mysql_num_rows($result)==0){
					$informacion = html_template('contenedor_resultado_anual_reporte_vacio');	
		 		 	$lineas = html_template('registro_tabla_vacio_generico');
					$lineas = str_replace ("#COLSPAN#","14",$lineas);
					$lineas = str_replace ("#MENSAJE#","No se encontraron solicitudes que cumplan con los criterios de b&uacute;squeda",$lineas);
					
}else{
	 
	 $i = -1;
	 while (list($id,$glosa,$mes,$cantidad) = mysql_fetch_row($result)){
			//arma la salida
			$id = trim($id);
			//echo "<br> i= ".$i."  mes=".$mes."    valor=".$cantidad;
			if ($glosa_registro!= $glosa){
				$i++;
				$glosa_registro = $glosa;
				$cod_identidad[$i] = $id;
				
				if($nivel=="Servicio"){
					$link = "<a href='index.php?accion=$accion&act=$act&nivel=Entidad&id_entidad=$id&periodo=$periodo&id_pais=$id_pais&id_region=$id_region&id_comuna=$id_comuna&id_categoria=$id_categoria'>$glosa_registro</a>";
					
				}else{
					$link = $glosa_registro;
				}
				$grilla[$i][0]= $link;
				$aLabel[$i] = $glosa_registro;
				
				//echo "<br>es diferente: $entidad_padre_registro<br>";
			}
				
			if($nivel=="Servicio"){
				$grilla[$i][$mes]=$cantidad;
			}else{
				$link = $cantidad;// "<a href='index.php?accion=$accion&act=1&nivel=Solicitud&id_entidad_padre=$id_entidad_padre&id_entidad=$id&periodo=$periodo&mes=$mes'>$cantidad</a>";
				$grilla[$i][$mes]=$link;
				
			}
			$grilla_csv[$i][$mes]=$cantidad;
	 }
	 
	 //suma_vertical
	 $total_fila = 0 ;
	 $aServicio = array();
	 for($fila = 0;$fila < $cantidad_registros;$fila++){
		$registro = html_template('contenedor_resultado_anual_registro_reporte');
		//echo "registro = ".$registro;
		$total_columna = 0;
	 	 for($columna = 0;$columna < 14;$columna++){
		 	if ($columna==0){
				$aServicio[$fila] = $grilla[$fila][$columna];
			}else{
				$aServicio[$fila] = $aServicio[$fila].",".$grilla[$fila][$columna];
			}
			$valor = $grilla[$fila][$columna];
			//echo "<br>columna: $columna   valor: ".$aServicio[$fila]."<br>";
			$valor_csv = $grilla_csv[$fila][$columna];
			if ($columna==0){
				$entidad_excel =  $grilla[$fila][$columna];
			}
			if ($columna==13){
				
				$registro = cms_replace("#CAMPO_".$columna."#",$total_columna,$registro);
				$grilla[$fila][$columna]= $total_columna;
				$indice = count($aValor);
				$aValor[$indice]=$total_columna;
				$csv_tabla = $csv_tabla.$total_columna.$csv_fin_linea;
			}else{
			
				$total_columna = $total_columna + $valor;
				if ($nivel!="Servicio"){
					if (($columna >0) && ($valor>0)){
						//guardar el valor para la serie
						$valor = "<a href='index.php?accion=$accion&act=$act&nivel=Solicitud&id_entidad_padre=$id_entidad_padre&id_entidad=$cod_identidad[$fila]&periodo=$periodo&mes=$columna&id_responsable=$id_responsable&id_estado_solicitud=$id_estado_solicitud&id_pais=$id_pais&id_region=$id_region&id_comuna=$id_comuna&id_categoria=$id_categoria'>$valor</a>";	
					}
					
					
				}
				$registro = cms_replace("#CAMPO_".$columna."#",$valor,$registro);
				if ($columna==0){
					$csv_tabla = $csv_tabla.acentos_inverso(utf8_decode($entidad_excel)).$csv_separador;
				}else{
					$csv_tabla = $csv_tabla.$valor_csv.$csv_separador;
				}
				
				
			}
			
			$varSuma = "suma_col_".$columna;
			$$varSuma = $$varSuma + $grilla[$fila][$columna];
			
		 }
		 $lineas = $lineas . $registro;
		
	 }
	 //echo $lineas;
	 
	//suma_vertical
	//serie para el grafico
	$aMiniSeries_0 = array();
	$aMiniSeries_0[0] = "Ene";
	$aMiniSeries_0[1] = "Feb";
	$aMiniSeries_0[2] = "Mar";
	$aMiniSeries_0[3] = "Abr";
	$aMiniSeries_0[4] = "May";
	$aMiniSeries_0[5] = "Jun";
	$aMiniSeries_0[6] = "Jul";
	$aMiniSeries_0[7] = "Ago";
	$aMiniSeries_0[8] = "Sep";
	$aMiniSeries_0[9] = "Oct";
	$aMiniSeries_0[10] = "Nov";
	$aMiniSeries_0[11] = "Dic";
	//fin serie grafico

	 
		
	$informacion = html_template('contenedor_resultado_anual_reporte');
	$csv_tabla = $csv_tabla."Total".$csv_separador;
	for($columna = 1;$columna < 14;$columna++){
		$total_columna = 0;
		for ($fila = 0;$fila < $cantidad_registros;$fila++){
			
			$valor = $grilla[$fila][$columna];
			if ($nivel!="Servicio")
			{
				/*echo "<br>valor:".$valor;
				$aDato = split("**",$valor);
				echo "<BR> DATO 0: ".$aDato[0];*/
				$valor = $aDato[1];
			}
			//$total_columna = $total_columna + $valor;
			$varSuma = "suma_col_".$columna;
			$total_columna = $$varSuma;
			
			//echo "<BR><br> fila=$fila    columan=$columna   &nbsp;&nbsp;&nbsp;&nbsp;   valor= $valor       suma = $total_columna";
		}
		
		
		$informacion =  str_replace("#TOTAL_".$columna."#",$total_columna,$informacion);
		$csv_tabla = $csv_tabla.$total_columna.$csv_separador;
	}
	
	for($i = 0;$i < 14;$i++){
		$nombreArreglo = "aMiniSeries_".$i;
		//echo "<br>datos:".$$nombreArreglo;
		$aSeries[$i] = $$nombreArreglo;
	}
	
}	
	$informacion =  str_replace("#CATEGORIA#","$nivel",$informacion);
	$informacion = cms_replace("#REGISTROS#","$lineas",$informacion);
	$informacion =  str_replace("class=\"derecha\"","",$informacion);
	
	session_register_cms('tabla_mail');
	$_SESSION['tabla_mail'] = $informacion;
	$_SESSION['tabla_csv'] = $csv_tabla;
	//crear la variable que va por mail
	


?>