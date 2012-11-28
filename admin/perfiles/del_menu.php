<?php

 $Sql ="DELETE FROM vistas_usuarios
        WHERE id_pagina='$accion_del'";

 cms_query($Sql)or die (error($query,mysql_error(),$php));
  
  
   $Sql ="DELETE FROM vistas
           WHERE id_vistas = '$accion_del'";

 cms_query($Sql)or die (error($query,mysql_error(),$php));

	
?>