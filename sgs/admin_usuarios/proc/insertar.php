<?php

	   
	   $fecha_nac_u = fechas_bd($fecha_nac_u);
	   
        $_POST['password'] = md5($_POST['password']);

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
		
		
		
		$login_u = $_POST['email'];
  $query= "SELECT id_usuario 
           FROM  usuario
           WHERE login='$login_u' ";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
     if(!list($id_us) = mysql_fetch_row($result)){

	 
	 $_POST['estado'] =1;
	 $_POST['login'] =  $_POST['email'];
	 $_POST['id_tipo_persona'] =  1;
	
	
	 inserta('usuario');
	 $email =  $_POST['email'];
	
	 
	 
	  $query= "SELECT id_usuario
               FROM  usuario
               WHERE email = '$email'";
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
          list($id_user) = mysql_fetch_row($result);
		 
        



}else{
		 	echo "<script>alert('Ya existe un Usuario \"$login_u\" con estos datos.'); document.location.href='index.php?accion=$accion&act=4';</script>\n";
		 }
?>