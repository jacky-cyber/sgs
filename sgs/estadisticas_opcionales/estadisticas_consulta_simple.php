<?php


	$tabla= "sgs_solicitud_acceso";
	$campo_txt= 'tematica';
	$campo_pk= 'id_tematica';
	$tabla_campo= 'onemi_tematica';
	//$dato= "$id_campo_tabla  tttt $axj";
	$condicion = "and a.id_tipo_solicitud=$act ";
	
			 
 $strXML2="";
	 
$query = "select b.$campo_txt,COUNT(*) as cantidad
		  from $tabla a LEFT OUTER JOIN $tabla_campo b on a.$campo_pk = b.$campo_pk
		  where 1 $condicion
		  GROUP by a.$campo_pk ";	
		
		 $result33= cms_query($query)or die (error($query,mysql_error(),$php));
    
	  while (list($texto_campo,$cantidad) = mysql_fetch_row($result33)){
    			if($texto_campo==""){
					$texto_campo="No Especifica";
				}
			  $strXML2 .= "<set label='$texto_campo' value='$cantidad' />"; 
			 }						
	
	


$nombre_grafico= "$titulo_graf por $tabla";
$id_tipo_grafico=1;

  
  $grafico2 = "  <div id=\"chart1div2_$tabla\">
      				FusionCharts 
   				</div>
   <script language=\"JavaScript\"> 
      var chart1 = new FusionCharts(\"sgs/estadisticas/Charts/Pie3D.swf\", \"$tabla\", \"550\", \"400\", \"0\", \"1\"); 
      chart1.setDataXML(\"<chart>$strXML2</chart>\");
      chart1.render(\"chart1div2_$tabla\");
   </script>";
  
  
	$strXML_html = htmlentities($strXML);
	

		  
	
	
	$contenido .= "<table width=\"95%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
	
                    <tr><td align=\"center\" class=\"textos\">Seleccione un filtro $combo_list </td></tr> 
					<tr><td align=\"center\" class=\"textos\">&nbsp;</td></tr> 
					<tr>
                      <td align=\"center\" class=\"textos\">$grafico2</td>
                    </tr>
					
                  </table>";
				  
				  
	if($axj==1 and $campo_sel !=""){
	
	$contenido="<chart>$strXML2</chart>";
	
	
	}

?>