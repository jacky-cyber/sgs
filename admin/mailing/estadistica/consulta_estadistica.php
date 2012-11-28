<?php

$query= "SELECT  id_mailing,titulo  
          FROM  mailing_mailing";
           $result= @cms_query($query) or die("$MSG_DIE -1 QR-$query");
           while (list($id_mailing3,$titulo) = mysql_fetch_row($result)){
           $option_sel .="<option value=\"$PHP_SELF?accion=$accion&act=2&id_mailing=$id_mailing3\">$titulo</option>";
          
           }


      	
				



?>


