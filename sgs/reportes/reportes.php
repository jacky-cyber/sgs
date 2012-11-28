<?php

session_register('encabezados_csv');
session_register('tabla_csv');
session_register('titulo_informe');

include("sgs/estadisticas/FusionCharts.php");
$accion_form = "?accion=$accion&act=$act";
//captura de parametros
$nivel = $_GET['nivel'];
$colspan = "";
if ($nivel != ""){
	$colspan = "colspan = \"3\"";
}
if($nivel==""){
	$nivel="Entidad";
}




$id_entidad_padre = "";
$id_entidad = "";
$periodo = "";
$mes = "";
$folio = "";
$paginacion =  "";
$dias = "";
$csv_separador=";";
$csv_fin_linea = "
";

if ($_GET['id_entidad_padre']!=""){
	$id_entidad_padre = $_GET['id_entidad_padre'];
}

if ($_POST['id_entidad_padre']!=""){
	$id_entidad_padre = $_POST['id_entidad_padre'];
}

if ($_GET['id_entidad']!=""){
	$id_entidad = $_GET['id_entidad'];
}
if ($_POST['id_entidad']!=""){
	$id_entidad = $_POST['id_entidad'];
}


if ($_GET['id_estado_solicitud']!=""){
	$id_estado_solicitud = $_GET['id_estado_solicitud'];
}  
if ($_POST['id_estado_solicitud']!=""){
	$id_estado_solicitud = $_POST['id_estado_solicitud'];
}


 
if ($_GET['periodo']!=""){
	$periodo = $_GET['periodo'];
}  
if ($_POST['periodo']!=""){
	$periodo = $_POST['periodo'];
}


if ($_GET['mes']!=""){
	$mes = $_GET['mes'];
}
if ($_POST['mes']!=""){
	$mes = $_POST['mes'];
}


if ($_GET['folio']!=""){
	$folio = $_GET['folio'];
}
if ($_POST['folio']!=""){
	$folio = $_POST['folio'];
}


if ($_GET['dias']!=""){
	$dias = $_GET['dias'];
}
if ($_POST['dias']!=""){
	$dias = $_POST['dias'];
}

if ($dias ==""){
	$dias = 5;
}


if ($_GET['id_responsable']!=""){
	$id_responsable = $_GET['id_responsable'];
}
if ($_POST['id_responsable']!=""){
	$id_responsable = $_POST['id_responsable'];
}


$id_tramo = "";


if ($_GET['id_tramo']!=""){
	$id_tramo = $_GET['id_tramo'];
}
if ($_POST['id_tramo']!=""){
	$id_tramo = $_POST['id_tramo'];
}

if ($_GET['id_pais']!=""){
	$id_pais = $_GET['id_pais'];
	
}  
if ($_POST['id_pais']!=""){
	$id_pais = $_POST['id_pais'];
}
if ($id_pais == ""){
	$id_region = "";
	$id_comuna = "";
}
if ($id_pais != ""){
	$condicion_geografica = " and c.id_pais = '$id_pais'";
}

	if ($_GET['id_region']!=""){
		$id_region = $_GET['id_region'];
	}  
	if ($_POST['id_region']!=""){
		$id_region = $_POST['id_region'];
	}
	if ($id_region != ""){
		$condicion_geografica .= " and c.id_region = '$id_region'";
	}
	$id_comuna = "";
	if ($id_region!=""){
		if ($_GET['id_comuna']!=""){
			$id_comuna = $_GET['id_comuna'];
		}  
		if ($_POST['id_comuna']!=""){
			$id_comuna = $_POST['id_comuna'];
		}
		//echo "<br>id comuna : ".$id_comuna."<br>";
		$sql = "Select id_comuna from comunas where id_region = '$id_region' and id_comuna = '$id_comuna' ";
		$result = mysql_query($sql) or die ("Error:".mysql_error()."<br>$sql");
		if (mysql_num_rows($result)==0){
			$id_comuna = "";
		}
		
		if ($id_comuna != ""){
			$condicion_geografica .= " and c.id_comuna = '$id_comuna'";
		}
	}

$id_categoria = "";

if ($_GET['id_categoria']!=""){
	$id_categoria = $_GET['id_categoria'];
}  
if ($_POST['id_categoria']!=""){
	$id_categoria = $_POST['id_categoria'];
}
if ($id_categoria !=""){
	$condicion .= " and d.id_categoria = '$id_categoria' ";
}

//echo "categoria: ".$id_categoria;



//echo "<br>id_responsable:".$id_responsable;
//crear los filtros

//echo "<br>entidad: ".$id_entidad;

$js.= "<script language=\"JavaScript\">

