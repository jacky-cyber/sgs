<?php

//vamos a borrar a los usuarios

//$id_empresa_o = $_GET['id_empresa_o'];

if($id_user!=$id_usuario){
	$dest = $_GET['dest'];

  $Sql ="DELETE FROM usuario 
         WHERE id_usuario=$id_user and id_empresa=$id_emp";

 mysql_query($Sql);
  if($dest==1){
 	header("Location:$PHP_SELF?accion=$accion&id_emp=$id_emp");
    }
   elseif($dest==2){
	header("Location:$PHP_SELF?accion=$accion&act=$act&act_usuario=1&id_user=$id_user&id_emp=$id_emp");
    }


}else{
	echo "<script>alert('No te puedes borrar a ti mismo'); document.location.href='index.php?accion=$accion';</script>\n";
}



 





?>