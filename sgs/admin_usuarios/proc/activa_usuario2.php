<?php

$id_user = $_GET['id_user'];
$estado = $_GET['estado'];

    $query= "SELECT estado   
           FROM  usuario
           WHERE id_usuario='$id_user'";
     $result_3= cms_query($query)or die (error($query,mysql_error(),$php));
      list($estado_u) = mysql_fetch_row($result_3);
	  
		

if($id_usuario!=$id_user){


	   
	if($estado_u==0){
	      $estado= 1;
	  $link_activo ="<div id=\"v_$id_user\" style=\"cursor: pointer;  cursor: hand;\" onclick=\"ObtenerDatos('index.php?accion=$accion&act=77&id_user=$id_user&axj=1','v_$id_user');\">
	   					<img  src=\"images/ciculo_ok.gif\" border=\"0\" alt=\"Usuario activo. Click para Desactivar\">
						</div>";
	    
	  }elseif($estado_u==1){
	  	$estado= 2;
	    $link_activo ="<div id=\"v_$id_user\" style=\"cursor: pointer;  cursor: hand;\" onclick=\"ObtenerDatos('index.php?accion=$accion&act=77&id_user=$id_user&axj=1','v_$id_user');\">
	   					<img  src=\"images/minus_circle.gif\" border=\"0\" alt=\"Cuenta Bloqueada. Click para Activar Cuenta\">
                      </div> ";
	 
	  }elseif($estado_u==2){
	  	$estado= 0;
	   
	 $link_activo ="<div id=\"v_$id_user\" style=\"cursor: pointer;  cursor: hand;\" onclick=\"ObtenerDatos('index.php?accion=$accion&act=77&id_user=$id_user&axj=1','v_$id_user');\">
	   					<img  src=\"images/ciculo_warring.gif\" border=\"0\" alt=\"Usuario creado pero con su cuenta aun desactiva. click para Desactivar Permanentemente\">
					  </div>";
	  } 
	   
	  $Sql ="UPDATE usuario
	   SET estado ='$estado'
	   WHERE id_usuario ='$id_user'";
//CHO $Sql;
 		cms_query($Sql)or die (error($Sql,mysql_error(),$php));
	 
	  $contenido = $link_activo;
}else{

//echo "<script>alert('No puedes generar cambios en tu propio usuario'); document.location.href='index.php?accion=$accion';</script>\n";

}




?>