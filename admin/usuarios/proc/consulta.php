<?php


  $query= "SELECT id_usuario, id_perfil, nombre,apellido, login, password, email, rut, fecha_nac, edad, estado_civil, direccion, fono, hijos, ocupacion, escolaridad,establecimiento,celular,equipo,id_comuna,id_region  
           FROM  usuario
           WHERE id_usuario=$id_user ";
  //echo "$query";
     $result= mysql_query($query)or die (mysql_error());
      list($id_usuario_u, $id_perfil_u, $nombre_u, $apellido_u, $login_u, $password_u, $email_u, $rut_u, $fecha_nac_u, $edad_u, $estado_civil_u, $direccion_u, $fono_u, $hijos_u, $ocupacion_u, $escolaridad_u ,$establecimiento_u,$celular_u,$equipo_u,$id_comuna2,$id_region2) = mysql_fetch_row($result);


//echo "$id_usuario_u, $id_perfil_u, $nombre_u, $apellido_u, $login_u, $password_u, $email_u, $rut_u, $fecha_nac_u, $edad_u, $estado_civil_u, $direccion_u, $fono_u, $hijos_u, $ocupacion_u, $escolaridad_u ,$establecimiento_u,$celular_u,$equipo_u,$id_comuna,$id_region";

?>