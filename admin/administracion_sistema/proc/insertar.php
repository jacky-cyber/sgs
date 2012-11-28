<?php
//insertar


$id_a = $_GET['id_auto_admin']; 
if(!$id_a){
$id_a = $_GET['id_a']; 
}

 $id_auto_admin=$id_a;
 
 $error =0;
 
 	  $query= "SELECT campo
 	           FROM  auto_admin_campo
 	           WHERE id_auto_admin='$id_auto_admin'
 	           AND txt= 1";
 	  
 	  
 	     $result= cms_query($query)or die (error($query,mysql_error(),$php));
 	      while (list($campo) = mysql_fetch_row($result)){
 	      	
 	      	if($_POST[$campo]==""){
 	      		
 	      		$error ="1";
 	      		
 			 header("HTTP/1.0 307 Temporary redirect");
 			 header("Location:index.php?accion=$accion&msj=1");
 			 
 	      	}
 	      	 							   
 			 }
 
 		if($error==0){
 			
 			
 			
 		
 
  $query= "SELECT tabla   
           FROM  auto_admin 
           WHERE id_auto_admin='$id_auto_admin'";
//echo $query;
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      if (list($nom_tabla) = mysql_fetch_row($result)){
						   
		 
      	
      	  $query= "SELECT campo,id_tipo_campo, carpeta  
   		           FROM  auto_admin_campo
   		           WHERE  id_auto_admin=$id_auto_admin
				   order by id_campo";
   		     //echo $query;
   		     $resultc= cms_query($query)or die ("ERROR $php  1sd <br>$query");
   		      while (list($campos, $id_tipo_campo, $carpeta) = mysql_fetch_row($resultc)){
   		 		
				
				
     		     if($id_tipo_campo!=8){     		     	
     		   
     		     	//$archivo="";
   				$cont_c++;
   		      	$lista_de_campos .="$campos,";
   		      	$valor_campo= trim($_POST[$campos]); 
				//$valor_campo = caracteres_html($valor_campo);
				$lista_de_camp_for .=  "'".$valor_campo."',";
				
				  }else{	
				  
				 // echo ">$campos<";
				  	$archivo=$campos;
				  	 	 $cont_c++; 
				  	 	 $lista_de_campos .="$campos,";     	         
   		      	     	 $imagen_name= $_POST_FILES[$campos]['name'];
   		      	     	 $lista_de_camp_for .=  "'".$imagen_name."',";
				  }
				
			   
			
		}	  			   
                         
      	$largo_lista_de_campos = strlen($lista_de_campos);
      	$lista_de_campos = substr($lista_de_campos,0,$largo_lista_de_campos-1);

     	$largo_lista_de_camp_for = strlen($lista_de_camp_for);
      	$lista_de_camp_for = substr($lista_de_camp_for,0,$largo_lista_de_camp_for-1);

      $id_r = $_POST['id_r'];
	if($id_r!=""){
		$_GET['id']=$id_r;
		
		
		$lista_de_campos="";
		include ("admin/administracion_sistema/proc/actualizar.php");
		
	}else{
		
			
			 $id=inserta($nom_tabla);
             //$id= mysql_insert_id();           
	
	}       
 }
 
 
 
					//revisar codigo ///////////

		
   		   /*  $query= "SELECT campo,id_tipo_campo, carpeta  
   		           FROM  auto_admin_campo
   		           WHERE  id_auto_admin=$id_auto_admin and id_tipo_campo=8
				   order by id_campo";
   		     
   		     $resultc= cms_query($query)or die ("ERROR $php  1sd <br>$query");
   		      while (list($campos, $id_tipo_campo, $carpeta) = mysql_fetch_row($resultc)){
   		 
		    	    
   		       	        	      	         
   		      	    // echo "$archivo dfdfdf";
				         $imagen_name= $HTTP_POST_FILES[$campos]['name'];
						 $imagen_producto= $HTTP_POST_FILES[$campos]['tmp_name'];
						 
			             $campo_pk= campo_pk_tabla($id_auto_admin);
					 	 $valor_campo_pk=valor_campo_tabla($nom_tabla, $campos, $id);
					 	
					 	
					 	 //echo "$nom_tabla, $campos, $id $imagen_producto <<< $imagen_name 33<br>";
					 	 
							 if(!is_dir("images/sitio/sistema/$nom_tabla/$campos/$id")){
				//		 	echo "images/sitio/sistema/$nom_tabla/$campos/$id";
						 		mkdir("images/sitio/sistema/$nom_tabla/$campos/$id");
						 	
						 	}			
						// echo "dfsdfsdfsdf";
						 
	  						 if($imagen_name!=""){   						 	
	  						 			 	
                   				   $imagen2 = ereg_replace('&','',$imagen_name);
				    			   $imagen2 = ereg_replace('(','',$imagen_name);
				    			   $imagen2 = ereg_replace(')','',$imagen_name);
				    			   $imagen2 = ereg_replace(' ','_',$imagen2);
								   $imagen2 = ereg_replace('*','',$imagen2);
								 $imagen2 = ereg_replace('%','',$imagen2);
								 $imagen2 = ereg_replace('?','',$imagen2);
								 $imagen2 = ereg_replace('¿','',$imagen2);
								 if(copy($imagen_producto,"images/sitio/sistema/$nom_tabla/$campos/$id/$imagen2")){
								
									$Sql ="UPDATE $nom_tabla 
                                    	   SET $campos ='$imagen2'
                                    	   WHERE $campo_pk ='$id'";
                                  //  	echo "$Sql";

 cms_query($Sql)or die (error($Sql,mysql_error(),$php));
										
								}else{
									
					         $contenido .= "Fallo, La imagen chica no se ha podido subir al servidor. <br>
							 La imagen chica no existe o es muy grande.<br>
							 Imagen temp: $imagen_producto<br> Imagen nombre : $imagen_name";
								}
					      		
					      		//echo "$imagen_producto,$carpeta/$id/$imagen2";
					
                      			}
                     				
   		      	     	
   		      	     	}*/
   		      	      
   /////		      	 
 }
 
?>