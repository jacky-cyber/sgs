<?php


$filtro = $_POST['filtro'];
$tabla_filtro = $_POST['tabla_filtro'];

$contador_pk="#";


if($filtro!="" and $tabla_filtro!="#"){
$condicion_filtro= " and $tabla_filtro like '%$filtro%' ";

}

$pagina=150;
//listado
crear_campo_orden($nom_tabla);
//echo "$nom_tabla";
$pag = $_GET['pag'];	

if(substr_count ($nom_tabla, $cpl)){
   			
   			$nom_tabla2= str_replace("$cpl","",$nom_tabla);
   		}
   
	if($id_auto_admin==""){
			

   		$query= "SELECT id_auto_admin   
           FROM  acciones
           WHERE accion='$accion'";

   		$result= mysql_query($query)or die ("ERROR $php  1 <br>$query");
      list($id_auto_admin) = mysql_fetch_row($result);
   		
   	}
   		
   		$query= "SELECT campo,existe_listado,pk,id_tipo_campo  
   		           FROM  auto_admin_campo
   		           WHERE  id_auto_admin=$id_auto_admin
				   order by id_campo";
   		  
   			//echo "$query<br>";
   		     $resultc= mysql_query($query)or die ("ERROR $php  1sd <br>$query");
   		      while (list($campos,$existe_listado,$pk,$id_tipo_campo) = mysql_fetch_row($resultc)){
   		      	//echo "$campos<br>";
   				$campo_txt_tbl_pk="";
				if($existe_listado==1){
   		       
   					if(substr_count ($campos, "id_") and $pk!=1){
   						
   						$tbl_pk= campo_pk($campos,$DATABASE);
						
						
   						// $tbl_pk=tabla($id_auto_admin_tbl);
						//echo "holss $campos<br>";
						
   						if($tbl_pk!=""){
   		      					$campo_tbl_pk = $campos;
   		      	  				$query= "SELECT id_auto_admin  
   		      	          				 FROM auto_admin 
   		      	          				 WHERE tabla='$tbl_pk'";
   		      	  				
   		      	     				$resultq= mysql_query($query)or die ("ERROR $php  1 <br>$query");
   		      	     			 list($id_auto_admin_tbl_pk) = mysql_fetch_row($resultq);
   		      	
   		      	 				$query= "SELECT campo
   		      	          				 FROM auto_admin_campo 
   		      	          				 WHERE id_auto_admin='$id_auto_admin_tbl_pk' and existe_listado =1";

   		      	
   		      					 $resultq= mysql_query($query)or die ("ERROR $php  1 <br>$query");
   		      	     			 list($campo_txt_tbl_pk) = mysql_fetch_row($resultq);
   		      	    			
   		     	   					$contador_pk= $cont;
   		     	   					
   		     	   					$ver_pk="ok";
									
   		      	         
   		      					}
   					}else{
   						
   						$query= "SELECT campo
   		      	          				 FROM auto_admin_campo 
   		      	          				 WHERE id_auto_admin='$id_auto_admin' and existe_listado =1";

   		      	
   		      					 $resultq= mysql_query($query)or die ("ERROR $php  1 <br>$query");
   		      	     			 list($campo_txt_tbl_pk) = mysql_fetch_row($resultq);
   		      	    
   		      	     			//echo "hol $campo_txt_tbl_pk<br>"; 
   		      	     			 
   					}
   					
   		       
   		   
   		     
   		       $cont++;
   		     
   		       
   		       
				$cont_c++;
   		      	$lista_de_campos .="$campos,";
				
				$campos2 = str_replace("_"," ",$campos);	//reemplaza "_" por blanco en $campos 
				$campos2 = str_replace("id "," ",$campos2);	//reemplaza "_" por blanco en $campos 
				
				$campos2 = ucwords($campos2);				//pone la primera letra en mayuscula
				$nom_columnas .="<th align=\"center\" class=\"textos\">$campos2</th> ";	
   		      	
				}
				
   		      $lista_campos .="<option value=\"$campos\">$campos</option>";		   
   		}
   		
   		
/////////

/////////parte nueva de filtrar por grupo u otra cosa   	   	
   	
