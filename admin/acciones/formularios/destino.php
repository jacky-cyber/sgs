<?php

$orden = $_GET['orden'];


  $query= "SELECT  	DIRECCION,DESCRIPCION_COMUNA,CONTACTO_DIRECCION,HH,MM   
           FROM  PEDIDOS_DIRECCIONES
           WHERE NUMERO_PEDIDO='$orden'";
     $result_r= mssql_query($query)or die (error($query,mysql_error(),$php));
      while (list($DIRECCION,$DESCRIPCION_COMUNA,$CONTACTO_DIRECCION,$HH,$MM ) = mssql_fetch_row($result_r)){

      	 
      	
      	
      	
      		$datos .="<tr ><td align=\"center\" class=\"textos\">$estado</td>
      				<td align=\"center\" class=\"textos\">$DIRECCION</td>
		 			<td align=\"center\" class=\"textos\">$DESCRIPCION_COMUNA</td>
		 			<td align=\"center\" class=\"textos\">$DESCRIPCION_COMUNA</td>
		 			<td align=\"center\" class=\"textos\">$HH:$MM</td>
		 			</tr>"; 
		 		 }
		 		 
		 		
		 		 
		 		 $lista_de_datos = "<table width=\"300\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
		 		     <tr>
		 		       <td align=\"center\" class=\"textos\">Direcci&oacute;n</td>
		 		       <td align=\"center\" class=\"textos\">Comuna/td>
		 		       <td align=\"center\" class=\"textos\">Contacto</td>
		 		       <td align=\"center\" class=\"textos\">Hora</td>
		 		       </tr>
		 		       $datos
		 		 	</table>";
      	
      	  
		 $contenido = $lista_de_datos;


		 
		 
?>