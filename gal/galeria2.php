<?php

include("gal/config_gal.php");

$thumbs = $_GET['thumbs'];
$first = $_GET['first'];
$id_galeria = $_GET['id_galeria'];
$id_cliente = $_GET['id_cliente'];
		

// CONSTRUCCIÓN DEL ARRAY E INICIALIZACIÓN DE VARIABLES
         
	$contenido .= "<input type=\"hidden\" name=\"galeria_id\" value=\"$id_galeria\">"; 
	$onload = "onsubmit=\"enviarDatosComentario(); return false\"";
	$accion_form = "";


if($postal=="ok"){	

$id_img_p = $_GET['id_img_p'];
$tamanio_image = $_GET['tamanio_image'];

$nombre_cont = $_POST['nombre_cont'];
$apellido_cont = $_POST['apellido_cont'];
$apellido_cont = $_POST['apellido_cont'];
$email_cont = $_POST['email_cont'];
$mensaje = $_POST['mensaje'];


$contenido .="<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                <tr>
                  <td class=\"textos\" align=\"center\">Postal Enviada a el mail $email_cont</td>
                </tr>
              </table>";
			  
		include("gal/envia_postal.php");
			  
}

  $query= "SELECT id_cliente,id_galeria,fecha,nombre,descripcion,imagen    
                   FROM  galerias
				   ORDER BY id_galeria DESC";
           $result= @cms_query($query) or die("$MSG_DIE -1 QR-$query");
           while (list($id_cli,$id_gal,$fec,$nombre,$desc,$ima) = mysql_fetch_row($result)){
        	
			/*
			*  $query= "SELECT nombre   
                      FROM  entidad
                      WHERE id_entidad='$id_cli'";
                           $result_cliente= @cms_query($query) or die("$MSG_DIE -1 QR-$query");
                           list($nombre_cliente) = mysql_fetch_row($result_cliente);
			
			*/
			 $select_gal .= "<option value=\"index.php?accion=$accion&act=1&id_cliente=$id_cli&id_galeria=$id_gal\">
	                   $nombre </option>\n";			   
           }

		   $contenido .="<br><table aling=\"center\" width=\"50%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                           <tr>
                             <td aling=\"center\" class=\"textos\">Otras Galer&iacute;as</td>
							 <td>  <select name=\"menu1\" onChange=\"MM_jumpMenu('parent',this,0)\" class=\"textos\">
                                    <option value=\"\" class=\"textos\"></option>
					                $select_gal
					              </select>
								  </td>
                           </tr>
						   <tr><td>&nbsp;</td><td align=\"center\" class=\"textos\">&nbsp;</td>
						   </tr>
						   
                         </table>";
						 
						 
						 
						 
$fuente= $fuente_relativa;				 


if(is_dir("$fuente/$id_cliente/$id_galeria/")){


			 $dir = opendir("$fuente/$id_cliente/$id_galeria/"); 
			$i = 0;
			while ($images[$i][0] = readdir($dir)){
			
			
			
			

			if(is_file("$fuente/$id_cliente/$id_galeria/".$images[$i][0])){
			
				if($images[$i][0]=="." or $images[$i][0]=="..") continue;				 
				$aux = @filesize("$fuente/$id_cliente/$id_galeria/".$images[$i][0])/1024;
				$images[$i][1] = round($aux,2);
				//$aux = getimagesize("thumbs/".$images[$i][0]);
				$images[$i][2] = $thumbwidth; 
				$images[$i][3] = $thumbheight; 
				$aux = @getimagesize("$fuente/$id_cliente/$id_galeria/".$images[$i][0]); 
				$images[$i][4] = $aux[0]; 
				$images[$i][5] = $aux[1];
				$i++;
				
			   }
			}
			$thumbsdefault=10;
			$total = $i;
			if ($thumbs==null) $thumbs=$thumbsdefault;
			if ($id==null) {
				if ($first==null) $first=0;
				$last=$first+$thumbs;
				if ($last>$total) $last=$total;
			}
			else {
				$first=floor($id/$thumbs);
				$first=$first*$thumbs;
			}
			
			

}						 
			
			 $query= "SELECT sum(click)   
                               FROM  imagenes
                               WHERE id_cliente='$id_cliente' 
							   AND id_galeria='$id_galeria'";
                       $result= @cms_query($query) or die("$MSG_DIE -1 QR-$query");
                       list($total_click) = mysql_fetch_row($result);
					   
   // $nombre_cliente = datos_encuestas($id_cliente,13,1);
	//$nombre_cliente = $nombre_cliente[1];
	
	
	
	include("gal/configuracion_js.php");
	
	
	
	
	
