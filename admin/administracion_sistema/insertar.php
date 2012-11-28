<?php
//insertar
  $query= "SELECT tabla   
           FROM  auto_admin 
           WHERE id_auto_admin='$id_auto_admin'";

     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      if (list($nom_tabla) = mysql_fetch_row($result)){
						   
		
      	
      	  $query= "SELECT campo ,unic 
   		           FROM  auto_admin_campo
   		           WHERE  id_auto_admin=$id_auto_admin
				   order by id_campo";
   		     
   		     $resultc= cms_query($query)or die (error($query,mysql_error(),$php));
   		      while (list($campos,$unic) = mysql_fetch_row($resultc)){
   		 
     		      	
   				$cont_c++;
   		      	$lista_de_campos .="$campos,";
   		      	$valor_campo= trim($_POST[$campos]);
				$lista_de_camp_for .=  "'".$valor_campo."',";	
				    
				if($unic==1){
				$condicion_unic .= " and ".$campos."='$valor_campo' ";
				}	
				  			   
   				 }
   		
		
             
                        
      	$largo_lista_de_campos = strlen($lista_de_campos);
      	$lista_de_campos = substr($lista_de_campos,0,$largo_lista_de_campos-1);

     	$largo_lista_de_camp_for = strlen($lista_de_camp_for);
      	$lista_de_camp_for = substr($lista_de_camp_for,0,$largo_lista_de_camp_for-1);

		
		if($condicion_unic!=""){
		$query= "SELECT *   
                   FROM  $nom_tabla
                   WHERE $condicion_unic";
				  
             $result= cms_query($query)or die (error($query,mysql_error(),$php));
             if(!list($id_usuario,$nombre) = mysql_fetch_row($result)){
        			
					$qry_insert="INSERT INTO $nom_tabla ($lista_de_campos )
                                   values ($lista_de_camp_for)";
                                   
                    $result_insert=cms_query($qry_insert) or die (error($qry_insert,mysql_error(),$php));
			   
        		 }
		
		}else{
			 
                    $qry_insert="INSERT INTO $nom_tabla ($lista_de_campos )
                                   values ($lista_de_camp_for)";
                                   
                    $result_insert=cms_query($qry_insert) or die (error($qry_insert,mysql_error(),$php));

		}
		    
		
		
		
					 
				

             
            
 }


?>