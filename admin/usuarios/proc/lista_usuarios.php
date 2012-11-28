<?php



$id_establecimiento = $_GET['id_establecimiento'];
$filtro = $_POST['filtro'];

//lista para seleccionar el establecimiento
$accion_form = "index.php?accion=$accion";
session_register('filtro_user');
session_register('filtro_user_text');




if($filtro!="" ){




$condicion ="where nombre like '%$filtro%' or apellido like '%$filtro%'  or email like '%$filtro%'   or razon_social like '%$filtro%' ";	
$_SESSION['filtro_user']=$condicion;

$_SESSION['filtro_user_text']= $filtro;
	
}

$condicion= $_SESSION['filtro_user'];
$filtro = $_SESSION['filtro_user_text'];

if($_GET['filtro']=="borrar_filtro"){
	   
	   
$_SESSION['filtro_user']="";
$_SESSION['filtro_user_text']="";
$condicion= "";
$filtro = "";	   
	   
}




/**/
 
 $pagina=100;
 
 $query= "SELECT  count(*) 
	               FROM  usuario
			$condicion";
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
								<strong>$cont</strong></font>
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
								<strong>$cont</strong></font>
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

            
 
 
/**/


$query= "SELECT  id, establecimiento    
	           FROM  establecimientos
	          order by establecimiento";
	     $result= mysql_query($query)or die (mysql_error());
	     while(list($id, $establecimiento_u) = mysql_fetch_row($result)){
	     
	     	
			if($id_establecimiento==$id){
				$seleccionado="selected";
			}
			else{
			$seleccionado='';	
			}
			
      	$lista_select .="<option value=\"?accion=$accion&id_establecimiento=$id\" $seleccionado>$establecimiento_u</option>"; 
	     	
	     	}

	     	if($id_establecimiento!=""){
	     		$condicion="where establecimiento='$id_establecimiento' ";
	     		
	     	}
	     	//lista de los usuarios    
	     	
	     	    
  $query= "SELECT id_usuario,nombre,apellido, establecimiento,id_perfil,email, estado  ,razon_social 
           FROM  usuario
            $condicion
	   
            order by nombre
	    $paginacion";
		
     $result2= mysql_query($query)or die (mysql_error());
      while (list($id_user_u,$nombre_u,$apellido_u, $id_establecimiento_u,$id_perfil,$email_u, $estado,$razon_social) = mysql_fetch_row($result2)){
      	
		if($nombre_u==""){
			$nombre_u= $razon_social;
		}
	  
	  	if($estado==0 ){
	       
	    $link_activo ="<td align=\"center\">
						<div id=\"v_$id_user_u\"  >
					&nbsp;<img style=\"cursor: pointer;  cursor: hand;\" onclick=\"ObtenerDatos('index.php?accion=$accion&act=77&id_user=$id_user_u&axj=1','v_$id_user_u');\" src=\"images/ciculo_warring.gif\" border=\"0\" alt=\"Usuario creado pero con su cuenta aun desactiva. click para Desactivar Permanentemente\">
					  </div></td>";
	    
	  }elseif($estado==1){
	  	
	   $link_activo ="<td align=\"center\">
	   					<div id=\"v_$id_user_u\">
	   					&nbsp;<img  style=\"cursor: pointer;  cursor: hand;\" onclick=\"ObtenerDatos('index.php?accion=$accion&act=77&id_user=$id_user_u&axj=1','v_$id_user_u');\" src=\"images/ciculo_ok.gif\" border=\"0\" alt=\"Usuario activo. Click para Desactivar\">
						</div></td>";
	
	  }elseif($estado==2){
	  	
	    $link_activo ="<td align=\"center\">
							<div id=\"v_$id_user_u\">
						&nbsp;<img  style=\"cursor: pointer;  cursor: hand;\" onclick=\"ObtenerDatos('index.php?accion=$accion&act=77&id_user=$id_user_u&axj=1','v_$id_user_u');\" src=\"images/minus_circle.gif\"  border=\"0\" alt=\"Cuenta Bloqueada. Click para Activar Cuenta\">
                       </div></td>";
	
	  }  
	  if($id_user_u==id_usuario($id_sesion)){
	 			if($estado==0 ){
	       
	    $link_activo ="<td align=\"center\">
					&nbsp;<img src=\"images/ciculo_warring.gif\" border=\"0\" alt=\"Usuario creado pero con su cuenta aun desactiva. click para Desactivar Permanentemente\">
					</td>  ";
	    
	  }elseif($estado==1){
	  	
	   $link_activo ="<td align=\"center\">
	   					&nbsp;<img  src=\"images/ciculo_ok.gif\" border=\"0\" alt=\"Usuario activo. Click para Desactivar\">
						</td>";
	
	  }elseif($estado==2){
	  	
	    $link_activo ="<td align=\"center\">
							&nbsp;<img src=\"images/minus_circle.gif\"  border=\"0\" alt=\"Cuenta Bloqueada. Click para Activar Cuenta\">
                      </td> ";
	
	  } 
	  $link_del ="&nbsp;";
		}else{
		 $link_del = "<a href=\"javascript:confirmar('Esta seguro de eliminar $nombre_u','?accion=$accion&act=3&id_user=$id_user_u')\">
		  <img src=\"images/del.gif\" border=\"0\" alt=\"Borrar\"></a>";
		
		}

      
      		     	
			  $query= "SELECT perfil
	     	           FROM  usuario_perfil
	     	           where id_perfil ='$id_perfil'";
	     	     $result= mysql_query($query)or die (mysql_error());
	     	    list($perfil) = mysql_fetch_row($result);
			
      	 $lista_usuarios .="<tr style=\"background-color: rgb(248, 248, 248);\" onmouseover=\"this.style.backgroundColor='#EBEBEB'\" onmouseout=\"this.style.backgroundColor='#F8F8F8'\" bgcolor=\"#2d528e\">

   
   <td   align=\"left\" class=\"textos\">$nombre_u $apellido_u</td> 
   <td align=\"left\" class=\"textos\">$email_u</td> 
  	<td    align=\"left\" class=\"textos\">$perfil</td> 
  	
  	
  	 $link_activo
  	<td  align=\"right\"><a href=index.php?accion=$accion&act=1&id_user=$id_user_u>
		  
          <img src=\"images/edit.gif\" border=\"0\" alt=\"Editar\"></a></td>
          <td  align=\"right\">$link_del</td>
    </tr>
";

      	 
      	
      	   
		
	     } 	
	
	   	
		$texto_lista = "  
			
			<table width=\"100%\" cellpadding=\"1\" cellspacing=\"1\" border=\"0\" id=\"table1\" class=\"cuadro_light\" align=\"left\">
    			
			
                <tr>
                  		<td  class=\"textos\"  align=\"center\">Nombre</td>  
     						<td  class=\"textos\" align=\"center\">Email</td>  
     						<td  class=\"textos\" align=\"center\">Tipo User</td>  
     						   
    						<td  class=\"textos\" align=\"center\"  class=\"nosort\">Estado</td>
     						<td class=\"textos\" align=\"center\"  class=\"nosort\">Editar</td>
  					<td class=\"textos\" align=\"center\"  class=\"nosort\">Borrar</td>
  					 </tr>
			
           
            <div id=\"resultado\">
                $lista_usuarios
              </div>
            
        </table>
			";
			
