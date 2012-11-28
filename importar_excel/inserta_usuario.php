<?php

function rescata_valor($tabla,$pk,$val_pk,$txt){


    $query= "SELECT $txt   
           FROM  $tabla
           WHERE $pk like '%$val_pk%'";
     $result= mysql_query($query)or die (error($query,mysql_error(),$php));
     list($valor) = mysql_fetch_row($result);
	 
	 return $valor;


}


    $query= "SELECT id_usuario
           FROM  usuario
           WHERE email='$email'";
     $result= mysql_query($query)or die (error($query,mysql_error(),$php));
     	 if(!list($id_u) = mysql_fetch_row($result)){
			
			$id_comuna = rescata_valor('comuna','comuna',$comuna,'id_comuna');
			$id_region = rescata_valor('region','region',$region,'id_region');
			
			$password = md5($email);
			$id_perfil = 1;
            
			$qry_insert="INSERT INTO usuario(nombre,paterno,materno,apoderado,password,id_perfil,login,email,direccion,numero,id_region,ciudad,id_comuna) 
			values ('$nombres','$paterno','$materno','$apoderado','$password','$id_perfil','$email','$email','$calle','$numero','$id_region','$ciudad','$id_comuna')";
                          
            $result_insert=mysql_query($qry_insert) or die("$MSG_DIE $php - QR-Problemas al insertar $qry_insert");
			
			$id_u = mysql_insert_id();			   
		 }

		 
	
		 
?>