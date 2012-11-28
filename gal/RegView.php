<?php
include("../lib/connect_db.inc");
include("../lib/lib.inc");
include("../config.php");

$id_mail = $_GET['id_mail'];

$Sql ="UPDATE mails
	   SET vio ='ok'
	   WHERE id_fecha ='$id_mail'";

 cms_query($Sql)or die (error($query,mysql_error(),$php));
  
	  
?>