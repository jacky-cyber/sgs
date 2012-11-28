<?php
$nom_tabla=$tabla;

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
   		
   		$query= "SELECT campo,existe_listado,pk,id_tipo_campo,txt  
   		           FROM  auto_admin_campo
   		           WHERE  id_auto_admin=$id_auto_admin and campo<>'orden'
				   order by id_campo";
   		  
   			//echo "$query<br>";
   		     $resultc= cms_query($query)or die (error($query,mysql_error(),$php));
   		      while (list($campos,$existe_listado,$pk,$id_tipo_campo,$txt) = mysql_fetch_row($resultc)){
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
   		 			 
   		 			 
   		 			 
   		 			 $lista_filtro_dependiente1 .="<option value=\"index.php?accion=$accion&campo_filtro=$campo_pk&id=$valor_pk\">$campo2 </option>";
   		     
   		 			 
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
   			
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
     
     
	
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
			
 			}
					if($tipo=="date") {
						$valor=fechas_html($valor);
					}
					$lista_campos_html .="<td align=\"left\" class=\"textos\"> $valor  </td>";
		 
		 
		 }
    
		 	
		
		//$i++;
	     $id= @mysql_result($result,$a, $i);
		$a++;
		
		 if($lista_campos_html!=""){	
		
		 	
		if(verfica_permiso($id_auto_admin,$id_perfil,'editar')){
		
	$configurar_editar ="<a href=\"?accion=$accion&act=1&id=$id\">
      	<img src=\"images/edit.gif\" alt=\"Editar\" border=\"0\"></a>";
		
		} 	
		 
		if(verfica_permiso($id_auto_admin,$id_perfil,'borrar')){
		
	$configurar_borrar ="<a href=\"javascript:confirmar('Esta Seguro de Borrar','?accion=$accion&act=4&id=$id')\">
	<img src=\"images/del.gif\" alt=\"Borrar\" border=\"0\"></a>";	
	
		}	
		 	
		
		
if(verfica_permiso($id_auto_admin,$id_perfil,'ver')){
$configurar_ver= "<td align=\"center\" class=\"nosort\">
		<a href=\"index.php?accion=$accion&act=18&id=$id&width=320&axj=1\" class=\"jTip\" id=\"$id\" name=\"Detalle de Registro\"><img src=\"images/lupa.gif\" alt=\"Ver\" border=\"0\"></a>
		</td>";
}


if(verfica_permiso($id_auto_admin,$id_perfil,'editar')){
$configurar_editar = "<td align=\"center\" class=\"nosort\">$configurar_editar</td>";
}

if(verfica_permiso($id_auto_admin,$id_perfil,'borrar')){
$configurar_borrar = "<td align=\"center\" class=\"nosort\">$configurar_borrar</td>";
}



		$cont_gen++;
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
  
  
 



		


$cont_ver= $cont_c+1;
$cont_editar= $cont_c+2;
$cont_borrar= $cont_c+3;



if(verfica_permiso($id_auto_admin,$id_perfil,'ver')){
$titulo_ver= "<th align=\"center\" width=\"10%\" class=\"nosort\"><h3>Ver </h3></th>";
}


if(verfica_permiso($id_auto_admin,$id_perfil,'editar')){
$titulo_editar = "<th align=\"center\" width=\"10%\" class=\"nosort\" ><h3>Editar</h3></th>";
}

if(verfica_permiso($id_auto_admin,$id_perfil,'borrar')){
$titulo_borrar = "<th align=\"center\" width=\"10%\" class=\"nosort\" ><h3>Borrar</h3></th>";
}




			
			
//$texto_lista= crea_tabla_tiny($texto_lista);


if($cont_gen==0){
		//$tabla_general = str_replace("#LINEAS#",$lineas,$texto_lista);
	
		$contenido= "  
			<br>
			<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" id=\"table1\" class=\"tinytable\" align=\"left\">
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
               
              <tr><td align=\"center\" class=\"textos\" colspan=\"6\">Sin Datos </td></tr>
            </tbody>
        </table>
			";
		
		$sin_datos= " ";
		//$tabla_general = str_replace("#LINEAS#",$sin_datos,$tabla_general);
		//$contenido = $tabla_general;
		}else{
		
		$texto_lista = "  
			
			<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" id=\"table1\" class=\"tinytable\" align=\"left\">
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
		$contenido = crea_tabla_tiny($texto_lista);
		}

   	
		$contenido = "<table width=\"98%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                                    <tr><td align=\"center\" class=\"textos\"><h3>$titulo_administracion</h3> </td></tr> 
									 <tr>
                                       <td align=\"right\" class=\"textos\">
									   <a href=\"index.php?accion=$accion&act=1\"><img src=\"images/add.png\" alt=\"\" border=\"0\"></a></td>
                                       </tr>$sin_datos
									   <tr><td align=\"center\" class=\"textos\"> 
									
       											$contenido
												
									   </td></tr> 
                                 	</table>";

?>