<?php

include("../../lib/connect_db.inc");    
include("../../lib/lib.inc");



$login_u = $_GET['q'];
$idm = $_GET['idm'];

  $query= "SELECT id_usuario
           FROM  usuario
           WHERE session='$idm'";
     $result1= mysql_query($query)or die (mysql_error());
      if (list($id) = mysql_fetch_row($result1) and $idm!=""){
	  
				$query= "SELECT id_usuario
           FROM  usuario
           WHERE login='$login_u'";
     $result= mysql_query($query)or die (mysql_error());
    if(list($id) = mysql_fetch_row($result)){
			echo "NO";			   
		 }else{
		 	echo "OK";	
		 }	
		 
		 	   
	}else{

		header("HTTP/1.0 307 Temporary redirect");
        header("Location:http://www.google.com");
	
	}

  

?>