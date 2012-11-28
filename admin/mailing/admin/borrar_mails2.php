<?php
$del = $HTTP_GET_VARS['del'];



if(isset($del)){

 $Sql ="DELETE FROM mailing_mailing
         WHERE id_mailing='$id_mailing'";
  cms_query($Sql);

   $Sql ="DELETE FROM user_mailing
         WHERE id_mailing='$id_mailing'";
  cms_query($Sql);
  
    $query= "SELECT image   
              FROM mailing_mail_texto 
              WHERE id_mailing='$id_mailing'";
                $result= cms_query($query);
              while (list($image) = mysql_fetch_row($result)){
  					
					if(file_exists("$url/images/mail/$image")){
					unlink("$url/images/mail/$image");
					
					}
					
					//4539449
					
					   $Sql ="DELETE FROM mailing_mail_texto
					    WHERE id_mailing='$id_mailing' AND image='$image'";
                               cms_query($Sql);
					
						   
  				   }

  header("Location:$PHP_SELF?accion=$accion&act=3040");
}
  $query= "SELECT titulo,subjet     
             FROM  mailing_mailing
              WHERE id_mailing='$id_mailing'";
               $result= cms_query($query);
                 while (list($mail,$subjet) = mysql_fetch_row($result)){
						   
					
  $contenido = "<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                  <tr>
                    <td align=\"center\" class=\"textos\">&nbsp;</td>
                  </tr>
				  <tr>
                    <td align=\"center\" class=\"textos\">Confirmar Elimininaci&oacute;n de <b>$mail</b> con subjet: <b>$subjet</b></td>
                  </tr>
				  <tr>
                    <td align=\"center\" class=\"textos\">&nbsp;</td>
                  </tr>
				   <tr>
                    <td align=\"center\"> <table width=\"300\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                                            <tr>
                                            <td align=\"center\" class=\"textos\">
											<a href=\"$PHP_SELF?accion=$accion&act=3022&id_mailing=$id_mailing&del=ok\">Si</a>
											</td>
											<td align=\"center\" class=\"textos\">
											<a href=\"$PHP_SELF?accion=$accion&act=3040\">No</a>
											</td>
                                             </tr>
                                          </table>
					</td>
                  </tr>
                </table>";
  	   }

?>