$(document).ready(function () 
		{
			$('#boton').click(function() 
			{ procesar('index.php?accion=$accion&axj=1&act=$act');
			});
			
			
			/*$('#csv').click(function() 
							{ 
								procesarArchivo();
							}
							);
			*/
			
		});



function procesarArchivo(){
	alert('Entra');
	$.ajax(
		   {
			   url:'genera_csv.php',
			   type:'post',
			   data:$('#form1').serialize(),
			   
			   success: function(request,settings)
			   {
				   $('#id_respuesta').html(request);
			   },
			   error: function(request,settings)
			   {
				   $('#id_respuesta').html(request);
			   }
		   })
}


		</script>";


include  ("sgs/reportes/reportes_crea_filtros.php");

if ($id_entidad !=""){
	$condicion = $condicion. " AND a.id_entidad = $id_entidad";
}else{
	$condicion = $condicion. " AND a.id_entidad in($entidades_por_defecto) ";
}

if ($axj!=1){

switch ($act) {
     case 1:
		
		 $icono = "total_solicitudes.jpg";
         include ("sgs/reportes/reportes_solicitudes_ingresadas.php");
		 break;
		 
	 case 2:
	 	 $icono = "sin_asignar.jpg";
         include ("sgs/reportes/reportes_solicitudes_ingresos_sin_asignar.php");
         break;

	 case 3:
	 	 $icono = "analisis_segun_tipo.jpg";
         include ("sgs/reportes/reportes_solicitudes_analisis_tipo.php");
         break;
		 
	case 4:
		 $icono = "denegadas.jpg";
         include ("sgs/reportes/reportes_solicitudes_denegadas_causal.php");
         break;
		 
	case 5:
		 $icono = "prox_vencer.jpg";
         include ("sgs/reportes/reportes_solicitudes_proximas_vencer.php");
         break;
		 
	case 6:
		 $icono = "vencidas.jpg";
         include ("sgs/reportes/reportes_solicitudes_vencidas.php");
         break;
		 
	case 7:
		 $icono = "con_secreto.jpg";
         include ("sgs/reportes/reportes_solicitudes_respondidas_secreto.php");
         break;
		 
	case 8:
		 $icono = "sin_secreto.jpg";
         include ("sgs/reportes/reportes_solicitudes_respondidas_no_secreto.php");
         break;
		 
	case 9:
		 $icono = "derivadas.jpg";
         include ("sgs/reportes/reportes_solicitudes_derivadas.php");
         break;
		 
	case 10:
		 $icono = "impagas.jpg";
         include ("sgs/reportes/reportes_solicitudes_impagas.php");
         break;
		 
	case 11:
		 $icono = "responsable.jpg";
         include ("sgs/reportes/reportes_solicitudes_ingresadas_responsable.php");
         break;
	case 12:
		 $icono = "estadistica_agregada.jpg";
		 include ("sgs/reportes/estadistica_agregada.php");
         include ("sgs/reportes/reportes_estadistica_agregada.php");
         break;
	case 13:
		include ("sgs/documentos_sistema/descarga.php");
	break;	 
   	default:
				
	
	    $def ="ok";
		$contenido = html_template('contenedor_menu_reportes');	
		
		$contenido = cms_replace("#ACCION#","$accion",$contenido);
		$contenido = cms_replace("#RESULTADO_REPORTE#","",$contenido);
		
		
		break;
		
		       
 }
 
}


if ($nivel=="Detalle"){
	
	$imagen_exportar = "<a href=\"sgs/reportes/genera_csv.php?axj=1\" ><img src=\"images/excel_min.jpg\" id=\"csv\" width=\"16\" height=\"16\" border=\"0\" alt=\"Exportar a CSV\" /></a>";
	$resultado_reporte = str_replace($imagen_exportar," ",$resultado_reporte);
}
$resultado_reporte = cms_replace("#COLSPAN#",$colspan,$resultado_reporte);


