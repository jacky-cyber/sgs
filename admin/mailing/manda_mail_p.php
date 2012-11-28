<?php

     $query= "SELECT titulo,subjet,tipo,br    
            FROM  mailing_mailing
            WHERE id_mailing='$id_mailing'";
                           $result_m= cms_query($query)or die ("ERROR 1 <br>$query");
                  list($titulo,$subjet,$tipo_mailing,$formato) = mysql_fetch_row($result_m);


     $query= "SELECT id_texto,titulo,bajada,contenido,image,link
            FROM mailing_mail_texto 
            WHERE id_mailing='$id_mailing'";
                           $result_mail= cms_query($query)or die ("ERROR 2 <br>$query");
            while(list($id_texto,$titulo,$bajada,$contenido_m,$image,$link) = mysql_fetch_row($result_mail)){
			
			  if($formato=='of'){
			     $bajada =nl2br($bajada);
			     $contenid =nl2br($contenido_m);
			   } 
		
						
			if($tipo_mailing==3){
			
			if($image!=""){
			$image ="<a href=\"http://".$_SERVER['SERVER_NAME']."/visit.php?id_usuario=$id_receptor&id_mailing=$id_mailing\">
			<img src=\"http://".$_SERVER['SERVER_NAME']."/images/sitio/mail/$image\" alt=\"\" border=\"0\"></a>";
			
			}
			$tabla .="<table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                                <tr> 
                                  <td class=\"titulo\" align=\"center\">
	                              <a href=\"http://".$_SERVER['SERVER_NAME']."/visit.php?id_receptor=$id_receptor&id_mailing=$id_mailing&prueba=ok\">$titulo</a>
								  <br>
                                  </td>
                                </tr>
		                     <tr> 
                                 <td class=\"bajada\">$bajada</td>
                             </tr>
                             <tr> 
                                  <td width=\"603\" valign=\"top\"><br>
                                     <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\"  align=\"left\">
                                        <tr > 
                                          <td >
	                                          <table border=\"0\" align=\"left\" cellpadding=\"0\" cellspacing=\"0\">
                                                 <tr> 
                                                    <td width=\"16\" align=\"center\">$image</td>
                                                 </tr>
                                              </table>
	                           </td>
                             </tr>
                             <tr > 
                                <td align=\"center\" class=\"textos-chico\">
	                            </td>
                             </tr>
                       </table>

	                <p align=\"justify\" class=\"textos\">$contenido_m</p>
                  </td>
				</table>";
			
			
		
			
			}else{
			
			$tabla .=" <table  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
			            <tr>
                          <td align=\"center\">
						    <a href=\"http://".$_SERVER['SERVER_NAME']."/visit.php?id_usuario=$id_receptor&id_mailing=$id_mailing\">
			                <img src=\"http://".$_SERVER['SERVER_NAME']."/images/sitio/mail/$image\" alt=\"\" border=\"0\">
							</a>
							</td>
                          </tr>
						</table>";
		
			
			}
			
				
	
				  
	
	
	
	 }
	 
	 
	 
	 
	 			  
if($tipo_mailing==3){
	
	$html_mail ="<table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" > 
	              <tr>
                   <td colspan=\"3\" align=\"center\">
                    <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                      <tr>
                       <td align=\"center\" bgcolor=\"$color_fondo\">
	                      <a href=\"http://".$_SERVER['SERVER_NAME']."/visit.php?id_usuario=$id_receptor&id_mailing=$id_mailing\">
	                      <img src=\"http://".$_SERVER['SERVER_NAME']."/logo.gif\" border=\"0\" > </a>
					     </td>
                       </tr>
                    </table>
                  </td>
                 </tr>
                 <tr>
                   <td align=\"center\">  $tabla 
				   </td>
                 </tr> 
			   </table>";
	}else{
	
	$html_mail ="<table width=\"80%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" >
                 <tr><td>
				    $tabla
				 </td></tr>
                 </table>";
	}
	 

$html ="<html>
<head>
<title>$cliente</title>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">
$estilos
</head>

<body bgcolor=\"$color_fondo\" leftmargin=\"0\" topmargin=\"0\" marginwidth=\"0\" marginheight=\"0\">
<center><font size=\"1\" face=\"Arial, Helvetica, sans-serif\">$si_ud_no_ve
<a href=\"http://".$_SERVER['SERVER_NAME']."/visit.php?id_receptor=$id_receptor&id_mailing=$id_mailing&image=no&prueba=ok\">aqu&iacute;</a>
</font></center>
<br>


