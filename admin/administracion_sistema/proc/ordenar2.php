<?php


$categoriesListOrder = $_POST['categoriesListOrder'];
$divOrder = $_POST['divOrder'];
$imageOrder = $_POST['imageOrder'];
$imageFloatOrder = $_POST['imageFloatOrder'];



		    $query= "SELECT campo  
   		           FROM  auto_admin_campo
   		           WHERE id_auto_admin=$id_auto_admin and id_tipo_campo=1
				   order by id_campo";
             $result= mysql_query($query)or die (error($query,mysql_error(),$php));
             list($pk_campo) = mysql_fetch_row($result);
	
	       if(isset($_POST['sortableListsSubmitted'])) {
		       
			      $mensaje .=" <div class=\"alert alert-success\">Cambios realizados</div>";
				      
			      
			      
			       $query= "SELECT count(*)
					 FROM $nom_tabla";
				   $result= mysql_query($query)or die (error($query,mysql_error(),$php));
				   list($total) = mysql_fetch_row($result);
				      
				      
				      
				      
				      
			      $var_arreglo = $_POST['categoriesListOrder'];
			      
			      
			      $aux=explode("&", $var_arreglo);
			      $a=0;
			      while($a<$total){
			      
			      $orden_x = explode("=", $aux[$a]);
			      
			      $orden_final = $orden_x[1];
			      
			      $sql = "UPDATE $nom_tabla set orden='$a' WHERE $pk_campo='$orden_final'";
			      
			       mysql_query($sql)or die (error($query,mysql_error(),$php));
				      
			      $a++;
			      }

	
	
}

  
			       $query= "SELECT count(*)
					 FROM $nom_tabla";
				   $result= mysql_query($query)or die (error($query,mysql_error(),$php));
				   list($total) = mysql_fetch_row($result);
				   

  
   		 		  $query= "SELECT campo,existe_listado  
					     FROM  auto_admin_campo
					     WHERE  id_auto_admin=$id_auto_admin
					     order by id_campo";
   		  
		    // echo $query;
   		     $resultc= mysql_query($query)or die ("ERROR $php  1sd <br>$query");
   		      while (list($campos,$existe_listado) = mysql_fetch_row($resultc)){
   		      //	echo "$campos<br>";
   				
				if($existe_listado==1){
				$cont_c++;
   		      	$lista_de_campos .="$campos,";
				
   		      	
				}
				
   			      }
	
	       $largo_lista_de_campos = strlen($lista_de_campos);
	       $lista_de_campos = substr($lista_de_campos,0,$largo_lista_de_campos-1);
		
		
   		$query= "SELECT $lista_de_campos ,$pk_campo
			 FROM $nom_tabla
			 order by orden asc";  
	
	
	 $aux=explode(",", $lista_de_campos);
	$tot_col  = count($aux)+1;
	
   	$num_res = $pag*$pagina;
   		   		
     $result= mysql_query($query)or die (error($query,mysql_error(),$php));
     
     
	
     //$num_filas = @mysql_numrows($qry);
     $num_filas =$tot_col;
	 
    	
    while ($b<$total) {
	       $lista_campos_html="";
		 
		 
			 $valor_id= @mysql_result($result,$b,$cont_c);
    	
			      for ($i = 0; $i < $cont_c; $i++){
			       
				  $valor= @mysql_result($result,$b,$i);
				  $lista_campos_html .=" $valor ";
			       }
		 $b++;
		 $lista .="<li id=\"item_$valor_id\">$lista_campos_html</li>\n";
	       }

 
		 


$contenido .="  

<ul id=\"categories\" class=\"sortableList\">$lista</ul>

<script language=\"JavaScript\" type=\"text/javascript\">

			// <![CDATA[
							Sortable.create('categories',{tag:'li'});
								Sortable.create('divContainer',{tag:'div'});
								Sortable.create('imageContainer',{tag:'img'});
								Sortable.create('imageFloatContainer',{tag:'img',overlap:'horizontal',constraint:false});
							// ]]>
     </script>
							
";






