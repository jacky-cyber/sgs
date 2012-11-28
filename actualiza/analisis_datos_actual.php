<?php



$tot_ok=1;
$aux=explode(",", $tablas_verifica);

 for( $i = 0; $i < count($aux); $i ++)
    {
     $tabla_compara =  $aux[$i];
     
	   $tablas = mysql_list_tables($DATABASE)or die (mysql_error()); 
		$tabla_ok = 0;
         while (list($tabla) = mysql_fetch_array($tablas) ) { 
             if ($tabla_compara == $tabla){ 
               // 
			  // if($tabla_compara=="")
			   $tabla_ok = 1;
             } 
			// 
         }
	   	if($tabla_ok==1){
		
		   $query= "SELECT count(*)     
                   FROM  $DATABASE.$tabla_compara";
			 $result= mysql_query($query);
			 list($tot_reg) = mysql_fetch_row($result);
			 
			  
			 
			 //echo $query."<br>";
				  
		
		$anals .=  "<tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">
					    <td align=\"Left\" class=\"textos\" >$tabla_compara</td>
						<td align=\"left\" class=\"textos\"  title=\"Esta tabla contiene $tot_reg Registros\">$tot_reg </td> 
						<td align=\"center\" class=\"textos\"><img src=\"images/ok2.gif\" alt=\"\"></td> </tr>  ";
						
		}else{
		$anals .= "<tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">
						<td align=\"Left\" class=\"textos\"><strong>$tabla_compara</strong> </td>
						<td align=\"center\" class=\"textos\">&nbsp</td> 
						<td align=\"right\" class=\"textos\"><font color=\"#FF0000\">NO existe</font> </td> </tr>  
						";
						
		$tot_ok = 0;
					
		}
		
    }
	
	
		


		
	
	//////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	
	$tabla_cms_conf=0;
		$tablas = mysql_list_tables($base_compara)or die (mysql_error()); 
		 
         while (list($tabla) = mysql_fetch_array($tablas) ) { 
             if ($tabla=="cms_configuracion"){ 
			
               $tabla_cms_conf = 1;
             } 
			}
		//echo $tabla." -- $tabla_cms_conf cfdff<br>";	 
if($tabla_cms_conf==1){
	
$tot_ok=1;
$aux=explode(",", $variables_sistema);

 for( $i = 0; $i < count($aux); $i ++)
    {
      $datos_compara =  $aux[$i];
	  $tabla_cms_conf=0;
    // echo "$tabla_compara  dfdfd $lista_variables <br>";
	
	   $nombre_var =  str_replace("id_","",$datos_compara);
	   $nombre_var =  str_replace("_"," ",$nombre_var);
	   $nombre_var = ucwords($nombre_var);
		if($datos_compara!=""){
		   $query= "SELECT id_configuracion,valor,descripcion     
                   FROM  $DATABASE.cms_configuracion
                   WHERE configuracion='$datos_compara'";
				  
				       $result= mysql_query($query);
             			 if (list($id_configuracion,$valor,$descripcion) = @mysql_fetch_row($result)){
        					$existe_uno=1;
							
							$lista_variables .="<tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">
											<td align=\"left\" class=\"textos\" >$nombre_var </td>
											<td align=\"left\" class=\"textos\">$valor
											<a href=\"index.php?accion=$accion&id_var=$id_configuracion&width=320&axj=1\" class=\"jTip\" id=\"ficha_278\" name=\"$valor\">
											<img src=\"images/help.gif\" alt=\"\" border=\"0\"></a>
											</td>
										</tr> ";
						  }else{
						  $lista_variables .="<tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">
											<td align=\"left\" class=\"textos\" title=\"Puede buscar est&aacute; variable en modulo Configuraci&oacute;n Sistema, variable $datos_compara\">$nombre_var</td>
											<td align=\"left\" class=\"textos\"><font color=\"#FF0000\">
											No existe</font> </td>
										</tr> ";
							$valor_no_existe=1;
						  }
		}					
	  
		
    }	
	
						
}else{
   $lista_variables .="<tr><td align=\"center\" class=\"textos\" colspan=\"3\">
   <font color=\"#FF0000\">No existe la tabla \"cms_configuracion\" <br>$error</font> </td></tr> ";
}
//echo " ererere rrrr $lista_variables";

////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
		
		$datos_actual =  "<table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\">
						<tr><td align=\"center\" class=\"textos\" colspan=\"3\"><strong>An&aacute;lisis de tablas de Base de Datos</strong></td></tr> 
                      	<tr>
							<td align=\"center\" class=\"textos\">Tabla</td>
							<td align=\"center\" class=\"textos\">Registros en $base_compara</td>
							<td align=\"center\" class=\"textos\">Estado</td>
						</tr> 
						$anals
						<tr><td align=\"center\" class=\"textos\" colspan=\"3\"> &nbsp;</td></tr> 
						<!--    <tr><td align=\"center\" class=\"textos\" colspan=\"3\"><strong>An&aacute;lisis de Configuraci&oacute;n de Correo</strong></td></tr> 
						 -->$anals_archiv
						<tr><td align=\"center\" class=\"textos\" colspan=\"3\">&nbsp; </td></tr> 
						 <tr><td align=\"center\" class=\"textos\" colspan=\"3\"><strong>An&aacute;lisis de Variables de Sistema</strong></td></tr> 
						 $lista_variables
						  
						   $link_actualiza
                      </table>";

?>