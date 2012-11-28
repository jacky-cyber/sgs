<?php


$id_sesion = session_id();

$Sql ="UPDATE usuario
	   SET session =''
	   WHERE session ='$id_sesion'";
		//echo $Sql;

 cms_query($Sql)or die (error($query,mysql_error(),$php));

     setcookie("cookname_sgs", "", time()-60*60*24*100, "/");
   	 setcookie("cookpass_sgs", "", time()-60*60*24*100, "/");				 
     
	// echo "rr ".$_COOKIE['cookname']."  tt <br>";
   
	$_COOKIE['cookname_sgs']="";
	$_COOKIE['cookpass_sgs']="";
	
   $_SESSION = array(); // reset session array
   session_destroy();   // destroy session.
   
   
   foreach($_SESSION as $variable=>$valor){
		$_SESSION[$variable]="";
		 }
		 
 //   echo "<meta http-equiv=\"Refresh\" content=\"0;url=$HTTP_SERVER_VARS[PHP_SELF]\">";
  header("Location:index.php");
  
 
?>