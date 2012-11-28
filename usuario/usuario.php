<?php
$log=$_GET['log'];
$login = $_POST['login'];
$password = $_POST['password'];
$boton = $_POST['boton'];
$msg= $_GET['msg'];

//echo $_COOKIE['cookname_sgs']." user<br>";
//echo $_COOKIE['cookpass_sgs']." pass<br>";
switch ($msg) {
     case 1:
         include ("usuario/forgot.php");
        
         break;
  
	 
   	default:
   	
   		
	   include ("usuario/main.php");
   }

    if(isset($_COOKIE['cookname']) && isset($_COOKIE['cookpass'])){
      $login = $_COOKIE['cookname'];
      $password = $_COOKIE['cookpass'];
	  
	//  echo "hola $login $password";
   	}
   
if($login!="" and $password!=""  ){
	
	  if(!get_magic_quotes_gpc()) {
			$login = addslashes($login);
   			//$password = addslashes($password);
   		}
   
	$password = md5($password);
		
	  $query= "SELECT id_usuario   
	           FROM  usuario
	           WHERE login='$login' and password='$password' and estado=1 ";
		
	  
	  $result= cms_query($query)or die (error($query,mysql_error(),$php));
	      if (list($id_usuario) = mysql_fetch_row($result)){
	      	

					$Sql ="UPDATE usuario
						   SET session ='$id_sesion'
						   WHERE id_usuario ='$id_usuario'";

 								cms_query($Sql)or die (error($query,mysql_error(),$php));	
							   	   
								 //  header("HTTP/1.0 307 Temporary redirect");
                                 // header("Location:index.php");
			 }else{
			 	//echo "<script>alert('Nombre o contraseña incorrecta'); document.location.href='index.php';</script>\n";
			
				$contenido = "<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                                <tr>
                                  <td align=\"center\" class=\"textos\">Usuario o password inv&aacute;lido, si olvidaste tu contrase&ntilde;a clickea aqu&iacute;</td>
                                </tr>
                              </table>";
			 }
}elseif($log=='ok'){
/*
if(isset($_COOKIE['cookname']) && isset($_COOKIE['cookpass'])){
   setcookie("cookname", "", time()-60*60*24*100, "/");
   setcookie("cookpass", "", time()-60*60*24*100, "/");
}*/
	          // echo "<script>alert('Nombre o contraseña incorrecta'); document.location.href='index.php';</script>\n";
			  
			  	$contenido = "<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                                <tr>
                                  <td align=\"center\" class=\"textos\">Usuario o password inv&aacute;lido , si olvidaste tu contrase&ntilde;a clickea aqu&iacute;</td>
                                </tr>
                              </table>";
}
?>