if($filtro!=""){$borrar_filtro="<a href=\"index.php?accion=$accion&filtro=borrar_filtro\">(Borrar filtro)</a>";}	
$buscador = "<td align=\"left\" class=\"textos\">Buscar por : <input type=\"text\" name=\"filtro\" id=\"filtro\" maxlength=\"50\" value=\"$filtro\"> <input type=\"submit\" name=\"Submit\" value=\"Buscar\">
$borrar_filtro</td>";
			
//$texto_lista= crea_tabla_tiny_aduana($texto_lista);		
$modulo_usuarios  .= "<script languaje=\"javascript\">
function confirmar( mensaje, destino){  
  if (confirm(mensaje)) {     
     document.location = destino ;  
	   }
}

</script> 


	  <table width=\"90%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
	  
        
		 <tr><td align=\"center\" class=\"textos\"> &nbsp;</td></tr>
		<tr>
          	<td align=\"right\" class=\"textos\">
		 <table  border=\"0\" align=\"right\" cellpadding=\"2\" cellspacing=\"2\">
      						<tr>
      							<td align=\"left\" class=\"textos\">
					  				&nbsp;
								</td>
								
    	  						<td align=\"right\" class=\"textos\">
      							<a href=\"?accion=$accion&act=4\"><img src=\"images/new.gif\" alt=\"\" border=\"0\"></a>
      							</td>
      							
      							<td align=\"right\" class=\"textos\">
      							<a href=\"admin/usuarios/proc/xls.php\"><img src=\"images/excel_min.jpg\" alt=\"Exportar lista de usuarios\" border=\"0\"></a>
      							</td>
	      					</tr>
      						<tr>
	      						<td align=\"right\" class=\"textos\">&nbsp; </td>
      							<td align=\"right\" class=\"textos\">
      								<a href=\"?accion=$accion&act=4\">Nuevo</a>
      							</td>
      							
    							<td align=\"right\" class=\"textos\">
    							<a href=\"admin/usuarios/proc/xls.php\">Exportar</a></td>
    							<td align=\"right\" class=\"textos\">&nbsp; </td>
      						</tr>
			</table>

		  
		  </td>
          </tr>
		  <tr><td align=\"center\" class=\"textos\"> &nbsp;</td></tr>
		    <tr>$buscador<tr>
		  <tr><td align=\"center\" class=\"textos\">$tabla_paginas</td></tr> 
    	 <tr >
          <td align=\"center\" class=\"textos\">
		  
		 
		 		 $texto_lista 
		  
		  </td>
          </tr>
		<tr><td align=\"center\" class=\"textos\">$tabla_paginas</td></tr>   
    	 <tr >
          <td align=\"center\" class=\"textos\">
		  	<table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">     
       			<tr>
        			 <td align=\"left\" class=\"textos\">
         				<img src=\"images/ciculo_ok.gif\" border=\"0\" >&nbsp;&nbsp;Usuario Activo</td> 
	  			</tr> 
				<tr>
	    			<td align=\"left\" class=\"textos\">
	    				<img src=\"images/ciculo_warring.gif\" border=\"0\" >&nbsp;&nbsp;Usuario sin verificar email</td> 
				</tr> 
				<tr>
	    			<td align=\"left\" class=\"textos\">
	    				<img src=\"images/minus_circle.gif\" border=\"0\" >&nbsp;&nbsp;Usuario Bloqueado</td> 
				</tr> 
			</table>
		  
		 </td>
        </tr>
		  
   </table>
";

?>