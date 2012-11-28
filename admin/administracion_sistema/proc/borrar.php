<?php
//borrar
$tabla_borrar = $_GET['tabla_borrar'];
//echo "$id_auto_admin";
$id_r = $_GET['id_r'];
$id_a = $_GET['id_a'];




if($tabla_borrar!=""){
	$id_a=$id_auto_admin;
	$id_x=$id;
$id=$id_r;	
	$id_auto_admin=$tabla_borrar;
	
}


if($tabla_borrar!=""){
         	//echo "index.php?accion=$accion&act=1&id_a=$id_a_auto_admin&id=$id_x";
         header("Location:index.php?accion=$accion&act=1&id_a=$id_auto_admin&id=$id_x");
         	  // echo "hola";
}else{
		 
		 
		 

$query= "SELECT tabla
FROM auto_admin
WHERE id_auto_admin='$id_auto_admin'";
//echo $query;
$result0= cms_query($query)or die (error($query,mysql_error(),$php));
 list($nom_tabla) = mysql_fetch_row($result0);
 
 
$query= "SELECT campo  
   		           FROM  auto_admin_campo
   		           WHERE id_auto_admin=$id_auto_admin and id_tipo_campo=1
				   order by id_campo";
//echo "$query<br>";

             $result= cms_query($query)or die (error($query,mysql_error(),$php));
             list($pk_campo) = mysql_fetch_row($result);
    	 
		 
		 	  $query= "SELECT DISTINCT id_auto_admin  
           				FROM  auto_admin_campo
           				WHERE campo='$pk_campo' and id_auto_admin<>$id_auto_admin";
     $result6= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($id_auto_admin_rel) = mysql_fetch_row($result6)){
	
	  		$tabla_rela = tabla($id_auto_admin_rel);
			    $query= "SELECT count(*)   
                       FROM  $tabla_rela
                       WHERE $pk_campo='$id'";
                 $result_tot1= cms_query($query)or die (error($query,mysql_error(),$php));
                  list($tot_reg) = mysql_fetch_row($result_tot1);
				  
				  
			if($tot_reg > 0){
				$lista .= "<tr><td align=\"left\" class=\"textos\"><strong>$tot_reg registros en tabla $tabla_rela</strong></td></tr> ";	   
			}
			
			
		
		 }
			

				if($lista!="" ){
							if($lista!="" and $_GET['ok']==0){
									 $contenido = "<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"tabla_amarillo_sin_ico\">
                        				<tr><td align=\"center\" class=\"textos\">Extisten tablas relacionadas con este dato,
										&iquest;Desea borrar los datos relacionados? </td></tr> 
										<tr><td align=\"center\" class=\"textos\">
										  <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                                            <tr>
                                              <td align=\"center\" class=\"textos_rojo\">
											  <a href=\"index.php?accion=$accion&act=$act&id_a=$id_a&id=$id&ok=1\">SI</a></td>
                                              <td align=\"center\" class=\"textos\">
											  <a href=\"index.php?accion=$accion&act=$act\">NO</a></td> 
											  </tr>
                                        	</table>
										 </td></tr> 
										 $lista
                       				   </table>";
							
							
							}elseif($lista!="" and $_GET['ok']==1){
								
								  $query= "SELECT DISTINCT id_auto_admin  
           									FROM  auto_admin_campo
           									WHERE campo='$pk_campo' and id_auto_admin<>$id_auto_admin";
     								$result2= cms_query($query)or die (error($query,mysql_error(),$php));
      								while (list($id_auto_admin_rel) = mysql_fetch_row($result2)){
	
	  								$tabla_rela = tabla($id_auto_admin_rel);
			    					$query= "SELECT count(*)   
                       						  FROM  $tabla_rela
                       						  WHERE $pk_campo='$id'";
                 					$result_tot2= cms_query($query)or die (error($query,mysql_error(),$php));
                  					list($tot_reg) = mysql_fetch_row($result_tot2);
				  
				  
									if($tot_reg > 0){
										 //$Sql ="DELETE FROM $tabla_rela WHERE $pk_campo='$id'";
                                         // cms_query($Sql)or die ("ERROR $php <br>$Sql");
										  borrar($tabla_rela,$id);
									}
			
		
		 					}
								
								
									$query= "SELECT tabla   
           									FROM  auto_admin
           							WHERE tabla_relacion='$nom_tabla'";
     								$result3= cms_query($query)or die (error($query,mysql_error(),$php));
    								while(list($tabla_rel) = mysql_fetch_row($result3)){
    	
    									borrar($tabla_rel,$id);
		    						}

									borrar($nom_tabla,$id);
			
								header("Location:index.php?accion=$accion");
			
									}
					

					}else{
			   
			   				$query= "SELECT tabla   
           							FROM  auto_admin
           							WHERE tabla_relacion='$nom_tabla'";
     						$result4= cms_query($query)or die (error($query,mysql_error(),$php));
    						while(list($tabla_rel) = mysql_fetch_row($result4)){
    	
    							borrar($tabla_rel,$id);
		    				}

							borrar($nom_tabla,$id);

			
							header("Location:index.php?accion=$accion");
					}			
			


		 
         	
}
			
?>