$js .=" <script src=\"js/scriptaculous/prototype.js\" type=\"text/javascript\"></script>
		<script src=\"js/scriptaculous/scriptaculous.js\" type=\"text/javascript\"></script>
		
			<script language=\"JavaScript\" type=\"text/javascript\">
			function populateHiddenVars() {
									document.getElementById('categoriesListOrder').value = Sortable.serialize('categories');
										document.getElementById('divOrder').value = Sortable.serialize('divContainer');
										document.getElementById('imageOrder').value = Sortable.serialize('imageContainer');
										document.getElementById('imageFloatOrder').value = Sortable.serialize('imageFloatContainer');
									return true;
			}
		
		
		
		 </script>
		 
		 
		";



 $onsubmit = " onSubmit=\"populateHiddenVars();\"  id=\"sortableListForm\"";

$accion_form = "index.php?accion=$accion&act=$act";

$css .="
<style type=\"text/css\">
ul.sortableList {
	list-style-type: none;
	
	margin: 20px;
	width: 400px;
	font-size:10px;
    font-family:Verdana,Helvetica;
    color:#000;
	text-align: justify;
	   
          
}
ul.sortableList li {
	cursor: move;
	padding: 2px 2px;
	margin: 2px 0px;
	border: 1px solid #000000;
	background-color: #E8F8FF;
}

div#divContainer {
	border: 1px solid #F0FBFF;
	width: 400px;
}

div#divContainer div {
	border: 1px solid #000000;
	margin: 5px;
	padding: 2px;
	cursor: move;
}

div#imageContainer {
	margin-left: 75px;
}

div#imageContainer img {
	cursor: move;
	display: block;
	margin: 5px 0px;
	border: 1px solid #000000;
}

div#imageFloatContainer {
	width: 600px;
	border: 1px solid #000000;
}

div#imageFloatContainer img {
	float: left;
	margin: 10px;
	border: 1px solid #000000;
}

</style>";





 		  $query= "SELECT campo,existe_listado  
   		           FROM  auto_admin_campo
   		           WHERE  id_auto_admin=$id_auto_admin and pk=0 and campo <>'orden'
			   order by id_campo";
   		  
   		// echo $query;
   		     $resultc= cms_query($query)or die (error($query,mysql_error(),$php));
   		      while (list($campos,$existe_listado) = mysql_fetch_row($resultc)){
   		     $cont++;
			 
			 $lista_campos_sele .="<option value=\"$campos\">$campos</option>";
   			   	
			  }

	if($_POST['invertir_orden']!=""){
		
		if($_POST['invertir_orden']=="desc"){
			$_POST['invertir_orden']="asc";
		}else{
			$_POST['invertir_orden']="desc";
		}
	
	}else{
		$ord="desc";
		$_POST['invertir_orden']="desc";
	}
	
	$ord = $_POST['invertir_orden'];
	
	if($campo_sel!=""){
	$imagen_orden ="Invertir orden $ord<input type=\"checkbox\" id=\"invertir_orden\" name=\"invertir_orden\" value=\"$ord\">";
	}
	
	
	

$contenido ="  
		
		 
		 
						
		
			
		<div id=\"workingMsg\" style=\"display:none;\">Actualizaci&oacute;n de la Base de datos...</div>	
			
			<table width=\"300\"  border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\">
			 <tr><td align=\"center\" class=\"textos\">
   Ordenar por campo <select name=\"campo_sel\" name=\"campo_sel\">
                  $lista_campos_sele
                 </select> 
				 $imagen_orden
				 
    </td></tr>
    <tr><td align=\"center\" class=\"textos\"> <input type=\"submit\" value=\"Guardar cambios\" class=\"btn btn-success\"></td></tr>
    <tr><td align=\"center\" class=\"textos\"> $mensaje </td></tr> 
    
			  <tr><td align=\"center\" class=\"textos\"> $contenido</td></tr> 
    <tr >
      <td align=\"center\" class=\"textos\">
      
     
      <input type=\"hidden\" name=\"categoriesListOrder\" id=\"categoriesListOrder\" size=\"60\">
						<input type=\"hidden\" name=\"divOrder\" id=\"divOrder\" size=\"60\">
						<input type=\"hidden\" name=\"imageOrder\" id=\"imageOrder\" size=\"60\">
						<input type=\"hidden\" name=\"imageFloatOrder\" id=\"imageFloatOrder\" size=\"60\">
					<input type=\"hidden\" name=\"sortableListsSubmitted\" value=\"true\">
      </td>
      </tr>
    
	</table>
			
			
		";

?>