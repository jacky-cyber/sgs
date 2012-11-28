<?php
$acc_add = $_GET['acc_add'];

/*
$_POST['accion']=$_GET['id'];
$_POST['acciones']=$_GET['acc_add'];

*/

$qry_insert="INSERT INTO accion_acciones(id_accion_acciones,accion,acciones) values (null,'$id','$acc_add')";
              
 $result_insert=cms_query($qry_insert) or die (error($qry_insert,mysql_error(),$php));


?>