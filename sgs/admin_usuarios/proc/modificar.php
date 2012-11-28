<?php



		$aux=explode("-", $fecha_nac_u);     
		$dia = $aux[0];		
	    $mes   = $aux[1];	   
        $ano   = $aux[2];
        $fecha_nac_u = "$ano-$mes-$dia";
	

		
   
	 $session  = rescata_valor('usuario',$id_user,'session'); 
	 $estado   = rescata_valor('usuario',$id_user,'estado'); 
	 
	 //$password = $_POST['password'];
	 
	 
	 
	 
	 if($session==$id_sesion){
	 	$_POST['session']= $id_sesion;
	 }
	 
	if($_POST['password']!="" and $_POST['pass2']!="" and $_POST['pass2']==$_POST['password']){
		
		$_POST['password'] = md5($_POST['password']);
		//$password= $_POST['password'];
			//echo "passwor $password";
	}else{
	    $pass_crip = rescata_valor('usuario',$id_user,'password'); 
		$_POST['password'] = $pass_crip;
		//echo  $pass_crip;

	}
	
	$_POST['login'] = $_POST['email'];
	$_POST['estado'] = $estado;
	
	

if($id_user==$id_usuario){
  	// $_POST['password'] = md5($pass_crip);
	 /*$login   = rescata_valor('usuario',$id_user,'login'); 
	 
	 $_POST['login'] =rescata_valor('usuario',$id_user,'password'); 
	 $_POST['password'] =rescata_valor('usuario',$id_user,'password'); */
	// update('usuario',$id_user);
	

	 echo  "<script>alert('No es posible cambiar sus propios datos en este modulo'); document.location.href='index.php?accion=$accion'; </script>\n";
	
}else{
	
	
	if($id_perfil!=999  and $_POST['email']){
	
	    	if($_POST['departamento_add']!="" ){
			$_POST['departamento_add']= acentos($_POST['departamento_add']);
			$query= "SELECT id_departamento   
                       FROM  sgs_departamentos
                       WHERE departamento='$dpto'";
                 $result= cms_query($query)or die (error($query,mysql_error(),$php));
                 if(!list($id_depto) = mysql_fetch_row($result)){
					
					 $_POST['departamento'] = $_POST['departamento_add']; 
					 $dpto = $_POST['departamento_add'];
           			
					 inserta('sgs_departamentos');
			 		
					 $query= "SELECT id_departamento   
                      			 FROM  sgs_departamentos
                      			 WHERE departamento='$dpto'";
               			  $result= cms_query($query)or die (error($query,mysql_error(),$php));
                 			list($id_depto) = mysql_fetch_row($result);
				 }
		
			
			
			$_POST['id_departamento'] =$id_depto;
		}
		
	
	//echo $_POST['id_departamento']."cddd";
		
		update('usuario',$id_user);
		
	
	
	if($_POST['password']!="" and $_POST['pass2']!="" and $_POST['password']==md5($_POST['pass2'])){
		
	echo  "<script>alert('Datos Actualizados'); document.location.href='index.php?accion=$accion&act=1&id_user=$id_user'; </script>\n";
		
	}else{
		echo  "<script>alert('Datos Actualizados, contrase\u00F1a NO fue actualizada '); document.location.href='index.php?accion=$accion&act=1&id_user=$id_user'; </script>\n";
	
	}
	
	
	}else{
	  echo  "<script>alert('No es posible cambiar datos de un usuario Administrador Absoluto'); document.location.href='index.php?accion=$accion'; </script>\n";
	
	}
	
	
}








?>