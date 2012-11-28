<?php
$thumbs = $_GET['thumbs'];
$first = $_GET['first'];
$id_galeria = $_GET['id_galeria'];
$id_cliente = $_GET['id_cliente'];
		
		// CONSTRUCCIÓN DEL ARRAY E INICIALIZACIÓN DE VARIABLES





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
        	
			 $query= "SELECT nombre   
                      FROM  entidad
                      WHERE id_entidad='$id_cli'";
                           $result_cliente= @cms_query($query) or die("$MSG_DIE -1 QR-$query");
                           list($nombre_cliente) = mysql_fetch_row($result_cliente);
			
			
			 $select_gal .= "<option value=\"index.php?id_usuario=$id_usuario&user=$user&accion=2600&id_cliente=$id_cli&id_galeria=$id_gal\">
	                   $nombre ($nombre_cliente)</option>\n";			   
           }

		   $contenido .="<br><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                           <tr>
                             <td class=\"textos\">Otras Galer&iacute;as </td>
							 <td>  <select name=\"menu1\" onChange=\"MM_jumpMenu('parent',this,0)\" class=\"textos\">
                                    <option value=\"\" class=\"textos\"></option>
					                $select_gal
					              </select>
								  </td>
                           </tr>
						   <tr><td>&nbsp;</td><td align=\"center\" class=\"textos\">&nbsp;</td> </tr>
						   
                         </table>";
						 
						 
