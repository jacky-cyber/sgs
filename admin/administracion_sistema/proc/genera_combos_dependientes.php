<?php

 
	 	 
$tabla = busca_tabla($nom_campo,$DATABASE);     		 
       
		     $query= "SELECT id_auto_admin   
                    FROM  auto_admin
                    WHERE tabla='$tabla'";
              $result= cms_query($query)or die (error($query,mysql_error(),$php));
              if(list($id_auto_admin_tabla) = mysql_fetch_row($result)){
         						   
         		
		            
$id_campo_selecionado="$valor";


$js_sel="";
$clase="texto";

$campo_select="$nom_campo";
 	   
	 	     $query= "SELECT relacion   
	 	              FROM  auto_admin_campo
	 	              WHERE id_auto_admin='$id_auto_admin' and campo='$nom_campo'";
	 	     
	
	 	        $result= cms_query($query)or die (error($query,mysql_error(),$php));
	 	      list($tabla_relacion) = mysql_fetch_row($result);
				
				   
                	 if($tabla_relacion!=""){

	 	      	
	 	      		  $query= "SELECT campo
	 	      		           FROM  auto_admin_campo
	 	      		           WHERE relacion='$tabla' and id_auto_admin=$id_auto_admin";
	 	      		     $result23= cms_query($query)or die ("ERROR sql 23 linea 100 $php <br>$query");
	 	      		    
						
						list($filtro) = mysql_fetch_row($result23);
	 	      		    
	 	      		     if($filtro!=""){
	 	      		     	
	 	      		     	
	 	      		     	$id_busca_get = $_GET[id];
	 	      		     	$id_tabla_get = $_GET[id_a];
	 	      		     	  $query= "SELECT tabla   
         								FROM  auto_admin 
           								WHERE id_auto_admin='$id_tabla_get'";
 							 //echo $query;
    						 $result34= cms_query($query)or die ("ERROR $php linea 114 1 <br>$query");
    						  list($nom_tabla_get) = mysql_fetch_row($result34);
	 	      		     	
    						  $campo_pk_get = pk_tabla($nom_tabla_get);	
	 	      		     	  
	 	      		     	$query= "SELECT $filtro   
	 	      		               FROM  $nom_tabla_get
	 	      		               WHERE $campo_pk_get='$id_busca_get'";
	 	      		         $result34= cms_query($query)or die (error($query,mysql_error(),$php));
	 	      		          list($id_opcional) = mysql_fetch_row($result34);
	 	      		     	
	 	      		     } else{
	 	      		     	
	 	      		     	$id_opcional="";
	 	      		     }
	 	      		    
	 	      		
	 	      	}			   
                		 
				
	 	      
	 	    
//	echo "$tabla, $id_campo_selecionado, $js_sel, $clase, $id_opcional,$tabla_relacion,$id_auto_admin<br>";
	
	if($_GET['id']==""){
		$id_campo_selecionado="";
	}
	if($tabla_relacion=="#" and $tabla_relacion ==""){
	$tabla_relacion="";
	}
	//echo "$tabla, $id_campo_selecionado, $js_sel, $clase, $id_opcional,$tabla_relacion,$id_auto_admin , $nom_campo<br>";
		$html_form= select_admin_campo_relacion($tabla, $id_campo_selecionado, $js_sel, $clase, $id_opcional,$tabla_relacion,$id_auto_admin);  
 }else{
 	
	    $query= "SELECT campo_relacion,relacion   
               	 FROM  auto_admin_campo
                 WHERE campo='$nom_campo' and id_auto_admin='$id_auto_admin'";
        
		 $result= cms_query($query)or die (error($query,mysql_error(),$php));
           list($campo_relacion,$relacion) = mysql_fetch_row($result);
		   
		   if($campo_relacion!="" and $relacion==""){
		   	$query= "SELECT id_auto_admin   
               	 FROM  auto_admin_campo
                 WHERE campo='$campo_relacion' and pk=1";
        
		   $result= cms_query($query)or die (error($query,mysql_error(),$php));
           list($id_auto_admin_relacion) = mysql_fetch_row($result);
		  		   
				    $query= "SELECT tabla   
                           FROM  auto_admin
                           WHERE id_auto_admin='$id_auto_admin_relacion'";

					 $result= cms_query($query)or die (error($query,mysql_error(),$php));
                      list($tabla) = mysql_fetch_row($result);
			}elseif($campo_relacion=="" and $relacion!=""){
				$tabla= $relacion;
				$id_opcional= $nom_campo;
			}
		   
		   $html_form = select_admin_campo_simple($tabla,$valor, $js_sel, $clase,$id_opcional);
		
   		
 
 }
 
 

?>