<?php


	   
$array	= $_POST['item'];

if ($_POST['update'] == "update"){
	
        	
      
        
        
	$count = 1;
	foreach ($array as $movie_id) {
		
              			
       			 $listas_nom_campos="";
				 $listas_val_campos="";
				 
					  $query= "SELECT * 
                               FROM  acciones
       			               WHERE accion='$movie_id' and home ='si'";
                         $result= cms_query($query)or die (error($query,mysql_error(),$php));
                         $num_filas = mysql_num_fields($result);
						 $resultado = mysql_fetch_row($result);
						 $id_acc_old= $resultado[0];
						
						  for ($i = 1; $i < $num_filas; $i++){
						  
						  	$nom_campo = mysql_field_name($result,$i);	
							$valor = $resultado[$i];
							if($nom_campo=="descrip_php_esp"){
							
							$descrip_php_esp= $valor;
							}
							
							if($nom_campo=="descrip_url"){
								$valor = titulo_url($descrip_php_esp);
								//echo $valor;
							}
							$listas_nom_campos .= "$nom_campo,";
							$listas_val_campos .= "'$valor',";
							  
						  }	
						   
						  
						  $listas_nom_campos=elimina_ultimo_caracter($listas_nom_campos);
						  $listas_val_campos=elimina_ultimo_caracter($listas_val_campos);
						
       			     
       			      $Sql ="DELETE FROM acciones WHERE accion=$movie_id";

 						cms_query($Sql)or die (error($Sql,mysql_error(),$php));
       			       
					   $listas_val_campos= acentos($listas_val_campos);
					   
       			       $qry_insert="INSERT INTO acciones ($listas_nom_campos) values ($listas_val_campos)";
       			       mysql_query($qry_insert) or die("$MSG_DIE - QR-Problemas al insertar $qry_insert");
       			       
					  
					   
                         
       					$id_acc_new = mysql_insert_id();
						
						$datos .=$qry_insert ."\n\r";
						
						$Sql ="UPDATE accion_etiqueta 
                        	   SET accion ='$id_acc_new'
                        	   WHERE accion ='$id_acc_old'";

						 cms_query($Sql)or die (error($Sql,mysql_error(),$php));
						
						$Sql ="UPDATE accion_acciones 
                        	   SET accion ='$id_acc_new'
                        	   WHERE accion ='$id_acc_old'";

						 cms_query($Sql)or die (error($Sql,mysql_error(),$php));
						
						$Sql ="UPDATE accion_contenido 
                        	   SET accion ='$id_acc_new'
                        	   WHERE accion ='$movie_id'";

						 cms_query($Sql)or die (error($Sql,mysql_error(),$php));
						  
						  
						    
							 /* */
							$contrr++;
         				
              		    	   				
        			}
     $contenido = "Cambios realizados.";
}else{
$contenido = "upss.... no pude realizar el cambio en el orden sorry.";
}
 
  
  
  
?>