if(is_dir("./gal/$id_cliente/$id_galeria/")){

	

			 $dir = opendir("./gal/$id_cliente/$id_galeria/"); 
			$i = 0;
			while ($images[$i][0] = readdir($dir)){
			if(is_file("./gal/$id_cliente/$id_galeria/".$images[$i][0])){
			
				if($images[$i][0]=="." or $images[$i][0]=="..") continue;				 
				$aux = @filesize("gal/$id_cliente/$id_galeria/".$images[$i][0])/1024;
				$images[$i][1] = round($aux,2);
				//$aux = getimagesize("thumbs/".$images[$i][0]);
				$images[$i][2] = $thumbwidth; 
				$images[$i][3] = $thumbheight; 
				$aux = @getimagesize("gal/$id_cliente/$id_galeria/".$images[$i][0]); 
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
					   
    $nombre_cliente = datos_encuestas($id_cliente,13,1);
	$nombre_cliente = $nombre_cliente[1];
		
$contenido .="
<table width=\"80%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\">
  <tr>
    <td align=\"center\" class=\"texto-titulo\" >
	
	<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\">
      <tr>
        <td align=\"left\" class=\"textos\" width=\"42%\">Cliente </td>
        <td align=\"left\" class=\"textos\" width=\"58%\"><b>$nombre_cliente</b></td>		
      </tr>
	
	  <tr>
        <td align=\"left\" class=\"textos\" width=\"42%\">Total fotos </td>
        <td align=\"left\" class=\"textos\" width=\"58%\">$total</td>		
      </tr>
    <tr>
        <td align=\"left\" class=\"textos\" width=\"42%\">Total de clicks de esta Galeria </td>
        <td align=\"left\" class=\"textos\" width=\"58%\">$total_click</td>		
      </tr>
    </table>
	
	$title</td>
  </tr>
</table>";

		
			// CONSTRUCCIÓN DEL ARRAY E INICIALIZACIÓN DE VARIABLES

			
		

		$contenido .="<div id=\"textos\"><p>";
				
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
							
										$contenido .="<a href=\"?accion=2600&id_cliente=$id_cliente&id_galeria=$id_galeria&id_usuario=$id_usuario&user=$user&first=$first&thumbs=15\">15</a>&nbsp;&middot;&nbsp;";
							
									}
								} 
							
							
								if ($total>20) {
									if ($thumbs==20) {
								
										$contenido .="20&nbsp;&middot;&nbsp;";
							
									}
									else {
							
										$contenido .="<a href=\"?accion=2600&id_cliente=$id_cliente&id_galeria=$id_galeria&id_usuario=$id_usuario&user=$user&first=$first&thumbs=20\">20</a>&nbsp;&middot;&nbsp;";
							
									}
								} 
							
							
								if ($total>25) {
									if ($thumbs==25) {
								
										$contenido .="25&nbsp;&middot;&nbsp;";
							
									}
									else {
							
										$contenido .="<a href=\"?accion=2600&id_cliente=$id_cliente&id_galeria=$id_galeria&id_usuario=$id_usuario&user=$user&first=$first&thumbs=25\">25</a>&nbsp;&middot;&nbsp;";
							
									}
								} 
							
							
								if ($total>50) {
									if ($thumbs==50) {
								
										$contenido .="50&nbsp;&middot;&nbsp;";
							
									}
									else {
							
										$contenido .="<a href=\"?accion=2600&id_cliente=$id_cliente&id_galeria=$id_galeria&id_usuario=$id_usuario&user=$user&first=$first&thumbs=50\">50</a>&nbsp;&middot;&nbsp;";
							
									}
								} 
							
							
								if ($thumbs==$total) {
							
									$contenido .="todos&nbsp;|&nbsp;";
							
								}
								else {
							
									$contenido .="<a href=\"?accion=2600&id_cliente=$id_cliente&id_galeria=$id_galeria&id_usuario=$id_usuario&user=$user&first=$first&thumbs=$total\">todos</a>&nbsp;|&nbsp;";
							
								}
							
				 } 
				
						}
						
						$i=$thumbs*(floor($first/$thumbs));
						if ($i-$thumbs>=0) {
							$prev=$first-$thumbs;
				
							$contenido .="<a href=\"?accion=2600&id_cliente=$id_cliente&id_galeria=$id_galeria&id_usuario=$id_usuario&user=$user&first=$prev&thumbs=$thumbs\">&laquo;&nbsp;Ant</a>&nbsp;|&nbsp;";
				
						}
						if (($first+$thumbs)<$total) {
				
							
				              $firstb =$first+1;
							  $firstc =$first+$thumbs;
							  
							  $contenido .="$firstb a  $firstc de  $total&nbsp;";
						}
						else {
				               $firstb =$first+1;
							 $contenido .="$firstb a  $total de  $total&nbsp;";
				
						}
						if (($i+$thumbs)<$total) {
				
							$contenido .="|&nbsp;&nbsp;<a href=\"?accion=2600&id_cliente=$id_cliente&id_galeria=$id_galeria&id_usuario=$id_usuario&user=$user&first=$last&thumbs=$thumbs\">Sig&nbsp;&raquo;</a>";
				
						}
				
				
					}
					

				
					// MENÚ PARA LA FOTOGRAFÍA
					if ($id!=null) {
						if ($id>0) {
							$prev=$id-1;
				            $contenido .="<a href=\"?accion=2600&id_cliente=$id_cliente&id_galeria=$id_galeria&id_usuario=$id_usuario&user=$user&id=$prev&thumbs=$thumbs\">&laquo;&nbsp;Anterior</a>&nbsp;|&nbsp;";
							
				
				}
				             $id2 = $id+1;
							 $contenido .="$id2 &nbsp;de&nbsp; $total&nbsp;";
				
						if ($id<($total-1)) {
							$next=$id+1;
				              $contenido .="|&nbsp;&nbsp;<a href=\"?accion=2600&id_cliente=$id_cliente&id_galeria=$id_galeria&id_usuario=$id_usuario&user=$user&id=$next&thumbs=$thumbs\">Sig&nbsp;&raquo;</a>";
							
				
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

			
			
		            $fuente ="gal/$id_cliente/$id_galeria/".$images[$i][0];
		
		            $imagen = $images[$i][0];
		
		            $fuente = @imagecreatefromjpeg($fuente); 
		            $imgAncho = @imagesx ($fuente);
					
					$imgAncho = $imgAncho + 20;
				
					if ($imgAncho<468){
					
					$imgAncho=468;
					
					}
					 
                    $imgAlto =@imagesy($fuente); 
					$imgAlto = $imgAlto + 10;
		            $link ="gal/marca_p.php?id_img_p=$imagen&id_usuario=$id_usuario&id_cliente=$id_cliente&id_galeria=$id_galeria";
		            $click =0;
		        
		                $tum .="<div class=\"thumb\">
							<div class=\"frame\">
							<a href=\"#$imagen\" onClick=\"MM_openBrWindow('$link','','width=$imgAncho,height=$imgAlto ,scrollbars=yes')\" border=\"0\" title=\"ver la im&aacute;gen ampliada\">
							<img src=\"gal/imagen_chica_gal.php?filename=".$images[$i][0]."&id_cliente=$id_cliente&id_galeria=$id_galeria&tamanio_image=".$images[$i][2]."\"".$images[$i][3]."\" alt=\"thumbnail\"  border=\"0\" title=\"ver la im&aacute;gen ampliada\" /></a>
							</div>     
							</div>";
                 
					   $i= $images[$i][0];
					if($i!=""){
						
						
						 $querye= "SELECT id_imagen   
                                           FROM  imagenes
                                           WHERE id_galeria='$id_galeria' 
										   AND id_cliente= '$id_cliente' 
										   AND imagen1 LIKE '%".$images[$i][0]."%'";
                                   
								   
								   $result3= @cms_query($querye) or die("$MSG_DIE -1 QR-$querye");
                                  list($id_imagen) = mysql_fetch_row($result3);
						
					}
								   
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
				
		  $query= "SELECT id_comentario   
				           FROM  imagenes_comentarios 
				           WHERE id_galeria ='$id_galeria'
				           AND  id_imagen ='$id_imagen'";
				     $result2= cms_query($query)or die (error($query,mysql_error(),$php));
				      while (list($id_comentario) = mysql_fetch_row($result2)){
								$cont_comentario++;		   
						 }		
				
		/*
		 <tr>
                              <td class=\"textos\">Peso Aprox: &nbsp;</td>
                              <td class=\"textos\">".$images[$i][1]."Kb</td>
                              
                            </tr>
		*/
					
		$tum  .="</td>
		           <td align=\"center\" valign=\"top\">
				 
				   <table width=\"80%\"  border=\"0\"  cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
                           
                            <tr>
                              <td class=\"textos\">Click :&nbsp;</td>
                              <td class=\"textos\">$click</td>
                             
                            </tr>
							<tr>
                              <td class=\"textos\">Fecha :&nbsp;</td>
                              <td class=\"textos\">$fecha</td>
                             
                            </tr>
							
						<tr>
                              <td class=\"textos\">Comentarios :&nbsp;</td>
                              <td class=\"textos\">$cont_comentario 
                              <a href=\"?accion=2610&id_galeria=$id_galeria&id_cliente=$id_cliente&id_imagen=$id_imagen&id_usuario=$id_usuario&user=$user\">Ver</a>
                            </td>
                             
                            </tr>
							
					<tr>
                              <td class=\"textos\">
                              <a href=\"?accion=2610&id_galeria=$id_galeria&id_cliente=$id_cliente&id_imagen=$id_imagen&id_usuario=$id_usuario&user=$user\">Ver o Agregar comentario</a>
                              </td>
                              <td class=\"textos\"> 
                              
                            </td>
                             
                            </tr>
							
							<tr>
                              <td class=\"textos\">&nbsp;
							  </td>
                              <td class=\"textos\"></td>
                             
                            </tr>
							<tr>
                              <td class=\"textos\">
							  $envia_postal
							  </td>
                              <td class=\"textos\"></td>
                             
                            </tr>
							<tr>
                              <td class=\"textos\">
							$tumx
							 </td>
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
		$contenido .= $tum;
		
	if(is_dir($dir)){
			closedir($dir);
	
	}
		
		
?>