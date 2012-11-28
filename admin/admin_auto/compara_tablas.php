<?php

$tbl = $_GET['tbl'];
$base_compara = $_GET['bd'];





 $sql = "SELECT * FROM $tbl";
  $qry = cms_query($sql);
   $num_filas = mysql_num_fields($qry);		 		
    $num_registro1 = mysql_num_rows($qry);
 for ($i = 0; $i < $num_filas; $i++){			//el num_filas cuenta la cantidad de campos que tiene una tabla 
      $nom_campo = mysql_field_name($qry,$i);		//y luego va sacando los datos que hay en cada campo
	  $flag      = mysql_field_flags($qry,$i);
	  $largo     = mysql_field_len($qry,$i);
	  $tipo      = mysql_field_type($qry,$i);

	  $not_null     = substr_count ($flag, "not_null");
	  $auto_inc     = substr_count ($flag, "auto_increment");
	  $campo_id     = substr_count ($nom_campo, "id_");
	 
	 $var= "campo_$nom_campo";
	 $$var=1;
	 $campo_local .="<tr style=\"background-color: rgb(248, 248, 248);\" >
	 				<td align=\"left\" class=\"textos\" height=\"25\" width=\"200\">$nom_campo</td>
	 				<!--     <td align=\"left\" class=\"textos\">$flag</td> 
					<td align=\"center\" class=\"textos\">$tipo</td> -->
					 <!--<td align=\"center\" class=\"textos\">
					 
					 <a href=\"index.php?accion=$accion&act=11&tbl=$tbl&campo=$nom_campo&bd_org=$DATABASE&bd_des=$base_compara\">
                      <img src=\"images/x.gif\" alt=\"\" border=\"0\">
                      </a>
					
					 </td> -->
					  <td align=\"center\" class=\"textos\">
					 <a href=\"index.php?accion=$accion&act=10&tbl=$tbl&campo=$nom_campo&bd_org=$DATABASE&bd_des=$base_compara\">
                      <img src=\"images/right.gif\" alt=\"\" border=\"0\">
                      </a></td>
					    </tr> ";
	 
	}

	
	

$tabla_campo_local = "  <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\" class=\"cuadro_light\">
                         <tr style=\"background-color: rgb(248, 248, 248);\">
						 <td align=\"left\" class=\"textos\">Campo</td>
	 				<!-- <td align=\"left\" class=\"textos\">Flag</td> 
					<td align=\"center\" class=\"textos\">Tipo</td> 
					 <td align=\"center\" class=\"textos\"></td> -->
					 <td align=\"center\" class=\"textos\"></td> 
					 </tr>
                      	$campo_local
						</table>";
	
			

//$DB2 = mysql_connect($HOST_NAME, $DB_USERNAME, $DB_PASSWORD) ;	
//$DB2 = mysql_connect('localhost', 'root', '')or die (mysql_error()) ;	

