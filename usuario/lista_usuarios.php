<?php
$id_establecimiento_u = $_GET['id_establecimiento_u'];
$filtrar = $_POST['filtrar'];
$filtro = $_POST['filtro'];
$id_cargo = $_GET['id_cargo'];
$filtrar = $_POST['filtrar'];
$buscar_en = $_POST['buscar_en'];

$pag = $_GET['pag'];



 $query= "SELECT  id,establecimiento 
	  		   FROM  establecimientos 
	  		   ORDER BY establecimiento";
	  $result= cms_query($query)or die (error($query,mysql_error(),$php));
	      while (list($id, $establecimiento) = mysql_fetch_row($result)){
    
	      	if ($id_establecimiento_u == $id){
	      		$establecimiento_n = $establecimiento;
	      		$lista_establecimientos .="<option value=\"?accion=$accion&id_establecimiento_u=$id".$add_url."\" selected>$establecimiento </option>";
	      	}
			else{
	      		$lista_establecimientos .="<option value=\"?accion=$accion&id_establecimiento_u=$id".$add_url."\">$establecimiento</option>";
	      	}
		}
		
		if($id_establecimiento_u!=""){
			$condicion_establecimiento=" and  establecimiento='$id_establecimiento_u'"; 
			$add_url .="&id_establecimiento_u=$id_establecimiento_u";
			$cant_resultados=10;
			}else{
			$cant_resultados=50;
			}  
			
				


      $query= "SELECT   id,cargo  
	  		   FROM  tipos_cargos
			   order by cargo asc";
	  $result= cms_query($query)or die (error($query,mysql_error(),$php));
	      while (list($id_ca, $cargo_nombre) = mysql_fetch_row($result)){
    			 
	     	if ($id_cargo == $id_ca){
	       		$cargo_sel .="<option value=\"?accion=$accion&id_cargo=$id_ca".$add_url."\" selected>$cargo_nombre</option>";
	      	}
			else{
	      		$cargo_sel .="<option value=\"?accion=$accion&id_cargo=$id_ca".$add_url."\">$cargo_nombre</option>";
	      	}
		}
			
			if($id_cargo!=""){
			$condicion_cargo=" and c.id_cargo=$id_cargo";
			$add_url .="&id_cargo=$id_cargo";
			
			}
			
			
			  
			 if($pag==""){
					$limit ="limit 0,$cant_resultados";
			}else{
					$pag = $pag*10;
					$limit =" limit $pag,$cant_resultados";
				}
	
	
	
			if($filtro!=""){
				$condicion_buscar=" and p.$buscar_en like '%$filtro%'";
			}
			 
			  $pag2=$pag;
			  $query= "SELECT p.id,p.paterno,p.materno,p.nombres,p.establecimiento   
                       FROM  personal p,contratos c
					   WHERE 1 and p.id=c.id_personal
					   $condicion_buscar
                       $condicion_cargo
                       $condicion_establecimiento
					   order by nombres,establecimiento
					   $limit";
               // echo $query;
				 $result2= cms_query($query)or die (error($query,mysql_error(),$php));
                  while (list($id,$paterno,$materno,$nombres,$establecimiento) = mysql_fetch_row($result2)){
				  $nombre_establecimiento= establecimiento_nombre($establecimiento);
            			$pag2++;
						
						  $query= "SELECT id_cargo   
                                   FROM  contratos
                                   WHERE id_personal='$id'";
                             $result= cms_query($query)or die (error($query,mysql_error(),$php));
                              list($id_cargo) = mysql_fetch_row($result);
							   $cargo = tipo_cargo($id_cargo);
						
						
						$tabla .="<tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\" bgcolor=\"#f8f8f8\">
            						<td align=\"left\" class=\"textos\">$pag2</td>
								 	<td align=\"left\" class=\"textos\">&nbsp;$nombres $paterno $materno</td>
								 	<td align=\"left\" class=\"textos\">$cargo</td>
								 	<td align=\"left\" class=\"textos\">$nombre_establecimiento</td>
								 	<td align=\"center\" class=\"textos\">
									<a href=\"index.php?accion=$accion&act=1&ficha=$id\">
									<img src=\"images/lupa.gif\" alt=\"Ver\" border=\"0\"></a>
									 </td>
								 </tr> ";			   
            		 }				   
		

$js .= "<script language=\"JavaScript\">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+\".location=\'\"+selObj.options[selObj.selectedIndex].value+\"\'\");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
<style type=\"text/css\">

/*Credits: Dynamic Drive CSS Library */
/*URL: http://www.dynamicdrive.com/style/ */

.pagination{
padding: 2px;
}

.pagination ul{
margin: 0;
padding: 0;
text-align: center; /*Set to \"right\" to right align pagination interface*/

}

