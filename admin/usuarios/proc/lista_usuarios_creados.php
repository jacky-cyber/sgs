<?php
//lista del usuario creado

/*Paginacion*/
		
	$js .= "<SCRIPT LANGUAGE=\"JAVASCRIPT\">
		<!--

		function pasa_pag(vari){
		document.frm1.pag.value= vari;
		document.frm1.method = \"POST\";
		document.frm1.submit();
		}
		//-->
		</SCRIPT>";
	
	
	
	$pagina = 10;
	         $query= "SELECT  count(nombre)
	                 FROM usuario
	                 Where id_empresa='$id_empresa_u'"; 
	           $result1= mysql_query($query)or die (mysql_error());
	             
			  list($tot_res) = mysql_fetch_row($result1);
			  
			  
			$tot_paginas = (int)($tot_res/$pagina);
			$tot_paginas = (int)($tot_res/$pagina);
			$cont=0;
			while ($tot_paginas > $cont){
				if($cont==$pag){
					$tabla_paginas .= " <td align=\"center\" class=\"textos\"> 
							<font color=\"#000000\"> <b>$cont</b></font>
							</td>";
					
				}else{
					$tabla_paginas .= " <td align=\"center\" class=\"textos\"> 
					<a href=\"JavaScript:pasa_pag('$cont')\">$cont</a>
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
					$tabla_paginas .= "<td align=\"center\" class=\"textos\">
								      <a href=\"JavaScript:pasa_pag('$cont')\">$cont</a>
			       					  </td>";
				}
			
			
			
			//echo $resto;
			}
			
			
			
			$var_oculta = "<input type=\"hidden\" name=\"pag\" >";
			
			
			$tabla_paginas =  "$var_oculta<table  border=\"0\" align=\"center\" cellpadding=\"3\" cellspacing=\"3\">
			
			$tabla_paginas
				</table>";
						
			if(isset($pag)){
				
				$ini = $pag * $pagina;
				$paginacion = "limit $ini , $pagina";
				
			}else{
				
				$paginacion = "limit 0 , $pagina";
			}
			
			/**/
	
 
       $query= "SELECT razon_social
                 FROM empresa
                 WHERE id_empresa='$id_empresa_u'";
      
     $result2= mysql_query($query)or die (mysql_error());
      list($rz_emp) = mysql_fetch_row($result2);
      

 
 
$query= "SELECT  id_usuario,nombre, apellido
           FROM  usuario
           Where id_empresa='$id_empresa_u'
           $paginacion";
     $result= mysql_query($query)or die (mysql_error());

     
         
     while(list($id_usuario,$nombre, $apellido) = mysql_fetch_row($result))
     
     
 
     {
     	$cont++;
		if($fondo==1){
				$bg= "bgcolor=\"#ffffff\"";
				$fondo=0;
				}else{
				$fondo=1;
				$bg= "bgcolor=\"#E8E8EA\"";
				}
				
				
     	     	$datos_u .="<tr $bg>
     	     	
			    <td align=\"left\" class=\"textos\">&nbsp;$nombre</td>
			    <td align=\"left\" class=\"textos\">&nbsp;$apellido</td>
			    <td align=\"left\" class=\"textos\">&nbsp;$rz_emp</td>
			    <td align=\"center\" class=\"textos\">
			 <a href=\"index.php?accion=$accion&act=$act&act_usuario=1&id_user=$id_usuario&id_emp=$id_emp&dest=1\">
			<img src=\"icons/edit.gif\" alt=\"\" border=\"0\"></a>
		    </td>
			  <td align=\"center\" class=\"textos\">
			<a href=\"javascript:confirmar('Esta Seguro de Borrar $nombre','?accion=$accion&act=$act&act_usuario=7&id_user=$id_usuario&id_emp=$id_emp&dest=2')\">
	     <img src=\"icons/del.gif\" alt=\"\" border=\"0\"></a>
	     </td>
	     </tr>"; 
     	
     	
     }

   
     
if($idm=='eng'){
 
		 $lista_de_datos = "<script languaje=\"javascript\">
function confirmar( mensaje, destino) {  
  if (confirm(mensaje)) {     
     document.location = destino ;  
	   }
}

</script>
		 
		<table width=\"90%\"  border=\"0\" align=\"center\" cellpadding=\"3\" cellspacing=\"2\">
		      <tr>
		      <td align=\"center\" class=\"textos\"><b>List of users created</b></td>
		      </tr>
		      
		      
		     <tr>
		     <td align=\"center\" class=\"textos\">
		       <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"1\" cellspacing=\"1\">
		       <tr>
		       <td bgcolor=\"#DEE7F8\" align=\"left\" class=\"textos\">
		        <a href=\"".$PHP_SELF."?accion=$accion".$url_empresa."&order=nombre\">&nbsp;Name</a>
		       </td>
		       <td bgcolor=\"#DEE7F8\" align=\"left\" class=\"textos\">
		       <a href=\"".$PHP_SELF."?accion=$accion".$url_empresa."&order=apellido\">&nbsp;Last name</a>
		       </td>
		       <td bgcolor=\"#DEE7F8\" align=\"left\" class=\"textos\">
		        <a href=\"".$PHP_SELF."?accion=$accion".$url_empresa."&order=id_empresa\">&nbsp;Trade name</a>
		       </td>
		       <td bgcolor=\"#DEE7F8\" align=\"center\" class=\"textos\">&nbsp;Edit</td>
		       <td bgcolor=\"#DEE7F8\" align=\"center\" class=\"textos\">&nbsp;Delete</td>
		       </tr>
		         $datos_u
		       </table>
		     
		  </td>
		  </tr>
 <tr><td align=\"center\" class=\"textos\">$tabla_paginas</td></tr> 
	      
	</table>";
}	
else{
 $lista_de_datos = "<script languaje=\"javascript\">
function confirmar( mensaje, destino) {  
  if (confirm(mensaje)) {     
     document.location = destino ;  
	   }
}

</script>
 
<table width=\"90%\"  border=\"0\" align=\"center\" cellpadding=\"3\" cellspacing=\"2\">
		      <tr>
		      <td align=\"center\" class=\"textos\"><b>Lista de los usuarios creados</b></td>
		      </tr>
		      
		      
		     <tr>
		     <td align=\"center\" class=\"textos\">
		       <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"1\" cellspacing=\"1\">
		       <tr>
		       <td bgcolor=\"#DEE7F8\" align=\"left\" class=\"textos\">
		        <a href=\"".$PHP_SELF."?accion=$accion".$url_empresa."&order=nombre\">&nbsp;Nombre</a>
		       </td>
		       <td bgcolor=\"#DEE7F8\" align=\"left\" class=\"textos\">
		       <a href=\"".$PHP_SELF."?accion=$accion".$url_empresa."&order=apellido\">&nbsp;Apellido</a>
		      </td>
		       <td bgcolor=\"#DEE7F8\" align=\"left\" class=\"textos\">
		        <a href=\"".$PHP_SELF."?accion=$accion".$url_empresa."&order=id_empresa\">&nbsp;Raz&oacute;n Social</a>
		       </td>
		       <td bgcolor=\"#DEE7F8\" align=\"center\" class=\"textos\">&nbsp;Editar</td>
		       <td bgcolor=\"#DEE7F8\" align=\"center\" class=\"textos\">&nbsp;Borrar</td>
		       </tr>
		        $datos_u
		       </table>
		     
		  </td>
		  </tr>
 <tr><td align=\"center\" class=\"textos\">$tabla_paginas</td></tr> 
	      
	</table>";
		
		 
}


$modulo_usuarios .= $lista_de_datos;
?>