<?php

$tipo = $HTTP_GET_VARS['tipo'];
$order = $HTTP_GET_VARS['order'];

$pag = $HTTP_GET_VARS['pag'];


if(isset($tipo)){

  if($tipo!="all"){
  

  
  $condicion="WHERE tipo='$tipo'";
  
      $query= "SELECT descrip   
             FROM mailing_usuario_tipo WHERE id_tipo_u = '$tipo'";
            $result= cms_query($query)or die ("ERROR 1 <br>$query");
			
			list($nombre_bd) = mysql_fetch_row($result);
			
  
  }


}else{
//  $tipo=9;
 $condicion="WHERE tipo ='0'";
}


if($order==""){
$order="mail";
}







  $query= "SELECT id_tipo_u ,descrip   
                FROM mailing_usuario_tipo ";
            $result= cms_query($query)or die ("ERROR 1 <br>$query");
                  while (list($id_tipo_u ,$base) = mysql_fetch_row($result)){
            		$lista_bases .="<option value=\"$PHP_SELF?accion=$accion&act=$act&tipo=$id_tipo_u&act_all=1\">$base</option>";   
					   if($tipo!=$id_tipo_u){
					     $lista_bases2 .="<option value=\"$PHP_SELF?accion=$accion&act=$act&tipo=$tipo&imp_base=$id_tipo_u&act_all=9\">$base</option>";   
					
					    }
						  			   
            		 }
			


            		 
           
      /*Paginacion*/
	



	
	$js .="<script language=\"JavaScript\" type=\"text/javascript\"> 