$campo_filtro = $_GET['campo_filtro']; 		
   		

   		 if($campo_filtro!=""){
   		 	
   		 	
   		 	$tabla_filtro= campo_pk($campo_filtro,$DATABASE);
   		 	//echo "$tabla_filtro<br>";
   		 	
   		 	$id_auto_admin_filtro= id_tabla($tabla_filtro);
   		 	//echo "$id_auto_admin_filtro<br>";
   		 	
   		 	$campo_txt_filtro= campo_txt($id_auto_admin_filtro);
   		 	//echo "$campo_txt_filtro";
   		 	
   		 	$campo_pk= campo_pk_tabla($id_auto_admin_filtro);
   		 	//echo "$valor_pk<br>";
   		 	
   		 	  $query= "SELECT $campo_pk,$campo_txt_filtro
   		 	           FROM  $tabla_filtro
   		 	           ORDER BY orden asc";
   		 	 //echo $query." zfsdfsd<br>";
   		 	     $result1= mysql_query($query)or die ("ERROR qqq $php <br>$query");
   		 	      while (list($valor_pk,$campo) = mysql_fetch_row($result1)){
   		 				
   		 		$campo2 = str_replace("id_","",$campo);   		      	
   		      	$campo2 = str_replace("_"," ",$campo2);
   		 			 
   		 			 if($id==$valor_pk){
					 $lista_filtro_dependiente1 .="<option selected value=\"index.php?accion=$accion&campo_filtro=$campo_pk&id=$valor_pk\">$campo2</option>";
   		     
					 }else{
					 $lista_filtro_dependiente1 .="<option value=\"index.php?accion=$accion&campo_filtro=$campo_pk&id=$valor_pk\">$campo2</option>";
   		     
					 }
   		 			 
   		 			 
   		 			 
   		 			 if($id!="" and $campo_filtro!=""){
   		 			 	
   		 			 	$condicion_filtro = " and $campo_filtro = $id";
   		 			 	
   		 			 }

   				 }
   		
   		   				
   	$filtro_dependiente1 ="<select name=\"menu1\" onChange=\"MM_jumpMenu('parent',this,0)\">
   	    						<option value=\"#\">Seleccione filtro</option>
   	    						$lista_filtro_dependiente1
   	  						</select>";
   		 	
   		 }else {  		 	
   		 	
   				 	
   				 	
   		  $query= "SELECT  campo 
   		           FROM  auto_admin_campo
   		           WHERE id_auto_admin='$id_auto_admin' and pk=0 and id_tipo_campo=6";
   		 // echo "$query";
   		     $result2= mysql_query($query)or die ("ERROR $php <br>$query");
   		      while (list($campo) = mysql_fetch_row($result2)){
		
   		      	$campo2 = str_replace("id_","",$campo);   		      	
   		      	$campo2 = str_replace("_"," ",$campo2);
   		      	
   		      	//echo "$campo";			   
   		      	$lista_filtro_dependiente1 .="<option value=\"index.php?accion=$accion&campo_filtro=$campo\">$campo2</option>";
   		      	
   				 }
   		
   		   				
   	$filtro_dependiente1 ="<select name=\"menu1\" onChange=\"MM_jumpMenu('parent',this,0)\">
   	    						<option value=\"#\">Seleccione filtro</option>
   	    						$lista_filtro_dependiente1
   	  						</select>";
   	
   				 	
   				 }
   		 	

   				 
   	
/////////   	
   		
		
		$lista_campos="<select name=\"tabla_filtro\" class=\"textos\">
					<option value=\"#\">seleccione un campo</option>
						$lista_campos
					</select>";

		
		
		  $query= "SELECT campo  
   		           FROM  auto_admin_campo
   		           WHERE id_auto_admin=$id_auto_admin and id_tipo_campo=1 and pk=1
				   order by id_campo";
             $result= mysql_query($query)or die ("ERROR $php  1 <br>$query");
             list($pk_campo) = mysql_fetch_row($result);
		
             
//<<<<<
  $query= "SELECT  count(*) 
	               FROM  $nom_tabla 
				   where 1 $condicion_filtro";
	        // echo "$query";   
   
	     $result33= mysql_query($query)or die ("ERROR $php (Revisar admin acciones y tablas auto_admin) linea 125<br>$query");
	     list($tot_res) = mysql_fetch_row($result33);
		          
				 if($tot_res>0){
				$tot_paginas = (int)($tot_res/$pagina);	
			     }
				
				
				$cont=0;
				
				while ($tot_paginas > $cont){
					
					if($cont==$pag){
						$tabla_paginas .= " <td align=\"center\" class=\"textos\"> 
								<font color=\"#000000\"><b>$cont</b></font>
								</td>";
						
					}else{
						$tabla_paginas .= " <td align=\"center\" class=\"textos\"> 
						 <a href=\"?accion=$accion&pag=$cont\">$cont</a>
				
					</td>";
					}
					
					
					$cont++;
				}
				if($tot_res>0){
				$resto = $tot_res % $pagina;
				}
				if($resto!=0){
					if($cont==$pag){
						$tabla_paginas .= "<td align=\"center\" class=\"textos\"> 
								<font color=\"#000000\"><b>$cont</b></font>
								</td>";
					}else{
						$tabla_paginas .="<td align=\"center\" class=\"textos\">
									      <a href=\"?accion=$accion&pag=$cont\">$cont</a>
				       					  </td>";	
							$cont++;
					}
				$tot_paginas = $tot_paginas +1;
				//echo $resto;
				}
				
				$tabla_paginas =  "<input type=\"hidden\" name=\"pag\" value=\"\">
				<table  border=\"0\" align=\"center\" cellpadding=\"3\" cellspacing=\"3\">
				    $tabla_paginas
					</table>";
				
				
				
				
				if($pag!=""){
					
					$ini = $pag * $pagina;
					
					
					$paginacion = "limit $ini , $pagina";
				}else{
					
					$paginacion = "limit 0 , $pagina";
				}

            
             
