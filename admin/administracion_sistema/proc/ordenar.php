<?php

$categoriesListOrder = $_POST['categoriesListOrder'];
$divOrder = $_POST['divOrder'];
$imageOrder = $_POST['imageOrder'];
$imageFloatOrder = $_POST['imageFloatOrder'];



$query= "SELECT campo  
   		           FROM  auto_admin_campo
   		           WHERE id_auto_admin=$id_auto_admin and id_tipo_campo=1
				   order by id_campo";
             $result= cms_query($query)or die (error($query,mysql_error(),$php));
             list($pk_campo) = mysql_fetch_row($result);



$campo_sel = $_POST['campo_sel'];


if($campo_sel!=""){

	
	if($_POST['invertir_orden']!=""){
		$ordena = "ORDER BY $campo_sel ".$_POST['invertir_orden'];
	}else{
		$ordena = "order by $campo_sel";
	}
	   
	   
	    $query= "SELECT $pk_campo
               FROM  $nom_tabla
			   
			   $ordena";
			 ///  echo $query;
         $result= mysql_query($query)or die (error($query,mysql_error(),$php));
          while (list($id_campo) = mysql_fetch_row($result)){
    			$cont_or++;
				$Sql ="UPDATE $nom_tabla
                	   SET orden ='$cont_or'
                	   WHERE $pk_campo ='$id_campo'";
                				  
                	   mysql_query($Sql)or die (error($Sql,mysql_error(),$php));
						   
    		 }

}



	
if(isset($_POST['sortableListsSubmitted'])) {
	
$mensaje .="  <table width=\"300\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                <tr>
                  <td align=\"center\" class=\"textos\">Cambios realizados</td>
                  </tr>
            	</table>";
	


 $query= "SELECT count(*)
           FROM $nom_tabla";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
     list($total) = mysql_fetch_row($result);
	//echo $query;
	
	
$accion_form = "index.php?accion=$accion&act=$act";
	
	
	
$var_arreglo = $_POST['categoriesListOrder'];


$aux=explode("&", $var_arreglo);
$a=0;
while($a<$total){

$orden_x = explode("=", $aux[$a]);

$orden_final = $orden_x[1];

$sql = "UPDATE $nom_tabla set orden='$a' WHERE $pk_campo='$orden_final'";

 cms_query($sql)or die (error($query,mysql_error(),$php));
		
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
   		     $resultc= cms_query($query)or die (error($query,mysql_error(),$php));
   		      while (list($campos,$existe_listado) = mysql_fetch_row($resultc)){
   		      //	echo "$campos<br>";
   				
				if($existe_listado==1){
				$cont_c++;
   		      	$lista_de_campos .="$campos,";
				
   		      	
				}
				
   			}
	
		$largo_lista_de_campos = strlen($lista_de_campos);
    	$lista_de_campos = substr($lista_de_campos,0,$largo_lista_de_campos-1);
		
		
		/** Select tabla count(*)*/
		$query= "SELECT count(*)  
			   FROM  $nom_tabla";
		     $result_count = cms_query($query)or die (error($query,mysql_error(),$php));
		      list($tot_reg) = mysql_fetch_row($result_count);
		/** fin select ***/
			
   		$query= "SELECT $lista_de_campos ,$pk_campo
			FROM $nom_tabla
			order by orden asc";  
	
 	//echo $query;
   	$num_res = $pag*$pagina;
   		   		
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
     
     
	 $aux=explode(",", $lista_de_campos);
	$tot_col  = count($aux)+1;
	
	
     //$num_filas = @mysql_numrows($qry);
	$num_filas = $tot_col; 
    	
    while ($b<$num_filas) {
    	 $lista_campos_html="";
		 
		 
		 $valor_id= @mysql_result($result,$b,$cont_c);
    	
    	 for ($i = 0; $i < $cont_c; $i++){
		 
		 $valor= @mysql_result($result,$b,$i);
		
		 $lista_campos_html .=" $valor ";
		      	
      	
		 
		 }
		 $lista_campos_html= cambio_texto($lista_campos_html);
		 $b++;
		 $lista .="<div id=\"item_$valor_id\" class=\"td3\">$lista_campos_html</div>\n";
		
		 }

 


		 





$tabla .=" $mensaje <br>
<table width=\"90%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" >
    <tr>
    <td align=\"center\" class=\"textos\"><h4>Para ordenar debe arrastrar una fila y luego soltarla para realizar los cambios</h4></td>
     </tr>
	</table><br>

<div id=\"listContainer\" align=\"center\">
			    $lista
		</div>
";




$peso="$";

$js .=" <script src=\"js/scriptaculous/prototype.js\" type=\"text/javascript\"></script>
		<script src=\"js/scriptaculous/scriptaculous.js\" type=\"text/javascript\"></script>
		
		<script>
		Event.observe(window,'load',init,false);
		function init() {
			Sortable.create('listContainer',{tag:'div',onUpdate:updateList});
		}
		function updateList(container) {
		
			var url = 'admin/administracion_sistema/proc/ordena_ajax.php?accion=$accion';
				var params = Sortable.serialize(container.id);
				
			var ajax = new Ajax.Request(url,{
				method: 'post',
				parameters: params,
				onLoading: function(){ $('workingMsg').show()},
				onLoaded: function(){ $('workingMsg').hide()}
			});
			
		}
	</script>
<style type=\"text/css\">

	
	
	div#listContainer {
	width: 400px;
	border: 2px solid #336699;
	background: #EFF7FF;
	}
	div#listContainer div {
		border: 1px solid #336699;
		margin: 5px;
		padding: 3px 5px;
		background: #DFEFFF;
		font-weight: bold;
		cursor: move;
		font-size: 10px;
	font-family: Verdana;
	font-style: normal;
	font-stretch: normal;
	text-align: left;
	}
  </style>	";	
	






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
  <table   border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
 <tr><td align=\"center\" class=\"textos\">
   Ordenar por campo <select name=\"campo_sel\" name=\"campo_sel\">
                  $lista_campos_sele
                 </select> 
				 $imagen_orden <input type=\"submit\" name=\"Submit\" value=\"Ordenar\">
    </td></tr> 
    <tr >
      <td align=\"center\" class=\"textos\">$tabla</td>
      </tr> 
	  
	</table>
";



?>