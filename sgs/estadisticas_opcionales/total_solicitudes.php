<?php

			  
			      $query= "SELECT id_tipo_solicitud,tipo_solicitud  
                         FROM  sgs_tipo_solicitud 
						 WHERE codigo='W' or codigo='C' or codigo = 'P'";
                   $result= cms_query($query)or die (error($query,mysql_error(),$php));
                    while (list($id_tipo_solicitud,$tipo_solicitud) = mysql_fetch_row($result)){
              				
			     $query= "SELECT count(*)
                        FROM  sgs_solicitud_acceso 
                        group by id_tipo_solicitud=$id_tipo_solicitud ";
                  $result22= cms_query($query)or die (error($query,mysql_error(),$php));
                  list($tot_tipo_solicitud) = mysql_fetch_row($result22);							
					
					$tot_transparencia = $tot_transparencia + $tot_tipo_solicitud;
									   
              		 }
			  
			$total_ley_transparencia =  $tot_transparencia;
			
			 $strXML2 = "<set label='Solicitudes de Transparencia' value='$total_ley_transparencia' link='index.php?accion=Reportes'/>"; 

				      $query= "SELECT id_tipo_solicitud,tipo_solicitud  
                               FROM  sgs_tipo_solicitud 
						       WHERE codigo<>'W' and  codigo<>'C' and codigo <> 'P'";
                   $result= cms_query($query)or die (error($query,mysql_error(),$php));
                    while (list($id_tipo_solicitud,$tipo_solicitud) = mysql_fetch_row($result)){
              			
			     $query= "SELECT count(*)
                          FROM  sgs_solicitud_acceso 
                          where id_tipo_solicitud=$id_tipo_solicitud ";
						  
                  $result22= cms_query($query)or die (error($query,mysql_error(),$php));
                  list($tot_tipo_solicitud) = mysql_fetch_row($result22);							
					//echo $tipo_solicitud." $tot_tipo_solicitud<br>";	
					//$tot_transparencia = $tot_transparencia + $tot_tipo_solicitud;
						
						$strXML2 .= "<set label='$tipo_solicitud' value='$tot_tipo_solicitud' link='index.php?accion=$accion&act=$id_tipo_solicitud'/>"; 				   
              		 }
			  
		  $query= "SELECT count(*)
                        FROM  onemi_visita_museo ";
                  $result22= cms_query($query)or die (error($query,mysql_error(),$php));
                  list($tot_tipo_museo) = mysql_fetch_row($result22);							
					
					
			
			
			 $strXML2 .= "<set label='Visita Museo' value='$tot_tipo_museo' link='index.php?accion=$accion&act=2'/>"; 

		
		
		
		
	$nombre_grafico= "$titulo_graf por $tabla";
$id_tipo_grafico=1;
//$grafico = grafico(1, $id_tipo_grafico,$strXML2,$nombre_grafico);

$grafico = "  <div id=\"chart1div_$tabla\">
      FusionCharts
   </div>
   <script language=\"JavaScript\"> 
      var chart1 = new FusionCharts(\"sgs/estadisticas/Charts/Pie3D.swf\", \"$tabla\", \"550\", \"400\", \"0\", \"1\"); 
      chart1.setDataXML(\"<chart>$strXML2</chart>\");
      chart1.render(\"chart1div_$tabla\");
   </script>";
  
	//$strXML_html = htmlentities($strXML);
	
	$contenido = "<table width=\"95%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                    <tr><td align=\"center\" class=\"textos\"><h2>Cantidad de Ingresos segun tipo</h2> </td></tr> 
					<tr><td align=\"right\" >
				  <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                    <tr >
                      <td align=\"left\" class=\"textos\"></td> 
                       <td align=\"right\" class=\"textos\">
					   <img src=\"images/printButton.png\" alt=\"Imprimir Grafico\" border=\"0\" onClick='javascript:printChart('$tabla');'></td>
					 </tr>
                	</table>
				</td></tr> 
					<tr>
                      <td align=\"center\" class=\"textos\">$grafico </td>
                    </tr>
					     </table>";
						 
						 
?>