.pagination li{
list-style-type: none;
display: inline;
padding-bottom: 1px;
}

.pagination a, .pagination a:visited{
padding: 0 5px;
border: 1px solid #9aafe5;
text-decoration: none; 
color: #2e6ab1;
}

.pagination a:hover, .pagination a:active{
border: 1px solid #2b66a5;
color: #000;
background-color: lightyellow;
}

.pagination li.currentpage{
font-weight: bold;
padding: 0 5px;
border: 1px solid navy;
background-color: #2e6ab1;
color: #FFF;
}

.pagination li.disablepage{
padding: 0 5px;
border: 1px solid #929292;
color: #929292;
}

.pagination li.nextpage{
font-weight: bold;
}

* html .pagination li.currentpage, * html .pagination li.disablepage{ /*IE 6 and below. Adjust non linked LIs slightly to account for bugs*/

}

</style>
";		

 			$query= "SELECT count(*)   
                       FROM  personal p,contratos c
					   WHERE 1 and p.id=c.id_personal
					   $condicion_buscar
                       $condicion_cargo
                       $condicion_establecimiento";
               // echo $query;
				 $result2= cms_query($query)or die (error($query,mysql_error(),$php));
                 list($numeroRegistros) = mysql_fetch_row($result2);
				
			 
$tamPag =$cant_resultados;
	 if(!isset($_GET["pag"])) 
    { 
       $pagina=0; 
       $inicio=1; 
       $final=$tamPag; 
    }else{ 
       $pagina = $_GET["pag"]; 
    } 
    //calculo del limite inferior 
    $limitInf=($pagina-1)*$tamPag; 

    //calculo del numero de paginas 
    $numPags=@ceil($numeroRegistros/$tamPag); 
   
	$cont_pag_rr=0;
	//$numPags= $numPags-1;
	//$paginacion="$cont_pag_rr<$numPags";
	while($cont_pag_rr<$numPags){
	$cont_pag_rr2++;
	
	if($pagina==$cont_pag_rr){
	$var_t .= "<li class=\"currentpage\">$cont_pag_rr2</li>";
	
	}else{
	$var_t .= "<li><a href=\"?accion=$accion&pag=$cont_pag_rr".$add_url."\">$cont_pag_rr2</a></li>";
	
	}
	
	
	
	$cont_pag_rr++;
	}
	
	
					 
					 
		$contenido = "<table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                        <tr>
                          <td align=\"center\" class=\"textos\">Filtrar por Colegio
						  	<select name=\"menu1\" onChange=\"MM_jumpMenu('parent',this,0)\" class=\"textos\">
           						 <option value=\"#\">Seleccione Colegio</option>
								  $lista_establecimientos
           					</select>
		   				</td>
                        </tr>
						<tr><td align=\"center\" class=\"textos\"> &nbsp;</td></tr> 
						<tr>
                          <td align=\"center\" class=\"textos\">Filtrar por Cargo
						  	<select name=\"menu1\" onChange=\"MM_jumpMenu('parent',this,0)\" class=\"textos\">
           						 <option value=\"#\">Seleccione Cargo</option>
								  $cargo_sel
           					</select>
		   				</td>
                        </tr>
						<tr><td align=\"center\" class=\"textos\"> &nbsp;</td></tr> 
						
						<tr><td align=\"center\" class=\"textos\">
						Buscar <input type=\"text\" name=\"filtro\" class=\"textos\">
						<input type=\"submit\" name=\"filtrar\" value=\"Filtrar\" class=\"boton\"></td></tr> 
						
						
						<tr><td align=\"center\" class=\"textos\">
						 Nombre <input type=\"radio\" name=\"buscar_en\" value=\"nombres\" checked> 
						 Ap. Paterno <input type=\"radio\" name=\"buscar_en\" value=\"paterno\"> 
						 Ap. Materno<input type=\"radio\" name=\"buscar_en\" value=\"materno\"> 
						</td></tr> 
						<tr><td align=\"center\" class=\"textos\"> &nbsp;</td></tr> 
						<tr><td align=\"center\" class=\"textos\"> 
						<div class=\"pagination\" ><ul>$var_t</ul></div></td></tr> 
						
						<tr>
						<td  >
						  <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"1\" class=\"cuadro\">
                             <tr class=\"cabeza\">
                                <td align=\"center\"></td>
                               <td align=\"center\">Nombre</td>
                              <td align=\"center\" >&nbsp;</td>
                              <td align=\"center\" >&nbsp;</td>
                              <td align=\"center\" >Ver</td>
                              </tr>
							  $tabla
                           </table>
						   </td>
						  </tr>
						
                      </table>"; 
		 

?>