$html_mail

<img width=\"1\" height=\"1\" src=\"http://".$_SERVER['SERVER_NAME']."/RegView.php?id_receptor=$id_receptor&id_mailing=$id_mailing&prueba=ok\">
<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
  

<tr>
    <td>
      <div align=\"center\">
	   <font face=\"Arial, Helvetica, sans-serif\" size=\"1\" color=\"#000000\">
	   $no_desea</font>
		<font face=\"Arial, Helvetica, sans-serif\" size=\"1\" > 
        <a href=\"http://".$_SERVER['SERVER_NAME']."/unsubcrib.php?id_receptor=$id_receptor&id_mailing=$id_mailing&prueba=ok\">aqu&iacute;</a>
		</font></div>
	  </td>
  </tr>
</table>
</body>
</html>
";
			

$lc_text ="
        \n
         $titulo.\n
		\n
		$contenido\n

     Visite $url
	    Si no quiere seguir recibiendo más información, por favor haga click aquí\n
	   $url/unsubcrib.php?id_receptor=$id_receptor&id_mailing=$id_mailing";
       
	   
	   $boundary = "----=_NextPart_000_" . uniqid("SO_PHP");

      // text
      $lc_message = "--$boundary\n";
      $lc_message .= "Content-Type: text/plain; \n\tcharset=\"iso-8859-1\"\r\n";
      $lc_message .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
      $lc_message .= $lc_text . "\n";

      // html
      $lc_message .= "--$boundary\r\n";
      $lc_message .= "Content-Type: text/html; \n\tcharset=\"iso-8859-1\"\r\n";
      $lc_message .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
      $lc_message .= $html;
      $lc_message .= "\r\n--$boundary--";

      /* recipients */
      $lc_recipient = "$nombre $apellido <$email>";

      /* subject */
	  $lc_subject ="$subjet";
	  
	  
      $lc_headers  = "From: $remitente <$mail_remitente>\r\n";
      $lc_headers .= "Mime-Version: 1.0\n";
      $lc_headers .= "Content-Type: multipart/alternative; boundary=\"$boundary\"\r\n";
	   

	  
	    mail("$nombre  <$mail>",$lc_subject,$lc_message,$lc_headers);
      
	  
	  
	$html ="<html>
    <head>
    <title>$nombre_pag</title>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">
    </head>
    
    <body bgcolor=\"#FFFFFF\" text=\"#000000\">
    <table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
      <tr>
        <td align=\"center\">Ha recibido un mail con el sigiente t&iacute;tulo o Subjet <b>$subjet</b></td>
      </tr>
    </table>
	<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
      <tr>
        <td align=\"center\">
		<a href=\"$url/aprobar_ok.php?id_receptor=$id_receptor&id_mailing=$id_mailing\">Para <b>Aprobar</b> el mail clickee aqu&iacute;</a>
		</td>
      </tr>
	  
	  <tr>
        <td align=\"center\">
		&nbsp;
		</td>
      </tr>
	  <tr>
        <td align=\"center\">
		<a href=\"$url/aprobar_no.php?id_receptor=$id_receptor&id_mailingr=$id_mailing\">Para <b>Des-Aprobar</b> el mail clickee aqu&iacute;</a>
		</td>
      </tr>
    </table>
	
    </body>
    </html>";
	    
	   $boundary = "----=_NextPart_000_" . uniqid("SO_PHP");

      // text
      $lc_message = "--$boundary\n";
      $lc_message .= "Content-Type: text/plain; \n\tcharset=\"iso-8859-1\"\r\n";
      $lc_message .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
      $lc_message .=  "\n";

      // html
      $lc_message .= "--$boundary\r\n";
      $lc_message .= "Content-Type: text/html; \n\tcharset=\"iso-8859-1\"\r\n";
      $lc_message .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
      $lc_message .= $html;
      $lc_message .= "\r\n--$boundary--";

      /* recipients */
      /* subject */
	  $lc_subject ="Mail de Aprobación";
	  
	  
      $lc_headers  = "From: sistema de mailing_mailing<$mail_remitente>\r\n";
      $lc_headers .= "Mime-Version: 1.0\n";
      $lc_headers .= "Content-Type: multipart/alternative; boundary=\"$boundary\"\r\n";
	   

	 
	  
	      mail("$nombre  <$mail>",$lc_subject,$lc_message,$lc_headers); 
	  



     $tabla="";
?>