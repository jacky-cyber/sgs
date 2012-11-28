<?php



//$fp=fopen("mail_xerox_glotia.txt","r");



$tot_ok=1;
$aux=explode(",", $tablas_verifica);

 for( $i = 0; $i < count($aux); $i ++)
    {
     $tabla_compara =  $aux[$i];
     
	   $tablas = mysql_list_tables($base_compara)or die (mysql_error()); 
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
                   FROM  $base_compara.$tabla_compara";
			 $result= mysql_query($query);
			 list($tot_reg) = mysql_fetch_row($result);
			 
			  
			 
			 //echo $query."<br>";
				  
		
		$anals .=  "<tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">
					    <td align=\"Left\" class=\"textos\" >$tabla_compara</td>
						<td align=\"center\" class=\"textos\"  title=\"Esta tabla contiene $tot_reg Registros\">$tot_reg </td> 
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
	
	
		
	/////////////////////////////////////////////////////////////////////////////////////////////////////	
		/*
		if(!is_file("lib/correos.inc.php")){
		
		$tot_ok = 0;
		$anals_archiv .="<tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">
		<td align=\"center\" class=\"textos\" colspan=\"3\">
		<font color=\"#FF0000\">No existe el archivo \"lib/correos.inc.php\" puede ser exportado desde la instalaci&oacute;n anterior de Sgs, copielo en la carpeta \"lib\"</font> </td></tr> ";
		}else{
		
		$anals_archiv .="<tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">
		<td align=\"center\" class=\"textos\" colspan=\"3\">
		Existe el archivo \"lib/correos.inc.php\" <img src=\"images/ok2.gif\" alt=\"\"></td></tr> ";
		
		}
		*/
		
		if($tot_ok==1){
			$link_actualiza="<tr>
			<td align=\"center\" class=\"textos\" colspan=\"3\">
			<h3>Clickee el &iacute;cono para ejecutar la Actualizaci&oacute;n</h3> 
			<button name=\"boton\" type=\"button\" onclick=\"actualiza_datos('index.php?accion=$accion&act=3&axj=1');\">
			<img src=\"images/dw.jpg\" alt=\"\" style=\"cursor: pointer;  cursor: hand;\" border=\"0\">
			</button>
			</td></tr>  ";		
		}else{
			$link_actualiza="<tr><td align=\"center\" class=\"textos\" colspan=\"3\">
			<font color=\"#FF0000\"><h3>No es posible realizar la actualizaci&oacute;n</h3></font>  </td></tr> ";		
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
      $datos_compara =  trim($aux[$i]);
	  $tabla_cms_conf=0;
    // echo "$tabla_compara  dfdfd $lista_variables <br>";
	
	   $nombre_var =  str_replace("id_","",$datos_compara);
	   $nombre_var =  str_replace("_"," ",$nombre_var);
	   $nombre_var = ucwords($nombre_var);
		if($datos_compara!=""){
		   $query= "SELECT id_configuracion,valor,descripcion     
                   FROM  $base_compara.cms_configuracion
                   WHERE configuracion='$datos_compara'";
				  
				       $result= mysql_query($query);
             			 if (list($id_configuracion,$valor,$descripcion) = @mysql_fetch_row($result)){
        					$existe_uno=1;
							
							$lista_variables .="<tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">
											<td align=\"left\" valign=\"top\" class=\"textos\" title=\" Puede buscar est&aacute; variable en modulo Configuraci&oacute;n Sistema, variable $datos_compara \">$nombre_var</td>
											<td align=\"left\" valign=\"top\" class=\"textos\" colspan=\"2\">
											<input type=\"text\" name=\"$datos_compara\" id=\"$datos_compara\" value=\"$valor\" size=\"45\">
											$descripcion
											</td>
										</tr> ";
						  }else{
						   
						   /*
						   * Select tabla cms_configuracion
						   * 
						   */
						  $query= "SELECT descripcion,valor  
							     FROM  $DATABASE.cms_configuracion
							     WHERE configuracion = '$datos_compara'";
								
						       $result_cms_configuracion= cms_query($query)or die (error($query,mysql_error(),$php));
							list($descripcion,$valor) = mysql_fetch_row($result_cms_configuracion);
							
						   /** fin select cms_configuracion***/
						  $lista_variables .="<tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">
											<td align=\"left\" valign=\"top\"  class=\"textos\" title=\" Puede buscar est&aacute; variable en modulo Configuraci&oacute;n Sistema, variable $datos_compara\">$nombre_var</td>
											<td align=\"left\" valign=\"top\" class=\"textos\" colspan=\"2\">
											<input type=\"text\" name=\"$datos_compara\" id=\"$datos_compara\" value=\"$valor\" size=\"45\">
											$descripcion
											</td>
										</tr> ";
							$valor_no_existe=1;
						  }
		}					
	  
		
    }	
	if($lista_variables!="" and $valor_no_existe==0){
	$lista_variables .= "<tr><td align=\"center\" class=\"textos\" colspan=\"3\"><strong>Usar estos valores de configuraci&oacute;n para actualizar <input type=\"checkbox\" name=\"valor_ant\" id=\"valor_ant\" value=\"1\" checked></strong></td></tr>
	<tr><td align=\"center\" class=\"textos\" colspan=\"3\"><strong>Deshabilitar usuarios TEST <input type=\"checkbox\" name=\"user_def\" id=\"user_def\" value=\"1\" ></strong></td></tr>";
	
	}else{
		if($existe_uno==1){
		$lista_variables .= "<tr><td align=\"center\" class=\"textos\" colspan=\"3\"><strong>Usar estos valores de configuraci&oacute;n para actualizar<input type=\"checkbox\" name=\"valor_ant\" id=\"valor_ant\" value=\"1\" checked><br>
		<font color=\"#FF0000\">Las variables no existentes deben ser llenadas manualmente</font></strong></td></tr>";
	
		}else{
		$lista_variables .= "<tr><td align=\"center\" class=\"textos\" colspan=\"3\">
		<font color=\"#FF0000\">Las variables no existentes deben ser llenadas manualmente</font><br>
		Puede buscar estas variables en modulo <a href=\"index.php?accion=Configuracion-Sistema\"><strong>Configuraci&oacute;n Sistema</strong></a></strong></td></tr>";
	
		}
	
	}
						
}else{
   $lista_variables .="<tr><td align=\"center\" class=\"textos\" colspan=\"3\">
   <font color=\"#FF0000\">No existe la tabla \"cms_configuracion\" <br>$error</font> </td></tr> ";
}
//echo " ererere rrrr $lista_variables";

