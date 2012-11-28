<?php
//Exportar a excel la base de datos de usuarios registrados

//WHERE id_perfil=1 
  $query= "SELECT DISTINCT id_usuario,login,password,id_perfil,establecimiento,nombre,apellido,paterno,materno,razon_social,apoderado,email,session,rut,fecha_nac,edad,estado_civil,direccion,numero,depto,fono,hijos,ocupacion,escolaridad,estado,celular,orden,equipo,id_region,ciudad,id_comuna,comuna,empresa,direccion_empresa,comuna_empresa,codigo,telefono,id_ocupacion,id_rango_edad,id_sexo,id_nacionalidad,id_nivel_educacional,id_organizacion,id_frecuencia_organizacion,fecha_crea,fecha_ingreso,id_tipo_persona,id_entidad_padre,id_entidad,id_departamento  
           FROM  usuario 
		   
            order by nombre
			";
			
     $result2= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($id_usuario,$login,$password,$id_perfil,$establecimiento,$nombre,$apellido,$paterno,$materno,$razon_social,$apoderado,$email,$session,$rut,$fecha_nac,$edad,$estado_civil,$direccion,$numero,$depto,$fono,$hijos,$ocupacion,$escolaridad,$estado,$celular,$orden,$equipo,$id_region,$ciudad,$id_comuna,$comuna,$empresa,$direccion_empresa,$comuna_empresa,$codigo,$telefono,$id_ocupacion,$id_rango_edad,$id_sexo,$id_nacionalidad,$id_nivel_educacional,$id_organizacion,$id_frecuencia_organizacion,$fecha_crea,$fecha_ingreso,$id_tipo_persona,$id_entidad_padre,$id_entidad,$id_departamento) = mysql_fetch_row($result2)){
      	
		$lista_usuarios .="<tr>
		 <td>$login </td>
		 <td >$nombre</td> 
	     <td >$paterno</td> 
		 <td >$materno</td> 
		 <td >$razon_social</td> 
		 <td >$apoderados</td> 
		 <td >$email</td> 
		</tr> ";
		
		}


 header("Content-type: application/vnd.ms-excel");
 header("Content-Disposition:  filename=\"Registros_usuarios.xls\";");
 
 echo "<table border=1>" ;
 echo "<tr>
		 <th>Login </th>
		 <th >Nombre</th> 
	     <th >Paterno</th> 
		 <th >Materno</th> 
		 <th >Razon Social</th> 
		 <th >Apoderados</th> 
		 <th >Email</th> 
		</tr>";
echo $lista_usuarios;
 echo "</table>";

?>