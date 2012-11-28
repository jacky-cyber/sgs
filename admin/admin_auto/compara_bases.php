<?php


		  

$base_compara = $_POST['base_compara'];



if($base_compara==""){
$base_compara=  $_GET['bd'];
}



$db_list = mysql_list_dbs($DB);

while ($db = mysql_fetch_object($db_list))
  {
  
 $base = $db->Database;
  	if($base==$base_compara){
	$lista_bases .=  "<option value=\"$base\" selected>$base</option><br />";
	}else{
	$lista_bases .=  "<option value=\"$base\">$base</option><br />";
	}
  
  }


  
$contenido_base = "<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                <tr>
                  <td align=\"center\" class=\"textos\">Nombre de base de datos a comparar con $DATABASE :</td>
                </tr>
				<tr><td align=\"center\" class=\"textos\">
				 <select name=\"base_compara\" id=\"base_compara\">
  						$lista_bases
  
  				</select>
				 </td></tr> 
				<tr><td align=\"center\" class=\"textos\"><input type=\"submit\" name=\"Submit\" value=\"Comparar\"> </td></tr> 
              <tr><td align=\"center\" class=\"textos\">&nbsp; </td></tr> 
			  </table>";



function campos_tabla_bd($tabla){

			
			global $base_compara;
			global $HOST_NAME;
			global $DB_USERNAME;
			global $DB_PASSWORD;
			global $DATABASE;
			
			$DB2 = mysql_connect($HOST_NAME, $DB_USERNAME, $DB_PASSWORD) ;	
			mysql_select_db($DATABASE, $DB2);
			
			 $sql2 = "SELECT * FROM $base_compara.$tabla";
  		 	 $qry2 = cms_query($sql2,$DB2);
  		 	 $num_campos2 = mysql_num_fields($qry2);
			
			//mysql_close();
			
	return 	$num_campos2;	
}



