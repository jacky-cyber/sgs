<?php

	$id_usuario     = id_usuario($id_sesion);
   $id_auto_admin="usuario";
  // $_GET['id']=$id_usuario;
			$query= "SELECT * 
		 		FROM usuario
		 		WHERE id_usuario='$id_usuario'"; 
			$result= mysql_query($query)or die ("ERROR $php <br>$query"); 
			$num_filas = mysql_num_fields($result); 
			$resultado = mysql_fetch_row($result); 
			for (
				$i = 1; $i < $num_filas; $i++){ 
				$nom_campo = mysql_field_name($result,$i); 
				$valor = $resultado[$i];
				if($_POST[$nom_campo]==""){
					$$nom_campo = $valor;
					$_POST[$nom_campo]=$valor;
					//echo "$nom_campo=$valor<br>\n";
				}
				
				//echo "$nom_campo --> ".$$nom_campo."<br>\n";
			} 
							   
			
			$password_u =$_POST['pass']; 
			$pass_actual = $_POST['pass_actual'];
			
			if($password_u!=""){

	 			 $query= "SELECT password   
					  FROM  usuario
					  WHERE id_usuario='$id_usuario'";
       
				
		 		$result= cms_query($query)or die (error($query,mysql_error(),$php));
				list($pass) = mysql_fetch_row($result);
		 
		 		$password_actual_crip = md5($pass_actual);
		 
		
		
		 		if($pass==$password_actual_crip ){
		 				$password_u_crip = md5($password_u);
		 				//$strg_pass ="password='$password_u_crip',";		
						$_POST['password']= $password_u_crip;	
		 				 $msg="&msg=3";
					}else{
			 			$msg="&msg=1";
					}
				

			}else{
					$_POST['password']= $password;	
			}
			
			
			




//no permitimos cambio de login en este modulo
$_POST['login']= $login;
$_POST['email']= $email;
$_POST['id_ocupacion']=$_POST['id_usuario_ocupacion'];

if($_POST['id_tipo_persona']==1){
$_POST['apoderado']=$_POST['apoderado_natural'];
}


$fecha_nac_u = fechas_bd($fecha_nac_u);

$rut = str_replace(".","",$_POST['rut']);
$rut = str_replace(",","",$rut);
$rut = str_replace("#","",$rut);
$rut = str_replace("-","",$rut);

$_POST['rut']=$rut;




   if($msg==""){
   $msg="&msg=2";	
 }

 
  if( $_POST['paterno']!="" and $_POST['materno']!=""){
	 
	
	if (($_POST['id_pais']!="") and ($_POST['id_pais'] >0)){
			
			$sql = "Select pais from pais where id_pais = '".$_POST['id_pais']."'";
			$result_pais = cms_query($sql)or die (error($sql,mysql_error(),$php));
			list($pais)=  mysql_fetch_row($result_pais);
			
			if ($pais != "Chile"){
				$_POST['id_region'] = 0;
				$_POST['id_comuna'] = 0;
			}
			
	}	


	    $query= "SELECT estado,id_entidad_padre ,id_entidad
               FROM  usuario
               WHERE id_usuario='$id_usuario'";
         $result= mysql_query($query)or die (error($query,mysql_error(),$php));
          list($estado,$id_entidad_padre ,$id_entidad) = mysql_fetch_row($result);
		  $_POST['estado']=$estado;
		  $_POST['id_entidad_padre']=$id_entidad_padre;
		  $_POST['id_entidad']=$id_entidad;
		  
	
	update('usuario',$id_usuario);
 
	
	header("Location:index.php?accion=$accion&act=5&$msg");
	
  }else{

	   
  header("Location:index.php?accion=$accion");
  }
 
 
	   
	
	  
?>