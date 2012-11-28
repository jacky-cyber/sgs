<?php


 $campo_pk= pk_tabla($nom_tabla);

  $query= "SELECT tabla
           FROM  auto_admin
           WHERE tabla_relacion='$nom_tabla'";
  //echo "$query";
     $result9= cms_query($query)or die ("ERROR $php  1 formulario.php linea 79<br>$query");
      while (list($tabla) = mysql_fetch_row($result9)){
	  $nombre_tabla = str_replace("cpl_","",$tabla);
		$nombre_tabla2 = $tabla;
	  		////
			
			$id_tabla = id_tabla($tabla);
			
			  $query= "SELECT campo, id_tipo_campo  
                       FROM  auto_admin_campo 
                       WHERE id_auto_admin ='$id_tabla' and campo<>'$campo_pk' and existe_listado=1";
                
			//echo $query."<br>";
				 $result5= cms_query($query)or die ("ERROR $php  $php linea 89<br>$query");
                
				 $campo_var="";
				 $cont_var=0;
				  while (list($campo, $id_tipo_campo) = mysql_fetch_row($result5)){
				//	echo "$campo, $id_tipo_campo<br>";
				 
            			$cont_var++;
						
						$campo_var[$cont_var]=$campo;	
						$tipo[$cont_var]=$id_tipo_campo;
						//echo $id_tipo_campo[$cont_var];	
						//echo "$tipo[$cont_var]<br>";  	
					   
            		 }
			
			$lista_de_campos .=$campo_pk;
			
			
	  		  
	        $lista_registro="";
	        
	          $query= "SELECT count(*)   
	                   FROM  auto_admin_campo
	                   WHERE id_auto_admin='$id_tabla' and campo='$campo_pk'";
	             $result= cms_query($query)or die (error($query,mysql_error(),$php));
	              list($cuenta_campos) = mysql_fetch_row($result);
	        
	              
	              if($cuenta_campos>0){
	              	
	              	     
	         $query= "SELECT count(*)  
                       FROM  $tabla
                       WHERE $campo_pk='$id'";
	      // echo "$query<br>";
			 		  					
                 $result6= cms_query($query)or die ("ERROR $php  1rr <br>$query");
                list($cantd_reg) = mysql_fetch_row($result6);
            			
	              }
	         			   
          
	        
	        
	  		///
			    $b=0;
		       $tr="";
		      // $lista_registro="";
			while($b<$cantd_reg){
		
				//echo "$b<$cantd_reg";
							
			
			$a=0;
			$lista_registro="";
			 //$tr="";
			while($a<$cont_var){
			$a++;
			//echo "dfdf ".$campo_var[$a]." $tabla dsfdddd<br>";
			
			$campo_pk_tabla=pk_tabla($tabla);
			
			 $query= "SELECT $campo_pk_tabla,".$campo_var[$a]."  
                       FROM  $tabla
                       WHERE $campo_pk='$id'
                       LIMIT $b,1";
			 
               //echo "$query<br>";
					  					
                 $result6= cms_query($query)or die ("ERROR $php  1rr <br>$query");
                list($id_r,$campo) = mysql_fetch_row($result6);
                
          //echo "dd  $tipo[$a]==9 $campo<br>";
             
             if($tipo[$a]==9){
             	 $campo=fechas_html($campo);
             	 
             }
             
             
//////             
             
              if($tipo[$a]==6){
              	//echo "$campo_var[$a]HOLA<br>";
              	$tabla_indice =campo_pk($campo_var[$a],$DATABASE);
				//echo "$campo_var[$a],$DATABASE<br>";
              	
              	$campo= valor_admin_campo($tabla_indice,$campo,$campo_var[$a]);
              	//echo "$tabla_indice,$id_r,$campo_var[$a]<br>";
              	
			}
             
/////              
             				   
            		$lista_registro.="<td align=\"center\" class=\"textos\">$campo</td>";
				//echo "$lista_registro<br>";
			}
		
			
			$b++;
		
			//echo "'admin/admin_auto_fichas/form/formulario_tabla.php?id_auto_admin=$id_tabla&id=$id&id_r=$id_r&num_crip=$num_crip&axj=1','$nombre_tabla2'";
			//echo "index.php?accion=$accion&act=4&id_auto_admin=$id_tabla&id_a=$id_a&id=$id&id_r=$id_r&tabla_borrar=$id_tabla";
			
			 $tr.="<tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\">
			 $lista_registro
			 <td width=\"30\" align=\"center\" >
			<a href=\"javascript:ObtenerDatos('index.php?accion=$accion&act=13&id_auto_admin=$id_tabla&id=$id&id_r=$id_r&num_crip=$num_crip&axj=1','$nombre_tabla2');\">
			 <img src=\"images/edit.gif\" alt=\"Editar\" border=\"0\"></a></td>
			 <td width=\"30\" align=\"center\" >
			 <a href=\"index.php?accion=$accion&act=4&id_auto_admin=$id_tabla&id_a=$id_a&id=$id&id_r=$id_r&tabla_borrar=$id_tabla\">
			 <img src=\"images/del.gif\" alt=\"Borrar\" border=\"0\"></a></td>
			  </tr>" ;
			
			//
				}
			
			$nombre_titulo="";
			$titulos="";
			$a=0;
			while($a<$cont_var){
			$a++;
			$nombre_titulo = str_replace("id_","",$campo_var[$a]);
			$nombre_titulo = str_replace("cpl_","",$nombre_titulo);
			$nombre_titulo = str_replace("_"," ",$nombre_titulo);
			$nombre_titulo = ucwords($nombre_titulo);
			
			$titulos .="<td align=\"center\" >$nombre_titulo</td> " ;
			
			}
			$titulos ="<tr class=\"cabeza_rojo\">$titulos<td align=\"center\" ></td>
			<td align=\"center\" > </td></tr> ";
			
			
			$cont_var = $cont_var+2;
			
			
			
			$nombre_tabla = str_replace("_"," ",$nombre_tabla);
			$nombre_tabla = ucwords($nombre_tabla);
			
			//echo "admin/admin_auto_fichas/form/formulario_tabla.php?id_auto_admin=$id_tabla&id=$id <br>";
			if($lista_registro!=""){
				
			///////////////
			
			}else{
			
			$tr="<tr class=\"cuadro\">
			<td align=\"center\" class=\"textos\" colspan=\"$cont_var\" >Sin Datos</td></tr> ";
			}
			
						
			//echo "admin/admin_auto_fichas/form/formulario_tabla.php?id_auto_admin=$id_tabla <br>";
			
			//$campo_txt_tabla = campo_txt($id_auto_admin);

	//		$valor_campo_tabla = valor_campo_tabla ($tabla, $campo_txt_tabla, $id);
//
//de $valor_campo_tabla

				if ($id_r!=""){

					$url ="&id_r=$id_r";

				}	

			
			$contenidoxxx .= " $js3
			
			 </form>
 <form action=\"index.php?accion=$accion&id_auto_admin=$id_tabla&id=$id&act=2&id_a=$id_a&id2=$id&$url2\" method=\"post\" name=\"form_$nombre_tabla2\">
			
			<br><table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"1\" cellspacing=\"1\" class=\"cuadro\">
			   
				 <tr class=\"cuadro\"><td align=\"center\" class=\"cabeza_rojo\" colspan=\"$cont_var\" >
				   <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                     <tr>
                       <td align=\"center\" class=\"cabeza_rojo\">$nombre_tabla</td>
                       <td align=\"right\" class=\"textos\">
					   
                        <a href=\"javascript:ObtenerDatos('index.php?accion=$accion&act=13&id_auto_admin=$id_tabla&id=$id&num_crip=$num_crip&axj=1','$nombre_tabla2');\">
                        <img src=\"images/plus.gif\" alt=\"Agregar $nombre_tabla\" border=\"0\">
                        </a>
                       				  
					   </td>
                       </tr>
                       
                 	</table>
				 </td></tr>
				 <tr>
				 <td  align=\"center\" class=\"textos\" colspan=\"$cont_var\">
				 
				
				 <div id=\"$nombre_tabla2\">
				
				 
				 </div>
				 </td>
				 </tr>
				 
                            $titulos
						    $tr
                          </table>";		   
		 }

?>