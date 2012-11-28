<?php
 $Sql ="DELETE FROM vistas_usuarios";

 cms_query($Sql);
  
$query = "SELECT id_vistas 
          FROM vistas 
          ORDER BY pagina DESC";		  
		  
$result = cms_query($query) or die ("problemas en la consulta 1.<br>$query");
	
while(list($id_vistas) = mysql_fetch_row($result)){
 
              $query_sel = "SELECT id_tipo    
                            FROM usuario_tipo";
              
			 
			  $result_sel = cms_query($query_sel) or die ("problemas en la consulta 2.<br>$query_sel");
               while(list($perfil) = mysql_fetch_row($result_sel)){
                
				
				$temp =$perfil."_".$id_vistas;
				// echo "$temp &nbsp;&nbsp;";
			
				 $temp = $_POST[$temp];
				// echo "$temp <bR>";
				 
				 
				if(isset($temp)){
				
				   $query_agregar = "INSERT
                     INTO vistas_usuarios (id_pagina,perfil)
                     VALUES ('$id_vistas','$perfil')";
                    
					//echo " <div class=\"textos\">$query_agregar   sdsds</div><br>";

 cms_query($query_agregar) or die ("No se pudo conectar!! $query_agregar");
			
				   }
							   
			  
			   }
  
     }


  header("Location:?accion=1005&id=$id_noticia&id_usuario=$id_usuario&user=$user&act=1&datos=ok");
  

?>