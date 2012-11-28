<?php
//consulta


	
  $query= "SELECT campo   
           FROM  auto_admin_campo
           WHERE campo='$nom_campo'";
  
  //echo "$query<br>";  
  
 
     $result2= cms_query($query)or die (error($query,mysql_error(),$php));
        list($campo) = mysql_fetch_row($result2);
           
  
       
         $query= "SELECT id_tipo_campo 
                  FROM  auto_admin_tipo_campo
                 ";
     //   echo "$query<br>";      
         
            $result1= cms_query($query)or die (error($query,mysql_error(),$php));
             while (list($id_tipo_campo) = mysql_fetch_row($result1)){
       						   
       		
  
  $query= "SELECT flag,largo,tipo   
	           FROM  auto_admin_combinacion
	           WHERE id_tipo_campo='$id_tipo_campo'";
  
  //  echo "$query<br>";  
	     $result0= cms_query($query)or die (error($query,mysql_error(),$php));
	     list($flag,$largo,$tipo) = mysql_fetch_row($result0);
							   
	    }  
	  	   
			

?>