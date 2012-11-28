<?php

//echo "-- $tabla txt - $num_campos   tabla - $num_filas<br>";
		$diferencia = $num_campos - $num_filas;
		//$cont_campos_tabla=2;
		$a=0;
		$b=2;
		while($a<$num_campos){
		$campo_txt_aux = trim($aux[$b]);
		 $aux3=explode("#", $campo_txt_aux);
		$campo_txt =  trim($aux3[0]);
		$tipo_campo_txt =  trim($aux3[1]);
		//echo "$a $campo_txt <br>";
		$a++;
		$b++;
			
			$cont_a=0;
			$campo_ok="ok";
			while ($cont_a<$num_filas){
			
				$nom_campo = mysql_field_name($qry,$cont_a);	
				$tipo      = mysql_field_type($qry,$cont_a);
				//echo "&nbsp;&nbsp;&nbsp;&nbsp; $campo_txt --> $nom_campo<br>";
				if($campo_txt==$nom_campo){
					$campo_ok="no";
				}
				$cont_a++;
			}
			
			if($campo_ok=="ok"){
			//echo "-------Campo creado $campo_txt $tipo<br>";
			$alter =alter($tabla,$campo_txt,$tipo_campo_txt);
			$campos2 .="$campo_txt , ";

 				cms_query($alter);
			
			}
		 	//echo "<br><br><br>";
		
		  }
		  $campos2 = elimina_ultimo_caracter($campos2);
		$lista_campos .="<tr><td class=\"textos\"  align=\"left\" class=\"textos\" title=\"Se agregaron los sig campos $campos2\" >Tabla \"$tabla\" tiene una diferencia de $diferencia campos, Tabla actualizada.</td></tr> ";
		 

?>