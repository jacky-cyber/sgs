<?php

$id_user = $_GET['id_user'];
$estado = $_GET['estado'];

    $query= "SELECT estado   
           FROM  usuario
           WHERE id_usuario='$id_user'";
     $result_3= mysql_query($query)or die (mysql_error());
      list($estado_u) = mysql_fetch_row($result_3);
	  
		

if($id_usuario!=$id_user){


	
	if($estado_u==0){
	      $estado= 1;
	 echo "<img  style=\"cursor: pointer;  cursor: hand;\" onclick=\"ObtenerDatos('index.php?accion=$accion&act=77&id_user=$id_user&axj=1','v_$id_user');\" src=\"images/ciculo_ok.gif\" border=\"0\" alt=\"Usuario activo. Click para Desactivar\">
						";
	    
	  }elseif($estado_u==1){
	  	$estado= 2;
	   echo "<img style=\"cursor: pointer;  cursor: hand;\" onclick=\"ObtenerDatos('index.php?accion=$accion&act=77&id_user=$id_user&axj=1','v_$id_user');\" src=\"images/minus_circle.gif\" border=\"0\" alt=\"Cuenta Bloqueada. Click para Activar Cuenta\">
                       ";
	 
	  }elseif($estado_u==2){
	  	$estado= 0;
	   
	echo "<img style=\"cursor: pointer;  cursor: hand;\" onclick=\"ObtenerDatos('index.php?accion=$accion&act=77&id_user=$id_user&axj=1','v_$id_user');\" src=\"images/ciculo_warring.gif\" border=\"0\" alt=\"Usuario creado pero con su cuenta aun desactiva. click para Desactivar Permanentemente\">
					  ";
	  } 
	
	   

	  
	  
	  $Sql ="UPDATE usuario
	   SET estado ='$estado'
	   WHERE id_usuario ='$id_user'";
    
 		mysql_query($Sql)or die (error($Sql,mysql_error(),$php));
	 
	 // $contenido = $link_activo;
}else{

 //echo "<script>alert('No puedes generar cambios en tu propio usuario'); document.location.href='index.php?accion=$accion';</script>\n";

}




?>