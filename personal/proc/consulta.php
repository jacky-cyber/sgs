<?php
$id_usuario     = id_usuario($id_sesion);


    $query= "SELECT login,password,id_perfil,establecimiento,nombre,apellido,paterno,materno,razon_social,apoderado,email,session,rut,fecha_nac,edad,estado_civil,direccion,numero,depto,fono,hijos,ocupacion,escolaridad,estado,celular,orden,equipo,id_pais,id_region,ciudad,id_comuna,comuna,empresa,direccion_empresa,comuna_empresa,codigo,id_departamento,telefono,id_ocupacion,id_rango_edad,id_sexo,id_nacionalidad,id_nivel_educacional,id_organizacion,id_frecuencia_organizacion,fecha_crea,fecha_ingreso,id_tipo_persona,id_entidad_padre,id_entidad  
FROM usuario
WHERE id_usuario=$id_usuario";

	  
	$result = cms_query($query)or die (error($query,mysql_error(),$php));
    list($login,$password,$id_perfil,$establecimiento,$nombre,$apellido,$paterno,$materno,$razon_social,$apoderado,$email,$session,$rut,$fecha_nac,$edad,$estado_civil,$direccion,$numero,$depto,$fono,$hijos,$ocupacion,$escolaridad,$estado,$celular,$orden,$equipo,$id_pais,$id_region,$ciudad,$id_comuna,$comuna,$empresa,$direccion_empresa,$comuna_empresa,$codigo,$id_departamento,$telefono,$id_ocupacion,$id_rango_edad,$id_sexo,$id_nacionalidad,$id_nivel_educacional,$id_organizacion,$id_frecuencia_organizacion,$fecha_crea,$fecha_ingreso,$id_tipo_persona,$id_entidad_padre,$id_entidad) = mysql_fetch_row($result);
	if (($id_region!="") and ($id_region >0)){
		$sql = "Select id_pais from pais where pais = 'Chile'";
		$result_pais = cms_query($sql)or die (error($sql,mysql_error(),$php));
		list($id_pais)=  mysql_fetch_row($result_pais);
	}

 

?>