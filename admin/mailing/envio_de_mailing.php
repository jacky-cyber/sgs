<?php
$tipo = $HTTP_GET_VARS['tipo'];

$vistos_ok = $HTTP_POST_VARS['vistos_ok'];

  $query= "SELECT  id_tipo_u,descrip   
           FROM mailing_usuario_tipo ";
            $result_tipo= cms_query($query)or die ("ERROR 1 <br>$query");
			
              while (list($id_tipo_u,$descrip) = mysql_fetch_row($result_tipo)){
				$tabla_mailing ="";
				
				$temp = "id_base_$id_tipo_u";
				
				
				if(isset($HTTP_POST_VARS[$temp])){
				$contenido .= "<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                                <tr>
                                  <td align=\"center\">&nbsp;</td>
                                </tr>
								<tr>
                                  <td align=\"center\" class=\"textos\">$descrip</td>
                                </tr>
								<tr>
                                  <td align=\"center\">&nbsp;</td>
                                </tr>
                              </table>";
				$tipo = $HTTP_POST_VARS[$temp];
				
			      $condicion="WHERE tipo='$id_tipo_u' AND nomas <>'ok'";





$query2= "SELECT id_usuario, nombre ,mail,mail2,tipo
          FROM mailing_usuario
		  $condicion";

		 

$result2 = cms_query($query2);


while(list($id_usuario, $nombre ,$email,$email2,$tipo)= mysql_fetch_row($result2)){



$query= "SELECT titulo,subjet,tipo,br    
            FROM  mailing_mailing
            WHERE id_mailing='$id_mailing'";
                           $result_m= cms_query($query);
                  list($titulo,$subjet,$tipo_mailing,$formato) = mysql_fetch_row($result_m);


     $query= "SELECT id_texto,titulo,bajada,contenido,image,link
            FROM mailing_mail_texto WHERE id_mailing='$id_mailing'";
                           $result_mail= cms_query($query);
            while(list($id_texto,$titulo,$bajada,$contenido_m,$image,$link) = mysql_fetch_row($result_mail)){
			
		       if($formato=='of'){
			     $bajada =nl2br($bajada);
			     $contenid =nl2br($contenido_m);
				  } 
						
			if($tipo_mailing==3){
			  if($image!=""){
			   $image ="<a href=\"$url/visit.php?id_usuario=$id_usuario&id_mailing=$id_mailing\">
			    <img src=\"$url/images/sitio/mail/$image\" alt=\"\" border=\"0\"></a>";
			
			   }
			
			$tabla .="<table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                       <tr> 
                        <td class=\"titulo\" align=\"center\">
	                      <a href=\"$url/visit.php?id_receptor=$id_receptor&id_mailing=$id_mailing\">$titulo</a><br>
                        </td>
                       </tr>
		               <tr> 
                         <td class=\"bajada\">$bajada
	                     </td>
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
			
			$tabla .="<table  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
			             <tr>
                          <td align=\"center\">
						  <a href=\"$url/visit.php?id_usuario=$id_usuario&id_mailing=$id_mailing\">
			               <img src=\"$url/images/sitio/mail/$image\" alt=\"\" border=\"0\"></a></td>
                        </tr>
					  </table>";
		
			
			}
			
		}	
			
		
				



if($tipo_mailing==3){
	
	$html_mail .="<table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" >
                     <tr>
                      <td colspan=\"3\" align=\"center\">
                        <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                           <tr>
                                <td align=\"center\" bgcolor=\"$color_fondo\">
	                             <a href=\"$url/visit.php?id_usuario=$id_usuario&id_mailing=$id_mailing\">
	                               <img src=\"$url/logo.gif\" border=\"0\" > </a>
								</td>
                           </tr>
                        </table>
					</td>
                     <tr>
                       <td align=\"center\">  $tabla 
					   </td>
                     </tr>
                  </table>";
}else{
	
	$html_mail .="<table width=\"80%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" >
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
<a href=\"$url/visit.php?id_usuario=$id_usuario&id_mailing=$id_mailing&image=no\">aqu&iacute;</a>
</font></center>
<br>


$html_mail

<img width=\"1\" height=\"1\" src=\"$url/RegView.php?id_usuario=$id_usuario&id_mailing=$id_mailing\">
<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
  
<tr>
    <td>
	  <div align=\"center\">
	   <font face=\"Arial, Helvetica, sans-serif\" size=\"1\" color=\"#000000\">
	   
	   
	   Publica tu auto Gratis en www.4ruedas.cl y participa por entradas dobles para ver Monster Truck en Chile
	 
	   </font>
		</div>
      </td>
  </tr>
  
  
<tr>
    <td>
	  <div align=\"center\">
	   <font face=\"Arial, Helvetica, sans-serif\" size=\"1\" color=\"#000000\">
	   $no_desea</font>
		<font face=\"Arial, Helvetica, sans-serif\" size=\"1\" > 
        <a href=\"$url/unsubcrib.php?id_usuario=$id_usuario&id_mailing=$id_mailing\">aqu&iacute;</a>
		</font></div>
      </td>
  </tr>
<tr>
    <td>
	  <div align=\"center\">
	   <font face=\"Arial, Helvetica, sans-serif\" size=\"1\" color=\"#000000\">
	   $no_desea</font>
		<font face=\"Arial, Helvetica, sans-serif\" size=\"1\" > 
        <a href=\"$url/unsubcrib.php?id_usuario=$id_usuario&id_mailing=$id_mailing\">aqu&iacute;</a>
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
	   $url/mailing/unsubcrib.php?id_usuario=$id_usuario&id_mailing=$id_mailing";
       
	   
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
	  
	  $lc_headers .= "Reply-To: 4ruedas@4ruedas.cl\r\n"; 
      $lc_headers  = "From: $remitente <$mail_remitente>\r\n";
      $lc_headers .= "Mime-Version: 1.0\n";
      $lc_headers .= "Content-Type: multipart/alternative; boundary=\"$boundary\"\r\n";
	   

  $query= "SELECT  id_usuario
           FROM  mailing_user_mailing 
           WHERE id_usuario='$id_usuario' 
		   AND id_mailing = '$id_mailing'
		   AND enviado = 'ok'";
  
  if($vistos_ok=="ok"){
  	  $query= "SELECT  id_usuario
           FROM  mailing_user_mailing 
           WHERE id_usuario='$id_usuario' 
		   AND id_mailing = '$id_mailing'
		   AND enviado = 'ok' 
		   AND reci='ok'";
  }
  
                  $result= @cms_query($query) or die("$MSG_DIE -1 QR-$query");
               $cont++;
			     if(!(list($id_us) = mysql_fetch_row($result))){
    
			  
			  if($email!=""){
			     if($vistos_ok!="ok"){	
			       $qry_insert="INSERT INTO mailing_user_mailing (id_mailing,id_usuario,enviado)
                                VALUES ('$id_mailing','$id_usuario','ok')";
							 
			  

			  //echo "$cont ".$qry_insert."<br>"		 			   ;
               $result_insert=cms_query($qry_insert) or die("$MSG_DIE - QR-Problemas al insertar qry_insert");
				}
				  $tabla_mailing .= "  <tr>
                                       <td align=\"center\" class=\"textos\">$cont :</td>
									   <td align=\"center\" class=\"textos\">$nombre</td>
									   <td align=\"center\" class=\"textos\">$email</td>
									   <td align=\"center\" class=\"textos\">$email2</td>
                                     </tr>";
									 
				$nombre =explode(" ", $nombre);
				$nombre =$nombre[0];

									 
				$lc_subject = str_replace("#NOMBRE#","$nombre",$lc_subject);
	  
                      mail("$nombre  <$email>",$lc_subject,$lc_message,$lc_headers);
			           echo "<br>enviado a  $nombre $email";
                     if($email2!=""){
			        // mail("$nombre  <$email2>",$lc_subject,$lc_message,$lc_headers);
			             }
			   
			     }
			  // echo $nombre;
            usleep(100);
				
				  }else{
				  
				  
				 $tabla_mailing .= "<tr>
                                       <td align=\"left\" class=\"textos\"><font color=\"#FF0000\">$cont :</font></td>
									   <td align=\"left\" class=\"textos\"><font color=\"#FF0000\">$nombre</font></td>
									   <td align=\"center\" class=\"textos\"><font color=\"#FF0000\"></font></td>
									   <td align=\"center\" class=\"textos\"><font color=\"#FF0000\">No enviado</font></td>
                                     </tr>";
				 
				  }
				  
				  	    
				
                    $html_mail="";
					$tabla="";
                    $html ="";

             }


if($vistos_ok=="ok"){

	  $Sql ="UPDATE mailing_mailing
         	   SET estado='5'
         	   WHERE id_mailing ='$id_mailing'";
    
         		 
         	   cms_query($Sql)or die ("ERROR 1 <br>$Sql");

}
	
	



$contenido.="<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                 $tabla_mailing
             </table>";
//echo $html_f;		
	              }
						   
		
			  }
?>
