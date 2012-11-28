<?php
 
   

    $query= "SELECT folio   
           FROM  sgs_solicitud_acceso
           WHERE id_usuario='0'";
     $result0= mysql_query($query)or die (error($query,mysql_error(),$php));
      while (list($folio) = mysql_fetch_row($result0)){
						   
		

    $query= "SELECT datos_post   
           FROM  estadisticas_acciones
		   where url like '%ingreso-de-solicitudes&act=4%' and datos_post like '%$folio%'";
		  
     $result= mysql_query($query)or die (error($query,mysql_error(),$php));
      while ( list($datos_post) = mysql_fetch_row($result)){
	  	
			$datos_post = str_replace("<br>","#",$datos_post);		   
			//echo $datos_post;	
		

		 	
		 
		 
		 $aux=explode("#", $datos_post);
       
  
		 for( $i = 1; $i < count($aux); $i++)
   		 {
        	$var =  $aux[$i]." \n";
			$var = trim($var);
			$aux2 =explode("=", $var);
			
			//echo $aux[$i] ." -- nom_var = ". $aux2[0]." --> valor = ". $aux2[1]."<br>";
        	 $$var = trim($aux2[1]);
			$variable= trim($aux2[0]);
			$$variable = trim($aux2[1]);
			//echo $variable ."=".$$variable."<br>\n";
   		 }

//echo "folio = $folio <br>"		;
		
		
		
		
		if($email==""){
			$login = $razon_social;
		}else{
		$login= $email;
		}

		
		    $query= "SELECT id_usuario  
                   FROM  usuario
                   WHERE login ='$login'";
             $result= mysql_query($query)or die (mysql_error());
              if(!list($id_usuario) = mysql_fetch_row($result)){
        			$qry_insert="INSERT INTO usuario(id_usuario,login,password,id_perfil,establecimiento,nombre,apellido,paterno,materno,razon_social,apoderado,email,session,rut,fecha_nac,edad,estado_civil,direccion,numero,depto,fono,hijos,ocupacion,escolaridad,estado,celular,orden,equipo,id_region,ciudad,id_comuna,comuna,empresa,direccion_empresa,comuna_empresa,codigo,telefono,id_ocupacion,id_rango_edad,id_sexo,id_nacionalidad,id_nivel_educacional,id_organizacion,id_frecuencia_organizacion,fecha_crea,fecha_ingreso,id_tipo_persona,id_entidad_padre,id_entidad)
								  values (NULL,'$login','$pass','$id_perfil','$establecimiento','$nombre','$apellido','$paterno','$materno','$razon_social','$apoderado','$email','$session','$rut','$fecha_nac','$edad','$estado_civil','$direccion','$numero','$depto','$fono','$hijos','$ocupacion','$escolaridad','$estado','$celular','$orden','$equipo','$id_region','$ciudad','$id_comuna','$comuna','$empresa','$direccion_empresa','$comuna_empresa','$codigo','$telefono','$id_ocupacion','$id_rango_edad','$id_sexo','$id_nacionalidad','$id_nivel_educacional','$id_organizacion','$id_frecuencia_organizacion','$fecha','$fecha','$id_tipo_persona','$id_entidad_padre','$id_entidad')";
  				//echo $qry_insert;
      				$result_insert=mysql_query($qry_insert) or die("$MSG_DIE $php - QR-Problemas al insertar $qry_insert");
				 $id_usuario = mysql_insert_id();   
        		 }
				 
				 
			$Sql ="UPDATE sgs_solicitud_acceso
            	   SET id_usuario ='$id_usuario'
            	   WHERE folio ='$folio' and id_usuario=0";
            		echo $Sql."<br>\n";		  
        mysql_query($Sql)or die ("ERROR $php <br>$Sql");	
	  }
			
 }
		
		 
?>