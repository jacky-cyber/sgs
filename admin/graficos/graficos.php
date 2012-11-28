<?php


include("sgs/estadisticas/FusionCharts.php");




  $query= "SELECT id_auto_admin,tabla    
           FROM  auto_admin";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($id_auto_admin,$tabla) = mysql_fetch_row($result)){
			
			$lista_tablas .= "<option value=\"$id_auto_admin\">$tabla</option>";
			
			
						   
		 }
		 

		   
		   
		   
		   
			$contenido = "<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                            <tr>
                              <td align=\"center\" class=\"textos\"><select name=\"id_tabla\">
                            <option value=\"#\" >Seleccione tabla</option>
                          	 $lista_tablas
                            </select></td>
							
                            </tr>
							<tr><td align=\"center\" class=\"textos\">
							<input type=\"submit\" name=\"Submit\" value=\"Enviar\"></td></tr> n
                          </table>";   
		   

						  
						  
						  
$id_tabla = $_POST['id_tabla'];




if($id_tabla!=""){

  $query= "SELECT tabla
           FROM  auto_admin
           WHERE id_auto_admin =$id_tabla";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      list($tabla) = mysql_fetch_row($result);

  $query= "SELECT id_campo,campo,id_tipo_campo,relacion,js,unic,carpeta,existe_listado,pk,txt    
           FROM  auto_admin_campo 
           WHERE id_auto_admin =$id_tabla and pk<>1 and campo <>'orden'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($id_campo,$campo,$id_tipo_campo,$relacion,$id_auto_admin,$js,$unic,$carpeta,$existe_listado,$pk,$txt) = mysql_fetch_row($result)){
			
			 $strXML="";
			 if(es_pk($campo)){
			 	$campo_txt = campo_txt($id_tabla);
				if($campo_txt!=""){
				$valor = rescata_valor($tabla,$valor_id_registro,$campo_txt);
				}
			 	
			 }else{
			 
			 }
			
			  $query= "SELECT count(*),$campo  
                       FROM  $tabla
                       WHERE 1
					   group by $campo";
                 $result2= cms_query($query)or die (error($query,mysql_error(),$php));
                  while (list($valor,$campo_texto) = mysql_fetch_row($result2)){
            			
						 $strXML .= "<set label='$campo_texto ddd' value='$valor' />";
						
									   
            		 }
			 $strXML = "<chart caption='$campo' xAxisName='Month' yAxisName='Units' showValues='0' formatNumberScale='0' showBorder='1'>
			 				$strXML
			 			</chart>";
			
			
			
			
			$gra = renderChartHTML("sgs/estadisticas/Charts/Column3D.swf", "", $strXML, "$campo", 600, 300, false);
			
				$graficos .= "
                            <tr>
                              <td align=\"center\" >$gra</td>
                            </tr>
                        ";
					   
		 }



}

$contenido = "<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                $graficos
              </table>";



   


?>