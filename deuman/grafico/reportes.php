<?php

include("sgs/estadisticas/FusionCharts.php");

set_time_limit(0);
//captura de parametros

$nivel = $_GET['nivel'];
if($nivel==""){
	$nivel="Servicio";
}


$id_entidad_padre = "";
$id_entidad = "";
$periodo = "";
$mes = "";
$folio = "";
$paginacion =  "";
$inicio =  "";
$fin =  "";
$csv_separador = ";";
$csv_fin_linea = "
";



//echo "<br>post:".$_POST['id_entidad_padre'];
if ($_POST['id_entidad_padre']!=""){
	$id_entidad_padre = $_POST['id_entidad_padre'];
}else{
	if ($_GET['id_entidad_padre']!=""){
		$id_entidad_padre = $_GET['id_entidad_padre'];
	}
}

/*if (($_POST['id_entidad_padre']=="")&&($_GET['id_entidad_padre']!="")){
	$id_entidad_padre = $_GET['id_entidad_padre'];
}*/

//echo "<br>id_entidad_padre:".$id_entidad_padre;


if ($_POST['id_entidad']!=""){
	$id_entidad = $_POST['id_entidad'];
	
}
if (($_POST['id_entidad']=="")&&($_GET['id_entidad']!="")){
	$id_entidad = $_GET['id_entidad'];
}



  
  
if ($_POST['id_estado_solicitud']!=""){
	$id_estado_solicitud = $_POST['id_estado_solicitud'];
}
if (($_POST['id_estado_solicitud']=="")&&($_GET['id_estado_solicitud']!="")){
	$id_estado_solicitud = $_GET['id_estado_solicitud'];
}
 
  
if ($_POST['periodo']!=""){
	$periodo = $_POST['periodo'];
}
if (($_POST['periodo']=="")&&($_GET['periodo']!="")){
	$periodo = $_GET['periodo'];
}


if ($_POST['mes']!=""){
	$mes = $_POST['mes'];
}
if (($_POST['mes']=="") && ($_GET['mes']!="")){
	$mes = $_GET['mes'];
}

if ($_POST['inicio']!=""){
	$inicio = $_POST['inicio'];
}
if (($_POST['inicio']=="") && ($_GET['inicio']!="")){
	$inicio = $_GET['inicio'];
}


if ($_POST['fin']!=""){
	$fin = $_POST['fin'];
}
if (($_POST['fin']=="") && ($_GET['fin']!="")){
	$fin = $_GET['fin'];
}



if ($_POST['folio']!=""){
	$folio = $_POST['folio'];
}
if (($_POST['folio']=="")&&($_GET['folio']!="")){
	$folio = $_GET['folio'];
}

if ($_POST['id_factor']!=""){
	$id_factor = $_POST['id_factor'];
}
if (($_POST['id_factor']=="")&&($_GET['id_factor']!="")){
	$id_factor = $_GET['id_factor'];
}



if ($_POST['dias']!=""){
	$dias = $_POST['dias'];
}
if (($_POST['folio']=="")&&($_GET['dias']!="")){
	$dias = $_GET['dias'];
}
if ($dias ==""){
	$dias = 5;
}


if ($_POST['id_responsable']!=""){
	$id_responsable = $_POST['id_responsable'];
}
if (($_POST['id_responsable']=="") && ($_GET['id_responsable']!="")){
	$id_responsable = $_GET['id_responsable'];
}

//echo "<br>id_responsable:".$id_responsable;
//crear los filtros

//echo "<br>entidad: ".$id_entidad;
if ($act==12){
	if ($mes==""){
		$mes = date('m');
	}
}

include  ("sgs/reportes/reportes_crea_filtros.php");



if($id_entidad_padre!=""){
	$condicion = $condicion. " AND a.id_entidad_padre = $id_entidad_padre";
}

if ($id_entidad !=""){
	$condicion = $condicion. " AND a.id_entidad = $id_entidad";
}

if (($act!=6) and ($act!=12)){
	
	if ($mes!=""){
		$condicion = $condicion. " and MONTH(fecha_inicio)= $mes";
	}
	if ($periodo!=""){
		$condicion = $condicion. " and YEAR(fecha_inicio)= $periodo";
	}
}


if ($id_estado_solicitud !=""){
	$condicion = $condicion. " and a.id_sub_estado_solicitud = $id_estado_solicitud ";
}



$mensaje = "";

