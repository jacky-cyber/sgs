<?php

       $id_tipo = $HTTP_POST_VARS['id_tipo'];
	   $predefinido = $HTTP_POST_VARS['predefinido'];
       $nombre_mailing = $HTTP_POST_VARS['nombre_mailing'];
	   $titulo_mailing = $HTTP_POST_VARS['titulo_mailing'];
       $html= $HTTP_POST_VARS['html'];
	   $texto_html = $HTTP_POST_VARS['texto_html'];
	   $texto = $HTTP_POST_VARS['texto'];
       $subjet_mail = $HTTP_POST_VARS['subjet_mail'];
	   $id_mailing = $HTTP_POST_VARS['id_mailing'];
	   $link = $HTTP_POST_VARS['link'];
	   $formato = $HTTP_POST_VARS['formato'];
	   
	   
	   $imagen_name= $HTTP_POST_FILES['imagen']['name'];
	   $imagen= $HTTP_POST_FILES['imagen']['tmp_name'];
	   
	   if($subjet_mail==""){
	     $Sql ="UPDATE mailing_mailing
         	   SET html ='$html',txt='$texto_html'
         	   WHERE id_mailing ='$id_mailing'";
       
	   }else{
	   
	        $Sql ="UPDATE mailing_mailing
         	   SET html ='$html',txt='$texto_html',subjet='$subjet_mail',url='$link',estado='2',br='$formato'
         	   WHERE id_mailing ='$id_mailing'";
    
	   }
    
	
    
         		 
         	   cms_query($Sql)or die ("ERROR 1 <br>$Sql");
	  
		/*$qry_insert="INSERT INTO  mailing values ( '$id_mailing','$nombre_mailing','$subjet','$id_tipo','$html','$texto_html')";
         $result_insert=cms_query($qry_insert) or die("$MSG_DIE - QR-Problemas al insertar $qry_insert");
	    */
		
		 if (isset($imagen)){
                   if($imagen_name!=""){
				   
				      $imagen2 = ereg_replace('&','*',$imagen_name);
				      $imagen2 = ereg_replace(' ',':',$imagen2);
				      
				      if(file_exists("images/sitio/mail/$imagen2")){
				      	unlink("images/sitio/mail/$imagen2");
				      }
				      
					  
					  
					      if (!@copy($imagen, "images/sitio/mail/$imagen2"))
					         {
					         $contenido .= "Fallo, La imagen chica no se a podido subir al servidor. <br>";
					         $contenido .= "La imagen chica no existe o es muy grande.<br>
							 imagen temp: $imagen<br> imagen nombre : $imagen_name<br>
							 ".$_SERVER['SERVER_NAME']."/images/sitio/mail/$imagen2
							 ";
					         }else{
							 	$id_texto = new_uid();		
		
		$qry_insert="INSERT INTO  mailing_mail_texto 
		             values ( '$id_texto','$id_mailing','$titulo_c','$bajada_c','$texto_html','$imagen_name','$link')";
        
	   $result_insert=cms_query($qry_insert) or die("$MSG_DIE - QR-Problemas al insertar $qry_insert");
	
		$contenido .="<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                        <tr>
                          <td align=\"left\" class=\"textos\">
						  <a href=\"$PHP_SELF?accion=$accion&act=1003&id_mailing=$id_mailing\">Generar prueba</a></td>
                        </tr>
						
						<tr>
                          <td align=\"left\" class=\"textos\">
						  <a href=\"$PHP_SELF?accion=$accion&act=1021&id_mailing=$id_mailing&predefinido=3\">Agregar Texto</a></td>
                        </tr>
                      </table>";	
							 
							 }
					
				   }
                   		 
	

             }
			 
		
		
		
		
		

?>