//$DB = mysql_connect($HOST_NAME, $DB_USERNAME, $DB_PASSWORD) ;	
if($base_compara==""){
$contenido = "$contenido_base";



}elseif($DATABASE!=$base_compara){

$sql = "SHOW TABLES FROM $DATABASE";
$result_lista_tablas1 = cms_query($sql);

//$tot_tablas1 = mysql_list_tables( $DATABASE,$DB);

//$tablas_base1= mysql_num_rows($result_lista_tablas1);


while( $line = mysql_fetch_row($result_lista_tablas1)){

	$tablas_base1++;
	$arreglo_tablas1[$tablas_base1] =$line[0];
	
		
}





$sql = "SHOW TABLES FROM $base_compara";
$result_lista_tablas = cms_query($sql);

//$tot_tablas2 = mysql_list_tables($base_compara,$DB);

while( $line = mysql_fetch_row($result_lista_tablas)){

	$tablas_base2++;
	$arreglo_tablas2[$tablas_base2] =$line[0];
	
		
}

//existe_en_los_dos($arreglo_tablas1, $arreglo_tablas2);
//$lista_tablas1 = solo_en_arreglo1($arreglo_tablas1, $arreglo_tablas2);

foreach ($arreglo_tablas1 as $value1) {
    $encontrado=false;
    foreach ($arreglo_tablas2 as $value2) {
        if ($value1 == $value2){
            $encontrado=true;
            $break;
        }
    }
    if ($encontrado == false){
          $lista_tablas1 .="<tr style=\"background-color: #EBEBEB;\" onmouseover=\"this.style.backgroundColor='#EEF8FD'\" onmouseout=\"this.style.backgroundColor='#EBEBEB'\">
		  <td align=\"left\" class=\"textos\">
		  <a href=\"#\"  onclick=\"ObtenerDatos('index.php?accion=$accion&act=12&bdo=$DATABASE&bdd=$base_compara&tabla=$value1&axj=1','contenido_tabla');\">$value1</a></td></tr> " ;
    }
}



//$lista_tablas2 = solo_en_arreglo2($arreglo_tablas1, $arreglo_tablas2);

foreach ($arreglo_tablas2 as $value2) {
    $encontrado=false;
    foreach ($arreglo_tablas1 as $value1) {
        if ($value1 == $value2){
            $encontrado=true;
            $break;
        }
    }
    if ($encontrado == false){
          $lista_tablas2 .="<tr style=\"background-color: #EEF8FD;\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#EEF8FD'\">
		  <td align=\"left\" class=\"textos\">
		  <a href=\"#\"  onclick=\"ObtenerDatos('index.php?accion=$accion&act=12&bdo=$base_compara&bdd=$DATABASE&tabla=$value2&axj=1','contenido_tabla');\">$value2</a></td></tr> ";
    }
}





$sql = "SHOW TABLES FROM $base_compara";
$result_lista_tablas = cms_query($sql);


 //$tables = mysql_list_tables( $base_compara,$DB);					//conexion con la base de datos
		 
		while( $line = mysql_fetch_row($result_lista_tablas)){
		$cont++;
		
		$tbla= $line[0];

		 $sql = "SELECT * FROM $tbla";
  		 $qry = cms_query($sql);
  		 $num_campos = mysql_num_fields($qry);
		 $num_reg1 = mysql_num_rows($qry);
			
			 //$tbla2_rel="";
			/*******************************************/
			$DB2 = mysql_connect($HOST_NAME, $DB_USERNAME, $DB_PASSWORD) ;	
			mysql_select_db($DATABASE, $DB2);
			
			 $sql2 = "SELECT * FROM $base_compara.$tbla";
  		 	 $qry2 = cms_query($sql2,$DB2);
  		 	 $num_campos2 = mysql_num_fields($qry2);
			 $num_reg2 = mysql_num_rows($qry2);
			
			//$num_campos2= campos_tabla_bd($tbla);
			
			/**/
			//mysql_close($DB);
			if($num_reg1!=$num_reg2){
			$estilos_reg_dif="border: 1px; border-style: solid; border-color: #F00;";
			}else{
			$estilos_reg_dif="";
			}
			
			if($num_campos2!=$num_campos){
			$lista_tablas .="<tr style=\"background-color: #FFC69F;\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#FFC69F'\">
				
				  <td align=\"left\" class=\"textos\" >$tbla</td>
				  <td align=\"center\" class=\"textos\" style=\" $estilos_reg_dif\">$num_campos</td>
				  <td align=\"center\" class=\"textos\" style=\" $estilos_reg_dif\">$num_reg1</td>  
				  <td align=\"center\" class=\"textos\" style=\" $estilos_reg_dif\">$num_campos2 </td> 
				  <td align=\"center\" class=\"textos\" style=\" $estilos_reg_dif\">$num_reg2</td>  
				  <td align=\"center\" class=\"textos\" >
				  <a href=\"index.php?accion=$accion&act=9&tbl=$tbla&bd=$base_compara\">
				  <img src=\"images/history.gif\" alt=\"\" border=\"0\"></a></td> 
				  </tr> ";
			}else{
			
			
			$lista_tablas .="<tr style=\"background-color: #F8F8F8; \" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">
				  
				  <td align=\"left\" class=\"textos\">$tbla</td>
				   <td align=\"center\" class=\"textos\" style=\"background-color: #EBEBEB; $estilos_reg_dif\">$num_campos </td>
				  <td align=\"center\" class=\"textos\" style=\"background-color: #EBEBEB; $estilos_reg_dif\">$num_reg1</td>  
				  <td align=\"center\" class=\"textos\" style=\"background-color: #EAF9FF; $estilos_reg_dif \">$num_campos2 </td> 
				  <td align=\"center\" class=\"textos\" style=\"background-color: #EAF9FF; $estilos_reg_dif\">$num_reg2</td>  
				  <td align=\"center\" class=\"textos\">
				  <a href=\"index.php?accion=$accion&act=9&tbl=$tbla&bd=$base_compara\">
				  <img src=\"images/history.gif\" alt=\"\" border=\"0\"></a></td>
				  </tr> ";
		
				  }
		
			
			}



$contenido = "  <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\" >
					      	<tr><td align=\"center\" class=\"textos\">$contenido_base 
							</td></tr> 
							<tr><td align=\"center\" class=\"textos\">
							Lista de tablas faltantes en cada base de datos </td></tr> 
                   
							 <tr>
					 <td align=\"center\" >
				  <div id=\"contenido_tabla\"></div>
				   </td></tr> 
				   		<tr  > 
							<td align=\"center\" class=\"textos\" >
				  
				    <table width=\"90%\"  border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\"  >
                      <tr >
                        <td align=\"center\"  valign=\"top\" width=\"50%\" class=\"textos\" style=\"background-color: #EBEBEB;\">
						  <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                            <tr>
                              <td align=\"center\" class=\"textos\">$tablas_base1 Tablas en BD<strong>$DATABASE</strong> </td>
                              </tr>
							  $lista_tablas1
                        	</table>
						
						</td>
						<td align=\"center\" valign=\"top\" width=\"50%\" class=\"textos\" style=\"background-color: #EAF9FF;\" >
						  <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" >
                            <tr>
                              <td align=\"center\" class=\"textos\">
							  $tablas_base2 tablas en BD <strong>$base_compara</strong> 
							  </td>
                              </tr>
							  $lista_tablas2
                        	</table>
						
						</td> 
                        </tr>
                  	</table>
				   </td></tr>
				    
				   <tr><td align=\"center\" class=\"textos\">&nbsp; </td></tr> 
					<tr><td align=\"center\" class=\"textos\">Lista de tablas presentes en ambas Bases de Datos</td></tr> 
							<tr><td align=\"center\" class=\"textos\">
							<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\">
					<tr  >
				  
				  <td align=\"left\" class=\"textos\"></td>
				  <td align=\"center\" class=\"textos\" colspan=\"2\" style=\"background-color: #EBEBEB;\">BD $DATABASE</td> 
				 
				 <td align=\"center\" class=\"textos\" colspan=\"2\" style=\"background-color: #EAF9FF;\">BD $base_compara</td> 
				
				    <td align=\"center\" class=\"textos\"></td> 
				 
				  </tr>		
		<tr style=\"background-color: rgb(248, 248, 248);\"  >
				  
				  <td align=\"left\" class=\"textos\">Tabla</td>
				  <td align=\"center\" class=\"textos\" style=\"background-color: #EBEBEB;\">campos</td> 
				  <td align=\"center\" class=\"textos\" style=\"background-color: #EBEBEB;\">registros</td> 
				 <td align=\"center\" class=\"textos\" style=\"background-color: #EAF9FF;\">campos</td> 
				 <td align=\"center\" class=\"textos\" style=\"background-color: #EAF9FF;\">registros</td> 
				    <td align=\"center\" class=\"textos\">&nbsp</td> 
				 
				  </tr>
				
				
                      $lista_tablas 
                     
                      </table>
							
							 </td></tr>
					  
                      	</table>";  
}else{

$contenido = "<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                <tr>
                  <td align=\"center\" class=\"textos\">Nombre de base de datos a comparar con $DATABASE : 
				  <input type=\"text\" name=\"base_compara\" id=\"base_compara\" value=\"\"></td>
                </tr>
				<tr><td align=\"center\" class=\"textos\">
				<input type=\"submit\" name=\"Submit\" value=\"Comparar\"> </td></tr> 
				<tr><td align=\"center\" class=\"textos\"> &nbsp;</td></tr> 
				<tr><td align=\"center\" class=\"textos\">
				  <table width=\"300\" class=\"tabla_rojo\" border=\"0\" align=\"center\" cellpadding=\"3\" cellspacing=\"3\">
                    <tr >
                      <td align=\"center\" class=\"textos\">
					  <h3>La tabla a comparar debe ser distinta a la que tiene configurada el sistema.</h3>
					  </td>
                      </tr>
                	</table>
				 </td></tr> 
				 <tr><td align=\"center\" class=\"textos\">$contenido_base </td></tr> 
          
              </table>";
}

		

?>