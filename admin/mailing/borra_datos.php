<?php
include("lib/lib.inc");  
include("lib/connect_db.inc");    


  $query= "SELECT id_usuario
                           FROM mailing_usuario
                           WHERE tipo <>'1'";
                           $result= cms_query($query);
                           while (list($id_usuario) = mysql_fetch_row($result)){
						   
						   $query_del ="DELETE FROM user_mailing 
						                 WHERE id_mailing='2004070802333087' 
										 AND id_usuario='$id_usuario'";
						   $result_del= cms_query($query_del);
						   echo "$id_usuario <br>";
						   }


?>