<?php

   
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


header("Pragma: no-cache");
header("Expires: 0");
header("Content-Transfer-Encoding: binary");
header("Content-type: application/force-download");
header("Content-Disposition: attachment; filename=$filename");

/**/
  $tables = mysql_list_tables( $DATABASE );//conexion con la base de datos
		 
		while( $line = mysql_fetch_row($tables) )
{

  	    $tabla2= $line[0];
	 	if($_POST['estructura_'.$tabla2]){
			echo  extrae_estructura($tabla2 ,$DATABASE);
		}
		if($_POST['datos_'.$tabla2]){
			echo extrae_datos_tabla($tabla2,$condicion,$DATABASE,$nombre_campos);
		}
		
	
}


?>