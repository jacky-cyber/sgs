<?php
	
	$fp=fopen("actualiza/estructura.txt","r");
    while ($linea=fgets($fp,5000) and $error==0)
          {
		 
		  $linea=trim($linea);
		    if(cms_query($linea)){
		   		$cont_tablas++;
		    }
		  
		  }
	
	$fp=fopen("actualiza/tablas.txt","r");
    
     $error=0;
    
    while ($linea=fgets($fp,5000) and $error==0)
          {
		  $caracteres_lines = strlen($linea);
          $aux=explode(",", $linea);
    
          $tabla    = trim($aux[0]);
          $num_campos    = trim($aux[1]);
    	  
		  $sql = "SELECT * FROM $tabla  LIMIT 0,1" ;
  			if($qry = cms_query($sql)){
			 $num_filas = mysql_num_fields($qry);
			
		 		if($num_filas!=$num_campos){
					$diferencia = $num_campos - $num_filas;
					$a=0;
					$b=2;
						while($a<$num_campos){
							$campo_txt_aux = trim($aux[$b]);
		 					$aux3=explode("#", $campo_txt_aux);
							$campo_txt =  trim($aux3[0]);
							$tipo_campo_txt =  trim($aux3[1]);
							$a++;
							$b++;
			
								$cont_a=0;
								$campo_ok="ok";
											while ($cont_a<$num_filas){
			
												$nom_campo = mysql_field_name($qry,$cont_a);	
												$tipo      = mysql_field_type($qry,$cont_a);
																		if($campo_txt==$nom_campo){
																					$campo_ok="no";
																					}
												$cont_a++;
												}
			
							if($campo_ok=="ok"){
							$alter =alter($tabla,$campo_txt,$tipo_campo_txt);
							$campos2 .="$campo_txt , ";
							cms_query($alter);
			
							}
		 
		  				  }
		  			$campos2 = elimina_ultimo_caracter($campos2);
					$lista_campos .="<tr><td class=\"textos\"  align=\"left\" class=\"textos\" title=\"Se agregaron los sig campos $campos2\" >Tabla \"$tabla\" tiene una diferencia de $diferencia campos, Tabla actualizada.</td></tr> ";
		 
		 		}
			}
		 
		
		 if($error==0){

			$tablas_totales= $cont_tablas-$tablas_actuales;
   			
			$contenido = "  <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\" class=\"tabla_verde\">
                              	<tr><td class=\"textos\"  align=\"center\" class=\"textos\"><h3>Estructura de datos actualizada, ahora solo falta actualizar algunos datos de la Base de datos 
								 </h3></td></tr> 
								 <tr><td align=\"center\" class=\"textos\">Tablas totales finales despues de la actualizaci&oacute;n de estructura $cont_tablas </td></tr>
								 <tr><td class=\"textos\"  align=\"center\" class=\"textos\">Desea actualizar la base de datos<br><br></td></tr> 
								 <tr><td class=\"textos\"  align=\"left\" class=\"textos\"> 
								   <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                                     <tr >
                                       <td class=\"textos\"  align=\"center\">
									   <a href=\"#\"  onclick=\"ObtenerDatos('index.php?accion=$accion&act=2&axj=1','contenido3');\"><div id=\"boton\">SI</div></a></td>
                                       <td class=\"textos\"  align=\"center\">
									   <a href=\"index.php\"><div id=\"boton2\">NO</div></a>
									   </td>
                                       </tr>
                                 	</table>
								 </td></tr> 
								 <tr><td  align=\"center\" class=\"textos\">Esto es opcional si lo desea puede actualizar 
								 manualmente la base de datos, tomando la informaci&oacute;n del archivo 
								 <a href=\"insert.sql\">insert.sql</a><br><br>
								 </td></tr>
								 
								 $lista_actualizacion
								$lista_campos
								 
                          	</table><br><div id=\"contenido3\"></div>";
 			 }else{
			 
			 $contenido = "<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\" class=\"tabla_amarillo\">
                    <tr>
                      <td align=\"center\" class=\"textos\">no se ha ejecutado la actualizaci&oacute;n 
					  de los datos de la tabla, verifique la instalaci&oacute;n e intente nuevamente</td>
                    </tr>
                  </table>";
			 
			 }
			 
		}	
				  	   
			
		

?>