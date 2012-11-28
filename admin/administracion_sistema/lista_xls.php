<?php



$contador_pk="#";


//listado
crear_campo_orden($nom_tabla);
//echo "$nom_tabla";
	

if(substr_count ($nom_tabla, $cpl)){
   			
   			$nom_tabla2= str_replace("$cpl","",$nom_tabla);
   		}
   
	if($id_auto_admin==""){
			

   		$query= "SELECT id_auto_admin   
           FROM  acciones
           WHERE accion='$accion'";

   		$result= cms_query($query)or die (error($query,mysql_error(),$php));
      list($id_auto_admin) = mysql_fetch_row($result);
   		
   	}
   		

   		$query= "SELECT campo,existe_listado,pk,id_tipo_campo  
   		           FROM  auto_admin_campo
   		           WHERE  id_auto_admin=$id_auto_admin
				   order by id_campo";
   		  
   			//echo "$query<br>";
   		     $resultc= cms_query($query)or die (error($query,mysql_error(),$php));
   		      while (list($campos,$existe_listado,$pk,$id_tipo_campo) = mysql_fetch_row($resultc)){
   		      	//echo "$campos<br>";
   				$campo_txt_tbl_pk="";
				
   		     
   					if(substr_count ($campos, "id_") ){
   						
   						$tbl_pk= campo_pk($campos,$DATABASE);
						 
						
   						// $tbl_pk=tabla($id_auto_admin_tbl);
						//echo "holss $campos<br>";
						
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
   		      	    
   		      	     			//echo "hol $campo_txt_tbl_pk<br>"; 
   		      	     			 
   					}
   					
   		       
   		    
   		     
   		       $cont++;
   		     
   		       
   		       
				$cont_c++;
   		      	$lista_de_campos .="$campos,";
				
				$campos2 = str_replace("_"," ",$campos);	//reemplaza "_" por blanco en $campos 
				$campos2 = str_replace("id "," ",$campos2);	//reemplaza "_" por blanco en $campos 
				
				$campos2 = ucwords($campos2);				//pone la primera letra en mayuscula
				$nom_columnas .="$campos2 \t ";	
   		      	
								
   		      //$lista_campos .="<option value=\"$campos\">$campos</option>";		   
   		}
   		

   		  		
		
		
		
		  $query= "SELECT campo  
   		           FROM  auto_admin_campo
   		           WHERE id_auto_admin=$id_auto_admin and id_tipo_campo=1 and pk=1
				   order by id_campo";
		  //echo "$query<br>";
             $results= cms_query($query)or die (error($query,mysql_error(),$php));
             list($pk_campo) = mysql_fetch_row($results);
		

		
		$largo_lista_de_campos = strlen($lista_de_campos);
    	$lista_de_campos = substr($lista_de_campos,0,$largo_lista_de_campos-1);
		
////////////////////////
 
////////////////////////
	
	
    	$num_reg = $ini;
    while ($a<$num_filas) {
    	  
	     $num_reg++;
    	 $lista_campos_html="";
		 
    	$i=0;
    	 for ($i = 0; $i < $cont_c; $i++){
		 
		 $valor= @mysql_result($result,$a,$i);
		 $tipo=  @mysql_field_type($result,$i);
		 $campo_nom= @mysql_field_name($result,$i);
	
		 
		 if($contador_pk==$i and $contador_pk!="#"){
		 	//echo "$contador_pk= =$i";
		 	//rescatar valores de campos id de otra tabla
		 	
			
			
			 $query= "SELECT id_auto_admin  
                       FROM  auto_admin_campo
                       WHERE campo='$campo_nom' and pk=1";
               // echo $query."<br>";
				 $result_r= cms_query($query)or die (error($query,mysql_error(),$php));
                  list($id_auto_tabla_r) = mysql_fetch_row($result_r);
				  if($id_auto_tabla_r!=""){
				  
				     $tabla_r= tabla($id_auto_tabla_r);
				     $campo_txt_r =campo_txt($id_auto_tabla_r);	
				     $campo_pk_r=campo_pk_tabla($id_auto_tabla_r);	
				  	 $valor= valor_campo_tabla ($tabla_r, $campo_txt_r, $valor);
				
				  
				  }else{
				  		 
		 	     $query= "SELECT $campo_txt_tbl_pk   
   		     	           FROM  $tbl_pk
   		     	           WHERE $campo_tbl_pk='$valor'";
   		     	// echo $query."<br>";
				 
				  $resultq= cms_query($query)or die (error($query,mysql_error(),$php));
   		     	  list($valor) = mysql_fetch_row($resultq);
				  }
				  //echo "hhh $valor";  
		//tbl_pk =tipo_campo($campo_txt_tbl_pk,$nom_tabla);
		 	//echo "$tipo_campo_txt_tbl_pk --> $campo_txt_tbl_pk,$nom_tabla <br>";
					if($tipo=="date") {
						$valor=fechas_html($valor);
					}
					
			
		 			$lista_campos_html .="$valor \t";
		 
		 
		 }
    
		 	
		
	
	     $id= @mysql_result($result,$a, $i);
		$a++;
		
		 if($lista_campos_html!=""){	
		 	
	 	
		
		
		 	$listado .=$lista_campos_html;
      	
		
     
    
	}
      	
      	
   
	  }
	}
  
  
 



		


$cont_ver= $cont_c+1;


$data = "
      	
      	
  
$nom_columnas
$listado
	";     
		 	
 
?>