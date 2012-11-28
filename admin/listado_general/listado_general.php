<?php

$id = $_GET['id'];
$id_auto_admin = id_tabla($tabla);


switch ($act) {
     case 1:
        // include ("contenido/formulario.php");
		if($formulario ==""){
		include ("admin/administracion_sistema/form/formulario.php");
		}
		if($_GET['id']!=""){
		$js .= "<script language=\"JavaScript\">



$(document).ready(function () 
			{
				$('#boton').click(function() 
				{ 
				procesar('index.php?accion=$accion&act=2&id=$id&axj=1','div_respuesta');
				
				});
			});
		</script>";
		}else{
		$js .= "<script language=\"JavaScript\">



$(document).ready(function () 
			{
				$('#boton').click(function() 
				{ 
				procesar('index.php?accion=$accion&act=3&axj=1','div_respuesta');
				
				});
			});
		</script>";
		}
	


		
		
			$contenido =   "<table   border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                             <tr>
                               <td align=\"center\" class=\"textos\">$formulario</td>
                               </tr>
							   <tr><td align=\"center\" class=\"textos\">
							     <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
   										  <tr >
       											<td class=\"textos\" align=\"center\" class=\"textos\">
	   											<div id=\"div_respuesta\" align=\"center\"></div>
												<div id=\"div_cargando\" style=\"display:none\">Enviado datos, Espere...</div>
	   										</td>
       									</tr>
 								</table></td></tr> 
                         	</table>";
		
		
         break;
	 case 2:
        // include ("contenido/update.php");
		update($tabla,$_GET['id']);
		$contenido = "<table border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                        <tr>
                          <td align=\"center\" class=\"textos\">Datos actualizados exitosamente</td>
                        </tr>
						<tr><td align=\"center\" class=\"textos\">
						<a href=\"index.php?accion=$accion\">Volver al listado</a> </td></tr> 
                      </table>";
					  $contenido = cuadro_verde($contenido);
         break;
     case 3:
    
	 
	  if(inserta($tabla)){
		$contenido = "<table border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                        <tr>
                          <td align=\"center\" class=\"textos\">Datos ingresados a la base de datos</td>
                        </tr>
						<tr><td align=\"center\" class=\"textos\">
						<a href=\"index.php?accion=$accion\">Volver al listado</a> </td></tr> 
                      </table>";
		 $contenido = cuadro_verde($contenido);
		}else{
		$contenido = "<table border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                        <tr>
                          <td align=\"center\" class=\"textos\">No fue posible ingresar los Datos</td>
                        </tr>
						<tr><td align=\"center\" class=\"textos\">
						<a href=\"index.php?accion=$accion\">Volver al listado</a> </td></tr> 
                      </table>";
					  $contenido = cuadro_rojo($contenido);
		}
	
		
         break;
   	case 4:
         
		 borrar($tabla,$id);
		 
         header("Location:index.php?accion=$accion");
         break;
	case 5:
        // include ("contenido/formulario.php");
	$js .= "<script language=\"JavaScript\">

			$(document).ready(function () 
			{
				$('#boton').click(function() 
				{ procesar('index.php?accion=$accion&act=2&id=$id&axj=1','div_respuesta');
				});
			});
		</script>";


		
		
			$contenido =   "<table width=\"300\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                             <tr>
                               <td align=\"center\" class=\"textos\">$formulario</td>
                               </tr>
							   <tr><td align=\"center\" class=\"textos\">
							     <table width=\"100%\"  border=\"0\" align=\"left\" cellpadding=\"0\" cellspacing=\"0\">
     <tr >
       <td class=\"textos\" align=\"center\" class=\"textos\">
	   <div id=\"div_respuesta\" align=\"center\"></div>
<div id=\"div_cargando\" style=\"display:none\">Enviado datos, Espere...</div>
	   </td>
       </tr>
 	</table></td></tr> 
                         	</table>";
		
		
         break;
   	default:
	    //echo "$tabla";
		$id_auto_admin = id_tabla($tabla);
		
	 	   include("admin/listado_general/lista.php");
		       /*
			   $query= "SELECT campo,pk 
                      FROM  auto_admin_campo
                      WHERE id_auto_admin ='$id_auto_admin' and existe_listado =1";
                $result= cms_query($query)or die (error($query,mysql_error(),$php));
                 while (list($campo,$pk) = mysql_fetch_row($result)){
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
		   
		    $query= "SELECT $campos_bd  $campo_id
                   	 FROM  $tabla
                   	 $condicion";
					
             $result= cms_query($query)or die (error($query,mysql_error(),$php));
              while (list($txt_campo,$id_campo) = mysql_fetch_row($result)){
			  $cont_gen++;
			  $txt_campo= acentos($txt_campo);
        			$lineas .="<tr><td align=\"left\" class=\"textos\">&nbsp;&nbsp; $txt_campo </td>
								   <td align=\"center\" class=\"textos\">
								   <a href=\"index.php?accion=$accion&act=5&id=$id_campo\"><img src=\"images/edit.gif\" alt=\"Editar\" border=\"0\"></td> 
								   <td align=\"center\" class=\"textos\">
								   <a href=\"javascript:confirmar('Esta Seguro de Borrar','index.php?accion=$accion&act=4&id=$id_campo')\">
									<img src=\"images/del.gif\" alt=\"Borrar\" border=\"0\"></a>
								   </td> 
								   </tr> ";
        		 }
				 if($cont_gen==0){
				 $lineas= "<tr><td align=\"center\" class=\"textos\" colspan=\"3\"> Sin Datos</td></tr> ";
			
				 }
				 
			
				$tabla_general ="    <table width=\"98%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" id=\"table1\" class=\"tinytable\" align=\"left\">
    		  <thead>
				<tr>
                  
                        <th ><h3>$titulo_columna_txt</h3></th>
                        <th width=\"50\" class=\"nosort\"><h3>Editar</h3></th>
                        <th width=\"50\" class=\"nosort\"><h3>Borrar</h3></th>
                       
                </tr>
			 </thead>
			  <tbody>
                #LINEAS#
              </tbody> </table> ";
		
		if($cont_gen>0){
		$tabla_general = str_replace("#LINEAS#",$lineas,$tabla_general);
		$contenido = crea_tabla_tiny($tabla_general);
		$contenido = "<table width=\"98%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                                    <tr><td align=\"center\" class=\"textos\"><h3>$titulo_administracion</h3> </td></tr> 
									 <tr>
                                       <td align=\"right\" class=\"textos\">
									   <a href=\"index.php?accion=$accion&act=1\"><img src=\"images/add.png\" alt=\"\" border=\"0\"></a></td>
                                       </tr>
									   <tr><td align=\"center\" class=\"textos\"> 
									
       											$contenido
									   </td></tr> 
                                 	</table>";
		}else{
		$sin_datos= "<tr><td align=\"center\" class=\"textos\" colspan=\"3\">Sin Datos </td></tr> ";
		$tabla_general = str_replace("#LINEAS#",$sin_datos,$tabla_general);
		$contenido = $tabla_general;
		}
			   */

				 
				 
       
 }

 
 

?>