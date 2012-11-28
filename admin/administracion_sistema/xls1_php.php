<?php

  $query= "SELECT count(*)   
           FROM  auto_admin_campo
           WHERE id_auto_admin='$id_auto_admin'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      list($cant_cam) = mysql_fetch_row($result);

      while ($cant_cam>$a){
			$a++;
					
			$lista_reg .="$valor \t";
			
		}
		

	$tabla= tabla($id_tabla);
	
	
	  $query= "SELECT count(*)   
	           FROM  $tabla";
	     $result2= cms_query($query)or die (error($query,mysql_error(),$php));
	      list($cant_reg) = mysql_fetch_row($result2);
	     
	      
	      	       
	  $query= "SELECT $campos
	           FROM  $tabla'";
	     $result3= cms_query($query)or die (error($query,mysql_error(),$php));
	            while ($cant_reg>$cta_linea){
	      		$cta_linea++;
	         		while ($cat_cam>$columnas){
	         			$columnas++;
	         			
	         			
	         			$valor .= @mysql_result($result3,$cta_linea,$columnas);
	         			
	         		}
	            		

?>