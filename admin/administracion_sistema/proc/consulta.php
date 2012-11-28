<?php

//consulta
$query= "SELECT id_auto_admin   
           FROM  acciones
           WHERE accion='$accion'";

     $result= cms_query($query)or die (error($query,mysql_error(),$php));
     list($id_auto_admin) = mysql_fetch_row($result);
	
$cpl ="cpl_";



if($id_auto_admin!=""){	



  $query= "SELECT tabla   
           FROM  auto_admin 
           WHERE id_auto_admin='$id_auto_admin'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      if (list($nom_tabla) = mysql_fetch_row($result)){
						   
		  $query= "SELECT campo
                   FROM  auto_admin_campo
                   WHERE id_tipo_campo=1 and id_auto_admin='$id_auto_admin'";
             $result= cms_query($query)or die (error($query,mysql_error(),$php));
        if (list($cpo) = mysql_fetch_row($result)){
        						   
					
 $sql = "SELECT * FROM $nom_tabla  LIMIT 0,1"; 
 $qry = cms_query($sql);
   $num_filas = mysql_num_fields($qry);
   


   
 for ($i = 0; $i < $num_filas; $i++){			//el num_filas cuenta la cantidad de campos que tiene una tabla 
    $nom_campo = mysql_field_name($qry,$i);		//y luego va sacando los datos que hay en cada campo
	
	
	
	if(!$_GET[$nom_campo]){
	$$nom_campo = $_POST[$nom_campo];	
		
	}
   
   }  	
 }else{
 	
 	echo "<script>alert('Existe problemas de configuración'); document.location.href='index.php';</script>\n";
 	
 	}
 }
 
 
  }else{
  echo "<script>alert('Existe problemas de configuración'); document.location.href='index.php';</script>\n";
 	
  }
  



?>