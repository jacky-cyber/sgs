<?php

$id_p_check = $_POST['id_p_check'];
$boton_aceptar = $_POST['boton_aceptar'];
$perfiles_publico = $_POST['perfiles_publico'];

/*guada configuracion perfiles*/
if($id_p_check==""){

if($perfiles_publico=="1"){

	if(!perfil_contenido($id_perfil,$id_contenido)){
	 
	 $Sql ="DELETE FROM control_contenido_perfil
	 		WHERE id_contenido=$id_contenido";

 cms_query($Sql);
	  
	$qry_insert="INSERT INTO control_contenido_perfil(id_contenido,id_perfil)  
				 values ('$id_contenido','0')";
              
	$result_insert=cms_query($qry_insert) or die("$MSG_DIE - 1 QR-Problemas al insertar $qry_insert");
	}



}else{

 $Sql ="DELETE FROM control_contenido_perfil
	 		WHERE id_contenido=$id_contenido";

 cms_query($Sql);


$query_check = "SELECT id_perfil,perfil  
                FROM usuario_perfil ";		  
;  
	
	 
$result_user_check = cms_query($query_check) or die ("problemas en la consulta 2.<br>$query_check");


 while(list($id_perfil_check,$perfil_check) = mysql_fetch_row($result_user_check)){
 

	$var ="id_perfil_check_$id_perfil_check";
	$var_temp="temp_$var";

	
		if($_POST[$var]){
		
		 $nivel= nivel_perfil($id_perfil_check);
				/*if($nivel!="0" ){
					
				}else{
				
					marca_perfil_contenido($id_perfil_check,$id_contenido);
				}*/
				//echo "$id_contenido,$id_perfil_check";
				//marca_perfil_contenido($id_contenido,$id_perfil_check);
				marca_arbol_sin_perfiles_contenido($id_contenido,$id_perfil_check,$id_perfil_check);
			//marca_arbol_sin_perfiles_contenido($id_perfil_check,$id_contenido);
			//echo "Perfil inicial marca_arbol_sin_perfiles_contenido  $id_perfil_check";
		
		}elseif($_POST[$var_temp]){
			desmarca_arbol_con_perfiles_contenido($id_contenido,$id_perfil_check,$id_perfil_check);
			
		}
		
	
	
	
	
	}


}


/*Perfil Colegios*/
/*$colegio_publico = $_POST['colegio_publico'];

if($colegio_publico==1){

	  $query= "SELECT id_contenido   
               FROM  control_contenido_escuela
               WHERE id_establecimiento='0' and id_contenido='$id_contenido'";
         $result= cms_query($query)or die (error($query,mysql_error(),$php));
          if(!list($id_cont) = mysql_fetch_row($result)){
		  
		  	 $Sql ="DELETE FROM control_contenido_escuela
			 		WHERE id_contenido=$id_contenido";

 cms_query($Sql)or die("$MSG_DIE - QR-Problemas al insertar $Sql");
			  
			  
    			$qry_insert="INSERT INTO control_contenido_escuela(id_contenido, id_establecimiento) 
				     values ($id_contenido,0)";
                
        	    $result_insert=cms_query($qry_insert) or die("$MSG_DIE - 3 QR-Problemas al insertar $qry_insert");			   
    		 }

		

		
}else{

		   $Sql ="DELETE FROM control_contenido_escuela
			 		WHERE id_establecimiento=0";

 cms_query($Sql)or die("$MSG_DIE - QR-Problemas al insertar $Sql");
			  

        $lista_establecimiento = $_POST['lista_establecimiento'];
		
	 if($lista_establecimiento!=""){
		if(!contenido_colegio($id_contenido,$lista_establecimiento) ){
		
			$qry_insert="INSERT INTO control_contenido_escuela(id_contenido,id_establecimiento) 
				         values ($id_contenido,$lista_establecimiento)";
                  
        	$result_insert=cms_query($qry_insert) or die("$MSG_DIE - 4 QR-Problemas al insertar $qry_insert");			   
    	
		}
		
	  }
		
			


}*/
}


	


?>