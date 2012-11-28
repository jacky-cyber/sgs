<?php
$del = $HTTP_GET_VARS['del'];



 $Sql ="DELETE FROM mailing_mailing
         WHERE id_mailing='$id_mailing'";
  cms_query($Sql);

   $Sql ="DELETE FROM mailing_user_mailing
         WHERE id_mailing='$id_mailing'";
  cms_query($Sql);
  
    $query= "SELECT image   
              FROM mailing_mail_texto
               WHERE id_mailing='$id_mailing'";
                $result= cms_query($query);
              while (list($image) = mysql_fetch_row($result)){
  					
					if(file_exists("../images/mail/$image")){
					unlink("../images/mail/$image");
					
					}
					
				
					
					   $Sql ="DELETE FROM mailing_mail_texto
					    WHERE id_mailing='$id_mailing' AND image='$image'";
                               cms_query($Sql);
					
						   
  				   }

  header("Location:$PHP_SELF?accion=$accion&act=3020");
  
  
  
  
  	   
?>