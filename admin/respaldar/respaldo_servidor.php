<?php
ini_set("memory_limit","40M");


include("../../lib/lib.inc.php");  
include("../../lib/lib.inc2.php");  
include("../../lib/connect_db.inc.php");

   
function extrae_estructura($tabla ,$BASEDATOS){
 $results = cms_query('DESCRIBE ' .  $BASEDATOS.".".$tabla); 
		         $create .="CREATE TABLE IF NOT EXISTS `$tabla` (" ; 
		         $tmp = '';          
			while ($row = @mysql_fetch_assoc($results)) {
			
			
             $create .= "`" . $row['Field'] . "` " . $row['Type']; 
		            if ($row['Null'] != 'YES') { $create .= ' NOT NULL'; 
					}           
					
					 if ($row['Default'] != '') {
                                            $create .= ' DEFAULT \'' . $row['Default'] . '\''; 
					 }            
					 if ($row['Extra']) {
                                            $create .= ' ' . strtoupper($row['Extra']); 
					 }           
					  if ($row['Key'] == 'PRI') { 
					  
					  $tmp_pk = "primary key(" . $row['Field'] . ")"; 
					  //$PK = 
					  }  
					             
					  $create .= ',';         
			 } 
					   
					    if($tmp_pk!=""){
						 $create .= $tmp_pk .")TYPE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;\n" ; 
						}else{
						$create = elimina_ultimo_caracter($create);
						 $create .= ")TYPE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;\n" ; 
						}        
					  
					   
				$create = str_replace("timestamp NOT NULL DEFAULT 'CURRENT_TIMESTAMP'","timestamp NOT NULL",$create);	 
					   
		return $create;
}

  function extrae_datos_tabla($tabla,$condicion,$BASEDATOS,$nombre_campos) {       
 
				   $results = cms_query('SELECT * FROM ' . $tabla.$condicion); 
							   
						       while ($row = @mysql_fetch_assoc($results)) {             
								 $datos .= "INSERT INTO `$tabla` " ; 
					             $data = Array();            
								 
								  while (list($key, $value) = @each($row)) {
								  
								  $data['keys'][] = $key; 
								  $value=trim(@eregi_replace("[\n|\r|\n\r]", '', $value));  

								  $data['values'][] = addslashes($value); 
								
								  
								  }             
								  if($nombre_campos==1){
                                    $campos_val = join($data['keys'], "`,`");
								  	$campos_nombre = " (`".$campos_val. "`)";
								  }
								  
								  
								  $datos .= $campos_nombre .' VALUES (\'' . join($data['values'], '\', \'') . '\');' . lnbr;         
								  }          
								  $datos .= str_repeat(lnbr, 2);    
								   
					    
						 $datos = str_replace("lnbr","\n",$datos);
								     
									   
		    return $datos;  
		}      
     
		 
		 

//fijo el date de hoy
$date_month = date('m');
$date_year = date('Y');
$date_day = date('d');
$Date = "$date_year-$date_month-$date_day";

//Archivo


$nombre_campos = $_POST['nombre_campos'];

$filename = $DATABASE."_$Date.sql";

/*
header("Pragma: no-cache");
header("Expires: 0");
header("Content-Transfer-Encoding: binary");
header("Content-type: application/force-download");
header("Content-Disposition: attachment; filename=$filename");
*/
/**/
  $tables = @mysql_list_tables( $DATABASE );//conexion con la base de datos
		 
		while( $line = mysql_fetch_row($tables) )
{

  	    $tabla2= $line[0];
	 	 $sql_text .= extrae_estructura($tabla2 ,$DATABASE);
		 $sql_text .= extrae_datos_tabla($tabla2,$condicion,$DATABASE,1);
		
		
	
}

$fp = fopen("$filename","w");
fwrite($fp, $sql_text . PHP_EOL);
fclose($fp);

function comprimir ($nom_arxiu)
{
$fptr = fopen($nom_arxiu, "rb");
$dump = fread($fptr, filesize($nom_arxiu));
fclose($fptr);

//Comprime al máximo nivel, 9
$gzbackupData = gzencode($dump,9);

$fptr = fopen($nom_arxiu . ".gz", "wb");
fwrite($fptr, $gzbackupData);
fclose($fptr);
//Devuelve el nombre del archivo comprimido
return $nom_arxiu.".gz";
}


comprimir ("$filename");

unlink($filename);



?>