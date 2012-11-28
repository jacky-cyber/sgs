<?php

$query= "SELECT id_configuracion,configuracion,valor,descripcion,publico,orden,txt,obligatorio     
           FROM  cms_configuracion
           WHERE publico=1";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      while (list($id_configuracion,$configuracion,$valor,$descripcion,$publico,$orden,$txt,$obligatorio) = mysql_fetch_row($result)){
			
			$var =  $_POST['campo_'.$id_configuracion];
			
			
			$Sql ="UPDATE cms_configuracion
            	   SET valor ='$var'
            	   WHERE id_configuracion ='$id_configuracion'";

 cms_query($Sql)or die (error($Sql,mysql_error(),$php));
										
										
		   
		 }
		 
		$id_entidad_padre = $_POST['id_entidad_padre'];
		if($id_entidad_padre!=""){
		
		  $query= "SELECT id_entidad,entidad     
                   FROM  sgs_entidades
				   Where id_entidad_padre=$id_entidad_padre";
				   
				  // echo $query."<br>";
             $result2= cms_query($query)or die (error($query,mysql_error(),$php));
              while (list($id_entidad,$entidad) = mysql_fetch_row($result2)){
        			
					if($_POST['check_e_'.$id_entidad]==1){
					$var2 .= "$id_entidad,";
					
					}
					
					   
        		 }
			$var2 = elimina_ultimo_caracter($var2);
			$Sql ="UPDATE cms_configuracion
            	   SET valor='$var2'
            	   WHERE configuracion ='id_entidad'";

 cms_query($Sql)or die (error($Sql,mysql_error(),$php));
				 
			$Sql ="UPDATE cms_configuracion
            	   SET valor='$id_entidad_padre'
            	   WHERE configuracion ='id_servicio'";

 cms_query($Sql)or die (error($Sql,mysql_error(),$php));
				   
				
		
		}
		
				
				
			if($_POST['user']!="" and $_POST['pass']!=""){
			
			$usuario = $_POST['user'];
			$clave = md5($_POST['pass']);
	
			$sql = "Insert into usuario (login,password,nombre,id_perfil,estado) VALUES ('$usuario','$clave','Webmaster','999','1');";

 cms_query($sql)or die ("ERROR $php <br>$Sql<br>".mysql_error());
	
			}
	
	$politicas = $_POST['politicas'];
	$Sql ="UPDATE noticias SET contenido ='".$politicas."' WHERE id_noticia ='2009012010144481'";

 cms_query($Sql)or die ("ERROR $php <br>$Sql".mysql_error());
	
	$Sql ="UPDATE accion_grupo SET id_grupo ='0' WHERE grupo ='Sitio'";

 cms_query($Sql)or die (error($Sql,mysql_error(),$php));
	
    
		
        header("Location:index.php?accion=$accion&act=2");

?>