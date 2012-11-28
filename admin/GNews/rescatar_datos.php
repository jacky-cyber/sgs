<?php
$id_plantilla = $_GET['id_plantilla'];


  $query= "SELECT  nombre_plantilla,plantilla_html,defecto 
           FROM  noticia_plantilla
           WHERE id_plantilla_noticia='$id_plantilla'";
     $result= cms_query($query)or die (error($query,mysql_error(),$php));
      list($nombre_plantilla,$plantilla_html,$defecto) = mysql_fetch_row($result);

?>