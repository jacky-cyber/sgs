<?php

function fecha($fecha){

$dia=substr($fecha,0,2);

$mes=substr($fecha,2,2);

$anio=substr($fecha,4,8);

return "$dia-$mes-$anio";
}


$excel = "arreglos.xls";

set_time_limit(0) ; 



require_once 'reader.php';


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
		$$var = str_replace("&nbsp;","",$$var);
		
		$valor= $$var;
		
		
		if($valor!=""){
			
			switch ($j) {
                 case 1:
					 $valor = strtoupper($valor);
                     echo "folio :<strong>$valor </strong><br>";
					 $folio=$valor;
                     break;
            	 case 2:
                      echo "Nombres:<strong>$valor </strong><br>";
					 $nombres=$valor;
                     break;
               case 3:
                      echo "Paterno:<strong>$valor </strong><br>";
					 $paterno=$valor;
                     break;
              case 4:
                      echo "Materno:<strong>$valor </strong><br>";
					 $materno=$valor;
                     break;
               case 5:
                      echo "Apoderado:<strong>$valor </strong><br>";
					 $apoderado=$valor;
                     break;
             case 6:
                      echo "Calle:<strong>$valor </strong><br>";
					 $calle=$valor;
                     break;
					 //Número
              case 7:
                      echo "Número:<strong>$valor </strong><br>";
					 $numero=$valor;
                     break;
					 //
              case 8:
                      echo "Región:<strong>$valor </strong><br>";
					 $region=$valor;
                     break;
					 //
              case 9:
                      echo "Comuna:<strong>$valor </strong><br>";
					 $comuna=$valor;
                     break;
					 //
              case 10:
                      echo "Ciudad:<strong>$valor </strong><br>";
					 $ciudad=$valor;
                     break;
				case 11:
                   //   echo "Número:<strong>$valor </strong><br>";
					// $numero=$valor;
                     break;
				case 12:
                      echo "Materia/documento(s) Solicitado:<strong>$valor </strong><br>";
					 $doc_solicitado =$valor;
                     break;
				case 13:
                      echo "Notificado Por Email Si O No :<strong>$valor </strong><br>";
					 $notificacion =$valor;
                     break;
					
				case 14:
                      echo "Email :<strong>$valor </strong><br>";
					 $email =$valor;
                     break;
					
				case 15:
                      echo "Retiro En Oficina :<strong>$valor </strong><br>";
					 $retiro_en_oficina =$valor;
                     break;
				case 16:
                      echo "formato de entrega :<strong>$valor </strong><br>";
					 $formato_de_entrega =$valor;
                     break;
				case 17:
                     
					 $fecha_ini =fecha($valor);
					        
					  echo "Fecha ini:<strong>$fecha_ini </strong><br>";
                     break;
				case 18:
                     $fecha_fin =fecha($valor);
					  echo "Fecha fin :<strong>$fecha_fin  </strong><br>";
					 
                     break;
				case 19:
                      echo "Estado :<strong>$valor </strong><br>";
					 $estado =$valor;
                     break;
					
					//
					
               	default:
            	 //  echo $valor;
            	 
                   
             }
			
		}
		
		
		
		
	/*
	* Insertar Usuario
	*/

	
	/*
	* Insertar Solicitud
	* Insertar Flujo
	
	*/		
		

	}
	
	echo "<br><br><br>";
	}
	
	
		
	

	
	
	
 



?>