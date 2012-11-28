<?php
	if(substr_count ($campos, "id_") and $pk!=1){
   						
   						$tbl_pk= campo_pk($campos,$DATABASE);

   						
   						if($tbl_pk!=""){
   		      					$campo_tbl_pk = $campos;
   		      	  				$query= "SELECT id_auto_admin  
   		      	          				 FROM auto_admin 
   		      	          				 WHERE tabla='$tbl_pk'";
   		      	  				
   		      	     				$resultq= cms_query($query)or die (error($query,mysql_error(),$php));
   		      	     			 list($id_auto_admin_tbl_pk) = mysql_fetch_row($resultq);
   		      	
   		      	 				$query= "SELECT campo
   		      	          				 FROM auto_admin_campo 
   		      	          				 WHERE id_auto_admin='$id_auto_admin_tbl_pk' and existe_listado =1";

   		      	
   		      					 $resultq= cms_query($query)or die (error($query,mysql_error(),$php));
   		      	     			 list($campo_txt_tbl_pk) = mysql_fetch_row($resultq);
   		      	    
   		     	   					$contador_pk= $cont;
   		     	   					
   		     	   					$ver_pk="ok";
   		      	         
   		      					}
   					}else{
   						
   						$query= "SELECT campo
   		      	          				 FROM auto_admin_campo 
   		      	          				 WHERE id_auto_admin='$id_auto_admin' and existe_listado =1";

   		      	
   		      					 $resultq= cms_query($query)or die (error($query,mysql_error(),$php));
   		      	     			 list($campo_txt_tbl_pk) = mysql_fetch_row($resultq);
   		      	    
   		      	     			 
   		      	     			 
   					}



?>