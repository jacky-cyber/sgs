<?php

$id_grupo = $_GET['id_grupo'];

 $Sql ="DELETE FROM accion_grupo where id_grupo='$id_grupo'";

 cms_query($Sql);


  header("Location:index.php?accion=$accion");
?>