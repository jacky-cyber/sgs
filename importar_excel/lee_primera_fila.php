<?php


//$excel = "deuman/importar_excel/arreglos.xls";

set_time_limit(0) ; 



require_once 'deuman/importar_excel/reader.php';


// ExcelFile($filename, $encoding);
$data = new Spreadsheet_Excel_Reader();


// Set output Encoding.
$data->setOutputEncoding('CP1251');





$data->read($excel);


/*
for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) { //sheets maneja el nº de la página
	}
	$base ="";
	$valora="";
	$porcentajea="";
	$valor_fijo = "";
	$unidad = "";
	
	$tede="";
	$cont_blancos=0;
	
	*/
	
	function lista_tablas_select($DATABASE){
	
	 $tables = mysql_list_tables( $DATABASE );					//conexion con la base de datos
		 
		while( $line = mysql_fetch_row($tables) )
{
		$tbla= $line[0];
		   
		$lista_tablas_bd .= "<option value=\"".$line[0]."\">".$line[0]."</option>";
		
	
}

//para seleccionar la tabla en la pag.			 
$tablas ="<select name=\"#NOMBRE#\" id=\"#NOMBRE#\" #JS_SEL# class=\"#CLASS_SEL#\">		
              <option value=\"#\">Seleccione tabla </option>
			 $lista_tablas_bd
            </select>";

	
	return $tablas;
	}
	
	

	
	
	
	//$lista_campos_tabla = lista_campos_tabla($tabla);
	
	
	$i=$id_fila_titulo;
	
	for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
		$var = "columna_$j";
		
		$$var = $data->sheets[0]['cells'][$i][$j];
		
		$$var = ucwords(strtolower(trim($$var)));
		if($$var==""){
		$$var="&nbsp;";
		$cont_blancos++;
		}
		$lista_tablas = lista_tablas_select($DATABASE);
		$lista_tablas = str_replace("#NOMBRE#","select_tabla_".$i."_".$j,$lista_tablas);
		$lista_tablas = str_replace("#JS_SEL#","",$lista_tablas);
		$lista_tablas = str_replace("#CLASS_SEL#","class_sel",$lista_tablas);
		//$lista_tablas = str_replace("#NOMBRE#","select_tabla_".$i."_".$j,$lista_tablas);
		
		$$var = htmlentities($$var);
		$tede .= "<tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">
			<td class=\"textos\"> ". $$var."</td>
			<!--    
			<td align=\"center\" class=\"textos\">
			<input type=\"checkbox\" name=\"check_$i"."_".$j."\" id=\"check_$i"."_".$j."\" value=\"1\" checked></td>
			 -->
			<td align=\"center\">$lista_tablas </td>
			 <td align=\"center\" class=\"textos\"> 
			 <select name=\"campo_select_tabla_$i"."_".$j."\" id=\"campo_select_tabla_$i"."_".$j."\" disabled=\"disabled\">
                                                    <option value=\"uno\">Seleccione</option>
                                                    
                                                    </select>
													</td> 
			</tr>";
		
		$cont_col++;
	  }
	  $cont_blancos++;
	
	 if($cont_blancos<$j){
			 $fila .="$tede"; 
	 }
	
	/*
		// Parametros para e id_entidad

	
	*/
			
			

	$js.=" <script type=\"text/javascript\">
   


$(document).ready(function(){

	
	//$(\".class_sel\").change(function() {
  		//	var etiqueta =this.id; 
		//	$(\"#campo_\"+ etiqueta).removeAttr('disabled');
			
			
			
			//alert('hola campo_'+ etiqueta);
	//});
	
	
	
	$(\".class_sel\").change(function() {
		var etiqueta =this.id; 
   		$(\"#\"+ etiqueta).each(function () {
			$(\"#campo_\"+ etiqueta).removeAttr('disabled');
				elegido=$(this).val();
				$.post(\"?accion=$accion&act=2&axj=1\", { elegido: elegido }, function(data){
				$(\"#campo_\"+ etiqueta).html(data);
				
			});			
        });
   });

	
});




</script>";
	
       

		$contenido .=" 
		  <table width=\"98%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
            <tr >
              <td align=\"center\" class=\"textos\">
			  <table   border=\"0\" align=\"left\" cellpadding=\"2\" cellspacing=\"2\">
                               <tr >
                                 <td align=\"center\" class=\"texnormalbold2\"><strong>Subir Excel</strong> >></td>
                                 <td align=\"center\" class=\"texnormalbold2\"><strong>Indicar Origen de Datos</strong> >></td>
                                 <td align=\"center\" class=\"textos\">Indicar Titulos</td>
                                 </tr>
                           	</table>
			  </td>
              </tr>
			  <tr><td align=\"center\" class=\"textos\">
			  <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"1\" cellspacing=\"1\" class=\"cuadro\">
                        <tr><td align=\"center\" class=\"textos\" colspan=\"3\">Tabla </td></tr> 
						$fila
                     	</table>
			   </td></tr> 
        	</table> ";
 

?>