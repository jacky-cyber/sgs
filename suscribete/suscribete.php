<?php
$email= $_GET['email'];


  $query= "SELECT email_news  
           FROM  usuarios_newsletter
           WHERE email_news='$email'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      if(!list($email_news) = mysql_fetch_row($result)){
				$date = date(Y)."-".date(m)."-".date(d);
		 $qry_insert="INSERT INTO usuarios_newsletter(id_usuario_newsletter,email_news,fecha_ingreso) values (null,'$email','$date')";
                              
          $result_insert=cms_query($qry_insert) or die("$MSG_DIE $php - QR-Problemas al insertar $qry_insert");
			
				
			$contenido =html_template('texto_gracias_suscribete');
						   
		 }else{
		 
		    $contenido =html_template('texto_ya_existe_suscribete');
			
		 }

?>