//mysql_select_db($base_compara, $DB)or die (mysql_error());
			
 $sql = "SELECT * FROM $base_compara.$tbl";
  $qry = cms_query($sql);
   $num_filas = mysql_num_fields($qry);		 		
   $num_registro2 = mysql_num_rows($qry);		 		

 for ($i = 0; $i < $num_filas; $i++){			//el num_filas cuenta la cantidad de campos que tiene una tabla 
   $nom_campo = mysql_field_name($qry,$i);		//y luego va sacando los datos que hay en cada campo
	$flag      = mysql_field_flags($qry,$i);
	$largo     = mysql_field_len($qry,$i);
	$tipo      = mysql_field_type($qry,$i);

	  $not_null     = substr_count ($flag, "not_null");
	  $auto_inc     = substr_count ($flag, "auto_increment");
	  $campo_id     = substr_count ($nom_campo, "id_");
	 
	 $var2= "campo_$nom_campo";

	 if($$var2!=1){
	 $campo_externa .="<tr style=\"background-color: #FFC69F;\">
	 				
	 				<td align=\"center\" class=\"textos\">
					 <a href=\"index.php?accion=$accion&act=10&tbl=$tbl&campo=$nom_campo&bd_org=$base_compara&bd_des=$DATABASE\">
                      <img src=\"images/left.gif\" alt=\"\" border=\"0\">
                      </a>		  
					 </td>
					<td align=\"left\" class=\"textos\" height=\"25\" width=\"200\" >$nom_campo </td>
					
	 				<!--<td align=\"left\" class=\"textos\">$flag</td> 
					<td align=\"center\" class=\"textos\">$tipo</td> -->
					 <td align=\"center\" class=\"textos\">
					 <a href=\"javascript:confirmar('Al borrar el campo $nom_campo tambien borrara los datos contenidos por este, \u00BFEst\u00E1 seguro de borrar $nom_campo?','index.php?accion=$accion&act=11&tbl=$tbl&campo=$nom_campo&bd_org=$base_compara&bd_des=$DATABASE')\">
						  <img src=\"images/x.gif\" alt=\"\" border=\"0\"></a></td>
						 </tr> ";
	 }else{
	 $campo_externa .="<tr style=\"background-color: rgb(248, 248, 248);\">
	 				  
					  <td align=\"center\" class=\"textos\"><a href=\"index.php?accion=$accion&act=10&tbl=$tbl&campo=$nom_campo&bd_org=$base_compara&bd_des=$DATABASE\"><img src=\"images/left.gif\" alt=\"\" border=\"0\"></a></td>
					  <td align=\"left\" class=\"textos\"  height=\"25\" width=\"200\">$nom_campo</td>
	 				  <!--<td align=\"left\" class=\"textos\">$flag</td> 
					  <td align=\"center\" class=\"textos\">$tipo</td> -->
					  <td align=\"center\" class=\"textos\">
					  <a href=\"javascript:confirmar('Al borrar el campo $nom_campo tambien borrara los datos contenidos por este, \u00BFEst\u00E1 seguro de borrar $nom_campo?','index.php?accion=$accion&act=11&tbl=$tbl&campo=$nom_campo&bd_org=$base_compara&bd_des=$DATABASE')\">
					  <img src=\"images/not_ok2.gif\" alt=\"\" border=\"0\"></a></td>
				 	</tr> ";
	 }

	 
	 
	 
	}


$tabla_campo_externa = "  <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\" class=\"cuadro_light\">
                         <tr style=\"background-color: rgb(248, 248, 248);\">
						 
						 <td align=\"center\" class=\"textos\"></td> 
						 <td align=\"left\" class=\"textos\">Campo</td>
						 <!-- <td align=\"left\" class=\"textos\">Flag</td> 
					     <td align=\"center\" class=\"textos\">Tipo</td> -->
					     <td align=\"center\" class=\"textos\"></td>
					 
					 </tr>
                      	$campo_externa 
						</table>";



/*
	  $results = cms_query('SELECT * FROM ' .  $bdo.".".$tabla.$condicion); 
							   
						       while ($row = @mysql_fetch_assoc($results)) {             
								 $datos .= 'INSERT INTO ' .  $bdd.".".$tabla .' ('; 
					             $data = Array();            
								 
								  while (list($key, $value) = @each($row)) {
								  
								  $data['keys'][] = $key; 
								  $data['values'][] = addslashes($value); 
								  }             
								  
								  $datos .= join($data['keys'], ', ') . ') VALUES (\'' . join($data['values'], '\', \'') . '\');' ;         
								  
								   //  echo $datos."<br>"; 
                                   if(cms_query($datos)){
								   	$cont_insert++;
								   }
								   
								  
								  
								  $datos="";
								  }          
								 
								 
				*/				 


				

