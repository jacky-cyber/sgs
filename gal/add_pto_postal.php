<?php

 
  $query= "SELECT id_usuario,mail  
           FROM  mails
           WHERE id_fecha='$id_mail'";
     $result_mail= cms_query($query)or die (error($query,mysql_error(),$php));
      list($id_remitente,$mail_d) = mysql_fetch_row($result_mail);
	//  echo"$id_mail,$id_remitente <br>";
	 
	 $mail_r = datos_encuestas($id_remitente,5,$enc_cero);
	 $mail_r = $mail_r[1];
	 
	//   echo "$mail_r != $mail_d<br>";
	   if($mail_r != $mail_d){
	   
	   
	   $query= "SELECT mail   
                FROM  mails
                WHERE id_usuario='$id_remitente' AND id_fecha <>'$id_mail'
				Order by id_fecha DESC";
          $result= cms_query($query)or die (error($query,mysql_error(),$php));
    // echo $query."<br>";
	  list($mail) = mysql_fetch_row($result);
	//   echo "$mail!=$mail_d";
		  if($mail!=$mail_d){
		 
	         suma_pto($id_mail,$id_remitente,2);  
	       }
	
	  }
	  
	  

?>