switch ($act) {
     case 1:
         include ("sgs/reportes/reportes_solicitudes_ingresadas.php");
		 break;
		 
	 case 2:
         include ("sgs/reportes/reportes_solicitudes_ingresos_sin_asignar.php");
         break;

	 case 3:
         include ("sgs/reportes/reportes_solicitudes_analisis_tipo.php");
         break;
		 
	case 4:
         include ("sgs/reportes/reportes_solicitudes_denegadas_causal.php");
         break;
		 
	case 5:
         include ("sgs/reportes/reportes_solicitudes_proximas_vencer.php");
         break;
		 
	case 6:
         include ("sgs/reportes/reportes_solicitudes_vencidas.php");
         break;
		 
	case 7:
         include ("sgs/reportes/reportes_solicitudes_respondidas_secreto.php");
         break;
		 
	case 8:
         include ("sgs/reportes/reportes_solicitudes_respondidas_no_secreto.php");
         break;
		 
	case 9:
         include ("sgs/reportes/reportes_solicitudes_derivadas.php");
         break;
		 
	case 10:
         include ("sgs/reportes/reportes_solicitudes_impagas.php");
         break;
		 
	case 11:
		 include ("sgs/reportes/reporte_observatorio.php");
         break;
		 
	case 12:
		 include ("sgs/reportes/reportes_promedio_respuesta.php");
         break;
	case 13:
		 include ("sgs/reportes/reportes_avance.php");
         break;
	case 14:
		 include ("sgs/reportes/reportes_distribucion.php");
         break;
	case 15:
		 include ("sgs/reportes/reporte_distribucion_estado.php");
         break;
		 
   	default:
	   $def ="ok";
		$contenido = html_template('contenedor_menu_reportes');	
		
		$contenido = str_replace("#ACCION#","$accion",$contenido);
		$contenido = str_replace("#RESULTADO_REPORTE#","",$contenido);
		       
 }
 
