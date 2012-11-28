<?php


$js_marca .="
<script>
function seleccionar_todo(){ 
   for (i=0;i<document.form1.elements.length;i++) 
      if(document.form1.elements[i].type == \"checkbox\") 
         document.form1.elements[i].checked=1 
} 

function deseleccionar_todo(){ 
   for (i=0;i<document.form1.elements.length;i++) 
      if(document.form1.elements[i].type == \"checkbox\") 
         document.form1.elements[i].checked=0 
} 
	
 </script>
 
    <table   border=\"0\"  cellpadding=\"3\" cellspacing=\"3\">
    <tr><td align=\"right\" class=\"textos\"><a href=\"javascript:seleccionar_todo()\">
	<img src=\"images/plus.gif\" alt=\"\" border=\"0\"></a>  
<a href=\"javascript:deseleccionar_todo()\"><img src=\"images/minus.gif\" alt=\"\" border=\"0\"></a> </td></tr>
	
	</table>
 
"; 


switch ($act) {
     case 1:
         
			
		include ("admin/respaldar/bakup.php");


         break;
	 case 2:
         include ("admin/respaldar/actualizar.php");
         break;
   	default:
	   
	   
	   $sql = "SHOW TABLES FROM $DATABASE";
$result_lista_tablas1 = cms_query($sql);

//$tot_tablas1 = mysql_list_tables( $DATABASE,$DB);

//$tablas_base1= mysql_num_rows($result_lista_tablas1);


while( $line = mysql_fetch_row($result_lista_tablas1)){

	$tablas_base1++;
	$tbl= $line[0];
	
	
	    $query= "SELECT count(*)   
               FROM  $DATABASE.$tbl;";
			   
			  
			   
         $result2= mysql_query($query)or die (error($query,mysql_error(),$php));
         list($tot_reg) = mysql_fetch_row($result2);
	
	$lista_tablas .="<tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">
					<td align=\"left\" class=\"textos\">$tbl </td>
					<td align=\"center\" class=\"textos\">$tot_reg</td> 
					<td align=\"center\" class=\"textos\"><input type=\"checkbox\" name=\"estructura_$tbl\" id=\"estructura_$tbl\" value=\"1\" checked></td> 
					<td align=\"center\" class=\"textos\"><input type=\"checkbox\" name=\"datos_$tbl\" id=\"datos_$tbl\" value=\"1\" checked></td> 
					</tr> ";
	
	//$arreglo_tablas1[$tablas_base1] =$line[0];
	
		
}

	   $accion_form = "index.php?accion=$accion&act=1&axj=1";
	   $url = $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
	   $url = str_replace("index.php?accion=$accion","",$url);
	   
   		$contenido = "<table width=\"90%\" height =\"300\"border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" >
   		                <tr>
   		                  <td align=\"center\" class=\"textos\" >
   		                 
   		                  <h2><strong>Respaldar Base de Datos</strong></h2>
   		                  </td>
   		                </tr>
						<tr><td align=\"center\" class=\"textos_plomo\">Respaldos de forma automarica por medio de un cron en url <br>
						http://".$url."admin/respaldar/respaldo_servidor.php</td></tr> 
						
						<tr><td align=\"center\" class=\"textos\">&nbsp;</td></tr> 
						<tr><td align=\"center\" class=\"textos\"><input type=\"submit\" name=\"Submit\" value=\"Importar Datos\"></td></tr> 
						<tr><td align=\"center\" class=\"textos\">Insert con nombre de campos <input type=\"checkbox\" name=\"nombre_campos\" id=\"nombre_campos\" value=\"1\" checked></td></tr> 
						<tr><td align=\"center\" class=\"textos\">Link de respaldo automatico </td></tr> 
						<tr><td align=\"center\" class=\"textos\">
						  <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"1\" cellspacing=\"1\" class=\"cuadro_light\">
                           <tr>
						   	<td align=\"center\" class=\"textos\">&nbsp;</td>
						   	<td align=\"center\" class=\"textos\">&nbsp;</td> 
						   	<td align=\"center\" class=\"textos\">&nbsp</td>
							<td align=\"right\" class=\"textos\">$js_marca</td> 
						   </tr> 
						 <tr>
						   	<td align=\"center\" class=\"textos\"><strong>Tabla</strong></td>
						   	<td align=\"center\" class=\"textos\"><strong>Registros</strong></td> 
						   	<td align=\"center\" class=\"textos\">Estructura</td>
							<td align=\"center\" class=\"textos\">Datos</td> 
						   </tr> 
						   $lista_tablas
                        	</table>
						
						 </td></tr> 
						 <tr><td align=\"center\" class=\"textos\"> <input type=\"submit\" name=\"Submit\" value=\"Importar Datos\"></td></tr> 
						
   		              </table>";
   		
   }



  
		

?>