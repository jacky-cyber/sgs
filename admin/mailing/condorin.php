<?php

include("lib/connect_db.inc");
include("lib/lib.inc");


  $query= "SELECT mail   
                           FROM mailing_usuario
                           WHERE id_usuario='' ";
                           $result= cms_query($query);
        while (list($mail) = mysql_fetch_row($result)){
						 usleep(10);
						 $id_usuario= new_uid();
						   $Sql ="UPDATE usuario
                           	   SET id_usuario ='$id_usuario'
                           	   WHERE mail ='$mail'";
                           				  
										  
                           	   cms_query($Sql)or die ("ERROR 1 <br>$Sql");
							   
							   echo "$mail <br>";
							   $cont++;
						   }

	echo "$cont <br>";					   
?>