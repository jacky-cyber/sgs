<?php
include ("../../lib/connect_db.inc");
$id_mailing = $HTTP_GET_VARS['id_mailing'];
$id_usuario = $HTTP_GET_VARS['id_usuario'];
$prueba = $HTTP_GET_VARS['prueba'];
$id_receptor = $HTTP_GET_VARS['id_receptor'];

if(isset($prueba)){
 $Sql ="UPDATE mailing_mail_apro SET vio ='ok'
 	   WHERE id_mailing='$id_mailing' AND id_receptor='$id_receptor'";



}else{
$Sql ="UPDATE mailing_user_mailing
	   SET reci ='ok'
	   WHERE id_usuario ='$id_usuario' 
	   AND id_mailing ='$id_mailing'";

}
				  
	   cms_query($Sql)or die ("ERROR 1 <br>$Sql");

?>