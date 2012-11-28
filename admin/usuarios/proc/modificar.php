<?php



		$aux=explode("-", $fecha_nac_u);     
		$dia = $aux[0];		
	    $mes   = $aux[1];	   
        $ano   = $aux[2];
        $fecha_nac_u = "$ano-$mes-$dia";
	   



if($password_u!=""){
	$password_u = md5($password_u);
	$strg_pass =", password='$password_u'";
}




		


  if($id_perfil_u==$perfil_wm){
  	
	$Sql ="UPDATE usuario
	   SET   login='$login_u' $strg_pass,establecimiento='$establecimiento_u', nombre='$nombre_u' , apellido='$apellido_u', email='$email_u', rut='$rut_u',
       fecha_nac='$fecha_nac_u', edad='$edad_u', estado_civil='$estado_civil_u', direccion='$direccion_u', fono='$fono_u', hijos='$hijos_u', ocupacion='$ocupacion_u', escolaridad='$escolaridad_u',id_comuna='$id_comuna2',celular='$celular_u',
       id_region='$id_region2'
	   WHERE id_usuario='$id_user'";

 mysql_query($Sql)or die (mysql_error());

}else{
	
	
	if($id_perfil_u!=$perfil_wm){
		
	$Sql ="UPDATE usuario
	   SET   login='$login_u',establecimiento='$establecimiento_u'$strg_pass, id_perfil='$id_perfil_u', nombre='$nombre_u' , apellido='$apellido_u', email='$email_u', rut='$rut_u',
       fecha_nac='$fecha_nac_u', edad='$edad_u', estado_civil='$estado_civil_u', direccion='$direccion_u', fono='$fono_u', hijos='$hijos_u', ocupacion='$ocupacion_u', escolaridad='$escolaridad_u',id_comuna='$id_comuna2', celular='$celular_u',
       id_region='$id_region2'
	   WHERE id_usuario='$id_user'";
	//echo $Sql;

 mysql_query($Sql)or die (mysql_error());
	
	}
	
	
}


include("admin/usuarios/proc/agregar_perfiles_colegios.php");


header("HTTP/1.0 307 Temporary redirect");
header("Location:index.php?accion=$accion&act=1&id_user=$id_user");

?>