//  <<<<<<<           
   		
		
		$largo_lista_de_campos = strlen($lista_de_campos);
    	$lista_de_campos = substr($lista_de_campos,0,$largo_lista_de_campos-1);
		
		

	
		
		
		
   		$query= "SELECT $lista_de_campos ,$pk_campo
                 FROM $nom_tabla  
				 where 1 $condicion_filtro 			
                 order by orden asc
                 $paginacion";
				 
				//echo "$query<br>";
   	$num_res = $pag*$pagina;
   			
     $result= mysql_query($query)or die ("ERROR $php  1 <br>$query");
     
     
	
     $num_filas = mysql_numrows($result);
	 
	 
	 
	
    	$num_reg = $ini;
		$a=0;
    while ($a<$num_filas) {
	     $num_reg++;
    	 $lista_campos_html="";
		 
    	$i=0;
    	 for ($i = 0; $i < $cont_c; $i++){
		 
		 $valor= @mysql_result($result,$a,$i);
		 $tipo=  @mysql_field_type($result,$i);
		 $campo_nom= @mysql_field_name($result,$i);
		// echo $tipo."<br>";
		 if($contador_pk==$i and $contador_pk!="#"){
		 	//echo "$contador_pk= =$i";
		 	//rescatar valores de campos id de otra tabla
		 	
			
			
			 $query= "SELECT id_auto_admin  
                       FROM  auto_admin_campo
                       WHERE campo='$campo_nom' and pk=1";
               // echo $query."<br>";
				 $result_r= mysql_query($query)or die ("ERROR $php <br>$query");
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
				 
				  $resultq= mysql_query($query)or die ("ERROR $php  1aa <br>$query");
   		     	  list($valor) = mysql_fetch_row($resultq);
				  }
			
				  
			/*	  
			
		 	if($campo_txt_tbl_pk!=""){
		 			
					
					
				
		 	
				}*/
 			}/*else{
			//echo "$valor $campo_nom<br>";
			
				  
				
				  
			//echo "$campo_txt_tbl_pk<br>";
			
			}	*/
				
				
									
			//$tipo_campo_txt_tbl_pk =tipo_campo($campo_txt_tbl_pk,$nom_tabla);
		 	//echo "$tipo_campo_txt_tbl_pk --> $campo_txt_tbl_pk,$nom_tabla <br>";
					if($tipo=="date") {
						$valor=fechas_html($valor);
					}
					
			
		 			$lista_campos_html .="<td align=\"left\" class=\"textos\">$valor </td>";
		 
		 
		 }
    
		 	
		
		//$i++;
	     $id= @mysql_result($result,$a, $i);
		$a++;
		
		 if($lista_campos_html!=""){	
		 	
		 	
		if(verfica_permiso($id_auto_admin,$id_perfil,'editar')){
		
	$configurar_editar ="<a href=\"?accion=$accion&act=1&id_a=$id_auto_admin&id=$id\">
      	<img src=\"images/edit.gif\" alt=\"Editar\" border=\"0\"></a>";
		
		} 	
		 
		if(verfica_permiso($id_auto_admin,$id_perfil,'borrar')){
		
	$configurar_borrar ="<a href=\"javascript:confirmar('Esta Seguro de Borrar','?accion=$accion&act=4&id_a=$id_auto_admin&id=$id')\">
	<img src=\"images/del.gif\" alt=\"Borrar\" border=\"0\"></a>";	
	
		}	
		 	
		
		
		 	$listado .=
      	"<tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\" bgcolor=\"#f8f8f8\">
      	<td align=\"center\" class=\"textos\">$num_reg</td> 
		$lista_campos_html
      	<td align=\"center\" class=\"textos\">
      	<a href=\"index.php?accion=$accion&act=18&id_a=$id_auto_admin&id=$id&width=400&axj=1\" class=\"jTip\" id=\"$id\" name=\"Detalle de Registro\"><img src=\"images/lupa.gif\" alt=\"Ver\" border=\"0\"></a>
		</td>
		<td align=\"center\" class=\"textos\">
      	$configurar_editar
      	</td>
      	<td align=\"center\" class=\"textos\">
        $configurar_borrar
      	
      	</td>
      	</tr>";
		
		
     
    
	}
      	
      	
  } 
  
  
 
