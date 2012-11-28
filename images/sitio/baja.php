<?php
/*
include("../../lib/connect_db.inc.php");
include("../../lib/lib.inc.php");
include("../../lib/lib.inc2.php");

session_start();


$id_sesion = session_id();


    $query= "SELECT id_usuario
           FROM  usuario
           WHERE session='$id_sesion'";
     $result= mysql_query($query);
      if(list($id_usuario,$nombre) = mysql_fetch_row($result)){
		
		$url = $_GET['url'];
		$archivo = $_GET['archivo'];
		$url = "sistema/$url/$archivo";
	
    	Header ( "Content-Type: application/octet-stream"); 
    	Header ( "Content-Length: ".filesize($url)); 
    	Header( "Content-Disposition: attachment; filename=$archivo"); 
    	readfile($url); 
	
	 }
*/
?>