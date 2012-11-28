<?php
include ("../../lib/connect_db.inc");

include ("config.inc");
$id_mailing = $HTTP_GET_VARS['id_mailing'];
$id_usuario = $HTTP_GET_VARS['id_usuario'];
$prueba = $HTTP_GET_VARS['prueba'];

if($prueba=="ok"){

 $Sql ="UPDATE mailing_mail_apro SET visito ='ok'
 	   WHERE id_mailing='$id_mailing' AND id_receptor='$id_receptor'";

}else{
 $Sql ="UPDATE mailing_user_mailing 
 	   SET visit ='ok'
 	   WHERE id_mailing='$id_mailing' AND id_usuario='$id_usuario'";
 				  
 	 

}


 if(cms_query($Sql)or die("$MSG_DIE - QR-Problemas al insertar $qry_insert")){
 
       
	     $query= "SELECT url   
                  FROM  mailing_mailing
                  WHERE id_mailing='$id_mailing'";
             $result= cms_query($query);
            list($url) = mysql_fetch_row($result);
			
			if($url==""){
		   Header("Location: $url_defecto");
			}else{
			 Header("Location: $url");
			}
 
 }

	          
 
 

?>