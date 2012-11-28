<?php
$apodo = $_POST['apodo'];		 
$file = $_POST['file_php'];			 
		 
 
		 
		       $qry_insert="INSERT INTO vistas (id_vistas,pagina,descripcion,Estado,contenido)
                  VALUES ('','$file','$apodo','nb','0')";
	//echo $qry_insert;
          $result_insert=cms_query($qry_insert) or die("$MSG_DIE - QR-Problemas al insertar qry_insert");
		  
	  Header("Location: ?accion=1005&id_usuario=$id_usuario&user=$user&act=1&datos=ok");

?>