function ColorFila() { 
var rows = document.getElementsByTagName(\"tr\"); 
for(var i in rows) { 
    rows[i].onmouseover = function() { 
            this.className = \"resaltar\"; 
            } 
    rows[i].onmouseout = function() { 
            this.className = null; 
            } 
    } 
} 
onload= ColorFila; 
</script>

<style type=\"text/css\"> 
.distabla tr:hover { 
         background-color: #DFE7F2; 
         color: #000000; 
} 
.distabla tr.resaltar { 
         background-color: #DFE7F2; 
         color: #000000; 
} 
 
</style>
<SCRIPT LANGUAGE=\"JAVASCRIPT\">
		<!--

		function pasa_pag(vari){
		document.frm1.pag.value= vari;
		document.frm1.method = \"POST\";
		document.frm1.submit();
		}
		//-->
		</SCRIPT>";
	
	$pagina = 1000;
	
	$query ="SELECT count(id_usuario)  
           FROM mailing_usuario
		   $condicion
		   ORDER BY $order ";

	         
  
	         
	           $result= cms_query($query)or die ("ERROR 1 <br>$query");
	             
			  list($tot_res) = mysql_fetch_row($result);
			  
			 
			$tot_paginas = (int)($tot_res/$pagina);
			$cont=0;
			while ($tot_paginas > $cont){
				if($cont==$pag){
					$tabla_paginas .= " <td align=\"center\" class=\"textos\"> 
							<font color=\"#000000\"><b>$cont</b></font>
							</td>";
					
				}else{
					
					$tabla_paginas .= " <td align=\"center\" class=\"textos\"> 
					
					 <a href=\"?accion=$accion&act=$act&tipo=$tipo&act_all=1&pag=$cont\">$cont</a>
			
				</td>";
				}
				
				
				$cont++;
			}
			
			$resto = $tot_res % $pagina;
			
			if($resto!=0){
				if($cont==$pag){
					$tabla_paginas .= "<td align=\"center\" class=\"textos\"> 
							<font color=\"#000000\"><b>$cont</b></font>
							</td>";
				}else{
					$tabla_paginas .="<td align=\"center\" class=\"textos\">
								      <a href=\"?accion=$accion&act=$act&tipo=$tipo&act_all=1&pag=$cont\">$cont</a>
			       					  </td>";	
						$cont++;
				}
			
			//echo $resto;
			}
			
			$tabla_paginas =  "<input type=\"hidden\" name=\"pag\" value=\"\">
			<table  border=\"0\" align=\"center\" cellpadding=\"3\" cellspacing=\"3\">
			    $tabla_paginas
				</table>";
			
			
			
			
			if(isset($pag)){
				
				$ini = $pag * $pagina;
				
				
				$paginacion = "limit $ini , $pagina";
			}else{
				
				$paginacion = "limit 0 , $pagina";
			}
			
			
			/**/


      		 

  $query= "SELECT id_usuario,nombre,apellido,mail,mail2,telefono1,telefono2,tipo,nomas  
           FROM mailing_usuario
		   $condicion
  		   ORDER BY $order
           $paginacion
		    ";
           $result= cms_query($query);
		    $num= mysql_num_rows($result);
			
			
		//echo $query;	
     
			
$usuarios = "<script languaje=\"javascript\">
					   function confirmar( mensaje, destino) {  
					     if (confirm(mensaje)) {     
					        document.location = destino ;  
					   	   }
					   }
					   
					   </script>
					    <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                 <tr>
                   <td align=\"center\" class=\"textos\">$nombre_bd agregar a 
				   
                  <select name=\"menu1\" onChange=\"MM_jumpMenu('parent',this,0)\" class=\"textos\">
				      <option value=\"#\" selected>---></option>
			             $lista_bases2
                      </select>
				   
				   </td>
                   </tr>
             	</table>
				  <table width=\"300\"  border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\">
                    <tr>
                      <td align=\"center\" class=\"textos\">&nbsp;</td>
                      </tr>
					<tr>
                      <td align=\"center\" class=\"textos\">
					  <a href=\"admin/mailing/admin/exp_csv.php?accion=$accion&act=$act&tipo=$tipo&act_all=11&id_base=$tipo\">Exportar $nombre_bd a CSV</a></td>
                      </tr>
					   <tr>
                      <td align=\"center\" class=\"textos\">&nbsp;</td>
                      </tr>
					<tr>
                      <td align=\"center\" class=\"textos\">
					  <a href=\"$PHP_SELF?accion=$accion&act=$act&tipo=$tipo&act_all=10\">Borrar <b>$nombre_bd </a></td>
                      </tr>
                	</table>
			 
		
			 <table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\">
               <tr>
                 <td align=\"center\" class=\"textos\">Total de mail en la Base de Datos<b> \"$nombre_bd\": $num</b></td>
               </tr>
			 
			    <tr>
              <td align=\"center\" class=\"textos\">
			  </td>
               </tr>
               <tr>
              <td align=\"center\" class=\"textos\"> $tabla_paginas
			  </td>
               </tr>
              
             </table>
			 <br>
               <table width=\"98%\" border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\">
            	<tr>
                  <td align=\"center\" class=\"textos_plomo\">
				  <a href=\"$PHP_SELF?accion=$accion&act=3010&tipo=$tipo&act_all=1&order=nombre\">Nombre</a></td>
				  <td align=\"center\" class=\"textos_plomo\">
				  <a href=\"$PHP_SELF?accion=$accion&act=3010&tipo=$tipo&act_all=1&order=mail\">Mail 1</a></td>
				  <td align=\"center\" class=\"textos\"><b>Fono1</b></td>
				  <td align=\"center\" class=\"textos\"><b>Estado</b></td>
				  
				   <td align=\"center\" class=\"textos_plomo\">&nbsp;</td>
                   <td align=\"center\" class=\"textos_plomo\"></td>
                </tr>
              ";
            
			  while (list($id_usuario,$nombre,$apellido,$mail,$mail2,$telefono1,$telefono2,$tipo_user,$nomas) = mysql_fetch_row($result)){
				
				if($nomas!=""){
				$fon_color ="#ff0000";
				$activo="Desactivo";
				}else{
				$fon_color="#000000";
				$activo ="";
				}
				
				
				$usuarios .="<tr>
                  <td align=\"left\" class=\"textos\">
				  <font color=\"$fon_color\">$nombre $apellido</font></td>
				  <td align=\"left\" class=\"textos\">$mail</td>
				   <td align=\"left\" class=\"textos\">$telefono1</td>
				   <td align=\"left\" class=\"textos\">
				   <a href=\"$PHP_SELF?accion=$accion&act=3010&act_all=8&id_usuario=$id_usuario&tipo=$tipo\">$activo
				   </td>
				  <td align=\"\" class=\"textos\">
				   <a href=\"$PHP_SELF?accion=$accion&act=$act&act_all=3&id_usuario=$id_usuario\">Edit</a></td>
                   <td align=\"center\" class=\"textos\">
				    <a href=\"javascript:confirmar('Esta Seguro de Borrar $usuario','?accion=$accion&act=$act&act_all=5&id_usuario=$id_usuario&tipo=$tipo')\">Del</a></td>
                </tr>";	
		
					   
					     
			   }

						   
			$usuarios .="<tr>
                  <td align=\"left\" class=\"textos\">&nbsp;</td>
				  <td align=\"left\" class=\"textos\"></td>
				   <td align=\"left\" class=\"textos\"></td>
                </tr></table>";		
$contenido .= $usuarios;


?>