if ($_POST['genera']!=""){

set_time_limit(0); 
$id = 208;//$_GET['id'];

/*
$sql = "delete from sgs_solicitud_acceso"; cms_query($query); 
*/

 $query= "SELECT a.url,a.id_entidad
		 FROM  sgs_llamadas_xml a, 
			  sgs_entidades b,
			  sgs_entidad_padre c
		 where a.esSatelite = 1				
				and a.id_entidad = b.id_entidad
			  and b.id_entidad_padre = c.id_entidad_padre
			 
		 ORDER BY a.id_entidad ";
$result_registros= cms_query($query)or die("<br>la consulta fallo<br>$sql<br>".mysql_error());
$pagina= "xmlg.php?id=".$id;
$t=1;
$url_sin_xml= "";
$url_ok = "";
$url_mala = "";
$url_problema = "";

//insertar registro de la lectura
echo "<br>";
echo $sql = "insert into sgs_lectura_solicitudes (fecha) values ('".date ('Y-m-d H:i:s')."')"; cms_query($sql) or die ("<br>Error en la inserci&oacute;n de la lec<BR>".$sql."<br>".mysql_error());

while (list($url,$id_entidad)=mysql_fetch_row($result_registros)){

	$aux = explode("index.php", $url);
	$url = $aux[0];
	$url = $url .$pagina;
	$url_code =  "<br>$t )&nbsp;&nbsp;id_entidad: ".$id_entidad."&nbsp;&nbsp;<a href=\"$url\" target=\"_blank\">".$url."</a>";

	$estado = Validar_URL($url);
	//echo "<br>".$url_code;
	//echo "<br>&nbsp;&nbsp;&nbsp;estado:".$estado;
	
		
	if ($estado!="404"){	
				
				$fp=fopen($url,"r");
				 
				$str_xml = "";
				while ($linea=fgets($fp,1024))
				{
				   $str_xml = $str_xml.$linea;		
				}
				
				$str_xml = str_replace("'","\'",$str_xml);
				
				//echo "<br>".$str_xml."<br><br>";
				
				
				$data = $str_xml;
				$data = acentos_inverso($data);
				
				$data = cambio_texto($data);
					
				$str_xml =  acentos_inverso($str_xml);
				$str_xml = cambio_texto($str_xml);
				
				if ($str_xml == ""){
					//echo "<br> es falso";
					    $url_problema = $url_problema .$url_code;
				}else{	
						//echo "<br>entra: $url_code";
						$url_ok = $url_ok .$url_code;
						$xml = simplexml_load_string($str_xml);
						$query= "SELECT tabla  
						   FROM  auto_admin
						   WHERE id_auto_admin ='$id'";
						$result= cms_query($query)or die ("ERROR $php <br>$query");
						list($tabla) = mysql_fetch_row($result);
						 
						
						
						//echo "tabla: ".$tabla."<br><br>";
						 
						$query= "SELECT campo,txt_xml,pk    
						   FROM  auto_admin_campo
						   WHERE id_auto_admin ='$id' and xml=1";
						$result= cms_query($query)or die ("ERROR $php <br>$query");
						
						$array_campos = array();
						$array_pk = array();
						$i = 0;
						$j=0;
						$insert_str = "Insert into $tabla (";
						$campo_insert = "";
						while (list($campo,$txt_xml,$pk) = mysql_fetch_row($result)){
							
							if($txt_xml!=""){
								$array_campos[$i] = $txt_xml;
								if($pk==1){
									$array_pk[$j] = $txt_xml;
									$j++;
								}
							}else{
								$array_campos[$i] = $campo;
								if($pk==1){
									$array_pk[$j] = $campo;
									$j++;
								}
							}
							if ($campo_insert==""){
								$campo_insert = $array_campos[$i];
							}else{
								$campo_insert = $campo_insert.",".$array_campos[$i];
							}
							
							//$msj = utf8_decode($msj);
							
							
							$i++;
								
					   }
						$insert_str  = $insert_str.$campo_insert.") values (";
						
						$valor_insert = "";
						foreach ($xml->$tabla as $registro){
							$valor_insert = "";
							foreach($array_campos as $columna){
								$msj = $registro->$columna ;
								if ($columna=="folio"){
									$condicion = " WHERE folio = '$msj'";
								}
								//echo $columna ." = ".$msj."<br>";
								if ($valor_insert==""){
									$valor_insert = $msj;
								}else{
									$valor_insert = $valor_insert.",'".$msj."'";
								}
								
							}
							
							$sql = "Select folio from sgs_solicitud_acceso ".$condicion ;
							//echo "<br>".$sql;
							$result = cms_query($sql)or die("Error:<br>".$sql);
							//echo "<br>cantidad :".mysql_num_rows($result);
							if (mysql_num_rows($result) == 0){
								$comando_insert_str  = $insert_str.$valor_insert.");";
								//echo "<br>".$comando_insert_str; cms_query($comando_insert_str)or die ("Error <br>$comando_insert_str ");
							}//programar la actualizacion de estado
							
					//echo "<br>".$comando_insert_str;
					//echo "<br><br>";

			 		  }
				}
				
	 }
	 if($estado==""){
	 	$url_sin_xml = $url_sin_xml .$url_code;
	 }
	 if($estado=="404"){
	 	$url_mala = $url_mala .$url_code;
	 }
	 $t++;

}

$mensaje = "Lectura realizada";


	
}
 		
		
		//sacar el html del contenido
		
		
		
		
		/*if ($axj==1){
		
				$resultado_reporte="<html xmlns='http://www.w3.org/1999/xhtml'>
		<head>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
		<title>Reportes</title>
		<link rel=\"stylesheet\" type=\"text/css\" href=\"images/sitio/sgs/css/observatorio.css\">
		
		
		</head>
		
		<body><form id=\"form1\" name=\"form1\" method=\"post\" action=\"\">
			".$resultado_reporte.'</form></body></html>';
			
		}*/
		$sql = "Select fecha from sgs_lectura_solicitudes order by id desc";
		$result = cms_query($sql) or die ("Error en la seleccci&oacute;n");
		list($fecha_lectura) = mysql_fetch_row($result); 
		
		$strXML  = "";
		

		switch($nivel){
			case "Servicio":
				$xAxisName = "Entidades";
				if ($act!=12){
					$nombreGrafico = "single_series_pie_2d";
					
					$cuerpo = armaCuerpoGrafico($aLabel,$aValor,$aSeries,$nombreGrafico);
					
					$strXML = "<chart palette='2' caption='$titulo_informe' shownames='1' showvalues='0'  decimals='0'>";
					$strXML .= $cuerpo;
					$strXML .= "</chart>";
					
					$grafico =  renderChartHTML("sgs/estadisticas/Charts/Pie2D.swf", "", $strXML, "myNext", 610, 400, false);
				}else{
					
					$nombreGrafico = "single_series_bar_2d";
					$alto = count($aValor) * 20 + 200;
					
					$cuerpo = armaCuerpoGrafico($aLabel,$aValor,$aSeries,$nombreGrafico);
					//echo "<br>cuerpo:".$cuerpo;
				
					$strXML .= "<chart caption='$titulo_informe' xAxisName='$xAxisName' yAxisName='Cantidad Solicitudes' showValues='0'  formatNumberScale='0' showBorder='1' legendBorderAlpha='0' slantLabels='1' labelDisplay='ROTATE' overlapColumns='2' labelDisplay='WRAP' >";
					$strXML .= $cuerpo;
					/*$strXML .=" <styles>
						<definition>
							<style name='myLabelsFont' type='font' font='Verdana' size='9' color='666666' bold='0' underline='0'/>
						</definition>
						<application>
							<apply toObject='DataLabels' styles='myLabelsFont' />
						</application>
					</styles>";*/
					$strXML .= "<styles>
							<definition>
								<style name='myBevel' type='bevel' distance='3'/>
								<style name='myShadow' type='shadow' angle='45' distance='3'/>
							</definition>
							<application>
								<apply toObject='DATAPLOT' styles='myBevel, myShadow' /> 
							</application>
						</styles>";
	
					$strXML .= "</chart>";
					
					$grafico =  renderChartHTML("sgs/estadisticas/Charts/Bar2D.swf", "", $strXML, "myNext", 600, $alto, false);
				}
				
				break;
			case "Entidad":
				$xAxisName = "Servicios";
				//echo "<br>act:".$act;
				if ($act==5){
					$nombreGrafico = "single_series_pie_2d";
					
					$cuerpo = armaCuerpoGrafico($aLabel,$aValor,$aSeries,$nombreGrafico);
										
					$strXML = "<chart palette='2' caption='$titulo_informe' shownames='1' showvalues='0'  decimals='0'>";
					$strXML .= $cuerpo;
					$strXML .= "</chart>";
					
					$grafico =  renderChartHTML("sgs/estadisticas/Charts/Pie2D.swf", "", $strXML, "myNext", 610, 400, false);
					
				}else{
					$nombreGrafico = "single_series_bar_2d";
					$alto = count($aValor) * 20 + 200;
					
					$cuerpo = armaCuerpoGrafico($aLabel,$aValor,$aSeries,$nombreGrafico);
				
					$strXML .= "<chart caption='$titulo_informe' xAxisName='$xAxisName' yAxisName='Cantidad Solicitudes' showValues='0'  formatNumberScale='0' showBorder='1' legendBorderAlpha='0' slantLabels='1' labelDisplay='ROTATE' overlapColumns='2' labelDisplay='WRAP' >";
					$strXML .= $cuerpo;
					/*$strXML .=" <styles>
						<definition>
							<style name='myLabelsFont' type='font' font='Verdana' size='9' color='666666' bold='0' underline='0'/>
						</definition>
						<application>
							<apply toObject='DataLabels' styles='myLabelsFont' />
						</application>
					</styles>";*/
					$strXML .= "<styles>
							<definition>
								<style name='myBevel' type='bevel' distance='3'/>
								<style name='myShadow' type='shadow' angle='45' distance='3'/>
							</definition>
							<application>
								<apply toObject='DATAPLOT' styles='myBevel, myShadow' /> 
							</application>
						</styles>";
	
					$strXML .= "</chart>";
					
					$grafico =  renderChartHTML("sgs/estadisticas/Charts/Bar2D.swf", "", $strXML, "myNext", 600, $alto, false);
				}
				break;
			case "Entidad2":
				$xAxisName = "Mes/a&ntilde;o";
				$yAxisName = "D&iacute;as";
				echo "<br>act:".$act;
				if ($act==5){
					$nombreGrafico = "single_series_pie_2d";
					
					$cuerpo = armaCuerpoGrafico($aLabel,$aValor,$aSeries,$nombreGrafico);
										
					$strXML = "<chart palette='2' caption='$titulo_informe' shownames='1' showvalues='0'  decimals='0'>";
					$strXML .= $cuerpo;
					$strXML .= "</chart>";
					
					$grafico =  renderChartHTML("sgs/estadisticas/Charts/Pie2D.swf", "", $strXML, "myNext", 610, 400, false);
					
				}else{
					$nombreGrafico = "single_series_bar_2d";
					$alto = count($aValor) * 20 + 200;
					
					$cuerpo = armaCuerpoGrafico($aLabel,$aValor,$aSeries,$nombreGrafico);
				
					$strXML .= "<chart caption='$titulo_informe' xAxisName='$xAxisName' yAxisName='$yAxisName' showValues='0'  formatNumberScale='0' showBorder='1' legendBorderAlpha='0' slantLabels='1' labelDisplay='ROTATE' overlapColumns='2' labelDisplay='WRAP' >";
					$strXML .= $cuerpo;
					/*$strXML .=" <styles>
						<definition>
							<style name='myLabelsFont' type='font' font='Verdana' size='9' color='666666' bold='0' underline='0'/>
						</definition>
						<application>
							<apply toObject='DataLabels' styles='myLabelsFont' />
						</application>
					</styles>";*/
					$strXML .= "<styles>
							<definition>
								<style name='myBevel' type='bevel' distance='3'/>
								<style name='myShadow' type='shadow' angle='45' distance='3'/>
							</definition>
							<application>
								<apply toObject='DATAPLOT' styles='myBevel, myShadow' /> 
							</application>
						</styles>";
	
					$strXML .= "</chart>";
					
					$grafico =  renderChartHTML("sgs/estadisticas/Charts/Line.swf", "", $strXML, "myNext", 600, $alto, false);
				}
				break;
			case "Solicitud":
				break;
			case "Detalle":
				break;
			case "gubernamental":
				$xAxisName = "$item_tabla";
				
				if (($id_factor==3)or($id_factor==4)or($id_factor==6)or($id_factor==8)) {
					$nombreGrafico = "single_series_pie_2d";
					
					$cuerpo = armaCuerpoGrafico($aLabel,$aValor,$aSeries,$nombreGrafico);
					
					$strXML = "<chart palette='2' caption='$titulo_informe' shownames='1' showvalues='0'  decimals='0'>";
					$strXML .= $cuerpo;
					$strXML .= "</chart>";
					
					$grafico =  renderChartHTML("sgs/estadisticas/Charts/Pie2D.swf", "", $strXML, "myNext", 610, 400, false);
				}else{
					
					$nombreGrafico = "single_series_column_3d";
					$alto = count($aValor) * 20 + 200;
					
					$cuerpo = armaCuerpoGrafico($aLabel,$aValor,$aSeries,$nombreGrafico);
					//echo "<br>cuerpo:".$cuerpo;
				
					$strXML .= "<chart caption='$titulo_informe' xAxisName='$xAxisName' yAxisName=' Porcentaje Solicitudes' showValues='1'  formatNumberScale='0' showBorder='1' legendBorderAlpha='0' slantLabels='1' labelDisplay='ROTATE' overlapColumns='2' labelDisplay='WRAP' >";
					$strXML .= $cuerpo;
					/*$strXML .=" <styles>
						<definition>
							<style name='myLabelsFont' type='font' font='Verdana' size='9' color='666666' bold='0' underline='0'/>
						</definition>
						<application>
							<apply toObject='DataLabels' styles='myLabelsFont' />
						</application>
					</styles>";*/
					$strXML .= "<styles>
							<definition>
								<style name='myBevel' type='bevel' distance='3'/>
								<style name='myShadow' type='shadow' angle='45' distance='3'/>
							</definition>
							<application>
								<apply toObject='DATAPLOT' styles='myBevel, myShadow' /> 
							</application>
						</styles>";
	
					$strXML .= "</chart>";
					
					$grafico =  renderChartHTML("sgs/estadisticas/Charts/Column3D.swf", "", $strXML, "myNext", 600, $alto, false);
				
				}
				
				break;

		}

		if (($cantidad_registros==0)and($nivel!="Detalle")and($cantidad_registros!="")){
			$mensaje = "<b>No se encontraron registros para los criterios seleccionados</b>";
		}
		$resultado_reporte = str_replace ("#FILTROS_EXTRAS#"," ", $resultado_reporte);
		$resultado_reporte = str_replace ("#PAGINACION#",$paginacion, $resultado_reporte);
		$resultado_reporte = str_replace ("#MENSAJE#",$mensaje, $resultado_reporte);
		$contenido .= $resultado_reporte;
		$contenido = str_replace("#FECHA_LECTURA#",$fecha_lectura,$contenido);
		$contenido = str_replace("#GRAFICO#",$grafico,$contenido);
		//$contenido = str_replace("?accion?","",$contenido);
		


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
					echo "<BR>EN FUNCION:";
					//echo "<br>cantidad arreglos:".$cantidad_arreglos;
					$aMeses = $aSeries[0];
					for($j=0;$j<count($aMeses);$j++){
						$cuerpo = $cuerpo . "<dataset seriesName='".$aMeses[$j]."' showValues='0'>";
						$k= $j+1;
						$datos = $aSeries[$k];
						$aDatos = split(",",$datos);
						echo "<br>en datos ".count($aDatos);
						for($m=0;$m<count($aDatos);$m++){
							echo "<br>cantidad datos arreglo  $k:".count($aDatos);
							$cuerpo = $cuerpo . "<set value='".$aDatos[$m]."' />"; 
						}			
						$cuerpo = $cuerpo . "</dataset>";
					}
					break;
			}
	}
	return $cuerpo;
}

	
	
?>