<?php


$array	= $_POST['arrayorder'];

if ($_POST['update'] == "update"){
	
        	    $query= "SELECT campo  
   		           FROM  auto_admin_campo
   		           WHERE id_auto_admin=$id_auto_admin and id_tipo_campo=1
				   order by id_campo";
             $result= mysql_query($query)or die (error($query,mysql_error(),$php));
             list($pk_campo) = mysql_fetch_row($result);
        
        
       
        
        
	$count = 1;
	foreach ($array as $idval) {
		//$query = "UPDATE dragdrop SET listorder = " . $count . " WHERE id = " . $idval;
                 
                 $query = "UPDATE $nom_tabla set orden='$count' WHERE $pk_campo='$idval'";
                 
		mysql_query($query) or die('Error, insert query failed');
		$count ++;	
	}
	$contenido = 'Cambios realizados.';
        
        
}else{
   
   
   
		    $query= "SELECT campo  
   		           FROM  auto_admin_campo
   		           WHERE id_auto_admin=$id_auto_admin and id_tipo_campo=1
				   order by id_campo";
             $result= mysql_query($query)or die (error($query,mysql_error(),$php));
             list($pk_campo) = mysql_fetch_row($result);
             
             
             
             
             
             /****************************************/
             
			       $query= "SELECT count(*)
					 FROM $nom_tabla";
				   $result= mysql_query($query)or die (error($query,mysql_error(),$php));
				   list($total) = mysql_fetch_row($result);
				   

  
   		 		  $query= "SELECT campo,existe_listado  
					     FROM  auto_admin_campo
					     WHERE  id_auto_admin=$id_auto_admin
					     order by id_campo";
   		  
		    // echo $query;
                    $lista_de_campos="";
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
		 $lista .="<li id=\"arrayorder_$valor_id\" class=\"span8\">Reg:$lista_campos_html</li>\n";
	       }

 

			
				$id = stripslashes($row['id']);
				$text = stripslashes($row['text']);
					
			
 $contenido .="<div id=\"container_lista\" class=\"span8\">

  <div id=\"list\">

  
     <h2>Para ordenar toma y arrastra la fila</h2>
       <div id=\"response\" class=\"alert alert-success\"> </div>
    <ul id=\"ordena\">
      
            $lista
        <div class=\"clear\"></div>
      </li>
      
    </ul>
  </div>
</div>";
 
 
             
             /****************************************/

$css .="<style>

#ordena ul {
	padding:0px;
	margin: 0px;
}

#list li {
	margin: 0 0 3px;
	padding:8px;
	background-color:#DFEFFF;
        border:1px solid #336699;
	color:#000;
	list-style: none;
}
</style>";




$js .="<script type=\"text/javascript\" src=\"http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.js\"></script>
<script type=\"text/javascript\">
$(document).ready(function(){ 	
	  function slideout(){
  setTimeout(function(){
  $(\"#response\").slideUp(\"slow\", function () {
      });
    
}, 2000);}
	
    $(\"#response\").hide();
	$(function() {
	$(\"#list ul\").sortable({ opacity: 0.8, cursor: 'move', update: function() {
			
			var order = $(this).sortable(\"serialize\") + '&update=update'; 
			$.post(\"index.php?accion=$accion&act=$act&axj=1\", order, function(theResponse){
				$(\"#response\").html(theResponse);
				$(\"#response\").slideDown('slow');
				slideout();
			}); 															 
		}								  
		});
	});

});	
</script>";
    
    
    
}



?>