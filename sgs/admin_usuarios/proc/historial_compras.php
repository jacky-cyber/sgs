<?php

//echo "dfsdf";
$id_usuario = $_GET['id_user'];

//echo "$id_usuario";
/*
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=archivo.xls");
header("Pragma: no-cache");
header("Expires: 0");*/

  $query= "SELECT nombre, apellido   
           FROM  usuario
           WHERE id_usuario='$id_usuario'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      list($nombre_usuario,$apellido_usuario) = mysql_fetch_row($result);
						   
		 

	  $query_vta= "SELECT id_vta,estado,fecha  
               FROM  producto_vta_us
               WHERE id_usuario='$id_usuario'";
	  
 //echo $query_vta;
         $result_vta= cms_query($query_vta)or die (error($query_vta,mysql_error(),$php));
      while (list($id_vta,$estado_vta,$fechas) = mysql_fetch_row($result_vta)){
		
		//$fecha= fecha($id_vta);
		//$fecha = date(y)."-".date(m)."-".date(d);
		$fecha=date(d)."-".date(m)."-".date(y);
		
		$cont_p=0;
		$query_vta= "SELECT id_prod,cant   
           FROM  producto_vta 
           WHERE id_vta='$id_vta'";
		//echo "$query_vta<br>";
		
     $result_vta2= cms_query($query_vta)or die (error($query_vta,mysql_error(),$php));

     $valor_tot=0;
	  	$valor_unit=0;
	  	$total_vta=0;
	  	
     
     
	  while (list($id_prod,$cant) = mysql_fetch_row($result_vta2)){
			
	  	
			  $query_prod= "SELECT nombre_producto,descripcion,precio_oferta     
                       FROM  cat_productos
                       WHERE id_productos='$id_prod'";
                 $result_prod= cms_query($query_prod)or die (error($query_prod,mysql_error(),$php));
                  list($nombre_prod,$descrip,$valor_unit) = mysql_fetch_row($result_prod);
				  
				  
				  $valor_tot = $valor_unit * $cant;
				 // echo " $valor_tot = $valor_unit * $cant<br>";
				  $total_vta = $total_vta + $valor_tot;
				  $valor_unit=	number_format($valor_unit,0,",", ".");
				   $valor_tot=	number_format($valor_tot,0,",", ".");
				  
			$cont_p++;
			$tabla_vta .="<tr>
			<td align=\"center\" class=\"textos\"  bgcolor=\"#ffffff\">$cont_p</td> 
			<td align=\"left\" class=\"textos\"  bgcolor=\"#ffffff\">&nbsp;&nbsp;$nombre_prod</td>
			<td align=\"center\" class=\"textos\" bgcolor=\"#ffffff\">$cant</td> 
			<td align=\"left\" class=\"textos\" bgcolor=\"#ffffff\">$$valor_unit</td> 
			<td align=\"left\" class=\"textos\" bgcolor=\"#ffffff\">$$valor_tot</td> 
			
			</tr>";
			
						   
		 }

		 $total_vta=	number_format($total_vta,0,",", ".");
	$vta_dia = " <table bgcolor=\"#E9E9E9\" width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"1\">
                   					 <tr>
									 <td align=\"center\" class=\"textos\" bgcolor=\"#ffffff\" >Nº</td> 
									 <td align=\"center\" class=\"textos\" bgcolor=\"#ffffff\" >Producto</td>
									<td align=\"center\" class=\"textos\" bgcolor=\"#ffffff\">Cant</td> 
									<td align=\"center\" class=\"textos\" bgcolor=\"#ffffff\">Valor unit</td> 
									<td align=\"center\" class=\"textos\" bgcolor=\"#ffffff\">Valor tot</td> 
									
									</tr>
										$tabla_vta
          						  </table>
								    <table width=\"300\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                                      <tr><td align=\"center\" class=\"textos\">&nbsp;</td></tr> 
									  <tr >
                                        <td align=\"center\" class=\"textos\">Este pedido es por un total de <b>$$total_vta</b></td>
                                        </tr>
                                  	</table>";
					
			$tabla_vta="";
			
			if($estado_vta != 'fn'){
				
				
				 	
			$var="<br><br>
			<br><br>";
			
			//echo "$id_seseion";
			
		//$segir ="<a href=\"index.php?id_usuario=$id_usuario&accion=$accion&act=15&id_vta=$id_vta\">
			$segir ="<a href=\"#\" onclick=\"ObtenerDatos('index.php?accion=$accion&act=14&id_vta=$id_vta&axj=1','contenido');\">
				<font color=\"#0066FF\">Seguir con esta compra</font> 
				<img src=\"images/shopcart.gif\" alt=\"\" border=\"0\"></a>";
			}else{
				
				$var="<br><br>
			<br><br>";
			//echo "index.php?id_usuario=$id_usuario&accion=$accion&id_vta=$id_vta<br>";	
			
			$segir ="Pedido finalizado";
			}
			//$nombre_usuario = nombre($id_sesion);
			//echo "index.php?accion=$accion&act=14&id_vta=$id_vta&axj=1','contenido<br>";
			
			$fechas= fechas_html($fechas);
		//echo $fecha;
			
			$vta .= " $var
			 			
			<table width=\"80%\" border=\"0\" cellspacing=\"0\" cellpadding=\"4\">
    <tr>
    <td>
      <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
        <tr>
          <td>
            <table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
              <tr>
                <td align=\"left\"  class=\"textos\" height=\"30\"><b>
				
				$segir</b>
				
				</td>
                <td align=\"right\" class=\"textos\">Fecha :$fechas</td>
              </tr>
            </table>
          </td>
        </tr>
		<tr><td align=\"center\" class=\"textos\" height=\"5\"></td>
		</tr> 
        <tr>
          <td>
		  $vta_dia
		  
		  </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
  <table width=\"300\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
    <tr >
      <td align=\"center\" class=\"textos\">&nbsp;</td>
      </tr>
	</table>
	  <table width=\"300\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
        <tr >
          <td align=\"center\" class=\"textos\">
		  
		  </td>
          </tr>
    	</table>";
						   
		 }

		$modulo_usuarios  .= "<br><br><table width=\"90%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
			    <tr>
			      <td align=\"center\" class=\"textos\"><b>Historial de tus compras pendientes y finalizadas por $nombre_usuario $apellido_usuario</b></td>
			      </tr>
				</table>".$vta; 
		//echo "$contenido";
?>