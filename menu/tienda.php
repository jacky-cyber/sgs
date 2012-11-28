<?php


$id_familia= $_GET['id_familia'];



$query= "SELECT  id_familia_productos,  id_catalogo,  id_tienda,  familia_productos    
           FROM  cat_familia_productos ";
        
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($id_familia_productos,  $id_catalogo,  $id_tienda, $familia_productos) = mysql_fetch_row($result)){
      	
      	
      	$datos1="";
        $query= "SELECT  id_grupo_productos,grupo_productos   
      	           FROM cat_grupo_productos  
      	           WHERE id_familia_productos='$id_familia_productos'";
        	
      	     $result4= cms_query($query)or die (error($query,mysql_error(),$php));
      	      while (list($id_grupo_productos,$grupo_productos) = mysql_fetch_row($result4)){
      	      	
      	       
      			     
	$datos1.="
             <tr>
                 <td align=\"center\" class=\"textos\"  width=\"14\" height=\"14\" valign=\"baseline\" ></td>             
 	 	         <td align=\"left\" class=\"textos\" valign=\"top\" >
 	 	         <img src=\"images/e01.gif\" width=\"14\" height=\"16\" alt=\"\" border=\"0\" align=\"absmiddle\">
 	 	         <a href=\"index.php?accion=tienda&id_familia=$id_familia_productos&id_grupo_productos=$id_grupo_productos\" >$grupo_productos</a></td>
             </tr>";
			
  
		 }
		 
		 if($id_familia==$id_familia_productos){		 	
		 	
		 	$tienda.= "<table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"1\" cellspacing=\"0\">
		     <tr>
                 <td align=\"center\" class=\"cabeza_rojo\"  width=\"14\" height=\"14\" valign=\"baseline\" ></td>             
 	 	         <td align=\"left\" class=\"cabeza_rojo\" valign=\"top\" >
 	 	         <a href=\"?accion=tienda&id_familia=$id_familia_productos\">$familia_productos</a></td>
             </tr>
		      $datos1
		 	</table>";
	
		 
		
	}else{	
		
		$tienda.= "<table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"1\" cellspacing=\"0\">
		     <tr>
                 <td align=\"center\" class=\"cabeza_rojo\"  width=\"14\" height=\"14\" valign=\"baseline\" ></td>             
 	 	         <td align=\"left\" class=\"cabeza_rojo\" valign=\"top\" >
 	 	         <a href=\"?accion=tienda&id_familia=$id_familia_productos\">$familia_productos</a></td>
             </tr>
		      
		 	</table>"; 
		
	}
		
		 
		  
	 }	
		 
	

		
?>