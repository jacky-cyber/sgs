<?php
$pass_html = md5($PASSWORD);

$login= $LOGIN;



  $query= "SELECT id_usuario,nombre,pass   
           FROM  usuarios
           WHERE login='$login'";

     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      list($id_usuario,$nombre,$pass) = mysql_fetch_row($result);
	  
	  
	  if($pass_html==$pass){
	  
	  header("Location:index.php?id_usuario=$id_usuario&accion=7&act=7");
	  }else{
	   header("Location:index.php?erro=1");
	  
	  
	  
	  }

?>