<?php
include("lib/lib.inc.php");
include("lib/lib.inc2.php");  
include("lib/connect_db.inc.php");    

  
  
  

  function mysql_dump2($database,$tabla) {       
 

  $query = '';       
  $tables = mysql_list_tables($database);
        while ($row =mysql_fetch_row($tables))
		 { 
		 //$table_list[] = ; 
				
				 if($tabla ==$row[0] ){
		  
		   $results = cms_query('DESCRIBE ' .  $row[0]); 
		         $query .='CREATE TABLE ' .  $row[0] . ' (' ; 
		         $tmp = '';          
			while ($row = @mysql_fetch_assoc($results)) {
			
			
             $query .= '' . $row['Field'] . ' ' . $row['Type']; 
		            if ($row['Null'] != 'YES') { $query .= ' NOT NULL'; 
					}           
					
					 if ($row['Default'] != '') { $query .= ' DEFAULT \'' . $row['Default'] . '\''; 
					 }            
					 if ($row['Extra']) { $query .= ' ' . strtoupper($row['Extra']); 
					 }           
					  if ($row['Key'] == 'PRI') { $tmp = 'primary key(' . $row['Field'] . ')'; 
					  }             
					  $query .= ',';         
					   }          
					   $query .= $tmp .");" ;  
					     
						 /*  $results = cms_query('SELECT * FROM ' .  $table_list[$i]); 
							   
						       while ($row = @mysql_fetch_assoc($results)) {             
								 $query .= 'INSERT INTO ' .  $table_list[$i] .' ('; 
					             $data = Array();            
								 
								  while (list($key, $value) = @each($row)) {
								  
								  $data['keys'][] = $key; $data['values'][] = addslashes($value); 
								  }             
								  
								  $query .= join($data['keys'], ', ') . ')' . lnbr . 'VALUES (\'' . join($data['values'], '\', \'') . '\');' . lnbr;         
								  }          
								  $query .= str_repeat(lnbr, 2);     */
								   
								  // }     
								  // $query = str_replace("lnbr","",$query);
								     return $query;  
				
				
		 }      
		}      
	}	      
		 
		
		         
  
  
  $tabla = $_GET['tabla'];
  
  

echo mysql_dump2($DATABASE,$tabla); 

?>