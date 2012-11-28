<?php

//voy a consultar por un usuario


  $query= "SELECT id_empresa,id_perfil,nombre,apellido, login, password, email  
           FROM  usuario
           WHERE id_usuario=$id_user ";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      list($id_empresa_u,$id_perfil_u, $nombre_u, $apellido_u, $login_u, $password_u, $email_u) = mysql_fetch_row($result);

      
?>