//<<<<<<<<<<<		
 if($pag!=0){
	        	 
	        	$pag_ant = $pag-1;
	        	$link_ant= "<a href=\"?accion=$accion&pag=$pag_ant\"><font color=\"#ffffff\"> << </font></a>";
	        	
	        }
	        
	        $pag_next= $pag +1;
	        
	
	        if($tot_paginas > 0){
	         	
	         if($tot_paginas > $pag_next and $pag_next >$pag ){
	        	$link_next= "<a href=\"?accion=$accion&pag=$pag_next\"><font color=\"#ffffff\"> >> </font></a>";
	        	
	        }
	        
	        if($tot_paginas < $pag_next and $pag_next >$pag){
	        	$link_next= "<a href=\"?accion=$accion&pag=$pag_next\"><font color=\"#ffffff\"> >> </font></a>";
	        	
	        }
	      
	      
	        	
	        	
	        }else{
	        	$link_next= "";
	        }
	        
//<<<<<<<<<<<<<<<<<<<<	


		


$cont_ver= $cont_c+1;
$cont_editar= $cont_c+2;
$cont_borrar= $cont_c+3;

$js.="<link rel=\"stylesheet\" href=\"js/paginador/themes/blue/style.css\" type=\"text/css\" media=\"print, projection, screen\" />
	<script type=\"text/javascript\" src=\"js/paginador/jquery-latest.js\"></script>
	<script type=\"text/javascript\" src=\"js/paginador/jquery.tablesorter.js\"></script>
	<script type=\"text/javascript\" src=\"js/paginador/addons/pager/jquery.tablesorter.pager.js\"></script>
	
	<script type=\"text/javascript\" id=\"js\">$(document).ready(function() {
	$(\"table\").tablesorter({
		// pass the headers argument and assing a object
		headers: {
			// assign the secound column (we start counting zero)
			
			0: {
				// disable it by setting the property sorter to false
				sorter: false
			},
			$cont_ver: {
				// disable it by setting the property sorter to false
				sorter: false
			},
			$cont_editar: {
				// disable it by setting the property sorter to false
				sorter: false
			},
			$cont_borrar: {
				// disable it by setting the property sorter to false
				sorter: false
			}
			
			
		}
		
	});
});</script>

	<script type=\"text/javascript\" id=\"js\">$(document).ready(function() {
	// extend the default setting to always include the zebra widget.
	$.tablesorter.defaults.widgets = ['zebra'];
	// extend the default setting to always sort on the first column
	//$.tablesorter.defaults.sortList = [[0,0]];
	// call the tablesorter plugin
	$(\"table\").tablesorter();
}); </script>

<script languaje=\"javascript\">
      	      function confirmar( mensaje, destino) {  
      	     if (confirm(mensaje)) {     
      	     document.location = destino ;  
      		   }
      	}
      	
        	</script>";




$contenido.= "
      	
      	
  
<table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\">
 <tr>
		       <td align=\"left\" class=\"textos\">
			     <table width=\"95%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                   <tr>
                     <td align=\"left\" class=\"textos\">
					 
					  Buscar <input type=\"text\" name=\"filtro\" value=\"$filtro\" size=\"6\">-$lista_campos<input type=\"submit\" name=\"Submit\" value=\"Enviar\" class=\"boton\"></td>
		      
					 </td>
                    <td align=\"right\" class=\"textos\">
					  
					  Seleccionar por $filtro_dependiente1
					</td>
                     </tr>
               	</table>
			   
			  
		       
		       </td>
		       </tr>
      <tr><td align=\"center\" class=\"textos\">$tabla_paginas</td></tr>
  	</table>
	<div id=\"main\">	 
<table width=\"95%\"  border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"1\" class=\"cuadro_light\">
      <thead>
	 <tr >
	 <th align=\"center\" width=\"20\">&nbsp;</th> 
         $nom_columnas
		 <th align=\"center\" width=\"10%\" class=\"textos\">&nbsp;Ver</th>
         <th align=\"center\" width=\"10%\" class=\"textos\">&nbsp;Editar</th>
         <th align=\"center\" width=\"10%\" class=\"textos\">&nbsp;Borrar</th>
    </tr>
	 </thead>
	 <tbody>
     $listado
	 </tbody>
</table> 

  </div>
    <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
      <tr><td align=\"center\" class=\"textos\">$tabla_paginas</td></tr>
  	</table>";     

$contenido = acentos($contenido);	 	
 
?>