<?php


/*SESSION*/




$nombre_grafico= "$titulo_graf por $tabla";
$id_tipo_grafico=1;

  

	$contenido .= "<table width=\"95%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"cuadro_light\">
		     <tr>
			<td align=\"center\" class=\"textos\">
			<table width=\"98%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
			      <tr >
			         <td align=\"left\" class=\"textos\">Seleccione un filtro $combo_list </td>
				 <td >
				 <div id=\"fcexpDiv\"  align=\"center\">FusionCharts Export Handler Component</div>
			   <script type=\"text/javascript\">
			      var myExportComponent = new FusionChartsExportObject(\"fcExporter1\", \"sgs/estadisticas/Charts/FCExporter.swf\");
			      myExportComponent.componentAttributes.width = '150';
			      myExportComponent.componentAttributes.height = '35';
			      myExportComponent.componentAttributes.bgColor = 'eeeeee';
			      myExportComponent.componentAttributes.btnsavetitle = 'Guardar Imagen';
			      myExportComponent.componentAttributes.btndisabledtitle = '  ';
			      myExportComponent.componentAttributes.btnColor = 'eeeeee';
			      myExportComponent.componentAttributes.btnBorderColor = 'eeeeee';
			      myExportComponent.componentAttributes.btnFontFace = 'Verdana';
			      myExportComponent.componentAttributes.btnFontColor = '000000';
			      myExportComponent.componentAttributes.btnFontSize = '12';
			      myExportComponent.Render(\"fcexpDiv\");
			   </script>
				 </td>
			          <td align=\"center\" class=\"textos\"><a href=\"javascript:barra_chart_col()\" ><img src=\"images/chart_bar.png\" alt=\"\" border=\"0\"></a>
				  &nbsp<a href=\"javascript:barra_chart_pie()\" ><img src=\"images/chart_pie.png\" alt=\"\" border=\"0\"></a></td>
			      </tr>
			</table>
			</td>
		     </tr>
		       <tr>
                        <td align=\"center\" class=\"textos\">
			<div id=\"chart1div2_$tabla\">
      				Aqu&iacute; va el Grafico
   				</div>
		  <script language=\"JavaScript\"> 
      
			var chart1 = new FusionCharts(\"sgs/estadisticas/Charts/Pie3D.swf\", \"$tabla\", \"600\", \"400\", \"0\", \"1\"); 
			chart1.setDataXML(\"$xml_grafico\");
			chart1.render(\"chart1div2_$tabla\");
     
		  </SCRIPT>
			</td>
                     </tr>
			<tr><td align=\"center\" class=\"textos\">
			
			</td></tr>
			<tr><td align=\"center\" class=\"textos\" >$filtro</td></tr> 
			 <tr><td align=\"center\" class=\"textos\"> <div id=\"criterios\">$lista_criterios_ajax</div></td></tr> 
		    				
                  </table><br>";
				  
	

//




?>