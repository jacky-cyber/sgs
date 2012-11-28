<?php

include("../../lib/connect_db.inc");    



  $query= "SELECT id_usuario,mail
           FROM  mailing_usuario ";
     $result= cms_query($query)or die ("ERROR 1 <br>$query");
      while (list($id_usuario,$nombre) = mysql_fetch_row($result)){
			
				$nombre = explode("@", $nombre);
				$nombre = $nombre[0];	

				$Sql ="UPDATE mailing_usuario
					   SET nombre ='$nombre'
					   WHERE id_usuario ='$id_usuario'";
								  
					   cms_query($Sql)or die ("ERROR 1 <br>$Sql");
			
					   echo "$id_usuario $nombre<br>";
				   
		 }
		 
		 
?>