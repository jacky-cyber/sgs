<?php

$filtro = $_POST['filtro'];
$tabla_filtro = $_POST['tabla_filtro'];

$contador_pk="#";


if($filtro!="" and $tabla_filtro!="#"){
$condicion_filtro= " and $tabla_filtro like '%$filtro%' ";

}

$pagina=50;
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

   		$result= cms_query($query)or die (error($query,mysql_error(),$php));
      list($id_auto_admin) = mysql_fetch_row($result);
   		
   	}
   		
   		$query= "SELECT campo,existe_listado,pk,id_tipo_campo,txt,txt_xml 
   		           FROM  auto_admin_campo
   		           WHERE  id_auto_admin=$id_auto_admin and campo<>'orden'
				   order by id_campo";
   		  
   			//echo "$query<br>";
   		     $resultc= cms_query($query)or die (error($query,mysql_error(),$php));
   		      while (list($campos,$existe_listado,$pk,$id_tipo_campo,$txt,$txt_xml) = mysql_fetch_row($resultc)){
   		      	//echo "$campos<br>";
   				$campo_txt_tbl_pk="";
				if($existe_listado==1){
   		       
   					if(substr_count ($campos, "id_") and $pk!=1){
   						
   						$tbl_pk= campo_pk($campos,$DATABASE);
						
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
   		      	  	}
   					
   		        $cont++;
   		      
				$cont_c++;
   		      	$lista_de_campos .="$campos,";
				
				$campos2 = str_replace("_"," ",$campos);	//reemplaza "_" por blanco en $campos 
				$campos2 = str_replace("id "," ",$campos2);	//reemplaza "_" por blanco en $campos 
				$campos2 = ucwords($campos2);				//pone la primera letra en mayuscula
				$nom_columnas .="<th align=\"center\"><h3>$campos2</h3></th>\n ";	
   		      	
				}
				
				$campos2 = str_replace("_"," ",$campos);
				if($txt==1){
				$lista_campos .="<option value=\"$campos\" selected>$campos2</option>";		   
				}else{
				$lista_campos .="<option value=\"$campos\">$campos2</option>";		   
				}
   		      
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
   		 	     $result1= cms_query($query)or die (error($query,mysql_error(),$php));
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
   		     $result2= cms_query($query)or die (error($query,mysql_error(),$php));
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
             $result= cms_query($query)or die (error($query,mysql_error(),$php));
             list($pk_campo) = mysql_fetch_row($result);
		
             
//<<<<<
  $query= "SELECT  count(*) 
	               FROM  $nom_tabla 
				   where 1 $condicion_filtro";
	        // echo "$query";   
   
	     $result33= cms_query($query)or die (error($query,mysql_error(),$php));
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
                 $paginacion2";
				 
				//echo "$query<br>";
   	$num_res = $pag*$pagina;
   			
     $result= mysql_query($query)or die (error($query,mysql_error(),$php));
     
     
	
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
		
		/* if($contador_pk==$i and $contador_pk!="#"){
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
				  $valor = acentos($valor);
				  }
			
 			}*/
			
					if($tipo=="date") {
						$valor=fechas_html($valor);
					}
					
					  $query= "SELECT id_tipo_campo   
                       FROM  auto_admin_campo
                       WHERE campo='$campo_nom' and id_auto_admin='$id_auto_admin'";
                     //  echo $query;
					     $result_camp= cms_query($query)or die (error($query,mysql_error(),$php));
                         list($id_tipo_campo) = mysql_fetch_row($result_camp);
						//echo $valor."<br>"; 
						
					 $valor=valor_campo_lista($id_auto_admin,$campo_nom,$id_tipo_campo,$valor);
					
					if($valor==""){
						$valor="&nbsp;";
					}
					  
						 
						 
					$lista_campos_html .="<td align=\"left\" class=\"textos\"> $valor</td>";
		 
		 
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
		 	
		
		
if(verfica_permiso($id_auto_admin,$id_perfil,'ver')){
$configurar_ver= "<td align=\"center\" class=\"nosort\">
		<a href=\"index.php?accion=$accion&act=18&id_a=$id_auto_admin&id=$id&width=400&axj=1\" class=\"jTip\" id=\"$id\" name=\"Detalle de Registro\"><img src=\"images/lupa.gif\" alt=\"Ver\" border=\"0\"></a>
		</td>";
}


if(verfica_permiso($id_auto_admin,$id_perfil,'editar')){
$configurar_editar = "<td align=\"center\" class=\"nosort\">$configurar_editar</td>";
}

if(verfica_permiso($id_auto_admin,$id_perfil,'borrar')){
$configurar_borrar = "<td align=\"center\" class=\"nosort\">$configurar_borrar</td>";
}


		
		 	$listado .=
      	"<tr >
      	<td align=\"center\" class=\"textos\">$num_reg</td>\n 
		$lista_campos_html
      	$configurar_ver\n
		$configurar_editar\n
      	$configurar_borrar\n
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
/*
$js33.="<link rel=\"stylesheet\" href=\"js/paginador/themes/blue/style.css\" type=\"text/css\" media=\"print, projection, screen\" />
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

*/


if(verfica_permiso($id_auto_admin,$id_perfil,'ver')){
$titulo_ver= "<th align=\"center\" width=\"10%\" class=\"nosort\"><h3>Ver </h3></th>";
}


if(verfica_permiso($id_auto_admin,$id_perfil,'editar')){
$titulo_editar = "<th align=\"center\" width=\"10%\" class=\"nosort\" ><h3>Editar</h3></th>";
}

if(verfica_permiso($id_auto_admin,$id_perfil,'borrar')){
$titulo_borrar = "<th align=\"center\" width=\"10%\" class=\"nosort\" ><h3>Borrar</h3></th>";
}



$texto_lista = "  
			
			<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" id=\"table1\" class=\"tinytable\" align=\"center\">
    			<thead>
			
                <tr>
                   <th align=\"center\" width=\"10%\" class=\"nosort\"><h3>&nbsp; </h3></th>
                    $nom_columnas\n
		 			$titulo_ver\n
					$titulo_editar\n
					$titulo_borrar\n
					
                </tr>
			
            </thead>
            <tbody>
                $listado
              
            </tbody>
        </table>
			";
			
			if($id_perfil==999){
			$barra_buscar=" <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                   <tr>
                     <td align=\"left\" class=\"textos\">
					 
					  Buscar <input type=\"text\" name=\"filtro\" value=\"$filtro\" size=\"6\">-$lista_campos<input type=\"submit\" name=\"Submit\" value=\"Enviar\" class=\"boton\"></td>
		      
					 </td>
                    <td align=\"right\" class=\"textos\">
					  
					  Seleccionar por $filtro_dependiente1
					</td>
                     </tr>
               	</table>";
			}
			
$texto_lista= crea_tabla_tiny($texto_lista);
$contenido.= "
      	
      	
  
<table width=\"95%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
 <tr>
		       <td align=\"left\" class=\"textos\">
			    
			   $barra_buscar
		       
		       </td>
		       </tr>
    <tr><td align=\"center\" class=\"textos\">$texto_lista </td></tr> 
  	</table>
	



   ";     

//$contenido = acentos($contenido);	 	


 function valor_campo_lista($id_auto_admin,$nom_campo,$id_tipo_campo,$valor_nom_campo){

 switch ($id_tipo_campo) {
             case 1: //PK
                 //include ("contenido/contenido.php");
                 break;
        	 case 4://text
                 if($valor_nom_campo==1){
				 $valor_nom_campo='si';
				 }else{
				 $valor_nom_campo='no';
				 }
                 break;
           	 case 5://text
           //    echo $valor_nom_campo; 	
			  $os = explode(",", $valor_nom_campo);
	 //<input type="checkbox" name="#nombre_campo#" value="#valor_campo_pk#"  id="#nombre_campo#" #checked1#>#valor_campo_txt#
		     $query= "SELECT relacion   
	 	              FROM  auto_admin_campo
	 	              WHERE id_auto_admin='$id_auto_admin' and campo='$nom_campo'";
	 	     
	// echo "$query<br>";
	 	        $result= cms_query($query)or die (error($query,mysql_error(),$php));
	 	      list($tabla_relacion) = mysql_fetch_row($result);
       		   
			    $query= "SELECT id_auto_admin
                       FROM  auto_admin
                       WHERE   tabla  ='$tabla_relacion'";
                 $result21= cms_query($query)or die (error($query,mysql_error(),$php));
                  list($id_auto_admin_rel) = mysql_fetch_row($result21);
				  
				  $campo_pk_rel = campo_pk_tabla($id_auto_admin_rel);
				  $campo_txt_rel= campo_txt($id_auto_admin_rel);
				  
				      $query= "SELECT $campo_pk_rel,$campo_txt_rel  
                             FROM  $tabla_relacion";
                       $result= cms_query($query)or die (error($query,mysql_error(),$php));
                        while (list($id_campo_pk_rel,$txt_campo_txt_rel) = mysql_fetch_row($result)){
						
									//echo "<br>$aEntidad $id_entidad encontrado:".$encontrado;
									$checked="";
									if(in_array($id_campo_pk_rel,$os)){
											//$checked = "checked";
											$check_campos .="$txt_campo_txt_rel ,";
									}
									  
						 }
				  
				 $valor_nom_campo = trim($check_campos);
				 $valor_nom_campo= elimina_ultimo_caracter($valor_nom_campo);
					
                 break;
			 case 6://text
               
		
	      $query= "SELECT id_auto_admin
	 	              FROM  auto_admin_campo
	 	              WHERE pk='1' and campo='$nom_campo'";
	 	
	 	        $result= cms_query($query)or die (error($query,mysql_error(),$php));
	 	      if(!list($id_auto_admin_tabla_relacion) = mysql_fetch_row($result) ){
			  	
				
				
				
	 	      	if($campo_relacion!=""){}
					 
					     $query= "SELECT id_auto_admin
	 	              		      FROM  auto_admin_campo
	 	              			  WHERE pk='1' and campo='$campo_relacion'";
								// echo $query." -->$nom_campo<br>";
                         $result= cms_query($query)or die (error($query,mysql_error(),$php));
                         list($id_auto_admin_tabla_relacion) = mysql_fetch_row($result);
                    											   
                    		 
				
			
			  }
       		   
			    $query= "SELECT tabla
                       FROM  auto_admin
                       WHERE   id_auto_admin  ='$id_auto_admin_tabla_relacion'";
                 $result21= cms_query($query)or die (error($query,mysql_error(),$php));
                  list($tabla_relacion) = mysql_fetch_row($result21);
				  
				  $campo_pk_rel = campo_pk_tabla($id_auto_admin_tabla_relacion);
				  $campo_txt_rel= campo_txt($id_auto_admin_tabla_relacion);
				  		$valor_pk = $valor_nom_campo;
						if($campo_pk_rel!="" and $campo_txt_rel!="" and $tabla_relacion!=""){
						$query= "SELECT $campo_txt_rel  
                             FROM  $tabla_relacion
							 WHERE $campo_pk_rel='$valor_pk'";
							
                         $result= cms_query($query)or die (error($query,mysql_error(),$php));
                      	 list($txt_campo_txt_rel) = mysql_fetch_row($result);
					  
							
						 $valor_nom_campo = $txt_campo_txt_rel ;
				
						}
						
				      
                 break;
			case 9://text
               	 $valor_nom_campo = fechas_html($valor_nom_campo);
                 break;
            case 10://text
               	 if($valor_nom_campo==1){
				 $valor_nom_campo='Mujer';
				 }else{
				 $valor_nom_campo='Hombre';
				 }
                 break;
          
           case 19://text
               	 $query= "SELECT id_auto_admin  
	 	              FROM  auto_admin_campo
	 	              WHERE pk='1' and campo='$nom_campo'";
	 	   
	 	        $result= cms_query($query)or die (error($query,mysql_error(),$php));
	 	      list($id_auto_admin_tabla_relacion) = mysql_fetch_row($result);
       		   
			    $query= "SELECT tabla
                       FROM  auto_admin
                       WHERE   id_auto_admin  ='$id_auto_admin_tabla_relacion'";
                 $result21= cms_query($query)or die (error($query,mysql_error(),$php));
                  list($tabla_relacion) = mysql_fetch_row($result21);
				  
				  $campo_pk_rel = campo_pk_tabla($id_auto_admin_tabla_relacion);
				  $campo_txt_rel= campo_txt($id_auto_admin_tabla_relacion);
				  		$valor_pk = $valor_nom_campo;
				      $query= "SELECT $campo_txt_rel  
                             FROM  $tabla_relacion
							 WHERE $campo_pk_rel='$valor_pk'";
                       $result= cms_query($query)or die (error($query,mysql_error(),$php));
                      list($txt_campo_txt_rel) = mysql_fetch_row($result);
					  
							
				 $valor_nom_campo = $txt_campo_txt_rel ;
			
                 break;
               case 7://text
               	 $visible=1;
                 break;
		       case 18://text
               	 $visible=1;
                 break;
		
           
           	 
           	default:
			//id_tipo_campo 2,3,7,8,11,12,13,14,15,16,17
                
         }
		 
	

	$valor_nom_campo = trim($valor_nom_campo);
	return $valor_nom_campo;
	
	
 }
?>