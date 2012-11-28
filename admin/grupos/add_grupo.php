<?php




$add = $_GET['add'];

if($add!=""){
$id_grupo = $_POST['id_grupo'];
$grupo = $_POST['grupo'];

$qry_insert="INSERT INTO accion_grupo (id_grupo,grupo) values ('$id_grupo','$grupo')";
              
$result_insert=cms_query($qry_insert) or die("$MSG_DIE - QR-Problemas al insertar $qry_insert");

header("Location:index.php?accion=$accion");
}else{
$accion_form = "index.php?accion=$accion&act=2&add=ok";
include("admin/grupos/formulario_grupo.php");

}



?>