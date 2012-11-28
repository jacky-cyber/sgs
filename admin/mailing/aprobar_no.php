<?php
include("../../lib/lib.inc");  
include("../../lib/connect_db.inc"); 

$id_receptor = $HTTP_GET_VARS['id_receptor'];   
$id_mailing = $HTTP_GET_VARS['id_mailing'];

$Sql ="UPDATE mailing_mail_apro SET aprobacion='no'
	   WHERE id_mailing ='$id_mailing' and id_receptor='$id_receptor'";
			
	   cms_query($Sql)or die ("ERROR 1 <br>$Sql");

	   echo "Mail desaprobado<br>Muchas Gracias";

?>