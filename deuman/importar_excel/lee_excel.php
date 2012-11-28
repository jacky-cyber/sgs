<?php


$excel = "deuman/importar_excel/arreglos.xls";

set_time_limit(0) ; 



require_once 'deuman/importar_excel/reader.php';


// ExcelFile($filename, $encoding);
$data = new Spreadsheet_Excel_Reader();


// Set output Encoding.
$data->setOutputEncoding('CP1251');





$data->read($excel);



for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) { //sheets maneja el nº de la página
	
	$base ="";
	$valora="";
	$porcentajea="";
	$valor_fijo = "";
	$unidad = "";
	
	$tede="";
	$cont_blancos=0;
	for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
		$var = "columna_$j";
		
		$$var = $data->sheets[0]['cells'][$i][$j];
		
		$$var = ucwords(strtolower(trim($$var)));
		if($$var==""){
		$$var="&nbsp;";
		$cont_blancos++;
		}
		
		
		$tede .= "<td class=\"textos\"> ". $$var."</td>";
		
		$cont_col++;
	  }
	  $cont_blancos++;
	
		if($cont_blancos<$j){
			 $fila .="<tr><td class=\"textos\">$cont_blancos $j</td>$tede</tr>"; 
		}
	
	
			 
	
	}
       

	
	
	

	
	
	
 

$contenido = "
  <table   border=\"1\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
   $fila
	</table>
<br><br><br>columnas $j <br> filas $i <br> Total ".$cont_col;


$html ="<html>
<head>
<title>$nombre_pag</title>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">
</head>

<body bgcolor=\"#FFFFFF\" text=\"#000000\">
$contenido
</body>
</html>";



?>