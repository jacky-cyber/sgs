<?php
//vamos a crear un usuario
$fecha = date(y)."-".date(m)."-".date(d);
$id_empresa_u = $_POST['id_empresa_u'];
$id_perfil_u = $_POST['id_perfil_u'];
$nombre_u = $_POST['nombre_u'];
$apellido_u = $_POST['apellido_u'];
$login_u = $_POST['login_u'];
$password_u = $_POST['password_u'];
$email_u = $_POST['email_u'];
$direccion_u = $_POST['doreccion_u'];
$var_check= $_POST['var_check'];
$id_perfil_u = $_POST['id_perfil'];

$pass_crip =md5($password_u);


  $query= "SELECT id_usuario  
           FROM  usuario
           WHERE login='$login_u'";

  

     $result= cms_query($query)or die (error($query,mysql_error(),$php));
 if (!list($id) = mysql_fetch_row($result)){
 	
   	$qry_insert="INSERT INTO usuario (id_usuario, id_empresa, id_perfil, nombre, apellido, login, password,email, fecha) 
   	values ('',$id_empresa_u,$id_perfil_u, '$nombre_u','$apellido_u','$login_u', '$pass_crip' ,'$email_u', '$fecha')";   	
   	               
   	                 $result_insert=cms_query($qry_insert) or die (error($qry_insert,mysql_error(),$php));
   	                 $id_user=mysql_insert_id();

   	    
   	            
   	 if(isset($var_check)){
   	 	
   	 	include("admin/usuarios/envia_mail.php");
   	 }
   	 
   	 echo "<script>alert('Usuario $nombre_u creado exitosamente'); document.location.href='?accion=$accion&act=$act&act_usuario=1&id_user=$id_user&id_emp=$id_empresa_u';</script>\n";	
   	              
        
 }
 else{
 	$accion_form = "$PHP_SELF?accion=$accion&act=$act&act_usuario=6";
 	

 
 
 if($idm=='eng'){
 	$msg= "<table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
 	 	   <tr><td align=\"center\" class=\"textos\"> &nbsp;</td></tr>
 	       <tr >
 	      <td align=\"center\" class=\"textos\"><font color=\"#FF0000\">This login already exists tries again</font></td>
       	  </tr>
       	   <tr><td align=\"center\" class=\"textos\"> &nbsp;</td></tr>
       	  </table>";
 	$msg2 ="<font color=\"#FF0000\">(*)</font> ";
 	
 	     
 	
 }
else{
	$msg= "<table width=\"90%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
 	 	   <tr><td align=\"center\" class=\"textos\"> &nbsp;</td></tr>
 	       <tr >
 	      <td align=\"center\" class=\"textos\"><font color=\"#FF0000\">Este login ya existe intente nuevamente</font></td>
       	  </tr>
       	   <tr><td align=\"center\" class=\"textos\"> &nbsp;</td></tr>
       	  </table>";
 	$msg2 ="<font color=\"#FF0000\">(*)</font> ";
 	
 	    
}

include("admin/usuarios/form/formulario.php");
  } 
  
 
 	


?>