////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		
$query= "SELECT descripcion,valor  
	 FROM  $DATABASE.cms_configuracion
	 WHERE configuracion = 'verifica permisos carpetas'";
								
$result_cms_configuracion= cms_query($query)or die (error($query,mysql_error(),$php));
list($descripcion,$carpetas_verifica_permisos) = mysql_fetch_row($result_cms_configuracion);
							
				      
$aux3=explode(",", $carpetas_verifica_permisos);
$i=0;
 for( $i = 0; $i < count($aux3); $i ++)
    {
      $carpeta_permisos =  trim($aux3[$i]);
      $carpeta_permisos_aux=explode("#", $carpeta_permisos);
      $carpeta = $carpeta_permisos_aux[0];
      $permisos_necesarios=$carpeta_permisos_aux[1];
      $permiso = substr(decoct( fileperms ($carpeta) ), 2);
      if($permiso==$permisos_necesarios){
	       $lista_carpetas .=  "<tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">
				       <td align=\"left\" class=\"textos\" >$carpeta </td>
				  <td align=\"center\" class=\"textos\" ><img src=\"images/ok2.gif\" alt=\"Permisos $permiso\">
				  </td> </tr>  ";
      }else{
	$lista_carpetas .=  "<tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">
			    <td align=\"left\" class=\"textos\" >$carpeta </td>
			    <td align=\"center\" class=\"textos\" ><img src=\"images/atencion_pequenia.gif\" alt=\"Necesita Permisos $permisos_necesarios\">
			    Necesita Permisos $permisos_necesarios
				  </td>
			     </tr>  ";
      }
      
    }
    
    if($lista_carpetas!=""){
     
     $lista_de_permisos_archivos= "<table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\" class=\"cuadro_light\">
				     <tr><td align=\"center\" class=\"textos\" colspan=\"2\">
				     <img src=\"images/ordenar.gif\" alt=\"\" border=\"0\">
				     <Strong>Lista de Carpetas con necesidad de permisos especiales</strong> </td></tr> 				   
				     $lista_carpetas
				  </table>";
     
    }
	
			
		$contenido = "<table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\">
						<tr><td align=\"center\" class=\"textos\" colspan=\"3\"> <img src=\"images/b_tblimport.png\" alt=\"\" border=\"0\"><strong>An&aacute;lisis de tablas de Base de Datos</strong>
												
						</td></tr> 
                      	<tr>
							<td align=\"center\" class=\"textos\">Tabla</td>
							<td align=\"center\" class=\"textos\">Registros en $base_compara</td>
							<td align=\"center\" class=\"textos\">Estado</td>
						</tr> 
						$anals
						<tr><td align=\"center\" class=\"textos\" colspan=\"3\">&nbsp; </td></tr> 
						
						<tr><td align=\"center\" class=\"textos\" colspan=\"3\">
						
						$lista_de_permisos_archivos</td></tr> 
						<tr><td align=\"center\" class=\"textos\" colspan=\"3\"> &nbsp;</td></tr> 
						<!--    <tr><td align=\"center\" class=\"textos\" colspan=\"3\"><strong>An&aacute;lisis de Configuraci&oacute;n de Correo</strong></td></tr> 
						 -->$anals_archiv
						<tr><td align=\"center\" class=\"textos\" colspan=\"3\">&nbsp; </td></tr> 
						 <tr><td align=\"center\" class=\"textos\" colspan=\"3\"><strong>An&aacute;lisis de Variables de Sistema</strong></td></tr> 
						 $lista_variables
						  
						   $link_actualiza
                      </table>";


	      
		      
		 
		//$contenido .=$carpetas_verifica_permisos;

?>