<?php

	   
	   $fecha_nac_u = fechas_bd($fecha_nac_u);
	   
        $password_u = md5($password_u);

		
		/*
		  $query= "SELECT id_perfil     
                   FROM  usuario_perfil";
             $result= mysql_query($query)or die (mysql_error());
              while (list($id_perfil) = mysql_fetch_row($result)){
        			$var= "id_perfil_$id_perfil";
					if($_POST[$var]){
						$id_perfil_u = $_POST[$var];
					}		   
        		 }
*/
  $query= "SELECT id_usuario 
           FROM  usuario
           WHERE login='$login_u' and establecimiento = $establecimiento_u";
     $result= mysql_query($query)or die (mysql_error());
     if(!list($id_us) = mysql_fetch_row($result)){
     	
			$qry_insert="INSERT INTO usuario(id_usuario,login,password,id_perfil,establecimiento,nombre,apellido,email,session,rut,fecha_nac,edad,estado_civil,direccion,fono,hijos,ocupacion,escolaridad,celular,equipo,id_comuna,id_region) 
 values('','$login_u','$password_u','$id_perfil_u','$establecimiento_u','$nombre_u','$apellido_u','$email_u','$session_u','$rut_u','$fecha_nac_u','$edad_u','$estado_civil_u','$direccion_u','$fono_u','$hijos_u','$ocupacion_u','$escolaridad_u','$celular_u','$equipo_u','$id_comuna2','$id_region2')
 ";
		//echo $qry_insert;             
$result_insert=mysql_query($qry_insert) or die("$MSG_DIE - QR-Problemas al insertar $qry_insert");			   
		 
        
$id_user = mysql_insert_id();
 
 include("admin/usuarios/proc/agregar_perfiles_colegios.php");

}else{
		 	echo "<script>alert('Ya existe un Usuario con estos datos'); document.location.href='index.php?accion=$accion&act=4';</script>\n";
		 }
?>