$contenido .="$estilo
<div id=\"highslide-container\"></div>
<table width=\"80%\" border=\"0\"  cellpadding=\"0\" cellspacing=\"0\" align=\"center\">
  <tr>
    <td align=\"center\" class=\"texto-titulo\" >
	
	<table width=\"100%\" border=\"0\"  cellpadding=\"0\" cellspacing=\"0\" align=\"center\">
      <tr>
        <td align=\"left\" class=\"textos\" width=\"42%\">Cliente  </td>
        <td align=\"left\" class=\"textos\" width=\"58%\"><b>:$nombre_cliente</b></td>		
      </tr>
	
	  <tr>
        <td align=\"left\" class=\"textos\" width=\"42%\">Total fotos </td>
        <td align=\"left\" class=\"textos\" width=\"58%\">:$total</td>		
      </tr>
    <tr>
        <td align=\"left\" class=\"textos\" width=\"42%\">Total de clicks de esta galeria </td>
        <td align=\"left\" class=\"textos\" width=\"58%\">:$total_click</td>		
      </tr>
    </table>
	
	$title3</td>
  </tr>
</table>";

		
// CONSTRUCCIÓN DEL ARRAY E INICIALIZACIÓN DE VARIABLES

		$contenido .="<div id=\"textos\" class=\"textos\"><p>";
				
				// MENÚ PARA LOS CONTACTOS
				
					if ($id==null) {
						if ($first==0) {
				
				 if ($total>15) { 
							$contenido .="Fotos por p&aacute;gina:&nbsp;";
							if ($total>15) {
									if ($thumbs==15) {
										$contenido .="15&nbsp;&middot;&nbsp;";
										$contenido .="";
							
									}
									else {
							
										$contenido .="<a href=\"?accion=$accion&act=1&id_cliente=$id_cliente&id_galeria=$id_galeria&id_usuario=$id_usuario&user=$user&first=$first&thumbs=15\">15</a>&nbsp;&middot;&nbsp;";
							
									}
								} 
							
							
								if ($total>20) {
									if ($thumbs==20) {
								
										$contenido .="20&nbsp;&middot;&nbsp;";
							
									}
									else {
							
										$contenido .="<a href=\"?accion=$accion&act=1&id_cliente=$id_cliente&id_galeria=$id_galeria&id_usuario=$id_usuario&user=$user&first=$first&thumbs=20\">20</a>&nbsp;&middot;&nbsp;";
							
									}
								} 
							
							
								if ($total>25) {
									if ($thumbs==25) {
								
										$contenido .="25&nbsp;&middot;&nbsp;";
							
									}
									else {
							
										$contenido .="<a href=\"?accion=$accion&act=1&id_cliente=$id_cliente&id_galeria=$id_galeria&id_usuario=$id_usuario&user=$user&first=$first&thumbs=25\">25</a>&nbsp;&middot;&nbsp;";
							
									}
								} 
							
							
								if ($total>50) {
									if ($thumbs==50) {
								
										$contenido .="50&nbsp;&middot;&nbsp;";
							
									}
									else {
							
										$contenido .="<a href=\"?accion=$accion&act=1&id_cliente=$id_cliente&id_galeria=$id_galeria&id_usuario=$id_usuario&user=$user&first=$first&thumbs=50\">50</a>&nbsp;&middot;&nbsp;";
							
									}
								} 
							
							
								if ($thumbs==$total) {
							
									$contenido .="todos&nbsp;|&nbsp;";
							
								}
								else {
							
									$contenido .="<a href=\"?accion=$accion&act=1&id_cliente=$id_cliente&id_galeria=$id_galeria&id_usuario=$id_usuario&user=$user&first=$first&thumbs=$total\">todos</a>&nbsp;|&nbsp;";
							
								}
							
				 } 
				
						}
						
						$i=$thumbs*(floor($first/$thumbs));
						if ($i-$thumbs>=0) {
							$prev=$first-$thumbs;
				
							$contenido .="<a href=\"?accion=$accion&act=1&id_cliente=$id_cliente&id_galeria=$id_galeria&id_usuario=$id_usuario&user=$user&first=$prev&thumbs=$thumbs\">&laquo;&nbsp;Ant</a>&nbsp;|&nbsp;";
				
						}
						if (($first+$thumbs)<$total) {
				
							
				              $firstb =$first+1;
							  $firstc =$first+$thumbs;
							  
							  $contenido .="$firstb a  $firstc de $total&nbsp;";
						}
						else {
				               $firstb =$first+1;
							 $contenido .="$firstb a  $total de $total&nbsp;";
				
						}
						if (($i+$thumbs)<$total) {
				
							$contenido .="|&nbsp;&nbsp;<a href=\"?accion=$accion&act=1&id_cliente=$id_cliente&id_galeria=$id_galeria&id_usuario=$id_usuario&user=$user&first=$last&thumbs=$thumbs\">Sig&nbsp;&raquo;</a>";
				
						}
				
				
					}
					
				// MENÚ PARA LA FOTOGRAFÍA
					if ($id!=null) {
						if ($id>0) {
							$prev=$id-1;
				            $contenido .="<a href=\"?accion=$accion&act=1&id_cliente=$id_cliente&id_galeria=$id_galeria&id_usuario=$id_usuario&user=$user&id=$prev&thumbs=$thumbs\">&laquo;&nbsp;Anterior</a>&nbsp;|&nbsp;";
							
				
				}
				             $id2 = $id+1;
							 $contenido .="$id2 &nbsp;de&nbsp; $total&nbsp;";
				
						if ($id<($total-1)) {
							$next=$id+1;
				              $contenido .="|&nbsp;&nbsp;<a href=\"?accion=$accion&act=1&id_cliente=$id_cliente&id_galeria=$id_galeria&id_usuario=$id_usuario&user=$user&id=$next&thumbs=$thumbs\">Sig&nbsp;&raquo;</a>";
							
				
						}
					}
				
			$contenido .="</p>
		</div>";
			
		if($fondo==1){
        		$bg= "bgcolor=\"#ffffff\"";
        		$fondo=0;
        		}else{
        		$fondo=1;
        		$bg= "bgcolor=\"#E8E8EA\"";
        		}	
			
			$tum .="<table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
			
	// MOSTRAR LOS CONTACTOS
	
			if ($id==null) {
					
				//$tum .="<div id=\"thumbnails\">";
		
				for ($i=$first;$i<$last && $i<$total;$i++) {
		
		 $tum .=" <tr>
            <td align=\"center\" valign=\"top\" width=\"25%\">";
			
		            $fuente ="$fuente/$id_cliente/$id_galeria/".$images[$i][0];
		
		            $imagen = $images[$i][0];
		
		            $fuente = @imagecreatefromjpeg($fuente); 
		            $imgAncho = @imagesx ($fuente);
					
					$imgAncho = $imgAncho + 20;
				
					if ($imgAncho<468){
					
							$imgAncho=468;
					
					}
									 
                    $imgAlto =@imagesy($fuente); 
					$imgAlto = $imgAlto + 10;
		           
		           // $click =0;
		           $comentario_txt="";
		           if($images[$i][0]!=""){
		           	
		           	$query= "SELECT id_imagen   
		                       FROM  imagenes
		                       WHERE id_galeria='$id_galeria' and imagen1 ='".$images[$i][0]."'";
		                 $result_i= cms_query($query)or die (error($query,mysql_error(),$php));
		                 if(list($id_imagen) = mysql_fetch_row($result_i)){
		                 	
		                 	$query= "SELECT nombre,comentario     
		                       FROM imagenes_comentarios 
		                       WHERE id_galeria='$id_galeria' and id_imagen = $id_imagen";
		                 $result_i= cms_query($query)or die (error($query,mysql_error(),$php));
		                  while (list($nombre,$comentario) = mysql_fetch_row($result_i)){
		            			
		                  	
		                  	$comentario_txt .= "<tr >
		                  						<td align=\"left\" valign=\"top\" width=\"20%\" class=\"textos\"><b>$nombre</b> </td>
		                  						<td align=\"left\" valign=\"top\" width=\"2\" class=\"textos\">:</td>
		                  						<td align=\"left\" class=\"textos\">$comentario</td>
		                  						</tr> ";
		            		 }
		                 	
		                 }
		            		           	
		           }
		            		           		 
		            		 
		            if($comentario_txt!=""){
		            	$comentario_txt= "
							<table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"0\">
					            	$comentario_txt	  
					            	<tr>
		                  						<td align=\"left\"  class=\"textos\" colspan=\"3\">
		                  						
		                  						 </td>
		                  						
		                  						</tr> 
		                  						 
		            		 	  </table>
		            	
										  ";
		            }
		           
		            
		        	$tumbs ="gal/imagen_chica_gal.php?filename=".$images[$i][0]."&id_cliente=$id_cliente&id_galeria=$id_galeria&tamanio_image=100";
		        	
		        	$link = "gal/marca.php?id_img_p=".$images[$i][0]."&id_usuario=$id_usuario&id_cliente=$id_cliente&click=si&id_galeria=$id_galeria&id_tipo=$id_tipo";
		        	
		    	$cont_imag++;
		           $tum .= "
		            
		            <table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
		        	    <tr >
		        	      <td align=\"center\" class=\"textos\">
		        	      <a id=\"thumb$cont_imag\" href=\"$link\" class=\"highslide\"  onclick=\"return hs.expand(this)\">
							<img src=\"$tumbs\" alt=\"".$images[$i][0]."\" 
							 width=\"100\" />
						</a>
						
		
    	
				
						
<div class='highslide-caption' align=\"left\" id='captionforthumb$id_imagen'>
$comentario_txt
		            
<table width=\"100%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
	<tr>
	<td align=\"center\"  class=\"textos\" colspan=\"3\">
		
			</td>
		                  						
		    </tr>		     
	<tr>
	<td align=\"center\"  class=\"textos\" colspan=\"3\"><br>
		                  						
			<b>Agrega un comentario a esta foto:</b>
			</td>
		                  						
		    </tr>		     
			<tr>
				<td align=\"center\"  class=\"textos\" colspan=\"3\">&nbsp;</td>
		                  						
		    </tr>		     
			<tr >
		       <td align=\"left\" class=\"textos\">Nombre</td>
		       <td align=\"left\" class=\"textos\">
		       <input type=\"text\" name=\"nombre_$id_imagen\" class=\"textos\" id=\"nombre_$id_imagen\">
		       </td>
		       <td align=\"center\" class=\"textos\"> &nbsp;</td>
		     </tr>
		 	 <tr >
		       <td align=\"left\" class=\"textos\" >Mail</td>
		       <td align=\"left\" class=\"textos\"><input type=\"text\" name=\"mail_$id_imagen\" class=\"textos\"></td>
		       <td align=\"center\" class=\"textos\"> &nbsp;</td>
		     </tr>
		 	 <tr >
		       <td align=\"left\" class=\"textos\">Comentario</td>
		       <td align=\"left\" class=\"textos\"><textarea name=\"comentario_$id_imagen\" cols=\"30\" rows=\"3\" class=\"textos\"></textarea></td>
		       <td align=\"center\" class=\"textos\"> &nbsp;</td>
		     </tr>
		     <tr>
				<td align=\"center\"  class=\"textos\" colspan=\"3\">&nbsp;</td>             						
		    </tr>
		     <tr>
		       <td align=\"center\"  class=\"textos\" colspan=\"3\" height=\"27\">
		       <input type=\"submit\"  name=\"bot_image_$id_imagen\" value=\"Agregar comentario...\" class=\"boton\">
		        </td>
		        <td align=\"center\" class=\"textos\"> &nbsp;
		        <input type=\"hidden\" name=\"imagen_id_$id_imagen\" value=\"$id_imagen\">
		        </td>          						
		     </tr>
		     <tr>
				<td align=\"center\"  class=\"textos\" colspan=\"3\">&nbsp;</td>             						
		    </tr>
		 	</table>
		
		        	      
		        	      </td>
		        	      </tr>
		        
		        		</table> 
		        		</div>
	
";

	            
 $js_campos.="
if(document.getElementById('nombre_$id_imagen').value!='' && document.getElementById('mail_$id_imagen').value!='' && document.getElementById('comentario_$id_imagen').value!='' ){
//donde se mostrará lo resultados
	divcaptionforthumb$id_imagen = document.getElementById('captionforthumb$id_imagen');
	//valores de los inputs

	
	var nombre=document.getElementById('nombre_$id_imagen').value;
	var mail=document.getElementById('mail_$id_imagen').value;
	var comentario=document.getElementById('comentario_$id_imagen').value;
	var imagen_id=document.form_contenido.imagen_id_$id_imagen.value;
	var galeria=document.form_contenido.galeria_id.value;
		
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//uso del medotod POST
	//archivo que realizará la operacion
	//ingreso_comentario.php
	ajax.open(\"POST\", \"gal/ingreso_comentario.php\",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
			divcaptionforthumb$id_imagen.innerHTML = ajax.responseText
			//llamar a funcion para limpiar los inputs
			LimpiarCampos();
		}else{
			divcaptionforthumb$id_imagen.innerHTML = 'Subiendo comentario. Espere'
		}
	}
	ajax.setRequestHeader(\"Content-Type\",\"application/x-www-form-urlencoded\");
	//enviando los valores
	ajax.send(\"nombre_$id_imagen=\"+nombre+\"&mail_$id_imagen=\"+mail+\"&comentario_$id_imagen=\"+comentario+\"&galeria_id=\"+galeria+\"&imagen_id_$id_imagen=\"+imagen_id)

}"; 
 		           
		       
		           
		           $js_limpia .="document.form_contenido.nombre_$id_imagen.value=\"\";
							     document.form_contenido.mail_$id_imagen.value=\"\";
								 document.form_contenido.comentario_$id_imagen.value=\"\";
								 ";
		            
		            
		           
					   
					
						 $querye= "SELECT id_imagen   
                                           FROM  imagenes
                                           WHERE id_galeria='$id_galeria' 
										   AND id_cliente= '$id_cliente' 
										   AND imagen1 LIKE '%".$images[$i][0]."%'";
                                   
								   
								   $result3= @cms_query($querye) or die("$MSG_DIE -1 QR-$querye");
                                  list($id_imagen) = mysql_fetch_row($result3);
								   
								   if($id_imagen==""){
                                			//echo $querye;	
											 $fecha = date("Y-m-d");
								   
                             		  $qry_insert3="INSERT INTO imagenes (id_imagen,imagen1,imagen2,pie_esp,click,id_cliente,fecha_clasificacion,id_galeria)
                                       VALUES ('','".$images[$i][0]."','null','$pie_esp','0','$id_cliente','$fecha','$id_galeria')";
                        	
                                      $result_insert3=cms_query($qry_insert3) or die("$MSG_DIE - QR-Problemas al insertar $qry_insert3");
													   
                                   }
						
									
		 $querye= "SELECT id_imagen,click,fecha_clasificacion  
                              FROM  imagenes
                              WHERE id_cliente= '$id_cliente' 
							  AND imagen1 LIKE '%".$images[$i][0]."%'";
                    $result3= @cms_query($querye) or die("$MSG_DIE -1 QR-$querye");
		            list($id_imagen,$click,$fecha) = mysql_fetch_row($result3);
					
					$fecha =fechas_html($fecha);
					
					if($id_usuario!=0){
					$envia_postal ="    <table border=\"0\" align=\"left\" cellpadding=\"0\" cellspacing=\"0\">
                                          <tr>
                                            <td align=\"center\" class=\"textos\">
											     <img src=\"images/mail.gif\" alt=\"\" border=\"0\">
											</td>
                                            <td align=\"center\" class=\"textos\">
											    <a href=\"#$imagen\" onClick=\"MM_openBrWindow('gal/postal.php?user=$user&id_usuario=$id_usuario&id_cliente=$id_cliente&tamanio_image=".$images[$i][2]."&id_galeria=$id_galeria&imagen=".$images[$i][0]."','','width=330,height=340')\">
												   Enviar a un amigo</a></td>
                                            </tr>
                                      	</table>";
					}else{
					$envia_postal ="";	
					}
				
		
				if($perfil=="ad"){
				
				$tumx ="  <a href=\"gal/del_foto.php?id_usuario=$id_usuario&id_cliente=$id_cliente&id_galeria=$id_galeria&imagen=".$images[$i][0]."\">X</a>";
				}elseif($id_usuario!=""){
				
				 $tumx =" <table  border=\"0\" align=\"left\" cellpadding=\"0\" cellspacing=\"0\">
                                  <tr >
                                    <td align=\"center\" class=\"textos\">
									<img src=\"images/del.gif\" alt=\"\" border=\"0\"></td>
                                      <td align=\"center\" class=\"textos\" title=\"Debes ser un usuario Registrado\"> 
									<a href=\"index.php?id_usuario=$id_usuario&user=$user&accion=2669&id_cliente_d=$id_cliente&id_galeria_d=$id_galeria&imagen_del=".$images[$i][0]."\">
									Quiero Borrar esta foto.</a>
									  </td> 
									</tr>
                              	</table>";
				
				}
			$cont_comentario=0;	
				
		  $query= "SELECT count(id_comentario)   
				           FROM  imagenes_comentarios 
				           WHERE id_galeria ='$id_galeria'
				           AND  id_imagen ='$id_imagen'";
				     $result2= cms_query($query)or die (error($query,mysql_error(),$php));
				      list($cont_comentario) = mysql_fetch_row($result2);
				
		/*
		 <tr>
                              <td class=\"textos\">Peso Aprox: &nbsp;</td>
                              <td class=\"textos\">".$images[$i][1]."Kb</td>
                              
                            </tr>
		*/
					
		$tum  .="</td>
		           <td align=\"left\" valign=\"top\">
				 
				   <table width=\"200\"  border=\"0\"  cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
                           
                            <tr>
                              <td class=\"textos\">Click &nbsp;</td>
                              <td class=\"textos\">:&nbsp;$click</td>
                             
                            </tr>
							<tr>
                              <td class=\"textos\">Fecha &nbsp;</td>
                              <td class=\"textos\">:&nbsp;$fecha</td>
                             
                            </tr>
							
						<tr>
                              <td class=\"textos\">Comentarios &nbsp;</td>
                              <td class=\"textos\">:&nbsp;$cont_comentario</td>
                             
                            </tr>
							
							<tr>
                              <td class=\"textos\">&nbsp;</td>
                              <td class=\"textos\"></td>
                             
                            </tr>
                          </table>
			     </td>
			 </tr>";
		
				}
		         
		
				//$tum .="";
		
			}
		
		$tum .="</table>";
		
			
		
		usleep(50);
		$contenido .= $tum."<div id=\"controlbar\" class=\"highslide-overlay controlbar\">
	<a href=\"#\" class=\"previous\" onclick=\"return hs.previous(this)\" title=\"Previous (left arrow key)\"></a>
	<a href=\"#\" class=\"next\" onclick=\"return hs.next(this)\" title=\"Next (right arrow key)\"></a>
    <a href=\"#\" class=\"highslide-move\" onclick=\"return false\" title=\"Click and drag to move\"></a>
    <a href=\"#\" class=\"close\" onclick=\"return hs.close(this)\" title=\"Close\"></a>
</div>";
		
	if(is_dir($dir)){
			closedir($dir);
	
	}
		

	$js .="<script type=\"text/javascript\"> 
	
    function objetoAjax(){
	var xmlhttp=false;
	try {
		xmlhttp = new ActiveXObject(\"Msxml2.XMLHTTP\");
	} catch (e) {
		try {
		   xmlhttp = new ActiveXObject(\"Microsoft.XMLHTTP\");
		} catch (E) {
			xmlhttp = false;
  		}
	}

	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}

function enviarDatosComentario(){

$js_campos
	
}

function LimpiarCampos(){
	$js_limpia
}
    
</script>";
	
?>