<?php
$acc = $_GET['acc'];
$acc_bd = $_GET['acc_bd'];



  $query= "SELECT id_acc
           FROM  acciones
           WHERE accion='$acc_bd'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
     list($id_acc) = mysql_fetch_row($result);
     
 $query= "SELECT id_acc
           FROM  acciones
           WHERE accion='$acc'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
     list($id_acc2) = mysql_fetch_row($result);
     
     $Sql ="UPDATE acciones 
     	    SET accion ='$acc_bd'
     	    WHERE id_acc ='$id_acc2'";

 cms_query($Sql)or die (error($query,mysql_error(),$php));

     $Sql ="UPDATE acciones 
     	    SET accion ='$acc'
     	    WHERE id_acc ='$id_acc'";

 cms_query($Sql)or die (error($query,mysql_error(),$php));

     	   
    
     	//   header("Location:?accion=$accion"); 	   

?>