<?php



 if($pass1==$pass2){
 
 if($login!="" and $email!=""){
 
   $query= "SELECT id_usuario
            FROM  usuario
            WHERE login='$login'";
      $result= cms_query($query)or die (error($query,mysql_error(),$php));
       list($id_usuario) = mysql_fetch_row($result);
	   if($id_usuario!=""){
	   header("HTTP/1.0 307 Temporary redirect");
       header("Location:index.php?accion=$accion&msj=1");
	  
	   }
	     $query= "SELECT id_usuario
            FROM  usuario
            WHERE email='$email'";
       $result2= cms_query($query)or die (error($query,mysql_error(),$php));
       list($id_usuario) = mysql_fetch_row($result2);
	  			if($id_usuario!=""){
	  			 header("HTTP/1.0 307 Temporary redirect");
      			 header("Location:index.php?accion=$accion&msj=2");
	
	  			}
	   
	   
 if($id_usuario==""){
 
 
 if($id_region==""){
 $id_region=1;
 }

 if($id_comuna==""){
 $id_comuna = 1;
 }
 $fecha= date(Y)."-".date(m)."-".date(d);
 
 $pass= md5($pass1);
 //
 
//"id_tipo_persona

  if($email!=""  and $paterno!="" and $paterno!="" and $pass!=""  and $id_region!="" and $id_comuna!="" and $direccion!="" and $numero!=""){

$qry_insert="INSERT INTO usuario(id_usuario,login,password,id_perfil,establecimiento,nombre,apellido,paterno,materno,razon_social,apoderado,email,session,rut,fecha_nac,edad,estado_civil,direccion,numero,depto,fono,hijos,ocupacion,escolaridad,estado,celular,orden,equipo,id_region,ciudad,id_comuna,comuna,empresa,direccion_empresa,comuna_empresa,codigo,telefono,id_ocupacion,id_rango_edad,id_sexo,id_nacionalidad,id_nivel_educacional,id_organizacion,id_frecuencia_organizacion,fecha_crea,fecha_ingreso,id_tipo_persona,id_entidad_padre,id_entidad)
			  values (NULL,'$login','$pass','$id_perfil','$establecimiento','$nombre','$apellido','$paterno','$materno','$razon_social','$apoderado','$email','$session','$rut','$fecha_nac','$edad','$estado_civil','$direccion','$numero','$depto','$fono','$hijos','$ocupacion','$escolaridad','$estado','$celular','$orden','$equipo','$id_region','$ciudad','$id_comuna','$comuna','$empresa','$direccion_empresa','$comuna_empresa','$codigo','$telefono','$id_ocupacion','$id_rango_edad','$id_sexo','$id_nacionalidad','$id_nivel_educacional','$id_organizacion','$id_frecuencia_organizacion','$fecha','$fecha','$id_tipo_persona','$id_entidad_padre','$id_entidad')";
  
      $result_insert=mysql_query($qry_insert) or die("$MSG_DIE $php - QR-Problemas al insertar $qry_insert");
									   
					$usuario_ok="ok";	
					$id_usuario = mysql_insert_id();	
					$nombre =  "$nombre $apellido";
					$id_usuario_n = mysql_insert_id();
				
					enviar_mail_gracias_registro($nombre, $email,$login ,$pass1, $id_sesion);

			}
 

 
  		}
 										
     }
 }
 
  if($id_region!=""){
  
  $query= "SELECT region   
           FROM  regiones
           WHERE id_region='$id_region'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
     list($region) = mysql_fetch_row($result);
	} 
	
	if($id_comuna!=""){
	
	
 $query= "SELECT comuna   
           FROM  comunas
           WHERE id_comuna='$id_comuna'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
     list($comuna) = mysql_fetch_row($result);
	 }
	 

 

			  

?>