<?php
//actualizar


$id = $_GET['id'];


//function actualiza_tablas($id_auto_admin,$id,$pk_campo){
//echo "$id_auto_admin,$id,$pk_campo dfdd";	
	
//}

	$pk_campo = campo_pk_tabla($id_auto_admin);


	//actualiza_tablas($id_a,$id,$pk_campo);
	//echo "$id_a,$id,$pk_campo";
	
	
	$error =0;

	
 	  $query= "SELECT campo
 	           FROM  auto_admin_campo
 	           WHERE id_auto_admin='$id_auto_admin'
 	           AND txt= 1";
 	 // echo "$query <br>";
 	     $result22= cms_query($query)or die (error($query,mysql_error(),$php));
 	      while (list($campo) = mysql_fetch_row($result22)){
 	      	
 	      	if($_POST[$campo]==""){
 	      		
 	      		$error ="1";
 	      		
 			// header("HTTP/1.0 307 Temporary redirect");
 			// header("Location:index.php?accion=$accion&msj=1");
 			 
 	      	}
 	      	 							   
 			 }
			 
			 
		 
 //echo $error."rrrr";
 			if($error==0){
 				
 			

  $query= "SELECT tabla   
           FROM  auto_admin 
           WHERE id_auto_admin='$id_auto_admin'";
//echo "$query";
     $result65= cms_query($query)or die (error($query,mysql_error(),$php));
      if (list($nom_tabla) = mysql_fetch_row($result65)){
						   
	 
   /*
      	  $query= "SELECT id_campo,campo,id_tipo_campo,carpeta
   		           FROM  auto_admin_campo
   		           WHERE  id_auto_admin=$id_auto_admin and id_tipo_campo<>1 
				   order by id_campo";
   		    // echo "$query <br>";
   		     $resultc= cms_query($query)or die (error($query,mysql_error(),$php));
   		      while (list($id_campo,$campos,$id_t_c,$carpeta) = mysql_fetch_row($resultc)){  				 
   		        
				
				     		
   		         	
   		      	switch ($id_t_c) {
   		      	     case 8:
   		      	     	//tipo file
   		      	       
   		      	     	
   		      	     	
   		      	     	
   		      	         break;
						 
						   case 9:
   		      	     		//$_POST[$campos] = fechas_bd($_POST[$campos]);
   		      	     	
   		      	         break;
   		      								 
						   case 5:
						  $content="";
							foreach ($_POST[$campos]as $id_check){ 
 									
									  $content .=  "$id_check,"; 
								}
							
							
								//$_POST[$campos] = elimina_ultimo_caracter($content);
							
   		      	         break;
   		      		
   		      	   	default:
   		      		  
   		      	   }
   		          
   		 		$valor_campo= trim($_POST[$campos]);
   		 		//echo $valor_campo."<br>";
				$valor_campo= caracteres_html($valor_campo);
				if($id_t_c!=8){
							
				 $lista_de_campos .="$campos='".$valor_campo."',";	
				}
   		       
   		         
   		           //echo "$lista_de_campos<br>";
		
	 } 
	 			
   		                
    	$largo_lista_de_campos = strlen($lista_de_campos);
    	$lista_de_campos = substr($lista_de_campos,0,$largo_lista_de_campos-1);
		

     	$largo_lista_de_camp_for = strlen($lista_de_camp_for);
      	$lista_de_camp_for = substr($lista_de_camp_for,0,$largo_lista_de_camp_for-1);
  /*   
    						 
	$Sql ="UPDATE $nom_tabla 
              SET $lista_de_campos 
              WHERE $pk_campo ='$id'";
	echo $Sql;

 cms_query($Sql)or die (error($Sql,mysql_error(),$php));  
 */
 update($nom_tabla,$id);
 }

}

//
 
/*
* 
* RRR
$query= "SELECT campo  
   		           FROM  auto_admin_campo
   		           WHERE id_auto_admin=$id_auto_admin and id_tipo_campo=1
				   order by id_campo";
//echo "$query <br>";
             $result= cms_query($query)or die (error($query,mysql_error(),$php));
             list($pk_campo) = mysql_fetch_row($result);
             
             
   //actualiza_tablas($id_auto_admin,$id,$pk_campo);
   
    
 $tabla=tabla($id_auto_admin);
  
 	  $query= "SELECT id_auto_admin   
 	           FROM  auto_admin
 	           WHERE tabla_relacion='$tabla'";
 	  //echo "$query<br>";
 	     $result= cms_query($query)or die (error($query,mysql_error(),$php));
 	      while (list($id_auto_admin_rel) = mysql_fetch_row($result)){
 	      	
			$tabla_rel=tabla($id_auto_admin_rel);
			
 	      	//echo "$id_auto_admin_rel<br>";	      	
 	     //echo "$id_auto_admin_rel,$id,$pk_campo<br>"  ;
 	      	//actualiza_tablas($id_auto_admin_rel,$id,$pk_campo);
			//inserta($tabla_rel);
			
 	      	
 			 }

 			
   		   

RRR
*/

	
	
?>