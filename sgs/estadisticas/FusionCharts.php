<?php

			  
function grafico($id_configuracion_grafico, $id_tipo_grafico,$datos_xml,$nombre_grafico){
//echo "$id_configuracion_grafico, $id_tipo_grafico,$datos_xml \n\n\n\n<br>";
		$id_tipo_grafico_def= $id_tipo_grafico;
	if(!is_numeric($id_configuracion_grafico)){
	 				$query= "SELECT *	
					 		  FROM graf_configuracion_xml 
							  WHERE caption='$id_configuracion_grafico'"; 

			$result22= cms_query($query)or die (error($query,mysql_error(),$php)); 
			$num_filas = mysql_num_fields($result22); 
			$resultado = mysql_fetch_row($result22); 
	}else{
					 $query= "SELECT *	
					 		  FROM graf_configuracion_xml 
							  WHERE id_configuracion_xml='$id_configuracion_grafico'"; 

			$result22= cms_query($query)or die (error($query,mysql_error(),$php)); 
			$num_filas = mysql_num_fields($result22); 
			$resultado = mysql_fetch_row($result22); 
	}
 
		
					for ($i = 1; $i < $num_filas; $i++){ 
							$nom_campo = mysql_field_name($result22,$i); 
							$valor = $resultado[$i]; 
							$$nom_campo = $valor; 
								if($valor!=0 and $valor!="" and  $valor!=" "){
									$nom_campo = str_replace("Nro","Nro $i",$nom_campo);
									
								$valores_conf_xml .= "$nom_campo = '$valor' ";
								}
							
								
							} 
						
						
						
					
					 $query= "SELECT *	
					 		  FROM graf_configuracion_letras
							  WHERE id_configuracion_letra ='$id_configuracion_letra'"; 

			$result23= cms_query($query)or die (error($query,mysql_error(),$php)); 
			$num_filas = mysql_num_fields($result22); 
			$resultado = mysql_fetch_row($result22); 
	
 
		
					for ($i = 1; $i < $num_filas; $i++){ 
							$nom_campo = mysql_field_name($result23,$i); 
							$valor = $resultado[$i]; 
							$$nom_campo = $valor; 
							
								
							} 
							
								
					// echo $valores_conf_xml."<br><br><br>";
					 if($datos_xml!=""){
					  $strXML = "<chart $valores_conf_xml >
			 				$datos_xml
							 <styles>
        <definition>
            <style name='$nombre_configuracion' type='font' font='$font' size='$size' color='$color' bold='$bold' underline='$underline'/>
        </definition>
        <application>
            <apply toObject='DataLabels' styles='$nombre_configuracion' />
        </application>
    </styles>
			 			</chart>";
			
	$swf_chart = rescata_valor('graf_tipo_grafico',$id_tipo_grafico,'swf');
	
	$gra = renderChartHTML("sgs/estadisticas/Charts/$swf_chart", "", $strXML, "$nombre_grafico", $ancho, $alto, $detalles);
	if($grilla_datos==1)	{
		
		$datos_xml= acentos_inverso($datos_xml);
		$grilla = "
	<div id=\"griddiv_$nombre_grafico\" align=\"center\">The grid will appear within this DIV.</div>
   <script type=\"text/javascript\">
      var myGrid = new FusionCharts(\"sgs/estadisticas/Charts/SSGrid.swf\", \"myGrid1_$nombre_grafico\", \"$ancho\", \"$alto\", \"0\", \"0\");
      myGrid.setDataXML(\"<chart>$datos_xml</chart>\");
      //Set Grid specific parameters
      myGrid.addVariable('showPercentValues', '1');
      myGrid.addVariable('showShadow', '1');
      myGrid.render(\"griddiv_$nombre_grafico\");
   </script>";
	}

   
    $query= "SELECT id_tipo_grafico,tipo_grafico    
           FROM  graf_tipo_grafico";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($id_tipo_grafico,$tipo_grafico) = mysql_fetch_row($result)){
			$lista_graficos .= "<option value=\"$id_tipo_grafico\">$tipo_grafico</option>";			   
		 }
	
	$gra = "  
	<SCRIPT LANGUAGE=\"Javascript\" SRC=\"sgs/estadisticas/JSClass/FusionCharts.js\"></SCRIPT>
	<SCRIPT LANGUAGE=\"JavaScript\"> 



function printChart(){
			//Get chart from its ID
			var chartToPrint = getChartFromId(\"$nombre_grafico\");
			chartToPrint.print();
		}

</SCRIPT>


	
	
	<table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
				<tr><td align=\"right\" >
				  <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                    <tr >
                      <td align=\"left\" class=\"textos\">Cambiar grafico <select name=\"tipo_grafico\">
                                                         $lista_graficos
                                                         </select></td> 
                       <td align=\"right\" class=\"textos\">
					   <img src=\"images/printButton.png\" alt=\"Imprimir Grafico\" border=\"0\" onClick='javascript:printChart();'></td>
					 </tr>
                	</table>
				</td></tr> 
                <tr>
                  <td align=\"center\" >
				  <div id=\"$nombre_grafico\">$gra</div>
				  </td>
                 </tr>
            	 <tr>
                  <td align=\"center\" >
				  $grilla
				  </td>
                  </tr>
            	</table>";	

      }
	  
	  
	return $gra;		  
}




// Page: FusionCharts.php
// Author: InfoSoft Global (P) Ltd.
// This page contains functions that can be used to render FusionCharts.


// encodeDataURL function encodes the dataURL before it's served to FusionCharts.
// If you've parameters in your dataURL, you necessarily need to encode it.
// Param: $strDataURL - dataURL to be fed to chart
// Param: $addNoCacheStr - Whether to add aditional string to URL to disable caching of data
function encodeDataURL($strDataURL, $addNoCacheStr=false) {
    //Add the no-cache string if required
    if ($addNoCacheStr==true) {
        // We add ?FCCurrTime=xxyyzz
        // If the dataURL already contains a ?, we add &FCCurrTime=xxyyzz
        // We replace : with _, as FusionCharts cannot handle : in URLs
		if (strpos($strDataURL,"?")<>0)
			$strDataURL .= "&FCCurrTime=" . Date("H_i_s");
		else
			$strDataURL .= "?FCCurrTime=" . Date("H_i_s");
    }
	// URL Encode it
	return urlencode($strDataURL);
}


// datePart function converts MySQL database based on requested mask
// Param: $mask - what part of the date to return "m' for month,"d" for day, and "y" for year
// Param: $dateTimeStr - MySQL date/time format (yyyy-mm-dd HH:ii:ss)
function datePart($mask, $dateTimeStr) {
    @list($datePt, $timePt) = explode(" ", $dateTimeStr);
    $arDatePt = explode("-", $datePt);
    $dataStr = "";
    // Ensure we have 3 parameters for the date
    if (count($arDatePt) == 3) {
        list($year, $month, $day) = $arDatePt;
        // determine the request
        switch ($mask) {
        case "m": return $month;
        case "d": return $day;
        case "y": return $year;
        }
        // default to mm/dd/yyyy
        return (trim($month . "/" . $day . "/" . $year));
    }
    return $dataStr;
}


// renderChart renders the JavaScript + HTML code required to embed a chart.
// This function assumes that you've already included the FusionCharts JavaScript class
// in your page.

// $chartSWF - SWF File Name (and Path) of the chart which you intend to plot
// $strURL - If you intend to use dataURL method for this chart, pass the URL as this parameter. Else, set it to "" (in case of dataXML method)
// $strXML - If you intend to use dataXML method for this chart, pass the XML data as this parameter. Else, set it to "" (in case of dataURL method)
// $chartId - Id for the chart, using which it will be recognized in the HTML page. Each chart on the page needs to have a unique Id.
// $chartWidth - Intended width for the chart (in pixels)
// $chartHeight - Intended height for the chart (in pixels)
// $debugMode - Whether to start the chart in debug mode
// $registerWithJS - Whether to ask chart to register itself with JavaScript
function renderChart($chartSWF, $strURL, $strXML, $chartId, $chartWidth, $chartHeight, $debugMode=false, $registerWithJS=false, $setTransparent="") {
	//First we create a new DIV for each chart. We specify the name of DIV as "chartId"Div.			
	//DIV names are case-sensitive.

    // The Steps in the script block below are:
    //
    //  1)In the DIV the text "Chart" is shown to users before the chart has started loading
    //    (if there is a lag in relaying SWF from server). This text is also shown to users
    //    who do not have Flash Player installed. You can configure it as per your needs.
    //
    //  2) The chart is rendered using FusionCharts Class. Each chart's instance (JavaScript) Id 
    //     is named as chart_"chartId".		
    //
    //  3) Check whether we've to provide data using dataXML method or dataURL method
    //     save the data for usage below 
	if ($strXML=="")
        $tempData = "//Set the dataURL of the chart\n\t\tchart_$chartId.setDataURL(\"$strURL\")";
    else
        $tempData = "//Provide entire XML data using dataXML method\n\t\tchart_$chartId.setDataXML(\"$strXML\")";

    // Set up necessary variables for the RENDERCAHRT
    $chartIdDiv = $chartId . "Div";
    $ndebugMode = boolToNum($debugMode);
    $nregisterWithJS = boolToNum($registerWithJS);
	$nsetTransparent=($setTransparent?"true":"false");


    // create a string for outputting by the caller
$render_chart = <<<RENDERCHART

	<!-- START Script Block for Chart $chartId -->
	<div id="$chartIdDiv" align="center">
		Chart.
	</div>
	<script type="text/javascript">	
		//Instantiate the Chart	
		var chart_$chartId = new FusionCharts("$chartSWF", "$chartId", "$chartWidth", "$chartHeight", "$ndebugMode", "$nregisterWithJS");
      chart_$chartId.setTransparent("$nsetTransparent");
    
		$tempData
		//Finally, render the chart.
		chart_$chartId.render("$chartIdDiv");
	</script>	
	<!-- END Script Block for Chart $chartId -->
RENDERCHART;

  return $render_chart;
}


//renderChartHTML function renders the HTML code for the JavaScript. This
//method does NOT embed the chart using JavaScript class. Instead, it uses
//direct HTML embedding. So, if you see the charts on IE 6 (or above), you'll
//see the "Click to activate..." message on the chart.
// $chartSWF - SWF File Name (and Path) of the chart which you intend to plot
// $strURL - If you intend to use dataURL method for this chart, pass the URL as this parameter. Else, set it to "" (in case of dataXML method)
// $strXML - If you intend to use dataXML method for this chart, pass the XML data as this parameter. Else, set it to "" (in case of dataURL method)
// $chartId - Id for the chart, using which it will be recognized in the HTML page. Each chart on the page needs to have a unique Id.
// $chartWidth - Intended width for the chart (in pixels)
// $chartHeight - Intended height for the chart (in pixels)
// $debugMode - Whether to start the chart in debug mode
function renderChartHTML($chartSWF, $strURL, $strXML, $chartId, $chartWidth, $chartHeight, $debugMode=false,$registerWithJS=false, $setTransparent="") {
    // Generate the FlashVars string based on whether dataURL has been provided
    // or dataXML.
    $strFlashVars = "&chartWidth=" . $chartWidth . "&chartHeight=" . $chartHeight . "&debugMode=" . boolToNum($debugMode);
    if ($strXML=="")
        // DataURL Mode
        $strFlashVars .= "&dataURL=" . $strURL;
    else
        //DataXML Mode
        $strFlashVars .= "&dataXML=" . $strXML;
    
    $nregisterWithJS = boolToNum($registerWithJS);
    if($setTransparent!=""){
      $nsetTransparent=($setTransparent==false?"opaque":"transparent");
    }else{
      $nsetTransparent="window";
    }
$HTML_chart = <<<HTMLCHART
	<!-- START Code Block for Chart $chartId -->
	<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="$chartWidth" height="$chartHeight" id="$chartId">
		<param name="allowScriptAccess" value="always" />
		<param name="movie" value="$chartSWF"/>		
		<param name="FlashVars" value="$strFlashVars&registerWithJS=$nregisterWithJS" />
		<param name="quality" value="high" />
		<param name="wmode" value="$nsetTransparent" />
		<embed src="$chartSWF" FlashVars="$strFlashVars&registerWithJS=$nregisterWithJS" quality="high" width="$chartWidth" height="$chartHeight" name="$chartId" allowScriptAccess="always" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" wmode="$nsetTransparent" />
	</object>
	<!-- END Code Block for Chart $chartId -->
HTMLCHART;

  return $HTML_chart;
}

// boolToNum function converts boolean values to numeric (1/0)
function boolToNum($bVal) {
    return (($bVal==true) ? 1 : 0);
}

?>