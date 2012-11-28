<?php

$bdo = $_GET['bdo'];
$bdd = $_GET['bdd'];
$tabla = $_GET['tabla'];





 $sql = "SELECT * FROM $bdo.$tabla";
 
  $qry = cms_query($sql);
   $num_filas = mysql_num_fields($qry);		
   
  $tot_reg = mysql_num_rows($qry); 		
   
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
	 $campo_local .="<tr style=\"background-color: rgb(248, 248, 248);\">
	 				    <td align=\"left\" class=\"textos\" >$nom_campo</td>
	 			    </tr> ";
	 
	}


	

$tabla_campo_local = "  <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\" class=\"cuadro_light\">
                      <tr><td style=\"background-color: rgb(248, 248, 248);\" align=\"center\" class=\"textos\">
					   <strong>Detalle Tabla $tabla Total de Registros $tot_reg</strong></td></tr> 
					     
                      	$campo_local
						</table>";

if($DATABASE==$bdo){
$bd=$bdd;
$movimiento = "<tr><td align=\"center\" style=\"vertical-align: middle\"  colspan=\"2\" class=\"textos\"><h3><strong>$bdo <img src=\"images/arrow_right.gif\" alt=\"\" border=\"0\"> $bdd</strong></h3> </td></tr> ";
}else{
$bd= $bdo;
$movimiento = "<tr><td align=\"center\" style=\" vertical-align: middle\" colspan=\"2\" class=\"textos\"><h3><strong>$bdd <img src=\"images/arrow_left.gif\" alt=\"\" border=\"0\"> $bdo</strong></h3> </td></tr> ";

}

$contenido = "  <table width=\"60%\"  border=\"0\" align=\"center\" cellpadding=\"3\" cellspacing=\"3\" >
                 <tr><td align=\"center\" colspan=\"2\" class=\"textos\">$tabla_campo_local  </td></tr>
				  <tr><td align=\"center\" colspan=\"2\" class=\"textos\">Exportar tabla \"$tabla\" a \"$bdd\" </td></tr> 
				 $movimiento
				  <tr >
                    <td align=\"left\"  width=\"50%\" class=\"textos\">
					  <table width=\"50%\"  border=\"0\" align=\"left\" cellpadding=\"0\" cellspacing=\"0\">
                        <tr >
                          <td align=\"center\" class=\"textos\">
                                   <a href=\"index.php?accion=$accion&act=13&bdd=$bdd&bdo=$bdo&tabla=$tabla&bd=$bd\">
                                      <img src=\"images/icono_reporte/analisis_segun_tipo.jpg\" alt=\"\" border=\"0\">
                                   </a>
                           </td>
                          </tr>
						  <tr><td align=\"center\" class=\"textos\"> Solo crear tabla</td></tr> 
                    	</table>
					
					 </td>
					<td align=\"right\" width=\"50%\">
					  <table width=\"50%\"  border=\"0\" align=\"right\" cellpadding=\"0\" cellspacing=\"0\">
                        <tr >
                          <td align=\"center\" class=\"textos\">
                                   <a href=\"index.php?accion=$accion&act=14&bdd=$bdd&bdo=$bdo&tabla=$tabla&bd=$bd\">
                                      <img src=\"images/icono_reporte/impagas.jpg\" alt=\"\" border=\"0\">
                                   </a>
                           </td>
                          </tr>
						  <tr><td align=\"center\" class=\"textos\"> Crear tabla e Insertar $tot_reg datos existentes</td></tr> 
                    	</table>
					</td> 
                    </tr>
					
					<tr><td align=\"center\" colspan=\"2\" class=\"textos\"> Importar Datos de <strong>\"$tabla\"</strong> a una tabla de datos con estructura distinta
					<a href=\"index.php?accion=$accion&act=17&bdd=$bdd&bdo=$bdo&tabla=$tabla&bd=$bd\">Aqu&iacute;</a></td></tr> 
              	</table>";

//$contenido = cuadro_amarillo($contenido);


?>