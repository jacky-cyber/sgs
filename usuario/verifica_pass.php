<?php

/*
 * Select tabla usuario
 * 
 */
if($_GET['axj']==""){
		   


session_register_cms('cont_msg');


 
 $id_usuario     = id_usuario($id_sesion);
 
 
  $cat_verifica = configuracion_cms('verifica_pass');
    $advertencia="";          
 if($_GET['axj']=="" and $_GET['accion']!="mis-datos" and $_SESSION['cont_msg']<$cat_verifica ){
    
$query= "SELECT nombre,apellido,paterno,materno,password,email  
           FROM  usuario
           WHERE id_usuario = '$id_usuario'";
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
    
    
		   if($advertencia!=""){
				      
				      
                $_SESSION['cont_msg']++;
				
				
				$texto = "La contrase&ntilde;a presenta una seguridad muy d&eacute;bil, se sugiere modificarla en <strong>\"<a href=\"index.php?accion=mis-datos\">Mis Datos</a>\"</strong>";
				$mensaje_tool .= genera_alerta($texto,'warning',$posicion='top');  
				
				
				

                 

                   
                   
		   }
                
                 }
                 
     }  
     
?>