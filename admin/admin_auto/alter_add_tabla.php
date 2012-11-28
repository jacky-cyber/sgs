<?php

$tabla = $_GET['tbl'];
$bd_org = $_GET['bd_org'];
$bd_des = $_GET['bd_des'];
$campo = $_GET['campo'];


 $results = cms_query('DESCRIBE ' .  $bd_org.'.'.$tabla); 
 
		         $create .='ALTER TABLE ' .  $bd_des.'.'.$tabla . ' ADD '. $campo.' ' ; 
		         $tmp = '';          
			while ($row = mysql_fetch_assoc($results)) {
			
			if($row['Field']==$campo){
			$create .= ' ' . $row['Type']; 
		            if ($row['Null'] != 'YES') { 
							$create .= ' NOT NULL'; 
					}           
					
					 if ($row['Default'] != '') { $create .= ' DEFAULT \'' . $row['Default'] . '\''; 
					 }           
					 if ($row['Extra']) { $create .= ' ' . strtoupper($row['Extra']); 
					 }           
					  if ($row['Key'] == 'PRI') { 
					  
					  $tmp = ' primary key(' . $row['Field'] . ')'; 
					  } 
					  
				}
                    
			 } 
					   $create .= $tmp ."\n" ; 
					  

				$DB2 = mysql_connect($HOST_NAME, $DB_USERNAME, $DB_PASSWORD) ;	
				mysql_select_db($bd_des, $DB2);	
				@cms_query($create);
				
				
				if($DATABASE==$bd_des){
					$bd = $bd_org;
				}else{
					$bd= $bd_des;
				}
				
            header("Location:index.php?accion=$accion&act=9&tbl=$tabla&bd=$bd");	   

			

?>