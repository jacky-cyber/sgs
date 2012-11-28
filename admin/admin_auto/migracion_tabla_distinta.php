<?php

$bdo = $_GET['bdo'];
$bdd = $_GET['bdd'];
$tabla = $_GET['tabla'];
$tbl = $_GET['tbl'];





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
                                           <td align=\"center\" class=\"textos\">$largo</td> 
                                            <td align=\"center\" class=\"textos\">$tipo $flag</td> 
	 			    </tr> ";
	 
         $select_tablas_origen .="<option value=\"$nom_campo\">$nom_campo</option>";
         
         
	}
        
        $select_tablas_origen ="<select name=\"#campo#_$nom_campo\" id=\"#campo#_$nom_campo\">
                        <option value=\"#\">Seleccione un campo</option>
                        $select_tablas_origen
                    </select>";

$tabla_campo_local = "  <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\" class=\"cuadro_light\">
                      <tr><td style=\"background-color: #999;\" align=\"center\" colspan=\"3\" class=\"textos\">
					   <strong>Detalle Tabla $tabla Total de Registros $tot_reg</strong></td></tr> 
                                    <tr style=\"background-color: #999;\">
	 				    <td align=\"left\" class=\"textos\" >Campo</td>
                                           <td align=\"center\" class=\"textos\">Largo</td> 
                                            <td align=\"center\" class=\"textos\">Tipo</td> 
	 			    </tr>
                                       $campo_local
				</table>";


 $tables = mysql_list_tables( $bdd );					//conexion con la base de datos
		 
		while( $line = mysql_fetch_row($tables) )
{
		$tbla= $line[0];
                
                 $sql = "SELECT * FROM $bdd.$tbla";
                 $qry = cms_query($sql);
                 $num_col_tbla = mysql_num_fields($qry);		
   
                
		if($tbla==$tbl){
                        $lista_tablas_bd .= "<option value=\"?accion=$accion&act=$act&bdd=$bdd&bdo=$bdo&tabla=$tabla&bd=$bd&tbl=".$line[0]."\" selected>".$line[0]."($num_col_tbla)</option>\n";                    
                    }else{
                        $lista_tablas_bd .= "<option value=\"?accion=$accion&act=$act&bdd=$bdd&bdo=$bdo&tabla=$tabla&bd=$bd&tbl=".$line[0]."\">".$line[0]."($num_col_tbla)</option>\n";
                    }
		 
		
        		
	
}

//para seleccionar la tabla en la pag.			 
$tablas_destino ="<select name=\"menu1\" onChange=\"MM_jumpMenu('parent',this,0)\">		
              <option value=\"#\">Seleccione tabla </option>
			 $lista_tablas_bd
            </select>";
            
            
            

if($tbl!=""){
    
   

 $sql = "SELECT * FROM $bdd.$tbl";
 
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
         
        $lista_tablas_origen = str_replace("#campo#","$nom_campo",$select_tablas_origen);
         
	 $campo_local_destino .="<tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">
	 				    <td align=\"left\" class=\"textos\" >$nom_campo</td>
                                           <td align=\"center\" class=\"textos\">$largo</td> 
                                            <td align=\"center\" class=\"textos\">$tipo $flag</td>
                                             <td align=\"center\" class=\"textos\">$lista_tablas_origen</td>
                                             <td align=\"center\" class=\"textos\">
                                             <input type=\"text\" size=\"5\" name=\"valor_def_$nom_campo\" id=\"valor_def_$nom_campo\"  value=\"\"></td> 
	 			    </tr> ";
	 
	}


 
    
}


$tabla_campo_local_destino = "  <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\" class=\"cuadro_light\">
                      <tr><td style=\"background-color: #999;\" align=\"center\" colspan=\"5\" class=\"textos\">
					   <strong>Detalle Tabla $tbl en BD $bdo</strong></td></tr> 
                                    <tr style=\"background-color: #999;\">
	 				    <td align=\"left\" class=\"textos\" >Campo</td>
                                           <td align=\"center\" class=\"textos\">Largo</td> 
                                            <td align=\"center\" class=\"textos\">Tipo</td>
                                            <td align=\"center\" class=\"textos\">Campos Org</td>
                                            <td align=\"center\" class=\"textos\">Valor Defct. </td> 
	 			    </tr>
                                       $campo_local_destino
				</table>";






	 //include ("admin/admin_auto/lista_tablas.php");







 $contenido = "<table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\">
                 
                   <tr >
                    <td align=\"center\"  class=\"textos\">
					<a href=\"index.php?accion=$accion&act=8&bd=$bdo\">
					<img src=\"images/back.gif\" alt=\"Volver\" border=\"0\"></a>
					</td>
                    </tr>
                  <tr>
                    <td align=\"center\" class=\"textos\">Estructura Actual de tabla <strong>$tabla</strong> en BD $bdo</td>
                  </tr>
                  <tr><td align=\"center\" class=\"textos\"> $tabla_campo_local</td></tr>
                  <tr><td align=\"center\" class=\"textos\"> Seleccione tabla destino de los registros en BD $bdd</td></tr>
                  <tr><td align=\"center\" class=\"textos\"> $tablas_destino</td></tr>
                  <tr><td align=\"center\" class=\"textos\"> $tabla_campo_local_destino</td></tr>
                  <tr><td align=\"center\" class=\"textos\"> Ver Insert  <input type=\"radio\" name=\"insert_radio\" id=\"insert_radio\" value=\"1\" checked>  Ejecutar Insert <input type=\"radio\" name=\"insert_radio\" id=\"insert_radio\" value=\"2\"></td></tr> 
                   <tr><td align=\"center\" class=\"textos\">Sin conversi&oacute;n utf8  <input type=\"radio\" name=\"utf8code\"  value=\"0\" checked>  |
		   Convertir utf8_encode <input type=\"radio\" name=\"utf8code\"  value=\"1\" > |
		   Convertir utf8_decode <input type=\"radio\" name=\"utf8code\"  value=\"2\" > </td></tr> 
		   
		   <tr><td align=\"center\" class=\"textos\">
                  <input type=\"button\" name=\"boton\" id=\"boton\" value=\"Migrar\"></td></tr>
                      <tr >
       <td class=\"textos\" align=\"center\" class=\"textos\">
	   <div id=\"div_respuesta\" align=\"center\"></div>
<div id=\"div_cargando\" style=\"display:none\">Enviado datos, Espere...</div>
	   </td>
       </tr>
                </table>
                <input type=\"hidden\" name=\"tabla_origen\" id=\"tabla_origen\" value=\"$tabla\">
                <input type=\"hidden\" name=\"tabla_destino\" id=\"tabla_destino\" value=\"$tbl\">
                <input type=\"hidden\" name=\"bdd\" id=\"bdd\" value=\"$bdd\">
                <input type=\"hidden\" name=\"bdo\" id=\"bdo\" value=\"$bdo\">";
                
                
                $js = "<script language=\"JavaScript\">

$(document).ready(function () 
		{
			$('#boton').click(function() 
			{ procesar('index.php?accion=$accion&act=18&axj=1','div_respuesta');
			});
		});
		</script>
";
?>