<?php


/*
 $login=$_POST["login"];
 $pass=$_POST["password"];
 $advertencia="";          
 
 $clave=md5($pass); 
*/
/* $query= "SELECT nombre,apellido,paterno,materno,password,email  
         FROM  usuario
         WHERE login = '$login'
		 AND password='$clave'";*/
 $id_usuario     = id_usuario($id_sesion);
		 
$query= "  SELECT nombre,apellido,paterno,materno,password,email  
           FROM  usuario
           WHERE id_usuario = '$id_usuario'
		";		 
     $result_usuario= cms_query($query)or die (error($query,mysql_error(),$php));
     if (list($nombre,$apellido,$paterno,$materno,$password,$email) = mysql_fetch_row($result_usuario)){
			$nombre_pass= md5($nombre);
                        $apellido_pass= md5($nombre);
                        $paterno_pass= md5($nombre);
                        $email_pass= md5($nombre);
		//$resp=1;
		  if($nombre_pass==$password){
			$_SESSION["texto_advertencia_up"]="Para mayor seguridad debe modificar su password presionando";
		  }	
		   if($apellido_pass==$password){
			$_SESSION["texto_advertencia_up"]="Para mayor seguridad debe modificar su password presionando";
		  } 
		   if($paterno_pass==$password){
		    $_SESSION["texto_advertencia_up"]="Para mayor seguridad debe modificar su password presionando";
		  }
		  if($email_pass==$password){
			$_SESSION["texto_advertencia_up"]="Para mayor seguridad debe modificar su password presionando";
		  }
		   $num= md5('123456'); 
		  if($password==$num){
			$_SESSION["texto_advertencia_up"]="Para mayor seguridad debe modificar su password presionando";
		  }	
		  if(strlen($pass)<=4){
			$_SESSION["texto_advertencia_up"]="Para mayor seguridad debe modificar su password presionando";
		  }	
		  if($email==""){
			$_SESSION["texto_advertencia_up"]="Su cuenta no posee correo electr&oacute;nico para ingresarlo presione";
		  }		  
	}	
	
 
 
 /*
 if($_GET['tp']==8){
  
  $_SESSION["texto_advertencia"]="Su cuenta no posee correo electr&oacute;nico para ingresarlo presione";
 }
*/ 
 


///$_SESSION["texto_advertencia"] = $_SESSION["texto_advertencia"]."--RRRR";
/*




 
 $id_usuario     = id_usuario($id_sesion);
 
 $login=$_POST["login"];
 $pass=$_POST["password"];
    $advertencia="";          

   $clave=md5($pass); 
$query= "SELECT nombre,apellido,paterno,materno,password,email  
         FROM  usuario
         WHERE login = '$login'
		 AND password='$clave'";
     $result_usuario= cms_query($query)or die (error($query,mysql_error(),$php));
     if (list($nombre,$apellido,$paterno,$materno,$password,$email) = mysql_fetch_row($result_usuario)){
			$nombre_pass= md5($nombre);
                        $apellido_pass= md5($nombre);
                        $paterno_pass= md5($nombre);
                        $email_pass= md5($nombre);
                       
                       if($nombre_pass==$password){
                        $advertencia =  "<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                  <tr>
                    <td align=\"center\" class=\"textos\">
                    <a href=\"index.php?accion=mis-datos\">
                    <img src=\"images/atencion.gif\" alt=\"\" border=\"0\"></a></td>
                  </tr>
                  <tr><td align=\"center\" class=\"textos_rojo\">
                  <a href=\"index.php?accion=mis-datos\">La contrase&ntilde;a presenta una seguridad muy d&eacute;bil, se sugiere modificarla</a> </td></tr> 
                </table>"; 
                        } 
                       if($apellido_pass==$password){
                        $advertencia =  "<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                  <tr>
                    <td align=\"center\" class=\"textos\">
                    <a href=\"index.php?accion=mis-datos\">
                    <img src=\"images/atencion.gif\" alt=\"\" border=\"0\"></a></td>
                  </tr>
                  <tr><td align=\"center\" class=\"textos_rojo\">
                  <a href=\"index.php?accion=mis-datos\">La contrase&ntilde;a presenta una seguridad muy d&eacute;bil, se sugiere modificarla</a> </td></tr> 
                </table>"; 
                        } 
                        
                      if($paterno_pass==$password){
                        $advertencia =  "<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                  <tr>
                    <td align=\"center\" class=\"textos\">
                    <a href=\"index.php?accion=mis-datos\">
                    <img src=\"images/atencion.gif\" alt=\"\" border=\"0\"></a></td>
                  </tr>
                  <tr><td align=\"center\" class=\"textos_rojo\">
                  <a href=\"index.php?accion=mis-datos\">La contrase&ntilde;a presenta una seguridad muy d&eacute;bil, se sugiere modificarla</a> </td></tr> 
                </table>"; 
                        } 
                        
                     if($email_pass==$password){
                        $advertencia =  "<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                  <tr>
                    <td align=\"center\" class=\"textos\">
                    <a href=\"index.php?accion=mis-datos\">
                    <img src=\"images/atencion.gif\" alt=\"\" border=\"0\"></a></td>
                  </tr>
                  <tr><td align=\"center\" class=\"textos_rojo\">
                  <a href=\"index.php?accion=mis-datos\">La contrase&ntilde;a presenta una seguridad muy d&eacute;bil, se sugiere modificarla</a> </td></tr> 
                </table>"; 
                        } 
                        
                       $num= md5('123456'); 
		
                 if($password==$num){
                        $advertencia =  "<table width=\"300\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
                  <tr>
                    <td align=\"center\" class=\"textos\">
                  
                    <img src=\"images/atencion.gif\" alt=\"\" border=\"0\"></td>
                  </tr>
                  <tr><td align=\"center\" class=\"textos_rojo\">
                  <a href=\"index.php?accion=mis-datos\">La contrase&ntilde;a presenta una seguridad muy d&eacute;bil, se sugiere modificarla</a> </td></tr> 
                </table>"; 
                        } 
                       
                   
               }
    
    exit($advertencia);
		   
                
*/
    

?>