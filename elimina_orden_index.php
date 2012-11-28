<?php
set_time_limit(0);
 
include("lib/connect_db.inc.php");
 
    
 
$query= "show tables";
     $result_show= mysql_query($query)or die (mysql_error(). "$query \n");
      while (list($tabla) = mysql_fetch_row($result_show)){
			
                 
               $query= "SHOW INDEX FROM $tabla where Key_name like 'orden_%'";
                    $result_= mysql_query($query)or die (mysql_error(). "$query \n");
                     while (list($Table,$Non_unique,$Key_name,$Seq_in_index,$Column_name,$Collation,$Cardinality,$Sub_part,$Packed,$Null,$Index_type,$Comment ) = mysql_fetch_row($result_)){
                                    
                                        $query= "ALTER TABLE $tabla DROP INDEX $Key_name";
                                        $result_ect= mysql_query($query)or die (mysql_error(). "$query \n");
                                        echo $query."\n";
                                        
                                }
                      
                        	   
		 }

 

 
?>