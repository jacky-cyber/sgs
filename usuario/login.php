<?php
/*
$login = $_GET['login'];
$password = $_GET['password'];

if($login==""){
	
	
	
}
//echo $var_post;
if($password==""){
	
	
	
}*/

//setcookie("cookpass_sgs", $_POST['password'], time()+3600);

$var_post="ok";
$login = $_POST['login'];
$password = $_POST['password'];

if($login!="" and $password!="" ){

if($_COOKIE["cookpass_sgs"])
	$password = $_COOKIE["cookpass_sgs"];
else
	$password=md5($password);

if($_COOKIE["cookname_sgs"])
	$login = $_COOKIE["cookname_sgs"];


	
$login = mysql_escape_string($login);
$password = mysql_escape_string($password);


$query= "SELECT id_usuario
FROM usuario
WHERE login='".sql_quote($login)."' and password='".sql_quote($password)."' and estado=1 ";

 //echo $query;

$result= cms_query($query)or die (error($query,mysql_error(),$php));
if (list($id_usuario) = mysql_fetch_row($result)){

$Sql ="UPDATE usuario
SET session ='$id_sesion'
WHERE id_usuario ='$id_usuario'";


 cms_query($Sql)or die (error($query,mysql_error(),$php));
//echo $_POST['remember']." ssss";
 			if($_POST['remember']=="1"){
			 
			// echo "escribi $login y $password";
				 unset($_COOKIE['cookname_sgs']); 
				 unset($_COOKIE['cookpass_sgs']);
			     setcookie("cookname_sgs", $_POST['login'], time()+60*60*24*100);
				// $pp=md5($_POST['password']);
     			 setcookie("cookpass_sgs",md5($_POST['password']), time()+60*60*24*100);
   				//setcookie("CookieDePrueba", $_POST['remember'], time()+3600);
			 }if($_POST['remember']=="2"){
			 	unset($_COOKIE['cookname_sgs']); 
				unset($_COOKIE['cookpass_sgs']);
			 }
  		
            //header("HTTP/1.0 307 Temporary redirect");

                        if($_SESSION['url_login']!=""){
                            
                           // $contenido ="window.location = \"".$_SESSION['url_login']."\"";
                            //header("Location:".$_SESSION['url_login']);
                            //echo 1;
                            echo $_SESSION['url_login'];
                        }else{
                            echo 1;
                            //header("Location:index.php");	
                        }
					 
            //$contenido="ok";
            //include("usuario/ficha_usuario.php");
            //$contenido=$login_html;
        }else{
       // echo 0;
                        //$contenido ="<div class=\"alert alert-error\">Lo sentimos, el usuario o contrase&ntilde;a ingresado no son correctos</div>";	
        echo 0;
        }

//echo "$contenido";

}else{
//include("usuario/formulario_registro.php");
//$er=1;
//include("usuario/formulario_registro.php");
	
//header("Location:index.php?mesj=1");	
//$contenido=$login_html;
echo 0;
}


?>