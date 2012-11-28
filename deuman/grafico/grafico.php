<?php
$id_campo_tabla = $_POST['id_campo_tabla'];

include("sgs/estadisticas/FusionCharts.php");

$tabla= "usuario";
$condicion= " and id_perfil=1 ";	
$campo_txt_def= "sexo";
$campo_pk_def= "id_sexo";
$tabla_campo_def= "usuario_sexo";
	

    $query= "SELECT id_auto_admin
           FROM  auto_admin 
           WHERE tabla='$tabla'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      list($id_auto_admin) = mysql_fetch_row($result);
	
	
	    $query= "SELECT id_tipo_campo,campo
               FROM  auto_admin_campo
               WHERE id_auto_admin='$id_auto_admin' and id_tipo_campo =6"; //6 es tipo de campo combolist
			 
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
          while (list($id_tipo_campo,$campo) = mysql_fetch_row($result)){
		  
		  
			    $query= "SELECT id_auto_admin 
                       FROM  auto_admin_campo
                       WHERE campo='$campo' and pk=1";
                 $result2= cms_query($query)or die (error($query,mysql_error(),$php));
                 list($id_auto_admin_campo) = mysql_fetch_row($result2);
				
		  		$campo_txt = ucwords(strtolower(campo_txt($id_auto_admin_campo)));
				$campo_txt = str_replace("_"," ",$campo_txt);
				if($id_auto_admin_campo==$id_campo_tabla){
				$titulo_graf= $campo_txt;
				$lista_campos_tabla .="<option value=\"$id_auto_admin_campo\" selected>$campo_txt</option>\n";
				}else{
				$lista_campos_tabla .="<option value=\"$id_auto_admin_campo\">$campo_txt</option>\n";
				}
				
		  	  }
		  
		  $combo_list ="<select name=\"id_campo_tabla\" onchange=\"document.form1.submit();\">
               			 $lista_campos_tabla
                	    </select>";
		
	
	
	if($id_campo_tabla==""){
	$campo_txt= $campo_txt_def;
	$campo_pk= $campo_pk_def;
	$tabla_campo= $tabla_campo_def;
	
	}else{
	$campo_txt=  campo_txt($id_campo_tabla);
	$campo_pk= campo_pk_tabla($id_campo_tabla);
	$tabla_campo= tabla($id_campo_tabla);
	}
			 
 
	 
$query = "select b.$campo_txt,COUNT(*) as cantidad
		  from $tabla a LEFT OUTER JOIN $tabla_campo b on a.$campo_pk = b.$campo_pk
		  where 1 
		  GROUP by a.$campo_pk";	
		
		 $result33= cms_query($query)or die (error($query,mysql_error(),$php));
    
	  while (list($texto_campo,$cantidad) = mysql_fetch_row($result33)){
    			if($texto_campo==""){
					$texto_campo="No Especifica";
				}
			  $strXML2 .= "<set label='$texto_campo' value='$cantidad' />\n"; 
			 }						
	
	
//Create an XML data document in a string variable
  
 /*  $strXML .= "<chart caption='$titulo_graf por $tabla' xAxisName='$titulo_graf' yAxisName='$tabla' showValues='0'    formatNumberScale='0' showBorder='1'>";
   $strXML .= $strXML2;
   $strXML .= "</chart>";
*/
   //Create the chart - Column 3D Chart with data from strXML variable using dataXML method
//  $grafico = renderChartHTML("sgs/estadisticas/Charts/Column3D.swf", "", $strXML, "myNext", 500, 300, false);
$nombre_grafico= "$titulo_graf por $tabla";
$id_tipo_grafico=1;
$grafico = grafico(1, $id_tipo_grafico,$strXML2,$nombre_grafico);
  
	$strXML_html = htmlentities($strXML);
	
	$contenido = "<table width=\"95%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                    <tr><td align=\"center\" class=\"textos\">Seleccione un filtro $combo_list </td></tr> 
					<tr><td align=\"center\" class=\"textos\">&nbsp;</td></tr> 
					<tr>
                      <td align=\"center\" class=\"textos\">$grafico</td>
                    </tr>
					
                  </table>";
	
	
?>