$contenido = "<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"1\" cellspacing=\"1\" >
                 <tr >
                    <td align=\"center\" colspan=\"2\" title=\"Volver a la administraci&oacute;n de la tabla\" class=\"textos\">
					<a href=\"index.php?accion=$accion&act=8&bd=$base_compara\">
					<img src=\"images/back.gif\" alt=\"Volver \" border=\"0\"></a>
					</td>
                    </tr>
				<tr>
                  <td align=\"center\" colspan=\"2\" class=\"textos\">Tabla <strong>$tbl</strong></td>
                </tr>
				<tr>
				<td align=\"center\" class=\"textos\"><strong>BD Origen \"$DATABASE\"</strong> $num_registro1 Registros</td> 
				<td align=\"center\" class=\"textos\"><strong>BD compara \"$base_compara\"</strong> $num_registro2 Registros</td>
				</tr> 
				
				<tr>
				<td align=\"center\" valign=\"Top\" class=\"textos\">$tabla_campo_local</td>
				<td align=\"center\" valign=\"Top\"  class=\"textos\">$tabla_campo_externa</td> 
				</tr> 
				<tr>
				<td align=\"center\" valign=\"Top\" class=\"textos\" style=\"background-color: rgb(248, 248, 248);\" >
				<a href=\"#\" style=\"cursor: pointer;  cursor: hand;\" onclick=\"ObtenerDatos('index.php?accion=$accion&act=15&tbl=$tbl&tabla=$tbl&bdd=$base_compara&bdo=$DATABASE&bd=$base_compara&axj=1','contenido_tabla');\">
				Agregar los $num_registro1  datos a la tabla <strong>$base_compara".".$tbl</strong>-></a></td>
				<td align=\"center\" valign=\"Top\"  class=\"textos\" style=\"background-color: rgb(248, 248, 248);\">
				<a href=\"#\" style=\"cursor: pointer;  cursor: hand;\" onclick=\"ObtenerDatos('index.php?accion=$accion&act=15&tbl=$tbl&tabla=$tbl&bdd=$DATABASE&bdo=$base_compara&bd=$base_compara&axj=1','contenido_tabla');\">
				<- Agregar los $num_registro2 datos a la tabla <strong>$DATABASE".".$tbl</strong></a></td> 
				</tr> 
				<tr>
				<td align=\"center\" valign=\"Top\" class=\"textos\" style=\"background-color: rgb(248, 248, 248);\">
				<a href=\"#\" style=\"cursor: pointer;  cursor: hand;\" onclick=\"ObtenerDatos('index.php?accion=$accion&act=16&tbl=$tbl&tabla=$tbl&bdd=$base_compara&bdo=$DATABASE&bd=$base_compara&axj=1','contenido_tabla');\">
				Vaciar tabla <strong>$base_compara".".$tbl</strong> y agregar los $num_registro1 datos-></a></td>
				<td align=\"center\" valign=\"Top\"  class=\"textos\" style=\"background-color: rgb(248, 248, 248);\">
				<a href=\"#\" style=\"cursor: pointer;  cursor: hand;\" onclick=\"ObtenerDatos('index.php?accion=$accion&act=16&tbl=$tbl&tabla=$tbl&bdd=$DATABASE&bdo=$base_compara&bd=$base_compara&axj=1','contenido_tabla');\">
				<-Vaciar tabla <strong>$DATABASE".".$tbl</strong> y Agregar los $num_registro2 datos</a></td> 
				</tr> 
				<tr>
				<td align=\"center\" colspan=\"2\" valign=\"Top\" class=\"textos\">
				<div id=\"contenido_tabla\"></div>
				</td> 
				</tr> 
				
              </table><br>
			    <table width=\"300\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                  <tr >
                    <td align=\"center\"  class=\"textos\">
					<a href=\"index.php?accion=$accion&act=8&bd=$base_compara\">
					<img src=\"images/back.gif\" alt=\"Volver\" border=\"0\"></a>
					</td>
                    </tr>
					<tr><td align=\"center\" class=\"textos\"><div id=\"destino\"></destino></td></tr> 
              	</table>";





?>