$_SESSION['titulo_informe'] = acentos_inverso($titulo_informe);
//sacar el html del contenido
if($_POST['mail']==1){
	
	$asunto = acentos_inverso($_POST['titulo_informe']);
	$email = $_POST['destinatarios'];
	$encabezados = "";	
	if ($_SESSION['encabezados_mail']!=""){
		$encabezados = "<table width=\"70%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
		$encabezados = $encabezados.$_SESSION['encabezados_mail'];
		$encabezados = $encabezados."</table><br>";
	}
	
	$cuerpo = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
				<html xmlns=\"http://www.w3.org/1999/xhtml\">
				<head>
				<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
				<link href=\"images/sitio/sgs/css/606006.css\" rel=\"stylesheet\" type=\"text/css\" />
				<link href=\"css/sitio.css\" rel=\"stylesheet\" type=\"text/css\" />
				<link href=\"css/deuman.css\" rel=\"stylesheet\" type=\"text/css\" />
				<title>Sgs</title>
				</head>
				<body>".$encabezados.$_SESSION['tabla_mail']."
				</body>
				</html>";
	
	
	$url = "http://".configuracion_cms('url');
	$url_1 = $url."/index.php";
	$url_2 = $url."/images/";
	$url_3 = $url."/css/";
	$cuerpo = str_replace("index.php",$url_1,$cuerpo);
	$cuerpo = str_replace("images/",$url_2,$cuerpo);
	$cuerpo = str_replace("css/",$url_3,$cuerpo);
	
	$resultado_envio = cms_mail($email,$asunto,$cuerpo,$headers);
	if ($resultado_envio==true){
		$contenido =  "El correo fue enviado Correctamente";
	}else{
		$contenido =  "El correo NO pudo ser enviado";
	}
	$_SESSION['tabla_mail'] = "";
	$_SESSION['encabezados_mail'] = "";
}
		
		
		
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
				//eje del grafico
				//echo "<br>act:".$act;
				/*if ($act==5){
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
					
					if($act!=12){
					$grafico =  renderChartHTML("sgs/estadisticas/Charts/Bar2D.swf", "", $strXML, "myNext", 600, $alto, false);
					}
				}*/
				//para cada servicio configurado se debe crear un gráfico
				
				$grafico = "";
				for($i=0;$i<count($aServicio);$i++){
					//echo "<br>en la funcion <br>";
					$datos = $aServicio[$i];
					$aDatos = explode(",",$datos);
					$nombre_servicio = $aDatos[0];			
					//006cb7
					$alto = 400;
					$nombreGrafico = "single_series_line_2d";
					$cuerpo = armaCuerpoGrafico($aMiniSeries_0,$aDatos,$aSeries,$nombreGrafico);
					$strXML = "<chart caption='$titulo_informe $periodo_seleccionado' subcaption='".$nombre_servicio."' xAxisName='Meses' yAxisName='Cantidad de solicitudes'  numberPrefix=' ' showValues='1' divLineAlpha='40' alternateHGridColor='#CEE3F6' alternateHGridAlpha='20' divLineColor='#CED8F6' lineColor='006CB7'>";
					$strXML .= $cuerpo;
					$strXML .= "</chart>";
					$grafic  =  renderChartHTML("sgs/estadisticas/Charts/Line.swf", "", $strXML, "myNext", 760, $alto, false);
					$grafico .= "<br><br>".$grafic;
				}
				
				
				//echo "hola dd $nivel"; 
				break;
			case "Entidad2":
				$xAxisName = "Mes/a&ntilde;o";
				$yAxisName = "D&iacute;as";
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
				
					$strXML .= "<chart caption='$titulo_informe' xAxisName='$xAxisName' yAxisName='$yAxisName' showValues='0'  formatNumberScale='0' showBorder='1' legendBorderAlpha='0' slantLabels='1' labelDisplay='ROTATE' overlapColumns='2' labelDisplay='WRAP'  >";
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
				
				if (($id_factor==3)or($id_factor==4)or($id_factor==6)) {
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
				
					$strXML .= "<chart caption='$titulo_informe' xAxisName='$xAxisName' yAxisName='Cantidad Solicitudes' showValues='1'  formatNumberScale='0' showBorder='1' legendBorderAlpha='0' slantLabels='1' labelDisplay='ROTATE' overlapColumns='2' labelDisplay='WRAP' >";
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
		//echo "<br>nivel:".$nivel;		
		$display="yes";
		if($nivel=="Detalle"){
			$display="none";
			
		}
		$resultado_reporte = str_replace ("#DISPLAY#",$display, $resultado_reporte);
		$resultado_reporte = str_replace ("#ACT#",$act, $resultado_reporte);
		
		$resultado_reporte = str_replace ("#PAGINACION#",$paginacion, $resultado_reporte);
		$resultado_reporte = cms_replace("#GRAFICO#",$grafico,$resultado_reporte);
		if($nivel!="Detalle"){
			$contenido .= $resultado_reporte;
			$contenido .= "<script>muestraOcultaRegionComuna();</script>";
		}else{
			$contenido = $resultado_reporte.$contenido;
		}
		
		$contenido = cms_replace("#LINK#","?accion=$accion&act=$act",$contenido);
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
				case "single_series_line_2d":
					
					for($i=0;$i<count($aLabel);$i++){
							$cuerpo = $cuerpo."<set label='".$aLabel[$i]."' value='".$aValor[$i+1]."'  />";
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
							//echo "<br>cantidad datos arreglo  $k:".count($aDatos);
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